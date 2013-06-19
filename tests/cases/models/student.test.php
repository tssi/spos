<?php
/* Student Test cases generated on: 2012-12-28 08:54:55 : 1356684895*/
App::import('Model', 'Student');

class StudentTestCase extends CakeTestCase {
	var $fixtures = array('app.student');

	function startTest() {
		$this->Student =& ClassRegistry::init('Student');
	}

	function endTest() {
		unset($this->Student);
		ClassRegistry::flush();
	}

}
