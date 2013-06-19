<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiInputNumeric','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid', 'biz/receiving'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>

<script>
	$(document).ready(function(){
		$('#ReceivingDocType,#ReceivingDocNo,#ReceivingDateTime').siblings().css('margin-left','-60px');
	});
</script>
<div id="myDialog"></div>
	<div class="tab">
	<div class="tab-content">
		<div class="canteen form formNeat w100">
			<?php echo $this->Form->create('Receiving', array('action'=>'add'));?>
			<div class="hdrReceive w100">
				<div class="fLeft w40  classic soft">
					<?php echo $this->Form->input('vendor_name',array('type'=>'text','label'=>'Vendor Name', 'class'=>'vendorAuto required'));?>
				</div>
				<div class="fRight w60  classic soft">
					<div class="fLeft w50"><?php echo $this->Form->input('date_time',array('type'=>'text','label'=>'Date', 'class'=>'datepicker required'));?></div>
				</div>
				<div class="fClear"></div>
				
				<div class="fLeft w40  classic soft">
					<?php echo $this->Form->input('vendor_id',array('type'=>'text','label'=>'Vendor ID', 'class'=>'required'));?>
				</div>
				<div class="fRight w60 classic soft">
					<div class="fLeft w50"><?php echo $this->Form->input('doc_type',array('type'=>'text', 'class'=>'required'));?></div>
					<div class="fRight w50"><?php echo $this->Form->input('doc_no',array('type'=>'text','label'=>'Doc No', 'class'=>'required'));?></div>
					<div class="fClear"></div>
				</div>
				<div class="fClear"></div>
			</div>

		
			<div class="tab record metro nmLeft w95 mCenter">
				<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">List</h2>
				<div class="tab-content  nmBottom posRelative ">
				
						
						<div class="recordHeader pbtm btmShadow">
							<div class="fLeft w100 ">
								<div class="fLeft w50">
									<div class="fLeft w35 ">Item Code</div>
									<div class="fRight w65 ">Item Description</div>
									<div class="fClear"></div>			
								</div>
								<div class="fRight w50 ">
									<div class="fLeft w40 ">
										<div class="fLeft w50 ">Qty</div>
										<div class="fRight w50 ">Unit</div>
										<div class="fClear"></div>
									</div>
									<div class="fLeft w60 ">
											<div class="fLeft w40 ">PP</div>
											<div class="fRight w60">
												<div class="fLeft w70">Amount</div>
												<div class="fRight w30 "></div>
												<div class="fClear"></div>									
											</div>
										<div class="fClear"></div>
									</div>
									<div class="fClear"></div>
								</div>
								<div class="fClear"></div>
							</div>
						</div>
						<div class="fClear"></div>
					<div class="iscroll w100" id="receiving">
						<div class="iscrollWrapper">							
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<li class="mainInput">
									<div class="fLeft w100">
										<div class="fLeft w50">
											<div class="fLeft w35 itemcode"><?php echo $this->Form->input('ReceivingDetail.%.item_code', array('label'=>false,'id'=>false, 'frm'=>'#itemCheck', 'linkto'=>'#ProductItemCode', 'class'=>'ajax unique numeric required'));?></div>
											<div class="fRight w65 desc"><?php echo $this->Form->input('ReceivingDetail.%.name',array('label'=>false,'class'=>'productAuto required') );?></div>
											<div class="fClear"></div>			
										</div>
										<div class="fRight w50 ">
											<div class="fLeft w40 ">
												<div class="fLeft w50 qty"><?php echo $this->Form->input('ReceivingDetail.%.qty', array('label'=>false,'id'=>false, 'class'=>'required'));?></div>
												<div class="fRight w50 unit"><?php echo $this->Form->input('ReceivingDetail.%.unit_id', array('label'=>false,'id'=>false, 'class'=>'required'));?></div>
												<div class="fClear"></div>
											</div>
											<div class="fLeft w60 ">
													<div class="fLeft w40 price"><?php echo $this->Form->input('ReceivingDetail.%.price', array('label'=>false,'id'=>false, 'class'=>'numeric monetary moreThanZero required'));?></div>
													<div class="fRight w60">
														<div class="fLeft w70 amt"><?php echo $this->Form->input('ReceivingDetail.%.amount', array('label'=>false,'id'=>false, 'class'=>'numeric monetary moreThanZero required'));?></div>
														<div class="fRight w30 "><a class="recordDelete maCenter" href="#">X</a></div>
														<div class="fClear"></div>									
													</div>
												<div class="fClear"></div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
								</li>
							</ul>	
						</div>
					</div>
					
					<div class="fClear"></div>
				</div>	
				<div class="fClear"></div>
			</div>
			<div class="fRight">
						<div class="fLeft pt5 topaz">
							<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button','id'=>false));?>
						</div>
						<div class="fRight pt5 topaz">
							<?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb cancel_button','id'=>false));?>
						</div>
					</div>
			<div class="fClear"></div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<div class="fClear"></div>
	</div>
	<?php echo $this->Form->create('Product',array('id'=>'itemCheck', 'action'=>'getByProductCode'));?>
	<?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
	<?php echo $this->Form->end();?>
	<?php echo $this->Form->create('Product',array('id'=>'nameCheck', 'action'=>'checkDesc'));?>
    <?php echo $this->Form->input('name',array('label'=>false, 'type'=>'hidden'));?>
    <?php echo $this->Form->end();?>
	<?php echo $this->Form->create('Product',array('id'=>'addProduct', 'action'=>'add'));?>
    <?php echo $this->Form->input('product_type_id',array('label'=>false, 'type'=>'hidden'));?>
    <?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
    <?php echo $this->Form->input('name',array('label'=>false, 'type'=>'hidden'));?>
    <?php echo $this->Form->input('unit_id',array('label'=>false, 'type'=>'hidden'));?>
    <?php echo $this->Form->end();?>
	
