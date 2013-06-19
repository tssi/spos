<?php
class SalePayment extends AppModel {
	var $name = 'SalePayment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Sale' => array(
			'className' => 'Sale',
			'foreignKey' => 'sale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PaymentType' => array(
			'className' => 'PaymentType',
			'foreignKey' => 'payment_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
