<?php
class PerishablesController extends AppController {

	var $name = 'Perishables';
	var $uses = array('Product','Perishable', 'ProductType','Counter');
    var $components = array('RequestHandler');
    
	function index() {
		$this->Perishable->recursive = 0;
		$this->set('perishables', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid perishable', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('perishable', $this->Perishable->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			if(isset($this->data['Perishable'][0])){ 
				for($i=0;$i<count($this->data['Perishable']); $i++){
					if($this->data['Perishable'][$i]['item_code']=='(Auto)'){
						$name = $this->data['Perishable'][$i]['name'];
						$cast = ucwords(strtolower($name));
						$this->data['Perishable'][$i]['name'] = $cast;
						$prefixInHouse = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXINH')));
						$prefixInProduct = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXPRD')));
						$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRSHBLE')));
						$this->data['Perishable'][$i]['item_code']=$prefixInHouse['Counter']['value'].$prefixInProduct['Counter']['value'].$counter['Counter']['value'];
						$this->Counter->doIncrement('PRSHBLE',1);
						$this->data['Perishable'][$i]['status']=1;
							
					}elseif (empty($this->data['Perishable'][$i]['item_code'])){
						unset($this->data['Perishable'][$i]);
					}
					
				}
			}else{
				if($this->data['Perishable']['item_code']=='(Auto)'){ //single product
								$name = $this->data['Perishable']['name'];
								$cast = ucwords(strtolower($name));
								$this->data['Perishable']['name'] = $cast;
								
								
								$prefixInHouse = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXINH')));
								$prefixInProduct = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXPRD')));
								$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRSHBLE')));
								$this->Counter->doIncrement('PRSHBLE',1);
								$this->data['Perishable']['item_code']=$prefixInHouse['Counter']['value'].$prefixInProduct['Counter']['value'].$counter['Counter']['value'];
								$this->data['Perishable']['status']=1;
					}elseif (empty($this->data['Perishable']['item_code'])){
								unset($this->data['Perishable']);
								exit();
							}
				
			}
			if ($this->Perishable->saveAll($this->data['Perishable'])) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/lib/img/icons/tick.png" />&nbsp; The perishable has been saved';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The perishable has been saved', true));
					//$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/lib/img/icons/exclamation.png" />&nbsp; The perishable could not be saved. Please, try again.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
				    $this->Session->setFlash(__('The perishable could not be saved. Please, try again.', true));
				}
			}
		}
		$productTypes = $this->Perishable->ProductType->find('list');
		$units = $this->Perishable->Unit->find('list');
		$this->set(compact('productTypes', 'units'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid perishable', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Perishable->save($this->data)) {
				$this->Session->setFlash(__('The perishable has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The perishable could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Perishable->read(null, $id);
		}
		$productTypes = $this->Perishable->ProductType->find('list');
		$units = $this->Perishable->Unit->find('list');
		$this->set(compact('productTypes', 'units'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for perishable', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Perishable->delete($id)) {
			$this->Session->setFlash(__('Perishable deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Perishable was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
