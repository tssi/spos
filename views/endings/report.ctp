<?php
App::import('Vendor','ending_report');
/* pr($data);
exit(); */
$date=date('Y-m-d');
$form = new endingForm($data);
$details = array('index'=>0,'page'=>1);

do{
	$form->hdr($date);
	$details = $form->details($details['index'],$details['page']);
	if($details['index']<count($data['EndingDetail'])){
		$form->createSheet();
	}
}while($details['index']<count($data['EndingDetail']));
$form->output();

?>