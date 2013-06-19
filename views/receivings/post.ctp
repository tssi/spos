<?php
	echo $this->Html->script(array('ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'active/hot_button',
	'biz/receiving_post'));
	echo $this->Html->css(array('ui/uiSmartTable',
	'ui/uiCollapsible',
	'ui/uiIScroll',
	'form/formValidation',
	'form/formNeat',
	'form/formNeatCanteen',
	'record/recordDatagrid',
	'record/recordSearch',
	'active/hot_button'));
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
	<div class="tab-header">Receiving  Report (Post)</div>
		<div class="tab-content">
			<div class="canteen form formNeat w100">
				<?php echo $this->Form->create('Receiving', array('action'=>'add'));?>
				<!--Search---->
					<div class="tab form formNeat w95 mCenter">
						<div class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">Search </div>
						<div class="tab-content">
							<div class="recordSearch w100">
								
								<!--Search Interface---->
								<?php echo $this->Form->create('Canteen',array('action'=>'advance_search','id'=>'advance_search','data-model'=>'Canteen'));?>
								<div class="search_tmplt w100" id="advance_search_tmplt">
									<span class="label pLeft">Search by:</span>
									<ul>
										<li>
											<div id="search_template" class="search_criteria w100 pt3"  style="margin-left:-20px">
												<div class="fLeft w90" >
												    <div class="fLeft w15">
														<div class="fLeft w50 pt1">
															<select class="search_keys notrequired">
																<option value="%">Select field</option>
																	<?php foreach($search_keys as $key){?>
																<option value="<?= $key['element'] ?>" field="<?= $key['field'] ?>" ><?= $key['label'] ?></option>
															<?}?>
															</select>
														</div>
														<div class="fRight w50 pt1">
															<input type="hidden" vname="data[Receiving][%][field]" class="w100 search_field" />
														</div>
														<div class='fClear'></div>
													</div>
													<div class="fRight w85 classic">
														<div class="fLeft w55">
															<div class="search_ui w100">
																<input class="search_input w100 notrequired" type="text"  disabled="disabled"/>
																<?php echo $this->Form->input('doc_type_id',array('label'=>false, 'div'=>false, 'class'=>'hide w100 doc_typeIs')); ?>
																<select class="hide mrkUp w100 ">
																	<option value="1">Posted</option>';
																	<option value="0">Not Posted</option>';
																</select>
															</div>
															<input type="hidden" vname="data[Receiving][%][value]" class="search_value" />
														</div>
														<div class="fRight w45">
															<div class='fLeft w50'>
																<div class='fLeft w30 taRight pt5 fwb'>View:</div>
																<div class='fRight w70'>
																	<select class="notrequired viewBy" disabled="disabled">
																		<option value="all">All</option>
																		<option  value="posted">Posted</option>
																	</select>
																</div>
															</div>
															<div class='fRight w50'>
																<div class='fLeft w30 taRight pt5 fwb'>Sort By:</div>
																<div class='fRight w70'>
																	<select class="notrequired sortBy" disabled="disabled">
																		<?php foreach($search_keys as $key){?>
																			<option value="<?= $key['field'] ?>"><?= $key['label'] ?></option>
																		<?}?>
																	</select>
																</div>
																
															</div>
															<div class='fClear'></div>
														</div>
														<div class="fClear"></div>	
													</div>
													<div class="fClear"></div>	
												</div>
												<div class="topaz fRight w10 taRight">
													<?php echo $this->Form->submit('Go',array('type'=>'button','class'=>'selected fwb search_button mL20','disabled'=>false,'id'=>false));?>
												</div>
												<div class="fClear"></div>	
											</div>
										</li>
									
									</ul>
								</div>
								<div class="fClear"></div>	
								<?php echo $this->Form->end(); ?>	
								<!--Search Result---->	
								<table width="100%" class="smart_table" id="search_results" style="display: ; ">
									<thead  class="label">
										<tr>
											<th class="txt-small w25 b1White">Vendor Name</th>
											<th class="txt-small w10 b1White">Vendor ID</th>
											<th class="txt-small w15 b1White">Date</th>
											<th class="txt-small w10 b1White">Doc Type</th>
											<th class="txt-small w10 b1White">User</th>
											<th class="txt-small w10 b1White">Doc No.</th>
											<th class="txt-small w10 b1White">Status</th>
											<th class="txt-small w10 b1White"></th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<br/>
								<table> 	
									<div class='topaz fRight w10 taRight clear_button_alignment'>
										<?php echo $this->Form->submit('Clear',array('type'=>'button','class'=>'selected fwb clear_button'));?>
									</div>
									<div class='fClear'></div>
								</table>
							</div>
						</div>
					</div>
			<!--Data Grid-->
				<br>
				<div class="tab record metro nmLeft w95 mCenter">
					<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11 listLabel">List</h2>
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
											<div class="data">
												<input type="hidden"/>
											</div>
											<div class='fLeft w75'>
												<div class='fLeft w30 itemcode'><?php echo $this->Form->input('ReceivingDetail.%.item_code', array('label'=>false,'id'=>false, 'frm'=>'#itemCheck', 'linkto'=>'#ProductItemCode', 'readonly'=>'readonly', 'class'=>'ajax unique numeric required'));?></div>
												<div class='fRight w70 desc'><?php echo $this->Form->input('ReceivingDetail.%.name',array('label'=>false,'class'=>'productAuto required', 'readonly'=>'readonly') );?></div>
												<div class='fClear'></div>
											</div>
											<div class='fRight w25 '>
												<div class='fLeft w50 qty'><?php echo $this->Form->input('ReceivingDetail.%.qty', array('label'=>false,'id'=>false, 'class'=>'required', 'readonly'=>'readonly'));?></div>
												<div class='fRight w50 unit'><?php echo $this->Form->input('ReceivingDetail.%.unit_id', array('type'=>'text','label'=>false,'id'=>false, 'class'=>'required', 'readonly'=>'readonly'));?></div>
												<div class='fClear'></div>
											</div>
											<div class='fClear'></div>
										</div>
										<div class='fRight w50'>
											<div class='fLeft w63 '>
												<div class='fLeft w50 money'>
													<div class='fLeft w50 pp'><?php echo $this->Form->input('ReceivingDetail.%.purchase_price', array('label'=>false,'id'=>false, 'class'=>'numeric monetary  required', 'readonly'=>'readonly'));?></div>
													<div class='fRight w50 amt '><?php echo $this->Form->input('ReceivingDetail.%.amount', array('label'=>false,'id'=>false, 'class'=>'monetary'));?></div>
												</div>
												<div class='fRight w50 money'>
													<div class='fLeft w50 app'><?php echo $this->Form->input('ReceivingDetail.%.avg_purchase_price', array('label'=>false,'id'=>false, 'class'=>'numeric monetary  required tcRed', 'readonly'=>'readonly'));?></div>
													<div class='fRight w50 epp'><?php echo $this->Form->input('ReceivingDetail.%.est_purchasing_price', array('label'=>false,'id'=>false, 'class'=>'numeric monetary  required tcRed', 'readonly'=>'readonly'));?></div>
												</div>
												<div class='fClear'></div>
											</div>
											<div class='fRight w37'>
												<div class='fLeft w80 money'>
													<div class='fLeft w50 csr '><?php echo $this->Form->input('ReceivingDetail.%.current_selling_price', array('label'=>false,'id'=>false, 'class'=>'numeric monetary moreThanZero required tcRed', 'readonly'=>'readonly'));?></div>
													<div class='fRight w50 rsrp '><?php echo $this->Form->input('ReceivingDetail.%.revise_srp', array('label'=>false,'id'=>false, 'class'=>'numeric monetary moreThanZero required tcRed', 'readonly'=>'readonly'));?></div>
												</div>
												<div class='fRight w20'>
													<button class= "maCenter hot_button skinless editThis">
													<img src="/canteen/img/icons/pencil.png"/>
													</button>
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
					<div class="fLeft pt5 topaz"><?php echo $this->Form->submit('Post',array('type'=>'button','class'=>'selected fwb submit-button post-button','id'=>false, 'disabled'=>true));?></div>
					<div class="fRight pt5 topaz"><?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb cancel_button','id'=>false));?></div>
				</div>
				<div class="fClear"></div>
				
				
				<hr>
				<div class='wrapper w80 fs10'>	
					<div class='fLeft w70'>
						<div class='fLeft w50'>
							<div><img src='/canteen/img/icons/bullet_star.png'><span class='fwb'>PP</span> -  Purchase Price</div>
							<div><img src='/canteen/img/icons/bullet_star.png'><span class='fwb'>CAPP</span> - Current Average Purchase Price</div>
						</div>
						<div class='fRight w50'>
							<div><img src='/canteen/img/icons/bullet_star.png'><span class='fwb'>CSRP</span> - Current Selling Retail Price</div>
							<div><img src='/canteen/img/icons/bullet_star.png'><span class='fwb'>RSRP</span> - Revise Suggested Retail Price</div>
						</div>
						<div class='fClear'></div>
					</div>
					<div class='fRight w30'>
						<div><img src='/canteen/img/icons/bullet_star.png'><span class='fwb'>NEPP</span> - New Estimated Purchase Price</div>
					</div>
					<div class='fClear'></div>
				</div>
				<?php echo $this->Form->end(); ?>
				<?php echo $this->Form->create('ReceivingDetail',array('action'=>'edit'));?>
				<?php echo $this->Form->input('receiving_id',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('receiving_detail_id',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('name',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('unit_id',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('qty',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('amount',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('purchase_price',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('avg_purchase_price',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('current_selling_price',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('revise_srp',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->input('est_purchasing_price',array('label'=>false, 'type'=>'hidden'));?>
				<?php echo $this->Form->end();?>
				<div class="input select hide">
					<?php echo $this->Form->select('unit_id', $units,null, array('id'=>'units','empty'=>false, 'div'=>false));?>
				</div>
				
			</div>
	</div>
</div>
