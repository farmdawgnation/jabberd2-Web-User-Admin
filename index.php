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

//report errors
error_reporting(E_ALL);

//Define the version
define('APP_VERSION_NAME', '0.1');
define('APP_VERSION_CODE', '1');

//Initilize the session.
session_start();

//Check for the existance of the config file.
if(!file_exists('config.php') || !is_readable('config.php')) {
	//Quit with error message.
	die("This app has either not been configured, or is not able to read the configuration file.");
}

//Otherwise, continue onward
//Load the required files.
require_once('config.php');
require_once('lib/database.php');
require_once('lib/protected_controller.php');
require_once('lib/view.php');
require_once('lib/util.php');

//Connect to the database
database::init();

//If controller and action are not specified, load the defaults.
if(!$_GET['controller'] && !$_GET['action']) {
	$controller = 'home';
	$action = 'dashboard';
} else {
	//Validate that our input isn't naughty
	if(!preg_match("/^([a-zA-Z]+)$/", $_GET['controller']) || !preg_match("/^([a-zA-Z]+)$/", $_GET['action']) || (isset($_GET['id']) && !is_numeric($_GET['id']))) {
		die("Fatal error: suspicious controller or action input.");
	}
	
	//If we're all good, then set these thingys as the controller
	//and the action
	$controller = $_GET['controller'];
	$action = $_GET['action'];
}

//Now, we must attempt to locate the controller file.
if(file_exists(APP_PATH . '/controllers/' . $controller . '.php')) {
	//Pull in the file
	require_once(APP_PATH . '/controllers/' . $controller . '.php');
} else {
	//Terminate with error
	die("Fatal error: Controller not found.");
}

//If we make it here, we have the controller. Let's make sure the action
//is real before proceeding.
if(!method_exists($controller, $action)) {
	die("Fatal error: Action not found: " . $controller . "/" . $action);
}

//Do what we do best.
//Call the controller and action!
$controller = new $controller();
$controller->$action();

?>