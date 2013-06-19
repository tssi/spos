<?php
/* Endings Test cases generated on: 2012-11-20 03:57:56 : 1353383876*/
App::import('Controller', 'Endings');

class TestEndingsController extends EndingsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EndingsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.ending', 'app.ending_detail');

	function startTest() {
		$this->Endings =& new TestEndingsController();
		$this->Endings->constructClasses();
	}

	function endTest() {
		unset($this->Endings);
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
