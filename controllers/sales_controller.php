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
					'DailyBeginningInventory',
					'User'
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
			
			//GENERATE SALE ID
			$counter = $this->Counter->find('first',array('conditions'=>array('Counter.id'=>'INVOICE')));
			$this->data['Sale']['id']=$counter['Counter']['value'];
			$this->Counter->doIncrement('INVOICE',1);
			//END
			
			//PREPARE SALE PAYMENTS
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
			//END
			
			//PREPARE SALE DETAILS
			$newSaleDetail=array();
			for($t=0;$t<count($this->data['SaleDetail']);$t++){
				$index = ($this->data['SaleDetail'][$t]['is_setmeal_dtl']==0)?$this->data['SaleDetail'][$t]['item_code']:$t;
				
				
				if(!isset($newSaleDetail[$index])){
						$newSaleDetail[$index]=array(
							'item_code' => $this->data['SaleDetail'][$t]['item_code'],
							'name' => $this->data['SaleDetail'][$t]['name'],
							'qty' => $this->data['SaleDetail'][$t]['qty'],
							'price' => $this->data['SaleDetail'][$t]['price'],
							'amount' => $this->data['SaleDetail'][$t]['amount'],
							'is_setmeal_hdr' => $this->data['SaleDetail'][$t]['is_setmeal_hdr'],
							'is_setmeal_dtl' => $this->data['SaleDetail'][$t]['is_setmeal_dtl'],
						);

				}else{
					if($this->data['SaleDetail'][$t]['is_setmeal_dtl']==0 && $this->data['SaleDetail'][$t]['is_setmeal_hdr']==0){
						$newSaleDetail[$index]['qty']+=$this->data['SaleDetail'][$t]['qty'];
						$newSaleDetail[$index]['amount']+=$this->data['SaleDetail'][$t]['amount'];
					}
				}			
			}
			$this->data['SaleDetail']=$newSaleDetail;
			array_shift($this->data['SaleDetail']);
			unset($this->Sale->SaleDetail->validate['sale_id']);
			//END
			
			
			//INIT BEGINNING INVENTORY
			foreach($this->data['SaleDetail'] as $index => $detail){
				$check_init =$this->DailyBeginningInventory->find('first',array(
							'conditions'=>array(
								'DailyBeginningInventory.item_code'=>$detail['item_code'],
								'DailyBeginningInventory.created'=>date('Y-m-d')
							)
					));
				if(empty($check_init)){
					$product_beginning_invty =$this->Product->find('first',array(
							'conditions'=>array('Product.item_code'=>$detail['item_code']),
							'fields'=>array('Product.qty')
						));
					if(!empty($product_beginning_invty)){
						$this->data['DailyBeginningInventory'][$index]['item_code'] = $detail['item_code'];
						$this->data['DailyBeginningInventory'][$index]['qty'] = $product_beginning_invty['Product']['qty'];
					}
				}
			}
			if(isset($this->data['DailyBeginningInventory'])){
				$this->DailyBeginningInventory->saveAll($this->data['DailyBeginningInventory']);
				unset($this->data['DailyBeginningInventory']);
			}
			//END
			
			
			//SALE SAVING
			if ($this->Sale->saveAll($this->data,array('validate'=>'first'))) {
				$currentSale = $this->Sale->SalePayment->find('all', array('conditions'=>array('Sale.id'=>$this->Sale->id)));

				
				
				//GET CHARGED TO DEDUCT TO CREDIT
				foreach($currentSale as $paymentIs){ 
					//FOR CHARGE ACCOUNT
					if($paymentIs['PaymentType']['name']=='CHAR'){ 
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
					//END
					
					//FOR PREPAID ACCOUNT
					if($paymentIs['PaymentType']['name']=='PREP'){ 
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
					//END
				}
				

				
				
				
				
				
				
				
				//UPDATE PRODUCT INVENTORY &|| DAILY MENU INVENTORY
				foreach($this->data['SaleDetail'] as $dtl){
					$product = $this->Product->find('first',array('conditions'=>array('Product.item_code'=>$dtl['item_code'])));
					
					if(isset($product['Product']['id'])){
						$this->Product->doIncrement($product['Product']['id'],-$dtl['qty']);	
					}
					
					$daily_menu = $this->DailyMenu->find('first',array(
															'conditions'=>array(
																'MenuItem.item_code'=>$dtl['item_code'],
																'DailyMenu.date =' =>date('Y-m-d'),
															),
															'order'=>'DailyMenu.created DESC'
														));
					
					if(isset($daily_menu['DailyMenu']['id'])){
						$this->DailyMenu->doIncrement($daily_menu['DailyMenu']['id'],-$dtl['qty']);
					}
				}
				//END
				
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
						'SaleDetail.is_setmeal_hdr',
						'SaleDetail.is_setmeal_dtl',
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
		if(empty($Date)) $Date = date('Y-m-d');
		
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
				'SaleDetail.is_setmeal_hdr',
				'SaleDetail.is_setmeal_dtl',
				'Prod.product_type_id',
				'Menu.name',
				'Prod.name',
				'Prod.id',
				'Menu.selling_price',
				'Prod.selling_price'
				);	
		
		
        $conditions = array("Sale.created >=" =>$fromDate,
							"Sale.created <=" =>$toDate,
							//"SaleDetail.is_setmeal_hdr !="=>1
							);
		
		
		if(!empty($byCashier)){
			$conditions['Sale.cashier ='] = $byCashier;
		}
		
		$daily = $this->Sale->SaleDetail->find('all', array('conditions'=>$conditions, 'fields'=>$field, 'joins'=>$join, 'recursive'=>2));
		
		$conditions = array(
							"Sale.created >=" =>$fromDate,
							"Sale.created <=" =>$toDate,
						);				
		if(!empty($byCashier)){
			$conditions['Sale.cashier ='] = $byCashier;
		}				
		
		$dailySale = $this->Sale->find('all', array('conditions'=>$conditions));
		
		$spamount = 0;
		$sdamount = 0;
		foreach($dailySale as $ds){
			$spamount= $ds['SalePayment'][0]['amount'];
			
			foreach($ds['SaleDetail'] as $sd){
				$sdamount+= $sd['amount'];
			}
			//UNCOMMENT THIS CODE FOR DEBUGGING THIS WILL COMPARE SALE PAYMENT AMOUNT VS SALE DETAILs TOTAL 
			//pr('SP ID '.$ds['SalePayment'][0]['id']. ', SALE ID '.$ds['SalePayment'][0]['sale_id']);
			//pr('SalePyment '.$spamount.', '.$sdamount);
			//$sdamount=0;
			
		}
		//pr($dailySale);
		//exit;
		
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
							
		//pr($daily);exit;
		for($q=0;$q<count($daily);$q++){
			$index = (string)$daily[$q]['Sale']['id'];
			$itemcode = (string)$daily[$q]['SaleDetail']['item_code'];
			$data =array();
			$selling_price = $daily[$q]['SaleDetail']['amount']/$daily[$q]['SaleDetail']['qty'];
				
			if(is_null($daily[$q]['Prod']['product_type_id'])){ //MEAL TYPE
				$foodDex = $daily[$q]['SaleDetail']['item_code'];
				$foodSalesDex = $daily[$q]['SaleDetail']['sale_id'];
				$data = array(
								'Qty'=>$daily[$q]['SaleDetail']['qty'],
								'Barcode'=>$daily[$q]['SaleDetail']['item_code'],
								'Desc'=>$daily[$q]['Menu']['name'],
								'SellingPrice'=>$daily[$q]['Menu']['selling_price'],
								'Amount'=>$daily[$q]['SaleDetail']['amount'],
								'Is_SetHdr'=>$daily[$q]['SaleDetail']['is_setmeal_hdr'],
								'Is_SetDtl'=>$daily[$q]['SaleDetail']['is_setmeal_dtl']
					);
				if(!isset($food[$foodDex]) && $daily[$q]['SaleDetail']['is_setmeal_dtl'] !=1){
					$food[$foodDex]= $data;
				}else{
					if($daily[$q]['SaleDetail']['is_setmeal_dtl'] !=1){
						$food[$foodDex]['Qty']+=$data['Qty'];
						$food[$foodDex]['Amount']+=$data['Amount'];
					}
				}
				if($daily[$q]['SaleDetail']['is_setmeal_dtl'] != 1){
					$foodTotal+=$data['Amount'];
				}				
			}else{ // MERCHANDISE TYPE
				$prodDex = $daily[$q]['SaleDetail']['item_code'];
				$prodSalesDex = $daily[$q]['SaleDetail']['sale_id'];
				$data = array(
								'Qty'=>$daily[$q]['SaleDetail']['qty'],
								'Barcode'=>$daily[$q]['SaleDetail']['item_code'],
								'Desc'=>$daily[$q]['Prod']['name'],
								'SellingPrice'=>$selling_price,
								'Amount'=>$daily[$q]['SaleDetail']['amount'],
								'Is_SetHdr'=>$daily[$q]['SaleDetail']['is_setmeal_hdr'],
								'Is_SetDtl'=>$daily[$q]['SaleDetail']['is_setmeal_dtl']
					);
				if(!isset($shelf[$prodDex]) && $daily[$q]['SaleDetail']['is_setmeal_dtl'] !=1){
					$shelf[$prodDex]= $data;
				}else{
					if($daily[$q]['SaleDetail']['is_setmeal_dtl'] !=1){
						$shelf[$prodDex]['Qty']+=$data['Qty'];
						$shelf[$prodDex]['Amount']+=$data['Amount'];
					}
				}
				
				if($daily[$q]['SaleDetail']['is_setmeal_dtl'] != 1){
					$shelfTotal+=$data['Amount'];
				}
								
			}

			$index = (string)$daily[$q]['Sale']['id'];
		
			if(!isset($byOr[$index])){ //(By OR) if or number is already set 
					$byOr[$index]=array();
					array_push($byOr[$index],$data);
			}else{
				$match = 0;
				for($t=0;$t<count($byOr[$index]); $t++){
					if($byOr[$index][$t]['Barcode']==$itemcode && $daily[$q]['SaleDetail']['is_setmeal_dtl'] ==0){
						$byOr[$index][$t]['Qty']+=$data['Qty'];
						$byOr[$index][$t]['Amount']=$byOr[$index][$t]['Qty']*$byOr[$index][$t]['SellingPrice'];
						$match=1;								
						break;
					}
				}
				if (!$match) array_push($byOr[$index],$data);
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
		}
	}
	
	function report(){
		$user =  $this->Auth->user();
		if($user['User']['is_collector']) $conditions =array('User.is_collector !='=>1);
		else $conditions =array('User.id'=>$user['User']['id']);
		
		$cashiers = $this->User->find('list',array(
										'conditions'=>$conditions,
										'fields'=>array('User.id','User.username'),
										'order'=>'User.username'
										));		

		if($user['User']['is_collector']) $cashiers['is_all_cashier'] = 'ALL Cashier';
		$this->set(compact('cashiers'));
	}
	
	function report_pdf(){
		if($this->data['Sale']['user_id'] == 'is_all_cashier'){
			$cashier = 'ALL CASHIER';
		}else{
			$user = $this->User->findById($this->data['Sale']['user_id']);
			$cashier = 	ucFirst($user['User']['last_name']).', '.ucFirst($user['User']['first_name']).' '.ucFirst($user['User']['middle_name'][0]).'.';
		}
	
		$data = $this->data['Sale']['data'];
		$data = json_decode($data, true);
		$this->set(compact('data','cashier'));
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
			echo json_encode($this->Employee->findbyId($this->data['Sale']['buyer']));
			exit();
		}
	}
	
	function returns(){
		$this->Employee->find('list');
		$paymentTypes = $this->PaymentType->find('list');
		$this->set(compact('paymentTypes'));
	}

	function daily_cashiers_report(){
		$date = $this->data['Sale']['date'];
		$cashier = $this->data['Sale']['user_id'];
	
		$curr_data = $this->Sale->daily_cashiers_report($date.' 00:00:00',$cashier);
		$this->set(compact('curr_data','date'));
		$this->layout='pdf';
		$this->render();
	}

}
