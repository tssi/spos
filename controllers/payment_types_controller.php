<?php
class PaymentTypesController extends AppController {

	var $name = 'PaymentTypes';

	function index() {
		$this->PaymentType->recursive = 0;
		$this->set('paymentTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid payment type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('paymentType', $this->PaymentType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PaymentType->create();
			if ($this->PaymentType->save($this->data)) {
				$this->Session->setFlash(__('The payment type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid payment type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PaymentType->save($this->data)) {
				$this->Session->setFlash(__('The payment type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PaymentType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for payment type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PaymentType->delete($id)) {
			$this->Session->setFlash(__('Payment type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Payment type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
