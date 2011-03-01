<?php
################
# jabberd2_webuseradmin                                           
# The web-based user administration tool for closed-registration
# jabberd2 servers using a MySQL database backend.
#
# (c)2011 Matt Farmer
# http://farmdawgnation.com
################

/**
 * Database class to facilitate DB connections
 * for the webapp.
**/
class database {
	private static $pdoInstance;
	
	/**
	 * Connect to the database and save the instance of the connection
	 * in a static variable.
	**/
	public static init() {
		//Construct the DSN
		$dsn = 'mysql:dbname=' . DB_DATABASE;
		
		if(DB_CONNTYPE == 'socket') {
			$dsn .= ';unix_socket=' . DB_UNIX_SOCKET;
		} else if(DB_CONNTYPE == 'host') { 
			$dsn .= ';host=' . DB_HOST_ADDRESS;
			$dsn .= ';port=' . DB_HOST_PORT;
		} else {
			die("DB_CONNTYPE is unrecognized.");
		}
		
		//Init PDO
		try {
			$dbh = new PDO($dsn, $user, $password);
			
			self::$pdoInstance = $dbh;
		} catch (PDOException $e) {
			die 'Database connection failed: ' . $e->getMessage();
		}
	}
	
	/**
	 * Retrieve the current instance of the database.
	 * @returns A PDO object or terminates with an error.
	**/
	public static this() {
		if(isset(self::$pdoInstance)) {
			return self::$pdoInstance;
		} else {
			die("Fatal error: attempt to access database without connection to database.");
		}
	}
}
?>