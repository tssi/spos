<div class="menuIngredients form">
<?php echo $this->Form->create('MenuIngredient');?>
	<fieldset>
		<legend><?php __('Add Menu Ingredient'); ?></legend>
	<?php
		echo $this->Form->input('menu_item_id');
		echo $this->Form->input('servings');
		echo $this->Form->input('login');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menu Ingredients', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('controller' => 'menu_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Ingredient Details', true), array('controller' => 'menu_ingredient_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Ingredient Detail', true), array('controller' => 'menu_ingredient_details', 'action' => 'add')); ?> </li>
	</ul>
</div>