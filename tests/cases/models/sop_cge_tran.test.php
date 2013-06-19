<?php
/* SopCgeTran Test cases generated on: 2013-01-04 02:29:40 : 1357266580*/
App::import('Model', 'SopCgeTran');

class SopCgeTranTestCase extends CakeTestCase {
	var $fixtures = array('app.sop_cge_tran', 'app.charge201');

	function startTest() {
		$this->SopCgeTran =& ClassRegistry::init('SopCgeTran');
	}

	function endTest() {
		unset($this->SopCgeTran);
		ClassRegistry::flush();
	}

}
