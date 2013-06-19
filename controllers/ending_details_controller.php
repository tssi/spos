<?php
class EndingDetailsController extends AppController {

	var $name = 'EndingDetails';

	function index() {
		$this->EndingDetail->recursive = 0;
		$this->set('endingDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ending detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('endingDetail', $this->EndingDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EndingDetail->create();
			if ($this->EndingDetail->save($this->data)) {
				$this->Session->setFlash(__('The ending detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ending detail could not be saved. Please, try again.', true));
			}
		}
		$endings = $this->EndingDetail->Ending->find('list');
		$this->set(compact('endings'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ending detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EndingDetail->save($this->data)) {
				$this->Session->setFlash(__('The ending detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ending detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EndingDetail->read(null, $id);
		}
		$endings = $this->EndingDetail->Ending->find('list');
		$this->set(compact('endings'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ending detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EndingDetail->delete($id)) {
			$this->Session->setFlash(__('Ending detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ending detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	
}
