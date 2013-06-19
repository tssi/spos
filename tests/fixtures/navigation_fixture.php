<?php
/* Navigation Fixture generated on: 2012-07-29 13:51:46 : 1343562706 */
class NavigationFixture extends CakeTestFixture {
	var $name = 'Navigation';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'link' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'root_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 8),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 8),
		'level' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 8),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'rght' => array('column' => array('root_id', 'rght', 'lft'), 'unique' => 0), 'lft' => array('column' => array('root_id', 'lft', 'rght'), 'unique' => 0), 'parent_id' => array('column' => array('parent_id', 'created'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'link' => 'Lorem ipsum dolor sit a',
			'created' => '2012-07-29 13:51:46',
			'modified' => '2012-07-29 13:51:46',
			'parent_id' => 1,
			'root_id' => 1,
			'lft' => 1,
			'rght' => 1,
			'level' => 1
		),
	);
}
