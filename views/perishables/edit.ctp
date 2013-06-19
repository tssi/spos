<div class="perishables form">
<?php echo $this->Form->create('Perishable');?>
	<fieldset>
		<legend><?php __('Edit Perishable'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_type_id');
		echo $this->Form->input('item_code');
		echo $this->Form->input('name');
		echo $this->Form->input('unit_id');
		echo $this->Form->input('qty');
		echo $this->Form->input('selling_price');
		echo $this->Form->input('avg_price');
		echo $this->Form->input('is_consumable');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Perishable.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Perishable.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Perishables', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Product Types', true), array('controller' => 'product_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Type', true), array('controller' => 'product_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>