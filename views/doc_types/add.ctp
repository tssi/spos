<div class="docTypes form">
<?php echo $this->Form->create('DocType');?>
	<fieldset>
		<legend><?php __('Add Doc Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Doc Types', true), array('action' => 'index'));?></li>
	</ul>
</div>