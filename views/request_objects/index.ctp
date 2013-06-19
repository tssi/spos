<div class="requestObjects index">
	<h2><?php __('Request Objects');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('link');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($requestObjects as $requestObject):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $requestObject['RequestObject']['id']; ?>&nbsp;</td>
		<td><?php echo $requestObject['RequestObject']['name']; ?>&nbsp;</td>
		<td><?php echo $requestObject['RequestObject']['link']; ?>&nbsp;</td>
		<td><?php echo $requestObject['RequestObject']['created']; ?>&nbsp;</td>
		<td><?php echo $requestObject['RequestObject']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $requestObject['RequestObject']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $requestObject['RequestObject']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $requestObject['RequestObject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $requestObject['RequestObject']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Request Object', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Control Objects', true), array('controller' => 'control_objects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Control Object', true), array('controller' => 'control_objects', 'action' => 'add')); ?> </li>
	</ul>
</div>