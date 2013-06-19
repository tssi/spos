<?php
/* SalePayment Fixture generated on: 2012-12-20 03:42:43 : 1355971363 */
class SalePaymentFixture extends CakeTestFixture {
	var $name = 'SalePayment';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'sale_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'payment_type_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'amount' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'sale_id' => 1,
			'payment_type_id' => 1,
			'amount' => 1,
			'created' => '2012-12-20 03:42:43'
		),
	);
}
