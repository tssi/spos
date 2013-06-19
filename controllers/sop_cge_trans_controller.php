<?php
class SopCgeTransController extends AppController {

	var $name = 'SopCgeTrans';

	function index() {
		$this->SopCgeTran->recursive = 0;
		$this->set('sopCgeTrans', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sop cge tran', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sopCgeTran', $this->SopCgeTran->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SopCgeTran->create();
			if ($this->SopCgeTran->save($this->data)) {
				$this->Session->setFlash(__('The sop cge tran has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sop cge tran could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sop cge tran', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SopCgeTran->save($this->data)) {
				$this->Session->setFlash(__('The sop cge tran has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sop cge tran could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SopCgeTran->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sop cge tran', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SopCgeTran->delete($id)) {
			$this->Session->setFlash(__('Sop cge tran deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sop cge tran was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
