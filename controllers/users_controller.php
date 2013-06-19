
<?php
class UsersController extends AppController {
	
	var $name = 'Users';
	var $components = array('RequestHandler');
	var $uses = array('User');
	function beforeFilter() {
		parent::beforeFilter();
		if(!$this->Session->read('Auth.User')){
			$this->Auth->allow('login','register','check');
		}
	}
	function login() {
		
	}
	
	function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
	function register() {
		if ($this->data) {
			$this->data['User']['group_id']=9; //USER Group id
			if ($this->data['User']['password'] ==$this->Auth->password($this->data['User']['confirm_password'])) {
				$this->User->create();
				if($this->User->save($this->data)){
					$this->Session->setFlash(__('User created', true));	
					$this->redirect('/');
				}
			}
		}
	}
	
	function check(){
		if ($this->RequestHandler->isAjax()) {
			if(!empty($this->data)){
				$result = $this->User->find('count',array('conditions'=>array('User.username'=>$this->data['User']['username'])));
				$response['result']=$result;
				if($result){
					$response['status']="ERROR";
					$response['message']="Username unavailable.";
				}else{
					$response['status']="OK";
					$response['message']="Username available.";
				}
			}else{
				$response['status']="ERROR";
				$response['message']="Empty data.";
			}
		}
		echo json_encode($response);
		Configure::write('debug', 0);
		exit;
	}
	
	function me(){
		$this->data = $this->Auth->user();
	}
	function change($field = null ,$id=null){
		$response =  array();
		if ($this->RequestHandler->isAjax()) {
			if($field==null||$id==null){
				$response['status']="ERROR";
				$response['message']="Field name or ID invalid!";
			}else{
				if(empty($this->data)){
					$response['status']="WARNING";
					$response['message']="Empty data.";
				}else{
					switch($field){
						case 'info':
							$user =  $this->User->read(null, $id);
							if ($user['User']['password'] == $this->data['User']['password']) {
								$this->data['User']['id']=$id;
								$this->User->save($this->data);
								$response['status']="OK";
								$response['message']="User information changed. You need to login again.";
							}else{
								$response['status']="ERROR";
								$response['message']="Password incorrect. Could not apply changes.";
							}
							break;
						case 'password':
							$user =  $this->User->read(null, $id);
							if ($user['User']['password'] == $this->Auth->password($this->data['User']['old_password'])) {
								$this->data['User']['id']=$id;
								$this->data['User']['password']= $this->Auth->password($this->data['User']['confirm_password']);
								$this->User->save($this->data);
								$response['status']="OK";
								$response['message']="Password changed. You need to login again.";
							}else{
								$response['status']="ERROR";
								$response['message']="Password incorrect.Could not change password.";
							}
					}
				}
				
			}	
			echo json_encode($response);
			Configure::write('debug', 0);
			exit;
		}
	}
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($username = null) {
		if (!$username) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$userInfo = $this->User->find('first',array('conditions'=>array('User.username'=>$username)));
		$this->set('userInfo', $this->User->read(null, $userInfo['User']['id']));
	}
	

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}else{
			$groups =  $this->User->Group->find('list');
			$this->set(compact('groups'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
			$groups =  $this->User->Group->find('list');
			$this->set(compact('groups'));
		}
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function find(){
		//$this->data['User']['key']='user';
		if($this->RequestHandler->isAjax()){
			$key = '%'.$this->data['User']['key'].'%';
			$find = $this->User->find('all', array('conditions'=>array('User.userFull LIKE'=>$key, 'User.is_collector'=>1), 'fields'=>array('User.userFull', 'User.id')));
			echo json_encode($find);
			exit();
		}
	}
	
}