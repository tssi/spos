<div class="dailyInventoryMenuDetails view">
<h2><?php  __('Daily Inventory Menu Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Daily Inventory Menu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($dailyInventoryMenuDetail['DailyInventoryMenu']['name'], array('controller' => 'daily_inventory_menus', 'action' => 'view', $dailyInventoryMenuDetail['DailyInventoryMenu']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Itemcode'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['itemcode']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['count']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Daily Inventory Menu Detail', true), array('action' => 'edit', $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Daily Inventory Menu Detail', true), array('action' => 'delete', $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryMenuDetail['DailyInventoryMenuDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Menu Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Menu Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Menus', true), array('controller' => 'daily_inventory_menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Menu', true), array('controller' => 'daily_inventory_menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
