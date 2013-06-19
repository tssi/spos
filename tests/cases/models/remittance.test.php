<?php
/* Remittance Test cases generated on: 2012-09-10 02:12:38 : 1347243158*/
App::import('Model', 'Remittance');

class RemittanceTestCase extends CakeTestCase {
	var $fixtures = array('app.remittance');

	function startTest() {
		$this->Remittance =& ClassRegistry::init('Remittance');
	}

	function endTest() {
		unset($this->Remittance);
		ClassRegistry::flush();
	}

}
