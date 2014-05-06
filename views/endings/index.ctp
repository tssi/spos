<?php
	echo $this->Html->script(array('ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'biz/endings'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
</style>
<div id="myDialog"></div>
<div class="tab w100">
	<div class="tab-header">Ending Inventory - Merchandise</div>
	<div class="tab-content">
	<!--View Ending Inventory-->	
		<div class="canteen form formNeat w98 mCenter">
			<?php echo $this->Form->create('Ending',array('action'=>'add'));?>
			<?php echo $this->Form->input('ref_no',array('type'=>'hidden', 'value'=>$ref));?>
			<?php echo $this->Form->input('login',array('type'=>'hidden', 'value'=>$user['id']));?>
			<?php echo $this->Form->input('type',array('type'=>'hidden', 'value'=>'MERCH'));?>
			<?php echo $this->Form->input('user',array('type'=>'hidden', 'value'=>$user['userFull']));?>
			<div class="tab record metro nmLeft w100 mCenter">
				<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
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
								<option value="Product.item_code">Item Code</option>
								<option value="Product.name">Description</option>
								<option value="Product.qty">Qty</option>
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
						<div class="fLeft w65 recordHeader">
							<div class="fLeft w77">
								<div class="fLeft w32 ">
									Item Code
								</div>
								<div class="fRight w68 ">
									Item Description
								</div>
								<div class="fClear"></div>
							</div>
							<div class="fRight w13">
								Unit						
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w35 ">
							<div class="fLeft w60 ">
								<div class="fLeft w42 ">
									Beginning
								</div>
								<div class="fRight w58 ">
									Sale
								</div>
								<div class="fClear"></div>
							</div>
							<div class="fRight w40 ">
								<div class="fLeft w63 ">
									Ending
								</div>
								<div class="fClear"></div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>
					<div class="iscroll w100" id="ending_Inventory" style='margin-top: -26px;'>
						<div class="iscrollWrapper">							
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<li class="mainInput">
									<div class="fLeft w65">
										<div class="hide id">											
											<?php echo $this->Form->input('EndingDetail.%.id_product',array('type'=>'hidden', 'id'=>false)); ?>
										</div>
										<div class="hide qtyC">											
											<?php echo $this->Form->input('EndingDetail.%.computer_qty',array('type'=>'hidden', 'id'=>false)); ?>
										</div>

										<div class="fLeft w90">
											<div class="fLeft w25 item_code">
												<?php echo $this->Form->input('EndingDetail.%.item_code',array('label'=>false,'id'=>false, 'frm'=>'#itemCheck', 'linkto'=>'#ProductItemCode', 'class'=>'ajax unique numeric', 'readonly'=>'readonly')); ?>
											</div>
											<div class="fRight w75 desc">
												<?php echo $this->Form->input('EndingDetail.%.name',array('label'=>false, 'class'=>'productAuto','id'=>false, 'readonly'=>'readonly')); ?>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w10 unit">
											<?php echo $this->Form->input('EndingDetail.%.unit_id',array('type'=>'text','label'=>false,'id'=>false,'class'=>'required option', 'readonly'=>'readonly')); ?>				
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w35">
										<div class="fLeft w60 ">
											<div class="fLeft w50 beginning_qty">
												<?php echo $this->Form->input('EndingDetail.%.beginning_qty',array('label'=>false, 'class'=>'numeric ','id'=>false, 'value'=>'X')); ?>
											</div>
											<div class="fRight w50 sale_qty">
												<?php echo $this->Form->input('EndingDetail.%.sale_qty',array('label'=>false, 'class'=>'numeric ','id'=>false, 'value'=>'X')); ?>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fRight w40 ">
											<div class="fLeft w75 ending_qty">
												<?php echo $this->Form->input('EndingDetail.%.ending_qty',array('label'=>false, 'class'=>'numeric ','id'=>false, 'value'=>'X')); ?>
											</div>
											<div class="fLeft w25">
												<a class="recordDelete taLeft" href="#">X</a>
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
			
			<div class="fClear"></div>
			<?php echo $this->Form->end(); ?>
		</div>
		<?php echo $this->Form->create('Product',array('id'=>'itemCheck', 'action'=>'getByProductCode'));?>
		<?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>
