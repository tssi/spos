<?php
class ProductsController extends AppController {

	var $name = 'Products';
    var $uses = array('Product','Perishable', 'ProductType','Counter', 'MenuItem','SaleDetail','Categories');
	var $components = array('RequestHandler');
	
	function index() {
		$productTypes = $this->Product->ProductType->find('all');
		$units = $this->Product->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));
		$categories = $this->Categories->find('list');

		$this->set(compact('productTypes', 'units','categories'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->set('product', $this->Product->read(null, $id));
	}

	function add() {
		if (!empty($this->data)){
			if(isset($this->data['Product'][0])){ //if many products 
				for($i=0;$i<count($this->data['Product']); $i++){
				
					//PROPER CASE PRODUCT NAME 
					$this->data['Product'][$i]['name'] = ucwords(strtolower($this->data['Product'][$i]['name']));
					//END
					
					//ASSIGN INIT QTY
					$this->data['Product'][$i]['init_qty'] = $this->data['Product'][$i]['qty'];
					//unset($this->data['Product'][$i]['qty']);
					//END
											
					if($this->data['Product'][$i]['item_code']=='(Auto)'){
						$prefixInHouse = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXINH')));
						$prefixInProduct = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXPRD')));
						$productType = $this->data['Product'][$i]['product_type_id'];
						
						if($productType== 'PI'){
							$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRSHBLE')));
							$this->Counter->doIncrement('PRSHBLE',1);
						}else{
							$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'SHLFITM')));
							$this->Counter->doIncrement('SHLFITM',1);
						}
						
						$assignee_code = $prefixInHouse['Counter']['value'].$prefixInProduct['Counter']['value'].$counter['Counter']['value'];
						
						$findMatch=$this->Product->findByItemCode($assignee_code);
						
						$this->data['Product'][$i]['item_code'] = $assignee_code;
						
						$typeIs = '';
							switch($productType){
								case 'SI':
									$this->data['Product'][$i]['is_consumable'] =1;
								break;
								case 'AX':
									$this->data['Product'][$i]['is_consumable'] =0;
								break;
								case 'PP':
									$this->data['Product'][$i]['is_consumable'] =0;
								break;
								case 'PI':
									$this->data['Product'][$i]['is_consumable'] =1;
								break;
								case 'SP':
									$this->data['Product'][$i]['is_consumable'] =1;
								break;
								case 'UT':
									$this->data['Product'][$i]['is_consumable'] =0;
								break;
							}
						$this->data['Product'][$i]['status']=1;
					}
					elseif (empty($this->data['Product'][$i]['item_code'])){
						unset($this->data['Product'][$i]);
					}
				}
			}else{
				if($this->data['Product']['item_code']=='(Auto)'){  //single product
					
					//PROPER CASE PRODUCT NAME 
					$this->data['Product']['name'] = ucwords(strtolower($this->data['Product']['name']));
					//END
					
					//ASSIGN INIT QTY
					$this->data['Product'][$i]['init_qty'] = $this->data['Product'][$i]['qty'];
					//unset($this->data['Product'][$i]['qty']);
					//END
					
					$prefixInHouse = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXINH')));
					$prefixInProduct = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRFXPRD')));
					$productType = $this->data['Product']['product_type_id'];
			
					if($this->data['Product']['product_type_id']== 'PI'){
						$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'PRSHBLE')));
						$this->Counter->doIncrement('PRSHBLE',1);
					}else{
						$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'SHLFITM')));
						$this->Counter->doIncrement('SHLFITM',1);
					}
					$this->data['Product']['item_code']=$prefixInHouse['Counter']['value'].$prefixInProduct['Counter']['value'].$counter['Counter']['value'];
					
					$typeIs = '';
						switch($productType){
							case 'SI':
								$this->data['Product']['is_consumable'] =1;
							break;
							case 'AX':
								$this->data['Product']['is_consumable'] =0;
							break;
							case 'PP':
								$this->data['Product']['is_consumable'] =0;
							break;
							case 'PI':
								$this->data['Product']['is_consumable'] =1;
							break;
							case 'SP':
								$this->data['Product']['is_consumable'] =1;
							break;
							case 'UT':
								$this->data['Product']['is_consumable'] =0;
							break;
						}
					$this->data['Product']['status']=0;
				}elseif (empty($this->data['Product']['item_code'])){
					unset($this->data['Product']);
					exit();
				}
			}

			//SAVING
			if ($this->Product->saveAll($this->data['Product'])) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Saving successful';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('Saving successful...', true));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The product could not be saved. Please, try again.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			}
		}
		$productTypes = $this->Product->ProductType->find('list');
		$units = $this->Product->Unit->find('list');
		$this->set(compact('productTypes', 'units'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The product has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		$productTypes = $this->Product->ProductType->find('list');
		$units = $this->Product->Unit->find('list');
		$this->set(compact('productTypes', 'units'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function findItem($id=null, $orderBy=null){
        if(!empty($id)){
			if($id!='PI'){ // if not perishable
				if(empty($orderBy)){
					$orderBy = 'Product.name';
				}
				
				//$order = array($orderBy);
				$order = array('Product.name');
				
				if ($id=="ALL"){
					$sItems = $this->Product->find('all', array('conditions'=>array('Product.status'=>1),'order'=>$order));
					
					$orderByP = 'Perishable'.strstr($orderBy , '.');
					$pItems = $this->Perishable->find('all', array('conditions'=>array('Perishable.status'=>1),'order'=>$orderByP));
					
					$items = array_merge($sItems, $pItems);
					 
					echo json_encode($items);
					exit();
				}else{
					$conditions = array('Product.product_type_id'=>$id);
					$items = $this->Product->find('all', array('conditions'=>$conditions ,'order'=>$order));
					echo json_encode($items);
					exit();
				}
				
			}
			elseif($id =='PI'){
				if(empty($orderBy)){
					$orderBy = 'Perishable.item_code';
				}else{
					$orderBy = 'Perishable'.strstr($orderBy , '.');
				}
				$order = array($orderBy);
				$perishables = $this->Perishable->find('all', array('order'=>$order));
				echo json_encode($perishables);
				exit();
			}
      }
	}
    
    function check(){
        if ($this->RequestHandler->isAjax()) {
			$itemcode= $this->data['Product']['item_code'];
			if(!empty($this->data)){
				$menuResult = $this->MenuItem->find('first', array('conditions'=>array('MenuItem.item_code'=>$itemcode)));
				$result = $this->Product->find('first',array('conditions'=>array('Product.item_code'=>$itemcode)));
				
				$response['result']=$result;
				if($result || $menuResult){
					if(isset($result['Product']['name'])){
						$response['status']="ERROR";
						$response['message']="ItemCode  found! ";
						$response['message'].="<ul>";
						$response['message'].='<li><strong>Description:<strong>'.$result['Product']['name'].'</li>';
						$response['message'].='<li><strong>Price:<strong>'.$result['Product']['selling_price'].'</li>';
						$response['message'].='<li><strong>Unit:<strong>'.$result['Unit']['name'].'</li>';
						
						$response['message'].="</ul>";
					}else{
						$response['status']="ERROR";
						$response['message']="ItemCode  found! ";
						$response['message'].="<ul>";
						$response['message'].='<li><strong>Description:<strong>'.$menuResult['MenuItem']['name'].'</li>';
						$response['message'].='<li><strong>Price:<strong>'.$menuResult['MenuItem']['selling_price'].'</li>';
						$response['message'].='<li><strong>Unit:<strong>'.$menuResult['Unit']['name'].'</li>';
						
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
	
	function search(){
		$key = '%'.$this->data['Product']['key'].'%';
		$product = $this->Product->find('all', array('conditions'=>array('Product.name LIKE'=>$key)));
		echo json_encode($product);
		exit();
	}

	function checkDesc(){
        if ($this->RequestHandler->isAjax()) {
			//$name = 'pwerty 500g');
			$name = trim($this->data['Product']['name']);
			$name = ucwords(strtolower($name));
			
			//echo $name;
			//exit();
			$result = $this->Product->find('first',array('conditions'=>array('Product.name'=>$name)));
			
			$response['result']=$result;
			
			if($result){
				if(isset($result['Product']['name'])){
					$response['status']="ERROR";
					$response['message']="<str>".$name."<str/> is already used, name it differently!";
				}
			}else{
				$response['status']="OK";
				$response['message']="Name available.";
			}
			
		}
		echo json_encode($response);
		exit();
    }
	
	function product_new() {
		$this->Product->recursive = 0;
		$productTypes = $this->Product->ProductType->find('all');
		$units = $this->Product->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));

		$this->set(compact('productTypes', 'units'));
	}
	
	function getByProductName(){
		$name = $this->data['Product']['name'];
		$cast = ucwords(strtolower($name));
		$this->data['Product']['name'] = $cast;
		$product = $this->Product->find('first', array('conditions'=>array('Product.name'=>$cast)));
		//$product['search-key']= $cast;
		if ($this->RequestHandler->isAjax()) {
			echo json_encode($product);
			exit();
		}
		exit();
	}
	
	function getByProductCode(){
		$code = $this->data['Product']['item_code'];
		$product = $this->Product->find('first', array('conditions'=>array('Product.item_code'=>$code)));
		echo json_encode($product);
		exit();
	}
	
	function getByProductId(){
		$id = $this->data['Product']['id'];
		$product = $this->Product->find('first', array('conditions'=>array('Product.id'=>$id)));
		echo json_encode($product);
		exit();
	}
	
	function getByType(){
		 if ($this->RequestHandler->isAjax()){
			if(!empty($this->data)){
				$kind  = $this->data['Product']['kind'];
				$field = $this->data['Product']['field'];
				$type = $this->data['Product']['type'];
				
				if($kind=='PI'){		
					if ($type=='within'){
						$type='LIKE';
						$key = '%'.$this->data['Product']['key'].'%';
					}else{
						$type='';
						$key = $this->data['Product']['key'];
					}
					$field = 'Perishable'.strstr($field, '.');
					$product = $this->Perishable->find('all', array('conditions'=>array(''.$field.' '.$type.''=>$key)));
					echo json_encode($product);
					exit();
				}else{
					if ($type=='within'){
						$type='LIKE';
						$key = '%'.$this->data['Product']['key'].'%';
					}else{
						$type='';
						$key = $this->data['Product']['key'];
					}
					$product = $this->Product->find('all', array('conditions'=>array(''.$field.' '.$type.''=>$key)));
					echo json_encode($product);
					exit();
				}
			}
		}
	}
	
	function update(){
		//ADJUSTING WHILE ITEM IS ON RECOUNT STATUS	
		if($this->data['Product']['is_recounting']){
			$item_sales_count = $this->SaleDetail->find('first',array(
							'conditions'=>array(
								'SaleDetail.item_code'=>$this->data['Product']['item_code'],
								'SaleDetail.created >='=>$this->data['Product']['last_recount_start_time'],
							),
							'fields'=>array('SUM(SaleDetail.qty)')
					));
			$this->data['Product']['qty'] = $this->data['Product']['qty'] - $item_sales_count[0]['SUM(`SaleDetail`.`qty`)'];
			
		}
		//REMOVE THIS AFTER INVENTORY HAS SET
		$this->data['Product']['init_qty'] = $this->data['Product']['qty']
		
		if($this->Product->saveAll($this->data)){
			if($this->RequestHandler->isAjax()){
				$response['status'] = 1;
				$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Item successfully updated';
				$response['data'] = $this->Product->read(null, $this->data['Product']['id']);
				echo json_encode($response);
				exit();
			}else{ 
				$this->Session->setFlash(__('Saving successful...', true));
			}
		} else {
			if($this->RequestHandler->isAjax()){
				$response['status'] = -1;
				$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; Item unsuccessfully updated. Please, try again.';
				$response['data'] = $this->data;
				echo json_encode($response);
				exit();
			}else{
			$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
			}
		}
	
	}
	
	function recount(){
		$productTypes = $this->Product->ProductType->find('all');
		$units = $this->Product->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));
		$this->set(compact('productTypes', 'units'));
	}
	
	function start_recounting(){
		$this->data['Product']['last_recount_start_time'] = date('Y-m-d H:i:s');
	
		if(!empty($this->data['Product']['id'])){
			if($this->Product->saveAll($this->data)){
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Item successfully updated';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('Saving successful...', true));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; Item unsuccessfully updated. Please, try again.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			}
		}
	}
	
	function stop_recounting(){
		$this->data['Product']['last_recount_stop_time'] = date('Y-m-d H:i:s');
	
		if(!empty($this->data['Product']['id'])){
			if($this->Product->saveAll($this->data)){
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Item successfully updated';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('Saving successful...', true));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; Item unsuccessfully updated. Please, try again.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
				$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			}
		}
	}
	
	function general(){
		$productTypes = $this->Product->ProductType->find('all');
		$units = $this->Product->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));
		$this->set(compact('productTypes', 'units'));
	}
}
