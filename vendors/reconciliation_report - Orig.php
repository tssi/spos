<?php
App::import('Vendor','formsheet');
class endingForm extends Formsheet{
	protected static $_width = 11.5;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_allot_subjects = 15;
	function endingForm(){
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
	function hdr($hdr){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0.25,
			'height'=> 0.75,
			'width'=> 8.5,
			'cols'=> 40,
			'rows'=> 5,
		);
		$this->section($metrics);
		$this->GRID['font_size']=11;
		$this->centerText(0,1,'HOLY TRINITY ACADEMY',40,'');
		$this->GRID['font_size']=10;
		$this->centerText(0,2,'Calabash Road, Balic-Balic, Sampaloc, Manila',40,'');
		$this->centerText(0,4,'Reconciliation Ending Report',40,'b');
		$this->GRID['font_size']=9;
		$this->leftText(2,5,'Ref No: '.$hdr['EndingReconciliation']['id'],'');
		$this->leftText(30,5,'Date: '.$hdr['EndingReconciliation']['created'],'');
	
	}
	function details($hdr,$details,$last_page,$page_count,$curr_page){
		$dbL="===============================================";
		$bL="_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _";
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

		if ($hdr['EndingReconciliation']['type']=='MERCH'){
			$this->GRID['font_size']=10;
			$this->centerText(0,$y++,$dbL . $dbL,40,'');
			$this->centerText(0,$y,'Merchandise',40,'b');
			$y++;
			$this->centerText(0,$y,$dbL . $dbL,40,'');
			$y+=0.8;
			
			$this->GRID['font_size']=9;
			$this->centerText(3.5,$y,'Beginning',3,'');
			$this->centerText(23.5,$y,'Ending',3,'');
			$this->centerText(29.5,$y,'Variance',3,'');
			
			$y+=1;
			$this->centerText(2,$y,'Computer',3,'');
			$this->centerText(5,$y,'Actual',3,'');
			$this->centerText(8,$y,'Desc',10,'');
			$this->centerText(18,$y,'Sold',4,'');
			$this->centerText(22,$y,'Computer',3,'');
			$this->centerText(25,$y,'Actual',3,'');
			$this->centerText(28,$y,'Computer',3,'');
			$this->centerText(31,$y,'Actual',3,'');
			$this->centerText(34,$y,'Remarks',4,'');
		
			$y+=0.2;
			$this->GRID['font_size']=10;
			$this->centerText(0,$y,$bL . $bL,40,'');
			$this->GRID['font_size']=9;
			$y+=1.5;
			foreach($details as $key=>$detail){
				$this->rightText(1.5,$y,$detail['ending_reconciliation_details']['beginning_computer'],3,'');
				$this->rightText(4,$y,$detail['ending_reconciliation_details']['beginning_actual'],3,'');
				$this->fitText(8,$y,$detail['products']['name'],3.5,'');
				$this->rightText(16.5,$y,$detail['ending_reconciliation_details']['sold'],4,'');
				$this->rightText(21.5,$y,$detail['ending_reconciliation_details']['ending_computer'],3,'');
				$this->rightText(24.5,$y,$detail['ending_reconciliation_details']['ending_actual'],3,'');
				$this->rightText(27.5,$y,$detail['ending_reconciliation_details']['variance_computer'],3,'');
				$this->rightText(30,$y,$detail['ending_reconciliation_details']['variance_actual'],3,'');
				$this->rightText(34,$y,isset($detail['ending_reconciliation_details']['remarks'])?$detail['ending_reconciliation_details']['remarks']:'',4,'');
				$y+=1;
			}
			if(!$last_page){
				$this->GRID['font_size']=10;
				$this->centerText(0,$y++,$dbL . $dbL,40,'');
				$this->GRID['font_size']=9;
				$this->centerText(0,$y++,'-- See next page --',40,'');
				$this->GRID['font_size']=10;
				$this->centerText(0,$y,$dbL . $dbL,40,'');
				$this->GRID['font_size']=9;	
			}
		}
		
		if ($hdr['EndingReconciliation']['type']=='MEALS'){
			$y+=1.5;
			$this->GRID['font_size']=10;
			$this->centerText(0,$y++,$dbL . $dbL,40,'');
			$this->centerText(0,$y,'Meals',40,'b');
			$y++;
			$this->centerText(0,$y,$dbL . $dbL,40,'');
			$y+=0.8;
			$this->GRID['font_size']=9;
			$this->centerText(3.5,$y,'Beginning',3,'');
			$this->centerText(23.5,$y,'Ending',3,'');
			$this->centerText(29.5,$y,'Variance',3,'');
			
			$y+=1;
			$this->centerText(2,$y,'Computer',3,'');
			$this->centerText(5,$y,'Actual',3,'');
			$this->centerText(8,$y,'Desc',10,'');
			$this->centerText(18,$y,'Sold',4,'');
			$this->centerText(22,$y,'Computer',3,'');
			$this->centerText(25,$y,'Actual',3,'');
			$this->centerText(28,$y,'Computer',3,'');
			$this->centerText(31,$y,'Actual',3,'');
			$this->centerText(34,$y,'Remarks',4,'');
			$y+=0.2;
			$this->GRID['font_size']=10;
			$this->centerText(0,$y,$bL . $bL,40,'');
			$this->GRID['font_size']=9;
			$y+=1.5;
			foreach($data['EndingReconciliationDetail'] as $detail){
				$this->rightText(1.5,$y,$detail['beginning_computer'],3,'');
				$this->rightText(4,$y,$detail['beginning_actual'],3,'');
				$this->leftText(8,$y,$detail['desc'],10,'');
				$this->rightText(16.5,$y,$detail['sold'],4,'');
				$this->rightText(21.5,$y,$detail['ending_computer'],3,'');
				$this->rightText(24.5,$y,$detail['ending_actual'],3,'');
				$this->rightText(27.5,$y,$detail['variance_computer'],3,'');
				$this->rightText(30,$y,$detail['variance_actual'],3,'');
				$this->rightText(34,$y,$detail['remarks'],4,'');
				$y+=1;
			}
			if(!$last_page){
				$this->GRID['font_size']=10;
				$this->centerText(0,$y++,$dbL . $dbL,40,'');
				$this->GRID['font_size']=9;
				$this->centerText(0,$y++,'-- See next page --',40,'');
				$this->GRID['font_size']=10;
				$this->centerText(0,$y,$dbL . $dbL,40,'');
				$this->GRID['font_size']=9;	
			}
		}
		
		if($last_page){
			$y+=2;
			$this->GRID['font_size']=10;
			$this->centerText(0,$y++,$dbL . $dbL,40,'');
			$this->GRID['font_size']=9;
			$this->centerText(0,$y++,'-- End of Daily Report --',40,'');
			$this->GRID['font_size']=10;
			$this->centerText(0,$y,$dbL . $dbL,40,'');
			$this->GRID['font_size']=9;	
			$y+=2;
		}
		$this->rightText(38,62,'Page '.$curr_page .' of '.$page_count,'','');
	}
	
}
?>