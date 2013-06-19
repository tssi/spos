<?php
class PaymentType extends AppModel {
	var $name = 'PaymentType';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Sale' => array(
			'className' => 'Sale',
			'foreignKey' => 'payment_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
