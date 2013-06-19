<?php
/* Advances Test cases generated on: 2012-09-19 06:16:05 : 1348035365*/
App::import('Controller', 'Advances');

class TestAdvancesController extends AdvancesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AdvancesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.advance');

	function startTest() {
		$this->Advances =& new TestAdvancesController();
		$this->Advances->constructClasses();
	}

	function endTest() {
		unset($this->Advances);
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
