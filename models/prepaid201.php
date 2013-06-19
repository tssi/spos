<?php
class Prepaid201 extends AppModel {
	var $name = 'Prepaid201';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'SopPpTran' => array(
			'className' => 'SopPpTran',
			'foreignKey' => 'prepaid201_id',
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
		'SopPpVal' => array(
			'className' => 'SopPpVal',
			'foreignKey' => 'prepaid201_id',
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
