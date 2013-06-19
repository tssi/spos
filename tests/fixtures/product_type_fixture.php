<?php
/* ProductType Fixture generated on: 2012-07-29 17:06:54 : 1343574414 */
class ProductTypeFixture extends CakeTestFixture {
	var $name = 'ProductType';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'is_consumable' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'is_perishable' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'is_shelf' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => '',
			'name' => 'Lorem ipsum dolor sit amet',
			'alias' => 'Lor',
			'is_consumable' => 1,
			'is_perishable' => 1,
			'is_shelf' => 1,
			'created' => '2012-07-29 17:06:54',
			'modified' => '2012-07-29 17:06:54'
		),
	);
}
