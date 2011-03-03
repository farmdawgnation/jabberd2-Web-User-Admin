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
		$pdoStatement = database::this()->query("SELECT * FROM authreg");
		$data['users'] = $pdoStatement->fetchAll();
		
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
			//Is this a current user?
			if(isset($_GET['jid'])) { //This is a pre existing user.
				//Are we changing their password?
				if(isset($_POST['password']) && $_POST['password'] != '') {
					//Update the record in the database
					$updateSql = "UPDATE authreg SET username = :username, realm = :realm, password = :password WHERE username = :curusername AND realm = :currealm";
					$pdoStatement = database::this()->prepare($updateSql);
					$pdoStatement->execute(array('username' => $_POST['username'], 'realm' => $_POST['realm'], 'password' => $_POST['password'], 'curusername' => $username_parts[0], 'currealm' => $username_parts[1]));
				} else {
					//Update the record in the database, without touching the password
					$updateSql = "UPDATE authreg SET username = :username, realm = :realm WHERE username = :curusername AND realm = :currealm";
					$pdoStatement = database::this()->prepare($updateSql);
					$pdoStatement->execute(array('username' => $_POST['username'], 'realm' => $_POST['realm'], 'curusername' => $username_parts[0], 'currealm' => $username_parts[1]));
				}
				
				//Now we must update the active table
				$updateSql = "UPDATE active SET collection-owner = :jid WHERE collection-owner = :curjid";
				$pdoStatement = database::this()->prepare($updateSql);
				$result = $pdoStatement->execute(array('jid' => $_POST['username'] . '@' . $_POST['realm'], 'curjid' => $_GET['jid']));
				
				if(!$result) die(print_r($result->errorInfo()));
			} else { //This is a new user
				//Create the authreg record.
				$insertSql = "INSERT INTO authreg VALUES (:username, :realm, :password);";
				$pdoStatement = database::this()->prepare($insertSql);
				$result = $pdoStatement->execute(array('username' => $_POST['username'], 'realm' => $_POST['realm'], 'password' => $_POST['password']));
				
				if($result) {
					//Create the active record
					$insertSql = "INSERT INTO active (`collection-owner`, `time`) VALUES (:jid, UNIX_TIMESTAMP());";
					$pdoStatement = database::this()->prepare($insertSql);
					$result = $pdoStatement->execute(array('jid' => $_POST['username'] . '@' . $_POST['realm']));
					
					if(!$result) {
						//Redirect with failure
						$_SESSION['error'] = "PDO Error on active.";
						util::redirect('admin', 'users');
					}
				} else {
					//Redirect with failure
					$_SESSION['error'] = "PDO Error on authreg.";
					util::redirect('admin', 'users');
				}
			}
			
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