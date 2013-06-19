<?php
App::import('Vendor','formsheet');
class orForm extends Formsheet{
	protected static $_width = 11.5;
	protected static $_height = 4.25;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_max = 35;
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
		$this->centerText(0,4,'Canteen Daily Report',20,'b');
		$this->leftText(1,7,'Total Sale:','b');
		$this->rightText(8,7,number_format($this->data['Total_Sales'], 2, '.', ','),'');
		$this->leftText(1,8,'Food:','b');
		$this->rightText(8,8,number_format($this->data['Total_Food'], 2, '.', ','),'');
		$this->leftText(1,9,'Merchandise:','b');
		$this->rightText(8,9,number_format($this->data['Total_Shelf'], 2, '.', ','),'');
		$this->GRID['font_size']=9;
		$this->leftText(14,6,'Date: '.$date,'');
	
	}
	
	function details(){
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
		
		//Food
		$this->centerText(1,0,$dbL,18,'');
		$this->centerText(1,2,$dbL,18,'');
		$this->centerText(1,3,$bL,18,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,1,'FOOD',20,'b');
		$this->GRID['font_size']=9;
		$y=2.8;
		$this->leftText(1.25,$y,'Desc','');
		$this->centerText(10,$y,'Qty',3,'');
		$this->centerText(13,$y,'Amount',3,'');
		$this->centerText(16,$y,'Total',4,'');
		$y+=1.5;
		foreach($this->data['Total_Details']['Food'] as $food){
			$this->leftText(1.25,$y,$food['Desc'],'');
			$this->centerText(10,$y,$food['Qty'],3,'');
			$this->rightText(12.5,$y,number_format($food['Amount'], 2, '.', ','),3,'');
			$this->rightText(14.5,$y++,number_format($food['Total'], 2, '.', ','),4,'');
			orForm::$_currline++;
			if(orForm::$_currline>orForm::$_max){
				$this->createSheet();
			
				orForm::$_currpage++;
			}
		}
		$y+=1.5;
		$this->leftText(10,$y++,'Total Food Sale: '.number_format($this->data['Total_Food'], 2, '.', ','),'','');
		$y++;
		//Shelf
		$this->GRID['font_size']=10;
		$this->centerText(1,$y++,$dbL,18,'');
		$this->centerText(0,$y,'Merchandise',20,'b');
		$y++;
		$this->centerText(1,$y,$dbL,18,'');
		$y+=0.8;
		$this->GRID['font_size']=9;
		$this->leftText(1.25,$y,'Desc','');
		$this->centerText(10,$y,'Qty',3,'');
		$this->centerText(13,$y,'Amount',3,'');
		$this->centerText(16,$y,'Total',4,'');
		$y+=0.2;
		$this->GRID['font_size']=10;
		$this->centerText(1,$y,$bL,18,'');
		$this->GRID['font_size']=9;
		$y+=1.5;
		foreach($this->data['Total_Details']['Shelf'] as $shelf){
			$this->leftText(1.25,$y,$shelf['Desc'],'');
			$this->centerText(10,$y,$shelf['Qty'],3,'');
			$this->rightText(12.5,$y,number_format($shelf['Amount'], 2, '.', ','),3,'');
			$this->rightText(14.5,$y++,number_format($shelf['Total'], 2, '.', ','),4,'');
			orForm::$_currline++;
			if(orForm::$_currline>orForm::$_max){
				$this->createSheet();
				
				orForm::$_currpage++;
			}
		}

		$y+=1.5;
		$this->leftText(10,$y,'Total Merchandise Sale: '.number_format($this->data['Total_Shelf'], 2, '.', ','),'','');
		$y+=2;
		$this->GRID['font_size']=10;
		$this->centerText(1,$y++,$dbL,18,'');
		$this->GRID['font_size']=9;
		$this->centerText(0,$y++,'-- End of Daily Report --',20,'');
		$this->GRID['font_size']=10;
		$this->centerText(1,$y,$dbL,18,'');
		$this->GRID['font_size']=9;	
		$this->leftText(15.5,55,'Page '.orForm::$_currpage.' of '.orForm::$_totalpage,'','');
	}
	
	function displayReport($container,$index){
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
			
		$this->hdr($this->data['Date']);
		//	orForm::$_currline+=5;
			$metrics['base_y'] =  ($this->GRID['cell_height'] * orForm::$_currline)+2;
		$y = $this->label($container[$index]['flag'],$metrics);
		$this->section($metrics);

		$curr_flag = $prev_flag = $container[$index]['flag'];

		for($i = $index; $i < count($container); $i++){
			
			$curr_flag = $container[$i]['flag'];
			if($curr_flag != $prev_flag){
				$metrics['base_y'] =  ($this->GRID['cell_height'] * orForm::$_currline)+1;
				$this->label($container[$i]['flag'],$metrics);
			}
			$prev_flag = $curr_flag;
			
			if(orForm::$_currline>orForm::$_max){
				orForm::$_currpage++;
				$this->createSheet();
				$this->displayReport($container,$i);
			}
			$this->leftText(1.25,$y,orForm::$_currline .' ' . $container[$i]['content']['Desc'],'');
			$this->centerText(10,$y,$container[$i]['content']['Qty'],3,'');
			$this->rightText(12.5,$y,number_format($container[$i]['content']['Amount'], 2, '.', ','),3,'');
			$this->rightText(14.5,$y++,number_format($container[$i]['content']['Total'], 2, '.', ','),4,'');
			
		
			orForm::$_currline++;
		}
		
		/* $y+=1.5;
		$this->leftText(11,$y,'Total Food Sale: '.number_format($this->data['Total_Food'], 2, '.', ','),'','');
		$y+=2; */
		
		
	}
	function label($flag,$metrics){
		$dbL="===============================================";
		$bL="_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _";

		$this->section($metrics);
		$y = 0;
		switch($flag){
			case 'F': $lbl = 'FOOD';break;
			case 'S': $lbl = 'SHELF';break;
		}
		$lbl .= ''. $metrics['base_y'];
		$this->centerText(1,$y,$dbL,18,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,$lbl,20,'b');
		$this->GRID['font_size']=9;
		$this->centerText(1,$y++,$dbL,18,'');
		$this->centerText(1,$y++,$bL,18,'');
		
		$this->GRID['font_size']=9;
		$y+=0.8;
		$this->leftText(1.25,$y,'Desc','');
		$this->centerText(10,$y,'Qty',3,'');
		$this->centerText(13,$y,'Amount',3,'');
		$this->centerText(16,$y,'Total',4,'');
		$y+=1.5;
		orForm::$_currline+=3.8;
		return $y;

	}

}
?>