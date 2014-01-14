<?php
class DailyMenu extends AppModel {
	var $name = 'DailyMenu';
	var $actsAs = array('Increment'=>array('incrementFieldName'=>'srv_left'));
	var $virtualFields = array('approx_srv_is_editable'=>"CASE additional_approx_srv
										WHEN '0' THEN 'true'
										ELSE 'false'
									END ");
	
	
	
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
	
	public function daily_inventory_sheet_hotmeal($date){
		return $this->query( 
		"SELECT 
		  `sale_details`.`item_code`,
		  `menu_items`.`name`,
		  SUM(`sale_details`.`qty`) AS no_of_sold_item,
		  `daily_menus`.`approx_srv`,
		  `daily_menus`.`selling_price` 
		FROM
		  `canteen`.`sale_details` 
		  INNER JOIN `canteen`.`menu_items` 
			ON (
			  `sale_details`.`item_code` = `menu_items`.`item_code`
			) 
		  INNER JOIN `canteen`.`daily_menus` 
			ON (
			  `menu_items`.`id` = `daily_menus`.`menu_item_id`
			) 
		WHERE `sale_details`.`created` >= '$date' 
			AND `sale_details`.`is_setmeal_hdr`  = '0'
		GROUP BY `sale_details`.`item_code`" 
		);
	}
}
