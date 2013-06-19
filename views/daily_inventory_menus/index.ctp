<?php
	echo $this->Html->script(array('ui/uiSmartTable','ui/uiInputNumeric','ui/uiCollapsible','form/formValidation','form/formNeat'));
	echo $this->Html->css(array('ui/uiSmartTable','ui/uiCollapsible','ui/uiIScroll','form/formValidation','form/formNeat','form/formNeatCanteen','record/recordDatagrid','record/recordSearch'));
?>
<?php echo $this->Form->create('DailyInventoryMenu', array('action'=>'add'));?>
<div class='tab'>
<div class='tab-header'>Daily Inventory - Menu</div>
	<div class='tab-content'>
		<div class="canteen form formNeat w100">
			<div class='tab w80 mCenter'>
				<h2 class="tab-header bgAqua taCenter tcWhite fsSmall txtShadow pad4">Daily Inventory</h2>
				<div class='tab-content'>
					<div class="w100 taCenter fwb bgCheri">Menu For Today</div>
					<?php echo $this->Form->input('DailyInventoryMenu.login', array('type'=>'hidden', 'id'=>false, 'value'=>$user['id']));?>
					<?php echo $this->Form->input('DailyInventoryMenu.name', array('type'=>'hidden', 'id'=>false, 'value'=>$user['userFull']));?>
					<table class='smart_table w100 fsSmall'>
						<thead>
							<th class="w10">Itemcode</th>
							<th class="w80 ">Desc</th>
							<th class="w10 ">Count</th>
						</thead>
						<tbody>
							<?php
								$index = 0;
								foreach($todayMenus as $menu){
								
								echo '<tr>';
								echo '<td class="taRight">';
								echo $this->Form->input('DailyInventoryMenuDetail.'.$index.'.itemcode', array('type'=>'hidden', 'id'=>false, 'value'=>$menu['MenuItem']['item_code']));
								echo $menu['MenuItem']['item_code'].'</td>';
								echo '<td class="taRight">';
								echo $this->Form->input('DailyInventoryMenuDetail.'.$index.'.desc', array('type'=>'hidden', 'id'=>false, 'value'=>$menu['MenuItem']['name']));
								echo $menu['MenuItem']['name'].'</td>';
								$countOf = $menu['DailyMenu']['approx_srv'] - $menu['DailyMenu']['served'];
								echo '<td class="taRight">';
								echo $this->Form->input('DailyInventoryMenuDetail.'.$index.'.count', array('type'=>'hidden', 'id'=>false, 'value'=>$countOf));
								echo $countOf.'</td>';
								echo '</tr>';
								$index+=1;
								};
							?>
						</tbody>
					</table>
					<br/>
					<div class="fRight pt5 topaz w10 ">
							<?php echo $this->Form->submit('Save',array('type'=>'button','id'=>'submit_button','class'=>'selected fwb submit-button'));?>
					</div>		
					<div class='fClear'></div>
					<div class='fClear'></div>
				</div>	
			</div>	
	
			<br/>
			
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>
