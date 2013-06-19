<?php
/* SopCgeTrans Test cases generated on: 2012-12-17 05:25:09 : 1355721909*/
App::import('Controller', 'SopCgeTrans');

class TestSopCgeTransController extends SopCgeTransController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SopCgeTransControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sop_cge_tran');

	function startTest() {
		$this->SopCgeTrans =& new TestSopCgeTransController();
		$this->SopCgeTrans->constructClasses();
	}

	function endTest() {
		unset($this->SopCgeTrans);
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
