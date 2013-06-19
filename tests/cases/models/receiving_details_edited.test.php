<?php
/* ReceivingDetailsEdited Test cases generated on: 2012-11-16 02:17:36 : 1353032256*/
App::import('Model', 'ReceivingDetailsEdited');

class ReceivingDetailsEditedTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving_details_edited', 'app.receiving', 'app.doc_type', 'app.vendor', 'app.receiving_detail', 'app.unit', 'app.perishable', 'app.product_type', 'app.product');

	function startTest() {
		$this->ReceivingDetailsEdited =& ClassRegistry::init('ReceivingDetailsEdited');
	}

	function endTest() {
		unset($this->ReceivingDetailsEdited);
		ClassRegistry::flush();
	}

}
