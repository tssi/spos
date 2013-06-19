<div class="menuItems form">
<?php echo $this->Form->create('MenuItem');?>
	<fieldset>
		<legend><?php __('Add Menu Item'); ?></legend>
	<?php
		echo $this->Form->input('item_code');
		echo $this->Form->input('name');
		echo $this->Form->input('unit_id');
		echo $this->Form->input('selling_price');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menu Items', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Daily Menu Details', true), array('controller' => 'daily_menu_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Daily Menu Detail', true), array('controller' => 'daily_menu_details', 'action' => 'add')); ?> </li>
	</ul>
</div>