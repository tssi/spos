<?php
/* ReceivingDetail Test cases generated on: 2012-09-14 08:44:46 : 1347612286*/
App::import('Model', 'ReceivingDetail');

class ReceivingDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving_detail', 'app.receiving', 'app.vendor', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->ReceivingDetail =& ClassRegistry::init('ReceivingDetail');
	}

	function endTest() {
		unset($this->ReceivingDetail);
		ClassRegistry::flush();
	}

}
