<?php
/* ReceivingDetailsEditeds Test cases generated on: 2012-11-16 02:14:09 : 1353032049*/
App::import('Controller', 'ReceivingDetailsEditeds');

class TestReceivingDetailsEditedsController extends ReceivingDetailsEditedsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ReceivingDetailsEditedsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving_details_edited', 'app.receiving', 'app.doc_type', 'app.vendor', 'app.receiving_detail', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->ReceivingDetailsEditeds =& new TestReceivingDetailsEditedsController();
		$this->ReceivingDetailsEditeds->constructClasses();
	}

	function endTest() {
		unset($this->ReceivingDetailsEditeds);
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
