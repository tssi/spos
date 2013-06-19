	<div class="art-layout-cell art-layout-cell-compressed" id="loginPane">
		<div class="overview-table-inner" id="loginHolder">
			<div class="users">
			<?php   echo $this->Session->flash('auth');?>
			<?php echo $this->Form->create('User' , array('action'=>'login'));?>
				<?php
					echo $this->Form->input('username',array('label'=>'Username:','autocomplete'=>'off'));
					echo $this->Form->input('password',array('label'=>'Password:','autocomplete'=>'off'));
				?>
					<div class="submit art-button-wrapper fRight">
						<span class="l"></span>
						<span class="r"> </span>
						<input class="art-button" type="submit" value="Login">
					</div>
			<?php echo $this->Form->end();?>
			<div class="cleared"></div>
			</div>
		</div>
	</div>