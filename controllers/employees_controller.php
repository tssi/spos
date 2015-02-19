<?php
class EmployeesController extends AppController {

	var $name = 'Employees';
	var $uses = array('Employee','SopCgeVal');

	function index() {
		$this->Employee->recursive = 0;
		$this->set('employees', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid employee', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('employee', $this->Employee->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Employee->create();
			if ($this->Employee->save($this->data)) {
				$this->Session->setFlash(__('The employee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid employee', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Employee->save($this->data)) {
				$this->Session->setFlash(__('The employee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Employee->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for employee', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Employee->delete($id)) {
			$this->Session->setFlash(__('Employee deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Employee was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function checkBal(){
		$bal = $this->SopCgeVal->checkBal($this->data['Sale']['buyer']);
		echo json_encode($bal);
		exit();
	}

	function search(){
		$full_name = '%'.$this->data['Employee']['trimmed_name'].'%';
		$search = $this->Employee->find('all',
										array(	'conditions'=>array('Employee.full_name LIKE'=>$full_name),
												'fields'=>array('Employee.id','Employee.full_name','Employee.first_name','Employee.last_name','Employee.middle_name')
										)						
								);
		//pr($search);exit;
		$this->set('search',$search);
		$this->layout='json';
		$this->render();
	}
}
