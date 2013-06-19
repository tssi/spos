<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
.pd116{
	padding-left: 116px;
}

</style>
<? echo $this->Form->create('Remittance');?>
	<div class="canteen form formNeat w100">
		<div class=" wLong mCenter">
				<div class="fRight w50">
					
					<div class="classic bigAmount money soft pd116">
						<div>Total Collection as of:  <? echo date( ' H:i:s',time()+(7*60*60)); ?></div>
						<?php
							echo $this->Form->input('Total Collection',array('type'=>'text','label'=>false,'class'=>'hMini','value'=>'1000.00'));
						?>
					</div>
				</div>
				<div class="fClear"></div>
		</div>
		
		<div class="wWider mCenter classic soft pt5">
			<div class="fLeft w50">
				<?php echo $this->Form->input('Remitance No'); ?>
				<?php echo $this->Form->input('Remit By'); ?>
			</div>
			<div class="fRight w50">
					<?php echo $this->Form->input('Date and Time'); ?>
					<?php echo $this->Form->input('Amount'); ?>
			</div>
			<div class="fClear"></div>
		</div>
		
		
		<div class="wWider mCenter metro pt5">
			<div class="fLeft topaz w50">
				<div class="fRight w90">
					<?php 	echo $this->Form->submit('Close',array('type'=>'button','class'=>'selected fwb wideButton',));?>
				</div>
				<div class="fClear"></div>	
			</div>
			<div class="fRight w25 topaz">
				<div class="fRight w90">
					<?php 	echo $this->Form->submit('Remit',array('type'=>'button','class'=>'selected fwb wideButton'));
							echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb'));
					?>		
				</div>
				<div class="fClear"></div>	
			</div>
			<div class="fClear"></div>
		</div>
		<br>
		
		<div class="hMini pt5">
			Collection for the day <? echo date( 'M-d-Y',time()+(7*60*60)); ?> as of <? echo date('H:i:s',time()+(7*60*60)); ?>
		</div>
		
		
		<div class="tab record metro nmLeft w100 mCenter h257">
			<h2 class="recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter ">
				&nbsp
			</h2>
			<div class="tab-content nmBottom posRelative">
				<div class="pbtm btmShadow">
					<div class="fLeft w40 recordHeader">
						<div class="fLeft w50">
							<div class="fLeft w100">Collection</div>
						</div>
						<div class="fRight w50">
							<div class="fLeft w100 ">Remitance</div>
							<div class="fClear"></div>							
						</div>
					</div>
					<div class="fRight w60 recordHeader">
						<div class="fLeft w65 ">
							<div class="fLeft w50 ">Time</div>
							<div class="fLeft w50 ">Balance</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w35">
							<div class="fLeft w100 ">Ref.#/doc</div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fClear"></div>
				</div>
				
				<div class="iscroll w100 h198">
					<div class="iscrollWrapper">
							
						<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
							<li class="mainInput">
								
								<div class="fLeft w40">
									<div class="fLeft w50">
										<div class="fLeft w100">
											<?php echo $this->Form->input('Remitance.%.collection',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?> 
										</div>
									</div>
									<div class="fRight w50">
										<div class="fLeft w100 ">
											<?php echo $this->Form->input('Remitance.%.remitance',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?> 
										</div>
										<div class="fClear"></div>							
									</div>
								</div>
								<div class="fRight w60">
									<div class="fLeft w65 ">
										<div class="fLeft w50 ">
											<?php echo $this->Form->input('Remitance.%.time',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?> 
										</div>
										<div class="fLeft w50 ">
											<?php echo $this->Form->input('Remitance.%.balance',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?> 
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w35">
										<div class="fLeft w100 ">
											<?php echo $this->Form->input('Remitance.%.ref_no',array('readonly'=>'readonly','label'=>false,'id'=>false)); ?> 
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
		
		
	
	</div>
<?php echo $this->Form->end();?>