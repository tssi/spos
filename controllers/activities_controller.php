<?php
class ActivitiesController extends AppController {

	var $name = 'Activities';

	function index() {
		$this->Activity->recursive = 0;
		$this->set('activities', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid activity', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('activity', $this->Activity->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Activity->create();
			if ($this->Activity->save($this->data)) {
				$this->Session->setFlash(__('The activity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid activity', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Activity->save($this->data)) {
				$this->Session->setFlash(__('The activity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Activity->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for activity', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Activity->delete($id)) {
			$this->Session->setFlash(__('Activity deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Activity was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function feeds(){
		$key =  '%'.$this->data['Activities']['key'].'%';
		$joins = array(
						array(
						'table' => 'users',
						'alias' => 'User',
						'type' => 'inner',
						'conditions' => array('User.id = Activity.actor')
						)
					);
		$conditions = array('Activity.details LIKE'=>$key);
		$fields = array('User.first_name',
						'User.last_name',
						'User.username',
						'Activity.object',
						'Activity.action',
						'Activity.details',
						'Activity.timestamp');
		$feeds = $this->Activity->find('all',array('joins'=>$joins,'conditions'=>$conditions, 'fields'=>$fields));
		$feed_ctr = 0;
		foreach($feeds as $feed){
			$mark_up  ='<div class="user">'.$feed['User']['first_name'].' '.$feed['User']['last_name'].'</div>';
			$mark_up .='<div class="activity"><a class="detail_viewer" href="javascript:void(0)">+</a>&nbsp;&nbsp;&nbsp;';
			$mark_up .='<a class="hot_button ajax_runner" href="javascript:void(0)" run="1" link="/isms/'.$feed['Activity']['object'].'/'.$feed['Activity']['action'].'">';
			$mark_up .='<span class="object">'.$feed['Activity']['object'].'</span>';
			$mark_up .='<span class="separator">/</span>';
			$mark_up .='<span class="action">'.$feed['Activity']['action'].'</span></a>';
			$mark_up .='</div>';
			$feeds[$feed_ctr++]['markup']=$mark_up;
		}
		$this->set('feeds',$feeds);
		
		$this->layout='json';
		$this->render();
	}
}
