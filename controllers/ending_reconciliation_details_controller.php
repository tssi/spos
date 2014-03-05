<?php
class EndingReconciliationDetailsController extends AppController {

	var $name = 'EndingReconciliationDetails';

	function index() {
		$this->EndingReconciliationDetail->recursive = 0;
		$this->set('endingReconciliationDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ending reconciliation detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('endingReconciliationDetail', $this->EndingReconciliationDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EndingReconciliationDetail->create();
			if ($this->EndingReconciliationDetail->save($this->data)) {
				$this->Session->setFlash(__('The ending reconciliation detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ending reconciliation detail could not be saved. Please, try again.', true));
			}
		}
		$endingReconciliations = $this->EndingReconciliationDetail->EndingReconciliation->find('list');
		$this->set(compact('endingReconciliations'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ending reconciliation detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EndingReconciliationDetail->save($this->data)) {
				$this->Session->setFlash(__('The ending reconciliation detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ending reconciliation detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EndingReconciliationDetail->read(null, $id);
		}
		$endingReconciliations = $this->EndingReconciliationDetail->EndingReconciliation->find('list');
		$this->set(compact('endingReconciliations'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ending reconciliation detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EndingReconciliationDetail->delete($id)) {
			$this->Session->setFlash(__('Ending reconciliation detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ending reconciliation detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
