<div class="pettyCashes form">
<?php echo $this->Form->create('PettyCash');?>
	<fieldset>
		<legend><?php __('Add Petty Cash'); ?></legend>
	<?php
		echo $this->Form->input('employee');
		echo $this->Form->input('login');
		echo $this->Form->input('amount');
		echo $this->Form->input('purpose');
		echo $this->Form->input('flag');
		echo $this->Form->input('trans_type');
		echo $this->Form->input('ref_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Petty Cashes', true), array('action' => 'index'));?></li>
	</ul>
</div>