<?php
class ReceivingDetailsEditedsController extends AppController {

	var $name = 'ReceivingDetailsEditeds';
	var $components = array('RequestHandler');

	function index() {
		$this->ReceivingDetailsEdited->recursive = 0;
		$this->set('receivingDetailsEditeds', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid receiving details edited', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('receivingDetailsEdited', $this->ReceivingDetailsEdited->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ReceivingDetailsEdited->create();
			if ($this->ReceivingDetailsEdited->save($this->data)) {
				
					$this->Session->setFlash(__('Edited successful...', true));
			
			} else {
				$this->Session->setFlash(__('The receiving details edited could not be saved. Please, try again.', true));
			}
		}
		$receivings = $this->ReceivingDetailsEdited->Receiving->find('list');
		$receivingDetails = $this->ReceivingDetailsEdited->ReceivingDetail->find('list');
		$units = $this->ReceivingDetailsEdited->Unit->find('list');
		$this->set(compact('receivings', 'receivingDetails', 'units'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid receiving details edited', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ReceivingDetailsEdited->save($this->data)) {
				$this->Session->setFlash(__('The receiving details edited has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receiving details edited could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ReceivingDetailsEdited->read(null, $id);
		}
		$receivings = $this->ReceivingDetailsEdited->Receiving->find('list');
		$receivingDetails = $this->ReceivingDetailsEdited->ReceivingDetail->find('list');
		$units = $this->ReceivingDetailsEdited->Unit->find('list');
		$this->set(compact('receivings', 'receivingDetails', 'units'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for receiving details edited', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ReceivingDetailsEdited->delete($id)) {
			$this->Session->setFlash(__('Receiving details edited deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Receiving details edited was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
