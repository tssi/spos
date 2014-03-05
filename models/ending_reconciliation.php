<?php
class EndingReconciliation extends AppModel {
	var $name = 'EndingReconciliation';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'EndingReconciliationDetail' => array(
			'className' => 'EndingReconciliationDetail',
			'foreignKey' => 'ending_reconciliation_id',
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

	public function report($ending_reconciliation_id){
		return $this->query("SELECT
				`ending_reconciliation_details`.`ending_reconciliation_id`
				, `ending_reconciliation_details`.`id_product`
				, `ending_reconciliation_details`.`beginning_computer`
				, `ending_reconciliation_details`.`beginning_actual`
				,`products`.`name`
				, `ending_reconciliation_details`.`sold`
				, `ending_reconciliation_details`.`ending_computer`
				, `ending_reconciliation_details`.`ending_actual`
				, `ending_reconciliation_details`.`variance_computer`
				, `ending_reconciliation_details`.`variance_actual`
				, `ending_reconciliation_details`.`variance_actual`
			FROM
				`ending_reconciliation_details`
				INNER JOIN `ending_reconciliations` 
					ON (`ending_reconciliation_details`.`ending_reconciliation_id` = `ending_reconciliations`.`id`)
				INNER JOIN `products` 
					ON (`ending_reconciliation_details`.`id_product` = `products`.`id`)
			WHERE (`ending_reconciliation_details`.`ending_reconciliation_id` ='$ending_reconciliation_id')"
		);
	}
}
