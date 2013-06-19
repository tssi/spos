<div class="activities form">
<?php echo $this->Form->create('Activity');?>
	<fieldset>
		<legend><?php __('Add Activity'); ?></legend>
	<?php
		echo $this->Form->input('actor');
		echo $this->Form->input('action');
		echo $this->Form->input('object');
		echo $this->Form->input('code');
		echo $this->Form->input('details');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Activities', true), array('action' => 'index'));?></li>
	</ul>
</div>