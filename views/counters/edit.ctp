<div class="counters form">
<?php echo $this->Form->create('Counter');?>
	<fieldset>
		<legend><?php __('Edit Counter'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Counter.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Counter.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Counters', true), array('action' => 'index'));?></li>
	</ul>
</div>