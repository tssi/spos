<?php
	echo $this->Html->script(array('ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
</style>
<div id="myDialog"></div>	
<?php echo $this->Form->create();?>
<div class="tab w100">
	<div class="tab-header">Statement Of Accounts</div>
	<div class="tab-content nmBottom5">
		<div class="canteen form formNeat w98 mCenter">
	
	
			<div class="metro picker ">
				<span class="sapphire"><?php echo $this->Form->submit('Charge',array('type'=>'button','id'=>'charge_button')); ?></span>
				<span class="ruby"><?php echo $this->Form->submit('Prepaid',array('type'=>'button','id'=>'prepaid_button')); ?></span>
			</div>
			<br/>
			<div class="w100 classic soft">
				<div class="fRight w75">
						<div class="fLeft w50">
							<?php echo $this->Form->input('date_from',array('type'=>'text','id'=>'','style'=>'width: 30%;')); ?>
						</div>
						<div class="fRight w50">
							<?php echo $this->Form->input('date_to',array('type'=>'text','id'=>'','style'=>'width: 30%;')); ?>
						</div>
						<div class="fClear"></div>
				</div>
				<div class="fClear"></div>
			</div>
			<hr/>
			<div class="metro picker " style="padding-left: 6%;">
				<span class="emerald"><?php echo $this->Form->submit('Itemized ',array('type'=>'button','id'=>'')); ?></span>
				<span class="emerald"><?php echo $this->Form->submit('By transaction ',array('type'=>'button','id'=>'')); ?></span>
			</div>
			<br/>
			<div class="w100 classic soft ">
				<div class="fLeft w35">
					<?php echo $this->Form->input('reference_id',array('type'=>'text','id'=>'','style'=>'width: 30%;')); ?>
				</div>
				<div class="fRight w65">
					<?php echo $this->Form->input('name',array('type'=>'text','id'=>'')); ?>
				</div>
				<div class="fClear"></div>
			</div>
			<div class="w100 classic soft ">
				<div class="fRight w37">
					<?php echo $this->Form->input('forwarded_balance',array('type'=>'text','id'=>'','style'=>'width: 30%;')); ?>
				</div>
				<div class="fClear"></div>
			</div>
			
			<div class="record metro tab nmLeft w75 mCenter" >				
					<h2 class="recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter">
						Accounts
					</h2>				
					<div class="tab-content nmBottom posRelative">
						<div class="recordHeader pbtm btmShadow">
							<div class="fLeft w55">
								<div class="fLeft w30 ">Date</div>
								<div class="fRight w70 ">Description</div>
							</div>
							<div class="fRight w45">
								<div class="fLeft w75 ">
									<div class="fLeft w55">Charge</div>
									<div class="fRight w45">Prepaid</div>
								</div>
								<div class="fRight w25 "></div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="iscroll w100" id="">
							<div class="iscrollWrapper">								
								<ul class="recordDatagrid on b1sg  nbLeft nbRight">
									<li class="mainInput">
										<div class="fLeft w55">
											<div class="fLeft w25 desc"><?php echo $this->Form->input('date',array('readonly'=>'','label'=>false,'id'=>false)); ?></div>
											<div class="fRight w75 qty"><?php echo $this->Form->input('description',array('readonly'=>'','label'=>false,'id'=>false)); ?></div>
										</div>								
										<div class="fRight w45">
											<div class="fLeft w80 money">
												<div class="fLeft w50 price"><?php echo $this->Form->input('charge',array('readonly'=>'','label'=>false,'id'=>false)); ?></div>
												<div class="fLeft w50 amount"><?php echo $this->Form->input('prepaid',array('readonly'=>'','label'=>false,'id'=>false)); ?></div>
											</div>
											<div class="fRight w20 ">
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
				
			
			
		</div>
		
	</div>
</div>
<?php echo $this->Form->end();?>