<?php
/* SalePayment Test cases generated on: 2012-12-20 03:42:44 : 1355971364*/
App::import('Model', 'SalePayment');

class SalePaymentTestCase extends CakeTestCase {
	var $fixtures = array('app.sale_payment', 'app.sale', 'app.sale_detail', 'app.payment_type');

	function startTest() {
		$this->SalePayment =& ClassRegistry::init('SalePayment');
	}

	function endTest() {
		unset($this->SalePayment);
		ClassRegistry::flush();
	}

}
