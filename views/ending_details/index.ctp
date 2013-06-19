<div class="endingDetails index">
	<h2><?php __('Ending Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('ending_id');?></th>
			<th><?php echo $this->Paginator->sort('item_code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($endingDetails as $endingDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $endingDetail['EndingDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($endingDetail['Ending']['id'], array('controller' => 'endings', 'action' => 'view', $endingDetail['Ending']['id'])); ?>
		</td>
		<td><?php echo $endingDetail['EndingDetail']['item_code']; ?>&nbsp;</td>
		<td><?php echo $endingDetail['EndingDetail']['name']; ?>&nbsp;</td>
		<td><?php echo $endingDetail['EndingDetail']['qty']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $endingDetail['EndingDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $endingDetail['EndingDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $endingDetail['EndingDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $endingDetail['EndingDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ending Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Endings', true), array('controller' => 'endings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending', true), array('controller' => 'endings', 'action' => 'add')); ?> </li>
	</ul>
</div>