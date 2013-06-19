<?php
class SopPpTran extends AppModel {
	var $name = 'SopPpTran';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Prepaid201' => array(
			'className' => 'Prepaid201',
			'foreignKey' => 'prepaid201_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
