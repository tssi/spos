<?php
App::import('Vendor','reconciliation_report');
//pr($data);exit;
$date=date('Y-m-d');
$form = new endingForm($data,$details);
$details = array('index'=>0,'page'=>1);
do{
	$form->hdr($date);
	$details = $form->details($details['index'],$details['page']);
	if($details['index']<count($data['EndingReconciliationDetail'])){
		$form->createSheet();
	}
}while($details['index']<count($data['EndingReconciliationDetail']));
$form->output();

?>