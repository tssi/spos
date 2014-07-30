<?php echo $this->Html->script('form/formValidation'); ?>
<div class="users form">
<script>
	$(document).ready(function(){
		$('.submit-button').click(function(){
			var FORM = $(this).parent().parent();
			$(FORM).ajaxSubmit({ 
				success: function(data) {
					var json_data =  $.parseJSON(data);
					alert(json_data.status+":\n"+json_data.message);
					$(FORM).find('input').removeAttr('disabled');
					$(FORM).find('.password input').val('');
					if(json_data.status==OK){
						location.href="/canteen/users/logout";
					}
				},
				beforeSend:function(e){
					$(FORM).find('input').attr('disabled','disabled');
				}
			});
		});
	});
	</script>
<h1>Account Settings</h1>
<hr/>
<?php echo $this->Form->create('User',array('action'=>'change/info','class'=>'me'));?>
	<fieldset>
		<legend><?php __('Edit User Information'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username',array('id'=>'username','frm'=>'#frm_usr_chk','class'=>'username ajax','linkto'=>'#username_check'));
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('password');
		
	?>
	</fieldset>
	<input class='art-button submit-button' type='button' value='Submit'/>
<?php echo $this->Form->end();?>

<?php echo $this->Form->create('User' , array('action'=>'check','id'=>'frm_usr_chk'));
	echo $this->Form->input('username',array('type'=>'hidden','id'=>'username_check'));
 echo $this->Form->end();?>
<hr/>
<?php echo $this->Form->create('User', array('action'=>'change/password','class'=>'me'));?>
	<fieldset>
		<legend><?php __('Change Password'); ?></legend>
	<?php
		echo $this->Form->input('old_password',array('type'=>'password'));
		
		echo $this->Form->input('password',array('value'=>false,'id'=>'new_password','class'=>'password'));
		echo $this->Form->input('confirm_password',array('type'=>'password','id'=>'password_confirm','class'=>'cpassword','linkto'=>'#new_password'));
			?>
	</fieldset>
	<input class='art-button submit-button' type='button' value='Submit'/>
<?php echo $this->Form->end();?>
</div>