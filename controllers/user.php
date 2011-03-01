<?php
################
# jabberd2_webuseradmin                                           
# The web-based user administration tool for closed-registration
# jabberd2 servers using a MySQL database backend.
#
# (c)2011 Matt Farmer
# http://farmdawgnation.com
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#   http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
################

/**
 * This class represents the user controller.
 */
class user {
	/**
	 * Handles login functionality.
	 */
	public function login() {
		//global
		global $admin_jids;
		
		//Check for incoming post variables.
		if(isset($_POST) && count($_POST) > 0) {
			//Do authentication.
			//Step 1 - is this user in the admin array?
			if(in_array($_POST['username'], $admin_jids)) {
				//This is an admin JID, so now we check for correct login.
				//If we are supposed to hash passwords, do so before moving
				//forward.
				$jidparts = explode("@", $_POST['username'], 2);
				$username = $jidparts[0];
				$realm = $jidparts[1];
				$password = $_POST['password'];
				
				if(PREF_PASSFORMAT == 'md5') {
					$password = md5($password);
				}
				
				//Now, we query the database for information on
				//users
				$pdoStatement = database::this()->prepare("SELECT * FROM authreg WHERE username = :username AND realm = :realm");
				$pdoStatement->execute(array('username' => $username, 'realm' => $realm));
				$userInfo = $pdoStatement->fetch();
				
				//Validate the password
				if($password == $userInfo['password']) {
					//successful authentication
				} else {
					//fail
					$data['error'] = "The username/password was invalid.";
				}
			} else {
				$data['error'] = "That user is not an administrator on this system.";
			}
		}
		
		//Render views
		view::load('header');
		view::load('user/login', $data);
		view::load('footer');
	}
}

?>