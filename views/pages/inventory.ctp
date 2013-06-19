<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','canteen/cantInventory'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<? echo $this->Form->create('Inventory');?>
	<div class="canteen form formNeat w100">
		<div class="wLong hMini">
			<div class="fRight w50">
				<div class="fRight w80 classic soft">
					<?php echo $this->Form->input('Date');?>
					
				</div>	
			</div><div class="fClear"></div>
		</div>
		
		
		<div class="wLong">	
			<div class="fLeft  w20">
				<div class="fLeft fwb">
					Shelf Item
				</div>
			</div>
			<div class="fRight w80">
				<div class="fLeft fwb">
					Non Shelf Item
				</div>
			</div>
			<div class="fClear"></div>
			<div class="fLeft  w20 pbtm">
				<div class="fLeft ">
					<div class="metro picker fRight w65 pearl ">
						<span><?php echo $this->Form->submit('Stockable Item',array('type'=>'button'));?></span>
					</div>
				</div>
			</div>
			<div class="fRight w80 pbtm">
				<div class="fLeft  metro picker w100 pearl">
					<span><?php echo $this->Form->submit('Non Stockable Ingredient',array('type'=>'button','class'=>'wideButton'));?></span>
					<span><?php echo $this->Form->submit('Accesoriest',array('type'=>'button','class'=>'wideButton'));?></span>
					<span><?php echo $this->Form->submit('Utensils',array('type'=>'button','class'=>'wideButton'));?></span>
					<span><?php echo $this->Form->submit('Properties',array('type'=>'button','class'=>'wideButton'));?></span>
				</div>
			</div>	
			<div class="fClear"></div>
		</div>
		<div class="tab record metro nmLeft">

			<h2 class="recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter ">

						Inventory Lists
			</h2>
			<div class="tab-content nmBottom posRelative">
				<div class="recordHeader pbtm btmShadow">
					<div class="fLeft w60 recordHeader">
						<div class="fLeft w25">
							<div class="fLeft w95">Item Code</div>
						</div>
						<div class="fRight w75">
							<div class="fLeft w80 ">Item Description</div>
							<div class="fRight w20 ">Unit</div>
						</div>
					</div>
					<div class="fRight w40 recordHeader">
						<div class="fLeft w50">
							<div class="fLeft w50 ">Qty</div>
							<div class="fRight w50 ">Selling Price</div>
						</div>
						<div class="fRight w50">
							<div class="fLeft w50 ">Amount</div>
							<div class="fRight w50 ">Avg Price</div>
						</div>
					</div>
					<div class="fClear"></div>
				</div>
				<div class="iscroll w100">
					<div class="iscrollWrapper">
						<div class="iscrollScroller">	
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<!--for loop for testing -->
								<? for($ctr=0;$ctr<15;$ctr++){ ?>
								<li>
									<div class="fLeft w60">
										<div class="fLeft w25">
											<div class="fLeft w100 itemCode ">
												<?php echo $this->Form->input('Item Code',array('readonly'=>'readonly','value'=>'23','label'=>false)); ?>
											</div>
										</div>
										<div class="fRight w75">
											<div class="fLeft w80 ">
												<?php echo $this->Form->input('Description',array('readonly'=>'readonly','value'=>'Mr.Chips','label'=>false)); ?>
											</div>
											<div class="fRight w20 ">
												<?php echo $this->Form->input('Unit',array('readonly'=>'readonly','value'=>'pcs','label'=>false)); ?>
											</div>
										</div>
									</div>
									<div class="fRight w40">
										<div class="fLeft w50">
											<div class="fLeft w50 qty ">
												<?php echo $this->Form->input('Qty',array('readonly'=>'readonly','value'=>'28','label'=>false)); ?>
											</div>
											<div class="fRight w50 money ">
												<?php echo $this->Form->input('Selling Price',array('readonly'=>'readonly','value'=>'6.00','label'=>false)); ?>
											</div>
										</div>
										<div class="fRight w50">
											<div class="fLeft w50 money ">
												<?php echo $this->Form->input('Amount',array('readonly'=>'readonly','value'=>'168.00','label'=>false)); ?>
											</div>
											<div class="fRight w50 money ">
												<?php echo $this->Form->input('Average Price',array('readonly'=>'readonly','value'=>'6.00','label'=>false)); ?>
											</div>
										</div>
									</div>
									<div class="fClear"></div>
								</li>
							<? } ?>	<!--end of for loop-->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="fRight pt5 topaz">
			<?php echo $this->Form->submit('Save',array('class'=>'selected fwb'));?>
			<?php echo $this->Form->submit('Cancel',array('class'=>'selected fwb'));?>
		</div><div class="fClear"></div>
	</div>
<?php echo $this->Form->end();?>