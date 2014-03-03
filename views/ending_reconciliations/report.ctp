<?php
App::import('Vendor','reconciliation_report');
//pr($data);
$date=date('Y-m-d');
$form = new endingForm($data);
$form->hdr($date);
$form->details();
$form->output();

?>