var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';

$(document).ready(function(){//RECOUNT
	$('.start-recounting').livequery('click',function(){
		var row = $(this).parents('li:first');
		var item_code = row.find('.VIEWitemCode input').val();

		$.ajax({
			type:'POST',
			url: BASE_URL+'products/start_recounting',
			data:{'data':{'Product':{'item_code':item_code}}},
			success:function(data){	
				var result = $.parseJSON(data);
				console.log(result.data.Product.last_recount_start_time);
		
				row.find("abbr.timeago").attr('title',result.data.Product.last_recount_start_time);
				row.find("abbr.timeago").timeago();
				row.find(".LastRecountStartTime input").val(result.data.Product.last_recount_start_time);
			}
		});
	
	});

	
});
