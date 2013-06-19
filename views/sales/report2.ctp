<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiInputNumeric','ui/uiCollapsible','form/formValidation','form/formNeat', 'biz/daily_sales_report'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<?php echo $this->Form->create('Sale', array('action'=>'daily_report'));?>
<div class="canteen form formNeat w100">
	<div class="wLong">
		<div class="wWider">
			<div class="fLeft w50 classic soft ">
				<?php echo $this->Form->input('date', array('class'=>'datepicker'));?>
			</div>	
			<div class="fRight w50 topaz pt5">	
				<?php echo $this->Form->submit('Go',array('type'=>'button','id'=>'go'));?>
			</div>
			<div class='fClear'></div>
		</div>
		<hr>
		<div class="wWider">
			<div class="fLeft w50 classic soft ">
				<?php echo $this->Form->input('Total Sales');?>
				<?php echo $this->Form->input('Food');?>
				<?php echo $this->Form->input('Shelf');?>
			</div>	
			<div class='fClear'></div>
		</div>
		<hr>
		
		<h2 class="bgAqua taCenter tcWhite fsSmall txtShadow pad4">Details</h2>
		
		<div class="w100 taCenter fwb bgCheri">FOOD</div>
		<table id="food_Table" class='smart_table w100 fsSmall'>
			<thead>
				<th>QTY</th>
				<th>Code</th>
				<th>Desc</th>
				<th>Amount</th>
				<th>Total</th>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		
		<hr>
		<br>
		<div class="w100 taCenter fwb bgCheri">SHELF</div>
		<table id="shelf_Table" class='smart_table w100 fsSmall'>
			<thead>
				<th>QTY</th>
				<th>Code</th>
				<th>Desc</th>
				<th>Amount</th>
				<th>Total</th>
			</thead>
			<tbody>
			
				
			</tbody>
		</table>

		
		
		
		
	</div>
</div>
<?php echo $this->Form->end();?>