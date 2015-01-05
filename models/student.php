<?php
class Student extends AppModel {
	var $name = 'Student';
	var $virtualFields = array(
			'full_name'=>"CONCAT(Student.LastName, ', ',Student.FirstName, '  ')"
		);
}
