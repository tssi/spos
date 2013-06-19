<style>
#login_holder{
	background-image: url('/isms/img/page_sg.jpg');
	background-repeat: repeat-x;
	padding:9px;
	width:150px;
	height:350px;
	margin: 5px;
}
</style>

	<div class="art-layout-cell art-layout-cell-compressed" id="login_pane">
		<div class="overview-table-inner" id="login_holder">
			<div class="users">
			<?php   echo $this->Session->flash('auth');?>
			<?php echo $this->Form->create('User' , array('action'=>'login'));?>
				<?php
					echo $this->Form->input('username',array('label'=>'Username:','autocomplete'=>'off'));
					echo $this->Form->input('password',array('label'=>'Password:','autocomplete'=>'off'));
				?>
					<div class="submit art-button-wrapper right">
						<span class="l"></span>
						<span class="r"> </span>
						<input class="art-button" type="submit" value="Submit">
					</div>
			<?php echo $this->Form->end();?>
			<div class="cleared"></div>
			</div>
		</div>
	</div>