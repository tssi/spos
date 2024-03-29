<?php
class Charge201 extends AppModel {
	var $name = 'Charge201';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'SopCgeTran' => array(
			'className' => 'SopCgeTran',
			'foreignKey' => 'charge201_id',
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
		'SopCgeVal' => array(
			'className' => 'SopCgeVal',
			'foreignKey' => 'charge201_id',
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
