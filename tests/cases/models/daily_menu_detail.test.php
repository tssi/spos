<?php
/* DailyMenuDetail Test cases generated on: 2012-08-01 23:51:26 : 1343865086*/
App::import('Model', 'DailyMenuDetail');

class DailyMenuDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_menu_detail', 'app.daily_menu', 'app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->DailyMenuDetail =& ClassRegistry::init('DailyMenuDetail');
	}

	function endTest() {
		unset($this->DailyMenuDetail);
		ClassRegistry::flush();
	}

}
