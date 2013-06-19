<?php
/* RequestObject Test cases generated on: 2012-09-19 03:05:36 : 1348023936*/
App::import('Model', 'RequestObject');

class RequestObjectTestCase extends CakeTestCase {
	var $fixtures = array('app.request_object', 'app.control_object', 'app.group', 'app.role', 'app.navigation', 'app.user');

	function startTest() {
		$this->RequestObject =& ClassRegistry::init('RequestObject');
	}

	function endTest() {
		unset($this->RequestObject);
		ClassRegistry::flush();
	}

}
