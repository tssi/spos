<div class="productTypes form">
<?php echo $this->Form->create('ProductType');?>
	<fieldset>
		<legend><?php __('Add Product Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('alias');
		echo $this->Form->input('is_consumable');
		echo $this->Form->input('is_perishable');
		echo $this->Form->input('is_shelf');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Product Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Perishables', true), array('controller' => 'perishables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Perishable', true), array('controller' => 'perishables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>