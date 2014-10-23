<?php
class DailyMenusController extends AppController {

	var $name = 'DailyMenus';
    var $uses = array('DailyMenu','MenuItem', 'Unit');
    var $components =array('RequestHandler');

	function index() {
	   $units = $this->MenuItem->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));
	   $this->set(compact('units'));
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid daily menu', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('dailyMenu', $this->DailyMenu->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$date = $this->data['DailyMenu']['date'];
			unset($this->data['DailyMenu']['date']);
			unset($this->data['DailyMenu']['avg_price']);
            unset($this->data['DailyMenu']['desc']);
            unset($this->data['DailyMenu']['unit']);
			unset($this->data['DailyMenu']['code']);	
			array_shift($this->data['DailyMenu']);
		
			foreach($this->data['DailyMenu'] as $index => $dailyMenu){
				
				
                $this->data['DailyMenu'][$index]['date']= $date;

				if(empty($dailyMenu['id'])){
					$this->data['DailyMenu'][$index]['srv_left'] = $dailyMenu['approx_srv'];
					$this->data['DailyMenu'][$index]['additional_approx_srv']= 0;
				}else if(!empty($dailyMenu['id'])){
					unset($this->data['DailyMenu'][$index]['additional_approx_srv']);
					unset($this->data['DailyMenu'][$index]['approx_srv']);
				}
			}
			
            if ($this->DailyMenu->saveAll($this->data['DailyMenu'])) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The daily menu has been saved';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The daily menu has been saved', true));
				}
				
			} else {
				$this->Session->setFlash(__('The daily menu could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid daily menu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DailyMenu->save($this->data)) {
				$this->Session->setFlash(__('The daily menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily menu could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DailyMenu->read(null, $id);
		}
	}
	
	function update(){
		if($this->data['DailyMenu']['tType'] == "Add"){
			$existingDailyMenu = $this->DailyMenu->find('first',array('conditions'=>array('DailyMenu.id'=>$this->data['DailyMenu']['id'])));
			
			$additionalApproxSrv= $this->data['DailyMenu']['additional_approx_srv'];
			
			$this->data['DailyMenu']['srv_left'] = $existingDailyMenu['DailyMenu']['srv_left'] + $additionalApproxSrv;
			$this->data['DailyMenu']['additional_approx_srv'] = $existingDailyMenu['DailyMenu']['additional_approx_srv'] + $additionalApproxSrv;
			unset($this->data['DailyMenu']['approx_srv']);
		}else{
			$this->data['DailyMenu']['additional_approx_srv']= 0;
		}
		
	

		//SAVING
		if ($this->DailyMenu->save($this->data)) {
			if($this->RequestHandler->isAjax()){
				$response['status'] = 1;
				$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Updating successful';
				$response['data'] = $this->data;
				echo json_encode($response);
				exit();
			}else{ 
				$this->Session->setFlash(__('Updating successful...', true));
			}
		} else {
			if($this->RequestHandler->isAjax()){
				$response['status'] = -1;
				$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The daily menu could not be updated. Please, try again.';
				$response['data'] = $this->data;
				echo json_encode($response);
				exit();
			}else{
				$this->Session->setFlash(__('The daily menu could not be updated. Please, try again.', true));
			}
		}
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for daily menu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DailyMenu->delete($id)) {
			$this->Session->setFlash(__('Daily menu deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Daily menu was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
    function findDailyMenu($date=null){
		if(!$date){
			$date = date("Y-m-d");
		}
        $dateIs = date('Y-m-d', strtotime($date));
		$daily = $this->DailyMenu->find('all',array('conditions'=>array('DailyMenu.date'=>$dateIs), 'recursive'=>2));
		echo json_encode($daily);
		exit();
	}
	
	function daily_inventory_sheet_hotmeal(){
		$date = $this->data['Sale']['date'];
		$cashier = $this->data['Sale']['user_id'];
		//pr($cashier);exit;
		$curr_data = $this->DailyMenu->daily_inventory_sheet_hotmeal($date.' 00:00:00',$cashier);
		$this->set(compact('curr_data','date'));
		$this->layout='pdf';
		$this->render();
	}
}
