<div class="controlObjects view">
<h2><?php  __('Control Object');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $controlObject['ControlObject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($controlObject['Group']['name'], array('controller' => 'groups', 'action' => 'view', $controlObject['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Request Object'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($controlObject['RequestObject']['name'], array('controller' => 'request_objects', 'action' => 'view', $controlObject['RequestObject']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Action'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $controlObject['ControlObject']['action']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Control Object', true), array('action' => 'edit', $controlObject['ControlObject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Control Object', true), array('action' => 'delete', $controlObject['ControlObject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $controlObject['ControlObject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Control Objects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Control Object', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Objects', true), array('controller' => 'request_objects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Object', true), array('controller' => 'request_objects', 'action' => 'add')); ?> </li>
	</ul>
</div>
