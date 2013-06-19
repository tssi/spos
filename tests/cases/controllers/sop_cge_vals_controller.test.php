<?php
/* SopCgeVals Test cases generated on: 2012-12-17 08:18:35 : 1355732315*/
App::import('Controller', 'SopCgeVals');

class TestSopCgeValsController extends SopCgeValsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SopCgeValsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sop_cge_val');

	function startTest() {
		$this->SopCgeVals =& new TestSopCgeValsController();
		$this->SopCgeVals->constructClasses();
	}

	function endTest() {
		unset($this->SopCgeVals);
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
