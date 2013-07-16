<?php 
App::import('Vendor','details_report');

$date=$data['Date'];
//$total =$data;
//pr($total);
//exit;

//$data = $data['Total_byOR'];


$form=new detailsreportForm($data);
$form->hdr();
$form->details();
$form->output();
?>