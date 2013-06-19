<?php
class VendorsController extends AppController {

	var $name = 'Vendors';
	var $components = array('RequestHandler');

	function index() {
		$this->Vendor->recursive = 0;
		$this->set('vendors', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid vendor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('vendor', $this->Vendor->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Vendor->create();
			if ($this->Vendor->save($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The vendor has been saved';
					$this->data['Vendor']['id']=$this->Vendor->id;
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The vendor has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('The vendor could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid vendor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Vendor->save($this->data)) {
				$this->Session->setFlash(__('The vendor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vendor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Vendor->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for vendor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Vendor->delete($id)) {
			$this->Session->setFlash(__('Vendor deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Vendor was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function search_vendor_match($exact=null){
		
		$product = null;
		if(empty($exact)){
			$key = '%'.$this->data['Vendor']['key'].'%';
			$product = $this->Vendor->find('all', array('conditions'=>array('Vendor.name LIKE'=>$key)));
		}else{
			$key = $this->data['Vendor']['key'];
			$product = $this->Vendor->find('first', array('conditions'=>array('Vendor.name'=>$key)));
		}

		echo json_encode($product);
		exit();
	}
}
