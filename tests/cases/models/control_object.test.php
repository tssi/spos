<?php
/* ControlObject Test cases generated on: 2012-09-19 03:07:23 : 1348024043*/
App::import('Model', 'ControlObject');

class ControlObjectTestCase extends CakeTestCase {
	var $fixtures = array('app.control_object', 'app.group', 'app.role', 'app.navigation', 'app.user', 'app.request_object');

	function startTest() {
		$this->ControlObject =& ClassRegistry::init('ControlObject');
	}

	function endTest() {
		unset($this->ControlObject);
		ClassRegistry::flush();
	}

}
