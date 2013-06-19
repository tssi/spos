<?php
/* SopCgeVal Test cases generated on: 2013-01-04 02:30:52 : 1357266652*/
App::import('Model', 'SopCgeVal');

class SopCgeValTestCase extends CakeTestCase {
	var $fixtures = array('app.sop_cge_val', 'app.charge201');

	function startTest() {
		$this->SopCgeVal =& ClassRegistry::init('SopCgeVal');
	}

	function endTest() {
		unset($this->SopCgeVal);
		ClassRegistry::flush();
	}

}
