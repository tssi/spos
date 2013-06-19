<div class="sales view">
<h2><?php  __('Sale');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Buyer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['buyer']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['total']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($sale['PaymentType']['name'], array('controller' => 'payment_types', 'action' => 'view', $sale['PaymentType']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sale', true), array('action' => 'edit', $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sale', true), array('action' => 'delete', $sale['Sale']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Types', true), array('controller' => 'payment_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Type', true), array('controller' => 'payment_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sale Details', true), array('controller' => 'sale_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale Detail', true), array('controller' => 'sale_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Sale Details');?></h3>
	<?php if (!empty($sale['SaleDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Sale Id'); ?></th>
		<th><?php __('Product Type Id'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sale['SaleDetail'] as $saleDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $saleDetail['id'];?></td>
			<td><?php echo $saleDetail['sale_id'];?></td>
			<td><?php echo $saleDetail['product_type_id'];?></td>
			<td><?php echo $saleDetail['qty'];?></td>
			<td><?php echo $saleDetail['amount'];?></td>
			<td><?php echo $saleDetail['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'sale_details', 'action' => 'view', $saleDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'sale_details', 'action' => 'edit', $saleDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'sale_details', 'action' => 'delete', $saleDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $saleDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sale Detail', true), array('controller' => 'sale_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
