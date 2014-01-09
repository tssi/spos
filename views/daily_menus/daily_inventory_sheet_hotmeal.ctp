<?php 
App::import('Vendor','daily_inventory_sheet_hotmeal');


$form=new disForm();
$form->hdr($date);
$form->dtl($curr_data);

$form->output();
?>