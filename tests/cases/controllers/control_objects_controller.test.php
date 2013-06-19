<?php
/* ControlObjects Test cases generated on: 2012-07-27 02:38:58 : 1343349538*/
App::import('Controller', 'ControlObjects');

class TestControlObjectsController extends ControlObjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ControlObjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.control_object', 'app.group', 'app.role', 'app.user', 'app.request_object');

	function startTest() {
		$this->ControlObjects =& new TestControlObjectsController();
		$this->ControlObjects->constructClasses();
	}

	function endTest() {
		unset($this->ControlObjects);
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
