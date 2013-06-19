<div class="vendors form">
<?php echo $this->Form->create('Vendor');?>
	<fieldset>
		<legend><?php __('Edit Vendor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Vendor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Vendor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Vendors', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Receivings', true), array('controller' => 'receivings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving', true), array('controller' => 'receivings', 'action' => 'add')); ?> </li>
	</ul>
</div>