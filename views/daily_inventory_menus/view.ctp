<div class="dailyInventoryMenus view">
<h2><?php  __('Daily Inventory Menu');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenu['DailyInventoryMenu']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Login'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenu['DailyInventoryMenu']['login']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenu['DailyInventoryMenu']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenu['DailyInventoryMenu']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyInventoryMenu['DailyInventoryMenu']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Daily Inventory Menu', true), array('action' => 'edit', $dailyInventoryMenu['DailyInventoryMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Daily Inventory Menu', true), array('action' => 'delete', $dailyInventoryMenu['DailyInventoryMenu']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryMenu['DailyInventoryMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Menus', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Menu', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Inventory Menu Details', true), array('controller' => 'daily_inventory_menu_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Inventory Menu Detail', true), array('controller' => 'daily_inventory_menu_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Daily Inventory Menu Details');?></h3>
	<?php if (!empty($dailyInventoryMenu['DailyInventoryMenuDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Daily Inventory Menu Id'); ?></th>
		<th><?php __('Login'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($dailyInventoryMenu['DailyInventoryMenuDetail'] as $dailyInventoryMenuDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $dailyInventoryMenuDetail['id'];?></td>
			<td><?php echo $dailyInventoryMenuDetail['daily_inventory_menu_id'];?></td>
			<td><?php echo $dailyInventoryMenuDetail['login'];?></td>
			<td><?php echo $dailyInventoryMenuDetail['name'];?></td>
			<td><?php echo $dailyInventoryMenuDetail['created'];?></td>
			<td><?php echo $dailyInventoryMenuDetail['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'daily_inventory_menu_details', 'action' => 'view', $dailyInventoryMenuDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'daily_inventory_menu_details', 'action' => 'edit', $dailyInventoryMenuDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'daily_inventory_menu_details', 'action' => 'delete', $dailyInventoryMenuDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyInventoryMenuDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Daily Inventory Menu Detail', true), array('controller' => 'daily_inventory_menu_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
