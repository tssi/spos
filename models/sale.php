<?php
class Sale extends AppModel {
	var $name = 'Sale';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'SaleDetail' => array(
			'className' => 'SaleDetail',
			'foreignKey' => 'sale_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SalePayment' => array(
			'className' => 'SalePayment',
			'foreignKey' => 'sale_id',
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
