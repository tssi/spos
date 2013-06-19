<?php
/* Sale Test cases generated on: 2013-01-04 10:06:35 : 1357293995*/
App::import('Model', 'Sale');

class SaleTestCase extends CakeTestCase {
	var $fixtures = array('app.sale', 'app.sale_detail', 'app.sale_payment', 'app.payment_type');

	function startTest() {
		$this->Sale =& ClassRegistry::init('Sale');
	}

	function endTest() {
		unset($this->Sale);
		ClassRegistry::flush();
	}

}
