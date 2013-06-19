<?php
class SopPpTransController extends AppController {

	var $name = 'SopPpTrans';

	function index() {
		$this->SopPpTran->recursive = 0;
		$this->set('sopPpTrans', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sop pp tran', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sopPpTran', $this->SopPpTran->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SopPpTran->create();
			if ($this->SopPpTran->save($this->data)) {
				$this->Session->setFlash(__('The sop pp tran has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sop pp tran could not be saved. Please, try again.', true));
			}
		}
		$prepaid201s = $this->SopPpTran->Prepaid201->find('list');
		$this->set(compact('prepaid201s'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sop pp tran', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SopPpTran->save($this->data)) {
				$this->Session->setFlash(__('The sop pp tran has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sop pp tran could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SopPpTran->read(null, $id);
		}
		$prepaid201s = $this->SopPpTran->Prepaid201->find('list');
		$this->set(compact('prepaid201s'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sop pp tran', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SopPpTran->delete($id)) {
			$this->Session->setFlash(__('Sop pp tran deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sop pp tran was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
