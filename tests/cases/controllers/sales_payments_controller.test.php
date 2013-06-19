<?php
/* SalesPayments Test cases generated on: 2012-12-18 08:12:00 : 1355818320*/
App::import('Controller', 'SalesPayments');

class TestSalesPaymentsController extends SalesPaymentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SalesPaymentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sales_payment', 'app.sale', 'app.payment_type', 'app.sale_detail');

	function startTest() {
		$this->SalesPayments =& new TestSalesPaymentsController();
		$this->SalesPayments->constructClasses();
	}

	function endTest() {
		unset($this->SalesPayments);
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
