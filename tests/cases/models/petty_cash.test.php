<?php
/* PettyCash Test cases generated on: 2012-09-21 01:03:25 : 1348189405*/
App::import('Model', 'PettyCash');

class PettyCashTestCase extends CakeTestCase {
	var $fixtures = array('app.petty_cash');

	function startTest() {
		$this->PettyCash =& ClassRegistry::init('PettyCash');
	}

	function endTest() {
		unset($this->PettyCash);
		ClassRegistry::flush();
	}

}
