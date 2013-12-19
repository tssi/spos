<?php
/* DailyBeginningInventory Test cases generated on: 2013-12-09 13:19:36 : 1386566376*/
App::import('Model', 'DailyBeginningInventory');

class DailyBeginningInventoryTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_beginning_inventory');

	function startTest() {
		$this->DailyBeginningInventory =& ClassRegistry::init('DailyBeginningInventory');
	}

	function endTest() {
		unset($this->DailyBeginningInventory);
		ClassRegistry::flush();
	}

}
