<?php
################
# jabberd2_webuseradmin                                           
# The web-based user administration tool for closed-registration
# jabberd2 servers using a MySQL database backend.
#
# (c)2011 Matt Farmer
# http://farmdawgnation.com
################

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

//Connect to the database
database::init();

//If controller and action are not specified, load the defaults.
if(!$_GET['controller'] && !$_GET['action']) {
	$controller = 'home';
	$controller = 'dashboard';
} else {
	//Validate that our input isn't naughty
	if(!preg_match("/^[a-z]$/", $_GET['controller']) || !preg_match("/^[a-z]$/", $_GET['action']) || !is_numeric($_GET['id'])) {
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
	require_once(APP_PATH . '/controllers/' . $controller . '.php'));
} else {
	//Terminate with error
	die("Fatal error: Controller not found.");
}

//If we make it here, we have the controller. Let's make sure the action
//is real before proceeding.
if(!method_exists($controller, $action)) {
	die("Fatal error: Action not found.");
}

//Do what we do best.
//Call the controller and action!
$controller = new $controller();
$controller->$action;

?>