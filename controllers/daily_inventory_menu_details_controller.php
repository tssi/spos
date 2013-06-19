<?php
class DailyInventoryMenuDetailsController extends AppController {

	var $name = 'DailyInventoryMenuDetails';

	function index() {
		$this->DailyInventoryMenuDetail->recursive = 0;
		$this->set('dailyInventoryMenuDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid daily inventory menu detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('dailyInventoryMenuDetail', $this->DailyInventoryMenuDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DailyInventoryMenuDetail->create();
			if ($this->DailyInventoryMenuDetail->save($this->data)) {
				$this->Session->setFlash(__('The daily inventory menu detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily inventory menu detail could not be saved. Please, try again.', true));
			}
		}
		$dailyInventoryMenus = $this->DailyInventoryMenuDetail->DailyInventoryMenu->find('list');
		$this->set(compact('dailyInventoryMenus'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid daily inventory menu detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DailyInventoryMenuDetail->save($this->data)) {
				$this->Session->setFlash(__('The daily inventory menu detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily inventory menu detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DailyInventoryMenuDetail->read(null, $id);
		}
		$dailyInventoryMenus = $this->DailyInventoryMenuDetail->DailyInventoryMenu->find('list');
		$this->set(compact('dailyInventoryMenus'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for daily inventory menu detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DailyInventoryMenuDetail->delete($id)) {
			$this->Session->setFlash(__('Daily inventory menu detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Daily inventory menu detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
