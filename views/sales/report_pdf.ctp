<?php 
App::import('Vendor','report');


$date=$data['Date'];
$form=new orForm($data);
$form->hdr($date,$cashier);
$form->details();


$form->output();
?>