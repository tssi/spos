<div class="requestObjects view">
<h2><?php  __('Request Object');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requestObject['RequestObject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requestObject['RequestObject']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Link'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requestObject['RequestObject']['link']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requestObject['RequestObject']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requestObject['RequestObject']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Request Object', true), array('action' => 'edit', $requestObject['RequestObject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Request Object', true), array('action' => 'delete', $requestObject['RequestObject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $requestObject['RequestObject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Objects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Object', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Control Objects', true), array('controller' => 'control_objects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Control Object', true), array('controller' => 'control_objects', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Control Objects');?></h3>
	<?php if (!empty($requestObject['ControlObject'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th><?php __('Request Object Id'); ?></th>
		<th><?php __('Action'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($requestObject['ControlObject'] as $controlObject):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $controlObject['id'];?></td>
			<td><?php echo $controlObject['group_id'];?></td>
			<td><?php echo $controlObject['request_object_id'];?></td>
			<td><?php echo $controlObject['action'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'control_objects', 'action' => 'view', $controlObject['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'control_objects', 'action' => 'edit', $controlObject['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'control_objects', 'action' => 'delete', $controlObject['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $controlObject['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Control Object', true), array('controller' => 'control_objects', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
