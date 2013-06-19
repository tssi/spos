<div class="sopPpVals index">
	<h2><?php __('Sop Pp Vals');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('prepaid201_id');?></th>
			<th><?php echo $this->Paginator->sort('amount_balance');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sopPpVals as $sopPpVal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sopPpVal['SopPpVal']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sopPpVal['Prepaid201']['id'], array('controller' => 'prepaid201s', 'action' => 'view', $sopPpVal['Prepaid201']['id'])); ?>
		</td>
		<td><?php echo $sopPpVal['SopPpVal']['amount_balance']; ?>&nbsp;</td>
		<td><?php echo $sopPpVal['SopPpVal']['created']; ?>&nbsp;</td>
		<td><?php echo $sopPpVal['SopPpVal']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $sopPpVal['SopPpVal']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $sopPpVal['SopPpVal']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $sopPpVal['SopPpVal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sopPpVal['SopPpVal']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sop Pp Val', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Prepaid201s', true), array('controller' => 'prepaid201s', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prepaid201', true), array('controller' => 'prepaid201s', 'action' => 'add')); ?> </li>
	</ul>
</div>