<?php
/* MenuIngredientDetails Test cases generated on: 2012-11-24 13:30:14 : 1353760214*/
App::import('Controller', 'MenuIngredientDetails');

class TestMenuIngredientDetailsController extends MenuIngredientDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MenuIngredientDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.menu_ingredient_detail', 'app.menu_ingredient', 'app.menu_item', 'app.unit', 'app.perishable', 'app.product_type', 'app.product', 'app.daily_menu');

	function startTest() {
		$this->MenuIngredientDetails =& new TestMenuIngredientDetailsController();
		$this->MenuIngredientDetails->constructClasses();
	}

	function endTest() {
		unset($this->MenuIngredientDetails);
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
