<div class="sopPpVals form">
<?php echo $this->Form->create('SopPpVal');?>
	<fieldset>
		<legend><?php __('Add Sop Pp Val'); ?></legend>
	<?php
		echo $this->Form->input('prepaid201_id');
		echo $this->Form->input('amount_balance');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sop Pp Vals', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Prepaid201s', true), array('controller' => 'prepaid201s', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prepaid201', true), array('controller' => 'prepaid201s', 'action' => 'add')); ?> </li>
	</ul>
</div>