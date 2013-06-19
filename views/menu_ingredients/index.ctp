<?php
	echo $this->Html->script(array(
	'ui/uiSmartTable',
	'ui/uiInputNumeric',
	'ui/uiCollapsible',
	'form/formValidation',
	'form/formNeat',
	'record/recordDatagrid',
	'biz/ingredients'
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


<div id="myDialog" class="dialogBox"></div>

<div class='tab'>
	<div class='tab-header'>Menu Ingredients</div>
	<?php echo $this->Form->create('MenuIngredient', array('action'=>'add'));?>
	<div class='tab-content'>
		<div class="canteen form formNeat w95 ">
			<div class='fLeft w40 classic soft '>
				<?php echo $this->Form->input('item_code',array('label'=>'Itemcode', 'class'=>'numeric'));?>
			</div>
			<div class='hide'>
				<?php echo $this->Form->input('menu_item_id',array( 'type'=>'hidden'));?>
			</div>
			<div class='fRight w60 classic soft'>
				<?php echo $this->Form->input('menu ' ,array('label'=>'Menu Name'));?>
			</div>
			<div class='fClear'></div>
		</div>
		<div class="canteen form formNeat w95 ">
			<div class='fLeft w40 classic soft '>
				<?php echo $this->Form->input('servings',array('label'=>'Per Servings Of'));?>
			</div>
			<div class='fClear'></div>
		</div>
		<hr>
		
		<!--Data Grid-->
		<div class="canteen form formNeat w100 mCenter pbtm14 nmall">
			<div class="record tab nmLeft w80 mCenter">
			<h2 class="recordTitle tab-header b1saqua pad4 bgAqua tcWhite fsSmall padLeft txtShadow taCenter h11">
				Ingredients
			</h2>
			<div class="tab-content nmBottom posRelative ">
				<div class="recordHeader pbtm btmShadow">
					<div class="fLeft w70">
						<div class="fLeft w30 ">
							Itemcode
						</div>
						<div class="fRight w70">
							Description
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fRight w30">
						<div class="fLeft w80">
							<div class="fLeft w50">
								Qty
							</div>
							<div class="fRight w50">
								Unit
							</div>
							<div class="fClear"></div>
						</div>
						<div class="fRight w20">
							
						</div>
						<div class="fClear"></div>
					</div>
					<div class="fClear"></div>
				</div>
				<div class="iscroll metro w100" id="ingredients">
					<div class="iscrollWrapper">							
						<ul class="recordDatagrid on w100 b1sg nbLeft nbRight">
							<li class="mainInput">
								<div class="fLeft w70">
						<div class="fLeft w30 itemcode">
							<div class="input select required">
								<?php echo $this->Form->input('MenuIngredientDetail.%.item_code',array('label'=>false,'id'=>false, 'frm'=>'#itemCheck', 'linkto'=>'#ProductItemCode', 'class'=>'ajax numeric unique', 'div'=>false)); ?>
							</div>
						</div>
						<div class="fRight w70 desc">
							<div class="input select required">
								<?php echo $this->Form->input('MenuIngredientDetail.%.desc',array('label'=>false,'id'=>false, 'div'=>false)); ?>
							</div>
						</div>
						<div class="fClear"></div>
					</div>
								<div class="fRight w30">
									<div class="fLeft w80">
										<div class="fRight w50 unitView">
											<div class="input select required">
												<?php echo $this->Form->input('Not.%.unit',array('label'=>false,'id'=>false, 'div'=>false, 'readonly'=>'readonly')); ?>
											</div>
										</div>
										<div class="fLeft w50 qty">
											<div class="input select required">
												<?php echo $this->Form->input('MenuIngredientDetail.%.qty',array('label'=>false,'id'=>false, 'div'=>false)); ?>
											</div>
										</div>
										
										<div class="unit hide">
											<div class="input">
												<?php echo $this->Form->input('MenuIngredientDetail.%.unit',array('label'=>false,'id'=>false, 'div'=>false, 'type'=>'hidden')); ?>
											</div>
										</div>
										<div class="fClear"></div>
									</div>
									<div class="fRight w20">
										<a class="recordDelete maCenter" href="#">X</a>
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
		
		<div class="canteen form formNeat w95 mCenter">
			<div class="fRight pt5 topaz pbtm pRight">
				<?php echo $this->Form->submit('Cancel',array('type'=>'button','class'=>'selected fwb','id'=>'cancel_button'));?>
			</div>
			<div class="fRight pt5 topaz pbtm pRight">
				<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'selected fwb submit-button' ,'id'=>'save_button'));?>
			</div>
			<div class='fClear'></div>
		</div>
	</div>

	<?php echo $this->Form->create('Product',array('id'=>'itemCheck', 'action'=>'getByProductCode'));?>
	<?php echo $this->Form->input('item_code',array('label'=>false, 'type'=>'hidden'));?>
	<?php echo $this->Form->end();?>
	
	
</div>