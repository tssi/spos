<div class="menuIngredientDetails form">
<?php echo $this->Form->create('MenuIngredientDetail');?>
	<fieldset>
		<legend><?php __('Add Menu Ingredient Detail'); ?></legend>
	<?php
		echo $this->Form->input('menu_ingredient_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('qty');
		echo $this->Form->input('unit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menu Ingredient Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menu Ingredients', true), array('controller' => 'menu_ingredients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Ingredient', true), array('controller' => 'menu_ingredients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>