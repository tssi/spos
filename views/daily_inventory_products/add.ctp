<div class="dailyInventoryProducts form">
<?php echo $this->Form->create('DailyInventoryProduct');?>
	<fieldset>
		<legend><?php __('Add Daily Inventory Product'); ?></legend>
	<?php
		echo $this->Form->input('login');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Daily Inventory Products', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Product Details', true), array('controller' => 'daily_inventory_product_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Product Detail', true), array('controller' => 'daily_inventory_product_details', 'action' => 'add')); ?> </li>
	</ul>
</div>