<div class="endingDetails form">
<?php echo $this->Form->create('EndingDetail');?>
	<fieldset>
		<legend><?php __('Edit Ending Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ending_id');
		echo $this->Form->input('item_code');
		echo $this->Form->input('name');
		echo $this->Form->input('qty');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('EndingDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('EndingDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ending Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Endings', true), array('controller' => 'endings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending', true), array('controller' => 'endings', 'action' => 'add')); ?> </li>
	</ul>
</div>