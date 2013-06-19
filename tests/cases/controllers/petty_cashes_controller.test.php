<?php
/* PettyCashes Test cases generated on: 2012-09-21 01:03:26 : 1348189406*/
App::import('Controller', 'PettyCashes');

class TestPettyCashesController extends PettyCashesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PettyCashesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.petty_cash');

	function startTest() {
		$this->PettyCashes =& new TestPettyCashesController();
		$this->PettyCashes->constructClasses();
	}

	function endTest() {
		unset($this->PettyCashes);
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
