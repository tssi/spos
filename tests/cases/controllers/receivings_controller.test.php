<?php
/* Receivings Test cases generated on: 2012-09-27 01:23:53 : 1348709033*/
App::import('Controller', 'Receivings');

class TestReceivingsController extends ReceivingsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ReceivingsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving', 'app.doc_type', 'app.vendor', 'app.receiving_detail', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->Receivings =& new TestReceivingsController();
		$this->Receivings->constructClasses();
	}

	function endTest() {
		unset($this->Receivings);
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
