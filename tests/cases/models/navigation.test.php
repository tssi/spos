<?php
/* Navigation Test cases generated on: 2012-07-29 13:51:46 : 1343562706*/
App::import('Model', 'Navigation');

class NavigationTestCase extends CakeTestCase {
	var $fixtures = array('app.navigation', 'app.role', 'app.group', 'app.control_object', 'app.request_object', 'app.user');

	function startTest() {
		$this->Navigation =& ClassRegistry::init('Navigation');
	}

	function endTest() {
		unset($this->Navigation);
		ClassRegistry::flush();
	}

}
