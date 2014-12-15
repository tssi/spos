<?php
class Charge201sController extends AppController {

	var $name = 'Charge201s';
	var $uses= array('Charge201','Sale', 'Employee', 'Student', 'SalePayment');
	var $components = array('RequestHandler');

	function index() {
		$this->Charge201->recursive = 0;
		$this->set('charge201s', $this->paginate());
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid charge201', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('charge201', $this->Charge201->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Charge201->create();
			if ($this->Charge201->save($this->data)) {
				$this->Session->setFlash(__('The charge201 has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The charge201 could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid charge201', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Charge201->save($this->data)) {
				$this->Session->setFlash(__('The charge201 has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The charge201 could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Charge201->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for charge201', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Charge201->delete($id)) {
			$this->Session->setFlash(__('Charge201 deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Charge201 was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function getCharges($from=null,$to=null){
		$reference = $this->data['Charge']['reference']; //reference
		$employee = $this->data['Charge']['reference'];
		$category = $this->data['Charge']['category']; //category
		
				
		$condition = array();
		$query=array();
		
		$charge_id =$this->Charge201->find('first', array('conditions'=>array(
							'Charge201.reference'=>$reference,
							'Charge201.category'=>$category,
					)));
		$reference = $charge_id['Charge201']['id']; //save as reference
		
		
		if(!$from){ // if from is null
				if($to){// if from is null and to contains date
					$condition = array(
									   'SopCgeTran.charge201_id'=>$reference,
									   'Charge201.category'=>$category,
									   'SopCgeTran.created <='=>date("Y-m-d H:i:s",strtotime($to.' 23:59:59')));
				}else{// if to is null too
					$condition = array('SopCgeTran.charge201_id'=>$reference,
										'Charge201.category'=>$category);
				}
		}else{
			if($to){ // if both contains date
				$condition = array('SopCgeTran.charge201_id'=>$reference,
									'Charge201.category'=>$category,
								   'SopCgeTran.created >='=>date("Y-m-d H:i:s",strtotime($from.' 00:00:00')),
								   'SopCgeTran.created <='=>date("Y-m-d H:i:s",strtotime($to.' 23:59:59'))
								   );
			}else{//if from only
				$condition = array('SopCgeTran.charge201_id'=>$reference,
									'Charge201.category'=>$category,
								   'SopCgeTran.created >='=>date("Y-m-d H:i:s",strtotime($from.' 00:00:00')));
			}
		}
				
		$charge = $this->Charge201->SopCgeTran->find('all', array('conditions'=>$condition, 'recursive'=>2));
		
		
		for($q=0;$q<count($charge);$q++){
			$doc_num=$charge[$q]['SopCgeTran']['doc_number'];
			
			$joins=array(
					 array(
						'table'=>'menu_items',
						'alias'=>'MenuItem',
						'type'=>'left',
						'conditions'=>array('SaleDetail.item_code=MenuItem.item_code'),
					), 
					array(
						'table'=>'products',
						'alias'=>'Produkto',
						'type'=>'left',
						'conditions'=>array('SaleDetail.item_code=Produkto.item_code'),
					)
				);
				
		$fields=array('SaleDetail.item_code',
						'Sale.id',
						'Sale.buyer',
						'Sale.total',
						'Sale.amount_received',
						'SaleDetail.amount',
						'SaleDetail.qty',
						'Produkto.name',
						'MenuItem.name',);
			
			
			
			$sales = $this->Sale->SaleDetail->find('all',array('conditions'=>array('Sale.id'=>$doc_num),
										'joins'=>$joins, 'fields'=>$fields));
			
			$sales_payment=$this->Sale->find('first',array('conditions'=>array('Sale.id'=>$doc_num), 'recursive'=>2));
					
			
			
			for($t=0;$t<count($sales);$t++){
				
				if($sales[$t]['Produkto']['name']){
					$sales[$t]['SaleDetail']['name']=$sales[$t]['Produkto']['name'].' ('.$sales[$t]['SaleDetail']['qty'].')';
				}else{
					$sales[$t]['SaleDetail']['name']=$sales[$t]['MenuItem']['name'].' ('.$sales[$t]['SaleDetail']['qty'].')';
				}
				unset($sales[$t]['MenuItem']);
				unset($sales[$t]['Produkto']);	
			};
			
			$charge[$q]['Sale']=$sales[0]['Sale'];
			$charge[$q]['SaleDetail']=$sales;
			$charge[$q]['SalePayment']=$sales_payment['SalePayment'];
			
		}
		
		$name=null;
		
		switch($category){
			case "E":
				$name = $this->Employee->findbyId($employee);
				$name = $name['Employee']['full_name'];
				break;
			case "S":
				$name = $this->Student->findById($employee);
				$name = $name['Student']['FullName'];
				break;
		}
		
				
		$charges['Charges']=$charge;
		$charges['name']=$name;
		$charges['query']['from']=$from;
		$charges['query']['to']=$to;
		$charges['query']['data']=$this->data;
		
						
		if($this->RequestHandler->isAjax()){
			echo json_encode($charges);
			exit();
		}
	}

	function checkCharges($cat=null, $ref=null){
		$buyer=null;
		
		switch($cat){
			case 'E':
				$buyer = $this->Employee->findbyId($ref);
			break;
			case 'S':
				$buyer = $this->Student->findBySno($ref);
			break;
			default:
			break;
			
		}
		
	
		$charge = $this->Charge201->find('first', array('conditions'=>array(
				'Charge201.reference'=>$ref,
				'Charge201.category'=>$cat,
				)));
		
		$charge['Buyer']=$buyer;
		
		if($this->RequestHandler->isAjax()){
			echo json_encode($charge);
			exit();
		}else{
			pr($charge);
			exit();
		}
	}

	
}
