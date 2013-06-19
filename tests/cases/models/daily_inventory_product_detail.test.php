<?php
/* DailyInventoryProductDetail Test cases generated on: 2012-11-11 01:45:50 : 1352598350*/
App::import('Model', 'DailyInventoryProductDetail');

class DailyInventoryProductDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_inventory_product_detail', 'app.daily_inventory_product');

	function startTest() {
		$this->DailyInventoryProductDetail =& ClassRegistry::init('DailyInventoryProductDetail');
	}

	function endTest() {
		unset($this->DailyInventoryProductDetail);
		ClassRegistry::flush();
	}

}
