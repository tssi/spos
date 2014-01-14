var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
$(document).ready(function(){
	$('.uiNotify').wrap('<span style="display:none"/>');// hide notify
    $('.recordDatagrid li.mainInput').hide();
    var RECORD_SPEED = 'slow';
    var menuItemsURL = '/canteen/menu_items';
	var status = 0;
	var allowContext = true;
    //--------------------------
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
				// Hide close button
				$(this).parent().children().children(".ui-dialog-titlebar-close").hide();
			},
			buttons: _buttons
		});
		$('#dialog').html(_msg);
	});
	
	//--- INITIATE DATEPICKER
	$('.datepicker').datepicker({ 
			dateFormat: 'yy-mm-dd',
			destroyed: true,
			yearRange: "-50:+0",
			changeMonth: true,
			changeYear: true,
			onSelect: function(dateText, inst) {
				var source = '#'+inst.id;
				if($(source).hasClass('hasstaledate')){
					if(daydiff(new Date(),parseDate(dateText))*-1>165){
						$('#check_alert').dialog({
								modal:true,
								title: 'Warning',
								buttons: {
									OK: function(){
										$(source).val('').focus();
										$(this).dialog('destroy');
									}
								}
							});
					}
				}
			}
		});
	
	//-- SET DATE TO CURRENT DATE
	var advanceDate = new Date();
	//advanceDate.setDate(advanceDate.getDate()+1);
	$(".datepicker").datepicker('setDate', advanceDate);

    //---------------------------
	var CONTXT_DSBLE='context-menu-item-disabled';
	var liClicked = null;
	
	$('#masterList ul.recordDatagrid li').live('mousedown',function(e){ //to avoid editing other menu at the same time
			if(e.which==3){
					liClicked = $(this);
				}
		});
	
	$('.goto-button').click(function(){
		document.location.href=menuItemsURL;
	});
	
	//POPULATE CURRENT MENU
	$('#go_button').click(function(){
		var dateIs = $('#dailyMenuDate').val();
		
		$.getJSON(
		ssUtil.cch_brk('/canteen/daily_menus/findDailyMenu/'+dateIs+''),
		function(data){
			$('#menu ul.recordDataGrid').trigger('clear_grid');//clear first
			$('#menu ul.recordDataGrid').trigger('update_grid',{'data':source});
			//console.log(data);
			var source = [];
			  //Prepare data structure
			  $.each(data, function(ctr,obj){
					var desc= obj.MenuItem.name;
					var price = obj.DailyMenu.selling_price;
					var avg = obj.MenuItem.avg_price;
					var unit = obj.MenuItem.Unit.alias;
					var menu_item_id = obj.MenuItem.id;
					var itemcode = obj.MenuItem.item_code;
					var approx_srv = (parseFloat(obj.DailyMenu.approx_srv) + parseFloat(obj.DailyMenu.additional_approx_srv)).toFixed(2);
					var daily_menu_id = obj.DailyMenu.id;
					var srv_left = obj.DailyMenu.srv_left;
					var approx_srv_is_editable = obj.DailyMenu.approx_srv_is_editable;
					var obj={};
					obj['div.menu_item_id input']=menu_item_id;
					obj['div.daily_menu_id input']=daily_menu_id;
					obj['div.code input'] = itemcode;
					obj['div.desc input']=desc;
					obj['div.price input']=ssUtil.roundNumber(price,2);
					obj['div.AVGprice input']=ssUtil.roundNumber(avg,2);
					obj['div.appSrv input']=approx_srv;
					obj['div.srvLeft input']=srv_left;
					obj['div.approx_srv_is_editable input']=approx_srv_is_editable;
					obj['div.unit input']=unit;
					source.push(obj);
				});
				//Pass data to populate_grid event
				$('#menu ul.recordDataGrid').trigger('populate_grid',{'data':source});
				$('#menu ul.recordDataGrid').trigger('update_grid');
				
				$('#menu ul.recordDataGrid').bind('hide', function(){
					$('.recordDatagrid li.mainInput').hide();
					
				});
				$('#menu ul.recordDataGrid').trigger('hide');
			}
		);
	}).trigger('click');	
	
    //--------------------
	$(document).bind('restore_defaults', function() {
		$('#menu .recordDatagrid li.dynamicInput').fadeOut(RECORD_SPEED,function(){
			$('#menu .recordDatagrid li.dynamicInput').remove();
			$(".datepicker").datepicker('setDate', new Date());	
		});
	});
    
    $('form').bind('formNeat_sucess',function(e,a){
		var msg = $('.uiNotify').html();
		var button = {};
		button.BACK = function() {
			$(this).dialog('destroy');
			$(document).trigger('restore_defaults');
		};
		$('#dialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': msg,
			'button': button,
			'modal': true
		});
    });
	
	$("#cancel_button").click(function(){
		$(document).trigger('restore_defaults');
	});
   
	function fillMenu(){
		$.getJSON(
			'/canteen/menu_items/findMenu',
			function(data){
				var source = [];
				//PREPARE DATA STRUCTURE
				$.each(data, function(ctr,obj){
					var desc= obj.MenuItem.name;
					var price = obj.MenuItem.selling_price;
					var avg = obj.MenuItem.avg_price;
					var unit = obj.Unit.alias;
					var id = obj.MenuItem.id;
					var itemcode = obj.MenuItem.item_code;
					var obj={};
					obj['div.menu_item_id input']=id;
					obj['div.code input'] = itemcode;
					obj['div.desc input']=desc;
					obj['div.price input']=ssUtil.roundNumber(price,2);
					obj['div.AVGprice input']=ssUtil.roundNumber(avg,2);
					obj['div.unit input']=unit;
					source.push(obj);
				});
				//PASS DATA TO POPULATE_GRID EVENT
				$('#masterList ul.recordDataGrid').trigger('populate_grid',{'data':source});
				$('#masterList ul.recordDataGrid').bind('hide', function(){
					$('.recordDatagrid li.mainInput').hide();
				});
				$('#masterList ul.recordDataGrid').trigger('hide');
				$('.monetary').blur();
			  }); 
		};
	fillMenu(); //AGGREGATE MENU
	
	$("div.context-menu-item").live('click', function(){
		console.log('may item na tinamaan')
		console.log('ctxtmenu clicked: ',liClicked);
		liClicked.parents('li:first').addClass('current');
	});

	var liHolder = null;
    $('#masterList ul.recordDataGrid').bind('grid_populated',function(){
		$(this).find('li.dynamicInput').addClass('clickInput');
	});

	//$.contextMenu.shadow = false;  
    
	//LINK TO MAIN MENU
	$('#toMenu').click(function(){
		window.location = menuItemsURL;
	});
	
    $('#CanteenAddItemInTheMenuList').click(function(e,a){
		var keyHit = e.which;
		var matched = $("#masterList [style*='display: block']");
		var check = !$.trim($('#CanteenAddItemInTheMenuList').val()) =='';
       
		if (keyHit==13){
			if (matchedCount.length==1){
				if(check){
					matched.click();
					$('#CanteenAddItemInTheMenuList').val('');
				}
			}
		}
    });	
   
	//MENU MASTER LIST CLICKED EVENT
	$('#masterList ul.recordDatagrid li.clickInput').live('clicked',function(evt,args){
		var data = [];
		var obj = args.obj;
		data.push(obj);
		var menu_id = obj['div.menu_item_id input'];
		var exist = $('#menu div.menu_item_id input[value="'+parseInt(menu_id)+'"]')

		if(!$('#masterList ul.recordDataGrid').hasClass('context-menu-active')){
			if(exist.length==0){
				data[0]['div.daily_menu_id input']='';
				$('#menu ul.recordDataGrid').trigger('populate_grid',{'data':data});
				$('#menu ul.recordDataGrid').find('li:last div.price input').removeAttr('readonly');
				$('#menu ul.recordDataGrid').find('li:last div.appSrv input').removeAttr('readonly').focus();
			}
		}
	});
		
	$('#desc').keyup(function(e,a){
       var keyHit = e.which;
       var matched = $("#masterList [style*='display: block']");
       var desc = !$.trim($('#desc').val()) =='';  
       if (keyHit==13){
            if (matched.length==1){
				console.log(matched);
                if(desc){
                    matched.click();
                    $('#desc').val('');
                }
				
            }else{//if no match on the item code
				$('#desc').val('').blur();
				
				$('#dialog').dialog({
					title:'Warning',
					modal:true,
					closeOnEscape: false,
					open: function(event, ui){
					
					$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
					buttons:{Back:function(e, a){
						//$(this).focus();
						$(this).dialog('destroy');
						$('#desc').focus();
						
					}}
				});
				$('#dialog').html('No match found!');
				
				
			}      
       }
    });
	
	//EDIT
    $('.edit-product').livequery('click',function(){
		var row = $(this).parents('li:first');
		row.find('.editable').removeAttr('readonly','readonly');
		row.find('.VIEWprice input').focus().select();
		row.find('.action').html('<a class="save-product"><img src="'+BASE_URL+'img/icons/disk.png"></img></a>');
		row.find('.appSrv input').addClass('is_modal');
		$('#submit_button').attr('disabled','disabled');
	});
	
	//SAVE
	$('.save-product').livequery('click',function(){
		var row = $(this).parents('li:first');
		row.find('.editable').attr('readonly','readonly');
		row.find('.action').html('<a class="edit-product"><img src="'+BASE_URL+'img/icons/pencil.png"></img></a>');
		var id = row.find('.daily_menu_id input').val();
		var price = row.find('.VIEWprice input').val();
		var appSrv = row.find('.appSrv input').val();
		var srvLeft = row.find('.srvLeft input').val();
		var tType = row.find('.tType input').val();
		var additionalApproxSrv = row.find('.additionalApproxSrv input').val();
		$.ajax({
			type:'POST',
			url: BASE_URL+'daily_menus/update',
			data:{'data':{'DailyMenu':{'id':id,'selling_price':price,'approx_srv':appSrv,'srv_left':srvLeft,'tType':tType,'additional_approx_srv':additionalApproxSrv}}},
			success:function(data){
				var data = $.parseJSON(data);
				$('#go_button').trigger('click');
				$('#submit_button').removeAttr('disabled');
				row.find('.appSrv input').removeClass('is_modal');
				
				$('#myDialog').dialog({
					title:'Notify',
					modal:true,
					closeOnEscape: false,
					open: function(event, ui){$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},
					buttons:{
							Back:function(e, a){
								$(this).dialog('destroy');
							},	
						}
				});
				$('#myDialog').html(data.msg);
				
			}
		});
	});
	
	//QTY ADJUSTMENT MODAL
	$('.appSrv input.is_modal').livequery('click',function(){
		var row = $(this).parents('li:first');
		var appSrv = parseFloat(row.find('.appSrv input').val());
		var approx_srv_is_editable = row.find('.approx_srv_is_editable input').val();

		$('#myDialog').dialog({
			title:'Add/Edit Approximate Serving',
			modal:true,
			closeOnEscape: false,
			open: function(event, ui){$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},
			buttons:{
					Ok:function(e, a){
						var tType = $('#tType').val();
						var newQty = parseFloat($('#NewQty').val());
						if(tType=='Add'){
							appSrv = (appSrv + newQty).toFixed(2);
							additionalApproxSrv = newQty.toFixed(2);
							row.find('.additionalApproxSrv input').val(additionalApproxSrv);
						}else if(tType=='Edit'){
							appSrv = newQty.toFixed(2);
							row.find('.additionalApproxSrv input').val(0);
												
						}
						row.find('.srvLeft  input').val(appSrv);	
						row.find('.tType  input').val(tType);
						row.find('.appSrv input').val(appSrv);
						
						$(this).dialog('destroy');
					},
					Cancel:function(e, a){
						$(this).dialog('destroy');
					},	
				}
		});
		var html='';
		if(approx_srv_is_editable == 'true'){
			html = "<br/><b>Transaction Type: <select class='w55' id='tType'><option value='Add'>Add Approx. Srv.</option><option value='Edit'>Edit Init. Approx. Srv.</option></select></b><br/><br/>"+
				"<div class='fLeft w43 pt5 text-right'><b>Quantity:</b></div>"+
				"<div class='fRight w57'><input id='NewQty' class='monetary numeric taRight'/></div>"+
				"<div class='fClear'></div>"
		}else{
			html = "<br/><b>Transaction Type: <select class='w55' id='tType'><option value='Add'>Add Approx. Srv.</option></select></b><br/><br/>"+
				"<div class='fLeft w43 pt5 text-right'><b>Quantity:</b></div>"+
				"<div class='fRight w57'><input id='NewQty' class='monetary numeric taRight'/></div>"+
				"<div class='fClear'></div>"
		}
		$('#myDialog').html(html);
	});
});