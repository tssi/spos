<?php
class SalesPaymentsController extends AppController {

	var $name = 'SalesPayments';

	function index() {
		$this->SalesPayment->recursive = 0;
		$this->set('salesPayments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sales payment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('salesPayment', $this->SalesPayment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SalesPayment->create();
			if ($this->SalesPayment->save($this->data)) {
				$this->Session->setFlash(__('The sales payment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales payment could not be saved. Please, try again.', true));
			}
		}
		$sales = $this->SalesPayment->Sale->find('list');
		$paymentTypes = $this->SalesPayment->PaymentType->find('list');
		$this->set(compact('sales', 'paymentTypes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sales payment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SalesPayment->save($this->data)) {
				$this->Session->setFlash(__('The sales payment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales payment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SalesPayment->read(null, $id);
		}
		$sales = $this->SalesPayment->Sale->find('list');
		$paymentTypes = $this->SalesPayment->PaymentType->find('list');
		$this->set(compact('sales', 'paymentTypes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sales payment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SalesPayment->delete($id)) {
			$this->Session->setFlash(__('Sales payment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sales payment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
