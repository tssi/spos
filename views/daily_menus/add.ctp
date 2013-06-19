<div class="dailyMenus form">
<?php echo $this->Form->create('DailyMenu');?>
	<fieldset>
		<legend><?php __('Add Daily Menu'); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('name');
		echo $this->Form->input('menu_item_id');
		echo $this->Form->input('selling_price');
		echo $this->Form->input('aprrox_srv');
		echo $this->Form->input('served');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Daily Menus', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>