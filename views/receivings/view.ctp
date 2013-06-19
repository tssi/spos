<div class="receivings view">
<h2><?php  __('Receiving');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receiving['Receiving']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receiving['Receiving']['date_time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receiving['Receiving']['doc_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Vendor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($receiving['Vendor']['name'], array('controller' => 'vendors', 'action' => 'view', $receiving['Vendor']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Receiving', true), array('action' => 'edit', $receiving['Receiving']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Receiving', true), array('action' => 'delete', $receiving['Receiving']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $receiving['Receiving']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Receivings', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vendors', true), array('controller' => 'vendors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vendor', true), array('controller' => 'vendors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Receiving Details', true), array('controller' => 'receiving_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving Detail', true), array('controller' => 'receiving_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Receiving Details');?></h3>
	<?php if (!empty($receiving['ReceivingDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Receiving Id'); ?></th>
		<th><?php __('Item Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Unit Id'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($receiving['ReceivingDetail'] as $receivingDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $receivingDetail['id'];?></td>
			<td><?php echo $receivingDetail['receiving_id'];?></td>
			<td><?php echo $receivingDetail['item_code'];?></td>
			<td><?php echo $receivingDetail['name'];?></td>
			<td><?php echo $receivingDetail['qty'];?></td>
			<td><?php echo $receivingDetail['unit_id'];?></td>
			<td><?php echo $receivingDetail['price'];?></td>
			<td><?php echo $receivingDetail['amount'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'receiving_details', 'action' => 'view', $receivingDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'receiving_details', 'action' => 'edit', $receivingDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'receiving_details', 'action' => 'delete', $receivingDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $receivingDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Receiving Detail', true), array('controller' => 'receiving_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
