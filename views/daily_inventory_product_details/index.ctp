<div class="dailyInventoryProductDetails index">
	<h2><?php __('Daily Inventory Product Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('daily_inventory_product_id');?></th>
			<th><?php echo $this->Paginator->sort('itemcode');?></th>
			<th><?php echo $this->Paginator->sort('desc');?></th>
			<th><?php echo $this->Paginator->sort('count');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($dailyInventoryProductDetails as $dailyInventoryProductDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $dailyInventoryProductDetail['DailyInventoryProductDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($dailyInventoryProductDetail['DailyInventoryProduct']['name'], array('controller' => 'daily_inventory_products', 'action' => 'view', $dailyInventoryProductDetail['DailyInventoryProduct']['id'])); ?>
		</td>
		<td><?php echo $dailyInventoryProductDetail['DailyInventoryProductDetail']['itemcode']; ?>&nbsp;</td>
		<td><?php echo $dailyInventoryProductDetail['DailyInventoryProductDetail']['desc']; ?>&nbsp;</td>
		<td><?php echo $dailyInventoryProductDetail['DailyInventoryProductDetail']['count']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $dailyInventoryProductDetail['DailyInventoryProductDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $dailyInventoryProductDetail['DailyInventoryProductDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $dailyInventoryProductDetail['DailyInventoryProductDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryProductDetail['DailyInventoryProductDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Daily Inventory Product Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Products', true), array('controller' => 'daily_inventory_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Product', true), array('controller' => 'daily_inventory_products', 'action' => 'add')); ?> </li>
	</ul>
</div>