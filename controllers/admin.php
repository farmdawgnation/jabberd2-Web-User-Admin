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
 * This is where all the action happens.
 */
class admin extends protected_controller {
	/**
	 * The manage list.
	 */
	public function users() {
		//Retrieve the list of users from the database
		$data['results'] = database::this()->query("SELECT * FROM authreg");
		
		//Load the views
		view::load('header');
		view::load('admin/manage', $data);
		view::load('footer');
	}
	
	public function addUser() {
		//Unified add/edit
		$this->editUser();
	}
	
	public function editUser() {
		//Check the id setting
		if(!isset($_GET['jid'])) {
			//Id isn't set. This is an add action
			$user = array();
		} else {
			//The id is set. Retrieve the user from the database
			$username_parts = explode("@", $_GET['jid']);
			$pdoStatement = database::this()->prepare("SELECT * FROM authreg WHERE username = :username AND realm = :realm");
			$pdoStatement->execute(array('username' => $username_parts[0], 'realm' => $username_parts[1]));
			$user = $pdoStatement->fetch();
		}
		
		//Count the POST variables?
		//We have incoming post data
		if(count($_POST) > 0) {
			//Update the record in the database
			$updateSql = "UPDATE authreg SET username = :username, realm = :realm, password = :password";
			$pdoStatement = database::this()->prepare($updateSql);
			$pdoStatement->execute(array('username' => $_POST['username'], 'realm' => $_POST['realm'], 'password' => $_POST['password']));
			
			//Redirect with success
			$_SESSION['notice'] = "User saved.";
			util::redirect('admin', 'users');
		}
		
		//stuff data
		$data['user'] = $user;
		
		//load views
		view::load('header');
		view::load('admin/form', $data);
		view::load('footer');
	}
	
	public function deleteUser() {
		//TODO
	}
}

?>