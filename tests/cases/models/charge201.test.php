<?php
/* Charge201 Test cases generated on: 2013-01-04 02:31:24 : 1357266684*/
App::import('Model', 'Charge201');

class Charge201TestCase extends CakeTestCase {
	var $fixtures = array('app.charge201', 'app.sop_cge_tran', 'app.sop_cge_val');

	function startTest() {
		$this->Charge201 =& ClassRegistry::init('Charge201');
	}

	function endTest() {
		unset($this->Charge201);
		ClassRegistry::flush();
	}

}
