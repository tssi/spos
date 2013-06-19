<div class="dailyInventoryMenus form">
<?php echo $this->Form->create('DailyInventoryMenu');?>
	<fieldset>
		<legend><?php __('Edit Daily Inventory Menu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('login');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DailyInventoryMenu.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DailyInventoryMenu.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Menus', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Menu Details', true), array('controller' => 'daily_inventory_menu_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Menu Detail', true), array('controller' => 'daily_inventory_menu_details', 'action' => 'add')); ?> </li>
	</ul>
</div>