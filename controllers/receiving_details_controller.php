<?php
class ReceivingDetailsController extends AppController {

	var $name = 'ReceivingDetails';
	var $uses = array('ReceivingDetail','ReceivingDetailsEdited');
	var $components = array('RequestHandler');

	function index() {
		$this->ReceivingDetail->recursive = 0;
		$this->set('receivingDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid receiving detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('receivingDetail', $this->ReceivingDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ReceivingDetail->create();
			if ($this->ReceivingDetail->save($this->data)) {
				$this->Session->setFlash(__('The receiving detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receiving detail could not be saved. Please, try again.', true));
			}
		}
		$receivings = $this->ReceivingDetail->Receiving->find('list');
		$units = $this->ReceivingDetail->Unit->find('list');
		$this->set(compact('receivings', 'units'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid receiving detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)){
				$isEdited = $this->ReceivingDetail->findById($this->data['ReceivingDetail']['receiving_detail_id']);
				$this->data['ReceivingDetailsEdited']=$isEdited['ReceivingDetail'];
				$this->data['ReceivingDetailsEdited']['receiving_detail_id']=$this->data['ReceivingDetail']['receiving_detail_id'];
				$this->ReceivingDetailsEdited->create();
				$this->ReceivingDetailsEdited->save($this->data);
				$this->data['ReceivingDetail']['id']=$this->data['ReceivingDetail']['receiving_detail_id'];
				$this->data['ReceivingDetail']['is_edited']=1;
			if ($this->ReceivingDetail->save($this->data)){
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Edited successful';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The receiving detail has been saved', true));
				}
			} else {
				$this->Session->setFlash(__('The receiving detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ReceivingDetail->read(null, $id);
		}
		$receivings = $this->ReceivingDetail->Receiving->find('list');
		$units = $this->ReceivingDetail->Unit->find('list');
		$this->set(compact('receivings', 'units'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for receiving detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ReceivingDetail->delete($id)) {
			$this->Session->setFlash(__('Receiving detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Receiving detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
