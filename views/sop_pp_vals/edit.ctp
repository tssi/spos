<div class="sopPpVals form">
<?php echo $this->Form->create('SopPpVal');?>
	<fieldset>
		<legend><?php __('Edit Sop Pp Val'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('prepaid201_id');
		echo $this->Form->input('amount_balance');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SopPpVal.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SopPpVal.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sop Pp Vals', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Prepaid201s', true), array('controller' => 'prepaid201s', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prepaid201', true), array('controller' => 'prepaid201s', 'action' => 'add')); ?> </li>
	</ul>
</div>