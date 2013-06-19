<?php
/* DailyMenus Test cases generated on: 2012-08-02 17:35:07 : 1343928907*/
App::import('Controller', 'DailyMenus');

class TestDailyMenusController extends DailyMenusController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DailyMenusControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_menu', 'app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->DailyMenus =& new TestDailyMenusController();
		$this->DailyMenus->constructClasses();
	}

	function endTest() {
		unset($this->DailyMenus);
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
