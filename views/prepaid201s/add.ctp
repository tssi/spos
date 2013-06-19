<div class="prepaid201s form">
<?php echo $this->Form->create('Prepaid201');?>
	<fieldset>
		<legend><?php __('Add Prepaid201'); ?></legend>
	<?php
		echo $this->Form->input('reference');
		echo $this->Form->input('status');
		echo $this->Form->input('category');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Prepaid201s', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sop Pp Trans', true), array('controller' => 'sop_pp_trans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Pp Tran', true), array('controller' => 'sop_pp_trans', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sop Pp Vals', true), array('controller' => 'sop_pp_vals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Pp Val', true), array('controller' => 'sop_pp_vals', 'action' => 'add')); ?> </li>
	</ul>
</div>