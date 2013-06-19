<?php
/* EndingReconciliations Test cases generated on: 2012-11-23 02:55:08 : 1353639308*/
App::import('Controller', 'EndingReconciliations');

class TestEndingReconciliationsController extends EndingReconciliationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EndingReconciliationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.ending_reconciliation', 'app.product', 'app.product_type', 'app.perishable', 'app.unit');

	function startTest() {
		$this->EndingReconciliations =& new TestEndingReconciliationsController();
		$this->EndingReconciliations->constructClasses();
	}

	function endTest() {
		unset($this->EndingReconciliations);
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
