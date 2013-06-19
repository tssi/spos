<?php
/* Perishables Test cases generated on: 2012-07-29 13:17:55 : 1343560675*/
App::import('Controller', 'Perishables');

class TestPerishablesController extends PerishablesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PerishablesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.perishable', 'app.product_type', 'app.product', 'app.unit');

	function startTest() {
		$this->Perishables =& new TestPerishablesController();
		$this->Perishables->constructClasses();
	}

	function endTest() {
		unset($this->Perishables);
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
