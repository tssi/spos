<?php
class EndingReconciliationDetail extends AppModel {
	var $name = 'EndingReconciliationDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'EndingReconciliation' => array(
			'className' => 'EndingReconciliation',
			'foreignKey' => 'ending_reconciliation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
