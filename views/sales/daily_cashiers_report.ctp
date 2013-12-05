<?php 
App::import('Vendor','daily_cashiers_report');

$data =  array();

foreach($curr_data['Sale'] as $index => $sale){
	foreach($curr_data['Received'] as $received){
		if($sale['sale_details']['item_code'] == $received['receiving_details']['item_code']){
			$curr_data['Sale'][$index]['receiving_details']['qty_additional_for_the_day'] = $received['0']['qty_additional_for_the_day'];
		}
	}
}
unset($curr_data['Received']);

$form=new dcrForm();
$form->hdr();
$form->dtl($curr_data);

$form->output();
?>