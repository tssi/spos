<?php
/* Product Test cases generated on: 2012-09-21 08:54:41 : 1348217681*/
App::import('Model', 'Product');

class ProductTestCase extends CakeTestCase {
	var $fixtures = array('app.product', 'app.product_type', 'app.perishable', 'app.unit');

	function startTest() {
		$this->Product =& ClassRegistry::init('Product');
	}

	function endTest() {
		unset($this->Product);
		ClassRegistry::flush();
	}

}
