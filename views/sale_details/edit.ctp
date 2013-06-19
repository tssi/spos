<div class="saleDetails form">
<?php echo $this->Form->create('SaleDetail');?>
	<fieldset>
		<legend><?php __('Edit Sale Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('sale_id');
		echo $this->Form->input('product_type_id');
		echo $this->Form->input('qty');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SaleDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SaleDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sale Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Types', true), array('controller' => 'product_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Type', true), array('controller' => 'product_types', 'action' => 'add')); ?> </li>
	</ul>
</div>