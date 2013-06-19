<div class="dailyInventoryProducts index">
	<h2><?php __('Daily Inventory Products');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('login');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($dailyInventoryProducts as $dailyInventoryProduct):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $dailyInventoryProduct['DailyInventoryProduct']['id']; ?>&nbsp;</td>
		<td><?php echo $dailyInventoryProduct['DailyInventoryProduct']['login']; ?>&nbsp;</td>
		<td><?php echo $dailyInventoryProduct['DailyInventoryProduct']['name']; ?>&nbsp;</td>
		<td><?php echo $dailyInventoryProduct['DailyInventoryProduct']['created']; ?>&nbsp;</td>
		<td><?php echo $dailyInventoryProduct['DailyInventoryProduct']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $dailyInventoryProduct['DailyInventoryProduct']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $dailyInventoryProduct['DailyInventoryProduct']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $dailyInventoryProduct['DailyInventoryProduct']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryProduct['DailyInventoryProduct']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Daily Inventory Product', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Product Details', true), array('controller' => 'daily_inventory_product_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Product Detail', true), array('controller' => 'daily_inventory_product_details', 'action' => 'add')); ?> </li>
	</ul>
</div>