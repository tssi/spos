<?php
/* SalesPayment Fixture generated on: 2012-12-18 08:11:52 : 1355818312 */
class SalesPaymentFixture extends CakeTestFixture {
	var $name = 'SalesPayment';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'primary'),
		'sale_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'payment_type_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'sale_id' => 1,
			'payment_type_id' => 1,
			'created' => '2012-12-18 08:11:52'
		),
	);
}
