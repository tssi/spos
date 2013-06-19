<style>
#wrapper{ width:350px;}
#title-bar span{color:white;font-size:12px;}
#search-box{padding:3px;text-align:center;}
#stream-pool .item{
	background-image:none;
	background-image: none;
	padding-bottom: 2px;
	border-bottom: 1px gray dashed;
}
#stream-pool .user{
	font-size: 12px;
	font-weight: bold;
}
#stream-pool .activity{
	margin-left:4px;
}
#stream-pool .activity .object{
	font-size:10px;
	margin-left:0px;
}
#stream-pool .activity .action{
	font-size:10px;
	margin-left:3px;
}
</style>
<script>
	$(document).ready(function(){
		$('#activity_feed_form').bind('search',function(evt,args){
			$('#activity_feed_form').ajaxSubmit({
				beforeSend:function(){
					
				},
				success:function(data){
					$('#stream-pool').html('');
					$.each(data,function(i,e){
						var details =  $.parseJSON(e.Activity.details);
						var data = details.data;
						var activity = '<li class="activity"><div class="meta" ';
							activity +="data='"+$.toJSON(data)+"'";
							activity +='>'+e.markup+'</div>';
							activity +='<ul class="details" style="display:none;">';
							activity +=$(tree(data)).html();
							activity +='</ul></li>';
						$('#stream-pool').append(activity);
						
					});
				}
			});
		});
		$('#go-button').click(function(){
			$('#key').val($('#search_key').val());
			$('#activity_feed_form').trigger('search');
		});
		$('.ajax_runner').live('click',function(){
			var THIS = this;
			var LINK = $(this).attr('link');
			var DATA = $.parseJSON($(this).parent().parent().attr('data'));
			var RUN  = parseInt($(this).attr('run'));
			if(RUN){
				$.ajax({
					type: 'POST',
					url:cch_brk(LINK),
					data:{'data':DATA},
					beforeSend:function(){
						$('.ajax_runner').attr('run',0);
						$(THIS).css({'opacity':0.25});
					},
					success:function(data){
						$('.ajax_runner').attr('run',1);
						$(THIS).css({'opacity':1});
					}
				});
			}
		});
		$('.detail_viewer').live('click',function(){
			var activity = $(this).parent().parent().parent();
			$(this).text($(this).text()=="+"?"-":"+");
			$(activity).find('.details').slideToggle();
			
		});
	});
</script>
<?php 
 echo $this->Form->create('Activities',array('action'=>'feeds','id'=>'activity_feed_form'));
 echo $this->Form->input('key',array('type'=>'hidden','id'=>'key'));
 echo $this->Form->input('timestamp',array('type'=>'hidden','id'=>'timestamp'));
 echo $this->Form->end();
?>
<div id="wrapper">
	<div id="activity-feed" class="tab">
		<div id="title-bar" class="tab-header">
			<span>Activity Feeds</span>
		</div>
		<div id="content" class="tab-content">
			<div id="search-box">
				<input type="text" id="search_key" class="xxlarge" />
				<input type="button" id="go-button" class="art-button" value="GO"/>
			</div>
			<div id="notifications"></div>
			<ul id="stream-pool">
			</ul>
		</div>
	</div>
</div>

