<div class="controlObjects index">
	<h2><?php __('Control Objects');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('group_id');?></th>
			<th><?php echo $this->Paginator->sort('request_object_id');?></th>
			<th><?php echo $this->Paginator->sort('action');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($controlObjects as $controlObject):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $controlObject['ControlObject']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($controlObject['Group']['name'], array('controller' => 'groups', 'action' => 'view', $controlObject['Group']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($controlObject['RequestObject']['name'], array('controller' => 'request_objects', 'action' => 'view', $controlObject['RequestObject']['id'])); ?>
		</td>
		<td><?php echo $controlObject['ControlObject']['action']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $controlObject['ControlObject']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $controlObject['ControlObject']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $controlObject['ControlObject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $controlObject['ControlObject']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Control Object', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Request Objects', true), array('controller' => 'request_objects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request Object', true), array('controller' => 'request_objects', 'action' => 'add')); ?> </li>
	</ul>
</div>