<?php
class EndingDetail extends AppModel {
	var $name = 'EndingDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Ending' => array(
			'className' => 'Ending',
			'foreignKey' => 'ending_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
