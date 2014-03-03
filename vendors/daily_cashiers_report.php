<?php
App::import('Vendor','formsheet');
class dcrForm extends Formsheet{
	protected static $_width = 13;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_count = 0;
	protected static $_currline = 0;
	protected static $_totalpage = 0;
	protected static $_currpage = 1;
	
	function dcrForm(){
		$this->showLines = !true;
		$this->FPDF(dcrForm::$_orient, dcrForm::$_unit,array(dcrForm::$_width,dcrForm::$_height));
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
			'base_y'=> 0.075,
			'height'=> 0.4,
			'width'=> 8,
			'cols'=> 40,
			'rows'=> 2,
		);
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$this->centerText(0,1,'ITEMIZED - HTA CANTEEN - DAILY CASHIERS REPORT',40,'b');
		$this->centerText(0,2,'GRADE SCHOOL__  HIGH SCHOOL__  CANTEEN',40,'b');
		$this->centerText(0,3,date("F d,Y",strtotime($date)),40,'b');
	}
	
	function data_table(){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.75,
			'height'=> 11.5,
			'width'=> 8,
			'cols'=> 40,
			'rows'=> 50,
		);
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$this->drawbox(0,0,40,50);
		
		$this->DrawMultipleLines(10,39,3,'v');
		$this->DrawMultipleLines(4,49,1,'h');
		$this->drawLine(1,'h');
		
		
		$this->GRID['font_size']=8;
		$x=10;
		$x_ntvl=3;
		$this->centerText($x,0.7,'A',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'B',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'C',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'D',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'E',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'F',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'G',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'H = E x G',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'I = F - G',3,'b');
		$this->centerText($x+=$x_ntvl,0.7,'J = E x G',3,'b');
		
		$x=10;
		$x_ntvl=3;
		$this->centerText(0,2.7,'Items',10,'b');
		
		$this->centerText($x,2,'Qty',3,'b');
		$this->centerText($x,2.7,'Beg.',3,'b');
		$this->centerText($x,3.4,'Invty.',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Qty',3,'b');
		$this->centerText($x,2.7,'Addition.',3,'b');
		$this->centerText($x,3.4,'for the day',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Qty',3,'b');
		$this->centerText($x,2.7,'Total',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Unit',3,'b');
		$this->centerText($x,2.7,'Price',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Selling',3,'b');
		$this->centerText($x,2.7,'Price',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'No. of',3,'b');
		$this->centerText($x,2.7,'Sold Item',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Less',3,'b');
		$this->centerText($x,2.7,'AR',3,'b');
		$this->centerText($x,3.4,'Qty',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'AR',3,'b');
		$this->centerText($x,2.7,'Amount',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Net Qty',3,'b');
		$this->centerText($x,2.7,'of Sold',3,'b');
		$this->centerText($x,3.4,'Items',3,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Net Sales',3,'b');
		$this->centerText($x,2.7,'for the day',3,'b');
				
		//Footer
		$this->GRID['font_size']=9;
		$this->leftText(0,50.6,'Total Cash Collection','','b');
		$this->GRID['font_size']=8;
		$this->leftText(0,51.25,'Prepared by:','','b');
		$this->drawLine(51.4,'h',array(3.5,10));
		$this->leftText(0,52,'Noted by:','','b');
		$this->drawLine(52.15,'h',array(3,10.5));
		$this->rightText(34,51.25,'Date Printed: ','','b');
		$this->leftText(34,51.25,date('M. d,Y H:i A'),'','b');
		$this->drawLine(51.4,'h',array(34,6));
	}
	
	function dtl($curr_data,$date){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.75,
			'height'=> 11.5,
			'width'=> 8,
			'cols'=> 40,
			'rows'=> 50,
		);
		$this->section($metrics);
		$this->GRID['font_size']=9;
		$max = 29;
		$totalpage = (count($curr_data['Sale'])!=$max)?ceil(count($curr_data['Sale'])/$max):$max;
		
		$line_count = 1;
		$curr_page = 1;
		$y = 4.7;
		$category ='';
		$this->rightText(39.8,52.25,'Page '.$curr_page.' of '.$totalpage,'','');
		foreach($curr_data['Sale'] as $data){
			if($category != $data['products']['category_id']){
				$category = $data['products']['category_id'];
				$this->leftText(0.25,$y++,$category,3,'b');
				$line_count++;
			}

			$qty_additional_for_the_day = isset($data['receiving_details']['qty_additional_for_the_day'])?$data['receiving_details']['qty_additional_for_the_day']:'0.00';
			$qty_total = $data['daily_beginning_inventories']['qty']+$qty_additional_for_the_day;
		
			$x=10;
			$x_ntvl=3;
			$this->leftText(0.5,$y,$data['products']['name'],3,'');
			$this->centerText($x,$y,$data['daily_beginning_inventories']['qty'],3,'');
			$this->centerText($x+=$x_ntvl,$y,number_format($qty_additional_for_the_day, 2, '.', ''),3,'');
			$this->centerText($x+=$x_ntvl,$y,number_format($qty_total, 2, '.', ''),3,'');
			$this->centerText($x+=$x_ntvl,$y,$data['products']['avg_price'],3,'');
			$this->centerText($x+=$x_ntvl,$y,$data['products']['selling_price'],3,'');
			$this->centerText($x+=$x_ntvl,$y,$data['0']['no_of_sold_item'],3,'');
			$this->centerText($x+=$x_ntvl,$y,'G',3,'');
			$this->centerText($x+=$x_ntvl,$y,'H',3,'');
			$this->centerText($x+=$x_ntvl,$y,'I',3,'');
			$this->centerText($x+=$x_ntvl,$y++,'J',3,'');
			
			$line_count++;
			if($line_count > $max){
				$this->createSheet();
				$this->hdr($date);
				$this->section($metrics);
				$this->GRID['font_size']=9;
				$y = 4.7;
				$this->leftText(0.25,$y++,$category,3,'b');
				$line_count = 1;
				$this->data_table();
				$this->rightText(39.8,52.25,'Page '.++$curr_page.' of '.$totalpage,'','');
			}
		}
	}
	
	function nodata(){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.75,
			'height'=> 11.5,
			'width'=> 8,
			'cols'=> 40,
			'rows'=> 50,
		);
		$this->section($metrics);
		$this->GRID['font_size']=15;
		$this->centerText(0,13,'No Data Available',40,'b');
		
	}

}
?>