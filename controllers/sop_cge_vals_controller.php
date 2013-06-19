<?php
class SopCgeValsController extends AppController {

	var $name = 'SopCgeVals';

	function index() {
		$this->SopCgeVal->recursive = 0;
		$this->set('sopCgeVals', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sop cge val', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sopCgeVal', $this->SopCgeVal->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SopCgeVal->create();
			if ($this->SopCgeVal->save($this->data)) {
				$this->Session->setFlash(__('The sop cge val has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sop cge val could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sop cge val', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SopCgeVal->save($this->data)) {
				$this->Session->setFlash(__('The sop cge val has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sop cge val could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SopCgeVal->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sop cge val', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SopCgeVal->delete($id)) {
			$this->Session->setFlash(__('Sop cge val deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sop cge val was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
