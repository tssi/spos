<?php
/* DailyMenuDetails Test cases generated on: 2012-08-01 23:43:15 : 1343864595*/
App::import('Controller', 'DailyMenuDetails');

class TestDailyMenuDetailsController extends DailyMenuDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DailyMenuDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_menu_detail', 'app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->DailyMenuDetails =& new TestDailyMenuDetailsController();
		$this->DailyMenuDetails->constructClasses();
	}

	function endTest() {
		unset($this->DailyMenuDetails);
		ClassRegistry::flush();
	}

}
