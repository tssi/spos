<?php
/* MenuItem Test cases generated on: 2012-08-30 17:22:47 : 1346347367*/
App::import('Model', 'MenuItem');

class MenuItemTestCase extends CakeTestCase {
	var $fixtures = array('app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product', 'app.daily_menu');

	function startTest() {
		$this->MenuItem =& ClassRegistry::init('MenuItem');
	}

	function endTest() {
		unset($this->MenuItem);
		ClassRegistry::flush();
	}

}
