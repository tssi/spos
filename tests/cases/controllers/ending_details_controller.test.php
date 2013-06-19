<?php
/* EndingDetails Test cases generated on: 2012-11-20 03:58:15 : 1353383895*/
App::import('Controller', 'EndingDetails');

class TestEndingDetailsController extends EndingDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EndingDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.ending_detail', 'app.ending');

	function startTest() {
		$this->EndingDetails =& new TestEndingDetailsController();
		$this->EndingDetails->constructClasses();
	}

	function endTest() {
		unset($this->EndingDetails);
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
