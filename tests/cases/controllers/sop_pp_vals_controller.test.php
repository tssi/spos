<?php
/* SopPpVals Test cases generated on: 2013-01-16 06:58:49 : 1358319529*/
App::import('Controller', 'SopPpVals');

class TestSopPpValsController extends SopPpValsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SopPpValsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sop_pp_val', 'app.prepaid201', 'app.sop_pp_tran');

	function startTest() {
		$this->SopPpVals =& new TestSopPpValsController();
		$this->SopPpVals->constructClasses();
	}

	function endTest() {
		unset($this->SopPpVals);
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
