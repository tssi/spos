$(document).ready(function(){
	$('.uiNotify ').hide();
	var commit=13;
	var mode=2; //structured
	
	//--pop dialog constructor
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
	});
	
	function populateProducts(daily_beginning,total_sale_qty){
		$.ajax({
			url:'/canteen/products/findItem/ALL'+'/Product.name',
			dataType:'json',
			beforeSend:function(data){
				var msg = "<br/><center><img src='/canteen/img/icons/loader.gif'><br/><br/><strong>Loading Products..</strong></center>";
				var button = {};
				$('#myDialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': msg,
					'button': button,
					'modal': true
				});
				$('#ending_Inventory ul.recordDataGrid').trigger('clear_grid');
			},
			success:function(data){
			$('#myDialog').dialog('destroy');	
		
			//PREPARE DATA STRUCTURE
			var source = [];
			$.each(data, function(ctr,obj){
				
				if(obj.Product){
					var idIs = obj.Product.id;
					var desc = obj.Product.name;
					var unit = obj.Unit.alias;
					var code = obj.Product.item_code;
					var ending_qty = obj.Product.qty;
					var beginning_qty=(typeof daily_beginning[code]  != "undefined")?daily_beginning[code]:'0.00';
					var sale_qty=(typeof total_sale_qty[code]  != "undefined")?total_sale_qty[code]:'0.00';
				}else{
					var idIs= obj.Perishable.id;
					var desc= obj.Perishable.name;
					var unit = obj.Unit.alias;
					var code = obj.Perishable.item_code;
					var ending_qty = obj.Perishable.qty;
				}
				var aggr={};           
					aggr['div.id input']=idIs;
					aggr['div.item_code input']=code;
					aggr['div.desc input']=desc;
					aggr['div.unit input']=unit;
					aggr['div.ending_qty input']=ending_qty;
					aggr['div.beginning_qty input']=beginning_qty;
					aggr['div.sale_qty input']=sale_qty;
				source.push(aggr);  
			});
			//console.log(source);
			$('#ending_Inventory ul.recordDataGrid').trigger('populate_grid',{'data':source});
			$('#ending_Inventory ul.recordDatagrid li.mainInput').hide();
			$('#ending_Inventory ul.recordDataGrid').trigger('update_grid');
		}
		});
	}
	
	
	function get_daily_beginning(total_sale_qty){
		$.ajax({
			url:'/canteen/daily_beginning_inventories/get_daily_beginning',
			dataType:'json',
			success:function(daily_beginning){
				populateProducts(daily_beginning,total_sale_qty);
			}
		});
	}	
	
	
	function get_total_sale_qty(){
		$.ajax({
			url:'/canteen/daily_beginning_inventories/get_total_sale_qty',
			dataType:'json',
			success:function(total_sale_qty){
				get_daily_beginning(total_sale_qty);
			}
		});
	}	
	get_total_sale_qty();
	
	
	
	$('.input_mode').live('change', function(e,a){
		mode = $(this).find('input:checked').val();
		if(mode==2){ //if structured
			$('#ending_Inventory ul.recordDatagrid li.mainInput .qty input').val('X');
			$('#ending_Inventory ul.recordDatagrid li.mainInput').hide();
			$('#ending_Inventory ul.recordDatagrid li.mainInput input').val('');
			$('#ending_Inventory ul.recordDatagrid li.mainInput input').attr('readonly','readonly');
			get_total_sale_qty();
			
		}else{
			$('#ending_Inventory ul.recordDataGrid').trigger('clear_grid');
			$('#ending_Inventory ul.recordDatagrid li.mainInput').show();
			$('#ending_Inventory ul.recordDatagrid li.mainInput .item_code input, .qty input').removeAttr('readonly');
			$('#ending_Inventory ul.recordDatagrid li.mainInput .qty input').val('');
			$('#ending_Inventory ul.recordDatagrid li.mainInput .item_code input:first').focus();
		}
	});
	
	$('#ending_Inventory ul.recordDatagrid .qty').live('keydown', function(e,a){
		if(e.which==commit && mode==2){
			var emptyOne = $('#ending_Inventory ul.recordDatagrid .dynamicInput .qty').find('input[value=""]');
			if(emptyOne.length!=0){
				$(emptyOne[0]).focus();
			}else{
				var msg = "Proceed to Save";
				var button = {};
				button.OK = function() {
					$(document).trigger('restore_defaults');
					$(this).dialog('destroy');
				};
				$('#myDialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': msg,
					'button': button,
					'modal': true
				});
			}
			return false;
		};
	
	});
	
	$('#EndingAddForm').bind('formNeat_sucess',function(e,a){
		$('#myDialog').dialog('destroy');
		var msg = $.parseJSON(a.data);
		var button = {};
		button.OK = function() {
			$(document).trigger('restore_defaults');
			$(this).dialog('destroy');
		};
		$('#myDialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': msg.msg,
			'button': button,
			'modal': true
		});
		//$('.ui-dialog-buttonset button:first').show();	
		//$(document).trigger('restore_defaults');
	});


	$('#EndingAddForm').bind('form_error',function(evt,args){
		$('#EndingAddForm .uiNotify').html('Fill up required field or delete row');//.addClass('bgCheri').addClass('b1sCheri').fadeIn('slow').fadeOut('slow');
		var msg = $('.uiNotify').html();
		var button = {};
		button.BACK = function() {
			$(this).dialog('destroy');
		};
		$('#myDialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': msg,
			'button': button,
			'modal': true
		});	
	});
	
	$('.print_button').click(function(){
		$('#EndingAddForm').attr('action','/canteen/endings/report');
		$('#EndingAddForm').attr('target','_blank');
		$('#EndingAddForm').submit();
		$('#EndingAddForm').attr('action','/canteen/endings/add');
		$('#EndingAddForm').removeAttr('target');
	
	});

	$('#EndingAddForm').bind('formNeat_beforeSend', function(){
		var msg = "<br/><center><img src='/canteen/img/icons/loader.gif'><br/><br/><strong>Saving Ending Inventory..</strong></center>";
		var button = {};
		$('#myDialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': msg,
			'button': button,
			'modal': true
		});
	});
	
	$('#printOpt').blur(function(){
		if($(this).val()!='%'){
			
		}
	});

	$(document).bind('restore_defaults', function() {
		$('#ending_Inventory .qty input').val('');
		if (mode==1){
			$('#ending_Inventory ul.recordDatagrid li.mainInput input').val('');
			$('#ending_Inventory ul.recordDataGrid').trigger('clear_grid');
		}
	})	

	$('#itemCheck').bind('getResult', function(e,a){
		var Li = $(a.self).parents('li:first');
		var code = Li.find('div.item_code input');
		var units = Li.find('div.unit select:first').parent().html();
		try{
			var prod = a.data['0'];
			console.log(prod);
			Li.find('div.id input:first').val(prod.Product.id);
			Li.find('div.desc input:first').val(prod.Product.name);
			Li.find('div.unit input:first').val(prod.Unit.alias);
			Li.find('div.qtyC input:first').val(prod.Product.qty);
			Li.find('div.qty input:first').focus();
		}catch(e){
			var msg ='<center><strong>Product not found!<br /><br /></strong></center>';
			var button = {};
			button.BACK = function(){
				$(this).dialog('destroy');
				$(code).select().focus();
				
			}	
			$('#myDialog').trigger('pop-it', {
				'title': 'Notification',
				'msg': msg,
				'button': button,
				'modal': true
			});
		}
	});

	$('#ending_Inventory ul.recordDatagrid input').live('blur',function(){
		$(this).trigger('check_valid');
	});
	
	$('div.item_code .input input.ajax, div.desc .input input.ajax').live('error',function(evt,args){
		var SELF = $(this);
		var button = {};
			
		button.BACK = function() {
			SELF.removeAttr('disabled');
			SELF.parents('li:first').find('input').val('');
			SELF.val('').select(); 			 
			$(this).dialog('destroy');
		};
		$('#myDialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': args.msg,
			'button': button,
			'modal': true
		});
    });
});