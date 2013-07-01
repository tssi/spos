<?php
class SetMealsController extends AppController {

	var $name = 'SetMeals';
	var $uses = array('SetMeal','MenuItem', 'Unit','Product','Counter');
	var $components = array('RequestHandler');

	function index() {
		$this->SetMeal->recursive = 0;
		$this->set('setMeals', $this->paginate());

		$units = $this->MenuItem->Unit->find('list',array('fields'=>array('Unit.id','Unit.alias')));
		$this->set(compact('units'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid set meal', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('setMeal', $this->SetMeal->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SetMeal->create();
			if ($this->SetMeal->saveAll($this->data)) {
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
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; No menu item added. Please, select menu on master list .';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
				$this->Session->setFlash(__('No menu item added. Please, select menu on master list .', true));
				}
			}
		}
		$menuItems = $this->SetMeal->MenuItem->find('list');
		$this->set(compact('menuItems'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid set meal', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SetMeal->save($this->data)) {
				$this->Session->setFlash(__('The set meal has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The set meal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SetMeal->read(null, $id);
		}
		$menuItems = $this->SetMeal->MenuItem->find('list');
		$this->set(compact('menuItems'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for set meal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SetMeal->delete($id)) {
			$this->Session->setFlash(__('Set meal deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Set meal was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function MerchandiseItems(){
		$data = $this->Product->find('all', array('order'=>array('Product.name'),
										'conditions'=>array('Product.product_type_id'=>'SI'),
										));
		echo json_encode($data);
		exit();
	}
	function MenuItems(){
		$data = $this->MenuItem->find('all', array('order'=>array('MenuItem.name'),
										'conditions'=>array('MenuItem.unit_id != '=>7),
										));
		echo json_encode($data);
		exit();
	}
	function validate_duplicate(){
		$data = $this->MenuItem->find('first',array('recursive'=>2,
										'conditions'=>array('MenuItem.name'=>$this->data['name']),
										));
		echo json_encode($data);
		exit();
	}
	
	function autocomplete(){
		$key = '%'.$this->data['MenuItem']['key'].'%';
		$data = $this->MenuItem->find('all', array(
										'conditions'=>array('MenuItem.name LIKE'=>$key,
																'MenuItem.unit_id'=>7),
										'fields'=>array('MenuItem.name')
										));
		echo json_encode($data);
		exit();
		
	}

}
