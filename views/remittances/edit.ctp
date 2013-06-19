<div class="remittances form">
<?php echo $this->Form->create('Remittance');?>
	<fieldset>
		<legend><?php __('Edit Remittance'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('cashier');
		echo $this->Form->input('date_time');
		echo $this->Form->input('sales_amount');
		echo $this->Form->input('remitted');
		echo $this->Form->input('collector');
		echo $this->Form->input('ref_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Remittance.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Remittance.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Remittances', true), array('action' => 'index'));?></li>
	</ul>
</div>