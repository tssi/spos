<?php
App::import('Vendor','formsheet');
class orForm extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_max = 41;
	protected static $_count = 0;
	protected static $_currline = 0;
	protected static $_totalpage = 0;
	protected static $_currpage = 1;
	protected static $_allot_subjects = 15;
	function orForm($data){
		$this->data =$data; 
		orForm::$_count = count($this->data['Total_Details']['Food'])+count($this->data['Total_Details']['Shelf']);
		orForm::$_totalpage = ceil(orForm::$_count/orForm::$_max);
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
	function hdr($date,$cashier){
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
		$this->leftText(0,7,'Total Sale:','b');
		$this->rightText(9,7,number_format($this->data['Total_Sales'], 2, '.', ','),'');
		$this->leftText(0,8,'Food:','b');
		$this->rightText(9,8,number_format($this->data['Total_Food'], 2, '.', ','),'');
		$this->leftText(0,9,'Merchandise:','b');
		$this->rightText(9,9,number_format($this->data['Total_Shelf'], 2, '.', ','),'');
		$this->leftText(0,10,'Cashier: '.$cashier,'b');
		$this->GRID['font_size']=9;
		$this->rightText(40,6,'Date: '.$date,'');
	
	}
	
	function details($cashier){
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
		
		//FOOD
		if(count($this->data['Total_Details']['Food']) == 0){	
			$y=0;
		}else{
			$this->GRID['font_size']=10;
			$this->centerText(0,0,$dbL.$dbL,40,'');
			$this->centerText(0,2,$dbL.$dbL,40,'');
			$this->centerText(0,3,$bL.$bL,40,'');
			$this->centerText(0,1,'FOOD',40,'b');
			$this->GRID['font_size']=9;
			$y=2.8;
			$this->leftText(0.25,$y,'Desc','');
			$this->centerText(30,$y,'Qty',5,'');
			//$this->centerText(13,$y,'SellingPrice',3,'');
			$this->centerText(35,$y,'Amount',5,'');
			$y+=1.5;
			foreach($this->data['Total_Details']['Food'] as $food){
				if($food['Is_SetDtl']!=1){
					$this->leftText(0.25,$y,$food['Desc'],'');
					$this->centerText(30,$y,number_format($food['Qty'], 2, '.', ','),5,'');
					//$this->rightText(12.5,$y,number_format($food['SellingPrice'], 2, '.', ','),3,'');
					$this->rightText(39.5,$y++,number_format($food['Amount'], 2, '.', ','),'','');
					orForm::$_currline++;
					if(orForm::$_currline>orForm::$_max){
						$this->createSheet();
						$this->hdr($this->data['Date'],$cashier);
						$y=10.8;
						$this->GRID['font_size']=10;
						$this->centerText(0,$y++,$dbL.$dbL,40,'');
						$this->centerText(0,$y++,'FOOD',40,'b');
						$this->centerText(0,$y++,$dbL.$dbL,40,'');
						$this->centerText(0,$y++,$bL.$bL,40,'');
						$y=13.6;
						$this->leftText(0.25,$y,'Desc','');
						$this->centerText(30,$y,'Qty',5,'');
						//$this->centerText(13,$y,'SellingPrice',3,'');
						$this->centerText(39.5,$y,'Amount','','');
						$y+=1.5;
						orForm::$_currline =0;
						orForm::$_currpage++;
					}
				}
			}
			$y++;
			$this->GRID['font_size']=9;
			$this->rightText(39.5,$y++,'Total Food Sale: '.number_format($this->data['Total_Food'], 2, '.', ','),'','');
		}
	
		//SHELF
		if(count($this->data['Total_Details']['Shelf']) == 0){
			//$y=0;
		}else{
			$this->GRID['font_size']=10;
			$this->centerText(0,$y++,$dbL.$dbL,40,'');
			$this->centerText(0,$y,'Merchandise',40,'b');
			$y++;
			$this->centerText(0,$y,$dbL.$dbL,40,'');
			$y+=0.8;
			$this->GRID['font_size']=9;
			$this->leftText(0.25,$y,'Desc','');
			$this->centerText(30,$y,'Qty',5,'');
			//$this->centerText(13,$y,'SellingPrice',3,'');
			$this->centerText(35,$y,'Amount',5,'');
			$y+=0.2;
			$this->GRID['font_size']=10;
			$this->centerText(0,$y,$bL.$bL,40,'');
			$this->GRID['font_size']=9;
			$y+=1.5;
			foreach($this->data['Total_Details']['Shelf'] as $shelf){
				//pr($shelf);exit;
				if($shelf['Is_SetDtl']!=1){
					$this->leftText(0.25,$y,$shelf['Desc'],'');
					$this->centerText(30,$y,number_format($shelf['Qty'], 2, '.', ','),5,'');
					//$this->rightText(12.5,$y,number_format($shelf['SellingPrice'], 2, '.', ','),3,'');
					$this->rightText(39.5,$y++,number_format($shelf['Amount'], 2, '.', ','),'','');
					orForm::$_currline++;
					if(orForm::$_currline>orForm::$_max){	
						$this->createSheet();
						$this->hdr($this->data['Date'],$cashier);
						$y=10.8;
						$this->GRID['font_size']=10;
						$this->centerText(1,$y++,$dbL,18,'');
						$this->centerText(0,$y++,'Merchandise',20,'b');
						$this->centerText(1,$y++,$dbL,18,'');
						$this->centerText(1,$y++,$bL,18,'');
						$y=13.6;
						$this->leftText(0.25,$y,'Desc','');
						$this->centerText(10,$y,'Qty',3,'');
						//$this->centerText(13,$y,'SellingPrice',3,'');
						$this->centerText(16,$y,'Amount',4,'');
						$y+=1.5;
						orForm::$_currline =0;
						orForm::$_currpage++;
					}	
				}
			}
		}
		$y++;
		$this->rightText(39.5,$y++,'Total Merchandise Sale: '.number_format($this->data['Total_Shelf'], 2, '.', ','),'','');
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,$dbL.$dbL,40,'');
		$this->GRID['font_size']=9;
		$this->centerText(0,$y++,'-- End of Daily Report --',40,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,$y,$dbL.$dbL,40,'');
	}
}
?>