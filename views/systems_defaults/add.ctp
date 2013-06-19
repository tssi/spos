<div class="systemsDefaults form">
<?php echo $this->Form->create('SystemsDefault');?>
	<fieldset>
		<legend><?php __('Add Systems Default'); ?></legend>
	<?php
		echo $this->Form->input('field');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Systems Defaults', true), array('action' => 'index'));?></li>
	</ul>
</div>