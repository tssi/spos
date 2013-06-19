<?php
/* Ending Test cases generated on: 2012-11-20 03:57:55 : 1353383875*/
App::import('Model', 'Ending');

class EndingTestCase extends CakeTestCase {
	var $fixtures = array('app.ending', 'app.ending_detail');

	function startTest() {
		$this->Ending =& ClassRegistry::init('Ending');
	}

	function endTest() {
		unset($this->Ending);
		ClassRegistry::flush();
	}

}
