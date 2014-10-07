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
	
	function hdr($date){
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
		$this->centerText(0,4,'DAILY INVENTORY SHEET HOTMEAL',52,'b');
		$this->centerText(0,5,date("F d,Y",strtotime($date)),52,'');
		//$this->leftText(0,5.8,'Department:','','');
		//$this->drawLine(6,'h',array(4,10));
		$this->rightText(45,5.8,'Date Printed: ','','');
		$this->leftText(45,5.8,date('M. d,Y H:i A'),'','');
		$this->drawLine(6,'h',array(45,7));
	}
	
	function data_table(){
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
		$this->centerText($x+=$x_ntvl,1,'TOTAL',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.8,'No. of sold',$x_ntvl,'b');
		$this->centerText($x,1.8,'Cash',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'No. of unsold',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'Selling Price',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'TOTAL',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,1,'DIFFERENCES',6.25,'b');
		
		$this->drawLine(30.5,'h');
		$this->leftText(0.5,32,'Prepared by:','','');
		$this->drawLine(32.1,'h',array(5,8));
	}
	
	
	
	function dtl($curr_data,$date){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 1.5,
			'height'=> 1.2,
			'width'=> 11,
			'cols'=> 52,
			'rows'=> 6,
		);
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$max = 28;
		$totalpage = (count($curr_data)!=$max)?ceil(count($curr_data)/$max):1;
		
		
		$line_count = 0;
		$curr_page = 1;
		$i = 1;
		$y = 3;
		$this->rightText(52,34,'Page '.$curr_page.' of '.$totalpage,'','');
		foreach($curr_data as $data){
			$x =16;
			$x_ntvl =4.25;
			$total_item = $data['daily_menus']['approx_srv']+$data['daily_menus']['additional_approx_srv'];
			$total = $data['daily_menus']['selling_price']*$total_item;
			$differences = $data['daily_menus']['selling_price']*$data['daily_menus']['srv_left'];

			if($data['sale_details']['is_setmeal_dtl']){
				$item_name = (isset($data['menu_items']['menu_item_name']))?$data['menu_items']['menu_item_name']:$data['products']['product_name'];
				$this->leftText(2.75,$y++,'> '.$item_name,'','');
			
			}else{
				$x =16;
				$this->centerText(0,$y,$i,2,'');
				$this->leftText(2.25,$y,$data['menu_items']['menu_item_name'],'','');
				$this->centerText($x,$y,$data['daily_menus']['approx_srv'],$x_ntvl,'');
				$this->centerText($x+=$x_ntvl,$y,$data['daily_menus']['additional_approx_srv'],$x_ntvl,'');
				$this->centerText($x+=$x_ntvl,$y,number_format($total_item, 2, '.', ','),$x_ntvl,'');
				$this->rightText(-0.5+$x+=$x_ntvl,$y,$data['0']['no_of_sold_item'],$x_ntvl,'');
				$this->rightText(-0.5+$x+=$x_ntvl,$y,number_format($data['daily_menus']['srv_left'], 2, '.', ','),$x_ntvl,'');
				$this->rightText(-0.5+$x+=$x_ntvl,$y,$data['daily_menus']['selling_price'],$x_ntvl,'');
				$this->rightText(-0.5+$x+=$x_ntvl,$y,number_format($total, 2, '.', ','),$x_ntvl,'');
				$this->rightText(-0.5+$x+=$x_ntvl,$y++,number_format($differences, 2, '.', ','),6.25,'');
				$i++;
			}
			$line_count++;
			if($line_count > $max){
				$this->createSheet();
				$this->hdr($date);
				$y = 3;
				$line_count = 0;
				$this->data_table();
				$this->rightText(52,34,'Page '.++$curr_page.' of '.$totalpage,'','');
			}
		}
	}
	
	function nodata(){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 1.5,
			'height'=> 1.2,
			'width'=> 11,
			'cols'=> 52,
			'rows'=> 6,
		);
		$this->section($metrics);
		$this->GRID['font_size']=15;
		$this->centerText(0,13,'No Data Available',52,'b');
		
	}
	
}
?>