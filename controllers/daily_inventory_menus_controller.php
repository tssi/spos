<?php
class DailyInventoryMenusController extends AppController {

	var $name = 'DailyInventoryMenus';
	var $uses = array('DailyInventoryMenu', 'DailyMenu');
	var $components = array('RequestHandler');
	
	function index() {
		$Date = date('Y-m-d');
		$fromDate= date("Y-m-d H:i:s",strtotime($Date.' 00:00:00'));
		$toDate = date("Y-m-d H:i:s",strtotime($Date.'  23:59:59'));
		
		 $conditions = array("DailyMenu.created >=" =>$fromDate,
							"DailyMenu.created <=" =>$toDate);
		
		$todayMenus = $this->DailyMenu->find('all', array('conditions'=>$conditions));
		/* pr($todayMenus);
		exit(); */
		$this->set(compact('todayMenus'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid daily inventory menu', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('dailyInventoryMenu', $this->DailyInventoryMenu->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DailyInventoryMenu->create();
			unset($this->DailyInventoryMenu->DailyInventoryMenuDetail->validate['daily_inventory_menu_id']);
			if ($this->DailyInventoryMenu->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The daily inventory menu has been saved';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The daily inventory menu has been saved', true));
				}
			} else {
				$this->Session->setFlash(__('The daily inventory menu could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid daily inventory menu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DailyInventoryMenu->save($this->data)) {
				$this->Session->setFlash(__('The daily inventory menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily inventory menu could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DailyInventoryMenu->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for daily inventory menu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DailyInventoryMenu->delete($id)) {
			$this->Session->setFlash(__('Daily inventory menu deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Daily inventory menu was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
