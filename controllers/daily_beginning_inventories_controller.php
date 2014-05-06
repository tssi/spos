<?php
class DailyBeginningInventoriesController extends AppController {

	var $name = 'DailyBeginningInventories';
	var $components = array('RequestHandler');

	function index() {
		$this->DailyBeginningInventory->recursive = 0;
		$this->set('dailyBeginningInventories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid daily beginning inventory', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('dailyBeginningInventory', $this->DailyBeginningInventory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DailyBeginningInventory->create();
			if ($this->DailyBeginningInventory->save($this->data)) {
				$this->Session->setFlash(__('The daily beginning inventory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily beginning inventory could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid daily beginning inventory', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DailyBeginningInventory->save($this->data)) {
				$this->Session->setFlash(__('The daily beginning inventory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily beginning inventory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DailyBeginningInventory->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for daily beginning inventory', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DailyBeginningInventory->delete($id)) {
			$this->Session->setFlash(__('Daily beginning inventory deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Daily beginning inventory was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function get_daily_beginning(){
		if($this->RequestHandler->isAjax()){
			$data = $this->DailyBeginningInventory->find('all',array('conditions'=>array('DailyBeginningInventory.created'=>date('Y-m-d'))));
			$beginning_qty = array();
			foreach($data as $d){
				$beginning_qty[$d['DailyBeginningInventory']['item_code']] = $d['DailyBeginningInventory']['qty'];
			}
			echo json_encode($beginning_qty);
			exit();
		}
	}
}
