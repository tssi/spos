<?php
App::import('Vendor','reconciliation_report');
//pr($data);
$date=date('Y-m-d');
$form = new endingForm();
$form->hdr($date);
$form->details($data);
$form->output();

?>