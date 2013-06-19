var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
$(document).ready(function(){
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
	
	//--- Initiate datepicker
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
	
	//-- Set date to Current Date
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
	
	
	
	//populate current Menu
	$('#go_button').click(function(){
		var dateIs = $('#dailyMenuDate').val();
		//console.log('date: ',dateIs);
		
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
			  var avg = obj.DailyMenu.avg_price;
			  var unit = obj.MenuItem.Unit.alias;
			  var id = obj.MenuItem.id;
			  var itemcode = obj.MenuItem.item_code;
			  var approx_srv = obj.DailyMenu.approx_srv;
			  var mid = obj.DailyMenu.id;
			  var srv_left = obj.DailyMenu.served;
			  var obj={};
			  obj['div.menu_item_id input']=id;
			  obj['div.daily_menu_id input']=mid;
			  obj['div.code input'] = itemcode;
			  obj['div.desc input']=desc;
			  obj['div.price input']=ssUtil.roundNumber(price,2);
			  obj['div.AVGprice input']=ssUtil.roundNumber(avg,2);
			  obj['div.appSrv input']=approx_srv;
			  obj['div.srvLeft input']=srv_left;
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
		
	});
	
	$('#go_button').trigger('click');	
	
    //--------------------
	$(document).bind('restore_defaults', function() {
		$('#menu .recordDatagrid li.dynamicInput').fadeOut(RECORD_SPEED,function(){
			$('#menu .recordDatagrid li.dynamicInput').remove();
			$(".datepicker").datepicker('setDate', new Date());	
		});
		
	});
    
    $('form').bind('formNeat_sucess',function(e,a){
      
        //console.log($('.uiNotify').text());
        
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
				console.log(data);
			  var source = [];
				  //Prepare data structure
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
			  
				//Pass data to populate_grid event
				$('#masterList ul.recordDataGrid').trigger('populate_grid',{'data':source});
				$('#masterList ul.recordDataGrid').bind('hide', function(){
					$('.recordDatagrid li.mainInput').hide();
				});
				$('#masterList ul.recordDataGrid').trigger('hide');
				$('.monetary').blur();
			  });
			  
			 
		};
	fillMenu(); //aggregate menu
	
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
    
	//Link to Main Menu
	
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
    $('#masterList ul.recordDatagrid li.clickInput').live('clicked',function(evt,args){
			var data = [];
			var obj = args.obj;
			data.push(obj);
			var menu_id = obj['div.menu_item_id input'];
			var exist = $('#menu div.menu_item_id input[value="'+parseInt(menu_id)+'"]')
			if(!$('#masterList ul.recordDataGrid').hasClass('context-menu-active')){
				if(exist.length==0){
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
	//Edit
    $('.edit-product').livequery('click',function(){
		var row = $(this).parents('li:first');
		console.log(row);
		row.find('.editable').removeAttr('readonly','readonly');
		row.find('.VIEWprice input').focus().select();
		row.find('.action').html('<a class="save-product"><img src="'+BASE_URL+'img/icons/disk.png"></img></a>');
	});
	//save
	$('.save-product').livequery('click',function(){
		var row = $(this).parents('li:first');
		row.find('.editable').attr('readonly','readonly');
		row.find('.action').html('<a class="edit-product"><img src="'+BASE_URL+'img/icons/pencil.png"></img></a>');
		var id = row.find('.daily_menu_id input').val();
		var price = row.find('.VIEWprice input').val();
		var appSrv = row.find('.appSrv input').val();
		var srvLeft = row.find('.srvLeft input').val();
			$.ajax({
				type:'POST',
				url: BASE_URL+'daily_menus/update',
				data:{'data':{'DailyMenu':{'id':id,'selling_price':price,'approx_srv':appSrv,'served':srvLeft}}},
				success:function(data){
				console.log(data);
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
					$('#myDialog').html('Item successfully updated!');
				}
			});
	});
});