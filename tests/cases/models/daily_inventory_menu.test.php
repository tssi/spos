<?php
/* DailyInventoryMenu Test cases generated on: 2012-11-11 01:39:05 : 1352597945*/
App::import('Model', 'DailyInventoryMenu');

class DailyInventoryMenuTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_inventory_menu', 'app.daily_inventory_menu_detail');

	function startTest() {
		$this->DailyInventoryMenu =& ClassRegistry::init('DailyInventoryMenu');
	}

	function endTest() {
		unset($this->DailyInventoryMenu);
		ClassRegistry::flush();
	}

}
