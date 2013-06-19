<?php
/* Vendor Test cases generated on: 2012-09-14 08:42:29 : 1347612149*/
App::import('Model', 'Vendor');

class VendorTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor', 'app.receiving');

	function startTest() {
		$this->Vendor =& ClassRegistry::init('Vendor');
	}

	function endTest() {
		unset($this->Vendor);
		ClassRegistry::flush();
	}

}
