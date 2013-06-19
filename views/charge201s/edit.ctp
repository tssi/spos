<div class="charge201s form">
<?php echo $this->Form->create('Charge201');?>
	<fieldset>
		<legend><?php __('Edit Charge201'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('reference');
		echo $this->Form->input('status');
		echo $this->Form->input('category');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Charge201.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Charge201.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Charge201s', true), array('action' => 'index'));?></li>
	</ul>
</div>