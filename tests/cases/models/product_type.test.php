<?php
/* ProductType Test cases generated on: 2012-07-29 17:06:54 : 1343574414*/
App::import('Model', 'ProductType');

class ProductTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.product_type', 'app.perishable', 'app.unit', 'app.product');

	function startTest() {
		$this->ProductType =& ClassRegistry::init('ProductType');
	}

	function endTest() {
		unset($this->ProductType);
		ClassRegistry::flush();
	}

}
