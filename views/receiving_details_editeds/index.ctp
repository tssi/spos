<div class="receivingDetailsEditeds index">
	<h2><?php __('Receiving Details Editeds');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('receiving_id');?></th>
			<th><?php echo $this->Paginator->sort('receiving_detail_id');?></th>
			<th><?php echo $this->Paginator->sort('item_code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('unit_id');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('purchase_price');?></th>
			<th><?php echo $this->Paginator->sort('avg_purchase_price');?></th>
			<th><?php echo $this->Paginator->sort('current_selling_price');?></th>
			<th><?php echo $this->Paginator->sort('revise_srp');?></th>
			<th><?php echo $this->Paginator->sort('est_purchasing_price');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($receivingDetailsEditeds as $receivingDetailsEdited):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($receivingDetailsEdited['Receiving']['id'], array('controller' => 'receivings', 'action' => 'view', $receivingDetailsEdited['Receiving']['id'])); ?>
		</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['receiving_detail_id']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['item_code']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['name']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['qty']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($receivingDetailsEdited['Unit']['name'], array('controller' => 'units', 'action' => 'view', $receivingDetailsEdited['Unit']['id'])); ?>
		</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['amount']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['purchase_price']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['avg_purchase_price']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['current_selling_price']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['revise_srp']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['est_purchasing_price']; ?>&nbsp;</td>
		<td><?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $receivingDetailsEdited['ReceivingDetailsEdited']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $receivingDetailsEdited['ReceivingDetailsEdited']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $receivingDetailsEdited['ReceivingDetailsEdited']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $receivingDetailsEdited['ReceivingDetailsEdited']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Receiving Details Edited', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Receivings', true), array('controller' => 'receivings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving', true), array('controller' => 'receivings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Receiving Details', true), array('controller' => 'receiving_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving Details', true), array('controller' => 'receiving_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>