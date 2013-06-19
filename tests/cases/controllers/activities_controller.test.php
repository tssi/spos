<?php
/* Activities Test cases generated on: 2012-07-27 02:38:58 : 1343349538*/
App::import('Controller', 'Activities');

class TestActivitiesController extends ActivitiesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ActivitiesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.activity');

	function startTest() {
		$this->Activities =& new TestActivitiesController();
		$this->Activities->constructClasses();
	}

	function endTest() {
		unset($this->Activities);
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
