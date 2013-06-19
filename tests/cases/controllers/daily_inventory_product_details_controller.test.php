<?php
/* DailyInventoryProductDetails Test cases generated on: 2012-11-11 01:51:41 : 1352598701*/
App::import('Controller', 'DailyInventoryProductDetails');

class TestDailyInventoryProductDetailsController extends DailyInventoryProductDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DailyInventoryProductDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_inventory_product_detail', 'app.daily_inventory_product');

	function startTest() {
		$this->DailyInventoryProductDetails =& new TestDailyInventoryProductDetailsController();
		$this->DailyInventoryProductDetails->constructClasses();
	}

	function endTest() {
		unset($this->DailyInventoryProductDetails);
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
