<?php
/* DailyMenu Test cases generated on: 2012-08-02 17:37:50 : 1343929070*/
App::import('Model', 'DailyMenu');

class DailyMenuTestCase extends CakeTestCase {
	var $fixtures = array('app.daily_menu', 'app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->DailyMenu =& ClassRegistry::init('DailyMenu');
	}

	function endTest() {
		unset($this->DailyMenu);
		ClassRegistry::flush();
	}

}
