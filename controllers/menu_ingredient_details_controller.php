<?php
class MenuIngredientDetailsController extends AppController {

	var $name = 'MenuIngredientDetails';

	function index() {
		$this->MenuIngredientDetail->recursive = 0;
		$this->set('menuIngredientDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid menu ingredient detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('menuIngredientDetail', $this->MenuIngredientDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MenuIngredientDetail->create();
			if ($this->MenuIngredientDetail->save($this->data)) {
				$this->Session->setFlash(__('The menu ingredient detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu ingredient detail could not be saved. Please, try again.', true));
			}
		}
		$menuIngredients = $this->MenuIngredientDetail->MenuIngredient->find('list');
		$products = $this->MenuIngredientDetail->Product->find('list');
		$this->set(compact('menuIngredients', 'products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid menu ingredient detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MenuIngredientDetail->save($this->data)) {
				$this->Session->setFlash(__('The menu ingredient detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu ingredient detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MenuIngredientDetail->read(null, $id);
		}
		$menuIngredients = $this->MenuIngredientDetail->MenuIngredient->find('list');
		$products = $this->MenuIngredientDetail->Product->find('list');
		$this->set(compact('menuIngredients', 'products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu ingredient detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MenuIngredientDetail->delete($id)) {
			$this->Session->setFlash(__('Menu ingredient detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu ingredient detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
