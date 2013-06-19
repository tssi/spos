<?php
/* DailyInventoryMenuDetail Test cases generated on: 2012-11-11 01:39:33 : 1352597973*/
App::import('Model', 'DailyInventoryMenuDetail');

class DailyInventoryMenuDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_inventory_menu_detail', 'app.daily_inventory_menu');

	function startTest() {
		$this->DailyInventoryMenuDetail =& ClassRegistry::init('DailyInventoryMenuDetail');
	}

	function endTest() {
		unset($this->DailyInventoryMenuDetail);
		ClassRegistry::flush();
	}

}
