<?php
class Sale extends AppModel {
	var $name = 'Sale';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'SaleDetail' => array(
			'className' => 'SaleDetail',
			'foreignKey' => 'sale_id',
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
		'SalePayment' => array(
			'className' => 'SalePayment',
			'foreignKey' => 'sale_id',
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
	
	public function daily_cashiers_report($date){
		$sale = $this->query( 
				"SELECT 
				  `sale_details`.`item_code`,
				  SUM(`sale_details`.`qty`) AS no_of_sold_item,
				  `products`.`name`,
				  `products`.`selling_price`,
				  `products`.`avg_price`
				 
				FROM
				  `canteen`.`sale_details` 
				  INNER JOIN `canteen`.`products` 
					ON (
					  `sale_details`.`item_code` = `products`.`item_code`
					) 
				WHERE (
					`sale_details`.`created` >= '$date'
				  ) 
				GROUP BY `sale_details`.`item_code` 
				ORDER BY  `products`.`name`"
			);
		
		$received = $this->query( 
			"SELECT 
			  `receiving_details`.`item_code`,
			  `receiving_details`.`name`,
			  SUM(`receiving_details`.`qty`) AS qty_additional_for_the_day,
			  `receivings`.`created`,
			  `receivings`.`status` 
			FROM
			  `canteen`.`receiving_details` 
			  INNER JOIN `canteen`.`products` 
				ON (
				  `receiving_details`.`item_code` = `products`.`item_code`
				) 
			  INNER JOIN `canteen`.`receivings` 
				ON (
				  `receivings`.`id` = `receiving_details`.`receiving_id`
				) 
			WHERE (
				`receivings`.`created` >= '$date'
			  ) 
			AND `receivings`.`status` = '1'
			GROUP BY `receiving_details`.`item_code`"
		);
		
		$beginning_invty = $this->query( 
			"SELECT 
			  `id`,
			  `item_code`,
			  `qty`,
			  `created` 
			FROM
			  `canteen`.`daily_beginning_inventories` 
			WHERE (`created` = '2013-12-09')"
		);
		
		return array('Sale'=>$sale,'Received'=>$received,'BeginningInventory'=>$beginning_invty);
	}

}
