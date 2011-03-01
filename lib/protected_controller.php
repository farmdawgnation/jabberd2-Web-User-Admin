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
 * This class defines a controller
 * which requires user authentication
 * to utilize.
 */
class protected_controller {
	/**
	 * This constructor will only work if the user is authenticated.
	 * Otherwise, it will trigger a redirect.
	 */
	public function __construct() {
		if(!$_SESSION['logged_in']) {
			header("Location: /index.php?controller=user&action=login");
			die();
		}
	}
}

?>