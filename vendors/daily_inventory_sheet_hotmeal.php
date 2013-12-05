<?php
App::import('Vendor','formsheet');
class disForm extends Formsheet{
	protected static $_width = 11.5;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'L';
	protected static $_count = 0;
	protected static $_currline = 0;
	protected static $_totalpage = 0;
	protected static $_currpage = 1;
	
	function disForm(){
		$this->showLines = !true;
		$this->FPDF(disForm::$_orient, disForm::$_unit,array(disForm::$_width,disForm::$_height));
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
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.15,
			'height'=> 1.2,
			'width'=> 11,
			'cols'=> 52,
			'rows'=> 6,
		);
		$this->section($metrics);
		$this->GRID['font_size']=11;
		$this->centerText(0,1,'HOLY TRINITY ACADEMY',52,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,2,'Calabash Road, Balic-Balic, Sampaloc, Manila',52,'');
		$this->centerText(0,4,'DAILY INVENTORY SHEET',52,'b');
		$this->centerText(0,5,'HOTMEAL',52,'b');
		$this->leftText(0,5.8,'Department:','','');
		$this->drawLine(6,'h',array(4,10));
		$this->rightText(46,5.8,'Date: ','','');
		$this->leftText(46,5.8,date('m/d/Y H:i:s'),'','');
		$this->drawLine(6,'h',array(46,6));
	}
	
	function dtl($curr_data){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 1.5,
			'height'=> 1.2,
			'width'=> 11,
			'cols'=> 52,
			'rows'=> 6,
		);
		$this->section($metrics);
		$this->GRID['font_size']=11;
		$this->drawBox(0,0,52,33);
		$this->drawLine(2,'h');
		$x =16;
		$x_ntvl =4.25;
		$this->drawLine(2,'v',array(0,30.5));
		$this->drawLine($x,'v',array(0,30.5));
		$this->drawLine($x+=$x_ntvl,'v',array(0,30.5));
		$this->drawLine($x+=$x_ntvl,'v',array(0,30.5));
		$this->drawLine($x+=$x_ntvl,'v',array(0,30.5));
		$this->drawLine($x+=$x_ntvl,'v',array(0,30.5));
		$this->drawLine($x+=$x_ntvl,'v',array(0,30.5));
		$this->drawLine($x+=$x_ntvl,'v',array(0,30.5));
		$this->drawLine($x+=$x_ntvl,'v',array(0,30.5));
		$this->GRID['font_size']=9;
		$x =16;
		$this->centerText(0,1,'No.',2,'b');
		$this->centerText(2,1,'ITEMS',14,'b');
		$this->centerText($x,0.8,'Beginning',$x_ntvl,'b');
		$this->centerText($x,1.8,'Inventory',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'Addition',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.8,'No. of sold',$x_ntvl,'b');
		$this->centerText($x,1.8,'Cash',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'TOTAL',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'No. of unsold',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'Price/Unit',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'TOTAL',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'DIFFERENCES',6.25,'b');
		
		$i = 1;
		$y = 3;
		//pr($curr_data);exit;
		foreach($curr_data as $data){
			$x =16;
			$x_ntvl =4.25;
			$unsold = $data['daily_menus']['approx_srv'] - $data['0']['no_of_sold_item'];
			
			$this->centerText(0,$y,$i,2,'');
			$this->leftText(2.25,$y,$data['menu_items']['name'],'','');
			$this->centerText($x,$y,$data['daily_menus']['approx_srv'],$x_ntvl,'');
			$this->centerText($x+=$x_ntvl,$y,'Addition',$x_ntvl,'');
			$this->centerText($x+=$x_ntvl,$y,$data['0']['no_of_sold_item'],$x_ntvl,'');
			$this->centerText($x+=$x_ntvl,$y,'TOTAL',$x_ntvl,'');
			$this->centerText($x+=$x_ntvl,$y,number_format($unsold, 2, '.', ''),$x_ntvl,'');
			$this->centerText($x+=$x_ntvl,$y,$data['daily_menus']['selling_price'],$x_ntvl,'');
			$this->centerText($x+=$x_ntvl,$y,'TOTAL',$x_ntvl,'');
			$this->centerText($x+=$x_ntvl,$y++,'DIFFERENCES',6.25,'');
			$i++;
		}
		
		
		$this->drawLine(30.5,'h');
		$this->leftText(0.5,32,'Prepared by:','','');
		$this->drawLine(32.1,'h',array(5,8));

	}
	
}
?>