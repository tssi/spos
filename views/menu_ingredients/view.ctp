<div class="menuIngredients view">
<h2><?php  __('Menu Ingredient');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuIngredient['MenuIngredient']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Menu Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($menuIngredient['MenuItem']['name'], array('controller' => 'menu_items', 'action' => 'view', $menuIngredient['MenuItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Servings'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuIngredient['MenuIngredient']['servings']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Login'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuIngredient['MenuIngredient']['login']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuIngredient['MenuIngredient']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu Ingredient', true), array('action' => 'edit', $menuIngredient['MenuIngredient']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Menu Ingredient', true), array('action' => 'delete', $menuIngredient['MenuIngredient']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menuIngredient['MenuIngredient']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Ingredients', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Ingredient', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('controller' => 'menu_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Ingredient Details', true), array('controller' => 'menu_ingredient_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Ingredient Detail', true), array('controller' => 'menu_ingredient_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Menu Ingredient Details');?></h3>
	<?php if (!empty($menuIngredient['MenuIngredientDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Menu Ingredient Id'); ?></th>
		<th><?php __('Product Id'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Unit'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menuIngredient['MenuIngredientDetail'] as $menuIngredientDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $menuIngredientDetail['id'];?></td>
			<td><?php echo $menuIngredientDetail['menu_ingredient_id'];?></td>
			<td><?php echo $menuIngredientDetail['product_id'];?></td>
			<td><?php echo $menuIngredientDetail['qty'];?></td>
			<td><?php echo $menuIngredientDetail['unit'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'menu_ingredient_details', 'action' => 'view', $menuIngredientDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'menu_ingredient_details', 'action' => 'edit', $menuIngredientDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'menu_ingredient_details', 'action' => 'delete', $menuIngredientDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menuIngredientDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Menu Ingredient Detail', true), array('controller' => 'menu_ingredient_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
