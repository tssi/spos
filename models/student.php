<?php
class Student extends AppModel {
	var $name = 'Student';
	var $virtualFields = array(
			'FullName'=>"CONCAT(Student.LastName, ', ',Student.FirstName, '  ')"
		);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
	public function getStudentById($id){
		return $this->find('first', array('conditions'=>array('Student.id'=>$id)));
	}
}
