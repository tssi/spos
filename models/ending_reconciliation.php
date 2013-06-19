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

}
