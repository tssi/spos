<?php
	echo $this->Html->script(array('ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'ss/ssUtil',
	'biz/stateAccount',
	));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
</style>
<div id="myDialog"></div>	
<?php echo $this->Form->create('SalePayment', array('action'=>'sa_report', 'target'=>'_blank'));?>
<?php echo $this->Form->input('data',array('type'=>'hidden','id'=>'dataHere'));?>
<div class="tab w100">
	<div class="tab-header">Statement Of Accounts</div>
	<div class="tab-content nmBottom5">
		<div class="canteen form formNeat w98 mCenter">
			<div class="metro picker state_mode">
				<span class="sapphire"><?php echo $this->Form->submit('Charge',array('type'=>'button','id'=>'charge_button', 'mode'=>'CH')); ?></span>
				<span class="ruby"><?php echo $this->Form->submit('Prepaid',array('type'=>'button','id'=>'prepaid_button', 'mode'=>'PR')); ?></span>
			</div>
			
			<hr/>
			<br/>
			
			
			<div class="metro picker viewBy" style="padding-left: 6%;">
				<span class="emerald"><?php echo $this->Form->submit('Itemized ',array('type'=>'button','id'=>'itemized', 'mode'=>'itemized')); ?></span>
				<span class="emerald"><?php echo $this->Form->submit('By transaction ',array('type'=>'button','id'=>'bytransaction','mode'=>'transaction')); ?></span>
			</div>
			<br/>
			<div class="w100 classic soft ">
				<div class="fLeft w30">
					<?php echo $this->Form->input('reference_id',array('type'=>'text','id'=>'reference','placeholder'=>'Enter ID','style'=>'width: 30%;',
							'label'=>'<select id="by"><option value="E">Employee</option><option value="S">Student</option></select>')); ?>
				</div>
				<div class="fRight w70">
					<?php echo $this->Form->input('name',array('type'=>'text','id'=>'chargee','placeholder'=>'Name', 'disabled'=>true)); ?>
				</div>
				<div class="fClear"></div>
			</div>
			<div class="w100 classic soft ">
				<div class="fRight w40">
					<?php echo $this->Form->input('forwarded_balance',array('type'=>'text','class'=>'taRight','id'=>'forwardBal','style'=>'width: 30%;', 'disabled'=>true)); ?>
				</div>
				<div class="fClear"></div>
			</div>
			
			<div class="fRight pt5 topaz">
				<?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>' fwb close_button','id'=>'cancelIt'));?>
			</div>
			<div class="fRight pt5 topaz">
				<?php echo $this->Form->submit('Print',array('type'=>'button','class'=>' fwb print','id'=>'printIt'));?>
			</div>
			<div class="fClear"></div>
			<hr/>
			
			<div class="w100 classic soft checkDate">
					
					<div class="fLeft w50 ">
						
							<div class="fLeft w50 dateFrom">
								<?php echo $this->Form->input('date_from',array('type'=>'text','id'=>'','style'=>'width: 40%;', 'class'=>'datepicker')); ?>
							</div>
							<div class="fRight w50 dFrom">
								<?php echo $this->Form->checkbox('dFrom', array('hiddenField' => false, 'id'=>false)); ?>
						
							</div>
							<div class="fClear"></div>
						
					</div>
					<div class="fRight w50">
						<div class="fLeft w50 dateTo">
							<?php echo $this->Form->input('date_to',array('type'=>'text', 'id'=>'dTo','style'=>'width: 40%;', 'class'=>'datepicker')); ?>
						</div>
						<div class="fRight w50 dTo">
							<?php echo $this->Form->checkbox('dTo', array('hiddenField' => false, 'id'=>false)); ?>
					
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fClear"></div>
			</div>
			
			<div class="record metro tab nmLeft w90 mCenter" >				
					<h2 class="transLabel recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
						Transactions
					</h2>				
					<div class="tab-content nmBottom posRelative">
						<div class="recordHeader pbtm btmShadow">
							<div class="fLeft w60">
								<div class="fLeft w25">Date</div>
								<div class="fRight w75">Description</div>
							</div>
							<div class="fRight w40 ">
								<div class="fLeft w100 ">
									<div class="fLeft w30 ">Due</div>
									<div class="fRight w70">
										<div class="fLeft w50 ">Payment</div>
										<div class="fRight w50 ">Balance</div>
										<div class="fClear"></div>
									</div>
								</div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="iscroll w100" id="transac">
							<div class="iscrollWrapper">								
								<ul class="recordDatagrid on b1sg  nbLeft nbRight">
									<li class="mainInput">
										<div class="fLeft w60">
											<div class="fLeft w25 date">
												<?php echo $this->Form->input('date', array('label'=>false, 'id'=>false, 'readonly'=>'readonly'));?>
											</div>
											<div class="fRight w75 desc">
												<?php echo $this->Form->input('desc', array('label'=>false, 'id'=>false,'readonly'=>'readonly'));?>
											</div>
										</div>
										<div class="fRight w40 ">
											<div class="fLeft w100 ">
												<div class="fLeft w30 due">
													<?php echo $this->Form->input('due', array('label'=>false,'class'=>'taRight','id'=>false,'readonly'=>'readonly'));?>
												</div>
												<div class="fRight w70">
													<div class="fLeft w50 payment">
														<?php echo $this->Form->input('payment', array('label'=>false,'class'=>'taRight', 'id'=>false,'readonly'=>'readonly'));?>
													</div>
													<div class="fRight w50 bal">
														<?php echo $this->Form->input('balance', array('label'=>false, 'id'=>false,'readonly'=>'readonly'));?>
													</div>
													<div class="fClear"></div>
												</div>
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
		
	</div>
</div>
<?php echo $this->Form->end();?>
