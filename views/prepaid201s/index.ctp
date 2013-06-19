<div class="prepaid201s index">
	<h2><?php __('Prepaid201s');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('reference');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('category');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($prepaid201s as $prepaid201):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $prepaid201['Prepaid201']['id']; ?>&nbsp;</td>
		<td><?php echo $prepaid201['Prepaid201']['reference']; ?>&nbsp;</td>
		<td><?php echo $prepaid201['Prepaid201']['status']; ?>&nbsp;</td>
		<td><?php echo $prepaid201['Prepaid201']['category']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $prepaid201['Prepaid201']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $prepaid201['Prepaid201']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $prepaid201['Prepaid201']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $prepaid201['Prepaid201']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Prepaid201', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sop Pp Trans', true), array('controller' => 'sop_pp_trans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Pp Tran', true), array('controller' => 'sop_pp_trans', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sop Pp Vals', true), array('controller' => 'sop_pp_vals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Pp Val', true), array('controller' => 'sop_pp_vals', 'action' => 'add')); ?> </li>
	</ul>
</div>