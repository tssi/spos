<?php
	echo $this->Html->script(array('ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'biz/receiving'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
	.option{
		width: 97% !important;
		margin: 0px 1px !important;
	}
</style>
<script>
	$(document).ready(function(){
		$('.dateNow').css('width','80px');
		$('#ReceivingDocTypeId,#ReceivingDateTime').siblings().css('margin-left','-40px');
		$('#ReceivingUser').siblings().css('margin-left','-73px');
	});
</script>
<div id="myDialog"></div>

<div class="tab">
	<div class="tab-header">Receiving  Report (New)</div>
		<div class="tab-content">
			<div class="canteen form formNeat w100">
					<?php echo $this->Form->create('Receiving', array('action'=>'add'));?>
					<div class="hdrReceive w100">
						<div class="fLeft w45 classic soft">
							<div class="fLeft w100">
								<?php echo $this->Form->input('vendor_name',array('type'=>'text','label'=>'Vendor Name', 'class'=>'vendorAuto required'));?>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w55  classic soft  ">
							<div class="fLeft w50"><?php echo $this->Form->input('date_time',array('type'=>'text','label'=>'Date', 'class'=>'dateNow required','readonly'=>'readonly', 'value'=>date('Y-m-d')));?></div>
							<div class="fRight w50"><?php echo $this->Form->input('user',array('class'=>'required numeric','label'=>'User', 'value'=>$user['username'], 'readonly'=>'readonly' ));?></div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>	
					<div class="hdrReceive w100">	
						<div class="fLeft w45  classic soft ">
							<div class="fLeft w100">
								<?php echo $this->Form->input('vendor_id',array('type'=>'text','label'=>'Vendor ID', 'class'=>'required','readonly'=>'readonly'));?>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w55 classic soft">
							<div class="fLeft w50 "><?php echo $this->Form->input('doc_type_id', array('class'=>'required classic soft ">', 'label'=>'Doc Type'));?></div>
							<div class="fRight w50 "><?php echo $this->Form->input('doc_num',array('class'=>'required numeric','label'=>'Doc No' ));?></div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>
					<!--Data Grid-->
					<br>
					<div class="tab record metro nmLeft w95 mCenter">
						<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">List</h2>
						<div class="tab-content  nmBottom  posRelative">
							<div class="recordHeader pbtm btmShadow taCenter ">
								<div class='fLeft w50'>
									<div class='fLeft w75'>
										<div class='fLeft w30'>Item Code</div>
										<div class='fRight w70'>Description</div>
										<div class='fClear'></div>
									</div>
									<div class='fRight w25'>
										<div class='fLeft w50'>Qty</div>
										<div class='fRight w50'>Unit</div>
										<div class='fClear'></div>
									</div>
									<div class='fClear'></div>
								</div>
								<div class='fRight w50'>
									<div class='fLeft w63'>
										<div class='fLeft w50'>
											<div class='fLeft w50'>PP</div>
											<div class='fRight w50'>Amount</div>
										</div>
										<div class='fRight w50 tcRed'>
											<div class='fLeft w50'>CAPP </div>
											<div class='fRight w50'>NEPP </div>
										</div>
										<div class='fClear'></div>
									</div>
									<div class='fRight w37 tcRed'>
										<div class='fLeft w80'>
											<div class='fLeft w50'>CSRP</div>
											<div class='fRight w50'>RSRP </div>
										</div>
										<div class='fRight w20'>
										
										</div>
									</div>
									<div class='fClear'></div>
								</div>
								<div class='fClear'></div>
							</div>
							
							<div class="iscroll w100" id="receiving">
								<div class="iscrollWrapper">							
									<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
										<li class="mainInput">	
											<div class='fLeft w50'>
												<div class='fLeft w75'>
													<div class='fLeft w30 itemcode'>
														<div class='input select required'>
															<?php echo $this->Form->input('ReceivingDetail.%.item_code', array('label'=>false,'id'=>false,'div'=>false, 'frm'=>'#itemCheck', 'linkto'=>'#ProductItemCode', 'class'=>'ajax unique numeric'));?>
														</div>
													</div>
													<div class='fRight w70 desc'>
														<div class='input select required'>
															<?php echo $this->Form->input('ReceivingDetail.%.name',array('label'=>false,'id'=>false,'div'=>false, 'class'=>'productAuto unique') );?>
														</div>
													</div>
													<div class='fClear'></div>
												</div>
												<div class='fRight w25 '>
													<div class='fLeft w50 qty'>
														<div class='input select required'>
															<?php echo $this->Form->input('ReceivingDetail.%.qty', array('label'=>false,'id'=>false,'div'=>false, 'class'=>'required'));?>
														</div>
													</div>
													<div class='fRight w50 unit'>
														<div class='input select required'>
															<?php echo $this->Form->input('ReceivingDetail.%.unit_id', array('label'=>false,'id'=>false, 'div'=>false,'class'=>'required'));?></div>
														</div>
													<div class='fClear'></div>
												</div>
												<div class='fClear'></div>
											</div>
											<div class='fRight w50'>
												<div class='fLeft w63 '>
													<div class='fLeft w50 money'>
														<div class='fLeft w50 pp'>
															<div class='input select required'>
																<?php echo $this->Form->input('ReceivingDetail.%.purchase_price', array('label'=>false,'id'=>false, 'div'=>false, 'class'=>'numeric monetary  required'));?>
															</div>
														</div>
														<div class='fRight w50 amt '>
															<div class='input select required'>
																<?php echo $this->Form->input('ReceivingDetail.%.amount', array('label'=>false,'id'=>false, 'div'=>false, 'class'=>'monetary'));?>
															</div>
														</div>
													</div>
													<div class='fRight w50 money'>
														<div class='fLeft w50 app'>
															<div class='input select'>
																<?php echo $this->Form->input('ReceivingDetail.%.avg_purchase_price', array('label'=>false,'id'=>false, 'div'=>false,'class'=>'numeric monetary  required tcRed'));?>
															</div>
														</div>
														<div class='fRight w50 epp'>
															<div class='input select'>
																<?php echo $this->Form->input('ReceivingDetail.%.est_purchasing_price', array('label'=>false,'id'=>false, 'div'=>false,'class'=>'numeric monetary  required tcRed'));?>
															</div>
														</div>
													</div>
													<div class='fClear'></div>
												</div>
												<div class='fRight w37'>
													<div class='fLeft w80 money'>
														<div class='fLeft w50 csr '>
															<div class='input select'>
																<?php echo $this->Form->input('ReceivingDetail.%.current_selling_price', array('label'=>false,'id'=>false, 'div'=>false,'class'=>'numeric monetary moreThanZero required tcRed'));?>
															</div>
														</div>
														<div class='fRight w50 rsrp '>
															<div class='input select'>
																<?php echo $this->Form->input('ReceivingDetail.%.revise_srp', array('label'=>false,'id'=>false, 'class'=>'numeric monetary moreThanZero required tcRed'));?>
															</div>
														</div>
													</div>
													<div class='fRight w20'>
														<a class="recordDelete maCenter" href="#">X</a>
													</div>
													<div class='fClear'></div>
												</div>
												<div class='fClear'></div>
											</div>
											<div class='fClear'></div>	
										</li>
									</ul>	
								</div>
							</div>
							<div class="fClear"></div>
						</div>	
					</div>
					<!--End of Data Grid-->
					<div class="fRight">
						<div class="fLeft pt5 topaz"><?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button','id'=>false));?></div>
						<div class="fRight pt5 topaz"><?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb cancel_button','id'=>false));?></div>
					</div>
					<div class="fClear"></div>
					
					
					<hr>
					<div class='wrapper w80 fs10'>	
						<div class='fLeft w70'>
							<div class='fLeft w50'>
								<div><img src='../canteen/img/icons/bullet_star.png'><span class='fwb'>PP</span> -  Purchase Price</div>
								<div><img src='../canteen/img/icons/bullet_star.png'><span class='fwb'>CAPP</span> - Current Average Purchase Price</div>
							</div>
							<div class='fRight w50'>
								<div><img src='../canteen/img/icons/bullet_star.png'><span class='fwb'>CSRP</span> - Current Selling Retail Price</div>
								<div><img src='../canteen/img/icons/bullet_star.png'><span class='fwb'>RSRP</span> - Revise Suggested Retail Price</div>
							</div>
							<div class='fClear'></div>
						</div>
						<div class='fRight w30'>
							<div><img src='../canteen/img/icons/bullet_star.png'><span class='fwb'>NEPP</span> - New Estimated Purchase Price</div>
						</div>
						<div class='fClear'></div>
					</div>
					<?php echo $this->Form->end(); ?>
				</div>
			<div class="productType hide">
				<?php echo $this->Form->select('product_type_id',$prodTypes,null,array('empty'=>false, 'id'=>'dgProductProductType'))?>
			</div>
			<?php echo $this->Form->create('Vendor',array('id'=>'VendAdd'));?>
			<?php echo $this->Form->input('name',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->end();?>
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
			<?php echo $this->Form->input('qty',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->input('selling_price',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->input('avg_price',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->input('markup',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->input('markup_unit',array('label'=>false, 'type'=>'hidden'));?>
			<?php echo $this->Form->end();?>
	</div>
</div>
