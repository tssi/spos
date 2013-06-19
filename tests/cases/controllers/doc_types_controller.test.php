<?php
/* DocTypes Test cases generated on: 2012-09-25 07:42:42 : 1348558962*/
App::import('Controller', 'DocTypes');

class TestDocTypesController extends DocTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DocTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.doc_type');

	function startTest() {
		$this->DocTypes =& new TestDocTypesController();
		$this->DocTypes->constructClasses();
	}

	function endTest() {
		unset($this->DocTypes);
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
