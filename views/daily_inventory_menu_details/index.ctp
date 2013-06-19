<div class="dailyInventoryMenuDetails index">
	<h2><?php __('Daily Inventory Menu Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('daily_inventory_menu_id');?></th>
			<th><?php echo $this->Paginator->sort('itemcode');?></th>
			<th><?php echo $this->Paginator->sort('desc');?></th>
			<th><?php echo $this->Paginator->sort('count');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($dailyInventoryMenuDetails as $dailyInventoryMenuDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($dailyInventoryMenuDetail['DailyInventoryMenu']['name'], array('controller' => 'daily_inventory_menus', 'action' => 'view', $dailyInventoryMenuDetail['DailyInventoryMenu']['id'])); ?>
		</td>
		<td><?php echo $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['itemcode']; ?>&nbsp;</td>
		<td><?php echo $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['desc']; ?>&nbsp;</td>
		<td><?php echo $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['count']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Daily Inventory Menu Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Menus', true), array('controller' => 'daily_inventory_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Menu', true), array('controller' => 'daily_inventory_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>