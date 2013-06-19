<?php
/* Prepaid201s Test cases generated on: 2013-01-15 08:35:05 : 1358238905*/
App::import('Controller', 'Prepaid201s');

class TestPrepaid201sController extends Prepaid201sController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class Prepaid201sControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.prepaid201', 'app.sop_pp_tran', 'app.sop_pp_val');

	function startTest() {
		$this->Prepaid201s =& new TestPrepaid201sController();
		$this->Prepaid201s->constructClasses();
	}

	function endTest() {
		unset($this->Prepaid201s);
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
