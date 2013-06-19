<div class="endingReconciliations form">
<?php echo $this->Form->create('EndingReconciliation');?>
	<fieldset>
		<legend><?php __('Add Ending Reconciliation'); ?></legend>
	<?php
		echo $this->Form->input('beginning_computer');
		echo $this->Form->input('beginning_actual');
		echo $this->Form->input('purchases');
		echo $this->Form->input('product_id');
		echo $this->Form->input('ending_computer');
		echo $this->Form->input('ending_actual');
		echo $this->Form->input('variance_computer');
		echo $this->Form->input('variance_actual');
		echo $this->Form->input('remarks');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ending Reconciliations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>