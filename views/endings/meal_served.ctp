<?php
	echo $this->Html->script(array('ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'biz/endings_meals'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
</style>
<div id="myDialog"></div>
<div class="tab w100">
	<div class="tab-header">Ending Inventory - Meals</div>
	<div class="tab-content">
		<!--View Ending Inventory-->	
		<div class="canteen form formNeat w98 mCenter">
			<?php echo $this->Form->create('Ending',array('action'=>'add'));?>
			<?php echo $this->Form->input('ref_no',array('type'=>'hidden', 'value'=>$ref));?>
			<?php echo $this->Form->input('type',array('type'=>'hidden', 'value'=>'MEALS'));?>
			<?php echo $this->Form->input('login',array('type'=>'hidden', 'value'=>$user['id']));?>
			<?php echo $this->Form->input('user',array('type'=>'hidden', 'value'=>$user['userFull']));?>
			<div class="tab record metro nmLeft w100 mCenter">
				<h2 class="tab-header recordTitle b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
					<?php echo 'Entry ('.date("F j, Y").')'; ?>
				</h2>
				<div class="tab-content nmBottom5">
					<div class="fLeft w100 ">
						<div class="fLeft w65 pt2 input_mode">
							<?php 
							$options = array(
								'1' => 'Barcode', 
								'2' => 'Structured',
							);
							
							echo $this->Form->input('Not.inputType', array(
								'type' =>'radio',
								'options' => $options,
								'div'=>false,
								'legend'=>false,
								'default'=>'2'
								));
							?>
						</div>
						<div class='fClear'></div>
					</div>
					<div class="fClear"></div>	
					<div class="fLeft w35 hide">
						<div class="fLeft w65 pt2">
							<span class="fwb small pLeft">Sort order:</span>
							<select id="ordering"  class="h20 fsSmall">
								<option value="MenuItem.item_code">Item Code</option>
								<option value="MenuItem.name">Description</option>
								<option value="MenuItem.qty">Qty</option>
							</select>
						</div>
						<div class="fRight topaz w35">
							<?php echo $this->Form->submit('Go',array('type'=>'button','class'=>'selected fwb order_button ','id'=>false));?>
						</div>	
						<div class='fClear'></div>
					</div>
					<div class='fClear'></div>
				<hr/>
					<div class="recordHeader pbtm btmShadow posRelative" style='padding-top: 7px;'>
						<div class="fLeft w80 recordHeaderz">
							<div class="fLeft w25">
								<div class="fLeft w95">Item Code</div>
							</div>
							<div class="fRight w75">
								<div class="fLeft w80">Description</div>
								<div class="fLeft w20">Unit</div>
								<div class="fClear"></div>							
							</div>
						</div>
						<div class="fRight w20">
							<div class="fLeft w75">Qty</div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>
					<div class="iscroll w100" id="ending_Inventory" style='margin-top: -26px;'>
						<div class="iscrollWrapper">							
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<li class="mainInput">
									<div class="fLeft w80">
										<div class="hide id">											
											<?php echo $this->Form->input('EndingDetail.%.id_product',array('type'=>'hidden', 'id'=>false)); ?>
										</div>
										<div class="hide qtyC">											
											<?php echo $this->Form->input('EndingDetail.%.computer_qty',array('type'=>'hidden', 'id'=>false)); ?>
										</div>
										<div class="fLeft w25">
											<div class="fLeft w100 item_code">												
												<?php echo $this->Form->input('EndingDetail.%.item_code',array('label'=>false,'id'=>false, 'frm'=>'#itemCheck', 'linkto'=>'#MenuItemItemCode', 'class'=>'ajax unique numeric', 'readonly'=>'readonly')); ?>
											</div>
										</div>
										<div class="fRight w75">
											<div class="fLeft w80 desc">
												<?php echo $this->Form->input('EndingDetail.%.name',array('label'=>false, 'class'=>'productAuto','id'=>false, 'readonly'=>'readonly')); ?>
											</div>
											<div class="fRight w20 unit">
												<?php echo $this->Form->input('EndingDetail.%.unit_id',array('type'=>'text','label'=>false,'id'=>false,'class'=>'required option', 'readonly'=>'readonly')); ?>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w20">
										<div class="fLeft w70 qty required">
											<?php echo $this->Form->input('EndingDetail.%.qty',array('label'=>false, 'class'=>'numeric ','id'=>false, 'value'=>'X')); ?>
										</div>
										<div class="fRight w30">
											<a class="recordDelete taLeft" href="#">X</a>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</li>
							</ul>	
						</div>
					</div>
					<div class="fLeft pt5">
						<div class="fLeft w65">
							<select id="printOpt"  class="h20 fsSmall ">
								<option value="%">Select One</option>
								<option value="blank">Blank form</option>
								<option value="accomplish">Accomplished</option>
							</select>
						</div>
						<div class="fRight topaz w35">
							<?php echo $this->Form->submit('Print',array('type'=>'button','class'=>'selected fwb print_button ','id'=>false ));?>
						</div>	
						<div class='fClear'></div>
					</div>
					<div class="fRight pt5 topaz">
						<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button','id'=>false));?>
					</div>
					<div class="fClear"></div>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
		<?php echo $this->Form->create('MenuItem',array('id'=>'itemCheck', 'action'=>'getByMenuItemCode'));?>
		<?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>
