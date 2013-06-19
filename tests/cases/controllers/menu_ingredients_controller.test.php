<?php
/* MenuIngredients Test cases generated on: 2012-11-24 13:29:19 : 1353760159*/
App::import('Controller', 'MenuIngredients');

class TestMenuIngredientsController extends MenuIngredientsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MenuIngredientsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.menu_ingredient', 'app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product', 'app.daily_menu', 'app.menu_ingredient_detail');

	function startTest() {
		$this->MenuIngredients =& new TestMenuIngredientsController();
		$this->MenuIngredients->constructClasses();
	}

	function endTest() {
		unset($this->MenuIngredients);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
