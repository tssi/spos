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
		
			
		    $dateOf = $this->data['DailyMenu']['date'];
			$this->DailyMenu->deleteAll(array('DailyMenu.date'=>$dateOf));
			 
            unset($this->data['DailyMenu']['date']);
            unset($this->data['DailyMenu']['avg_price']);
            unset($this->data['DailyMenu']['desc']);
            unset($this->data['DailyMenu']['unit']);
			unset($this->data['DailyMenu']['code']);
			
            //remove first record of daily menu detail
            array_shift($this->data['DailyMenu']);
			
			
            for($x=0,$ctr=1;$x<count($this->data['DailyMenu']);$x++,$ctr++){
                if(!isset($this->data['DailyMenu'][$x]['date'])){
                    $this->data['DailyMenu'][$x]['date']=$dateOf;
                }
				if(empty($this->data['DailyMenu'][$x]['srv_left'])){
					$this->data['DailyMenu'][$x]['served'] = $this->data['DailyMenu'][$x]['approx_srv'];
				}else{
					$this->data['DailyMenu'][$x]['served'] = $this->data['DailyMenu'][$x]['srv_left'];
				}
				
				//Use in updating daily menu 
				$r = $this->DailyMenu->find('first',array('fields'=>'DailyMenu.id','order'=>'DailyMenu.id DESC'));
				$id = $r['DailyMenu']['id'];
				$this->data['DailyMenu'][$x]['id']= $id+$ctr;
            } 
			//pr($this->data['DailyMenu']);
			

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
		$this->DailyMenu->save($this->data);
		echo json_encode($this->data);
		exit();
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
		$date = $this->data['Sale']['date'].' 00:00:00';
		
		$curr_data = $this->DailyMenu->daily_inventory_sheet_hotmeal($date);
		$this->set(compact('curr_data'));
		$this->layout='pdf';
		$this->render();
	}
}
