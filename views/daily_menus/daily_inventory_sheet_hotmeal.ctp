<?php 
App::import('Vendor','daily_inventory_sheet_hotmeal');

$form=new disForm();
if(!empty($curr_data)){
	$form->hdr($date);
	$form->data_table();
	$form->dtl($curr_data,$date);

}else{
	$form->nodata();
}

$form->output();
?>