<div class="saleDetails index">
	<h2><?php __('Sale Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('sale_id');?></th>
			<th><?php echo $this->Paginator->sort('product_type_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($saleDetails as $saleDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $saleDetail['SaleDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($saleDetail['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $saleDetail['Sale']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($saleDetail['ProductType']['name'], array('controller' => 'product_types', 'action' => 'view', $saleDetail['ProductType']['id'])); ?>
		</td>
		<td><?php echo $saleDetail['SaleDetail']['qty']; ?>&nbsp;</td>
		<td><?php echo $saleDetail['SaleDetail']['amount']; ?>&nbsp;</td>
		<td><?php echo $saleDetail['SaleDetail']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $saleDetail['SaleDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $saleDetail['SaleDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $saleDetail['SaleDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $saleDetail['SaleDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sale Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Types', true), array('controller' => 'product_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Type', true), array('controller' => 'product_types', 'action' => 'add')); ?> </li>
	</ul>
</div>