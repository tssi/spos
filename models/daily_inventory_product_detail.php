<?php
class DailyInventoryProductDetail extends AppModel {
	var $name = 'DailyInventoryProductDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'DailyInventoryProduct' => array(
			'className' => 'DailyInventoryProduct',
			'foreignKey' => 'daily_inventory_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
