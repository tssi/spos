<?php
/* SaleDetail Fixture generated on: 2012-08-03 05:09:42 : 1343963382 */
class SaleDetailFixture extends CakeTestFixture {
	var $name = 'SaleDetail';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'sale_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'item_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'qty' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'amount' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '5,2'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'sale_id' => 1,
			'item_code' => 'Lorem ipsum d',
			'qty' => 1,
			'amount' => 1,
			'created' => '2012-08-03 05:09:42'
		),
	);
}
