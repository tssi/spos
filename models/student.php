<?php
class Student extends AppModel {
	var $name = 'Student';
	var $virtualFields = array(
			'FullName'=>"CONCAT(Student.LastName, ', ',Student.FirstName, '  ')"
		);
}
