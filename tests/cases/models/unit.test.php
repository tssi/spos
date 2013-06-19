<?php
/* Unit Test cases generated on: 2012-07-29 17:06:31 : 1343574391*/
App::import('Model', 'Unit');

class UnitTestCase extends CakeTestCase {
	var $fixtures = array('app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->Unit =& ClassRegistry::init('Unit');
	}

	function endTest() {
		unset($this->Unit);
		ClassRegistry::flush();
	}

}
