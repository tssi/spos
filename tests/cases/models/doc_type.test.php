<?php
/* DocType Test cases generated on: 2012-09-25 07:42:40 : 1348558960*/
App::import('Model', 'DocType');

class DocTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.doc_type');

	function startTest() {
		$this->DocType =& ClassRegistry::init('DocType');
	}

	function endTest() {
		unset($this->DocType);
		ClassRegistry::flush();
	}

}
