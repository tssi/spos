<?php
class SaleDetailsController extends AppController {

	var $name = 'SaleDetails';

	function index() {
		$this->SaleDetail->recursive = 0;
		$this->set('saleDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sale detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('saleDetail', $this->SaleDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SaleDetail->create();
			if ($this->SaleDetail->save($this->data)) {
				$this->Session->setFlash(__('The sale detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale detail could not be saved. Please, try again.', true));
			}
		}
		$sales = $this->SaleDetail->Sale->find('list');
		$this->set(compact('sales'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sale detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SaleDetail->save($this->data)) {
				$this->Session->setFlash(__('The sale detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SaleDetail->read(null, $id);
		}
		$sales = $this->SaleDetail->Sale->find('list');
		$this->set(compact('sales'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sale detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SaleDetail->delete($id)) {
			$this->Session->setFlash(__('Sale detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sale detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
