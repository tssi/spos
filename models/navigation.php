<?php
class Navigation extends AppModel {
	var $name = 'Navigation';
	var $virtualFields = array(
		'uri' =>  'CONCAT("/canteen/",Navigation.link)',
		
	);
	var $actsAs = array(
	'MultiTree' => array(
		'root' =>'root_id',
		'level' =>'level'
		)
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'navigation_id',
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
	);
}
?>
