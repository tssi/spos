<div class="sopCgeTrans form">
<?php echo $this->Form->create('SopCgeTran');?>
	<fieldset>
		<legend><?php __('Add Sop Cge Tran'); ?></legend>
	<?php
		echo $this->Form->input('date');
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

		<li><?php echo $this->Html->link(__('List Sop Cge Trans', true), array('action' => 'index'));?></li>
	</ul>
</div>