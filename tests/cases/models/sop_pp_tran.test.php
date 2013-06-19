<?php
/* SopPpTran Test cases generated on: 2013-01-15 08:28:39 : 1358238519*/
App::import('Model', 'SopPpTran');

class SopPpTranTestCase extends CakeTestCase {
	var $fixtures = array('app.sop_pp_tran', 'app.prepaid201');

	function startTest() {
		$this->SopPpTran =& ClassRegistry::init('SopPpTran');
	}

	function endTest() {
		unset($this->SopPpTran);
		ClassRegistry::flush();
	}

}
