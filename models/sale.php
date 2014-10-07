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
	
	public function daily_cashiers_report($date,$cashier){
		$sale = $this->query( 
				"SELECT 
				  `sale_details`.`item_code`,
				  SUM(`sale_details`.`qty`) AS no_of_sold_item,
				  `products`.`name`,
				  `products`.`selling_price`,
				  `products`.`avg_price`,
				  `products`.`category_id`
				 
				FROM
				  `sale_details` 
				  INNER JOIN `products` 
					ON (
					  `sale_details`.`item_code` = `products`.`item_code`
					)
				INNER JOIN `sales` 
					ON (
					  `sale_details`.`sale_id` = `sales`.`id`
					) 
				WHERE (
					`sale_details`.`created` >= '$date'
					AND `sales`.`cashier` = '$cashier'
				  ) 
				GROUP BY `sale_details`.`item_code` 
				ORDER BY   `products`.`category_id`,`products`.`name`"
			);
		
		$received = $this->query( 
			"SELECT 
			  `receiving_details`.`item_code`,
			  `receiving_details`.`name`,
			  SUM(`receiving_details`.`qty`) AS qty_additional_for_the_day,
			  `receivings`.`created`,
			  `receivings`.`status` 
			FROM
			  `receiving_details` 
			  INNER JOIN `products` 
				ON (
				  `receiving_details`.`item_code` = `products`.`item_code`
				) 
			  INNER JOIN `receivings` 
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
			  `daily_beginning_inventories` 
			WHERE (`created` = '$date')"
		);
		
		return array('Sale'=>$sale,'Received'=>$received,'BeginningInventory'=>$beginning_invty);
	}

}
