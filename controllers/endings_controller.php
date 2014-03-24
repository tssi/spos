<?php
class EndingsController extends AppController {

	var $name = 'Endings';
	var $uses = array('Ending','Counter','Sale','Product', 'Unit');
	var $components = array('RequestHandler');

	function index() {
		$ref= $this->Counter->find('first', array('Counter.id'=>'ENDINGP'));
		$ref=$ref['Counter']['value'];
		$this->set(compact('ref'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ending', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ending', $this->Ending->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			if(empty($this->data['EndingDetail'][0]['item_code'])){
					array_shift($this->data['EndingDetail']);		
			}
			
			
			$this->Ending->create();
			$ref= $this->Counter->find('first', array('Counter.id'=>'ENDINGP'));
			$this->data['Ending']['ref_no']=$ref['Counter']['value'];
			
			if ($this->Ending->saveAll($this->data)) {
				$this->Counter->doIncrement('ENDINGP',1);
				
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Saving successful';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The ending inventory has been saved', true));
				}
			} else {
				$this->Session->setFlash(__('The ending could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ending', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ending->save($this->data)) {
				$this->Session->setFlash(__('The ending has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ending could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ending->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ending', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ending->delete($id)) {
			$this->Session->setFlash(__('Ending deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ending was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function report(){
		if (!empty($this->data)) {
			if(empty($this->data['EndingDetail'][0]['item_code'])){
					array_shift($this->data['EndingDetail']);		
			}
			//if(this->data[''])
			
			$data=$this->data;
			$this->set('data',$data);
			$this->layout='pdf';
			$this->render();
		}else{
			$this->redirect(array('action' => 'index'));
		}
	}

	function findEndings(){
		$Date = date('Y-m-d');
		
		$fromDate= date("Y-m-d H:i:s",strtotime($Date.' 00:00:00'));
		$toDate = date("Y-m-d H:i:s",strtotime($Date.'  23:59:59'));
		
		$join =array(
				array(
					'table' => 'products',
					'alias' => 'Prod',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array(
								'Prod.item_code = SaleDetail.item_code'
							)
				
				),
				array(
					'table' => 'menu_items',
					'alias' => 'Menu',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array(
								'Menu.item_code = SaleDetail.item_code'
							)
				
				),
		);	
			
		$field = array(	
				'Sale.id',
				'Sale.total',
				'SaleDetail.item_code',
				'SaleDetail.id',
				'SaleDetail.sale_id',
				'SaleDetail.qty',
				'SaleDetail.amount',
				'Prod.product_type_id',
				'Menu.name',
				'Prod.name',
				'Prod.id',
				'Menu.selling_price',
				'Prod.selling_price',
				);	
		
		
        $conditions = array("Sale.created >=" =>$fromDate,
							"Sale.created <=" =>$toDate);
		
		
		$daily = $this->Sale->SaleDetail->find('all', array('conditions'=>$conditions, 'fields'=>$field, 'joins'=>$join));
		
		//pr($daily);exit;
		
		$report = array();
		$food = array();
		$shelf = array();
		$byOr = array();
		$data = null;
		$foodTotal= 0.00;
		$shelfTotal= 0.00;
		
		for($q=0;$q<count($daily);$q++){
				$index = (string)$daily[$q]['Sale']['id'];
				$itemcode = (string)$daily[$q]['SaleDetail']['item_code'];
				$data =array();
				
				if(is_null($daily[$q]['Prod']['product_type_id'])){
					$foodDex = $daily[$q]['SaleDetail']['item_code'];
					$data = array(
									'Qty'=>$daily[$q]['SaleDetail']['qty'],
									'Barcode'=>$daily[$q]['SaleDetail']['item_code'],
									'Desc'=>$daily[$q]['Menu']['name'],
									'Amount'=>$daily[$q]['Menu']['selling_price'],
									'Total'=>$daily[$q]['SaleDetail']['qty']*$daily[$q]['Menu']['selling_price']
						);
					if(!isset($food[$foodDex])){
						$food[$foodDex]= $data;
					}else{
						$food[$foodDex]['Qty']+=$data['Qty'];
						$food[$foodDex]['Total']+=$data['Total'];
					}
					$foodTotal+=$data['Total'];
				}else{
					$prodDex = $daily[$q]['SaleDetail']['item_code'];
					$data = array(
									'Qty'=>$daily[$q]['SaleDetail']['qty'],
									'Barcode'=>$daily[$q]['SaleDetail']['item_code'],
									'Desc'=>$daily[$q]['Prod']['name'],
									'Amount'=>$daily[$q]['Prod']['selling_price'],
									'Total'=>$daily[$q]['SaleDetail']['qty']*$daily[$q]['Prod']['selling_price']
						);
					if(!isset($shelf[$prodDex])){
						$shelf[$prodDex]= $data;
					}else{
						$shelf[$prodDex]['Qty']+=$data['Qty'];
						$shelf[$prodDex]['Total']+=$data['Total'];
					}
					$shelfTotal+=$data['Total'];

				}				
				
			}
		
		
		$report=array(
			'Date'=>$Date,
			'Total_Sales'=>$foodTotal+$shelfTotal,
			'Total_Food'=>$foodTotal,
			'Total_Shelf'=>$shelfTotal,
			'Total_Details'=>array(
								'Food'=>$food,
								'Shelf'=>$shelf,
				)	
			);
			
		
		$beginning = $this->Ending->EndingDetail->find('all', array('conditions'=>array('Ending.created <'=> date('Y-m-d 00:00:00'),
						'Ending.type'=>'MERCH'),
				'order'=>array('EndingDetail.name ASC')));
		
		$ending = $this->Ending->EndingDetail->find('all', array('conditions'=>array('Ending.created >'=> date('Y-m-d 00:00:00'),
						'Ending.created <'=> date('Y-m-d 23:59:59'),
						'Ending.type'=>'MERCH'),
				'order'=>array('EndingDetail.name ASC')));
		
		//pr($beginning);
		//exit();
		
		$endFinal =array();
		
		if(count($ending)>0){
			$endFinal['Merchandise_Ending_Date_Ending']=$ending[0]['Ending']['created'];
			$endFinal['Merchandise_Ending_Date_Beginning']=null;
			
			foreach($ending as $end){
				if(!isset($endFinal['Merchandise'][$end['EndingDetail']['item_code']])){
					$beg_a_qty = 0;
					$beg_c_qty = 0;
					$beg_date = 0;
					$daily_sold = 0;
					
					if(count($beginning)>0){
						$endFinal['Merchandise_Ending_Date_Beginning']=$beginning[0]['Ending']['created'];
						foreach($beginning as $beginIs){
							
							if($beginIs['EndingDetail']['item_code'] == $end['EndingDetail']['item_code']){
								$beg_a_qty = $beginIs['EndingDetail']['qty'];
								$beg_c_qty = $beginIs['EndingDetail']['computer_qty'];
								$beg_date = $beginIs['Ending']['created'];
							
							}
						}
					}
					
					$merchIndex = $end['EndingDetail']['item_code'];
					
					
					if(isset($report['Total_Details']['Shelf'][$merchIndex])){
						
						$daily_sold = $report['Total_Details']['Shelf'][$merchIndex]['Qty'];
					
					}
					
					$endFinal['Merchandise'][$end['EndingDetail']['item_code']]=array(
						'id' => $end['EndingDetail']['id'],
						'id_product' =>$end['EndingDetail']['id_product'],
						'name' => $end['EndingDetail']['name'],
						'beg_a_qty' => $beg_a_qty,
						'beg_c_qty' => $beg_c_qty,
						'beg_date' => $beg_date,
						'end_sold' => $daily_sold,
						'end_a_qty' => $end['EndingDetail']['qty'],
						'end_c_qty' => $end['EndingDetail']['computer_qty'],
						'end_date' => $end['Ending']['created']
					);
				}
			}
			
			$merchs = array();
		
			foreach($endFinal['Merchandise'] as $merchandise){
				array_push($merchs, $merchandise);
			}
			unset($endFinal['Merchandise']);
			$endFinal['Merchandise']= $merchs;
			
			
			$endFinal['Merchadise_status']=1;
			$endFinal['Merchadise_message']='Merchandise Ending Inventory Listed';
			
		}else{
			$endFinal['Merchadise_status']=3;
			$endFinal['Merchadise_message']='No Merchandise Ending Inventory Filed This Day!';
		}
		
		
		
		
		$beginning_meals = $this->Ending->EndingDetail->find('all', array('conditions'=>array('Ending.created <'=> date('Y-m-d 00:00:00'),
						'Ending.type'=>'MEALS'),
				'order'=>array('EndingDetail.name ASC')));
		
		$ending_meals = $this->Ending->EndingDetail->find('all', array('conditions'=>array('Ending.created >'=> date('Y-m-d 00:00:00'),
						'Ending.created <'=> date('Y-m-d 23:59:59'),
						'Ending.type'=>'MEALS'),
				'order'=>array('EndingDetail.name ASC')));
				
		if(count($ending_meals)>0){
			$endFinal['Meal_Ending_Date_Ending']=$ending_meals[0]['Ending']['created'];
			$endFinal['Meal_Ending_Date_Beginning']=null;
			
			foreach($ending_meals as $end){
				if(!isset($endFinal['Meal'][$end['EndingDetail']['item_code']])){
					$beg_a_qty = 0;
					$beg_c_qty = 0;
					$beg_date = 0;
					$daily_sold = 0;
					
					if(count($beginning_meals)>0){
						$endFinal['Meal_Ending_Date_Beginning']=$beginning_meals[0]['Ending']['created'];
						foreach($beginning_meals as $beginIs){
							
							if($beginIs['EndingDetail']['item_code'] == $end['EndingDetail']['item_code']){
								$beg_a_qty = $beginIs['EndingDetail']['qty'];
								$beg_c_qty = $beginIs['EndingDetail']['computer_qty'];
								$beg_date = $beginIs['Ending']['created'];
							
							}
						}
					}
					
					$foodIndex = $end['EndingDetail']['item_code'];
					
					
					if(isset($report['Total_Details']['Food'][$foodIndex])){
						
						$daily_sold = $report['Total_Details']['Food'][$foodIndex]['Qty'];
					
					}
					
					$endFinal['Meal'][$end['EndingDetail']['item_code']]=array(
						'id' => $end['EndingDetail']['id'],
						'id_product' =>$end['EndingDetail']['id_product'],
						'name' => $end['EndingDetail']['name'],
						'beg_a_qty' => $beg_a_qty,
						'beg_c_qty' => $beg_c_qty,
						'beg_date' => $beg_date,
						'end_sold' => $daily_sold,
						'end_a_qty' => $end['EndingDetail']['qty'],
						'end_c_qty' => $end['EndingDetail']['computer_qty'],
						'end_date' => $end['Ending']['created']
					);
				}
			}
			
			$food = array();
			foreach($endFinal['Meal'] as $meal){
				array_push($food, $meal);
			}
			unset($endFinal['Meal']);
			$endFinal['Meal']= $food;
			
			$endFinal['Meal_status']=1;
			$endFinal['Meal_message']='Meal Ending Inventory Listed';
			
		}else{
			$endFinal['Meal_status']=3;
			$endFinal['Meal_message']='No Meal Ending Inventory Filed This Day!';
		}
		
		
		echo json_encode($endFinal);
		exit();
	}

	function meal_served(){
		$ref= $this->Counter->find('first', array('Counter.id'=>'ENDINGP'));
		$ref=$ref['Counter']['value'];
		$this->set(compact('ref'));
	}
}
