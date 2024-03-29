$(document).ready(function(){
	var DaysInMillisec = 86400000;
	$('.wWider label').css('width','67px');
	$('.wWider').css('width','48%');
	
	//--POP DIALOG CONSTRUCTOR
    $('#myDialog').bind('pop-it', function(evt, args){
		var _msg = args.msg;
		var _title = args.title;
		var _buttons = args.button
		var _modal = args.modal
		$('#myDialog').dialog({
			title: _title,
			modal: _modal,
			closeOnEscape: false,
			open: function(event, ui) {
				// Hide close button
				$(this).parent().children().children(".ui-dialog-titlebar-close").hide();
			},
			buttons: _buttons
		});
		$('.ui-widget-overlay').css('opacity','.2');
		$('#myDialog').html(_msg);
		$('.ui-dialog-buttonset button:first').show();
	});
	
	$.ajax({
		type:'POST',
		url: '/canteen/endings/findEndings',
		beforeSend:function(){
			var msg = "<br/><center><img src='/canteen/img/icons/loader.gif'><br/><br/><strong>Reconcilling Ending Inventory...</strong></center>";
			var button = {};
			$('#myDialog').trigger('pop-it', {
				'title': 'Notification',
				'msg': msg,
				'button': button,
				'modal': true
			})
		},
		success:function(data){
			$('#myDialog').dialog('destroy');
			var endings=$.parseJSON(data);
			
			if(endings){
				var begin='null';
				var ending='null';
				if(endings.Merchandise_Ending_Date_Beginning){
					begin=new Date(endings.Merchandise_Ending_Date_Beginning);
					begin = begin.getFullYear()+'-'+(parseInt(begin.getMonth())+1)+'-'+begin.getDate();
					ending=new Date(endings.Merchandise_Ending_Date_Ending);
					ending = ending.getFullYear()+'-'+(parseInt(ending.getMonth())+1)+'-'+ending.getDate();
				}
				
				$('#MerchBeginDate').val(begin);
				$('#MerchEndDate').val(ending);
				if(endings.Merchadise_status==1){
					if(endings.Merchandise_Ending_Date_Beginning == null){ // if no previous Ending Inventory
						var msg = '<br/><center><strong>No Previous Day Ending Inventory!<br/><br/>';
						msg += 'Most Recent Date On File:</strong>';
						msg += '<br/>(None)';
						msg += '<br/><br/><strong>Continue?</strong></center>';
							
						var button = {};
							
						button['Disregard Previous']=function(){
							$(this).dialog('destroy');
							popuMerch(endings,1);
							
						};
						button['Cancel']=function(){
							$(this).dialog('destroy');
						};
						
						$('#myDialog').trigger('pop-it', {
							'title': 'Notification',
							'msg': msg,
							'button': button,
							'modal': true
						})
						
						
					}else{
						var beg = new Date(endings.Merchandise_Ending_Date_Beginning);
						var end = new Date(endings.Merchandise_Ending_Date_Ending);
						var aDayAgo = (end.getTime()-beg.getTime())/DaysInMillisec;
						
						//console.log('end:',end.toLocaleDateString(),end.getTime(),'beg:',beg.toLocaleDateString(),beg.getTime(),'aDayAgo: ',aDayAgo);
						if(aDayAgo>=1){
							var msg = '<br/><center><strong>No Previous Day Ending Inventory!<br/><br/>';
							msg += 'Most Recent Date On File:</strong>';
							msg += '<br/>'+beg.toLocaleDateString();
							msg += '<br/><strong>('+$.timeago(beg)+')<strong>';
							msg += '<br/><br/><strong>Continue?</strong></center>';
								
							var button = {};
								button['Consider Previous']=function(){
									$(this).dialog('destroy');
									var source = [];
									
									popuMerch(endings,0);
									//postMeals(endings);
									
							};
								
							button['Disregard Previous']=function(){
								$(this).dialog('destroy');
								popuMerch(endings,1);
								//postMeals(endings);
							
							};
							button['Cancel']=function(){
								$(this).dialog('destroy');
								//postMeals(endings);
							};
							
							$('#myDialog').trigger('pop-it', {
								'title': 'Notification',
								'msg': msg,
								'button': button,
								'modal': true
							})
							
							$('.ui-dialog').css('width', '385px');
						}else{
							popuMerch(endings,0);
							//postMeals(endings);
						}
					}
					
					
					 
				 }else{
					var msg = "<br/><center><strong>"+endings.Merchadise_message+"</strong></center>";
					var button = {};
					button['Go To Ending Inventory']=function(){
						top.location.href=('/canteen/endings/');
						$(this).dialog('destroy');
					}
					button['Proceed to Meals Anyway']=function(){
						$(this).dialog('destroy');
						postMeals(endings);
					}
					
					$('#myDialog').trigger('pop-it', {
						'title': 'Notification',
						'msg': msg,
						'button': button,
						'modal': true
					});
					$('.ui-dialog').css('width','auto');
				 
				 }
			}
		
		}
	});
	
	function popuMerch(merch,flag){
		var merch_source = [];
		
		if (flag){ //if flag is 1 end only else both
			$.each(merch.Merchandise, function(c,o){
				var aggr={};
				aggr['div.desc input']=o.name;
				aggr['div.id_product input']=o.id_product;
				aggr['div.sold input']=o.end_sold;
				aggr['div.endC input']=o.end_c_qty;
				aggr['div.endA input']=o.end_a_qty;
				aggr['div.varC input']=o.end_c_qty - o.end_a_qty;
				aggr['div.varA input']=o.end_a_qty - o.end_c_qty;
				merch_source.push(aggr);
			});
			
			$('#ending_recon ul.recordDataGrid').trigger('populate_grid',{'data':merch_source});
			$('#ending_recon ul.recordDatagrid li.mainInput').hide();
			$('#ending_recon ul.recordDataGrid').trigger('update_grid'); 
		}else{
			$.each(merch.Merchandise, function(c,o){
				var aggr={};
				aggr['div.id_product input']=o.id_product;
				aggr['div.begC input']=o.beg_c_qty;
				aggr['div.begA input']=o.beg_a_qty;
				aggr['div.desc input']=o.name;
				aggr['div.sold input']=o.end_sold;
				aggr['div.endC input']=o.end_c_qty;
				aggr['div.endA input']=o.end_a_qty;
				aggr['div.varC input']=o.end_c_qty - o.end_a_qty;
				aggr['div.varA input']=o.end_a_qty - o.end_c_qty;
				merch_source.push(aggr);
			});
			
			$('#ending_recon ul.recordDataGrid').trigger('populate_grid',{'data':merch_source});
			$('#ending_recon ul.recordDatagrid li.mainInput').hide();
			$('#ending_recon ul.recordDataGrid').trigger('update_grid'); 
		
		}
		
		var x = $('#ending_recon .input input');
		
		$.each(x, function(c,o){
			 if(!isNaN(parseInt($(o).val()))){
					if(parseInt($(o).val())<0){
						$(o).css("color", "red")
					}
				}  
		 });
		
		 postMeals(merch);		 
	}
	
	function popuMeals(meals,flag){
		
		var meal_source = [];
		console.log(meals);
		if (flag){ //if flag is 1 end only else both
			$.each(meals, function(c,o){
				var aggr={};
				aggr['div.desc input']=o.name;
				aggr['div.id_product input']=o.id_product;
				aggr['div.sold input']=o.end_sold;
				aggr['div.endC input']=o.end_c_qty;
				aggr['div.endA input']=o.end_a_qty;
				aggr['div.varC input']=o.end_c_qty - o.end_a_qty;
				aggr['div.varA input']=o.end_a_qty - o.end_c_qty;
				meal_source.push(aggr);
			});
			
			$('#ending_recon_meals ul.recordDataGrid').trigger('populate_grid',{'data':meal_source});
			$('#ending_recon_meals ul.recordDatagrid li.mainInput').hide();
			$('#ending_recon_meals ul.recordDataGrid').trigger('update_grid'); 
		}else{
			$.each(meals, function(c,o){
				var aggr={};
				aggr['div.id_product input']=o.id_product;
				aggr['div.begC input']=o.beg_c_qty;
				aggr['div.begA input']=o.beg_a_qty;
				aggr['div.desc input']=o.name;
				aggr['div.sold input']=o.end_sold;
				aggr['div.endC input']=o.end_c_qty;
				aggr['div.endA input']=o.end_a_qty;
				aggr['div.varC input']=o.end_c_qty - o.end_a_qty;
				aggr['div.varA input']=o.end_a_qty - o.end_c_qty;
				meal_source.push(aggr);
			});
			
			$('#ending_recon_meals ul.recordDataGrid').trigger('populate_grid',{'data':meal_source});
			$('#ending_recon_meals ul.recordDatagrid li.mainInput').hide();
			$('#ending_recon_meals ul.recordDataGrid').trigger('update_grid'); 
		
		}
		
		var x = $('#ending_recon_meals .input input');
		
		$.each(x, function(c,o){
			 if(!isNaN(parseInt($(o).val()))){
					if(parseInt($(o).val())<0){
						$(o).css("color", "red")
					}
				}  
		 });
		 
	
	}

	function postMeals(fromData){
		console.log(fromData);
		var mealBegin;
		var mealEnd;
		
		if(fromData.Meal_status==1){
					//console.log('endings.Merchadise_Ending_Date_Beginning: ',endings.Merchadise_Ending_Date_Beginning);
					if(fromData.Meal_Ending_Date_Beginning == null){ // if no previous Ending Inventory
						mealBegin='Null';
						var msg = '<br/><center><strong>No Previous Day Meal Ending Inventory!<br/><br/>';
						msg += 'Most Recent Date On File:</strong>';
						msg += '<br/>(None)';
						msg += '<br/><br/><strong>Continue?</strong></center>';
							
						var button = {};
							
						button['Disregard Previous']=function(){
							$(this).dialog('destroy');
							
							popuMeals(fromData.Meal,1);
							
						};
						button['Cancel']=function(){
							$(this).dialog('destroy');
						};
						
						$('#myDialog').trigger('pop-it', {
							'title': 'Notification',
							'msg': msg,
							'button': button,
							'modal': true
						})
										
					}else{
						var beg = new Date(fromData.Meal_Ending_Date_Beginning);
						var end = new Date(fromData.Meal_Ending_Date_Ending);
						var aDayAgo = (end.getTime()-beg.getTime())/DaysInMillisec;
						
						//console.log('end:',end.toLocaleDateString(),end.getTime(),'beg:',beg.toLocaleDateString(),beg.getTime(),'aDayAgo: ',aDayAgo);
						
						if(aDayAgo>1){
							var msg = '<br/><center><strong>No Previous Day Ending Inventory!<br/><br/>';
							msg += 'Most Recent Date On File:</strong>';
							msg += '<br/>'+beg.toLocaleDateString();
							msg += '<br/><strong>('+$.timeago(beg)+')<strong>';
							msg += '<br/><br/><strong>Continue?</strong></center>';
								
							var button = {};
								button['Consider Previous']=function(){
									$(this).dialog('destroy');
									var source = [];
									
									popuMeals(fromData.Meal,0);
									
							};
								
							button['Disregard Previous']=function(){
								$(this).dialog('destroy');
								popuMeals(fromData.Meal,1);
							
							};
							button['Cancel']=function(){
								$(this).dialog('destroy');
							};
							
							$('#myDialog').trigger('pop-it', {
								'title': 'Notification',
								'msg': msg,
								'button': button,
								'modal': true
							})
							
							$('.ui-dialog').css('width', '385px');
						}else{
							popuMeals(fromData.Meal,0);
							
						}
						
					}
					
					
					 
				 }else{
					var msg = "<br/><center><strong>"+fromData.Meal_message+"</strong></center>";
					var button = {};
					button['Go To Ending Inventory']=function(){
						top.location.href=('/canteen/endings/meal_served');
						$(this).dialog('destroy');
					}
					button['Proceed anyway']=function(){
						$(this).dialog('destroy');
					}
					
					$('#myDialog').trigger('pop-it', {
						'title': 'Notification',
						'msg': msg,
						'button': button,
						'modal': true
					});
					$('.ui-dialog').css('width','auto');
				 
				 }
		mealEnd=new Date(fromData.Meal_Ending_Date_Ending);
		mealEnd = mealEnd.getFullYear()+'-'+(parseInt(mealEnd.getMonth())+1)+'-'+mealEnd.getDate()
		$('#MealBegginingDate').val(mealBegin);
		$('#MealEndingDate').val(mealEnd);
	}

	$('#PerLineSubmmittingButton').click(function(){
		var records = $('#recon_merch li.dynamicInput');
		var index= 0;
		var chunk = 20;
		async_submit(records, index,chunk);
	});
	
	var minutesTime='Calculating time';
	function  async_submit(records, index, chunk){
		//records array for dataset
		//index for chunk counting
		//chunk size for splitting records
		var li_count =records.length;
		var start = chunk*index; //Start index of chunk
		var end =(start+chunk); //End index of chunk
		
		var is_last = start > li_count; //Flag to determine if current chunk is_last
		$('#recon_merch li.mainInput').find('input').attr('disabled','disabled');
		$('#recon_merch li.dynamicInput input').attr('disabled','disabled');
		$('#recon_merch li.dynamicInput').slice( start, end ).find('input').removeAttr('disabled');
		
		var STATUS_MSG = 'Saving <b>'+((!is_last)?start:li_count) +'</b> of <b>'+ li_count+'</b>';
		$('#progress-bar').html('<center><img src="img/icons/loader.gif"/></br>'+STATUS_MSG+'</center>');
		
		$('#recon_merch').ajaxSubmit({
			beforeSend:function(){
				//console.log(index,start,end,li_count);
				$('#progress-bar').dialog({
					modal:true,
					title: 'Saving',
					closeOnEscape: false,
					open: function(event, ui){
						$(this).parent().children().children(".ui-dialog-titlebar-close").hide();
					},
				});
			},
			success:function(data){
					var json = $.parseJSON(data);
					$('#Id,#ReportEndingReconciliationId').val(json.data.EndingReconciliation.id);
					if(!is_last) return async_submit(records, index+1,chunk); //Update index to point next chunk
					else  {
						$('#progress-bar').dialog('destroy');
						$('#Report').submit();	//Generate print out if last chunk already	
					}				
			}
		});
	}
});