<?php
/* ReceivingDetails Test cases generated on: 2012-09-25 07:49:19 : 1348559359*/
App::import('Controller', 'ReceivingDetails');

class TestReceivingDetailsController extends ReceivingDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ReceivingDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving_detail', 'app.receiving', 'app.vendor', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->ReceivingDetails =& new TestReceivingDetailsController();
		$this->ReceivingDetails->constructClasses();
	}

	function endTest() {
		unset($this->ReceivingDetails);
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
