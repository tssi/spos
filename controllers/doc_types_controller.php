<?php
class DocTypesController extends AppController {

	var $name = 'DocTypes';

	function index() {
		$this->DocType->recursive = 0;
		$this->set('docTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid doc type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('docType', $this->DocType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DocType->create();
			if ($this->DocType->save($this->data)) {
				$this->Session->setFlash(__('The doc type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The doc type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid doc type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DocType->save($this->data)) {
				$this->Session->setFlash(__('The doc type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The doc type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DocType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for doc type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DocType->delete($id)) {
			$this->Session->setFlash(__('Doc type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Doc type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
