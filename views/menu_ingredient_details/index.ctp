<div class="menuIngredientDetails index">
	<h2><?php __('Menu Ingredient Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('menu_ingredient_id');?></th>
			<th><?php echo $this->Paginator->sort('product_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('unit');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($menuIngredientDetails as $menuIngredientDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $menuIngredientDetail['MenuIngredientDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($menuIngredientDetail['MenuIngredient']['id'], array('controller' => 'menu_ingredients', 'action' => 'view', $menuIngredientDetail['MenuIngredient']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($menuIngredientDetail['Product']['name'], array('controller' => 'products', 'action' => 'view', $menuIngredientDetail['Product']['id'])); ?>
		</td>
		<td><?php echo $menuIngredientDetail['MenuIngredientDetail']['qty']; ?>&nbsp;</td>
		<td><?php echo $menuIngredientDetail['MenuIngredientDetail']['unit']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $menuIngredientDetail['MenuIngredientDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $menuIngredientDetail['MenuIngredientDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $menuIngredientDetail['MenuIngredientDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menuIngredientDetail['MenuIngredientDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Menu Ingredient Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Menu Ingredients', true), array('controller' => 'menu_ingredients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Ingredient', true), array('controller' => 'menu_ingredients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>