<?php
class DailyMenu extends AppModel {
	var $name = 'DailyMenu';
	var $actsAs = array('Increment'=>array('incrementFieldName'=>'served'));
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'MenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'menu_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
