<div class="Navigations form">
<?php echo $this->Form->create('Navigation');?>
	<fieldset>
		<legend><?php __('Add Navigation'); ?></legend>
	<?php
		if($parents==null){
			$parents =  array(''=>'ROOT');
		}
		echo $this->Form->input('parent_id',array('type'=>'select','options'=>$parents));
		echo $this->Form->input('title');
		echo $this->Form->input('link');
		
	?>
	</fieldset>
	<input class="art-button" type="submit" value="Submit"/>
<?php echo $this->Form->end();?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Navigations', true), array('action' => 'index')); ?></li>
	</ul>
</div>