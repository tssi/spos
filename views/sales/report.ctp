<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiInputNumeric','ui/uiCollapsible','form/formValidation','form/formNeat', 'biz/daily_sales_report'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<style>
	.formneat .classic .input input{ 
		display: inline-block;
		width: 30%;
		background: none;
	}
</style>

<?php echo $this->Form->create('Sale', array('action'=>'daily_report'));?>
<div class='tab'>
<div class='tab-header'>Collection Report</div>
	<div class='tab-content'>
		<div class="canteen form formNeat w100">
			<div class="wWider">
				<div class="fLeft w38 classic soft">
					<?php echo $this->Form->input('date', array('class'=>'datepicker w39'));?>
					<?php echo $this->Form->input('data', array('type'=>'hidden'));?>
					<?php echo $this->Form->input('user_id', array('type'=>'hidden', 'value'=>$user['id']));?>
					<?php echo $this->Form->input('is_collector', array('type'=>'hidden','id'=>'isCollector','value'=>$user['is_collector']));?>
				</div>	
				<div class="fRight w62 topaz pt5">	
					<?php echo $this->Form->submit('Go',array('type'=>'button','id'=>'go'));?>
					<?php echo $this->Form->submit('Cancel',array('type'=>'button','id'=>'cancel'));?>
				</div>
				<div class='fClear'></div>
			</div>
			<hr>
			<div class="wWider">
				<div class="fLeft w38 classic soft ">
					<?php echo $this->Form->input('Total Sales', array('label'=>'Total Sale(s)', 'class'=>'monetary TaRight'));?>
					<?php echo $this->Form->input('Food', array('class'=>'monetary TaRight'));?>
					<?php echo $this->Form->input('Shelf', array('label'=>'Merchendise', 'class'=>'monetary TaRight'));?>
					
				</div>
				<div class='fClear'></div>
			</div>
			
			<div class="wWider">
				<div class="fLeft w20 ptop10 taRight fsSmall">Include Details</div>
				<div class="fRight w80 classic soft">
					<div class="input checkbox">
						<input type="checkbox" id="showDtl"/>
					</div>
				</div>
				<div class="fClear"></div>
			</div>
			
			<div class='tab w70 mCenter'>
				<h2 class="tab-header bgAqua taCenter tcWhite fsSmall txtShadow pad4">Summary</h2>
				<div class='tab-content'>
					<div class="w100 taCenter fwb bgCheri">FOOD</div>
					<table class='smart_table w100 fsSmall food_Table'>
						<thead>
							<th class="w10">QTY</th>
							<th class="w15 ">Code</th>
							<th class="w30 ">Desc</th>
							<th class="w10 ">Amount</th>
							<th class="w10 ">Total</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<hr/><br/>
					<div class="w100 taCenter fwb bgCheri">MERCHANDISE</div>
					<table class='smart_table w100 fsSmall shelf_Table'>
						<thead>
							<th class="w10">QTY</th>
							<th class="w15 ">Code</th>
							<th class="w30 ">Desc</th>
							<th class="w10 ">Amount</th>
							<th class="w10 ">Total</th>
						</thead>
						<tbody>	
						</tbody>
					</table>
					<hr/><br/>
					<div class="w100 taCenter fwb bgCheri">BY PAYMENT TYPE</div>
					<table class='smart_table w100 fsSmall salesPayment'>
						<thead>
							<th class="w25">CASH</th>
							<th class="w25">PREPAID</th>
							<th class="w25">CHARGE</th>
							<th class="w25">TOTAL</th>
						</thead>
						<tbody>	
						</tbody>
					</table>
					<br/>
					<div class="fLeft w30 topaz pt5">	
							<?php echo $this->Form->submit('Print',array('type'=>'button','id'=>'print'));?>
					</div>
					<div class='fClear'></div>
				</div>	
			</div>	
	
			<br/>
			<div class='tab w70 mCenter'>
				<h2 class="tab-header bgAqua taCenter tcWhite fsSmall txtShadow pad4 ">Detail(s)</h2>
				<div class='tab-content'>
					<div class="detailByOR">	
				
					</div>
				</div>
			</div>
			
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>
