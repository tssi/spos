<?php
/* Sales Test cases generated on: 2012-08-10 08:37:37 : 1344580657*/
App::import('Controller', 'Sales');

class TestSalesController extends SalesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SalesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sale', 'app.payment_type', 'app.sale_detail');

	function startTest() {
		$this->Sales =& new TestSalesController();
		$this->Sales->constructClasses();
	}

	function endTest() {
		unset($this->Sales);
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
