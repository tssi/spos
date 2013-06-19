<?php
	
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid','ui/uiInputNumeric','biz/sales', 'ui/uiSmartSearch', 'ss/ssUtil'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
	#counterItems{ height:322px;}
	#itemsSold{ height:350px;}
	#buyer_info{ margin-left:-75px;}
	#sales_info{ margin-right:-75px;}
</style>
	<div class="canteen form formNeat w100">
		<div class="wLong">
			<div class=" wWider mCenter">
				<div class="fLeft w50 " id="buyer_info"> 
					<div class="metro picker ">
						<span class="emerald"><?php echo $this->Form->submit('Cash',array('type'=>'button')); ?></span>
						<span class="ruby"><?php echo $this->Form->submit('Prepaid',array('type'=>'button')); ?></span>
						<span class="sapphire"><?php echo $this->Form->submit('Charge',array('type'=>'button')); ?></span>
					</div>
					<div class="classic soft" >
						<?php
						 echo $this->Form->input('buyer_id',array('type'=>'text'));
						 echo $this->Form->input('name',array('type'=>'text'));
						?>
					</div>
				</div>			
				<div class="fRight w50" id="sales_info">
					<div class="classic bigAmount money soft numeric">
						<div><?php echo $this->Form->input('total',array('readonly'=>'readonly','type'=>'text'));?></div>
						<div><?php echo $this->Form->input('amount_received',array('type'=>'text'));?></div>
						<div class="pt5 "><?php  echo $this->Form->input('change',array('readonly'=>'readonly','type'=>'text'));?></div>
					</div>
				</div>
				<div class="fClear"></div>
			</div>
		</div>
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
								<ul class="recordDatagrid  on w100  b1sg  nbLeft  nbRight DispIt">								
									<li class="mainInput">
										<div class="fLeft w75 desc">
											<?php echo $this->Form->input('Product.%.name',array('readonly'=>'readonly','value'=>'','label'=>false, 'id'=>false)); ?>
										</div>
										<div class="fRight w25 money price">
											<?php echo $this->Form->input('Product.%.selling_price',array('readonly'=>'readonly','value'=>'12.25','label'=>false, 'id'=>false)); ?>
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
							<div class="fleft w25"><?php echo $this->Form->input('qty'); ?></div>
							<div class="fRight w75"><?php echo $this->Form->input('description'); ?></div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>							
					</div>
				</div>
			
			</div>
		
			<div class="fRight w60 ">
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
											<div class="fLeft w75 desc"><?php echo $this->Form->input('Sale.%.name',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?></div>
											<div class="fRight w25 qty"><?php echo $this->Form->input('Sale.%.qty',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?></div>
										</div>								
										<div class="fRight w45">
											<div class="fLeft w80 money">
												<div class="fLeft w50 price"><?php echo $this->Form->input('Sale.%.price',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?></div>
												<div class="fLeft w50 amount"><?php echo $this->Form->input('Sale.%.amount',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?></div>
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
				<div class="fLeft w100 metro">
						<div class="fRight w30 topaz ">					
							<div class="fLeft w50 pt5 "><?php echo $this->Form->submit('Save',array('class'=>'selected fwb'));?></div>		
							<div class="fRight w50 pt5"><?php echo $this->Form->submit('Cancel',array('class'=>'selected fwb','id'=>'cancel_button'));?></div>	
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
				</div>
				<div class="fClear"></div>	
			</div>
			<div class="fClear"></div>
		</div>
<?php //echo $this->Form->create('Sale',array('action'=>'add'));?>
<?php //echo $this->Form->end();
?>

