<div class="menuIngredientDetails view">
<h2><?php  __('Menu Ingredient Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuIngredientDetail['MenuIngredientDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Menu Ingredient'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($menuIngredientDetail['MenuIngredient']['id'], array('controller' => 'menu_ingredients', 'action' => 'view', $menuIngredientDetail['MenuIngredient']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($menuIngredientDetail['Product']['name'], array('controller' => 'products', 'action' => 'view', $menuIngredientDetail['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuIngredientDetail['MenuIngredientDetail']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuIngredientDetail['MenuIngredientDetail']['unit']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu Ingredient Detail', true), array('action' => 'edit', $menuIngredientDetail['MenuIngredientDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Menu Ingredient Detail', true), array('action' => 'delete', $menuIngredientDetail['MenuIngredientDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menuIngredientDetail['MenuIngredientDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Ingredient Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Ingredient Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Ingredients', true), array('controller' => 'menu_ingredients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Ingredient', true), array('controller' => 'menu_ingredients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
