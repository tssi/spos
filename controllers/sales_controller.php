<?php
class SalesController extends AppController {

	var $name = 'Sales';
	var $components = array('RequestHandler');
	var $uses= array('Sale',
					'SaleDetail',
					'Counter',
					'Product',
					'DailyMenu',
					'Employee',
					'PaymentType',
					'SopCgeTran', 
					'SopCgeVal', 
					'SopPpTran', 
					'SopPpVal',
					'Charge201',
					'Prepaid201',
					'MenuItem',
					);

	function index(){
		$this->Employee->find('list');
		$paymentTypes = $this->PaymentType->find('list');
		$this->set(compact('paymentTypes'));
	}

	function view($id = null){
		if (!$id) {
			$this->Session->setFlash(__('Invalid sale', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sale', $this->Sale->read(null, $id));
	}

	function add(){
		if (!empty($this->data)) {
			$this->Sale->create();
			$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'INVOICE')));
			$this->data['Sale']['id']=$counter['Counter']['value'];
			$this->Counter->doIncrement('INVOICE',1);
			
			
			$salesPayments = json_decode($this->data['Sale']['payment'], true);
			$this->data['SalePayment']=array();
			foreach($salesPayments as $payment){
				$byPayment =  array(
					'sale_id'=>$this->data['Sale']['id'],
					'payment_type_id'=>$payment['SalesPayment']['payment_type_id'],
                    'amount' =>$payment['SalesPayment']['amount'],
				);
				array_push($this->data['SalePayment'],$byPayment);
			}
			//-------------------
			$newSaleDetail=array();
			
			for($t=0;$t<count($this->data['SaleDetail']);$t++){
				$index = $this->data['SaleDetail'][$t]['item_code'];
				
				if(!isset($newSaleDetail[$index])){
					$newSaleDetail[$index]=array(
						'item_code' => $this->data['SaleDetail'][$t]['item_code'],
						'name' => $this->data['SaleDetail'][$t]['name'],
						'qty' => $this->data['SaleDetail'][$t]['qty'],
						'price' => $this->data['SaleDetail'][$t]['price'],
						'amount' => $this->data['SaleDetail'][$t]['amount'],
						'is_setmeal' => $this->data['SaleDetail'][$t]['is_setmeal'],
					);
				}else{
					$newSaleDetail[$index]['qty']+=$this->data['SaleDetail'][$t]['qty'];
					$newSaleDetail[$index]['amount']+=$this->data['SaleDetail'][$t]['amount'];
				}			
			}
			
			$this->data['SaleDetail']=$newSaleDetail;
			array_shift($this->data['SaleDetail']);
			unset($this->Sale->SaleDetail->validate['sale_id']);
			
			//pr($this->data);
			//exit();
			//------------------
			if ($this->Sale->saveAll($this->data,array('validate'=>'first'))) {
				
				$currentSale = $this->Sale->SalePayment->find('all', array('conditions'=>array('Sale.id'=>$this->Sale->id)));
				
				//pr($currentSale);
				//exit();
					
				foreach($currentSale as $paymentIs){ //get charged to deduct to credit
					if($paymentIs['PaymentType']['name']=='CHAR'){ //if to charge account
						$chAcount=$this->Charge201->find('first', array('conditions'=>array(
											'Charge201.reference'=>$paymentIs['Sale']['buyer'],
											'Charge201.category'=>$this->data['Sale']['category']
											)));
						$this->SopCgeTran->create();
						$chargeTransaction = array(
								'charge201_id'=>$chAcount['Charge201']['id'],
								'doc_number'=>$paymentIs['Sale']['id'],
								'amount'=>$paymentIs['SalePayment']['amount'],
								'flag'=>1,
							);
						if($this->SopCgeTran->save($chargeTransaction)){
							$bal = $this->SopCgeVal->findByCharge201Id($chAcount['Charge201']['id']);
							$this->SopCgeVal->id = $bal['SopCgeVal']['id'];
														$this->SopCgeVal->save(
											array(
												'SopCgeVal'=>array(
													'charge201_id'=>$chAcount['Charge201']['id'],
													'amount_balance'=>$bal['SopCgeVal']['amount_balance']-$paymentIs['SalePayment']['amount']
													)
												)
											);			
						};
						break;
					}
					if($paymentIs['PaymentType']['name']=='PREP'){ //if to prepaid account
						$pdAcount=$this->Prepaid201->find('first', array('conditions'=>array(
											'Prepaid201.reference'=>$paymentIs['Sale']['buyer'],
											'Prepaid201.category'=>$this->data['Sale']['category']
											)));
						
											
						$this->SopPpTran->create();
						$prepaidTransaction = array(
								'prepaid201_id'=>$pdAcount['Prepaid201']['id'],
								'doc_number'=>$paymentIs['Sale']['id'],
								'amount'=>$paymentIs['SalePayment']['amount'],
								'flag'=>1,
							);
						if($this->SopPpTran->save($prepaidTransaction)){
							$bal = $this->SopPpVal->findByPrepaid201Id($pdAcount['Prepaid201']['id']);
							
							$this->SopPpVal->id = $bal['SopPpVal']['id'];
							$this->SopPpVal->save(
											array(
												'SopPpVal'=>array(
													'prepaid201_id'=>$pdAcount['Prepaid201']['id'],
													'amount_balance'=>$bal['SopPpVal']['amount_balance']-$paymentIs['SalePayment']['amount']
													)
												)
											);			
						};
						break;
					}
				
				}
				foreach($this->data['SaleDetail'] as $dtl){
					$product = $this->Product->find('first',array('conditions'=>array('Product.item_code'=>$dtl['item_code'])));
					if(isset($product['Product']['id'])){
						$this->Product->doIncrement($product['Product']['id'],-$dtl['qty']);
					}
					$Date = date('Y-m-d');
					
					$conditions = array(
						'MenuItem.item_code'=>$dtl['item_code'],
						'DailyMenu.date =' =>$Date,
					);
					$daily_menu = $this->DailyMenu->find('first',array('conditions'=>$conditions,
						'order'=>'DailyMenu.created DESC'));
					
					if(isset($daily_menu['DailyMenu']['id'])){
						$this->DailyMenu->doIncrement($daily_menu['DailyMenu']['id'],-$dtl['qty']);
					}
				}
				
						
				
				
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; The transaction has been saved';
					$this->data['Sale']['id']=$this->Sale->id;
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The transaction has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The transaction could not be saved. Please, try again.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.', true));
				}
			}
		}
		$paymentTypes = $this->Sale->PaymentType->find('list');
		
		$this->set(compact('paymentTypes'));
	}

	function edit($id = null){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sale', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sale->save($this->data)) {
				$this->Session->setFlash(__('The sale has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sale->read(null, $id);
		}
		$paymentTypes = $this->Sale->PaymentType->find('list');
		$this->set(compact('paymentTypes'));
	}

	function delete($id = null){
		if (!$id){
			$this->Session->setFlash(__('Invalid id for sale', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sale->delete($id)) {
			$this->Session->setFlash(__('Sale deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sale was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function sale_or(){
		$invoice_no=$this->data['Sale']['id'];
		$joins=array(
					 array(
						'table'=>'menu_items',
						'alias'=>'MenuItem',
						'type'=>'left',
						'conditions'=>array('SaleDetail.item_code=MenuItem.item_code'),
					), 
					array(
						'table'=>'products',
						'alias'=>'Produkto',
						'type'=>'left',
						'conditions'=>array('SaleDetail.item_code=Produkto.item_code'),
					),
				);
		$fields=array('SaleDetail.item_code',
						'Sale.id',
						'SaleDetail.amount',
						'SaleDetail.qty',
						'SaleDetail.is_setmeal',
						'Sale.total',
						'Sale.amount_received',
						'Produkto.name',
						'MenuItem.name',
						'Produkto.unit_id',
						'MenuItem.unit_id',
					);
		
		$details= $this->Sale->SaleDetail->find('all',array('conditions'=>array('Sale.id'=>$invoice_no),'joins'=>$joins,'fields'=>$fields));
		$header = $this->Sale->find('first',array('conditions'=>array('Sale.id'=>$invoice_no)));

		$this->set(compact('details','invoice_no', 'header'));
		$this->layout='pdf';
		$this->render();
	}
	
	function daily_report($byCashier=null){
		
		$Date= $this->data['Sale']['date'];
		if(empty($Date)){
			$Date = date('Y-m-d');
		}
		
		$fromDate= date("Y-m-d H:i:s",strtotime($Date.' 00:00:00'));
		$toDate = date("Y-m-d H:i:s",strtotime($Date.'  23:59:59'));
		
		$join =array(
				array(
					'table' => 'products',
					'alias' => 'Prod',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array(
								'Prod.item_code = SaleDetail.item_code'
							)
				
				),
				array(
					'table' => 'menu_items',
					'alias' => 'Menu',
					'type' => 'left',
					'foreignKey' => false,
					'conditions' => array(
								'Menu.item_code = SaleDetail.item_code'
							)
				
				)
		);	
			
		$field = array(	
				'Sale.id',
				'Sale.total',
				'SaleDetail.item_code',
				'SaleDetail.id',
				'SaleDetail.sale_id',
				'SaleDetail.qty',
				'SaleDetail.amount',
				'Prod.product_type_id',
				'Menu.name',
				'Prod.name',
				'Prod.id',
				'Menu.selling_price',
				'Prod.selling_price'
				);	
		
		
        $conditions = array("Sale.created >=" =>$fromDate,
							"Sale.created <=" =>$toDate,
							"SaleDetail.is_setmeal !="=>1
							);
		
		
		if(!empty($byCashier)){
			$conditions['Sale.cashier ='] = $byCashier;
		}
		
		$daily = $this->Sale->SaleDetail->find('all', array('conditions'=>$conditions, 'fields'=>$field, 'joins'=>$join, 'recursive'=>2));
		 $conditions = array("Sale.created >=" =>$fromDate,
							"Sale.created <=" =>$toDate,
							);
		
		$dailySale = $this->Sale->find('all', array('conditions'=>$conditions));
		
		
		$report = array();
		$food = array();
		$shelf = array();
		$byOr = array();
		$data = null;
		$foodTotal= 0.00;
		$shelfTotal= 0.00;
		$bySalesPayment = array(
								'CASH'=>0.0,
								'PREPAID'=>0.0,
								'CHARGE'=>0.0,
		);
		
		for($q=0;$q<count($daily);$q++){
				$index = (string)$daily[$q]['Sale']['id'];
				$itemcode = (string)$daily[$q]['SaleDetail']['item_code'];
				$data =array();
				
				if(is_null($daily[$q]['Prod']['product_type_id'])){ //to check if Meal type
					$foodDex = $daily[$q]['SaleDetail']['item_code'];//Meals
					$foodSalesDex = $daily[$q]['SaleDetail']['sale_id'];
					$data = array(
									'Qty'=>$daily[$q]['SaleDetail']['qty'],
									'Barcode'=>$daily[$q]['SaleDetail']['item_code'],
									'Desc'=>$daily[$q]['Menu']['name'],
									'Amount'=>$daily[$q]['Menu']['selling_price'],
									'Total'=>$daily[$q]['SaleDetail']['qty']*$daily[$q]['Menu']['selling_price']
						);
					if(!isset($food[$foodDex])){
						$food[$foodDex]= $data;
					}else{
						$food[$foodDex]['Qty']+=$data['Qty'];
						$food[$foodDex]['Total']+=$data['Total'];
					}
					$foodTotal+=$data['Total'];
										
				}else{ // Merchandise
					$prodDex = $daily[$q]['SaleDetail']['item_code'];
					$prodSalesDex = $daily[$q]['SaleDetail']['sale_id'];
					$data = array(
									'Qty'=>$daily[$q]['SaleDetail']['qty'],
									'Barcode'=>$daily[$q]['SaleDetail']['item_code'],
									'Desc'=>$daily[$q]['Prod']['name'],
									'Amount'=>$daily[$q]['Prod']['selling_price'],
									'Total'=>$daily[$q]['SaleDetail']['qty']*$daily[$q]['Prod']['selling_price']
						);
					if(!isset($shelf[$prodDex])){
						$shelf[$prodDex]= $data;
					}else{
						$shelf[$prodDex]['Qty']+=$data['Qty'];
						$shelf[$prodDex]['Total']+=$data['Total'];
					}
					$shelfTotal+=$data['Total'];
									
				}

				if(!isset($byOr[$index])){ //(By OR) if or number is already set 
						$byOr[$index]=array();
						array_push($byOr[$index],$data);
				}else{
					$match = 0;
					
					for($t=0;$t<count($byOr[$index]); $t++){
						if($byOr[$index][$t]['Barcode']==$itemcode){
							$byOr[$index][$t]['Qty']+=$data['Qty'];
							$byOr[$index][$t]['Total']=$byOr[$index][$t]['Qty']*$byOr[$index][$t]['Amount'];
						
							$match=1;								
							break;
						}
					}
					if (!$match){
						array_push($byOr[$index],$data);
					}
				}
		
				
		}
		
	    for($r=0;$r<count($dailySale);$r++){
			
			foreach($dailySale[$r]['SalePayment'] as $salesPayment){
				if($salesPayment['payment_type_id']==1){
					$bySalesPayment['CASH']+=$salesPayment['amount'];
				}
				if($salesPayment['payment_type_id']==2){
					$bySalesPayment['PREPAID']+=$salesPayment['amount'];
				}
				if($salesPayment['payment_type_id']==3){
					$bySalesPayment['CHARGE']+=$salesPayment['amount'];
				}
			}
		
		}
		
		
		
		$report=array(
			'Date'=>$Date,
			'Total_Sales'=>$foodTotal+$shelfTotal,
			'Total_Food'=>$foodTotal,
			'Total_Shelf'=>$shelfTotal,
			'Total_Details'=>array(
								'Food'=>$food,
								'Shelf'=>$shelf,
				),
			'Total_byOR'=>$byOr,
			'bySalesPayment'=>$bySalesPayment
			
			);
			
			
		if($this->RequestHandler->isAjax()){
			echo json_encode($report);
			exit();
		}else{
			pr($report);
			exit();
		
		}
	}
	
	function report(){
	
	}
	
	function report_pdf(){
		$data = $this->data['Sale']['data'];
		$data = json_decode($data, true);
		$this->set(compact('data'));
		$this->layout='pdf';
		$this->render();
	}
	
	function details_report(){
		$data = $this->data['Sale']['data'];
		$data = json_decode($data, true);
		$this->set(compact('data'));
		$this->layout='pdf';
		$this->render();
	}
	
	function employeeCharged(){
		//$this->data['Sale']['buyer']=19;
		if($this->RequestHandler->isAjax()){
			echo json_encode($this->Employee->getEmployeeById($this->data['Sale']['buyer']));
			exit();
		}
	}
	function returns(){
		$this->Employee->find('list');
		$paymentTypes = $this->PaymentType->find('list');
		$this->set(compact('paymentTypes'));
	}
}
