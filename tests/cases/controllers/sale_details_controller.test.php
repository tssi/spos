<?php
/* SaleDetails Test cases generated on: 2012-08-10 05:41:39 : 1344570099*/
App::import('Controller', 'SaleDetails');

class TestSaleDetailsController extends SaleDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SaleDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sale_detail', 'app.sale', 'app.payment_type');

	function startTest() {
		$this->SaleDetails =& new TestSaleDetailsController();
		$this->SaleDetails->constructClasses();
	}

	function endTest() {
		unset($this->SaleDetails);
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
