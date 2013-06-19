<?php
/* Group Test cases generated on: 2012-07-29 13:51:45 : 1343562705*/
App::import('Model', 'Group');

class GroupTestCase extends CakeTestCase {
	var $fixtures = array('app.group', 'app.control_object', 'app.request_object', 'app.role', 'app.navigation', 'app.user');

	function startTest() {
		$this->Group =& ClassRegistry::init('Group');
	}

	function endTest() {
		unset($this->Group);
		ClassRegistry::flush();
	}

}
