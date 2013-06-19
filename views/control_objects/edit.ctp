<div class="controlObjects form">
<?php echo $this->Form->create('ControlObject');?>
	<fieldset>
		<legend><?php __('Edit Control Object'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id');
		echo $this->Form->input('request_object_id');
		echo $this->Form->input('action');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ControlObject.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ControlObject.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Control Objects', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Objects', true), array('controller' => 'request_objects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Object', true), array('controller' => 'request_objects', 'action' => 'add')); ?> </li>
	</ul>
</div>