<?php
/* SalesPayment Test cases generated on: 2012-12-18 08:11:53 : 1355818313*/
App::import('Model', 'SalesPayment');

class SalesPaymentTestCase extends CakeTestCase {
	var $fixtures = array('app.sales_payment', 'app.sale', 'app.payment_type', 'app.sale_detail');

	function startTest() {
		$this->SalesPayment =& ClassRegistry::init('SalesPayment');
	}

	function endTest() {
		unset($this->SalesPayment);
		ClassRegistry::flush();
	}

}
