<?php
class DailyBeginningInventoriesController extends AppController {

	var $name = 'DailyBeginningInventories';
	var $uses = array('DailyBeginningInventory','SaleDetail');
	
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
	
		
	function get_total_sale_qty(){
			$Date= $this->data['Sale']['date'];
			if(empty($Date)) $Date = date('Y-m-d');
			
			$fromDate= date("Y-m-d H:i:s",strtotime($Date.' 00:00:00'));
			$toDate = date("Y-m-d H:i:s",strtotime($Date.'  23:59:59'));
		
			
			$data = $this->SaleDetail->find('all',array(
							'conditions'=>array(
												"SaleDetail.created >=" =>$fromDate,
												"SaleDetail.created <=" =>$toDate,
												"SaleDetail.is_setmeal_hdr" =>0, 
												"SaleDetail.is_setmeal_dtl"=>0 
												),
							'fields'=>array('SaleDetail.item_code','SUM(SaleDetail.qty) as total_sale_qty'),
							'group'=>'SaleDetail.item_code'
						));			
		
			$sale_qty = array();
			foreach($data as $d){
				$sale_qty[$d['SaleDetail']['item_code']] = $d[0]['total_sale_qty'];
			}
			
			echo json_encode($sale_qty);
			exit();
	}
}
