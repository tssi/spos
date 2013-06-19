<?php
/* SystemsDefaults Test cases generated on: 2012-05-31 08:12:16 : 1338444736*/
App::import('Controller', 'SystemsDefaults');

class TestSystemsDefaultsController extends SystemsDefaultsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SystemsDefaultsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.systems_default');

	function startTest() {
		$this->SystemsDefaults =& new TestSystemsDefaultsController();
		$this->SystemsDefaults->constructClasses();
	}

	function endTest() {
		unset($this->SystemsDefaults);
		ClassRegistry::flush();
	}

}
