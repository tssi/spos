<?php
/* MenuIngredientDetail Test cases generated on: 2012-11-24 13:30:12 : 1353760212*/
App::import('Model', 'MenuIngredientDetail');

class MenuIngredientDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.menu_ingredient_detail', 'app.menu_ingredient', 'app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product', 'app.daily_menu');

	function startTest() {
		$this->MenuIngredientDetail =& ClassRegistry::init('MenuIngredientDetail');
	}

	function endTest() {
		unset($this->MenuIngredientDetail);
		ClassRegistry::flush();
	}

}
