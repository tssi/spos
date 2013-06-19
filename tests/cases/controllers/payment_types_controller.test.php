<?php
/* PaymentTypes Test cases generated on: 2012-12-13 01:18:02 : 1355361482*/
App::import('Controller', 'PaymentTypes');

class TestPaymentTypesController extends PaymentTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PaymentTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.payment_type', 'app.sale', 'app.sale_detail');

	function startTest() {
		$this->PaymentTypes =& new TestPaymentTypesController();
		$this->PaymentTypes->constructClasses();
	}

	function endTest() {
		unset($this->PaymentTypes);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
