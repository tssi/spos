<div class="roles view">
<h2><?php  __('Role');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $role['Role']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($role['Group']['name'], array('controller' => 'groups', 'action' => 'view', $role['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Navigation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($role['Navigation']['title'], array('controller' => 'navigations', 'action' => 'view', $role['Navigation']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Role', true), array('action' => 'edit', $role['Role']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Role', true), array('action' => 'delete', $role['Role']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $role['Role']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Navigations', true), array('controller' => 'navigations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Navigation', true), array('controller' => 'navigations', 'action' => 'add')); ?> </li>
	</ul>
</div>
