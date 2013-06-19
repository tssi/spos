<?php
class RemittancesController extends AppController {

	var $name = 'Remittances';
	var $components = array('RequestHandler');
	var $uses= array('Remittance','Sale','SaleDetail','Counter','Product','DailyMenu');

	function index() {
		$this->Remittance->recursive = 0;
		$this->set('remittances', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid remittance', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('remittance', $this->Remittance->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Remittance->create();
			$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'REMITNC')));
			$this->data['Remittance']['ref_no']=$counter['Counter']['value'];
			$this->Counter->doIncrement('REMITNC',1);
			if ($this->Remittance->save($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The remittance has been saved';
					$this->data['Remittance']['id']=$this->Remittance->id;
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
				$this->Session->setFlash(__('The remittance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The remittance could not be saved. Please, try again.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
					$this->Session->setFlash(__('The remittance could not be saved. Please, try again.', true));
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid remittance', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Remittance->save($this->data)) {
				$this->Session->setFlash(__('The remittance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The remittance could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Remittance->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for remittance', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Remittance->delete($id)) {
			$this->Session->setFlash(__('Remittance deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Remittance was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function report(){
		$data = $this->data['Remittance'];
		$this->set(compact('data'));
		$this->layout="pdf";
		$this->render();
	}
	
function get_previous(){
		if($this->RequestHandler->isAjax()){
			$this->data['Remittance']['date_today']= date("Y-m-d",strtotime($this->data['Remittance']['created']));
			$this->data['Remittance']['date_today']=$this->data['Remittance']['date_today'].' 00:00:00';
			$todayDt = $this->data['Remittance']['date_today'];
			$currentDt=$this->data['Remittance']['created'];
			$cashier = $this->data['Remittance']['cashier'];
			
			$conditions = array(
								"Remittance.created >=" => date("Y-m-d H:i:s",strtotime($todayDt)),
								"Remittance.created <" => date("Y-m-d H:i:s",strtotime($currentDt)),
								"Remittance.cashier"=>$cashier
								);
			$fields = array('SUM(Remittance.remitted) as total');					
			$previous = $this->Remittance->find('all',array('conditions'=>$conditions,'fields'=>$fields));
			$previous['data']=$this->data;
			echo json_encode($previous);
			exit();
		}
	}

function getAllRemit($byCashier=null){

		
		$this->data['Remittance']['date_today']= date("Y-m-d",strtotime($this->data['Remittance']['created']));
		$this->data['Remittance']['date_today']=$this->data['Remittance']['date_today'].' 00:00:00';
		
		$todayDt = $this->data['Remittance']['date_today'];
		$currentDt=$this->data['Remittance']['created'];
		
		$conditions =array();
		
		if(!empty($byCashier)){
			$cashier = $this->data['Remittance']['cashier'];
			$conditions = array(
										"Remittance.created >=" => date("Y-m-d H:i:s",strtotime($todayDt)),
										"Remittance.created <" => date("Y-m-d H:i:s",strtotime($currentDt)),
										"Remittance.cashier"=>$cashier
										);
					
		}else{
			$conditions = array(
								"Remittance.created >=" => date("Y-m-d H:i:s",strtotime($this->data['Remittance']['created'].'  00:00:00')),
								"Remittance.created <=" => date("Y-m-d H:i:s",strtotime($this->data['Remittance']['created'].'  23:59:59'))
								);
		
		}
		
		
		
		$all = $this->Remittance->find('all',array('conditions'=>$conditions));
		echo json_encode($all);
		exit();
	}
	
}
