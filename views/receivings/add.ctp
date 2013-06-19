<div class="receivings form">
<?php echo $this->Form->create('Receiving');?>
	<fieldset>
		<legend><?php __('Add Receiving'); ?></legend>
	<?php
		echo $this->Form->input('date_time');
		echo $this->Form->input('doc_no');
		echo $this->Form->input('vendor_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Receivings', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Vendors', true), array('controller' => 'vendors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vendor', true), array('controller' => 'vendors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Receiving Details', true), array('controller' => 'receiving_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving Detail', true), array('controller' => 'receiving_details', 'action' => 'add')); ?> </li>
	</ul>
</div>