<?php
/* ControlObject Fixture generated on: 2012-09-19 03:07:23 : 1348024043 */
class ControlObjectFixture extends CakeTestFixture {
	var $name = 'ControlObject';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'request_object_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'action' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'group_id' => 1,
			'request_object_id' => 1,
			'action' => 'Lorem ipsum dolor sit amet'
		),
	);
}
