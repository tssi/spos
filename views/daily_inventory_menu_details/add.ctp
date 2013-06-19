<div class="dailyInventoryMenuDetails form">
<?php echo $this->Form->create('DailyInventoryMenuDetail');?>
	<fieldset>
		<legend><?php __('Add Daily Inventory Menu Detail'); ?></legend>
	<?php
		echo $this->Form->input('daily_inventory_menu_id');
		echo $this->Form->input('itemcode');
		echo $this->Form->input('desc');
		echo $this->Form->input('count');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Daily Inventory Menu Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Menus', true), array('controller' => 'daily_inventory_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Menu', true), array('controller' => 'daily_inventory_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>