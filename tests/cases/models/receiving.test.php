<?php
/* Receiving Test cases generated on: 2012-09-28 02:27:06 : 1348799226*/
App::import('Model', 'Receiving');

class ReceivingTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving', 'app.doc_type', 'app.vendor', 'app.receiving_detail', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->Receiving =& ClassRegistry::init('Receiving');
	}

	function endTest() {
		unset($this->Receiving);
		ClassRegistry::flush();
	}

}
