<?php
/* DailyBeginningInventory Fixture generated on: 2013-12-09 13:19:36 : 1386566376 */
class DailyBeginningInventoryFixture extends CakeTestFixture {
	var $name = 'DailyBeginningInventory';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'item_code' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'qty' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '11,2'),
		'created' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'item_code' => 1,
			'qty' => 1,
			'created' => '2013-12-09'
		),
	);
}
