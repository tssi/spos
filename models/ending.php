<?php
class Ending extends AppModel {
	var $name = 'Ending';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'EndingDetail' => array(
			'className' => 'EndingDetail',
			'foreignKey' => 'ending_id',
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
