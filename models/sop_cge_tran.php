<?php
class SopCgeTran extends AppModel {
	var $name = 'SopCgeTran';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Charge201' => array(
			'className' => 'Charge201',
			'foreignKey' => 'charge201_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
