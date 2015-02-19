<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiCollapsible','form/formValidation','form/formNeat','record/recordDatagrid','ui/uiInputNumeric','biz/payment','ss/ssUtil', 'ui/uiSmartSearch'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
[readonly="readonly"]{
	cursor: not-allowed;
}
</style>
<!-----------------------------	ALERT---------------------------->
<!-----UPDATE PREPAID201 & CHARGE201 TABLE (REMOVE ID AUTO INCREMENTATION)----->
<div class="tab">
	<div class="tab-header">Sale Payment</div>
	<div class="tab-content">
		<?php echo $this->Form->create('Sale',array('action'=>'payment'));?>
		<div class="canteen form formNeat w100">
			
			
				<div class="fLeft w50 classic soft"> 		
					<div class="fLeft w100 classic soft"> 		
						<?php echo $this->Form->input('transaction_type',array('options'=>array('Prepaid'=>'Prepaid','Charge'=>'Charge'),'empty'=>'Select','class'=>'w70','required'=>'required'));?>		
					</div><div class="fClear"></div>
					
					<div class="fLeft w100 classic soft"> 
						<div class="fLeft w50 classic soft"> 
							<?php echo $this->Form->input('or_no',array('class'=>'w40','label'=>'OR No','required'=>'required'));?>					
						</div>
					</div><div class="fClear"></div>
					
					<div class="fLeft w100 classic soft"> 
						<div class="fLeft w50 classic soft"> 
							<?php echo $this->Form->input('buyer_type',array('options'=>array('Employee'=>'Employee','Student'=>'Student'),'empty'=>'Select','class'=>'w40','required'=>'required'));?>					
						</div>
						<div class="fRight w50 classic soft"> 		
							<?php echo $this->Form->input('buyer_id',array('class'=>'w40','type'=>'text','label'=>'Buyer ID','required'=>'required'));?>		
						</div><div class="fClear"></div>
					</div><div class="fClear"></div>
					
					
					<div class="fLeft w100 classic soft"> 
						<?php echo $this->Form->input('name',array('class'=>'w70','readonly'=>'readonly'));?>					
					</div><div class="fClear"></div>
					<div class="fLeft w100 classic soft money"> 
						<?php echo $this->Form->input('amount',array('class'=>'w70 numeric','required'=>'required'));?>					
					</div><div class="fClear"></div>
					
					<div class="fRight w17 topaz">
						<?php echo $this->Form->submit('Save',array('type'=>'submit','class'=>'selected fwb'));?>
					</div><div class="fClear"></div>
				</div>
				<div class="fClear"></div>
				
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>