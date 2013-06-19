<?php
App::import('Vendor','formsheet');
class detailsreportForm extends Formsheet{
	protected static $_width = 11.5;
	protected static $_height = 4.25;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_allot_subjects = 15;
	protected static $_available_line = 49;
	protected static $_currpage = 1;
	function detailsreportForm($data){
		$this->data =$data;
		$this->showLines = !true;
		$this->FPDF(detailsreportForm::$_orient, detailsreportForm::$_unit,array(detailsreportForm::$_width,detailsreportForm::$_height));
		$this->createSheet();
	}
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	function hdr($date,$total){

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
		$this->centerText(0,4,'Canteen Daily Report',20,'b');
		$this->centerText(0,5,'(Details By Official Receipt)',20,'');
		$this->leftText(1,7,'Total Sale:','b');
		$this->rightText(8,7,number_format($total['Total_Sales'], 2, '.', ','),'');
		$this->leftText(1,8,'Food:','b');
		$this->rightText(8,8,number_format($total['Total_Food'], 2, '.', ','),'');
		$this->leftText(1,9,'Merchandise:','b');
		$this->rightText(8,9,number_format($total['Total_Shelf'], 2, '.', ','),'');
		$this->GRID['font_size']=9;
		$this->rightText(19.5,6,'Date: '.$date,'');
	}
	
	
	function details($data,$date,$total){
		$dbL="===============================================";
		$bL="_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _";
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 2,
			'height'=> 1.5,
			'width'=> 4.25,
			'cols'=> 20,
			'rows'=> 9,
		);
		$this->section($metrics);
		$y=0;
		foreach($data as $key=>$val){
			$itm_count = count($val)+4;
	
			if(detailsreportForm::$_available_line < $itm_count){
				//$this->rightText(19,55,'Page '.detailsreportForm::$_currpage,'','');
				$this->createSheet();
				detailsreportForm::$_available_line =  49;
				detailsreportForm::$_currpage++;
				$this->hdr($date,$total);
				
				$y = 11;
			}
			
			$this->GRID['font_size']=10;
			$this->centerText(1,$y++,$dbL,18,'');
			$this->centerText(0,$y++,'OR - '.$key,20,'b');
			$this->centerText(1,$y++,$dbL,18,'');
			$this->GRID['font_size']=9;
			$this->leftText(1.25,$y,'Desc ','');
			$this->centerText(10,$y,'Qty',3,'');
			$this->centerText(13,$y,'Amount',3,'');
			$this->centerText(16,$y,'Total',4,'');
			$this->GRID['font_size']=10;
			$y+=0.5;
			$this->centerText(1,$y,$bL,18,'');
			$this->GRID['font_size']=9;
			$y+=1.5;
		
			foreach($val as $items){
				$this->leftText(1.25,$y,$items['Desc'],'');
				$this->centerText(10,$y,$items['Qty'],3,'');
				$this->rightText(12.5,$y,number_format($items['Amount'], 2, '.', ','),3,'');
				$this->rightText(14.5,$y++,number_format($items['Total'], 2, '.', ','),4,'');
				detailsreportForm::$_available_line--;
			}
			detailsreportForm::$_available_line-=4;
			
			
		}
		$y++;
		$this->GRID['font_size']=10;
		$this->centerText(1,$y++,$dbL,18,'');
		$this->GRID['font_size']=9;
		$this->centerText(0,$y++,'-- End of Daily Report --',20,'');
		$this->GRID['font_size']=10;
		$this->centerText(1,$y,$dbL,18,'');
		$this->GRID['font_size']=9;
		//$this->rightText(19,65,'Page '.detailsreportForm::$_currpage,'','');
	}
	
	

}
?>