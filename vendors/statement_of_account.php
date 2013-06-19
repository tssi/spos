<?php
App::import('Vendor','formsheet');
class SAReport extends Formsheet{
	protected static $_width = 11.5;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_allot_subjects = 15;
	function SAReport(){
		$this->showLines = !true;
		$this->FPDF(SAReport::$_orient, SAReport::$_unit,array(SAReport::$_width,SAReport::$_height));
		$this->createSheet();
	}
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	function hdr($data){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0.25,
			'height'=> 1.5,
			'width'=> 8.5,
			'cols'=> 40,
			'rows'=> 9,
		);
		
		
		$this->section($metrics);
		$this->GRID['font_size']=11;
		$this->centerText(0,1,'HOLY TRINITY ACADEMY',40,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,2,'Calabash Road, Balic-Balic, Sampaloc, Manila',40,'');
		$this->centerText(0,4,'Statement of Account Report',40,'b');
		
		$this->centerText(0,5,'('.$data['MODE_TYPE'].')',40,'b');
		
		$this->leftText(1,7,'Reference ID:','b');
		$this->leftText(5.5,7,$data['REF NO'],'');
		$this->rightText(8,7,'','');
		$this->leftText(1,8,'Name:','b');
		$this->leftText(3.5,8,$data['NAME'],'');
		$this->rightText(8,8,'','');
		$this->leftText(1,9,'Forwarded Balance:','b');
		$this->leftText(7.5,9,number_format($data['FORWARD BALANCE'], 2, '.', ','),'b');
		$this->leftText(1,10,'Date From:','b');
		$this->leftText(5,10,$data['DATE']['FROM'],'b');
		$this->leftText(1,11,'Date To:','b');
		$this->leftText(5,11,$data['DATE']['TO'],'b');
		$this->rightText(8,9,'','');
		$this->GRID['font_size']=9;
		$this->leftText(30,6,'Date Printed: '.date('Y-m-d H:m:s'),'');
	
	}
	
	function details($data){
		$dbL="==================================================";
		$bL="_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _";
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 2.4,
			'height'=> 1.5,
			'width'=> 8.5,
			'cols'=> 40,
			'rows'=> 9,
		);
		$this->section($metrics);
		
		$this->GRID['font_size']=10;
		$this->centerText(1,0,$dbL . $dbL,38,'');
		$this->centerText(1,2,$dbL . $dbL,38,'');
		$this->centerText(1,3,$bL . $bL,38,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,1,'TRANSACTIONS '.'('.$data['MODE_BY'].')',40,'b');
		$this->GRID['font_size']=9;
		$y=2.8;
		$this->leftText(1.25,$y,'Date','');
		$this->centerText(6,$y,'Description',15,'');
		$this->centerText(21,$y,'Due',7,'');
		$this->centerText(28,$y,'Payment',7,'');
		$this->centerText(33,$y,'Balance',7,'');
		$y+=1.5;
		
		if(isset($data['TRANSACTIONS'])){
		
			foreach($data['TRANSACTIONS'] as $transaction){
				if(isset($transaction['div .date input'])){
					$this->leftText(1.25,$y,$transaction['div .date input'],'');
					}
				if(isset($transaction['div .desc input'])){
					$this->leftText(6,$y,$transaction['div .desc input'],'','');
					}
				if(isset($transaction['div .due input'])){	
					$this->centerText(21,$y,$transaction['div .due input'],7,'');
				}
				if(isset($transaction['div .payment input'])){	
					$this->centerText(28,$y,$transaction['div .payment input'],7,'');
				}
				if(isset($transaction['div .bal input'])){
					$this->centerText(33,$y,$transaction['div .bal input'],7,'');
				}
				$y+=1;
			}
		}
		
		
		
	}
	
	

}
?>