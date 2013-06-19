<?php
/* DailyInventoryProduct Test cases generated on: 2012-11-11 01:45:38 : 1352598338*/
App::import('Model', 'DailyInventoryProduct');

class DailyInventoryProductTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_inventory_product', 'app.daily_inventory_product_detail');

	function startTest() {
		$this->DailyInventoryProduct =& ClassRegistry::init('DailyInventoryProduct');
	}

	function endTest() {
		unset($this->DailyInventoryProduct);
		ClassRegistry::flush();
	}

}
