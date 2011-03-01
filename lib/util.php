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
class util {
	/**
	 * This method will generate an internal redirect then kill execution.
	 * @param controller The controller to redirect to.
	 * @param action The action within the controller.
	 */
	public function redirect($controller, $action) {
		header("Location: " . $_SERVER['REQUEST_URI'] . "?controller=$controller&action=$action");
		die();
	}
}

?>