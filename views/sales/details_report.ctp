<?php 
App::import('Vendor','details_report');

$date=$data['Date'];
$total =$data;
//pr($total);
//exit;

$data = $data['Total_byOR'];


$form=new detailsreportForm($data);
$form->hdr($date,$total);
$form->details($data,$date,$total);
$form->output();
?>