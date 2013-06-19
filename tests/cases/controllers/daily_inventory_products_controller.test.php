<?php
/* DailyInventoryProducts Test cases generated on: 2012-11-11 01:45:39 : 1352598339*/
App::import('Controller', 'DailyInventoryProducts');

class TestDailyInventoryProductsController extends DailyInventoryProductsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DailyInventoryProductsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_inventory_product', 'app.daily_inventory_product_detail');

	function startTest() {
		$this->DailyInventoryProducts =& new TestDailyInventoryProductsController();
		$this->DailyInventoryProducts->constructClasses();
	}

	function endTest() {
		unset($this->DailyInventoryProducts);
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
