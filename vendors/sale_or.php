<?php
App::import('Vendor','formsheet');
class orForm extends Formsheet{
	protected static $_width = 5.75;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'L';
	protected static $_allot_subjects = 15;
	function orForm($data){
		$this->data =$data; 
		$this->showLines = !true;
		$this->FPDF(orForm::$_orient, orForm::$_unit,array(orForm::$_width,orForm::$_height));
		$this->createSheet();
	}
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	
	
	function official_receipt($y,$cashier,$invoice_no, $amount_received, $total, $payment){
		$dbL="====================================================";
		$bL="_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _";
		$data = $this->data;
		$metrics = array(
			'base_x'=> 0+$y,
			'base_y'=> 0.25,
			'height'=> 1,
			'width'=> 4.25,
			'cols'=> 23,
			'rows'=> 6,
		);
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$this->centerText(0,1,'Holy Trinity Academy',23,'');
		$this->centerText(0,2,'Calabash road, Balic-Balic, Sampaloc, Manila',23,'');
		$this->centerText(0,3,$dbL,23,'');
		$this->leftText(1.5,4.25,'ITEMS','');
		$this->centerText(14,4.25,'QTY',2,'');
		$this->leftText(18,4.25,'PRICE','');
		$this->centerText(0,5,$bL,23,'');
		$ctr=6;
		$count_item=0;
		$change=0.00;
				
		
		
		foreach($data as $d){
			if($d['is_setmeal']){
				$this->leftText(2,$ctr,$d['item'],'');
				$this->centerText(14,$ctr,$d['qty'],2,'');
				$this->rightText(21,$ctr,number_format($d['price'], 2, '.', ','),'');	
			}else{
				$this->leftText(1.5,$ctr,$d['item'],'');
				$this->centerText(14,$ctr,$d['qty'],2,'');
				$this->rightText(21,$ctr,number_format($d['price'], 2, '.', ','),'');	
			}
			$ctr++;
			$count_item++;	
		}
		$ctr+=1;
		$this->leftText(14.5,$ctr,'Total','');
		$this->rightText(21,$ctr++,number_format($total, 2, '.', ','),'');
		if(isset( $payment['cash'])){
			$this->leftText(14.5,$ctr,'Cash','');
			$this->rightText(21,$ctr++,number_format($payment['cash'], 2, '.', ','),'');
			$change=$amount_received-$payment['cash'];
		}
		if(isset($payment['charge'])){
			$this->leftText(14.5,$ctr,'Charge','');
			$this->rightText(21,$ctr++,number_format($payment['charge'], 2, '.', ','),'');
			//$this->rightText(21,$ctr++,'charge','');
		}
		if(isset($payment['prepaid'])){
			$this->leftText(14.5,$ctr,'Prepaid','');
			$this->rightText(21,$ctr++,number_format($payment['prepaid'], 2, '.', ','),'');
			//$this->rightText(21,$ctr++,'prepaid','');
		}
		$this->leftText(14.5,$ctr,'Received','');
		$this->rightText(21,$ctr++,number_format($amount_received, 2, '.', ','),'');
		
		$this->leftText(12,$ctr,'CHANGE ====>','');
		$this->rightText(21,$ctr++,number_format($change, 2, '.', ','),'');
		
			
		$this->centerText(0,$ctr++,$bL,23,'');
			$this->leftText(1.5,$ctr,'Cashier: '.$cashier['id'].' '.$cashier['name'],'');
			$this->leftText(16,$ctr,'Items:','');
			$this->rightText(21,$ctr++,$count_item,'');
			
		
		$this->centerText(0,$ctr++,$dbL,23,'');
			$this->centerText(0,$ctr++,"Thank you :".")",23,'');
		$this->centerText(0,$ctr++,$dbL,23,'');
			$this->leftText(1.5,$ctr,'Transaction Receipt  #:'.$invoice_no,'');
			$this->leftText(16,$ctr++,date( 'm/d/Y H:i',time()+(7*60*60)),'');
		
		$this->drawLine(23,'v',array(-1,45));
		}
}
?>
