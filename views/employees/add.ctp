<div class="employees form">
<?php echo $this->Form->create('Employee');?>
	<fieldset>
		<legend><?php __('Add Employee'); ?></legend>
	<?php
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('credit_limit');
		echo $this->Form->input('date_opened');
		echo $this->Form->input('date_close');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Employees', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Charge Ledgers', true), array('controller' => 'charge_ledgers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Charge Ledger', true), array('controller' => 'charge_ledgers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Charges', true), array('controller' => 'charges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Charge', true), array('controller' => 'charges', 'action' => 'add')); ?> </li>
	</ul>
</div>