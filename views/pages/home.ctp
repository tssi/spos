
<div class="art-content-layout-row" >
<?php
if(!isset($user)){
?>
	<?php echo $this->element('ss/ssLoginPane'); ?>
	
	

<?php } ?>

<?php foreach($posts as $post): ?>
	<div class="art-layout-cell art-layout-cell-compressed">
		<div class="overview-table-inner">
				<h4 class="posts_title"><?php echo $post['Post']['title']; ?></h4>
				<span class="posts_content"><?php echo $post['Post']['content']; ?></span>
			</div>
	</div><!-- end cell -->
	<?php endforeach ?>
</div>