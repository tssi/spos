<?php
class SetMeal extends AppModel {
	var $name = 'SetMeal';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'MenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'menu_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SetComponentMenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'menu_item',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SetComponentProduct' => array(
			'className' => 'Product',
			'foreignKey' => 'product_item',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
} 
