<?php
App::import('Vendor','formsheet');
class detailsreportForm extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_allot_subjects = 15;
	protected static $_available_line = 49;
	protected static $_currpage = 1;
	function detailsreportForm($data){
		$this->data = $data;
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
	function hdr(){
		$data = $this->data;
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 0.25,
			'height'=> 1.5,
			'width'=> 7,
			'cols'=> 40,
			'rows'=> 9,
		);
		$this->section($metrics);
		$this->GRID['font_size']=11;
		$this->centerText(0,1,'HOLY TRINITY ACADEMY',40,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,2,'Calabash Road, Balic-Balic, Sampaloc, Manila',40,'');
		$this->centerText(0,4,'Canteen Daily Report',40,'b');
		$this->centerText(0,5,'(Details By Official Receipt)',40,'');
		$this->leftText(1,7,'Total Sale:','b');
		$this->rightText(9,7,number_format($data['Total_Sales'], 2, '.', ','),'');
		$this->leftText(1,8,'Food:','b');
		$this->rightText(9,8,number_format($data['Total_Food'], 2, '.', ','),'');
		$this->leftText(1,9,'Merchandise:','b');
		$this->rightText(9,9,number_format($data['Total_Shelf'], 2, '.', ','),'');
		$this->GRID['font_size']=9;
		$this->rightText(39.5,6,'Date: '.$data['Date'],'');
	}
	
	
	function details(){
		$data = $this->data;
		$dbL="===============================================";
		$bL="_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _";
		$metrics = array(
			'base_x'=> 0.75,
			'base_y'=> 2,
			'height'=> 1.5,
			'width'=> 7,
			'cols'=> 40,
			'rows'=> 9,
		);
		$this->section($metrics);
		$y=0;
		foreach($data['Total_byOR'] as $key=>$val){
			$itm_count = count($val)+4;
			if(detailsreportForm::$_available_line < $itm_count){
				//$this->rightText(19,55,'Page '.detailsreportForm::$_currpage,'','');
				$this->createSheet();
				detailsreportForm::$_available_line =  49;
				detailsreportForm::$_currpage++;
				$this->hdr();
				$y = 11;
			}
			
			$this->GRID['font_size']=10;
			$this->centerText(0,$y++,$dbL.$dbL,40,'');
			$this->centerText(0,$y++,'OR - '.$key,40,'b');
			$this->centerText(0,$y++,$dbL.$dbL,40,'');
			$this->GRID['font_size']=9;
			$this->leftText(0.25,$y,'Desc ','');
			$this->centerText(25,$y,'Qty',3,'');
			$this->centerText(30,$y,'Selling Price',3,'');
			$this->centerText(35,$y,'Amount',4,'');
			$this->GRID['font_size']=10;
			$y+=0.5;
			$this->centerText(0,$y,$bL.$bL,40,'');
			$this->GRID['font_size']=9;
			$y+=1.5;
			$totalIs=0;
			foreach($val as $items){
				if($items['Is_SetDtl']){
					$this->leftText(0.5,$y,'>'.$items['Desc'],'');
					$this->centerText(25,$y,$items['Qty'],3,'');
					$this->rightText(34.5,$y,'0.00','','');
					$this->rightText(39.5,$y++,'0.00','','');
				}else{
					$totalIs += $items['Amount'];
					$this->leftText(0.25,$y,$items['Desc'],'');
					$this->centerText(25,$y,$items['Qty'],3,'');
					$this->rightText(34.5,$y,number_format($items['SellingPrice'], 2, '.', ','),'','');
					$this->rightText(39.5,$y++,number_format($items['Amount'], 2, '.', ','),'','');
				}
				detailsreportForm::$_available_line--;
			}
			$this->rightText(39.5,$y++,'Total Amount:    '.number_format($totalIs, 2, '.', ','),'','');
				
			detailsreportForm::$_available_line-=5;
			
			
		}
		$y++;
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,$dbL.$dbL,40,'');
		$this->GRID['font_size']=9;
		$this->centerText(0,$y++,'-- End of Daily Report --',40,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,$y,$dbL.$dbL,40,'');
		$this->GRID['font_size']=9;
		//$this->rightText(19,65,'Page '.detailsreportForm::$_currpage,'','');
	}
	
	

}
?>