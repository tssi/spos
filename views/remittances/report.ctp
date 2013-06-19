<?php

App::import('Vendor','remit_report');  
$remitForm= new remitForm();

/* pr($data);
echo date('F j, Y, g:i a',strtotime($data['created']));
exit(); */
$remitForm->remittance_details(0,$data);
$remitForm->remittance_details(4.25,$data);
$remitForm->divider();
$remitForm->output();
?>