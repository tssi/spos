<?php
App::import('Vendor','reconciliation_report');

$chunk_details = array_chunk($details,50);
$page_count = count($chunk_details);
$last_page =false;
$curr_page = 1;

$form = new endingForm();

foreach($chunk_details as $details){
	if($page_count==$curr_page)$last_page=true;

	$form->hdr($hdr);
	$form->details($hdr,$details,$last_page,$page_count,$curr_page);

	if($page_count != $curr_page)$form->createSheet();
	$curr_page++;
} 

$form->output();
?>