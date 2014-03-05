<?php
/* EndingReconciliationDetails Test cases generated on: 2014-03-05 10:00:21 : 1393984821*/
App::import('Controller', 'EndingReconciliationDetails');

class TestEndingReconciliationDetailsController extends EndingReconciliationDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EndingReconciliationDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.ending_reconciliation_detail', 'app.ending_reconciliation');

	function startTest() {
		$this->EndingReconciliationDetails =& new TestEndingReconciliationDetailsController();
		$this->EndingReconciliationDetails->constructClasses();
	}

	function endTest() {
		unset($this->EndingReconciliationDetails);
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
