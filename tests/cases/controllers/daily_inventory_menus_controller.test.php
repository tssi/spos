<?php
/* DailyInventoryMenus Test cases generated on: 2012-11-11 01:42:45 : 1352598165*/
App::import('Controller', 'DailyInventoryMenus');

class TestDailyInventoryMenusController extends DailyInventoryMenusController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DailyInventoryMenusControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_inventory_menu', 'app.daily_inventory_menu_detail');

	function startTest() {
		$this->DailyInventoryMenus =& new TestDailyInventoryMenusController();
		$this->DailyInventoryMenus->constructClasses();
	}

	function endTest() {
		unset($this->DailyInventoryMenus);
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
