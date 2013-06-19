<div class="users form">
<?php   echo $this->Session->flash('auth');?>
			<?php echo $this->Form->create('User' , array('action'=>'login'));?>
	<fieldset>
		<legend><?php __('Login'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
	<input class="art-button" type="submit" value="Submit">
<?php echo $this->Form->end();?>
</div>
