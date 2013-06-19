<?php
class ProductTypesController extends AppController {

	var $name = 'ProductTypes';

	function index() {
		$this->ProductType->recursive = 0;
		$this->set('productTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productType', $this->ProductType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ProductType->create();
			if ($this->ProductType->save($this->data)) {
				$this->Session->setFlash(__('The product type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductType->save($this->data)) {
				$this->Session->setFlash(__('The product type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductType->delete($id)) {
			$this->Session->setFlash(__('Product type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
