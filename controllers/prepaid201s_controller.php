<?php
class Prepaid201sController extends AppController {

	var $name = 'Prepaid201s';
	var $uses= array('Prepaid201','Sale', 'Employee', 'Student', 'SalePayment');
	var $components = array('RequestHandler');

	function index() {
		$this->Prepaid201->recursive = 0;
		$this->set('prepaid201s', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid prepaid201', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('prepaid201', $this->Prepaid201->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Prepaid201->create();
			if ($this->Prepaid201->save($this->data)) {
				$this->Session->setFlash(__('The prepaid201 has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prepaid201 could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid prepaid201', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Prepaid201->save($this->data)) {
				$this->Session->setFlash(__('The prepaid201 has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prepaid201 could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Prepaid201->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for prepaid201', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Prepaid201->delete($id)) {
			$this->Session->setFlash(__('Prepaid201 deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Prepaid201 was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function getCharges($from=null,$to=null){
		
		$reference = $this->data['Charge']['reference']; //reference
		$category = $this->data['Charge']['category']; //category
		$employee= $this->data['Charge']['reference'];
						
		$condition = array();
		$query=array();
		
		$prepaid_id =$this->Prepaid201->find('first', array('conditions'=>array(
							'Prepaid201.reference'=>$reference,
							'Prepaid201.category'=>$category,
					)));
		$reference = $prepaid_id['Prepaid201']['id']; //save as reference
		
		if(!$from){ // if from is null
				if($to){// if from is null and to contains date
					$condition = array(
									   'SopPpTran.prepaid201_id'=>$reference,
									   'Prepaid201.category'=>$category,
									   'SopPpTran.created <='=>date("Y-m-d H:i:s",strtotime($to.' 23:59:59')));
				}else{// if to is null too
					$condition = array('SopPpTran.prepaid201_id'=>$reference,
										'Prepaid201.category'=>$category);
				}
		}else{
			if($to){ // if both contains date
				$condition = array('SopPpTran.prepaid201_id'=>$reference,
									'Prepaid201.category'=>$category,
								   'SopPpTran.created >='=>date("Y-m-d H:i:s",strtotime($from.' 00:00:00')),
								   'SopPpTran.created <='=>date("Y-m-d H:i:s",strtotime($to.' 23:59:59'))
								   );
			}else{//if from only
				$condition = array('SopPpTran.prepaid201_id'=>$reference,
									'Prepaid201.category'=>$category,
								   'SopPpTran.created >='=>date("Y-m-d H:i:s",strtotime($from.' 00:00:00')));
			}
		}
		
		//pr($condition);
		$charge = $this->Prepaid201->SopPpTran->find('all', array('conditions'=>$condition, 'recursive'=>2));
		
		
		for($q=0;$q<count($charge);$q++){
			$doc_num=$charge[$q]['SopPpTran']['doc_number'];
			
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
		$ref_no=null;
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
	 
	 //echo 'Hey';
	 //exit();
	}

	
	function checkCharges($cat=null, $ref=null){
		$buyer=null;
		
		switch($cat){
			case 'E':
				$buyer = $this->Employee->findbyId($ref);
			break;
			case 'S':
				$buyer = $this->Student->findById($ref);
			break;
			default:
			break;
			
		}
	
		$prepaid = $this->Prepaid201->find('first', array('conditions'=>array(
				'Prepaid201.reference'=>$ref,
				'Prepaid201.category'=>$cat,
				)));
		
		$prepaid['Buyer']=$buyer;
		
		if($this->RequestHandler->isAjax()){
			echo json_encode($prepaid);
			exit();
		}
	}
}
