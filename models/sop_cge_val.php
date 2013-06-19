<?php
class SopCgeVal extends AppModel {
	var $name = 'SopCgeVal';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Charge201' => array(
			'className' => 'Charge201',
			'foreignKey' => 'charge201_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function checkBal($id){ //checking balance
		return $this->find('first', array('conditions'=>array('SopCgeVal.charge201_id'=>$id)));
	}
}
