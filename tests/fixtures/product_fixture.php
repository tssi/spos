<?php
/* Product Fixture generated on: 2012-09-21 08:54:41 : 1348217681 */
class ProductFixture extends CakeTestFixture {
	var $name = 'Product';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'product_type_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'item_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 13, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'unit_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'qty' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'selling_price' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'avg_price' => array('type' => 'float', 'null' => true, 'default' => NULL),
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
			'item_code' => 'Lorem ipsum',
			'name' => 'Lorem ipsum dolor sit amet',
			'unit_id' => 1,
			'qty' => 1,
			'selling_price' => 1,
			'avg_price' => 1,
			'is_consumable' => 1,
			'created' => '2012-09-21 08:54:41',
			'modified' => '2012-09-21 08:54:41'
		),
	);
}
