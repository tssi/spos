<?php
	echo $this->Html->script(array(
	'ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'ui/uiAmountToWords',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'biz/petty',
	));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'
								));
?>

<script>
$(document).ready(function(){
	$('.uiNotify').removeClass('mAll pad4'); 
}); 
</script>
<div id="myDialog" class="myDialog"></div>

<div class='tab'>
	<h2 class="recordTitle tab-header b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
						Petty Cash / Liquidation
					</h2>
	<?php echo $this->Form->create('PettyCash', array('action'=>'add'));?>
	<div class='tab-content'>
		<div class="canteen form formNeat w95 mCenter main">
					<div class="fLeft metro picker pbtm">
						<span class="sapphire"><?php echo $this->Form->submit('Petty Cash',array('type'=>'button','id'=>'cash_button', 'equals'=>'PTY')); ?></span>
						<span class="ruby"><?php echo $this->Form->submit('Liquidate',array('type'=>'button','id'=>'prepaid_button', 'equals'=>'LQD')); ?></span>
					</div>
					<div class='fRight w40 classic soft'>
						<?php echo $this->Form->input('ref_no',array('type'=>'text', 'label'=>'Ref No', 'value'=>$ref_no, 'readonly'=>'readonly'));?>
						<?php echo $this->Form->input('trans_type',array('type'=>'hidden', 'label'=>false, 'readonly'=>'readonly'));?>
						<?php echo $this->Form->input('flag',array('type'=>'hidden', 'label'=>false, 'readonly'=>'readonly')); ?>
					</div>
			
			<div class='fClear'></div>
			<div class='fLeft w60 classic soft'>
				<?php echo $this->Form->input('employee_name',array('type'=>'text', 'label'=>'Employee Name', 'class'=>'employeeAuto', 'readonly'=>'readonly'));?>
				
			</div>
			<div class='fLeft w40 classic soft'>
				<?php echo $this->Form->input('employee',array('type'=>'text', 'label'=>'Employee Id', 'readonly'=>'readonly'));?>
			</div>
			<div class='fLeft w40 classic soft id'>
				<?php echo $this->Form->input('created', array('type'=>'text', 'label'=>'Date / Time'));?>
			</div>
			<div class='fLeft w60 classic soft'>
				<?php echo $this->Form->input('login',array('label'=>'Login','value'=>$user['userFull'],'readonly'=>'readonly'));?>
			</div>
			
			<div class='fClear'></div>	
			<div class='fLeft w40 classic soft money'>
				<?php echo $this->Form->input('amount',array('type'=>'text', 'label'=>'Amount', 'class'=>'monetary', 'readonly'=>'readonly'));?>
			</div>
			<div class='fLeft w100 classic soft'>
				<?php echo $this->Form->input('amtwords',array('type'=>'text', 'label'=>'Amount in words', 'readonly'=>'readonly'));?>
			</div>
			<div class='fLeft w100 classic soft'>
				<?php echo $this->Form->input('purpose',array('type'=>'text', 'label'=>'Purpose', 'readonly'=>'readonly'));?>
			</div>
			<div class='fClear'></div>	
		<hr>
			<div class="fRight pt5 topaz pbtm pRight">
				<?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb','id'=>'cancel_button'));?>
			</div>
			<div class="fRight pt5 topaz pbtm pRight">
				<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button' ,'id'=>'save_button' ));?>
			</div>
			<div class='fClear'></div>
		
		<?php echo $this->Form->end();?>
		</div>
		<!--Data Grid-->
		<div class="canteen form formNeat w100 mCenter pbtm14 nmall">
			<div class="record tab nmLeft w80 mCenter">
			<h2 class="recordTitle tab-header b1saqua  bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
				History 
			</h2>
			<?php echo $this->Form->create('PettyCash', array('action'=>'view'));?>
			<div class="tab-content nmBottom posRelative ">
				<div class="recordHeader pbtm btmShadow">
					<div class="fLeft w30">
						<div class="fLeft w75">
							Date
						</div>
						<div class="fRight w25">
							Transc.
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fRight w70">
						<div class="fLeft w70">
							<div class="fLeft w100">
								Description
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w30">
							<div class="fLeft w50 ">
								Amount
							</div>
							<div class="fRight w50">
								Balance
							</div>
							<div class="fClear"></div>	
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fClear"></div>
				</div>
				<div class="iscroll metro w100" id="petty_view">
					<div class="iscrollWrapper">							
						<ul class="recordDatagrid on w100 b1sg nbLeft nbRight">
							<li class="mainInput">
								<div class="fLeft w30">
									<div class="fLeft w75 created">
										<?php echo $this->Form->input('PettyCash.%.created',array('type'=>'text','id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
									</div>
									<div class="fRight w25 ttype">
										<?php echo $this->Form->input('PettyCash.%.trans_type',array('type'=>'text','id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fRight w70">
									<div class="fLeft w70">
										<div class="fLeft w100 purpose">
											<?php echo $this->Form->input('PettyCash.%.purpose',array('type'=>'text','id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w30">
										<div class="fLeft w50 amt">
											<?php echo $this->Form->input('PettyCash.%.amount',array('type'=>'text','id'=>false, 'label'=>false, 'readonly'=>'readonly', 'class'=>'monetary')); ?>
										</div>
										<div class="fRight w50 bal">
											<?php echo $this->Form->input('PettyCash.%.balance',array('type'=>'text','id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
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
				<div class="padLeft fLeft pt5 ">
						<strong>Filter:</strong>
						<select id="filtering">
													<option value="ADV">Advances</option>
													<option value="LQD">Liquidations</option>
													<option value="ALL">All</option>
													<option value="LED">Ledger</option>
												</select>
												
						
				</div>
				<div class="fLeft pt5 topaz pbtm">
						<?php echo $this->Form->submit('Go',array('type'=>'button','class'=>'selected fwb order_button','id'=>false));?>
				</div>
				<div class="fClear"></div>
			</div>	
			<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>


	
	
</div>