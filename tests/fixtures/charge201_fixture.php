<?php
/* Charge201 Fixture generated on: 2013-01-04 02:31:23 : 1357266683 */
class Charge201Fixture extends CakeTestFixture {
	var $name = 'Charge201';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'reference' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'category' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'reference' => 1,
			'status' => 1,
			'category' => 'Lorem ipsum dolor sit ame'
		),
	);
}
