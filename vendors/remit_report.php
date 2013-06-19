<?php
//Salary Deduction form
App::import('Vendor','formsheet');  
class remitForm extends FormSheet{
	protected static  $_width = 11;
	protected static $_height = 8.5;
	protected static $_unit ='in';
	protected static $_orient ='P';
	protected static $_allot_subjects = 15;
	function remitForm(){
		$this->showLines = !true;
		$this->FPDF(remitForm::$_orient, remitForm::$_unit,array(remitForm::$_width,remitForm::$_height));
		$this->createSheet();
		//$this->Image('../webroot/img/tmplt/deduct.jpg',0,0,8.5,11);
	}
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	
	function remittance_details($x, $remit){
		$metrics = array(
				'base_x' => 0.2+$x,
				'base_y' => 0.2,
				'width' => 3.85,
				'height' => 11,
				'rows' =>60,
				'cols' =>18,
		);
		$this->section($metrics);
		$this->GRID['font_size']=11;
		$this->centerText(0,1,'HOLY TRINITY ACADEMY',18,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,2,'Calabash Road, Balic-Balic, Sampaloc, Manila',20,'');
		$this->centerText(0,4,'Remittance Report',18,'b');
		$y=6;
		
		$this->leftText(7,$y++,'Date: '.date('F j, Y, g:i a',strtotime($remit['created'])),'');
		$this->leftText(0,$y++,'Ref No: '.$remit['ref_no'],'');
		$y+=.5;
		$this->leftText(0,$y,'Cashier ID: ','');
		$this->leftText(4,$y,$remit['cashier'],'');
		$y+=1;
		$this->leftText(0,$y,'Cashier Name: ','');
		$this->leftText(5,$y++,$remit['cashier_name'],'');
		$y+=.5;
		$this->leftText(0,$y++,'Collector ID: '.$remit['collector'],'');
		$this->leftText(0,$y,'Collector Name: ','');
		$this->leftText(5,$y++,$remit['collector_name'],'');
		$y+=.5;
		$this->leftText(0,$y,'Total Sales: '.number_format($remit['sales_amount'], 2, '.', ','),'');
		$y+=2;
		$this->leftText(0,$y++,'Remittances:','','b');	
		//$previous  = isset($remit['Previous'])?number_format($remit['Previous'], 2, '.', ','):'';
		//echo '>'.gettype($remit['Previous']).'<';
		if($remit['Previous']==''){
			$remit['Previous']='00.0';
		}else{
			$remit['Previous'] = number_format($remit['Previous'], 2, '.', ',');
		}	
		$this->leftText(1,$y++,'Previous: '.$remit['Previous'],'');
		$amtRemitted  = isset($remit['remitted'])?number_format($remit['remitted'], 2, '.', ','):'0.0';
		$this->leftText(1,$y++,'Current amount remitted: '.$amtRemitted,'');//.$amtRemitted,'');
		
		
		//table
		/* $height=6;
		$this->drawBox(0,$y,18,$height);
		$this->drawLine(3.6,'v',array($y,$height));
		$this->drawLine(7.2,'v',array($y,$height));
		$this->drawLine(10.8,'v',array($y,$height));
		$this->drawLine(14.4,'v',array($y,$height));
		$y+=0.8;
		$this->centerText(0,$y,'Cash',3.6);
		$this->centerText(3.6,$y,'Charge',3.6);
		$this->centerText(7.2,$y,'Prepaid',3.6);
		$this->centerText(10.8,$y,'Others',3.6);
		$this->centerText(14.4,$y,'Total',3.6);
		$y+=0.2;
		$this->drawLine($y,'h');
		
		$y+=$height;
		 */
		$this->rightText(14.4,$y,'Total:','');
		$this->rightText(17.5,$y++,$remit['total '],'');
		
		
		
		$remit['cash_in_box']-=$remit['remitted'];
		$this->leftText(0,$y,'Cash in Box: '.number_format($remit['cash_in_box'], 2, '.', ','),'');
	//	$this->leftText(10,$y,'Total: '.number_format($remit['total '], 2, '.', ','),'');
		$y+=3;
		$this->drawLine($y++,'h',array(10.5,6.5));
		$this->leftText(11,$y,'Collector Signature','');
	}
	function divider(){
		$metrics = array(
				'base_x' => 0,
				'base_y' => 0,
				'width' => 8.5,
				'height' => 11,
				'rows' =>60,
				'cols' =>30
		);
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$this->drawLine(15,'v');
	}
}
?>
