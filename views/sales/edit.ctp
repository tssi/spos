<div class="sales form">
<?php echo $this->Form->create('Sale');?>
	<fieldset>
		<legend><?php __('Edit Sale'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('buyer');
		echo $this->Form->input('total');
		echo $this->Form->input('payment_type_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Sale.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Sale.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Payment Types', true), array('controller' => 'payment_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Type', true), array('controller' => 'payment_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sale Details', true), array('controller' => 'sale_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale Detail', true), array('controller' => 'sale_details', 'action' => 'add')); ?> </li>
	</ul>
</div>