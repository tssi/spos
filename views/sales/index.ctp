
<?php
	//echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid','ui/uiInputNumeric','biz/sales', 'ui/uiSmartSearch'));
	
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid','ui/uiInputNumeric','biz/sales','ss/ssUtil', 'ui/uiSmartSearch'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
	#counterItems{ height:322px;}
	#itemsSold{ height:350px;}
	#buyer_info{ margin-left:-75px;}
	#sales_info{ margin-right:-75px;}
	.dialogBox{display:none;	min-height: 8px !important;}
	.form  input,.form  select{
		height: 21px;
	}
	
	#change{ color: #C50F1E!important;
    height: 34px;
    font-size: 28px !important;
    font-weight: bolder;
	}
</style>

<div id="dialog" class="dialogBox"></div>

<div class="tab">
	<div class="tab-header">Point of Sales (POS)</div>
	<div class="tab-content">
		<?php echo $this->Form->create('Sale',array('action'=>'add'));?>
		<div class="canteen form formNeat w100">
			<div class="wLong">
			<div class=" wWider mCenter">
						<div class="fLeft w50 " id="buyer_info"> 
							<div class="metro picker">
								<span class="emerald"><?php echo $this->Form->submit('Cash (F7)',array('type'=>'button','id'=>'cash_button')); ?></span>
								<span class="ruby"><?php echo $this->Form->submit('Prepaid (F8)',array('type'=>'button','id'=>'prepaid_button')); ?></span>
								<span class="sapphire"><?php echo $this->Form->submit('Charge (F9)',array('type'=>'button','id'=>'charge_button')); ?></span>
							</div>
							<div class="classic soft forCash " style="margin-left: -80px;">
								<?php
									echo $this->Form->input('Sale.cashier',array('type'=>'hidden', 'value'=>$user['id'], 'readonly'=>'readonly'));
									echo $this->Form->input('Sale.payment',array('type'=>'hidden', 'readonly'=>'readonly'));
									echo $this->Form->input('Sale.category',array('type'=>'hidden', 'readonly'=>'readonly', 'id'=>'categoryIs'));
									echo $this->Form->select('Sale.payment_type_id',$paymentTypes, null, array('empty'=>false, 'class'=>'hide'));
								 ?>
								<?php
									 echo $this->Form->input('Sale.buyer',array('type'=>'text','class'=>'saleMode', 'label'=>'Buyer', 'class'=>'omnibox'));
									 echo $this->Form->input('Sale.name',array('type'=>'text'));
								?>
							</div>
						</div>			
						<?php //echo $this->Form->input('Sale.id',array('type'=>'text','value'=> $counter['Counter']['value']));?>
						<div class="fRight w50" id="sales_info">
							<div class="classic bigAmount money soft numeric">
								<div class="trans">
									<div><?php echo $this->Form->input('Sale.total',array('id'=>'total','readonly'=>'readonly','type'=>'text', 'label'=>'Total Due'));?></div>
									<div class="forPrepaid">
										<div>
											<?php echo $this->Form->input('Sale.prepaid',array('id'=>'prepaid','readonly'=>'readonly','type'=>'text'));?>
										</div>
									</div>
									<div class="forCharge">
										<div>
											<?php echo $this->Form->input('Sale.charge',array('id'=>'charge','readonly'=>'readonly','type'=>'text'));?>
										</div>
										<div class="cash_added">
											<?php echo $this->Form->input('Sale.additional_cash',array('id'=>'added_cash','readonly'=>'readonly','type'=>'text'));?>
										</div>
									</div>
									<div class="forSale">
										<div>
											<?php echo $this->Form->input('Sale.amount_received',array('id'=>'amount_received','readonly'=>'readonly','type'=>'text'));?>
										</div>
										<div class="pt5 ">
											<?php  echo $this->Form->input('Sale.change',array('id'=>'change','readonly'=>'readonly','type'=>'text'));?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="fClear"></div>
					</div>
				</div>
				<div id="notify"></div>
				
				<div class="fLeft w100 metro trans">
					<div class="fRight w38">			
						<div class="fLeft w50 pt5 taRight topaz"><?php echo $this->Form->submit('Save (Enter)',array('type'=>'button','class'=>'selected fwb submit-button wideButton', 'disabled'=>true,'id'=>'save_button'));?></div>		
						<div class="fRight w50 pt5 topaz"><?php echo $this->Form->submit('Cancel (Esc)',array('type'=>'button','class'=>'selected fwb wideButton','id'=>'cancel_button'));?></div>	
						<div class="fClear"></div>
					</div>
					<div class="fClear"></div>
				</div>
				<div class="fClear"></div>	
				<div class="w750 mCenter pTop10">
					<div class="fLeft w35 ">
						<div class="record metro tab nmLeft " >
							<h2 class="recordTitle b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
								Counter Items
							</h2>
							<div class="tab-content nmBottom posRelative" >
								<div class="recordHeader pbtm btmShadow">
									<div class="fLeft w60">Description</div>
									<div class="fRight w40">Price</div>
									<div class="fClear"></div>
								</div>
								<div class="iscroll w100" id="counterItems">
									<div class="iscrollWrapper">
										<ul class="recordDatagrid  on w100  b1sg  nbLeft  nbRight">
											<li class="mainInput">
												<div class="fLeft hide item_code">
													<div class="input">
														<?php echo $this->Form->input('Product.%.item_code',array('readonly'=>'readonly','value'=>'','label'=>false, 'type'=>'hidden','id'=>false)); ?>
													</div>
												</div>
												<div class="fLeft w75 desc">
													<?php echo $this->Form->input('Product.%.name',array('readonly'=>'readonly','value'=>'','label'=>false, 'id'=>false, )); ?>
												</div>
												<div class="fRight w25 money price">
													<?php echo $this->Form->input('Product.%.selling_price', array('readonly'=>'readonly','value'=>'','label'=>false, 'id'=>false)); ?>
												</div>
												<div class="fClear"></div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>	
						<div class="fLeft w100 metro soft">
							<div class="wrapper">
								<div class="fLeft  w100 ">
									<div class="fleft w25"><?php echo $this->Form->input('qty',array('id'=>'qty', 'class'=>'numeric')); ?></div>
									<div class="fRight w75"><?php echo $this->Form->input('description', array('id'=>'description','class'=>'uiSmartSearch','maxlength'=>50,'search-on'=>'#counterItems ul.recordDataGrid li.clickInput')); ?></div>
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>							
							</div>
						</div>
						<div class="fClear"></div>	
					</div>
				
					<div class="fRight w60">
						<div class="record metro tab nmLeft " >				
							<h2 class="recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
								Items Sold
							</h2>				
							<div class="tab-content nmBottom posRelative">
								<div class="recordHeader pbtm btmShadow">
									<div class="fLeft w55">
										<div class="fLeft w70 ">Description</div>
										<div class="fRight w30 ">Qty</div>
									</div>
									<div class="fRight w45">
										<div class="fLeft w75 ">
											<div class="fLeft w55">Price</div>
											<div class="fRight w45">Amount</div>
										</div>
										<div class="fRight w25 "></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="iscroll w100" id="itemsSold">
									<div class="iscrollWrapper">								
										<ul class="recordDatagrid  on   b1sg  nbLeft nbRight">
											<li class="mainInput">
												<div class="fLeft w55">
													<div class="fLeft w75 hide item_code"><div class="input"><?php echo $this->Form->input('SaleDetail.%.item_code',array('type'=>'hidden','id'=>false,'value'=>'X')); ?></div></div>
													<div class="fLeft w75 desc"><?php echo $this->Form->input('SaleDetail.%.name',array('readonly'=>'readonly','label'=>false,'id'=>false,'value'=>'X')); ?></div>
													<div class="fRight w25 qty"><?php echo $this->Form->input('SaleDetail.%.qty',array('readonly'=>'readonly','label'=>false,'id'=>false,'value'=>'X')); ?></div>
												</div>								
												<div class="fRight w45">
													<div class="fLeft w80 money">
														<div class="fLeft w50 price"><?php echo $this->Form->input('SaleDetail.%.price',array('readonly'=>'readonly','label'=>false,'id'=>false,'value'=>'X')); ?></div>
														<div class="fLeft w50 amount"><?php echo $this->Form->input('SaleDetail.%.amount',array('readonly'=>'readonly','label'=>false,'id'=>false,'value'=>'X')); ?></div>
													</div>
													<div class="fRight w20 ">
														<a class="recordDelete" href="#">X</a>
													</div>
												</div>							
												<div class="fClear"></div>
											</li>	
										</ul>								
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="fClear"></div>
				</div>	
				<div class="fLeft w100 metro">
						
						<div class="fRight w38">						
							<div class="fRight w50 pt5"><?php echo $this->Form->submit('Done (F10)',array('type'=>'button','class'=>'selected fwb wideButton','id'=>'done_button','disabled'=>'disabled'));?></div>	
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
				</div>
				<div class="fClear"></div>	
								
		</div>
		<?php echo $this->Form->end();?>
		<?php echo $this->Form->create('Sale',array('id'=>'print_invoice','action'=>'sale_or','target'=>'_blank'));?>
		<?php echo $this->Form->input('Sale.id',array('id'=>'invoice_no','type'=>'hidden'));?>
		<?php echo $this->Form->end();?>
	<!--Use For Cloning when Save is click-->
		<div class="iscroll w100 hide" id="counterItems_ui">
		<div class="iscrollWrapper">
			<ul class="recordDatagrid  on w100  b1sg  nbLeft  nbRight">
				<li class="mainInput">
					<div class="fLeft hide item_code">
						<div class="input">
							<?php echo $this->Form->input('Product.%.item_code',array('readonly'=>'readonly','value'=>'x','label'=>false, 'type'=>'hidden','id'=>false)); ?>
						</div>
					</div>
					<div class="fLeft w75 desc">
						<?php echo $this->Form->input('Product.%.name',array('readonly'=>'readonly','value'=>'x','label'=>false, 'id'=>false, )); ?>
					</div>
					<div class="fRight w25 money price">
						<?php echo $this->Form->input('Product.%.selling_price',array('readonly'=>'readonly','value'=>'x','label'=>false, 'id'=>false)); ?>
					</div>
					<div class="fClear"></div>
				</li>
			</ul>
		</div>
	</div>
	</div>
</div>
