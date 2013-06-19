<?php
/* SystemsDefault Test cases generated on: 2012-07-29 13:51:55 : 1343562715*/
App::import('Model', 'SystemsDefault');

class SystemsDefaultTestCase extends CakeTestCase {
	var $fixtures = array('app.systems_default');

	function startTest() {
		$this->SystemsDefault =& ClassRegistry::init('SystemsDefault');
	}

	function endTest() {
		unset($this->SystemsDefault);
		ClassRegistry::flush();
	}

}
