<?php
/* SopPpVal Fixture generated on: 2013-01-15 08:32:42 : 1358238762 */
class SopPpValFixture extends CakeTestFixture {
	var $name = 'SopPpVal';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'prepaid201_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'amount_balance' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'prepaid201_id' => 1,
			'amount_balance' => 1,
			'created' => '2013-01-15 08:32:42',
			'modified' => '2013-01-15 08:32:42'
		),
	);
}
