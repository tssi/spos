<?php
class NavigationsController extends AppController {

	var $name = 'Navigations';
	
	function beforeFilter(){
		parent::beforeFilter();
	}
	function index() {
		$nav_tree = $this->Navigation->find('threaded', array(
					'fields' => array('id', 'title', 'link','lft', 'rght', 'parent_id'), 
					'order' => 'id ASC'
					));
		$this->Navigation->recursive = 0;
		$this->paginate= isset($_GET['level'])? array('conditions'=>array('Navigation.level'=>$_GET['level'])):null;
		$Navigations =  $this->paginate('Navigation');
		$this->set(compact('Navigations','nav_tree'));
	}
	

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Navigation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('Navigation', $this->Navigation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$format = $format = array(
				'title' => $this->data['Navigation']['title'],	
				'link' => $this->data['Navigation']['link'],	
				'parent_id' =>  $this->data['Navigation']['parent_id']
			);
			$this->Navigation->create();
			if ($this->Navigation->save($format)) {
				$this->Session->setFlash(__('The Navigation has been saved', true));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The Navigation could not be saved. Please, try again.', true));
			}
		}else{
			$level = isset($_GET['level'])?$_GET['level']:null;
			$this->set('parents',$this->Navigation->find('list', array('conditions'=>array('Navigation.level'=>$level))));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Navigation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			if ($this->Navigation->save($this->data)) {
				$this->Navigation->move($id, $this->data['Navigation']['parent_id'], 'firstChild');
				$this->Session->setFlash(__('The Navigation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Navigation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Navigation->read(null, $id);
			$this->set('parents',$this->Navigation->find('list',array('conditions'=>array('Navigation.id !='=>$this->data['Navigation']['id']))));
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Navigation', true));
			$this->redirect(array('action'=>'index'));
		}else{
			$this->Navigation->removeFromTree($id, false); 
			if ($this->Navigation->delete($id)) {
				$this->Session->setFlash(__('Navigation deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Navigation was not deleted', true));
			$this->redirect(array('action' => 'index'));
		}
	}
}
