<?php
class Employee extends AppModel {
	var $name = 'Employee';
	var $virtualFields = array(
			'full_name'=>'CONCAT (Employee.last_name,", ",Employee.first_name,", ",Employee.middle_name)'
		);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
	public function getEmployeeById($id){
		return $this->find('first', array('conditions'=>array('Employee.id'=>$id)));
	}

}
