<?php 
App::import('Vendor','statement_of_account');
//pr($data);
//exit();
if($data['MODE_TYPE']=='CH'){
	$data['MODE_TYPE']='Charge';
}
if($data['MODE_TYPE']=='PR'){
	$data['MODE_TYPE']='Prepaid';
}

$form=new SAReport();
$form->hdr($data);
$form->details($data);
$form->output();
?>