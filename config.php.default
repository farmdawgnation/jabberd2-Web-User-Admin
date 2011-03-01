<?php
################
# jabberd2_webuseradmin                                           
# The web-based user administration tool for closed-registration
# jabberd2 servers using a MySQL database backend.
#
# (c)2011 Matt Farmer
# http://farmdawgnation.com
################

/////////
// Database Configuration
/////////

////
// DB_TYPE
// Defines the type of DB to use.
// Currently ignored, but could be used to indicate a pgSql
// DB if someone wants to implement it.
////
define('DB_TYPE', 'mysql');

/////
// DB_CONNTYPE
// Either 'tcp' or 'socket'. If socket you need to specify
// the path to a local UNIX socket to connect to. If tcp you'll
// fill out the host information
/////
define('DB_CONNTYPE', 'socket');

/////
// DB_LOCAL_SOCKET
// Only if you set DB_CONNTYPE to 'socket'
// The path to the UNIX socket for the Db.
/////
define('DB_LOCAL_SOCKET', '/var/run/mysql.sock');

/////
// DB_HOST_ADDRESS, DB_HOST_POST
// Used to indicate the host address and port
// if you are using the tcp DB_CONNTYPE setting
/////
define('DB_HOST_ADDRESS', 'localhost');
define('DB_HOST_PORT', '3306');

/////
// DB_USER, DB_PASS
// Login credentials for the database.
/////
define('DB_USER', 'jabberd2');
define('DB_PASS', 'secret');

/////
// DB_DATABASE
// The name of the database that jabberd2 is using
// as its datastore.
/////
define('DB_DATABASE', 'jabberd2');

/////////
// Preferences Configuration
/////////

/////
// PREF_PARTYLINE
// The "party line" feature essentially means that
// everyone on the server will always be on everyone
// else's buddy list. As a result, the jabber buddy
// lists get nuked and reset every time a user is
// added or deleted from the database.
/////
define('PREF_PARTYLINE', false);

/////
// PREF_PARTYLINE_GROUP
// If you specified PREF_PARTYLINE, then you also need
// to indicate the name of the group that all users
// will exist in using PREF_PARTYLINE_GROUP
/////
define('PREF_PARTYLINE_GROUP', 'My Compnany');

/////
// PREF_PASSFORMAT
// Indicate here whether or not jabberd2 is storing
// passwords as plaintext or an md5 hash. ('plain' or 'md5')
/////
define('PREF_PASSFORMAT', 'plain');

/////////
// Administration Configuration
/////////

/////
// $admin_jids
// This variable is an array of jids that have the ability
// to access this interface. In the future, this feature
// will be disabled in favor of a databased solution.
/////
$admin_jids = array('admin@localhost', 'admin2@localhost');

?>