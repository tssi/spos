<?php
class MenuItemsController extends AppController {

	var $name = 'MenuItems';
	var $uses = array('MenuItem', 'Counter', 'Product','SetMeal');
	var $components = array('RequestHandler');

	function index() {
		$this->MenuItem->recursive = 0;
		//$this->set('menuItems', $this->paginate());	
		$units = $this->MenuItem->Unit->find('list',array(
												'fields'=>array('Unit.id','Unit.alias'),
												'conditions'=>array('Unit.id != '=>'7'),
											));
		$this->set(compact('units'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid menu item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('menuItem', $this->MenuItem->read(null, $id));
	}	
	function add(){
		if (!empty($this->data)) {
			if(isset($this->data['MenuItem'][0])){
				for($i=0;$i<count($this->data['MenuItem']); $i++){
					$itemcode = trim($this->data['MenuItem'][$i]['item_code']);
					if($itemcode=='(Auto)'){
						$name = $this->data['MenuItem'][$i]['name'];
						$cast = ucwords(strtolower($name));
						$this->data['MenuItem'][$i]['name'] = $cast;
						
						$prefixInHouse = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXINH')));
						$prefixInMenu = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXMNU')));
						$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'MENUITM')));
						$this->data['MenuItem'][$i]['item_code']=$prefixInHouse['Counter']['value'].$prefixInMenu['Counter']['value'].$counter['Counter']['value'];
						$this->Counter->doIncrement('MENUITM',1);					
					}
					elseif (empty($itemcode)){
						unset($this->data['MenuItem'][$i]);
					}
				} 
				if ($this->MenuItem->saveAll($this->data['MenuItem'])) {
						if($this->RequestHandler->isAjax()){
							$response['status'] = 1;
							$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The menu has been saved';
							$response['data'] = $this->data;
							echo json_encode($response);
							exit();
						}else{ 
							$this->Session->setFlash(__('The menu has been saved', true));
						}
					} else {
						if($this->RequestHandler->isAjax()){
							$response['status'] = -1;
							$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The menu could not be saved. Please, try again.';
							$response['data'] = $this->data;
							echo json_encode($response);
							exit();
						}else{
						$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
						}
					}				
			}else{//Set Meal
				if($this->data['MenuItem']['unit_id']=='7'){	
					//pr($this->data);exit;
					$this->SetMeal->deleteAll(array('SetMeal.menu_item_id' => $this->data['MenuItem']['id']), true);	

					array_shift($this->data['SetMeal']);
					$itemcode = trim($this->data['MenuItem']['item_code']);
					if($itemcode=='(Auto)'){
						$name = $this->data['MenuItem']['name'];
						$cast = ucwords(strtolower($name));
						$this->data['MenuItem']['name'] = $cast;
						
						$prefixInHouse = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXINH')));
						$prefixInMenu = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXMNU')));
						$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'MENUITM')));
						$this->data['MenuItem']['item_code']=$prefixInHouse['Counter']['value'].$prefixInMenu['Counter']['value'].$counter['Counter']['value'];
						$this->Counter->doIncrement('MENUITM',1);					
					}
					if ($this->MenuItem->saveAll($this->data)) {
						if($this->RequestHandler->isAjax()){
							$response['status'] = 1;
							$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Set meal has been saved';
							$response['data'] = $this->data;
							echo json_encode($response);
							exit();
						}else{ 
							$this->Session->setFlash(__('Set meal has been saved', true));
						}
					} else {
						if($this->RequestHandler->isAjax()){
							$response['status'] = -1;
							$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; Set meal could not be saved. Please, try again.';
							$response['data'] = $this->data;
							echo json_encode($response);
							exit();
						}else{
						$this->Session->setFlash(__('Set meal could not be saved. Please, try again.', true));
						}
					}				
				}
				
			}
			
			
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid menu item', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MenuItem->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The menu has been edited';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The menu has been edited', true));
					//$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('The menu item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MenuItem->read(null, $id);
		}
		$units = $this->MenuItem->Unit->find('list');
		$this->set(compact('units'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu item', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MenuItem->delete($id)) {
			$this->Session->setFlash(__('Menu item deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu item was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    function findMenu(){
		$menus = $this->MenuItem->find('all', array('order'=>array('MenuItem.name')));
		echo json_encode($menus);
		exit();
	}
   
	function check(){
        if ($this->RequestHandler->isAjax()) {
			if(!empty($this->data)){
				$itemcode= $this->data['MenuItem']['item_code'];
				$productResult =$this->Product->find('first',array('conditions'=>array('Product.item_code'=>$itemcode)));
				
				$result = $this->MenuItem->find('first',array('conditions'=>array('MenuItem.item_code'=>$itemcode)));
				$response['result']=$result;
				if($result || $productResult){
					if(isset($result['MenuItem']['name'])){
						$response['status']="ERROR";
						$response['message']="ItemCode  found! ";
						$response['message'].="<ul>";
						$response['message'].='<li><strong>Description:<strong>'.$result['MenuItem']['name'].'</li>';
						$response['message'].='<li><strong>Price:<strong>'.$result['MenuItem']['selling_price'].'</li>';
						$response['message'].='<li><strong>Unit:<strong>'.$result['Unit']['name'].'</li>';
						
						$response['message'].="</ul>";
					}else{
						$response['status']="ERROR";
						$response['message']="ItemCode  found! ";
						$response['message'].="<ul>";
						$response['message'].='<li><strong>Description:<strong>'.$productResult['Product']['name'].'</li>';
						$response['message'].='<li><strong>Price:<strong>'.$productResult['Product']['selling_price'].'</li>';
						$response['message'].='<li><strong>Unit:<strong>'.$productResult['Product']['name'].'</li>';
						
						$response['message'].="</ul>";
					
					}
					
				}else{
					$response['status']="OK";
					$response['message']="ItemCode available.";
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
	
	function checkDesc(){
        if ($this->RequestHandler->isAjax()) {
			
			$name = trim($this->data['MenuItem']['name']);
			$beforeConvrt = $name;
			$name = ucwords(strtolower($name));
			
			//echo $name;
			//exit();
			$result = $this->MenuItem->find('first',array('conditions'=>array('MenuItem.name'=>$name)));
			
			$response['result']=$result;
			
			if($result){
				if(isset($result['MenuItem']['name'])){
					$response['status']="ERROR";
					$response['message']="<str>".$beforeConvrt."<str/> is already used, name it differently!";
				}
			}else{
				$response['status']="OK";
				$response['message']="Name available.";
			}
			
		}
		echo json_encode($response);
		exit();
    }
	
	function menu_items_new() {
		$this->MenuItem->recursive = 0;
		$units = $this->MenuItem->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));
		$this->set(compact('units'));
	}
	
	function search(){
		$key = '%'.$this->data['MenuItem']['key'].'%';
		//$key = '%H%';
		
		//$field = $this->data['Product']['field'];
		
		$menu = $this->MenuItem->find('all', array('conditions'=>array('MenuItem.name LIKE'=>$key), 'fields'=>array('MenuItem.name')));
		echo json_encode($menu);
		exit();
		
	}
	
	function getByMenuItemCode(){
		$code = $this->data['MenuItem']['item_code'];
		$menu = $this->MenuItem->find('first', array('conditions'=>array('MenuItem.item_code'=>$code)));
		echo json_encode($menu);
		exit();
	}
	
	function getComponents(){
		if ($this->RequestHandler->isAjax()) {
			$id = $this->data['id'];
			$data = $this->MenuItem->find('first',array('recursive'=>2,
							'conditions'=>array('MenuItem.id'=>$id),
			));
			echo json_encode($data);
			exit();
		}
	}
	
	function hot_meals() {
		$this->MenuItem->recursive = 0;
		//$this->set('menuItems', $this->paginate());	
		$units = $this->MenuItem->Unit->find('list',array(
												'fields'=>array('Unit.id','Unit.alias'),
												'conditions'=>array('Unit.id != '=>'7'),
											));
		$this->set(compact('units'));
	}
	
}
