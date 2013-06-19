<?php
/* Units Test cases generated on: 2012-07-27 03:07:54 : 1343351274*/
App::import('Controller', 'Units');

class TestUnitsController extends UnitsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UnitsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.unit', 'app.product', 'app.product_type');

	function startTest() {
		$this->Units =& new TestUnitsController();
		$this->Units->constructClasses();
	}

	function endTest() {
		unset($this->Units);
		ClassRegistry::flush();
	}

}
