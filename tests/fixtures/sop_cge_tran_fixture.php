<?php
/* SopCgeTran Fixture generated on: 2013-01-04 02:29:40 : 1357266580 */
class SopCgeTranFixture extends CakeTestFixture {
	var $name = 'SopCgeTran';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'charge201_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'doc_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'amount' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'flag' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'charge201_id' => 1,
			'doc_number' => 'Lorem',
			'amount' => 1,
			'flag' => 1,
			'created' => '2013-01-04 02:29:40'
		),
	);
}
