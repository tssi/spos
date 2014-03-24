function checkTime(i){
	if (i<10) i="0" + i;
	return i;
}

function timeIt(){ //TIME TICKER
	d = new Date();
	dateIs = d.getFullYear()+'-'+(d.getMonth())+'-'+d.getDate()+' '+checkTime(d.getHours())+':'+checkTime(d.getMinutes())+':'+checkTime(d.getSeconds());
	$('#RemittanceCreated').val(dateIs);
	setTimeout("timeIt()",1000);
}
	
$(document).ready(function(){
	timeIt(); //EXECUTE TIMING
	$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
	
	$('#dialog').bind('pop-it', function(evt, args) {
		var _msg = args.msg;
		var _title = args.title;
		var _buttons = args.button
		var _modal = args.modal
		$('#dialog').dialog({
			title: _title,
			modal: _modal,
			closeOnEscape: false,
			open: function(event, ui) {
				$(this).parent().children().children(".ui-dialog-titlebar-close").hide();
			},
			buttons: _buttons
		});
		$('#dialog').html(_msg);
	});
	
	
	function initialize(){
		//-- DESCRIPTION AUTO-COMPLETE
		$('.collectorAuto').livequery(function(){
			var input =  $(this);		
			input.autocomplete({
				source: [],
				select: function(event, ui) {
					$(event.target).val(ui.item.label);
					$('#RemittanceCollector').val(ui.item.id);
					$(event.target).focus().blur();//.trigger('keypress',{'which':13});
					return false;
				}
			}).keypress(function(){
			   var userDesc = $(this).val();
			   var myLink = window.location.protocol + "//" + window.location.host + "/" + 'canteen/users/find';
			   var source = [];
			   $('.collectorAuto').autocomplete('option','source',source);		   
			   $.ajax({
					type:'POST',
					url: myLink,
					data:{'data':{'User':{'key':userDesc}}},
					beforeSend:function(){
						//console.log('key: ',productDesc);
					},
					success:function(data){
						var prod = $.parseJSON(data);
						$.each(prod, function(c,o){
							var itemsOf = {
								'label':o.User.userFull,
								'value':o.User.userFull,
								'id':o.User.id,
							};
							source.push(itemsOf);
						})
						//console.log('source: ',source);
						$('.collectorAuto').autocomplete('option','source',source);
						//}
					},
					error:function(){
						alert('Reload');
					}
				});
				return;
			});
		});
		var cashier_id = $('#RemittanceCashier').val();
		
		//GET SALES
		$.ajax({
			url:'/canteen/sales/daily_report/'+cashier_id,
			success:function(data){
				var data = $.parseJSON(data);
				$('#RemittanceSalesAmount').val(data.Total_Sales).blur();
				d = new Date();
				dateIs = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+checkTime(d.getMinutes())+':'+d.getSeconds();
				$('#RemittanceCreated').val(dateIs);
				
				//GET PREVIOUS REMITTANCE		  
				$('#RemittanceAddForm').ajaxSubmit({ 
					url:'/canteen/remittances/get_previous/',
					success:function(data){
						try{
							var previous = $.parseJSON(data);
							$('#RemittancePrevious').val(previous['0']['0'].total);
						}catch(e){
							if(e.type=="non_object_property_load") $('#RemittancePrevious').val(0.0);
						}
						
						var total_sales = parseFloat($('#RemittanceSalesAmount').val());
						var total_remittance = parseFloat($('#RemittancePrevious').val());
						
						if(isNaN(total_sales)){
							$.ajax({
								url:'/canteen/sales/daily_report/',
								success:function(data){
									var data = $.parseJSON(data);
									console.log(data);
									$('#RemittanceSalesAmount').val(data.Total_Sales).blur();
									total_sales = parseFloat(data.Total_Sales);
								}
							});
						}
						
						if(isNaN(total_remittance)) total_remittance=0.0;
						
						var cashInBox = total_sales-total_remittance;
						
						if(isNaN(cashInBox)) cashInBox = 0.0;
						
						$('#RemittanceCashInBox').val(cashInBox);
						
						$('#RemittanceAddForm').ajaxSubmit({ 
							url:'/canteen/remittances/getAllRemit/'+cashier_id,
							success:function(data){
								$('#remittance_view ul.recordDataGrid').trigger('clear_grid');
								$('#remittance_view ul.recordDataGrid').trigger('update_grid');
								remitted = $.parseJSON(data);
								var source = [];
								//PREPARE DATA STRUCTURE
								$.each(remitted, function(ctr,obj){
									var date = new Date(obj.Remittance.created);
									var remit = obj.Remittance.remitted;
									d1 = date.toLocaleDateString()
									t1 = date.toLocaleTimeString();
									var aggr={};           
										aggr['div.VIEWdate input']=d1;
										aggr['div.VIEWtime input']=t1;
										aggr['div.VIEWcash input']=remit;
										aggr['div.VIEWtotal input']=remit;
										
									source.push(aggr);  
								});
								$('#remittance_view ul.recordDataGrid').trigger('populate_grid',{'data':source});
								$('#remittance_view ul.recordDataGrid').bind('hide', function(){
									$('#remittance_view ul.recordDatagrid li.mainInput').hide();
								});
								$('#remittance_view ul.recordDataGrid').trigger('hide');
								$('.monetary').blur();
							}
						});
					  },
					error:function(){alert('Reload')}
				}); 	
			}	  
		});
		
		$('#RemittanceCollectorName').keypress(function(e){
			if(e.which==13) $('#RemittanceCollectorName, input').trigger('blur');
		});
		
		$('#RemittanceCollectorName').removeAttr("readonly");		
		$('#RemittanceRemitted, #RemittanceCollectorName, #RemittanceCollector').val('').blur();	
		$('#RemittanceCollectorName').select();
	};
	
	initialize();
	
	$('#RemittanceAddForm').bind('formNeat_sucess',function(evt,args){
		data = $.parseJSON(args.data);
		msg='<center><strong>Printing remittance...</strong></center>';
		var button = {};
			button.OK = function() {
				var formatDate = $('#RemittanceCreated').val();
				formatDate=new Date(formatDate);
				formatDate.setMonth(formatDate.getMonth()+1);
				/* formatDate.setHours(formatDate.getHours()+7)
				console.log(formatDate); */
				//console.log(formatDate.toISOString());
				$('#RemittanceAddForm').attr('action','/canteen/remittances/report');
				$('#RemittanceAddForm').attr('target','_blank');
				$('#RemittanceRefNo').val(data.data.Remittance.ref_no);
				$('#RemittanceCreated').val(formatDate.toISOString());
				$('#RemittanceAddForm').submit();
				$('#RemittanceAddForm').attr('action','/canteen/remittances/add');
				$('#RemittanceAddForm').removeAttr('target');
				
				initialize();
				$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
				$(this).dialog('destroy');
			};
			$('#dialog').trigger('pop-it', {
				'title': 'Notification',
				'msg': msg,
				'button': button,
				'modal': true
			});
	});
	
	//CURRENT INPUT EVENT HANDLER
	$('#RemittanceRemitted').live('blur', function(){
		var contain = parseFloat($.trim($('#RemittanceCashInBox').val()));
		var remit = parseFloat($.trim($('#RemittanceRemitted').val()));
		
		if(remit>contain){
			$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
			var box = $('#RemittanceRemitted');
			var button = {};
			button.BACK = function() {
				box.select();
				$(this).dialog('destroy');
			};
			$('#dialog').trigger('pop-it', {
				'title': 'Notification',
				'msg': '<center><strong>Invalid amount!..</strong></center>',
				'button': button,
				'modal': true
			});
		}else{
			if(!isNaN(remit)) $('#save_button').removeAttr("disabled").parent().parent().addClass('topaz');
			
			current = parseFloat($('#RemittancePrevious').val());
			
			if(isNaN(current)) current = 0.0;
			if(isNaN(remit)) remit = 0.0;
			
			$('#RemittanceTotal').val(remit+current).blur();
		}
		$('#RemittanceTotal').blur();
	}).keypress(function(e){if(e.which==13) $('#RemittanceRemitted').blur() });
		
	//CANCEL BUTTON EVENT HANDLER
	$('#cancel_button').click(function(){
		$('#RemittanceRemitted, #RemittanceCollectorName, #RemittanceCollector').val('').blur();
		$('#RemittanceCollectorName').removeAttr("readonly");
		$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
		$('#RemittanceCollectorName').focus();
	});
	
	$('#RemittanceCollectorName').focus(function(){
		$('#RemittanceCollectorName').select();
	})
	
	$('#RemittanceCollectorName').blur(function(e){
		if($(this).val()!='' && $('#RemittanceCollector').val()!=''){
			$('#RemittanceCollectorName').attr('readonly', 'readonly');
			$('#RemittanceRemitted').select();
		}else{
			if($(this).val()==''){
				/* var msg = '<center><strong>Please collector name...</strong></center>';
				var button = {};
				button.BACK = function() {
					$(this).dialog('destroy');
					$('#RemittanceCollectorName').select();
				};
				$('#dialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': msg,
					'button': button,
					'modal': true
				}); */
			}else{
			//if($(this).val()!=''){
				var msg = ;
				var button = {};
				button.BACK = function() {
					$(this).dialog('destroy');
					$('#RemittanceCollectorName').select();
				};
				$('#dialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': '<center><strong>Collector not authorize!..</strong></center>',
					'button': button,
					'modal': true
				});
			}
		}
	});
	
});

