<?php
class ReceivingDetailsEdited extends AppModel {
	var $name = 'ReceivingDetailsEdited';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Receiving' => array(
			'className' => 'Receiving',
			'foreignKey' => 'receiving_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ReceivingDetail' => array(
			'className' => 'ReceivingDetail',
			'foreignKey' => 'receiving_detail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
