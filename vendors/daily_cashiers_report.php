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
		
		$this->DrawMultipleLines(15,39,2.5,'v');
		$this->DrawMultipleLines(4,49,1,'h');
		$this->drawLine(1,'h');
		
		
		$this->GRID['font_size']=7;
		$x=15;
		$x_ntvl=2.5;
		$this->centerText($x,0.7,'A',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'B',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'C',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'D',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'E',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'F',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'G',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'H = E x G',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'I = F - G',$x_ntvl,'b');
		$this->centerText($x+=$x_ntvl,0.7,'J = E x F',$x_ntvl,'b');
		
		$x=15;
		$x_ntvl=2.5;
		$this->centerText(0,2.7,'ITEMS',15,'b');
		$this->GRID['font_size']=6.5;
		$this->centerText($x,2,'Qty',$x_ntvl,'b');
		$this->centerText($x,2.7,'Beg.',$x_ntvl,'b');
		$this->centerText($x,3.4,'Invty.',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Qty',$x_ntvl,'b');
		$this->centerText($x,2.7,'Addition.',$x_ntvl,'b');
		$this->centerText($x,3.4,'for the day',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Qty',$x_ntvl,'b');
		$this->centerText($x,2.7,'Total',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Unit',$x_ntvl,'b');
		$this->centerText($x,2.7,'Price',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Selling',$x_ntvl,'b');
		$this->centerText($x,2.7,'Price',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'No. of',$x_ntvl,'b');
		$this->centerText($x,2.7,'Sold Item',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Less',$x_ntvl,'b');
		$this->centerText($x,2.7,'AR',$x_ntvl,'b');
		$this->centerText($x,3.4,'Qty',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'AR',$x_ntvl,'b');
		$this->centerText($x,2.7,'Amount',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Net Qty',$x_ntvl,'b');
		$this->centerText($x,2.7,'of Sold',$x_ntvl,'b');
		$this->centerText($x,3.4,'Items',$x_ntvl,'b');
		
		$this->centerText($x+=$x_ntvl,2,'Net Sales',$x_ntvl,'b');
		$this->centerText($x,2.7,'for the day',$x_ntvl,'b');
				
		
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
		$this->GRID['font_size']=7;
		$max = 46;
		$totalpage = (count($curr_data['Sale'])!=$max)?ceil(count($curr_data['Sale'])/$max):$max;
		
		$line_count = 1;
		$curr_page = 1;
		$y = 4.7;
		$category ='';
		$total_cash_collection = 0.00;
		$this->rightText(39.8,52.25,'Page '.$curr_page.' of '.$totalpage,'','');
		foreach($curr_data['Sale'] as $data){
			if($category != $data['products']['category_id']){
				$category = $data['products']['category_id'];
				$this->leftText(0.25,$y++,$category,3,'b');
				$line_count++;
			}
			

			$qty_additional_for_the_day = isset($data['receiving_details']['qty_additional_for_the_day'])?$data['receiving_details']['qty_additional_for_the_day']:'0.00';
			$qty_total = $data['daily_beginning_inventories']['qty']+$qty_additional_for_the_day;
			$j = $data['products']['selling_price'] * $data['0']['no_of_sold_item'];
			$total_cash_collection += $j;
			
			$x=14.8;
			$x_ntvl=2.5;
			$this->leftText(0.5,$y,$data['products']['name'],$x_ntvl,'');
			$this->rightText($x,$y,$data['daily_beginning_inventories']['qty'],$x_ntvl,'');
			$this->rightText($x+=$x_ntvl,$y,number_format($qty_additional_for_the_day, 2, '.', ','),$x_ntvl,'');
			$this->rightText($x+=$x_ntvl,$y,number_format($qty_total, 2, '.', ','),$x_ntvl,'');
			$this->rightText($x+=$x_ntvl,$y,$data['products']['avg_price'],$x_ntvl,'');
			$this->rightText($x+=$x_ntvl,$y,$data['products']['selling_price'],$x_ntvl,'');
			$this->rightText($x+=$x_ntvl,$y,$data['0']['no_of_sold_item'],$x_ntvl,'');
			$this->centerText(0.2+$x+=$x_ntvl,$y,'- -',$x_ntvl,'');
			$this->centerText(0.2+$x+=$x_ntvl,$y,'- -',$x_ntvl,'');
			$this->centerText(0.2+$x+=$x_ntvl,$y,'- -',$x_ntvl,'');
			$this->rightText($x+=$x_ntvl,$y++,number_format($j, 2, '.', ','),$x_ntvl,'');
			
			$line_count++;
			if($line_count > $max){
				$this->GRID['font_size']=8;
			
				$this->createSheet();
				$this->hdr($date);
				$this->section($metrics);
				$y = 4.7;
				$this->GRID['font_size']=7;
				$this->leftText(0.25,$y++,$category,$x_ntvl,'b');
				$line_count = 1;
				$this->data_table();
				$this->GRID['font_size']=7;
				$this->rightText(39.8,52.25,'Page '.++$curr_page.' of '.$totalpage,'','');
			}
		}
		$this->GRID['font_size']=8;
		$this->leftText(0,50.6,'Total Cash Collection','','b');
		$this->leftText(8,50.6,'Php '.number_format($total_cash_collection, 2, '.', ',') ,'','');
		
		//Footer
		
		$this->GRID['font_size']=7;
		$this->leftText(0,51.4,'Prepared by:','','b');
		//$this->drawLine(51.55,'h',array(3.5,10));
		$this->leftText(0,52,'Noted by:','','b');
		//$this->drawLine(52.15,'h',array(3,10.5));
		$this->rightText(34,51.4,'Date Printed: ','','b');
		$this->rightText(40,51.4,date('M. d,Y  H:i A'),'','');
		//$this->drawLine(51.55,'h',array(34,6));
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