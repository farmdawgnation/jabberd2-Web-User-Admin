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
 * This class represents a controller
 * that is only usable when someone is logged in.
 */
class home extends protected_controller {
	/**
	 * Dashboard action
	 * Represents the landing page for the user.
	 */
	public function dashboard() {
		view::load('header');
		view::load('home/dashboard');
		view::load('footer');
	}
}

?>