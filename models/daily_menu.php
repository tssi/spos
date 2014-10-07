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
	
	public function daily_inventory_sheet_hotmeal($date,$cashier){
		return $this->query( 
		"SELECT 
			  `sale_details`.`item_code`,
			  `menu_items`.`name` AS menu_item_name,
			  `products`.`name` AS product_name,
			  SUM(`sale_details`.`qty`) AS no_of_sold_item,
			  `daily_menus`.`approx_srv`,
			  `daily_menus`.`additional_approx_srv`,
			  `daily_menus`.`selling_price`,
			  `daily_menus`.`srv_left`,
			  `sale_details`.`is_setmeal_hdr`,
			  `sale_details`.`is_setmeal_dtl` ,
			  `sales`.`cashier` 
			FROM
			  `sale_details` 
			  LEFT OUTER JOIN `products` 
				ON (
				  `products`.`item_code` = `sale_details`.`item_code`
				) 
			  LEFT OUTER JOIN `menu_items` 
				ON (
				  `sale_details`.`item_code` = `menu_items`.`item_code`
				) 
			  LEFT OUTER JOIN `daily_menus` 
				ON (
				  `menu_items`.`id` = `daily_menus`.`menu_item_id`
				) 
				AND (
				  DATE(`daily_menus`.date) = DATE(`sale_details`.created)
				) 
			 INNER JOIN `sales` 
				ON (
				  `sale_details`.`sale_id` = `sales`.`id`
				) 
			WHERE `sale_details`.`created` >= '$date' 
				AND   NOT (`sale_details`.`is_setmeal_hdr`=0 AND 
					`sale_details`.`is_setmeal_dtl` =0 AND
					`menu_items`.`name`  IS NULL)
				 AND `sales`.`cashier` = '$cashier' 
			GROUP BY `sale_details`.`item_code`,
			  `sale_details`.`is_setmeal_dtl`,
			  `sale_details`.`is_setmeal_hdr` 
			ORDER BY `sale_details`.`created`,
			  `sale_details`.`is_setmeal_dtl`,
			  `sale_details`.`is_setmeal_hdr` " 
		);
	}
}
