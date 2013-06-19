<div class="Navigations form">
<?php echo $this->Form->create('Navigation');?>
	<fieldset>
		<legend><?php __('Edit Navigation'); ?></legend>
	<?php
		array_unshift($parents, array(''=>'ROOT'));
		echo $this->Form->input('parent_id',array('type'=>'select','options'=>$parents));
		echo $this->Form->input('title');	
		echo $this->Form->input('link');	
		echo $this->Form->input('id');
	?>
	</fieldset>
	<input class="art-button" type="submit" value="Submit"/>
<?php echo $this->Form->end();?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Navigation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Navigation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Navigations', true), array('action' => 'index')); ?></li>
	</ul>
</div>