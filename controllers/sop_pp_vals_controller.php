<?php
class SopPpValsController extends AppController {

	var $name = 'SopPpVals';

	function index() {
		$this->SopPpVal->recursive = 0;
		$this->set('sopPpVals', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sop pp val', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sopPpVal', $this->SopPpVal->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SopPpVal->create();
			if ($this->SopPpVal->save($this->data)) {
				$this->Session->setFlash(__('The sop pp val has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sop pp val could not be saved. Please, try again.', true));
			}
		}
		$prepaid201s = $this->SopPpVal->Prepaid201->find('list');
		$this->set(compact('prepaid201s'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sop pp val', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SopPpVal->save($this->data)) {
				$this->Session->setFlash(__('The sop pp val has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sop pp val could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SopPpVal->read(null, $id);
		}
		$prepaid201s = $this->SopPpVal->Prepaid201->find('list');
		$this->set(compact('prepaid201s'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sop pp val', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SopPpVal->delete($id)) {
			$this->Session->setFlash(__('Sop pp val deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sop pp val was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
