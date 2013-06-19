<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiInputNumeric','ui/uiCollapsible','form/formValidation','form/formNeat', 'biz/daily_sales_report'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<div id="myDialog"></div>

	<span class="label">Date: &nbsp;</span><input class="datepicker" id="" type="text"/>
	<?php echo $this->Form->create('Sale');?>
	<?php echo $this->Form->input('date');?>
	
	<?php //echo $this->Form->input('user_id', array('type'=>'hidden', 'value'=>));?>
	<?php echo $this->Form->end();?>

<input id="go" type="button" value="Go"/>
<br />
<br />
<span class="label">Total Sales:  &nbsp;</span><input id="totalSales" type="text"/><br />
<span class="label">Food:  &nbsp;</span><input id="totalFood" type="text"/><br />
<span class="label">Shelf:  &nbsp;</span><input id="totalShelf" type="text"/><br/>
<hr/>
<br />
<br />
<span class="label">Details:</span>
<br />
<br />
<br />
<span class="label">Food:</span>
<table id="food_Table" class='smart_table'>
	<thead>
		<th>QTY</th>
		<th>Desc</th>
		<th>AMT</th>
		<th>Total</th>
	</thead>
	<tbody>
	</tbody>
</table>
<br />
<br />
<br />
<span class="label">Shelf:</span>
<table id="food_Table" class='smart_table'>
	<thead>
		<th>QTY</th>
		<th>Desc</th>
		<th>AMT</th>
		<th>Total</th>
	</thead>
	<tbody>
	</tbody>
</table>

	
	


			
					
					
					
					