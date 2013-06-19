<?php
/* EndingReconciliationDetail Test cases generated on: 2012-11-28 06:11:02 : 1354083062*/
App::import('Model', 'EndingReconciliationDetail');

class EndingReconciliationDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.ending_reconciliation_detail', 'app.ending_reconciliation');

	function startTest() {
		$this->EndingReconciliationDetail =& ClassRegistry::init('EndingReconciliationDetail');
	}

	function endTest() {
		unset($this->EndingReconciliationDetail);
		ClassRegistry::flush();
	}

}
