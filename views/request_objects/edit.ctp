<div class="requestObjects form">
<?php echo $this->Form->create('RequestObject');?>
	<fieldset>
		<legend><?php __('Edit Request Object'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('link');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('RequestObject.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('RequestObject.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Request Objects', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Control Objects', true), array('controller' => 'control_objects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Control Object', true), array('controller' => 'control_objects', 'action' => 'add')); ?> </li>
	</ul>
</div>