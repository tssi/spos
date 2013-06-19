<?php
/* ProductTypes Test cases generated on: 2012-07-27 02:57:48 : 1343350668*/
App::import('Controller', 'ProductTypes');

class TestProductTypesController extends ProductTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_type', 'app.product', 'app.unit');

	function startTest() {
		$this->ProductTypes =& new TestProductTypesController();
		$this->ProductTypes->constructClasses();
	}

	function endTest() {
		unset($this->ProductTypes);
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
