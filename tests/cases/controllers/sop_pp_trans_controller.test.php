<?php
/* SopPpTrans Test cases generated on: 2013-01-16 06:59:04 : 1358319544*/
App::import('Controller', 'SopPpTrans');

class TestSopPpTransController extends SopPpTransController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SopPpTransControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.sop_pp_tran', 'app.prepaid201', 'app.sop_pp_val');

	function startTest() {
		$this->SopPpTrans =& new TestSopPpTransController();
		$this->SopPpTrans->constructClasses();
	}

	function endTest() {
		unset($this->SopPpTrans);
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
