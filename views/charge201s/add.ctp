<?php
	echo $this->Html->script(array('biz/charge201s'));
?>

<div class="charge201s form">
<?php echo $this->Form->create('Charge201');?>
	<fieldset>
		<legend><?php __('Add Charge201'); ?></legend>
		
	<?php
		$options=array('E'=>'Employee','S'=>'Student');
		$attributes=array('legend'=>false,'value'=>'E');
		echo $this->Form->radio('category',$options,$attributes);
	?>	
	<?php
		echo $this->Form->input('reference',array('label'=>'Reference ID'));
		echo $this->Form->input('name',array('readonly'=>'readonly','style'=>'width: 60%'));
		echo $this->Form->input('status');
	?>
	</fieldset>
	<br/>
	<?php echo $this->Form->submit('Save',array('id'=>'SaveButton','type'=>'button','disabled'=>'disabled'));?>	
							
	<?php echo $this->Form->end();?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Charge201s', true), array('action' => 'index'));?></li>
	</ul>
</div>