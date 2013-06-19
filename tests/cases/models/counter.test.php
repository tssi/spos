<?php
/* Counter Test cases generated on: 2012-08-03 18:46:09 : 1344019569*/
App::import('Model', 'Counter');

class CounterTestCase extends CakeTestCase {
	var $fixtures = array('app.counter');

	function startTest() {
		$this->Counter =& ClassRegistry::init('Counter');
	}

	function endTest() {
		unset($this->Counter);
		ClassRegistry::flush();
	}

}
