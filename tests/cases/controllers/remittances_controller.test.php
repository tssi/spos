<?php
/* Remittances Test cases generated on: 2012-09-06 23:33:25 : 1346974405*/
App::import('Controller', 'Remittances');

class TestRemittancesController extends RemittancesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RemittancesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.remittance');

	function startTest() {
		$this->Remittances =& new TestRemittancesController();
		$this->Remittances->constructClasses();
	}

	function endTest() {
		unset($this->Remittances);
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
