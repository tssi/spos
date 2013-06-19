<div class="dailyMenus view">
<h2><?php  __('Daily Menu');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyMenu['DailyMenu']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyMenu['DailyMenu']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyMenu['DailyMenu']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Menu Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($dailyMenu['MenuItem']['name'], array('controller' => 'menu_items', 'action' => 'view', $dailyMenu['MenuItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Selling Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyMenu['DailyMenu']['selling_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Aprrox Srv'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyMenu['DailyMenu']['aprrox_srv']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Served'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyMenu['DailyMenu']['served']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyMenu['DailyMenu']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dailyMenu['DailyMenu']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Daily Menu', true), array('action' => 'edit', $dailyMenu['DailyMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Daily Menu', true), array('action' => 'delete', $dailyMenu['DailyMenu']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dailyMenu['DailyMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Menus', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Menu', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
