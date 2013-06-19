<?php
/* Advance Test cases generated on: 2012-09-19 06:16:04 : 1348035364*/
App::import('Model', 'Advance');

class AdvanceTestCase extends CakeTestCase {
	var $fixtures = array('app.advance');

	function startTest() {
		$this->Advance =& ClassRegistry::init('Advance');
	}

	function endTest() {
		unset($this->Advance);
		ClassRegistry::flush();
	}

}
