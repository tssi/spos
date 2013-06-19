<?php
/* Sale Fixture generated on: 2013-01-04 10:08:08 : 1357294088 */
class SaleFixture extends CakeTestFixture {
	var $name = 'Sale';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'buyer' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'amount_received' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'total' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'cashier' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'buyer' => 'Lorem ipsum dolor sit amet',
			'amount_received' => 1,
			'total' => 1,
			'cashier' => 1,
			'created' => '2013-01-04 10:08:08'
		),
	);
}
