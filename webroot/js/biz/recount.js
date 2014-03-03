var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';

$(document).ready(function(){//RECOUNT
	$('.start-recounting').livequery('click',function(){
		var row = $(this).parents('li:first');
		var prod_id = row.find('.VIEWID input').val();
		$.ajax({
			type:'POST',
			url: BASE_URL+'products/start_recounting',
			data:{'data':{'Product':{'id':prod_id,'is_recounting':'1'}}},
			success:function(data){	
				var result = $.parseJSON(data);
				if(result.status){
					row.find(".LastRecountStartTime input").val(result.data.Product.last_recount_start_time);
					row.find(".IsRecounting input").val('TRUE');
				}else{
					alert('Error starting.Please try again');
				}
			}
		});
	});
	
	
	$('.stop-recounting').livequery('click',function(){
		var row = $(this).parents('li:first');
		var prod_id = row.find('.VIEWID input').val();
		$.ajax({
			type:'POST',
			url: BASE_URL+'products/start_recounting',
			data:{'data':{'Product':{'id':prod_id,'is_recounting':'0'}}},
			success:function(data){	
				var result = $.parseJSON(data);
				
				row.find(".IsRecounting input").val((result.data.Product.is_recounting==1)?true:false);
				
				if(result.status){
					row.find(".LastRecountStopTime input").val('');
					row.find(".IsRecounting input").val('FALSE');
				}else{
					alert('Error stopping.Please try again');
				}
			}
		});

	});
	
	
});
