<div class="roles form">
<?php echo $this->Form->create('Role');?>
	<fieldset>
		<legend><?php __('Edit Role'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id');
		echo $this->Form->input('navigation_id');
	?>
	</fieldset>
		<input class="art-button" type="submit" value="Submit"/>
<?php echo $this->Form->end();?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Role.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Role.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Roles', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Navigations', true), array('controller' => 'navigations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Navigation', true), array('controller' => 'navigations', 'action' => 'add')); ?> </li>
	</ul>
</div>