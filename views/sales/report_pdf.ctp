<?php 
App::import('Vendor','report');

/* $container = array();
foreach($data['Total_Details']['Food'] as $food){
	$f =array('flag'=>'F','content'=>$food);
	if($food['Is_SetDtl'] != 1){
		array_push($container,$f);
	}
}

foreach($data['Total_Details']['Shelf'] as $shelf){
	$s =array('flag'=>'S','content'=>$shelf);
	
	if($shelf['Is_SetDtl'] != 1){
		array_push($container,$s);
	}
} */
	
//pr($container);exit;	
		
$date=$data['Date'];
$form=new orForm($data);
$form->hdr($date);
$form->details();


$form->output();
?>