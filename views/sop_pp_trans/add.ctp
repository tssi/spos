<div class="sopPpTrans form">
<?php echo $this->Form->create('SopPpTran');?>
	<fieldset>
		<legend><?php __('Add Sop Pp Tran'); ?></legend>
	<?php
		echo $this->Form->input('prepaid201_id');
		echo $this->Form->input('doc_number');
		echo $this->Form->input('amount');
		echo $this->Form->input('flag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sop Pp Trans', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Prepaid201s', true), array('controller' => 'prepaid201s', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prepaid201', true), array('controller' => 'prepaid201s', 'action' => 'add')); ?> </li>
	</ul>
</div>