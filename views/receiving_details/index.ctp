<div class="receivingDetails index">
	<h2><?php __('Receiving Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('receiving_id');?></th>
			<th><?php echo $this->Paginator->sort('item_code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('unit_id');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('purchase_price');?></th>
			<th><?php echo $this->Paginator->sort('avg_purchase_price');?></th>
			<th><?php echo $this->Paginator->sort('current_selling_price');?></th>
			<th><?php echo $this->Paginator->sort('revise_srp');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($receivingDetails as $receivingDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $receivingDetail['ReceivingDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($receivingDetail['Receiving']['id'], array('controller' => 'receivings', 'action' => 'view', $receivingDetail['Receiving']['id'])); ?>
		</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['item_code']; ?>&nbsp;</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['name']; ?>&nbsp;</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['qty']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($receivingDetail['Unit']['name'], array('controller' => 'units', 'action' => 'view', $receivingDetail['Unit']['id'])); ?>
		</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['price']; ?>&nbsp;</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['amount']; ?>&nbsp;</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['purchase_price']; ?>&nbsp;</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['avg_purchase_price']; ?>&nbsp;</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['current_selling_price']; ?>&nbsp;</td>
		<td><?php echo $receivingDetail['ReceivingDetail']['revise_srp']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $receivingDetail['ReceivingDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $receivingDetail['ReceivingDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $receivingDetail['ReceivingDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $receivingDetail['ReceivingDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Receiving Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Receivings', true), array('controller' => 'receivings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving', true), array('controller' => 'receivings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>