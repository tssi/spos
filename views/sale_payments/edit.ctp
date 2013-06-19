<div class="salePayments form">
<?php echo $this->Form->create('SalePayment');?>
	<fieldset>
		<legend><?php __('Edit Sale Payment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('sale_id');
		echo $this->Form->input('payment_type_id');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SalePayment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SalePayment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sale Payments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Types', true), array('controller' => 'payment_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Type', true), array('controller' => 'payment_types', 'action' => 'add')); ?> </li>
	</ul>
</div>