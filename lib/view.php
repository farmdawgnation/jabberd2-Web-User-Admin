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
 * This class defines a controller
 * which requires user authentication
 * to utilize.
 */
class view {
	/**
	 * This method loads and displays a view from the
	 * views directory.
	**/
	public static function load($vname, $data = array()) {
		//Does the view exist?
		if(!file_exists(VIEW_PATH . '/' . $vname . '.php')) {
			die("Error 404: View resource not found.");
		} else {
			//Set locals
			if(is_array($data)) {
				foreach($data as $k => $v) {
					//variable variables... haha
					$$k = $v;
				}
			}
			
			//load file
			require_once(VIEW_PATH . '/' . $vname . '.php');
		}
	}
}

?>