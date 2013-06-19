<?php
	echo $this->Html->script(array('livequery','ui/uiSmartTable','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid','biz/menu_item', 'ui/uiInputNumeric'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
	.option{
	width: 98%; 	
	margin: 0 1 !important;
	}
	.w59{
	width: 59%; 	
	}
	.nmTop{
	margin-top: -16px !important;
	}
</style>
<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
<div id="dialog"></div>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Add Menu</a></li>
		<li><a href="#tabs-2">Menu Lists</a></li>
	</ul>
	<div class="form formNeat wWider mCenter">
		<div id="tabs-1">
			<div class="tab record metro nmLeft w100 mCenter">
			<?php echo $this->Form->create('MenuItem',array('action'=>'add'));?>
				<h2 class='taCenter bgLime b1sLemon pad4 nmAll nmTop'>Add Menu</h2>
				<div class="tab-content nmBottom posRelative ">
					<div class="recordHeader pbtm btmShadow">
						<div class="fLeft w60">
							<div class="fLeft w40">
							Item Code
							</div>
							<div class="fRight w60 ">
							Description
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w40 ">
							<div class="fLeft w30">
								Price
							</div>
							<div class="fRight w70">
								<div class="fLeft w35">
								Unit
								</div>
								<div class="fRight w59 taLeft">
								Est. Price
								</div>
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fClear"></div>
					</div>
				
					<div class="iscroll w100" id="menuList">
						<div class="iscrollWrapper">
								
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<li class="mainInput">
									<div class="pbtm btmShadow">
										<div class="fLeft w60">
											<div class="fLeft w40 itemCode">
												<?php echo $this->Form->input('MenuItem.%.item_code',array('label'=>false,'id'=>false, 'class'=>'unique ajax numeric','frm'=>'#menuCheck', 'linkto'=>'#MenuItemItemCode')); ?>
											</div>
											<div class="fRight w60 desc">
												<?php echo $this->Form->input('MenuItem.%.name',array('label'=>false,'id'=>false, 'class'=>'unique ajax','frm'=>'#nameCheck', 'linkto'=>'#MenuItemName')); ?>
											</div>
											
											<div class="fClear"></div>
										</div>
										<div class="fRight w40">
											<div class="fLeft w30 price money">
												<?php echo $this->Form->input('MenuItem.%.selling_price',array('label'=>false,'id'=>false, 'class'=>'numeric monetary')); ?>
											</div>
											<div class="fRight w70 unit">
												<div class="fleft w40">
													<?php echo $this->Form->input('MenuItem.%.unit_id',array('label'=>false,'id'=>false,'class'=>'option')); ?>
												</div>
												<div class="fRight w60">
													<div class="fLeft w70 money ">
														<?php echo $this->Form->input('selling_price',array('label'=>false,'class'=>'option')); ?>
													</div>
													<div class='fRight w30'>
														<a class="recordDelete " href="#">X</a>
													</div>
												</div>
											</div>
											<div class="fClear"></div>
										</div>
										<div class="fClear"></div>
									</div>
								</li>
							</ul>	
						</div>
					</div>			
					<div class="fLeft pt5">
						&nbsp;&nbsp;<strong>*ALT-I to auto-assign barcode number</strong>
					</div>
					<div class="fRight pt5 topaz pbtm pRight">
						<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button'));?>
						<?php echo $this->Form->submit('Cancel',array('type'=>'reset','class'=>'selected fwb','id'=>'cancel_button'));?>
					</div><div class="fClear"></div>
				</div>
			</div><div class="fClear "></div>
			<?php echo $this->Form->end(); ?>
		</div>
		<div id="tabs-2">		
			<div class="tab record metro nmLeft w100 mCenter">
				<h2 class='taCenter bgLime b1sLemon pad4 nmAll'>Menu Lists</h2>
				<div class="tab-content nmBottom posRelative ">
					<div class="recordHeader pbtm btmShadow">
						<div class="fLeft w60">
							<div class="fLeft w40">
							Item Code
							</div>
							<div class="fRight w60 ">
							Description
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w40 ">
							<div class="fLeft w35">
								Price
							</div>
							<div class="fRight w65">
								<div class="fLeft w50">
								Unit
								</div>
								<div class="fRight w50">
								Est. Cost
								</div>
							</div>
							<div class="fClear"></div>
						</div><div class="fClear"></div>
					</div>
					<div class="iscroll w100" id="menuList_view">
						<div class="iscrollWrapper">		
							<ul class="recordDatagrid on w100 h175px b1sg  nbLeft  nbRight">
								<li class="mainInput">
									<div class="pbtm btmShadow">
										<div class="fLeft w60">
											<div class="fLeft w40 VIEWitemCode">
												<?php echo $this->Form->input('MenuItem.%.item_code',array('label'=>false,'id'=>false, 'readonly'=>'readonly', 'class'=>'unique ajax numeric','frm'=>'#menuCheck', 'linkto'=>'#MenuItemItemCode')); ?>
											</div>
											<div class="fRight w60 VIEWdesc">
												<?php echo $this->Form->input('MenuItem.%.name',array('label'=>false,'id'=>false, 'readonly'=>'readonly', 'class'=>'unique ajax','frm'=>'#nameCheck', 'linkto'=>'#MenuItemName')); ?>
											</div><div class="fClear"></div>
										</div>
										
										<div class="fRight w40">
											<div class="fLeft w35 VIEWprice money">
												<?php echo $this->Form->input('MenuItem.%.selling_price',array('label'=>false,'id'=>false, 'readonly'=>'readonly', 'class'=>'numeric monetary')); ?>
											</div>
											<div class="fRight w65 ">
												<div class="fleft w50 VIEWunit">
													<?php echo $this->Form->input('MenuItem.%.unit_id',array('type'=>'text','label'=>false,'id'=>false,'readonly'=>'readonly','class'=>'option', 'disabled'=>true)); ?>
												</div>
												<div class="fleft w50 VIEWavg">
												<?php echo $this->Form->input('Selling_Price'); ?>
												</div>
											</div>
											
											<div class="fClear"></div>
										</div><div class="fClear"></div>
									</div>
								</li>
							</ul>	
						</div>
					</div>			
				</div>
			</div><div class="fClear"></div>
		</div>
		<div class="fLeft pt5 topaz">
				<?php echo $this->Form->submit('Back',array('type'=>'button','class'=>'selected fwb goto-button'));?>
		</div><div class="fClear"></div>
		<?php echo $this->Form->create('MenuItem',array('id'=>'menuCheck', 'action'=>'check'));?>
		<?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
		<?php echo $this->Form->end();?>
		<?php echo $this->Form->create('MenuItem',array('id'=>'nameCheck', 'action'=>'checkDesc'));?>
		<?php echo $this->Form->input('name',array('label'=>false, 'type'=>'hidden'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>