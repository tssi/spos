<?php
/* Prepaid201 Fixture generated on: 2013-01-15 08:33:46 : 1358238826 */
class Prepaid201Fixture extends CakeTestFixture {
	var $name = 'Prepaid201';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'reference' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'employee id or student id'),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => NULL, 'comment' => 'if still active or not active'),
		'category' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_general_ci', 'comment' => 'S= Student, E= Employee', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
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
