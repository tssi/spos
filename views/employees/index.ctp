<div class="employees index">
	<h2><?php __('Employees');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('middle_name');?></th>
			<th><?php echo $this->Paginator->sort('credit_limit');?></th>
			<th><?php echo $this->Paginator->sort('date_opened');?></th>
			<th><?php echo $this->Paginator->sort('date_close');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($employees as $employee):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $employee['Employee']['id']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['last_name']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['first_name']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['middle_name']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['credit_limit']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['date_opened']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['date_close']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['status']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $employee['Employee']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $employee['Employee']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $employee['Employee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $employee['Employee']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Employee', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Charge Ledgers', true), array('controller' => 'charge_ledgers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Charge Ledger', true), array('controller' => 'charge_ledgers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Charges', true), array('controller' => 'charges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Charge', true), array('controller' => 'charges', 'action' => 'add')); ?> </li>
	</ul>
</div>