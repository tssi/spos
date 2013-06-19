<?php
class MenuIngredientsController extends AppController {

	var $name = 'MenuIngredients';
	var $components = array('RequestHandler');

	function index() {
		$this->MenuIngredient->recursive = 0;
		$this->set('menuIngredients', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid menu ingredient', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('menuIngredient', $this->MenuIngredient->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MenuIngredient->create();
			
			if ($this->MenuIngredient->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/lib/img/icons/tick.png" />&nbsp; The menu ingredient has been saved';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The menu ingredient has been saved', true));
				}
				
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The menu ingredient could not be saved. Please, try again.';
					$this->data['MenuIngredient']['id']=$this->MenuIngredient->id;
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The menu ingredient could not be saved. Please, try again.', true));
					exit();
				}
			}
		}
		$menuItems = $this->MenuIngredient->MenuItem->find('list');
		$this->set(compact('menuItems'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid menu ingredient', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MenuIngredient->save($this->data)) {
				$this->Session->setFlash(__('The menu ingredient has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu ingredient could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MenuIngredient->read(null, $id);
		}
		$menuItems = $this->MenuIngredient->MenuItem->find('list');
		$this->set(compact('menuItems'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu ingredient', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MenuIngredient->delete($id)) {
			$this->Session->setFlash(__('Menu ingredient deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu ingredient was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
