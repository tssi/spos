<?php 
App::import('Vendor','direct_print');
App::import('Vendor','sale_or');
$paymentType=array(
	'CS'=>1,
	'CH'=>3,
	'PR'=>2
);

$temp = array();
$payment = array();
$paymentMode=null;
$change=null;


foreach($header['SalePayment'] as $mode){
	$paymentMode=$mode['payment_type_id'];
	switch($paymentMode){
		case $paymentType['CS']:
			$payment['cash']=$mode['amount'];
		break;
		case $paymentType['CH']:
			$payment['charge']=$mode['amount'];
		break;
		case $paymentType['PR']:
			$payment['prepaid']=$mode['amount'];
		break;
	}
	
}

for($q=0;$q<count($details);$q++){
		$code = $details[$q]['SaleDetail']['item_code'];
	
		if(empty($details[$q]['Produkto']['name'])){
			$details[$q]['Produkto']['name']=$details[$q]['MenuItem']['name'];
			$details[$q]['Produkto']['unit_id']=$details[$q]['MenuItem']['unit_id'];
			
		}

		$data = array(
						'SaleDetail'=>array(
								'qty'=>$details[$q]['SaleDetail']['qty'],
								'amount'=>$details[$q]['SaleDetail']['amount'],
								'is_setmeal_dtl'=>$details[$q]['SaleDetail']['is_setmeal_dtl']
						),
						'Sale'=>$details[$q]['Sale'],
						'Produkto'=>array(
									'name'=>$details[$q]['Produkto']['name'],
									'unit_id'=>$details[$q]['Produkto']['unit_id'],
						),
					);
			
		if(!isset($temp[$code])){
			$temp[$code] = $data;
		
		}else{
			$temp[$code]['SaleDetail']['qty']+=$data['SaleDetail']['qty'];
			$temp[$code]['SaleDetail']['amount']+=$data['SaleDetail']['amount'];
			$temp[$code]['SaleDetail']['is_setmeal_dtl']+=$data['SaleDetail']['is_setmeal_dtl'];
			
		}
		
} 


$details = $temp;
$invoice_dtl=array();
foreach($details as $details){
	$data =  array(
					'item' =>$details['Produkto']['name'],
					'qty' =>$details['SaleDetail']['qty'],
					'price'=> $details['SaleDetail']['amount'],
					'is_setmeal_dtl'=> $details['SaleDetail']['is_setmeal_dtl'],
				);
	array_push($invoice_dtl,$data);	
}	

$data=	$invoice_dtl;

$invoice_no=$details['Sale']['id'];
$amount_received=$details['Sale']['amount_received'];
$total=$details['Sale']['total']; 



$cashier=array(
	'id'=>$user['id'],
	'name'=>$user['username']
	);

	
$temporaryPrintDir = "C:\\xampp\htdocs\canteen\\tmp\print\\";
//echo $temporaryPrintDir;

$filename = "print.pdf";
$printerName ="HPDeskjet";
$myPrinter = new Printee($temporaryPrintDir, $filename, $printerName);

//exit();
	

$form=new orForm($data);
$form->official_receipt(0,$cashier,$invoice_no, $amount_received, $total, $payment);
$form->official_receipt(4.25,$cashier,$invoice_no, $amount_received, $total, $payment);
$form->output();



/* $form->output($temporaryPrintDir.$filename,"F");
$myPrinter->printNow(); */


?>