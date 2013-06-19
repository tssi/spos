<?php
class Receiving extends AppModel {
	var $name = 'Receiving';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'DocType' => array(
			'className' => 'DocType',
			'foreignKey' => 'doc_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Vendor' => array(
			'className' => 'Vendor',
			'foreignKey' => 'vendor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ReceivingDetail' => array(
			'className' => 'ReceivingDetail',
			'foreignKey' => 'receiving_id',
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
