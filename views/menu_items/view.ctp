<div class="menuItems view">
<h2><?php  __('Menu Item');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['item_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($menuItem['Unit']['name'], array('controller' => 'units', 'action' => 'view', $menuItem['Unit']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Selling Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['selling_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu Item', true), array('action' => 'edit', $menuItem['MenuItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Menu Item', true), array('action' => 'delete', $menuItem['MenuItem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menuItem['MenuItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Menu Details', true), array('controller' => 'daily_menu_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Menu Detail', true), array('controller' => 'daily_menu_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Daily Menu Details');?></h3>
	<?php if (!empty($menuItem['DailyMenuDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Menu Item Id'); ?></th>
		<th><?php __('Selling Price'); ?></th>
		<th><?php __('Aprrox Srv'); ?></th>
		<th><?php __('Served'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menuItem['DailyMenuDetail'] as $dailyMenuDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $dailyMenuDetail['id'];?></td>
			<td><?php echo $dailyMenuDetail['menu_item_id'];?></td>
			<td><?php echo $dailyMenuDetail['selling_price'];?></td>
			<td><?php echo $dailyMenuDetail['aprrox_srv'];?></td>
			<td><?php echo $dailyMenuDetail['served'];?></td>
			<td><?php echo $dailyMenuDetail['created'];?></td>
			<td><?php echo $dailyMenuDetail['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'daily_menu_details', 'action' => 'view', $dailyMenuDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'daily_menu_details', 'action' => 'edit', $dailyMenuDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'daily_menu_details', 'action' => 'delete', $dailyMenuDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyMenuDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Daily Menu Detail', true), array('controller' => 'daily_menu_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
