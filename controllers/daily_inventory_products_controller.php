<?php
class DailyInventoryProductsController extends AppController {

	var $name = 'DailyInventoryProducts';
	var $uses = array('DailyInventoryProduct','Product');
	var $components = array('RequestHandler');

	function index() {
		$todayProducts = $this->Product->find('all');
		$this->set(compact('todayProducts'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid daily inventory product', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('dailyInventoryProduct', $this->DailyInventoryProduct->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DailyInventoryProduct->create();
			unset($this->DailyInventoryProduct->DailyInventoryProductDetail->validate['daily_inventory_product_id']);
			if ($this->DailyInventoryProduct->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The daily inventory product has been saved';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The daily inventory product has been saved', true));
				}
			} else {
				$this->Session->setFlash(__('The daily inventory product could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid daily inventory product', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DailyInventoryProduct->save($this->data)) {
				$this->Session->setFlash(__('The daily inventory product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily inventory product could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DailyInventoryProduct->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for daily inventory product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DailyInventoryProduct->delete($id)) {
			$this->Session->setFlash(__('Daily inventory product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Daily inventory product was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
