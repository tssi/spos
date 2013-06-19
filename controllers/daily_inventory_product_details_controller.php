<?php
class DailyInventoryProductDetailsController extends AppController {

	var $name = 'DailyInventoryProductDetails';

	function index() {
		$this->DailyInventoryProductDetail->recursive = 0;
		$this->set('dailyInventoryProductDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid daily inventory product detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('dailyInventoryProductDetail', $this->DailyInventoryProductDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DailyInventoryProductDetail->create();
			if ($this->DailyInventoryProductDetail->save($this->data)) {
				$this->Session->setFlash(__('The daily inventory product detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily inventory product detail could not be saved. Please, try again.', true));
			}
		}
		$dailyInventoryProducts = $this->DailyInventoryProductDetail->DailyInventoryProduct->find('list');
		$this->set(compact('dailyInventoryProducts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid daily inventory product detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DailyInventoryProductDetail->save($this->data)) {
				$this->Session->setFlash(__('The daily inventory product detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily inventory product detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DailyInventoryProductDetail->read(null, $id);
		}
		$dailyInventoryProducts = $this->DailyInventoryProductDetail->DailyInventoryProduct->find('list');
		$this->set(compact('dailyInventoryProducts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for daily inventory product detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DailyInventoryProductDetail->delete($id)) {
			$this->Session->setFlash(__('Daily inventory product detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Daily inventory product detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
