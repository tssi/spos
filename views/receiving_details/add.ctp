<div class="receivingDetails form">
<?php echo $this->Form->create('ReceivingDetail');?>
	<fieldset>
		<legend><?php __('Add Receiving Detail'); ?></legend>
	<?php
		echo $this->Form->input('receiving_id');
		echo $this->Form->input('item_code');
		echo $this->Form->input('name');
		echo $this->Form->input('qty');
		echo $this->Form->input('unit_id');
		echo $this->Form->input('price');
		echo $this->Form->input('amount');
		echo $this->Form->input('purchase_price');
		echo $this->Form->input('avg_purchase_price');
		echo $this->Form->input('current_selling_price');
		echo $this->Form->input('revise_srp');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Receiving Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Receivings', true), array('controller' => 'receivings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving', true), array('controller' => 'receivings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>