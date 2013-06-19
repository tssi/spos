<?php
/* Charge201s Test cases generated on: 2012-12-28 05:42:33 : 1356673353*/
App::import('Controller', 'Charge201s');

class TestCharge201sController extends Charge201sController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class Charge201sControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.charge201');

	function startTest() {
		$this->Charge201s =& new TestCharge201sController();
		$this->Charge201s->constructClasses();
	}

	function endTest() {
		unset($this->Charge201s);
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
