<?php
App::import('Vendor', 'cross_talk');
class PettyCashesController extends AppController {

	var $name = 'PettyCashes';
	var $uses= array('PettyCash','Counter');
	var $components = array('RequestHandler');

	function index() {
		$counter = $this->Counter->findById('PTYCASH');
		$this->set('ref_no',$counter['Counter']['value']);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid petty cash', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pettyCash', $this->PettyCash->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PettyCash->create();
			if ($this->PettyCash->save($this->data)) {
				$this->Counter->doIncrement('PTYCASH',1);
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The petty cash has been saved';
					$this->data['PettyCash']['id']=$this->PettyCash->id;
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The petty cash has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
				
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The petty cash could not be saved. Please, try again.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
				$this->Session->setFlash(__('The petty cash could not be saved. Please, try again.', true));
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid petty cash', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PettyCash->save($this->data)) {
				$this->Session->setFlash(__('The petty cash has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The petty cash could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PettyCash->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for petty cash', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PettyCash->delete($id)) {
			$this->Session->setFlash(__('Petty cash deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Petty cash was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function employeefind(){
		if($this->RequestHandler->isAjax()){
			$data= array(
							'Employee'=>array(
									'key'=>$this->data['PettyCash']['employee']
								)
						);
			
			echo json_encode(Cross_Talk::post('http://localhost:85/isms/api/v1/employeefind', array('data'=>json_encode($data))),true);
			exit();
		}
	
	}
	
	function getAll(){
		if($this->RequestHandler->isAjax()){
			$pty=$this->PettyCash->find('all');
			echo json_encode($pty);
			exit();
		}
	}
	function getEmpPetty(){
		if($this->RequestHandler->isAjax()){
			$emp=$this->data['PettyCash']['employee'];
			$pty = $this->PettyCash->find('all', array('condition'=>array('PettyCash.employee'=>$emp)));
			echo json_encode($pty);
			exit();
		}
	}
}
