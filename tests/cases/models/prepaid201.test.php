<?php
/* Prepaid201 Test cases generated on: 2013-01-15 08:33:46 : 1358238826*/
App::import('Model', 'Prepaid201');

class Prepaid201TestCase extends CakeTestCase {
	var $fixtures = array('app.prepaid201', 'app.sop_pp_tran', 'app.sop_pp_val');

	function startTest() {
		$this->Prepaid201 =& ClassRegistry::init('Prepaid201');
	}

	function endTest() {
		unset($this->Prepaid201);
		ClassRegistry::flush();
	}

}
