<?php
class DailyInventoryMenuDetail extends AppModel {
	var $name = 'DailyInventoryMenuDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'DailyInventoryMenu' => array(
			'className' => 'DailyInventoryMenu',
			'foreignKey' => 'daily_inventory_menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
