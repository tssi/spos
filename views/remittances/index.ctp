<?php
	echo $this->Html->script(array(
	'ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'biz/remit'
	));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'
								));
?>
<script>
$(document).ready(function(){
	$('.uiNotify').removeClass('mAll pad4'); 
}); 
</script>
<style>
	.w238px{
		width: 238px !important;
	}
</style>


<div id="dialog" class="dialogBox"></div>

<div class='tab'>
	<div class='tab-header'>Remittance</div>
	<?php echo $this->Form->create('Remittance', array('action'=>'add'));?>
	<div class='tab-content'>
		<div class="canteen form formNeat w95 mCenter ">
			<div class='fLeft w40 classic soft id'>
				<?php echo $this->Form->input('created', array('type'=>'text', 'label'=>'Time'));?>
			</div>
			<div class='fClear'></div>
		</div>
		<div class="canteen form formNeat w95 mCenter">
			<div class='fLeft w40 classic soft'>
				<?php echo $this->Form->input('cashier',array('type'=>'hidden','label'=>'Cashier ID', 'value'=>$user['id'], 'readonly'=>'readonly'));?>
				<?php echo $this->Form->input('cashier_name',array('label'=>'Cashier Name','value'=>$user['first_name'].' '.$user['middle_name'].' '.$user['last_name']));?>
			</div>
			<div class='fLeft w40 classic soft'>
				<?php echo $this->Form->input('collector',array('type'=>'hidden','label'=>'Collector ID', 'value'=>''));?>
			</div>
			<div class='fRight w40 classic soft'>
				<?php echo $this->Form->input('collector_name',array('label'=>'Collector Name', 'class'=>'collectorAuto'));?>
			</div>
			<div class='hide'>
				<?php echo $this->Form->input('ref_no',array('type'=>'hidden'));?>
			</div>
			<div class='fClear'></div>	
		</div>
		<hr>
		<div class="canteen form formNeat w95 mCenter " id='Remittances'>
			<div class='fLeft w100 classic soft '>
				<?php echo $this->Form->input('sales_amount',array('class'=>"w238px monetary", 'readonly'=>'readonly'));?>
				<div class='fwb fsSmall bgLime w100 taCenter pbtm'>Remittance</div>
				<?php echo $this->Form->input('Previous',array('class'=>"w238px monetary numeric", 'readonly'=>'readonly'));?>
				<?php echo $this->Form->input('remitted',array('class'=>"w238px monetary numeric",'label'=>'Current'));?>
			</div>
			<div class='fRight w50 classic soft'>
				<?php echo $this->Form->input('total ' ,array('class'=>" monetary numeric"));?>
			</div>
			<div class='fClear'></div>
		</div>
		<hr>
		<div class="canteen form formNeat w95 mCenter">
			<div class='fLeft w50 classic soft'>
				<?php echo $this->Form->input('cash_in_box',array('label'=>'Cash in Box', 'class'=>'monetary numeric', 'readonly'=>'readonly'));?>
			</div>
			<div class="fRight pt5 topaz pbtm pRight">
				<?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb','id'=>'cancel_button'));?>
			</div>
			<div class="fRight pt5 pbtm pRight">
				<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button' ,'id'=>'save_button','disabled'=>'disabled'));?>
			</div>
			<div class='fClear'></div>
		</div>
		<?php echo $this->Form->end();?>
		<!--Data Grid-->
		<div class="canteen form formNeat w100 mCenter pbtm14 nmall">
			<div class="record tab nmLeft w80 mCenter">
			<h2 class="recordTitle tab-header b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
				<?php echo 'View Remittances ( '.date('D, F d, Y').' )';?> 
			</h2>
			<?php echo $this->Form->create('Remittance', array('action'=>'view'));?>
			<div class="tab-content nmBottom posRelative ">
				<div class="recordHeader pbtm btmShadow">
					<div class="fLeft w35">
						<div class="fLeft w50 ">
							Time
						</div>
						<div class="fRight w50">
							Cash
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fRight w65">
						<div class="fLeft w50">
							<div class="fLeft w50 ">
								Charge
							</div>
							<div class="fRight w50">
								Prepaid
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w50">
							<div class="fLeft w50 ">
								Others
							</div>
							<div class="fRight w50">
								Total
							</div>
							<div class="fClear"></div>	
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fClear"></div>
				</div>
				<div class="iscroll metro w100" id="remittance_view">
					<div class="iscrollWrapper">							
						<ul class="recordDatagrid on w100 b1sg nbLeft nbRight">
							<li class="mainInput">
								<div class="fLeft w35">
									<div class="fLeft w50 VIEWtime">
										<?php echo $this->Form->input('Remmitance.%.time',array('type'=>'text','id'=>false, 'label'=>false, 'readonly'=>'readonly', 'class'=>'taLeft')); ?>
									</div>
									<div class="fRight w50 VIEWcash">
										<?php echo $this->Form->input('Remmitance.%.cash',array('type'=>'text','id'=>false, 'label'=>false ,'readonly'=>'readonly', 'class'=>'monetary taRight')); ?>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fRight w65">
									<div class="fLeft w50">
										<div class="fLeft w50 VIEWcharge">
											<?php echo $this->Form->input('Remmitance.%.charge',array('type'=>'text','id'=>false, 'label'=>false, 'readonly'=>'readonly')); ?>
										</div>
										<div class="fRight w50">
											<?php echo $this->Form->input('Remmitance.%.prepaid',array('type'=>'text','id'=>false,'readonly'=>'readonly', 'label'=>false, 'class'=>'monetary')); ?>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w50">
										<div class="fLeft w50">
											<?php echo $this->Form->input('Remmitance.%.others',array('type'=>'text','id'=>false, 'label'=>false,'readonly'=>'readonly', 'class'=>'monetary')); ?>
										</div>
										<div class="fRight w50 VIEWtotal">
											<?php echo $this->Form->input('Remmitance.%.total',array('type'=>'text','id'=>false, 'label'=>false,'readonly'=>'readonly', 'class'=>'monetary taRight')); ?>
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
			<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>


	
	
</div>