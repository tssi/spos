<?php  echo $this->Html->css('form/formValidation'); ?>
<?php  echo $this->Html->script('form/formValidation'); ?>
<div class="users form">
<?php   echo $this->Session->flash('auth');?>
<?php echo $this->Form->create('User' , array('action'=>'register'));?>
	<fieldset>
		<legend><?php __('Register'); ?></legend>
	<?php
		echo $this->Form->input('username',array('id'=>'username','frm'=>'#frm_usr_chk','class'=>'username ajax','linkto'=>'#username_check'));
		echo $this->Form->input('password',array('value'=>false,'id'=>'password','class'=>'password'));
		echo $this->Form->input('confirm_password',array('type'=>'password','id'=>'password_confirm','class'=>'cpassword','linkto'=>'#password'));
		echo '<hr/>';
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		
	?>
	</fieldset>
	<input class="art-button submit-button" type="submit" value="Submit" id="submit">
<?php echo $this->Form->end();?>

<?php echo $this->Form->create('User' , array('action'=>'check','id'=>'frm_usr_chk'));
	echo $this->Form->input('username',array('type'=>'hidden','id'=>'username_check'));
 echo $this->Form->end();?>
</div>
