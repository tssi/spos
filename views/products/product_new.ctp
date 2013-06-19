<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiInputNumeric','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid','biz/inventory'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
.option{
	width: 97% !important;
	margin: 0px 1px !important;
}
</style>
<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
<div id="myDialog"></div>
<div id="tabs">
	<ul>
		<li><a class='wew' href="#tabs-1">Add Product</a></li>
		<li><a href="#tabs-2">View Inventory</a></li>
	</ul>
		<div class="canteen form formNeat w95 mCenter pTop30">
		<?php echo $this->Form->create('Product',array('action'=>'add'));?>
			<div class="mCenter w95  metro picker pearl pt5">
				<?php foreach($productTypes as $ptype){ ?>
					<div class="showLnBlk"><?php echo $this->Form->submit($ptype['ProductType']['name'],array('type'=>'button','class'=>'wideButton','data-picker-id'=>$ptype['ProductType']['id'], 'data-is-perish'=>$ptype['ProductType']['is_perishable'],'data-is-consume'=>$ptype['ProductType']['is_consumable']));?></div>
				<?php }?>			
			</div>
			<div class="fClear"></div>
			<div id="tabs-1">		
				<div class="tab record metro nmLeft w100 mCenter" id="addProductView">
					<h2 class='taCenter bgLime b1sLemon pad4 nmAll nmTop'>Add Product</h2>
					<div class="tab-content  nmBottom posRelative ">
						<div class="recordHeader pbtm btmShadow">
							<div class="fLeft w55 recordHeader ">
								<div class="fLeft w25">
									<div class="fLeft w95">Item Code</div>
								</div>
								<div class="fRight w75">
									<div class="fLeft w80 ">Item Description</div>
									<div class="fLeft w20">Qty</div>
									<div class="fClear"></div>							
								</div>
							</div>
							<div class="fRight w45 recordHeader">
								<div class="fLeft w45 ">
									<div class="fLeft w55 ">Unit</div>
									<div class="fLeft w45 ">Consumable</div>
									<div class="fClear"></div>
								</div>
								<div class="fRight w55">
									<div class="fLeft w40 ">Price</div>
									<div class="fLeft w40 ">Est. Cost</div>
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="iscroll w100"  id="inventoryList">
							<div class="iscrollWrapper">						
								<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
									<li class="mainInput">
										<div class="fLeft w55">
											<div class="fLeft w25">
												<div class="hide productType ">
													<?php echo $this->Form->input('Product.%.product_type_id',array('type'=>'hidden','id'=>false)); ?>
													
												</div>
												<div class="fLeft w100 itemCode ">												
													<?php echo $this->Form->input('Product.%.item_code',array('label'=>false,'id'=>false, 'frm'=>'#itemCheck', 'linkto'=>'#ProductItemCode', 'class'=>'ajax numeric unique')); ?>
												</div>
											</div>
											<div class="fRight w75">
												<div class="fLeft w80 desc productAuto">
													<?php echo $this->Form->input('Product.%.name',array('label'=>false, 'class'=>'productAuto ajax unique','id'=>false, 'linkto'=>'#ProductName', 'frm'=>'#nameCheck')); ?>
												</div>
												<div class="fRight w20 quantity">
													<?php echo $this->Form->input('Product.%.qty',array('label'=>false, 'class'=>'','id'=>false)); ?>
												</div>
												<div class="fClear"></div>
												
											</div>
										</div>
										<div class="fRight w45">
											<div class="fLeft w45">
												<div class="fLeft w55 unit ">
													<?php echo $this->Form->input('Product.%.unit_id',array('label'=>false,'id'=>false, 'class'=>'required option fs10')); ?>
												</div>
												<div class="fRight w45 consume">
													<?php //echo $this->Form->input('Product.%.is_consumable',array('label'=>false,'id'=>false)); ?>
													<div class="input select required">
														<select name="data[Product][%][is_consumable]" class="required option fs10">
															<option value="%">Select One</option>
															<option value="1">YES</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fRight w55 money ">
												<div class="fLeft w40 price">
													<div class="input select required">
														<?php echo $this->Form->input('Product.%.selling_price',array('label'=>false,'id'=>false,'class'=>'numeric monetary moreThanZero required', 'div'=>false)); ?>
													</div>
												</div>
												<div class="fRight w60 ">
													<div class="fLeft w80">
														<?php echo $this->Form->input('Product.%.selling_price'); ?>
													</div>
													<div class="fLeft w20">
														<a class="recordDelete maCenter" href="#">X</a>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</li>
								</ul>					
							</div>	
						</div>
						<div>
							<div class="fLeft pt5">
								&nbsp;&nbsp;<strong>*ALT-I to auto-assign barcode number</strong>
							</div>
							<div class="fRight pt5 topaz pbtm pRight">
								<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button'));?>
								<?php echo $this->Form->submit('Cancel',array('type'=>'reset','class'=>'selected fwb','id'=>'cancel_button'));?>
							</div><div class="fClear"></div>
						</div>
					</div>
				</div>
				<div class="fClear "></div>
			</div>
		<?php echo $this->Form->end(); ?>
		</div>
		
		<!--View Inventory-->	
		<div id="tabs-2">
		<div class="canteen form formNeat w95 mCenter">
			<?php echo $this->Form->create('Product',array('action'=>'add', 'id'=>'productView'));?>
			<div class="tab record metro nmLeft w100 mCenter">
				<!--<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">View Inventory</h2>-->
				<h2 class='taCenter bgLime b1sLemon pad4 nmAll nmTop'>View Inventory</h2>
				<div class="tab-content  nmBottom posRelative ">
					<div class="recordHeader pbtm btmShadow">
						<div class="fLeft w55 recordHeader">
							<div class="fLeft w25">
								<div class="fLeft w95 ">Item Code</div>
							</div>
							<div class="fRight w75">
								<div class="fLeft w80 ">Item Description</div>
								<div class="fLeft w20 ">Qty</div>
								<div class="fClear"></div>							
							</div>
						</div>
						<div class="fRight w45 recordHeader">
							<div class="fLeft w45 ">
								<div class="fLeft w55 ">Unit</div>
								<div class="fLeft w45 ">Consumable</div>
								<div class="fClear"></div>
							</div>
							<div class="fRight w55">
								<div class="fLeft w40 ">Price</div>
								<div class="fLeft w40 ">Est. Cost</div>
								<div class="fClear"></div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>
					<div class="iscroll w100" id="inventoryList_view">
						<div class="iscrollWrapper">							
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<li class="mainInput">
									<div class="fLeft w55">
										<div class="fLeft w25">
											<div class="hide VIEWproductType ">
												<?php echo $this->Form->input('Product.%.product_type_id',array('type'=>'hidden','readonly'=>'readonly','id'=>false)); ?>
												
											</div>
											<div class="fLeft w100 VIEWitemCode">												
												<?php echo $this->Form->input('Product.%.item_code',array('label'=>false,'id'=>false,'readonly'=>'readonly', 'frm'=>'#itemCheck', 'linkto'=>'#ProductItemCode', 'class'=>'ajax unique numeric')); ?>
											</div>
										</div>
										<div class="fRight w75">
											<div class="fLeft w80 VIEWdesc productAuto">
												<?php echo $this->Form->input('Product.%.name',array('label'=>false,'readonly'=>'readonly', 'class'=>'productAuto','id'=>false)); ?>
											</div>
											<div class="fRight w20 VIEWquantity txtr">
												<?php echo $this->Form->input('Product.%.qty',array('label'=>false,'readonly'=>'readonly', 'class'=>'numeric ','id'=>false)); ?>
											</div>
											<div class="fClear"></div>
										</div>
									</div>
									<div class="fRight w45">
										<div class="fLeft w45">
											<div class="fLeft w55 VIEWunit">
												<?php echo $this->Form->input('Product.%.unit_id',array('label'=>false,'id'=>false,'disabled'=>true, 'class'=>'required option')); ?>
											</div>
											<div class="fRight w45 VIEWconsume">
												<div class="input select required">
													<select name="data[Product][%][is_consumable]" class="required option" disabled="disabled">
														<option value="%">Select One</option>
														<option value="1">YES</option>
														<option value="0">NO</option>
													</select>
												</div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w55 money ">
											<div class="fLeft w40 VIEWprice">
												<div class="input select required">
													<?php echo $this->Form->input('Product.%.selling_price',array('label'=>false,'readonly'=>'readonly','id'=>false,'class'=>'numeric monetary moreThanZero required', 'div'=>false)); ?>
												</div>
											</div>
											<div class="fRight w60 ">
												<div class="fLeft w80">
													<?php echo $this->Form->input('Product.%.selling_price'); ?>
												</div>
												<div class="fLeft w20">
													<a class="recordDelete maCenter" href="#">X</a>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</li>
							</ul>	
						</div>
					</div>
					<div class="fRight pt5 topaz">
						<?php echo $this->Form->submit('Close',array('type'=>'button','class'=>'selected fwb close_button','id'=>false));?>
						<?php echo $this->Form->submit('Cancel',array('type'=>'reset','class'=>'selected fwb cancel_button','id'=>false));?>
					</div>	
				</div>	
			</div>
			<div class="fClear"></div>
			<?php echo $this->Form->end(); ?>
			
		</div>
		</div>
		<!---->
		<?php echo $this->Form->create('Product',array('id'=>'itemCheck', 'action'=>'check'));?>
		<?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
		<?php echo $this->Form->end();?>
		 <?php echo $this->Form->create('Product',array('id'=>'nameCheck', 'action'=>'checkDesc'));?>
		<?php echo $this->Form->input('name',array('label'=>false, 'type'=>'hidden'));?>
		<?php echo $this->Form->end();?>
</div>		
			
<!--
<div class="form formNeat topaz">
<?php echo $this->Form->submit('View Inventory',array('type'=>'reset','id'=>'inventoryView','class'=>'selected fwb view wideButton'));?>
<?php echo $this->Form->submit('Add Product',array('type'=>'reset','id'=>'addView','class'=>'selected fwb view wideButton'));?>
</div>
-->

