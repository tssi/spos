<?php
	echo $this->Html->script(array('ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'biz/inventory'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
.option{
	width: 97% !important;
	margin: 0px 1px !important;
}
.h20{
	height: 20px  !important;
}
</style>
<div id="myDialog"></div>
<div class="tab w100">
	<div class="tab-header">Inventory Adjustment</div>
	<div class="tab-content">

		<div class="canteen form formNeat w98 mCenter pt5">
			<div class="mCenter w95  metro picker pearl pbtm14">
				<?php foreach($productTypes as $ptype){ ?>
					<div class="showLnBlk"><?php echo $this->Form->submit($ptype['ProductType']['name'],array('type'=>'button','class'=>'wideButton','data-picker-id'=>$ptype['ProductType']['id'], 'data-is-perish'=>$ptype['ProductType']['is_perishable'],'data-is-consume'=>$ptype['ProductType']['is_consumable']));?></div>
				<?php }?>			
			</div>
		</div>
		<br/>
		<!--View Inventory-->	
		<div class="canteen form formNeat w98 mCenter">
			<?php echo $this->Form->create('Product',array('action'=>'add', 'id'=>'productView'));?>
			<div class="tab record metro nmLeft w100 mCenter">
				<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
							View Inventory
				</h2>
				<div class="tab-content on nmBottom ">
					<div class="fLeft w30 ">
						<div class="fLeft w65 pt2">
							<span class="fwb small pLeft">Sort order:</span>
							<select id="ordering" disabled="disabled" class="h20 fsSmall">
								<option value="Product.item_code">Item Code</option>
								<option value="Product.name">Description</option>
								<option value="Product.qty">Qty</option>
								<option value="Product.selling_price">SRP</option>
							</select>
						</div>
						<div class="fRight topaz w35">
								<?php echo $this->Form->submit('Go',array('type'=>'button','class'=>'selected fwb order_button ','id'=>false));?>
						</div>	
						<div class='fClear'></div>
					</div>
					<div class="fRight w70">
						<div class="fLeft w88 pt2">
							<div class='fLeft w30'>
								<strong>Search:</strong>
								<select id="searchBy" class="h20 fsSmall">
									<option value="Product.item_code">Item Code</option>
									<option value="Product.name">Description</option>
								</select>
							</div>
							<div class='fRight w70 '>
								<div class='fLeft w35 '>
									<strong>Type:</strong>
									<select id="searchType" class="h20 fsSmall">
										<option value="within">text within</option>
										<option value="exact">exact text</option>
									</select>
								</div>
								<div class='fLeft w65'>
									<input class="h20 pt2 fsSmall w95" id="searchKey" placeholder="Key"/>
								</div>
							</div>
							<div class="fClear"></div>	
						</div>
						<div class="fRight topaz w13">
							<?php echo $this->Form->submit('Search',array('type'=>'button','class'=>'selected fwb search_button ','id'=>false));?>
						</div>
						<div class="fClear"></div>	
					</div>
					<div class="fClear"></div>	
				<hr/>
					<div class="recordHeader pbtm btmShadow posRelative" style='padding-top: 7px;'>
						<div class="fLeft w55 recordHeaderz">
							<div class="fLeft w25">
								<div class="fLeft w95 ">Item Code</div>
							</div>
							<div class="fRight w75">
								<div class="fLeft w80 ">Item Description</div>
								<div class="fLeft w20 ">Qty</div>
								<div class="fClear"></div>							
							</div>
						</div>
						<div class="fRight w45 ">
							<div class="fLeft w45 ">
								<div class="fLeft w55 ">Unit</div>
								<div class="fLeft w45 ">Consumable</div>
								<div class="fClear"></div>
							</div>
							<div class="fRight w55">
								<div class="fLeft w40 ">SRP</div>
								<div class="fLeft w40 ">EPP</div>
								<div class="fClear"></div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>
					<div class="iscroll w100" id="inventoryList_view" style='margin-top: -26px;'>
						<div class="iscrollWrapper">							
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<li class="mainInput">
									<div class="fLeft w55">
										<div class="fLeft w25">
											<div class="hide VIEWproductType ">
												<?php echo $this->Form->input('Product.%.product_type_id',array('type'=>'hidden','readonly'=>'readonly','id'=>false)); ?>
											</div>
											<div class="hide VIEWID">
													<?php echo $this->Form->input('Product.%.id',array('type'=>'hidden','readonly'=>'readonly','id'=>false)); ?>
											</div>
											<div class="fLeft w100 VIEWitemCode">												
												<?php echo $this->Form->input('Product.%.item_code',array('label'=>false,'id'=>false,'readonly'=>'readonly', 'frm'=>'#itemCheck', 'linkto'=>'#ProductItemCode', 'class'=>'ajax unique numeric ')); ?>
											</div>
										</div>
										<div class="fRight w75">
											<div class="fLeft w80 VIEWdesc productAuto">
												<?php echo $this->Form->input('Product.%.name',array('label'=>false,'readonly'=>'readonly', 'class'=>'productAuto editable','id'=>false)); ?>
											</div>
											<div class="fRight w20 VIEWquantity ">
												<?php echo $this->Form->input('Product.%.qty',array('label'=>false,'readonly'=>'readonly', 'class'=>'numeric editable taCenter','id'=>false)); ?>
											</div>
											<div class="fClear"></div>
										</div>
									</div>
									<div class="fRight w45">
										<div class="fLeft w45">
											<div class="fLeft w55 VIEWunit">
												<?php echo $this->Form->input('Product.%.unit_id',array('type'=>'text','label'=>false,'id'=>false, 'readonly'=>'readonly','class'=>'required option')); ?>
											</div>
											<div class="fRight w45 VIEWconsume">
												<div class="input select required">
													<!--<select name="data[Product][%][is_consumable]" class="required option" disabled="disabled">
														<option value="%">Select One</option>
														<option value="1">YES</option>
														<option value="0">NO</option>
													</select>-->
													<?php echo $this->Form->input('Product.%.is_consumable',array('type'=>'text','label'=>false,'id'=>false, 'readonly'=>'readonly','class'=>'required option')); ?>	
												</div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w55 money ">
											<div class="fLeft w40 VIEWprice">
												<div class="input select required">
													<?php echo $this->Form->input('Product.%.selling_price',array('label'=>false,'readonly'=>'readonly','id'=>false,'class'=>'numeric monetary moreThanZero required editable', 'div'=>false)); ?>
												</div>
											</div>
											<div class="fRight w60 ">
												<div class="fLeft w70 VIEWavg">
													<?php echo $this->Form->input('Product.%.avg_price', array('label'=>false, 'readonly'=>'readonly','id'=>false,'class'=>'numeric monetary moreThanZero required editable',)); ?>
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
					
				</div>	
			</div>
			
			<div class="fClear"></div>
			<?php echo $this->Form->end(); ?>
			<!---->
			<?php echo $this->Form->create('Product',array('id'=>'itemCheck', 'action'=>'check'));?>
			<?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->end();?>
			<?php echo $this->Form->create('Product',array('id'=>'nameCheck', 'action'=>'checkDesc'));?>
			<?php echo $this->Form->input('name',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->end();?>
			<?php echo $this->Form->create('Product',array('id'=>'search', 'action'=>'getByType'));?>
			<?php echo $this->Form->input('field',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->input('kind',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->input('type',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->input('key',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->end();?>

			<div class="fRight pt5 topaz">
				<?php echo $this->Form->submit('Close',array('type'=>'button','class'=>'selected fwb close_button','id'=>false));?>
			</div>
			<div class="fClear"></div>
		</div>
		<!--
		<div class="form formNeat topaz">
			<?php echo $this->Form->submit('View Inventory',array('type'=>'reset','id'=>'inventoryView','class'=>'selected fwb view wideButton'));?>
			<?php echo $this->Form->submit('Add Product',array('type'=>'reset','id'=>'addView','class'=>'selected fwb view wideButton'));?>
		</div>
		-->
	</div>
</div>
