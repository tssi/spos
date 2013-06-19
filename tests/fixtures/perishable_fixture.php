<?php
/* Perishable Fixture generated on: 2012-07-30 19:21:45 : 1343676105 */
class PerishableFixture extends CakeTestFixture {
	var $name = 'Perishable';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'product_type_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'item_code' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'unit_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'selling_price' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '5,2'),
		'avg_price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '5,2'),
		'is_consumable' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'product_type_id' => '',
			'item_code' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'unit_id' => 1,
			'qty' => 1,
			'selling_price' => 1,
			'avg_price' => 1,
			'is_consumable' => 1,
			'created' => '2012-07-30 19:21:45',
			'modified' => '2012-07-30 19:21:45'
		),
	);
}
