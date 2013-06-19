<div class="dailyInventoryProductDetails form">
<?php echo $this->Form->create('DailyInventoryProductDetail');?>
	<fieldset>
		<legend><?php __('Edit Daily Inventory Product Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('daily_inventory_product_id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DailyInventoryProductDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DailyInventoryProductDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Product Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Products', true), array('controller' => 'daily_inventory_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Product', true), array('controller' => 'daily_inventory_products', 'action' => 'add')); ?> </li>
	</ul>
</div>