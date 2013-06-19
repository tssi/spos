<div class="dailyInventoryProductDetails view">
<h2><?php  __('Daily Inventory Product Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProductDetail['DailyInventoryProductDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Daily Inventory Product'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($dailyInventoryProductDetail['DailyInventoryProduct']['name'], array('controller' => 'daily_inventory_products', 'action' => 'view', $dailyInventoryProductDetail['DailyInventoryProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Itemcode'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProductDetail['DailyInventoryProductDetail']['itemcode']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProductDetail['DailyInventoryProductDetail']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryProductDetail['DailyInventoryProductDetail']['count']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Daily Inventory Product Detail', true), array('action' => 'edit', $dailyInventoryProductDetail['DailyInventoryProductDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Daily Inventory Product Detail', true), array('action' => 'delete', $dailyInventoryProductDetail['DailyInventoryProductDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryProductDetail['DailyInventoryProductDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Product Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Product Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Products', true), array('controller' => 'daily_inventory_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Product', true), array('controller' => 'daily_inventory_products', 'action' => 'add')); ?> </li>
	</ul>
</div>
