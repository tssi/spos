<?php
/* MenuIngredient Test cases generated on: 2012-11-24 13:29:08 : 1353760148*/
App::import('Model', 'MenuIngredient');

class MenuIngredientTestCase extends CakeTestCase {
	var $fixtures = array('app.menu_ingredient', 'app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product', 'app.daily_menu', 'app.menu_ingredient_detail');

	function startTest() {
		$this->MenuIngredient =& ClassRegistry::init('MenuIngredient');
	}

	function endTest() {
		unset($this->MenuIngredient);
		ClassRegistry::flush();
	}

}
