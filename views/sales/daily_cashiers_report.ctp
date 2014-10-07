<?php 
App::import('Vendor','daily_cashiers_report');

$data =  array();
foreach($curr_data['Sale'] as $index => $sale){
	foreach($curr_data['Received'] as $received){
		if($sale['sale_details']['item_code'] == $received['receiving_details']['item_code']){
			$curr_data['Sale'][$index]['receiving_details']['qty_additional_for_the_day'] = $received['0']['qty_additional_for_the_day'];
		}
	}
	foreach($curr_data['BeginningInventory'] as $beginning){
		if($sale['sale_details']['item_code'] == $beginning['daily_beginning_inventories']['item_code']){
			$curr_data['Sale'][$index]['daily_beginning_inventories']['qty'] = $beginning['daily_beginning_inventories']['qty'];
		}
	}
}
unset($curr_data['Received']);
unset($curr_data['BeginningInventory']);

$form=new dcrForm();
if(!empty($curr_data['Sale'])){
	$form->hdr($date);
	$form->data_table();
	$form->dtl($curr_data,$date);
}else{
	$form->nodata();
}
$form->output();
?>