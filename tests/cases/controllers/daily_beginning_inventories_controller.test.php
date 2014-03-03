<?php
/* DailyBeginningInventories Test cases generated on: 2013-12-09 13:21:07 : 1386566467*/
App::import('Controller', 'DailyBeginningInventories');

class TestDailyBeginningInventoriesController extends DailyBeginningInventoriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DailyBeginningInventoriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_beginning_inventory');

	function startTest() {
		$this->DailyBeginningInventories =& new TestDailyBeginningInventoriesController();
		$this->DailyBeginningInventories->constructClasses();
	}

	function endTest() {
		unset($this->DailyBeginningInventories);
		ClassRegistry::flush();
	}

}
