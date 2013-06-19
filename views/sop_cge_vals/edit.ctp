<div class="sopCgeVals form">
<?php echo $this->Form->create('SopCgeVal');?>
	<fieldset>
		<legend><?php __('Edit Sop Cge Val'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('amount_balance');
		echo $this->Form->input('as_of_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SopCgeVal.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SopCgeVal.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sop Cge Vals', true), array('action' => 'index'));?></li>
	</ul>
</div>