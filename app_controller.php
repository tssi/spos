<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	var $helpers = array('Html', 'Tree', 'Session', 'Form','Jsmin');
	var $components = array('Auth', 'Session');
	
	function beforeFilter(){
		
		App::Import('Model','RequestObject');
		App::Import('Model','ControlObject');
		
		$this->RequestObject = new RequestObject;
		$this->ControlObject = new ControlObject;
		
		$this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'display','home');
		$this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display','home');
		$user =  $this->Session->read('Auth.User');
		
		//pr($_SESSION);
		//exit();
		
		$this->Session->write('OLDUSER',$this->Session->read('NEWUSER'));
		$this->Session->write('NEWUSER',$user['id']);
		
		//Load on Session SystemsDefault
		if(!$this->Session->check('SystemsDefault')||$this->Session->read('NEWUSER')!=$this->Session->read('OLDUSER')){
			App::Import('Model', 'SystemsDefault');
			$this->SystemsDefault = new SystemsDefault;
			$systemsDefault = $this->SystemsDefault->find('all');
			$SYS_DEF = array();
			foreach($systemsDefault as $default){
				$SYS_DEF[$default['SystemsDefault']['field']] = $default['SystemsDefault']['value'];
			}
			$this->Session->write('SystemsDefault',$SYS_DEF);
		}
	
		//Allowed Navigation
		if(!$this->Session->check('Navigation')||$this->Session->read('NEWUSER')!=$this->Session->read('OLDUSER')||1){
			App::Import('Model','Role');
			$this->Role = new Role;
			
			$roles = $this->Role->find('all',array('fields'=>array('Role.navigation_id'),'conditions'=>array('Role.group_id'=>$user['group_id'])));
			
			if(!isset($user['group_id'])){
				$roles = $this->Role->find('all',array('fields'=>array('Role.navigation_id'),'conditions'=>array('Role.group_id'=>0)));
			}
			$lists =  array();
			foreach($roles as $r){
				array_push($lists,$r['Role']['navigation_id']);
			}
			$this->Session->write('Role',$lists);
			
			
			
			App::Import('Model','Navigation');
			$this->Navigation = new Navigation;
			$navigation = $this->Navigation->find('threaded', array(
					'fields' => array('id', 'title', 'uri','lft', 'rght', 'parent_id'), 
					'order' => array('Navigation.id'=>'ASC'),
					//'order' => array('Navigation.indx'=>'ASC'),
					'conditions'=>array('Navigation.id'=>$this->Session->read('Role'))
					));
			
			//pr($navigation);		
			//exit();
			
			$this->Session->write('Navigation',$navigation);
			$controlObjects  =null;
			if(!isset($user['group_id'])){
				$controlObjects = $this->ControlObject->find('all',array(	'conditions'=>array('ControlObject.group_id'=>0),
																		'fields'=>array('ControlObject.uri')));
			}else{
				$controlObjects = $this->ControlObject->find('all',array(	'conditions'=>array('ControlObject.group_id'=>$user['group_id']),
																		'fields'=>array('ControlObject.uri')));
			}															
			$this->Session->write('ControlObject',null);
			$this->Session->write('ControlObject',$controlObjects);
			
		}
		
		if(!$this->Session->check('AllowedURL')||$this->Session->read('NEWUSER')!=$this->Session->read('OLDUSER')){
			$allowed_url=array();
			//Access Layer One
			foreach($this->Session->read('Navigation') as $nav){
				array_push($allowed_url,$nav['Navigation']['uri']);
				foreach($nav['children'] as $child){
					array_push($allowed_url,$child['Navigation']['uri']);
					foreach($child['children'] as $gchild){
						array_push($allowed_url,$gchild['Navigation']['uri']);
					}
				}
			}
			//Access Layer Two
			foreach($this->Session->read('ControlObject') as $ctrl){
				array_push($allowed_url,$ctrl['ControlObject']['uri']);
			}
			$this->Session->write('AllowedURL',$allowed_url);
		}
			
		//pr($_SESSION['Navigation']);
		//exit();
		
		if(1){
			
			$URL = $this->params['controller'].'/'.$this->params['action'];
			$link = $this->params['controller'];
			$action = $this->params['action'];
			$group_id = isset( $_SESSION['Auth'])?$_SESSION['Auth']['User']['group_id']:0;
			$request_exist = $this->ControlObject->find('first', array('conditions'=>array('RequestObject.link'=>$link)));
		
			$control_exist = $this->ControlObject->find('first', array('conditions'=>array('ControlObject.action'=>$action,'ControlObject.group_id'=>$group_id)));
			
		
			if(1){
				if(!in_array($URL,$this->Session->read('AllowedURL'))){
					//-----------
					/* echo '<pre>';
					echo 'not allowed <br/>';
					print_r($request_exist['RequestObject']);
					exit(); */
					//-----------
					if (!count($request_exist['RequestObject'])){
						$name =Inflector::humanize($this->params['controller']);
						$this->RequestObject->create();
						$data['RequestObject']['name'] = $name;
						$data['RequestObject']['link'] = $link;
						$this->RequestObject->save($data);
						$ROBJid = $this->RequestObject->id;						
						$data['ControlObject']['group_id'] = $group_id;
						$data['ControlObject']['action'] = $action;
						$data['ControlObject']['request_object_id'] = $ROBJid;
						$this->ControlObject->save($data);
					}else if(!count($control_exist['ControlObject'])){
						$data['ControlObject']['group_id'] = $group_id;
						$data['ControlObject']['action'] = $action;
						$data['ControlObject']['request_object_id'] = $request_exist['RequestObject']['id'];;
						$this->ControlObject->save($data);
					}
				}
			}
		}
		
		//Record activity
		App::Import('Model','Activity');
		$this->Activity = new Activity;
		$data = array('Activity'=>array());
		if(!empty($_REQUEST)){
			$data['Activity']['actor'] = $user['id'];
			$data['Activity']['action'] = $this->params['action'];
			$data['Activity']['object'] = $this->params['controller'];
			$data['Activity']['details'] =json_encode($_REQUEST);
			$data['Activity']['timestamp'] =time()+(7*60*60);
			$data['Activity']['created'] =date('Y-m-d H:i:s',time()+(7*60*60));
			$this->Activity->save($data);
		}
		//Check if requested uri is in the allowed url stack
		$URL = $this->params['controller'].'/'.$this->params['action'];
		
		//pr($_SESSION);
		//exit();
		
		if(!in_array($URL,$this->Session->read('AllowedURL'))&&!in_array($_SERVER['REQUEST_URI'],$this->Session->read('AllowedURL'))){
			//$this->Session->setFlash(__('Access denied on '. $this->params['controller'].'/'.$this->params['action'].' !', true));
			//$this->redirect("/");
		}
	
		$systemsDefault = $this->Session->read('SystemsDefault');
		$this->set('SystemsDefault',$this->Session->read('SystemsDefault'));
		$this->set('navigation_layout',$this->Session->read('Navigation'));
		$this->set('title',$systemsDefault['SCHOOL_NAME']);
		$this->set('user',$user);
		
	}	

}
