<?php
/* SaleDetail Test cases generated on: 2012-08-03 05:09:42 : 1343963382*/
App::import('Model', 'SaleDetail');

class SaleDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.sale_detail', 'app.sale', 'app.payment_type');

	function startTest() {
		$this->SaleDetail =& ClassRegistry::init('SaleDetail');
	}

	function endTest() {
		unset($this->SaleDetail);
		ClassRegistry::flush();
	}

}
