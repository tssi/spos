<?php
/* EndingDetail Test cases generated on: 2012-11-20 03:58:12 : 1353383892*/
App::import('Model', 'EndingDetail');

class EndingDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.ending_detail', 'app.ending');

	function startTest() {
		$this->EndingDetail =& ClassRegistry::init('EndingDetail');
	}

	function endTest() {
		unset($this->EndingDetail);
		ClassRegistry::flush();
	}

}
