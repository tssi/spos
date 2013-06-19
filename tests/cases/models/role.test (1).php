<?php
/* Role Test cases generated on: 2012-07-29 13:51:54 : 1343562714*/
App::import('Model', 'Role');

class RoleTestCase extends CakeTestCase {
	var $fixtures = array('app.role', 'app.group', 'app.control_object', 'app.request_object', 'app.user', 'app.navigation');

	function startTest() {
		$this->Role =& ClassRegistry::init('Role');
	}

	function endTest() {
		unset($this->Role);
		ClassRegistry::flush();
	}

}
