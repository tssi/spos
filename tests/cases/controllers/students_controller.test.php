<?php
/* Students Test cases generated on: 2012-12-28 08:54:58 : 1356684898*/
App::import('Controller', 'Students');

class TestStudentsController extends StudentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StudentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.student');

	function startTest() {
		$this->Students =& new TestStudentsController();
		$this->Students->constructClasses();
	}

	function endTest() {
		unset($this->Students);
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
