<?php
class EndingReconciliationsController extends AppController {

	var $name = 'EndingReconciliations';
	var $components = array('RequestHandler');

	function index() {
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ending reconciliation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('endingReconciliation', $this->EndingReconciliation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)){
			$this->EndingReconciliation->create();
			array_shift($this->data['EndingReconciliationDetail']);
			if ($this->EndingReconciliation->saveAll($this->data)){
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The ending reconciliation has been saved';
					$this->data['EndingReconciliation']['id']=$this->EndingReconciliation->id;
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The ending reconciliation has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
			}else{
				$this->Session->setFlash(__('The ending reconciliation could not be saved. Please, try again.', true));
			}
		}
		$products = $this->EndingReconciliation->Product->find('list');
		$this->set(compact('products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ending reconciliation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EndingReconciliation->save($this->data)) {
				$this->Session->setFlash(__('The ending reconciliation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ending reconciliation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EndingReconciliation->read(null, $id);
		}
		$products = $this->EndingReconciliation->Product->find('list');
		$this->set(compact('products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ending reconciliation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EndingReconciliation->delete($id)) {
			$this->Session->setFlash(__('Ending reconciliation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ending reconciliation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function report(){
		array_shift($this->data['EndingReconciliationDetail']);
		$data = $this->data;
		$this->set(compact('data'));
		$this->layout='pdf';
		$this->render();

	}
}
