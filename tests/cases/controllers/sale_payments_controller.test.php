<?php
/* SalePayments Test cases generated on: 2012-12-20 03:43:36 : 1355971416*/
App::import('Controller', 'SalePayments');

class TestSalePaymentsController extends SalePaymentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SalePaymentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sale_payment', 'app.sale', 'app.sale_detail', 'app.payment_type');

	function startTest() {
		$this->SalePayments =& new TestSalePaymentsController();
		$this->SalePayments->constructClasses();
	}

	function endTest() {
		unset($this->SalePayments);
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
