<?php
/* SopCgeVal Fixture generated on: 2013-01-04 02:30:51 : 1357266651 */
class SopCgeValFixture extends CakeTestFixture {
	var $name = 'SopCgeVal';

	var $fields = array(
		'charge201_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'primary'),
		'amount_balance' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'charge201_id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'charge201_id' => 1,
			'amount_balance' => 1,
			'created' => '2013-01-04 02:30:51',
			'modified' => '2013-01-04 02:30:51'
		),
	);
}
