<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiInputNumeric','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<div id="myDialog"></div>
	<div class="tab">
	<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
							Receiving Report
				</h2>
	<div class="tab-content">
		
		
		
		<div class="canteen form formNeat wLong">
			<?php echo $this->Form->create('Product');?>
			<div class='fLeft w50 classic soft pbtm'>
					<?php echo $this->Form->input('vendor_name',array('type'=>'text','label'=>'Vendor Name'));?>
					<?php echo $this->Form->input('vendor_id',array('type'=>'text','label'=>'Vendor ID'));?>
			</div>
			<div class='fRight w50 classic soft pbtm'>
					<?php echo $this->Form->input('date',array('type'=>'text','label'=>'Date'));?>
					<?php echo $this->Form->input('docno',array('type'=>'text','label'=>'Doc No'));?>
			</div>
			<div class="fClear"></div>
		
			<div class="tab record metro nmLeft w95 mCenter">
				<h2 class="tab-header recordTitle  b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
							List
				</h2>
				<div class="tab-content  nmBottom posRelative ">
				
						
						<div class="recordHeader pbtm btmShadow">
							<div class="fLeft w100 recordHeader">
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
											<div class="fLeft w40 ">Price</div>
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
					<div class="iscroll w100" id="receiving_view">
						<div class="iscrollWrapper">							
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<li class="mainInput">
									<div class="fLeft w100">
										<div class="fLeft w50">
											<div class="fLeft w35 "><?php echo $this->Form->input('itemCode');?></div>
											<div class="fRight w65 "><?php echo $this->Form->input('desc');?></div>
											<div class="fClear"></div>			
										</div>
										<div class="fRight w50 ">
											<div class="fLeft w40 ">
												<div class="fLeft w50 "><?php echo $this->Form->input('qty');?></div>
												<div class="fRight w50 "><?php echo $this->Form->input('unit');?></div>
												<div class="fClear"></div>
											</div>
											<div class="fLeft w60 ">
													<div class="fLeft w40 "><?php echo $this->Form->input('price');?></div>
													<div class="fRight w60">
														<div class="fLeft w70 "><?php echo $this->Form->input('amount');?></div>
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
							<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb','id'=>false));?>
						</div>
						<div class="fRight pt5 topaz">
							<?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb','id'=>false));?>
						</div>
					</div>
			<div class="fClear"></div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<div class="fClear"></div>
	</div>
	
