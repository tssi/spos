<?php
class DailyInventoryMenu extends AppModel {
	var $name = 'DailyInventoryMenu';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'DailyInventoryMenuDetail' => array(
			'className' => 'DailyInventoryMenuDetail',
			'foreignKey' => 'daily_inventory_menu_id',
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
