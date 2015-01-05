<?php
class Charge201 extends AppModel {
	var $name = 'Charge201';
	
	var $virtualFields = array('str_category'=>"CASE category
											WHEN 'E' THEN 'Employee'
											WHEN 'S' THEN 'Student'
										END ");

	
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
	
	var $belongsTo = array(
		'Employee' => array(
			'className' => 'Employee',
			'foreignKey' => 'reference',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'reference',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

}
