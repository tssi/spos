<?php
App::import('Vendor','ending_report');
/* pr($data);
exit(); */
$date=date('Y-m-d');
$form = new endingForm($data);
$form->hdr($date);
$form->details();
$form->output();

?>