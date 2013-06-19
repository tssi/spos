$(document).ready(function(){
	var RECORD_SPEED = 'slow';
	var dailyMenuURL = '/canteen/daily_menus';
	var ERROR_FLAG=-1;
	$('.uiNotify ').hide();
	$('div.unit select').val(4);
	
	 
	$('.hdrAdd').live('click', function(){
			$('#menuList .itemCode input:last').focus();
	});
	
	//-- Description auto-complete
    $('.menuAuto').livequery(function(){
		var input =  $(this);		
		input.autocomplete({
			source: [],
			select: function(event, ui) {
				$(event.target).val(ui.item.label);
				$(event.target).focus().blur();//.trigger('keypress',{'which':13});
				return false;
			}
		}).keypress(function(){
			//console.log(this);			
		   //var productDesc = $('div.desc div.input input').val();
		   var productDesc = $(this).val();
		   var myLink = '/canteen/menu_items/search';
		   var source = [];
		   $('.menuAuto').autocomplete('option','source',source);		   
		   $.ajax({
				type:'POST',
				url: myLink,
				data:{'data':{'MenuItem':{'key':productDesc}}},
				beforeSend:function(){
					//console.log('key: ',productDesc);
				},
				success:function(data){
					//try{
					//console.log($.parseJSON(data));
					var prod = $.parseJSON(data);
					$.each(prod, function(c,o){
						var itemsOf = {
							'label':o.MenuItem.name,
							'value':o.MenuItem.name
						};
						source.push(itemsOf);
					})
					//console.log('source: ',source);
					$('.menuAuto').autocomplete('option','source',source);
					//}
				}
			});
			return;
		});
	})
	
	
	//--pop dialog constructor
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
		$('.ui-widget-overlay').css('opacity','.2');
		$('#dialog').html(_msg);
	});
	
	function getMenu(){
		$.getJSON(
				'/canteen/menu_items/findMenu/',
				function(data){
					console.log(data);
				  var source = [];
					  //Prepare data structure
				  $.each(data, function(ctr,obj){
					var desc= obj.MenuItem.name;
					var price = ssUtil.roundNumber(obj.MenuItem.selling_price,2);
					var avg = ssUtil.roundNumber(obj.MenuItem.avg_price,2);
					var code = obj.MenuItem.item_code;
					var isConsumable = obj.MenuItem.is_consumable;
					var qty = obj.MenuItem.qty;
					var unit = obj.Unit.alias;
					
					var aggr={};           
						aggr['div.VIEWdesc input']=desc;
						aggr['div.VIEWquantity input']=qty;
						aggr['div.VIEWprice input']=price;
						aggr['div.VIEWavg input']=avg;
						aggr['div.VIEWitemCode input']=code;
						aggr['div.VIEWunit input']=unit;
					source.push(aggr);  
				});
					//Pass data to populate_grid event
					$('#menuList_view ul.recordDataGrid').trigger('populate_grid',{'data':source});
					 $('#menuList_view ul.recordDataGrid').bind('hide', function(){
						$('#menuList_view ul.recordDatagrid li.mainInput').hide();
						});
					$('#menuList_view ul.recordDatagrid').trigger('hide');
				  });
	};
	

	getMenu();
	
	//restore defaults
	$(document).bind('restore_defaults', function() {
		
		$('li.dynamicInput div.itemCode .input input').removeClass('unique'); 
		$('.formNeat .picker .submit input').removeClass('selected');
		$('.formNeat .picker .submit input:not(.selected)').removeAttr('disabled','');
		$('.recordDatagrid').find('li input[type="text"]').removeAttr('readonly').removeAttr('valid').val('').removeClass('b1sCheri').removeClass('bgCheri');
		$('.recordDatagrid li.dynamicInput').fadeOut(RECORD_SPEED,function(){
			$('.recordDatagrid li.dynamicInput').remove();
		});
		$('div.unit select').val(4);
	});
	
	
	$('div.itemCode .input input.ajax, div.desc .input input.ajax').live('error',function(evt,args){
            var SELF = $(this);
			SELF.removeAttr('disabled');
			SELF.val('').focus(); 
            var button = {};
			$('#menuList ul.recordDatagrid').trigger('update_grid');
    		button.BACK = function() {
			SELF.val('').focus();
				$('.error-message').remove();
    			$(this).dialog('destroy');
    		};
    		$('#dialog').trigger('pop-it', {
    			'title': 'Notification',
    			'msg': args.msg,
    			'button': button,
    			'modal': true
    		});
 
    });
	
	$('#MenuItemAddForm').bind('form_error',function(evt,args){
		$('#MenuItemAddForm .uiNotify').html('Fill up required field or delete row');//.addClass('bgCheri').addClass('b1sCheri').fadeIn('slow').fadeOut('slow');
		var msg = $('.uiNotify').html();
		
		var button = {};
		button.BACK = function() {
			$(this).dialog('destroy');
		};
		$('#dialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': msg,
			'button': button,
			'modal': true
		});
	});
	
	$('#menuList ul.recordDataGrid').bind('new_row',function(){
		$(this).find('li:last div.itemcode .input input').removeAttr('readonly');
		$(this).find('li:last div.unit select').val(4);
	}); 
	
	$('#MenuItemAddForm').bind('formNeat_sucess',function(e,a){
		var msg = $.parseJSON(a.data);
        console.log(msg);
		var button = {};
		button.OK = function() {
			getMenu();
			$(this).dialog('destroy');
		};
		$('#dialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': msg.msg,
			'button': button,
			'modal': true
		});
		$('li.dynamicInput div.itemCode .input input').removeClass('unique'); 
		$(document).trigger('restore_defaults');
	});
	
	$('#menuList ul.recordDatagrid').trigger('update_grid');
	
	//cancel to restore defaults
	$("#cancel_button").click(function(){
		$(document).trigger('restore_defaults');
	});
	
	//Go to Daily Menu
	$('.goto-button').click(function(){
		document.location.href=dailyMenuURL;

	});
	
	
	$('.itemcode input').livequery(function(){
		
		var THIS = this;
		$(THIS).bind('keydown',function(e){
			//Alt+I trapping
			if(e.which==73 && e.altKey){
				$(THIS).attr('valid','1');
				$(THIS).removeClass('b1sCheri');
				$(THIS).removeClass('bgCheri');
				$(THIS).val('(Auto)').attr('readonly','readonly').trigger('keypress',{'which':13});
			}
		});      
	});
	
	/* $('#menuList ul.recordDatagrid input,#menuList ul.recordDatagrid select').livequery(function(){
		
			var input =  $(this);
			input.bind('next_row',function(evt,args){
				var unitType = $('div.unit > div.input select:first').val();
				$('div.unit > div.input select').val(unitType);
			});
			$('#menuList ul.recordDatagrid input,#menuList ul.recordDatagrid select').trigger('check_valid');
			
			input.bind('blur', function(evt, args){
				var valueOf = $.trim(input.val());
				
				if (valueOf=='' || valueOf=='%'){
					var thisLast = $(this).parents('li:first');
					var recordLast = $('#menuList .recordDatagrid li:last');
					thisLast = thisLast[0];
					recordLast =recordLast[0];
					if(!thisLast==recordLast){
						input.focus();
					};
				}
				
				if(input.attr('valid')==ERROR_FLAG){
					input.focus();
				}
			});
			
			
			
		}); */
	
   $('#menuList ul.recordDatagrid input, #menuList ul.recordDatagrid select').live('blur',function(){
		var input = $(this);
		var valueOf = $.trim(input.val());
		input.trigger('check_valid');
	});
   
});

