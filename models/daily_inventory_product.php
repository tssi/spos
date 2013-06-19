<?php
class DailyInventoryProduct extends AppModel {
	var $name = 'DailyInventoryProduct';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'DailyInventoryProductDetail' => array(
			'className' => 'DailyInventoryProductDetail',
			'foreignKey' => 'daily_inventory_product_id',
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
