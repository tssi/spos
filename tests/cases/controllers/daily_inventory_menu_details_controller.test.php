<?php
/* DailyInventoryMenuDetails Test cases generated on: 2012-11-11 01:51:27 : 1352598687*/
App::import('Controller', 'DailyInventoryMenuDetails');

class TestDailyInventoryMenuDetailsController extends DailyInventoryMenuDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DailyInventoryMenuDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_inventory_menu_detail', 'app.daily_inventory_menu');

	function startTest() {
		$this->DailyInventoryMenuDetails =& new TestDailyInventoryMenuDetailsController();
		$this->DailyInventoryMenuDetails->constructClasses();
	}

	function endTest() {
		unset($this->DailyInventoryMenuDetails);
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
