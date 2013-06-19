<div class="endings form">
<?php echo $this->Form->create('Ending');?>
	<fieldset>
		<legend><?php __('Edit Ending'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ref_no');
		echo $this->Form->input('login');
		echo $this->Form->input('user');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Ending.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Ending.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Endings', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ending Details', true), array('controller' => 'ending_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending Detail', true), array('controller' => 'ending_details', 'action' => 'add')); ?> </li>
	</ul>
</div>