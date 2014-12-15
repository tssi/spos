<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiInputNumeric','ui/uiCollapsible','form/formValidation','form/formNeat'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<div class='tab'>
	<div class='tab-header'>Charge Transaction</div>
	<div class='tab-content'>
		<div class="canteen form formNeat w100">
			<div class='tab w90 mCenter'>
				<h2 class="tab-header bgAqua taCenter tcWhite fsSmall txtShadow pad4"></h2>
				<div class='tab-content'>
					<table class='w100 smart_table fsSmall'>
						<thead>
							<th class="w10">Date</th>
							<th class="w10">Transaction No.</th>
							<th class="w10">Amount</th>
							<th class="w10">Flag</th>
							<th class="w10">ID No.</th>
							<th class="w10">RFID</th>
						</thead>
						<tbody>
							<td class="text-left"> Dec. 11,2014</td>
							<td class="text-center"> 10000000</td>
							<td class="text-center"> 10,000.00</td>
							<td class="text-center"> 1</td>
							<td class="text-center"> 030012</td>
							<td class="text-center"> 3211513421</td>
						</tbody>
					</table>
				</div>
			</div>
			<br/>
			<div class="wWider">
				<div class="fLeft w40 classic soft">
					<?php echo $this->Form->input('id', array('label'=>'ID No','class'=>'w50'));?>
				</div>
				<div class='fClear'></div>	
				<div class="fLeft w60 classic soft">
					<?php echo $this->Form->input('name', array('class'=>''));?>
				</div>	
				<div class="fLeft w40 topaz pt2">	
					<?php echo $this->Form->submit('Go',array('type'=>'button','id'=>'Go'));?>
					<?php echo $this->Form->submit('Cancel',array('type'=>'button','id'=>'Cancel'));?>
				</div>
				<div class='fClear'></div>
			</div>
			<hr>

			<div class='tab w90 mCenter'>
				<h2 class="tab-header bgAqua taCenter tcWhite fsSmall txtShadow pad4"></h2>
				<div class='tab-content'>
					<table class='w100 smart_table fsSmall'>
						<thead>
							<th class="w10">Date</th>
							<th class="w10">Transaction No.</th>
							<th class="w10">Charge (+)</th>
							<th class="w10">Payment (-)</th>
							<th class="w10">Balance (=)</th>
							<th class="w10">RFID</th>
						</thead>
						<tbody>
							<td class="text-left"> Dec. 11,2014</td>
							<td class="text-center">10000000</td>
							<td class="text-center">10,000.00</td>
							<td class="text-center">3,500.00</td>
							<td class="text-center">6,500.00</td>
							<td class="text-center">3211513421</td>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>