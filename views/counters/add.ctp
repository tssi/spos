<div class="counters form">
<?php echo $this->Form->create('Counter');?>
	<fieldset>
		<legend><?php __('Add Counter'); ?></legend>
	<?php
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Counters', true), array('action' => 'index'));?></li>
	</ul>
</div>