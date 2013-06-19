<?php
/* EndingReconciliation Test cases generated on: 2012-11-28 06:09:48 : 1354082988*/
App::import('Model', 'EndingReconciliation');

class EndingReconciliationTestCase extends CakeTestCase {
	var $fixtures = array('app.ending_reconciliation', 'app.ending_reconciliation_detail');

	function startTest() {
		$this->EndingReconciliation =& ClassRegistry::init('EndingReconciliation');
	}

	function endTest() {
		unset($this->EndingReconciliation);
		ClassRegistry::flush();
	}

}
