<?php
class SalePaymentsController extends AppController {

	var $name = 'SalePayments';

	function index() {
		$this->SalePayment->recursive = 0;
		$this->set('salePayments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sale payment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('salePayment', $this->SalePayment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SalePayment->create();
			if ($this->SalePayment->save($this->data)) {
				$this->Session->setFlash(__('The sale payment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale payment could not be saved. Please, try again.', true));
			}
		}
		$sales = $this->SalePayment->Sale->find('list');
		$paymentTypes = $this->SalePayment->PaymentType->find('list');
		$this->set(compact('sales', 'paymentTypes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sale payment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SalePayment->save($this->data)) {
				$this->Session->setFlash(__('The sale payment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale payment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SalePayment->read(null, $id);
		}
		$sales = $this->SalePayment->Sale->find('list');
		$paymentTypes = $this->SalePayment->PaymentType->find('list');
		$this->set(compact('sales', 'paymentTypes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sale payment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SalePayment->delete($id)) {
			$this->Session->setFlash(__('Sale payment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sale payment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function state_account(){
	}
	
	function sa_report(){
	
		$data = $this->data['SalePayment']['data'];
		$data = json_decode($data, true);
		$this->set(compact('data'));
		$this->layout='pdf';
		$this->render();
	}
}
