<?php
/* Perishable Test cases generated on: 2012-07-30 19:21:45 : 1343676105*/
App::import('Model', 'Perishable');

class PerishableTestCase extends CakeTestCase {
	var $fixtures = array('app.perishable', 'app.product_type', 'app.product', 'app.unit');

	function startTest() {
		$this->Perishable =& ClassRegistry::init('Perishable');
	}

	function endTest() {
		unset($this->Perishable);
		ClassRegistry::flush();
	}

}
