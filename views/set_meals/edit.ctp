<div class="setMeals form">
<?php echo $this->Form->create('SetMeal');?>
	<fieldset>
		<legend><?php __('Edit Set Meal'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('menu_item_id');
		echo $this->Form->input('menu_item');
		echo $this->Form->input('product_item');
		echo $this->Form->input('qty');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SetMeal.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SetMeal.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Set Meals', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('controller' => 'menu_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Set Component Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>