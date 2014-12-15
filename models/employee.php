<?php
class Employee extends AppModel {
	var $name = 'Employee';
	var $virtualFields = array(
			'full_name'=>'CONCAT (Employee.last_name,", ",Employee.first_name,", ",Employee.middle_name)'
		);


}
