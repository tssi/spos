<?php
/* SopPpVal Test cases generated on: 2013-01-15 08:32:42 : 1358238762*/
App::import('Model', 'SopPpVal');

class SopPpValTestCase extends CakeTestCase {
	var $fixtures = array('app.sop_pp_val', 'app.prepaid201');

	function startTest() {
		$this->SopPpVal =& ClassRegistry::init('SopPpVal');
	}

	function endTest() {
		unset($this->SopPpVal);
		ClassRegistry::flush();
	}

}
