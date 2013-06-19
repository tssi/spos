<?php
/* Activity Test cases generated on: 2012-07-29 13:51:43 : 1343562703*/
App::import('Model', 'Activity');

class ActivityTestCase extends CakeTestCase {
	var $fixtures = array('app.activity');

	function startTest() {
		$this->Activity =& ClassRegistry::init('Activity');
	}

	function endTest() {
		unset($this->Activity);
		ClassRegistry::flush();
	}

}
