<div class="dailyInventoryProducts view">
<h2><?php  __('Daily Inventory Product');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProduct['DailyInventoryProduct']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Login'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProduct['DailyInventoryProduct']['login']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProduct['DailyInventoryProduct']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProduct['DailyInventoryProduct']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProduct['DailyInventoryProduct']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Daily Inventory Product', true), array('action' => 'edit', $dailyInventoryProduct['DailyInventoryProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Daily Inventory Product', true), array('action' => 'delete', $dailyInventoryProduct['DailyInventoryProduct']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryProduct['DailyInventoryProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Products', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Product', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Product Details', true), array('controller' => 'daily_inventory_product_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Product Detail', true), array('controller' => 'daily_inventory_product_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Daily Inventory Product Details');?></h3>
	<?php if (!empty($dailyInventoryProduct['DailyInventoryProductDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Daily Inventory Product Id'); ?></th>
		<th><?php __('Itemcode'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('Count'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($dailyInventoryProduct['DailyInventoryProductDetail'] as $dailyInventoryProductDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $dailyInventoryProductDetail['id'];?></td>
			<td><?php echo $dailyInventoryProductDetail['daily_inventory_product_id'];?></td>
			<td><?php echo $dailyInventoryProductDetail['itemcode'];?></td>
			<td><?php echo $dailyInventoryProductDetail['desc'];?></td>
			<td><?php echo $dailyInventoryProductDetail['count'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'daily_inventory_product_details', 'action' => 'view', $dailyInventoryProductDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'daily_inventory_product_details', 'action' => 'edit', $dailyInventoryProductDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'daily_inventory_product_details', 'action' => 'delete', $dailyInventoryProductDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryProductDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Daily Inventory Product Detail', true), array('controller' => 'daily_inventory_product_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
