<?php
/* PaymentType Test cases generated on: 2012-12-13 01:18:00 : 1355361480*/
App::import('Model', 'PaymentType');

class PaymentTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.payment_type', 'app.sale', 'app.sale_detail');

	function startTest() {
		$this->PaymentType =& ClassRegistry::init('PaymentType');
	}

	function endTest() {
		unset($this->PaymentType);
		ClassRegistry::flush();
	}

}
