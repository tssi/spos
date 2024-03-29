<?php
class CountersController extends AppController {

	var $name = 'Counters';

	function index() {
		$this->Counter->recursive = 0;
		$this->set('counters', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid counter', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('counter', $this->Counter->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Counter->create();
			if ($this->Counter->save($this->data)) {
				$this->Session->setFlash(__('The counter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The counter could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid counter', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Counter->save($this->data)) {
				$this->Session->setFlash(__('The counter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The counter could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Counter->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for counter', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Counter->delete($id)) {
			$this->Session->setFlash(__('Counter deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Counter was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
