<?php
App::import('Vendor','formsheet');
class endingForm extends Formsheet{
	protected static $_width = 11.5;
	protected static $_height = 8.5;
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
			'width'=> 8.5,
			'cols'=> 40,
			'rows'=> 9,
		);
		$this->section($metrics);
		$this->GRID['font_size']=11;
		$this->centerText(0,1,'HOLY TRINITY ACADEMY',$metrics['cols'],'');
		$this->GRID['font_size']=10;
		$this->centerText(0,2,'Calabash Road, Balic-Balic, Sampaloc, Manila',$metrics['cols'],'');
		$this->centerText(0,4,'Canteen Daily Ending Report',$metrics['cols'],'b');
		
		$this->GRID['font_size']=9;
		$this->leftText(1,6,'Ref No: '.$this->data['Ending']['ref_no'],'');
		$this->rightText(39,6,'Date: '.$date.' / '.date('h:i:s A'),'');
	
	}
	
	function details($index=0,$page=1){
		$dbL="==================================================";
		$bL="_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _";
		//$this->showLines = true;
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 1,
			'height'=> 1.5,
			'width'=> 8.5,
			'cols'=> 40,
			'rows'=> 9,
		);
		$this->section($metrics);
		
		$y=2.8;
		//Shelf
		$this->GRID['font_size']=10;
		$this->centerText(1,$y++,$dbL.$dbL,$metrics['cols']-2,'');
		$this->centerText(0,$y,'Merchandise',$metrics['cols'],'b');
		$y++;
		$this->centerText(1,$y,$dbL.$dbL,$metrics['cols']-2,'');
		$y+=0.8;
		
		$this->GRID['font_size']=9;
		$this->leftText(1.25,$y,'Itemcode','');
		$this->centerText(7,$y,'Description',15,'');
		$this->centerText(26,$y,'Unit',3,'');
		$this->centerText(29,$y,'Beginning',3,'');
		$this->centerText(32,$y,'Sale',3,'');
		$this->centerText(35,$y,'Ending',3,'');
		$y+=0.2;
		$this->GRID['font_size']=10;
		$this->centerText(1,$y,$bL.$bL,$metrics['cols']-2,'');
		$this->GRID['font_size']=9;
		$y+=1.5;
		$ln=1;
		for($i=$index;$i<count($this->data['EndingDetail']);$i++,$ln++){
			$detail = $this->data['EndingDetail'][$i];
			$this->leftText(1.25,$y,$detail['item_code'],'');
			$this->fitText(7,$y,$detail['name'],15,'');
			$this->centerText(26,$y,isset($detail['unit_id'])?$detail['unit_id']:'---',3,'');
			$this->rightText(39,$y,isset($detail['qty'])?$detail['qty']:'---','');
			$this->drawLine(0.2+$y++,'h',array(35.5,3.5));
			if($ln==50){
				$this->GRID['font_size']=10;
				$this->centerText(1,$y++,$dbL.$dbL,$metrics['cols']-2,'');
				$this->GRID['font_size']=9;
				$this->centerText(0,$y++,'-- See next page --',$metrics['cols'],'');
				$this->GRID['font_size']=10;
				$this->centerText(1,$y,$dbL.$dbL,$metrics['cols']-2,'');
				$this->GRID['font_size']=9;	
				$y+=2;
				$this->centerText(0,$y,'Page '.$page,$metrics['cols'],'');
				return array('index'=>$i+1,'page'=>$page+1);
			}
			
		}
		$y+=1.5;
		$y+=2;
		$this->GRID['font_size']=10;
		$this->centerText(1,$y++,$dbL.$dbL,$metrics['cols']-2,'');
		$this->GRID['font_size']=9;
		$this->centerText(0,$y++,'-- End of Daily Report --',$metrics['cols'],'');
		$this->GRID['font_size']=10;
		$this->centerText(1,$y,$dbL.$dbL,$metrics['cols']-2,'');
		$this->GRID['font_size']=9;	
		$y+=2;
		$this->centerText(0,$y,'Page '.$page,$metrics['cols'],'');
		return array('index'=>$i,'page'=>$page+1);
	}
	
	

}
?>