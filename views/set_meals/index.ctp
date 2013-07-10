<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid','ui/uiInputNumeric','biz/set_meal','ss/ssUtil', 'ui/uiSmartSearch'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
	#MasterListItems{ height:465px;}
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
	
	.inline-block {
		display: inline-block;
	}
	.inline-block label{
		width:90px !important;
	}
	
</style>

<div id="dialog" class="dialogBox"></div>
<div class="tab">
	<div class="tab-header">Set Meal</div>
	<div class="tab-content">
		<div class="canteen form formNeat w100">
			<div class="w750 mCenter pTop10">
				<div class="fLeft w35 ">
					<div class="record metro tab nmLeft " >
						<h2 class="recordTitle b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
							Master Lists
						</h2>
						<div class="tab-content nmBottom posRelative" >
							<div class="recordHeader pbtm btmShadow">
								<div class="fLeft w60">Description</div>
								<div class="fRight w40">Price</div>
								<div class="fClear"></div>
							</div>
							<div class="iscroll w100" id="MasterListItems">
								<div class="iscrollWrapper">
									<ul class="recordDatagrid  on w100  b1sg  nbLeft  nbRight">
										<li class="mainInput">
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
								<div class="fleft w25"><?php echo $this->Form->input('Dummy.qty',array('id'=>'qty', 'class'=>'numeric','value'=>'1')); ?></div>
								<div class="fRight w75"><?php echo $this->Form->input('Dummy.description', array('id'=>'description','class'=>'uiSmartSearch','maxlength'=>50,'search-on'=>'#MasterListItems ul.recordDataGrid li.clickInput')); ?></div>
								<div class="fClear"></div>
							</div>
							<div class="fClear"></div>							
						</div>
					</div>
					<div class="fClear"></div>	
				</div>
			
				<div class="fRight w60">
					<?php echo $this->Form->create('MenuItem',array('action'=>'add'));?>
					<div class=" mCenter pTop10 classic soft ">
						<div class="w100 ">
							<?php echo $this->Form->input('MenuItem.item_code',array('placeholder'=>'Alt-I (Auto Code)','class'=>'itemcode','div'=>array('class'=>'inline-block input text required')));?>
							<?php echo $this->Form->input('MenuItem.name',array('div'=>array('class'=>'inline-block input text w57 required')));?>
						</div>
						<div class="w100">
							<?php echo $this->Form->input('MenuItem.selling_price',array('class'=>'text-right monetary numeric','div'=>array('class'=>'inline-block input text required')));?>
							<?php echo $this->Form->input('MenuItem.avg_price',array('label'=>'Est. Cost','class'=>'text-right monetary numeric','div'=>array('class'=>'inline-block input text required')));?>
						</div>
						<div class="w100 hide">
							<?php echo $this->Form->input('MenuItem.unit_id',array('value'=>7,'type'=>'hidden','div'=>array('class'=>'inline-block input text')));?>
							<?php echo $this->Form->input('MenuItem.id',array('type'=>'hidden','div'=>array('class'=>'inline-block input text')));?>
						</div>
					</div>
				
					<div class="record metro tab nmLeft " >				
						<h2 class="recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
							Set Meal Item (Component)
						</h2>				
						<div class="tab-content nmBottom posRelative">
							<div class="recordHeader pbtm btmShadow">
								<div class="fLeft w55">
									<div class="fLeft w75">Description</div>
									<div class="fRight w25">Qty</div>
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
							<div class="iscroll w100" id="SetMealItem">
								<div class="iscrollWrapper">								
									<ul class="recordDatagrid  on   b1sg  nbLeft nbRight">
										<li class="mainInput">
											<div class="fLeft w55">
												<div class="hide menu_item">
													<?php echo $this->Form->input('SetMeal.%.menu_item',array('type'=>'hidden','id'=>false,'value'=>'X')); ?>
												</div>
												<div class="hide product_item">
													<?php echo $this->Form->input('SetMeal.%.product_item',array('type'=>'hidden','id'=>false,'value'=>'X')); ?>
												</div>
												<div class="hide avg_price">
													<?php echo $this->Form->input('SetMeal.%.avg_price',array('type'=>'hidden','id'=>false,'value'=>'X')); ?>
												</div>
												<div class="fLeft w75 desc">
													<?php echo $this->Form->input('SetMeal.%.name',array('readonly'=>'readonly','label'=>false,'id'=>false,'value'=>'X')); ?>
												</div>
												<div class="fRight w25 qty">
													<?php echo $this->Form->input('SetMeal.%.qty',array('readonly'=>'readonly','label'=>false,'id'=>false,'value'=>'X')); ?>
												</div>
											</div>								
											<div class="fRight w45">
												<div class="fLeft w80 money">
													<div class="fLeft w50 price"><?php echo $this->Form->input('SetMeal.%.price',array('readonly'=>'readonly','label'=>false,'id'=>false,'value'=>'X')); ?></div>
													<div class="fLeft w50 amount"><?php echo $this->Form->input('SetMeal.%.amount',array('readonly'=>'readonly','label'=>false,'id'=>false,'value'=>'X')); ?></div>
												</div>
												<div class="fRight w20 xDel">
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
				
					<div class="fLeft w65 pt5">
						<div class="fLeft w90">
							&nbsp;&nbsp;<strong>*ALT-I to auto-assign barcode number</strong>
						</div>
						<div class="fLeft w10 loader" style="display:none">
							<img src="/canteen/img/icons/loader.gif" class="text-right"/>
						</div>
						<div class="fClear"></div>
						
					</div>
					<div class="fRight pt5 topaz pbtm pRight w30">
						<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button'));?>
						<?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb','id'=>'cancel'));?>
					</div><div class="fClear"></div>
					
					
				</div>
				<div class="fClear"></div>
			</div>				
			<?php echo $this->Form->end();?>
		</div>
		<!--Use For Cloning when Save is click-->
		<div class="iscroll w100 hide" id="MasterListItems_ui">
			<div class="iscrollWrapper">
				<ul class="recordDatagrid  on w100  b1sg  nbLeft  nbRight">
					<li class="mainInput">		
						<div class="fLeft hide id">
							<div class="input">
								<?php echo $this->Form->input('Product.%.id',array('readonly'=>'readonly','value'=>'','label'=>false, 'type'=>'hidden','id'=>false)); ?>
							</div>
						</div>
						<div class="hide menu_item">
							<div class="input">
								<?php echo $this->Form->input('Product.%.menu_item',array('type'=>'hidden','id'=>false,'value'=>'X')); ?>
							</div>
						</div>
						<div class="hide product_item">
							<div class="input">
								<?php echo $this->Form->input('Product.%.product_item',array('type'=>'hidden','id'=>false,'value'=>'X')); ?>
							</div>
						</div>
						<div class="hide avg_price">
							<div class="input">
								<?php echo $this->Form->input('Product.%.avg_price',array('type'=>'hidden','id'=>false,'value'=>'X')); ?>
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

