<div class="endings form">
<?php echo $this->Form->create('Ending');?>
	<fieldset>
		<legend><?php __('Add Ending'); ?></legend>
	<?php
		echo $this->Form->input('ref_no');
		echo $this->Form->input('login');
		echo $this->Form->input('user');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Endings', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ending Details', true), array('controller' => 'ending_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending Detail', true), array('controller' => 'ending_details', 'action' => 'add')); ?> </li>
	</ul>
</div>