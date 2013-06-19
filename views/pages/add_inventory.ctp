<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<? echo $this->Form->create('AddInventory');?>
	
	<style>
	.nm65{
		margin-left: -65px !important;
	}
	</style>
	
	<div class="canteen form formNeat w100">
		<div class="wLong">
			<div class="fLeft w80 classic soft mCenter">
				<div class="nm65">
					<div class="fLeft w70" >
						<div class="fLeft w100">
							<?php echo $this->Form->input('Vendor'); ?>
						</div>
						<div class="fClear"></div>		
					</div>
					<div class="fClear"></div>	
					
					<div class="fLeft w50 ">
						<div class="fLeft w100 ">
							<?php echo $this->Form->input('Doc Type');?>
						</div>
						<div class="fLeft w100">
							<?php echo $this->Form->input('Doc No');?>
						</div>
						<div class="fLeft w100">
							<?php echo $this->Form->input('Doc Date');?>
						</div>
						<div class="fClear"></div>	
					</div>
					<div class="fRight w50 ">
						<div class="fLeft w100 ">
							<?php echo $this->Form->input('Delivery Date');?>
						</div>
						<div class="fLeft w100">
							<?php echo $this->Form->input('Last CRR No');?>
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fClear"></div>	
				</div>
			</div>
			<div class="fRight w20 metro soft">
				<div class="fLeft w90">
					<?php 
						echo $this->Form->input('LogIn');
						echo $this->Form->input('Date/Time');
					?>
				</div>
				<div class="fClear"></div>
			</div>
			<div class="fClear"></div>
		</div>

		
		<div class="wLong">
			<div class="tab record metro nmLeft">
			<h2 class="recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
						Inventory Item (Shelf Item)
			</h2>
				<div class="tab-content nmBottom posRelative">
					<div class="recordHeader pbtm btmShadow">
						
						
						<div class="fLeft w55 recordHeader">
							<div class="fLeft w75 ">
								<div class="fLeft w80">Item Description</div>
								<div class="fRight w20">Item Code</div>
								<div class="fClear"></div>
							</div>
							<div class="fRight w25">
								<div class="fLeft w55">Bar Code</div>
								<div class="fRight w45">Unit</div>
								<div class="fClear"></div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w45 recordHeader ">
							<div class="fLeft w35">
								<div class="fLeft w45">Qty</div>
								<div class="fRight w55">Unit Price</div>
								<div class="fClear"></div>
							</div>
							<div class="fRight w65">
								<div class="fLeft w45 ">
									<div class="fLeft w55">Amount</div>
									<div class="fRight w45">MU</div>
									<div class="fClear"></div>
								</div>
								<div class="fRight w55">
									<div class="fLeft w50">SP</div>
									<div class="fRight w50">CP</div>
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>
							</div>
							<div class="fClear"></div>
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
										<div class="fLeft w55 recordHeader">
											<div class="fLeft w75 ">
												<div class="fLeft w80">							
													<?php echo $this->Form->input('Item Description',array('readonly'=>'readonly','value'=>'Mr.Chips','label'=>false)); ?>
												</div>
												<div class="fRight w20 itemCode ">	
													<?php echo $this->Form->input('Item Code',array('readonly'=>'readonly','value'=>'23','label'=>false)); ?>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fRight w25">
												<div class="fLeft w55">
													<?php echo $this->Form->input('Bar Code',array('readonly'=>'readonly','value'=>'111','label'=>false)); ?>
												</div>
												<div class="fRight w45">
													<?php echo $this->Form->input('Unit',array('readonly'=>'readonly','value'=>'pcs','label'=>false)); ?>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w45 recordHeader ">
											<div class="fLeft w35">
												<div class="fLeft w45 qty">
													<?php echo $this->Form->input('Qty',array('readonly'=>'readonly','value'=>'75','label'=>false)); ?>
												</div>
												<div class="fRight w55 money">
													<?php echo $this->Form->input('Unit Price',array('readonly'=>'readonly','value'=>'5.00','label'=>false)); ?>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fRight w65">
												<div class="fLeft w45 ">
													<div class="fLeft w55 money">
														<?php echo $this->Form->input('Amount',array('readonly'=>'readonly','value'=>'375.00','label'=>false)); ?>
													</div>
													<div class="fRight w45">
														<?php echo $this->Form->input('MU',array('readonly'=>'readonly','value'=>'MU','label'=>false)); ?>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fRight w55 ">
													<div class="fLeft w50 money">
														<?php echo $this->Form->input('SP',array('readonly'=>'readonly','value'=>'996.00','label'=>false)); ?>
													</div>
													<div class="fRight w50 money">
														<?php echo $this->Form->input('CP',array('readonly'=>'readonly','value'=>'995.00','label'=>false)); ?>
													</div>
													<div class="fClear"></div>
												</div>
												<div class="fClear"></div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</li>
									<? } ?>	<!--end of for loop-->
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="fClear"></div>
			</div>
		</div>
		<div class="fLeft wLong metro">
			<div class="fRight w20 topaz">
				<div class="fLeft w50 pt5"><?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb'));?></div>		
				<div class="fRight w50 pt5"><?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb'));?></div>		
				<div class="fClear"></div>	
			</div>
		</div>
		<div class="fClear"></div>
		
		
	</div>
	

<?php echo $this->Form->end();?>