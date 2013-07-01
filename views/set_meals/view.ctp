<div class="setMeals view">
<h2><?php  __('Set Meal');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setMeal['SetMeal']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Menu Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($setMeal['MenuItem']['name'], array('controller' => 'menu_items', 'action' => 'view', $setMeal['MenuItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Set Component Menu Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($setMeal['SetComponentMenuItem']['name'], array('controller' => 'menu_items', 'action' => 'view', $setMeal['SetComponentMenuItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Set Component Product'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($setMeal['SetComponentProduct']['name'], array('controller' => 'products', 'action' => 'view', $setMeal['SetComponentProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setMeal['SetMeal']['qty']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Set Meal', true), array('action' => 'edit', $setMeal['SetMeal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Set Meal', true), array('action' => 'delete', $setMeal['SetMeal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setMeal['SetMeal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Set Meals', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Set Meal', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('controller' => 'menu_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Set Component Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
