<?php
/* User Test cases generated on: 2012-07-29 13:51:58 : 1343562718*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.group', 'app.control_object', 'app.request_object', 'app.role', 'app.navigation');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
