$(document).ready(function(e){

	$('#SaleBuyerType,#SaleBuyerId').change(function(){
		var buyer_type = $('#SaleBuyerType').val();
		var buyer_id = $('#SaleBuyerId').val();
		if(buyer_type.length && buyer_id.length){
			$.ajax({
				url:ssUtil.cch_brk('/canteen/sales/get_buyer_details'),
				type:'POST',
				dataType:'json',
				data:{'data':{'buyer_type':buyer_type,'buyer_id':buyer_id}},
				beforeSend:function(){
					$('#SaleName').val('').attr('placeholder','Loading...');
				},
				success:function(json){
					$('#SaleName').removeAttr('placeholder');
					if(!json){
						alert('No Result Found Check Buyer Type & Buyer ID');
						return;
					}
					
					$('#SaleName').val(json[buyer_type].full_name);
				}
			
			});
		}
	});
});