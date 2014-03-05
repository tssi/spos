<?php
App::import('Vendor','reconciliation_report');
//pr($data);
$date=date('Y-m-d');
$form = new endingForm($data);
$details = array('index'=>0,'page'=>1);
do{
	$form->hdr($date);
	$form->details($details['index'],$details['page']);
	if($details['index']<count($data['EndingReconciliationDetail'])){
		$form->createSheet();
	}
}while($details['index']<count($data['EndingReconciliationDetail']));
$form->output();

?>