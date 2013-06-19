<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<? echo $this->Form->create('AddAccesories');?>
	<div class="canteen form formNeat w100">
		<div class="w80 metro soft">
			<div class="fLeft w40">
				<?php echo $this->Form->input('Reference No'); ?>
			</div>
			<div class="fRight w25">
				<?php echo $this->Form->input('Date/Time'); ?>
			
			</div>
			<div class="fClear"></div>
		</div>
		<div class="wLong  metro soft pt5">
				<div class="fLeft  metro picker w60 pearl">
					<?php
						echo $this->Form->submit('Non Stockable Ingredient',array('type'=>'button','class'=>'wideButton'));
						echo $this->Form->submit('Supplemental Ingredient',array('type'=>'button','class'=>'wideButton'));
						echo $this->Form->submit('Accesories',array('type'=>'button'));
					?>
				</div>
				<div class="fRight metro picker w40 pearl">
					<?php
						echo $this->Form->submit('Utensils',array('type'=>'button'));
						echo $this->Form->submit('Properties',array('type'=>'button'));
					?>
				</div>
				<div class="fClear"></div>
		</div>
		<div class="w95 mCenter pt5">
			<div class="tab record metro nmLeft">
				<h2 class="recordTitle b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
				Accesories
				</h2>	
				<div class="tab-content nmBottom posRelative" >	
					<div class="recordHeader pbtm btmShadow">
						<div class="fLeft w40 recordHeader">
							<div class="fLeft w100"> Item Description</div>
						</div>
						<div class="fRight w60 recordHeader">
							<div class="fLeft w50">
								<div class="fLeft w50">Unit</div>
								<div class="fRight w50">Qty</div>
							</div>
							<div class="fRight w50">
								<div class="fLeft w50">Price</div>
								<div class="fRight w50">Amount</div>
							</div>
						</div>
						<div class="fClear"></div>
					</div>
					<div class="iscroll w100" id="add_accesories">
						<div class="iscrollWrapper">
							<div class="iscrollScroller">
								<ul class="recordDatagrid on w100 h175px b1sg  nbLeft nbRight">
									<!--for loop for testing -->
									<? for($ctr=1;$ctr<11;$ctr++){ ?>
									<li>
										<div class="fLeft w40 recordHeader">
											<?php echo $this->Form->input('Description',array('readonly'=>'readonly','value'=>'Item '.$ctr.'','label'=>false)); ?>
										</div>
										<div class="fRight w60 recordHeader">
											<div class="fLeft w50">
												<div class="fLeft w50 ">
													<?php echo $this->Form->input('Unit',array('readonly'=>'readonly','value'=>'Pcs','label'=>false)); ?>
												</div>
												<div class="fRight w50 qty">
													<?php echo $this->Form->input('Qty',array('readonly'=>'readonly','value'=>'25','label'=>false)); ?>
												</div>
											</div>
											<div class="fRight w50">
												<div class="fLeft w50 money">
													<?php echo $this->Form->input('Price',array('readonly'=>'readonly','value'=>'45.00','label'=>false)); ?>
												</div>
												<div class="fRight w50 money">
													<?php echo $this->Form->input('Amount',array('readonly'=>'readonly','value'=>'1125.00','label'=>false)); ?>
												</div>
											</div>
										</div>
										<div class="fClear"></div>
									</li>
									<? } ?>	
									<!--end of for loop-->
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="fClear"></div>
		</div>
		<div class="fLeft wLong metro">
			<div class="fRight w20 topaz">
				<div class="fLeft w50 pt5"><?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'noIdle'));?></div>		
				<div class="fRight w50 pt5"><?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'noIdle'));?></div>		
				<div class="fClear"></div>	
			</div>
		</div>
		<div class="fClear"></div>
		
		
	</div>
<?php echo $this->Form->end();?>