<?php
/* Counters Test cases generated on: 2012-08-03 18:37:38 : 1344019058*/
App::import('Controller', 'Counters');

class TestCountersController extends CountersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CountersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.counter');

	function startTest() {
		$this->Counters =& new TestCountersController();
		$this->Counters->constructClasses();
	}

	function endTest() {
		unset($this->Counters);
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
