<div class="paymentTypes form">
<?php echo $this->Form->create('PaymentType');?>
	<fieldset>
		<legend><?php __('Edit Payment Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('alias');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PaymentType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PaymentType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Payment Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
	</ul>
</div>