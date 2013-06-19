<?php
App::import('Vendor','formsheet');
class endingForm extends Formsheet{
	protected static $_width = 11.5;
	protected static $_height = 4.25;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_allot_subjects = 15;
	function endingForm($data){
		$this->data =$data; 
		$this->showLines = !true;
		$this->FPDF(endingForm::$_orient, endingForm::$_unit,array(endingForm::$_width,endingForm::$_height));
		$this->createSheet();
	}
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	function hdr($date){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0.25,
			'height'=> 1.5,
			'width'=> 4.25,
			'cols'=> 20,
			'rows'=> 9,
		);
		$this->section($metrics);
		$this->GRID['font_size']=11;
		$this->centerText(0,1,'HOLY TRINITY ACADEMY',20,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,2,'Calabash Road, Balic-Balic, Sampaloc, Manila',20,'');
		$this->centerText(0,4,'Canteen Daily Ending Report',20,'b');
		
		$this->GRID['font_size']=9;
		$this->leftText(1,6,'Ref No: '.$this->data['Ending']['ref_no'],'');
		$this->leftText(10,6,'Date: '.$date.' / '.date('h:i:s A'),'');
	
	}
	
	function details(){
		$dbL="===============================================";
		$bL="_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _";
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 1,
			'height'=> 1.5,
			'width'=> 4.25,
			'cols'=> 20,
			'rows'=> 9,
		);
		$this->section($metrics);
		
		$y=2.8;
		//Shelf
		$this->GRID['font_size']=10;
		$this->centerText(1,$y++,$dbL,18,'');
		$this->centerText(0,$y,'Merchandise',20,'b');
		$y++;
		$this->centerText(1,$y,$dbL,18,'');
		$y+=0.8;
		
		$this->GRID['font_size']=9;
		$this->leftText(1.25,$y,'Itemcode','');
		$this->centerText(6,$y,'Description',3,'');
		$this->centerText(15,$y,'Unit',3,'');
		$this->centerText(16,$y,'Qty',4,'');
		$y+=0.2;
		$this->GRID['font_size']=10;
		$this->centerText(1,$y,$bL,18,'');
		$this->GRID['font_size']=9;
		$y+=1.5;
		foreach($this->data['EndingDetail'] as $detail){
			$this->leftText(1.25,$y,$detail['item_code'],'');
			$this->leftText(6,$y,$detail['name'],3,'');
			$this->centerText(15,$y,$detail['unit_id'],3,'');
			$this->rightText(19,$y,$detail['qty'],'');
			$this->drawLine(0.2+$y++,'h',array(17.5,1.5));
			
		}
		$y+=1.5;
		$y+=2;
		$this->GRID['font_size']=10;
		$this->centerText(1,$y++,$dbL,18,'');
		$this->GRID['font_size']=9;
		$this->centerText(0,$y++,'-- End of Daily Report --',20,'');
		$this->GRID['font_size']=10;
		$this->centerText(1,$y,$dbL,18,'');
		$this->GRID['font_size']=9;	
		$y+=2;
		$this->leftText(15.5,$y,'Page '.'1'.' of '.'1','','');
	}
	
	

}
?>