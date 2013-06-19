<?php
class Counter extends AppModel {
	var $name = 'Counter';
	var $actsAs = array('Increment'=>array('incrementFieldName'=>'value'));
	
}
