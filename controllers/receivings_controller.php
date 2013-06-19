<?php
class ReceivingsController extends AppController {

	var $name = 'Receivings';
	var $uses = array('Receiving', 'Unit', 'ReceivingDetail', 'Product', 'DocType', 'ProductType', 'Counter');
	var $components = array('RequestHandler');

	function index() {
		$this->Receiving->recursive = 0;
		$docTypes = $this->Receiving->DocType->find('list');
		$prodTypes = $this->ProductType->find('list');
		$units = $this->ReceivingDetail->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));
		$this->set(compact('units', 'docTypes', 'prodTypes'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid receiving', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('receiving', $this->Receiving->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Receiving->create();
			unset($this->Receiving->ReceivingDetail->validate['receiving_id']);
			
			if($this->data['Receiving']['doc_num']=='(Auto)'){
					$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'RECEIVE')));
					$this->data['Receiving']['doc_num']=$counter['Counter']['value'];
					$this->Counter->doIncrement('RECEIVE',1);
				}
			
			if(isset($this->data['ReceivingDetail'][0])){
					for($i=0;$i<count($this->data['ReceivingDetail']); $i++){
						$this->data['ReceivingDetail'][$i]['is_edited']=0;	
						if(empty($this->data['ReceivingDetail'][$i]['item_code'])){
							unset($this->data['ReceivingDetail'][$i]);
						}
					}
				}
			
			$this->data['Receiving']['status']=0;
			
			if ($this->Receiving->saveAll($this->data,array('validate'=>'first'))){
				
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The receiving has been saved';
					$this->data['Receiving']['id']=$this->Receiving->id;
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The receiving has been saved', true));
					exit();
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The receiving could not be saved';
					$this->data['Receiving']['id']=$this->Receiving->id;
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The receiving could not be saved. Please, try again.', true));
					exit();
				}
				
			}
		}
		$vendors = $this->Receiving->Vendor->find('list');
		$this->set(compact('vendors'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid receiving', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Receiving->save($this->data)) {
				$this->Session->setFlash(__('The receiving has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receiving could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Receiving->read(null, $id);
		}
		$vendors = $this->Receiving->Vendor->find('list');
		$this->set(compact('vendors'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for receiving', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Receiving->delete($id)) {
			$this->Session->setFlash(__('Receiving deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Receiving was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function post(){
		$search_keys =array();
		foreach($this->Receiving->schema() as $key=>$value){
			$item = array(
			'label'=>Inflector::humanize(str_replace('_id','',$key)),
			'element'=>'Receiving'.Inflector::camelize($key),
			'field'=>'Receiving.'.$key
			);
			if($key!='id'){array_push($search_keys,$item);}
		}
		/* pr($search_keys);
		exit();*/
		
		for($ctr=0;$ctr<count($search_keys);$ctr++){
			if($search_keys[$ctr]['label']=='Vendor'){
				 unset($search_keys[$ctr]);
			}
		} 
		
		$units = $this->ReceivingDetail->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));
		$docTypes = $this->Receiving->DocType->find('list');
		
		$this->set(compact('search_keys', 'units', 'docTypes'));
		
	}
	
	function postToInventory(){
		$postIt=$this->data['Receiving']['post'];
		$receiveToPost=$this->Receiving->find('first', array('conditions'=>array('Receiving.id'=>$postIt)));
		
		if(!$receiveToPost['Receiving']['status']){ //if not posted 
			for($index=0;$index<count($receiveToPost['ReceivingDetail']);$index++){ //for each received producta received
				$prod = $this->Product->findByItemCode((string)$receiveToPost['ReceivingDetail'][$index]['item_code']); // search on Products
				if(!$prod['Product']['status']){ //if not active
					$this->Product->id = $prod['Product']['id'];
					$this->data['Product']['status']=1;
					$this->Product->save($this->data);
				}else{ 
					// if already active product
					$this->Product->id = $prod['Product']['id'];
					$this->data['Product']['qty']=$prod['Product']['qty']+$receiveToPost['ReceivingDetail'][$index]['qty'];
					$this->data['Product']['selling_price']=$receiveToPost['ReceivingDetail'][$index]['revise_srp'];
					$this->Product->save($this->data);
				}
			};
			$this->Receiving->id = $postIt;
			$this->data['Receiving']['status'] = 1;
			$this->Receiving->save($this->data);
			
			if($this->RequestHandler->isAjax()){
				$response['status'] = 1;
				$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The received product(s) has been posted';
				$this->data['Receiving']['id']=$this->Receiving->id;
				$response['data'] = $this->data;
				echo json_encode($response);
				exit();
			}else{ 
				$this->Session->setFlash(__('The receiving has been posted', true));
				exit();
			}
		}
		exit();
	}
	
	function getAvgPP($id){
		$pp = $this->Product->find('first', array('conditions'=>array('Product.item_code'=>$id),
					'fields'=>array('Product.item_code','Product.name','Product.avg_price')));
		//pr($pp);
		echo json_encode($pp);
		exit();
	}

	function search(){
		$field=$this->data['Receiving']['field'];
		$view=$this->data['Receiving']['view'];
		$sort=$this->data['Receiving']['sort']." ASC";
		$key='%'.$this->data['Receiving']['key'].'%';
			
		$conditions = array(''.$field.'  LIKE'=>$key );
		$search = $this->Receiving->find('all',array('conditions'=>$conditions, 'order'=>$sort, 'recursive'=>2));
		echo json_encode($search);
		exit;
		
		if ($this->RequestHandler->isAjax()) {
			if($view=="all"){
				$search = $this->Receiving->find('all',array('conditions'=>$conditions, 'order'=>$sort, 'recursive'=>2));
			}else{
				$search = $this->Receiving->find('all',array('conditions'=>array(''.$field.'  LIKE'=>$key, 'Receiving.status'=>1 ), 'order'=>$sort));
			}
			echo json_encode($search);
			exit;
		}
	}

	function adv_search(){
		$field = $this->data['Receiving']['field'];
		$key ='%'.$this->data['Receiving']['key'].'%';
	}
}
