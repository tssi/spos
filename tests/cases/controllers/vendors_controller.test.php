<?php
/* Vendors Test cases generated on: 2012-09-14 08:45:26 : 1347612326*/
App::import('Controller', 'Vendors');

class TestVendorsController extends VendorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class VendorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor', 'app.receiving', 'app.receiving_detail', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->Vendors =& new TestVendorsController();
		$this->Vendors->constructClasses();
	}

	function endTest() {
		unset($this->Vendors);
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
