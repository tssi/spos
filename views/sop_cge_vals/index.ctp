<div class="sopCgeVals index">
	<h2><?php __('Sop Cge Vals');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('charge201_id');?></th>
			<th><?php echo $this->Paginator->sort('amount_balance');?></th>
			<th><?php echo $this->Paginator->sort('as_of_date');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sopCgeVals as $sopCgeVal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sopCgeVal['SopCgeVal']['id']; ?>&nbsp;</td>
		<td><?php echo $sopCgeVal['SopCgeVal']['charge201_id']; ?>&nbsp;</td>
		<td><?php echo $sopCgeVal['SopCgeVal']['amount_balance']; ?>&nbsp;</td>
		<td><?php echo $sopCgeVal['SopCgeVal']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $sopCgeVal['SopCgeVal']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $sopCgeVal['SopCgeVal']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $sopCgeVal['SopCgeVal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sopCgeVal['SopCgeVal']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sop Cge Val', true), array('action' => 'add')); ?></li>
	</ul>
</div>