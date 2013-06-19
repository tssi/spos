$(document).ready(function(){
	var commit = 13;
	
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
	
	$('#MenuIngredientItemCode').livequery(function(){
		var input = $(this);
		input.bind('keydown', function(e,a){
			if(e.which==commit){
				var itemcode =$(this).val();
				if (itemcode!=''){
					$.ajax({
						type:'POST',
						url:'/canteen/menu_items/getByMenuItemCode/',
						data:{'data':{'MenuItem':{'item_code':itemcode}}},
						success:function(data){
							console.log($.parseJSON(data));
							try{
								var menu =$.parseJSON(data);
								$('#MenuIngredientMenu').val(menu.MenuItem.name);
								$('#MenuIngredientMenuItemId').val(menu.MenuItem.id);
								$('#MenuIngredientServings').focus();
							}
							catch(err){
								var button = {};
								button.BACK = function() {
									$(this).dialog('destroy');
									input.select();
								};
								$('#myDialog').trigger('pop-it', {
									'title': 'Notification',
									'msg': '<center><br/><strong>Menu not existing..</strong></center>',
									'button': button,
									'modal': true
								});
							}
						}
					});
				}
			}
			if(e.which==73 && e.altKey){
				var dgbox = '<div class="dgForm fwb">';
				dgbox+='<div class="fLeft w45 pt5">Item Code:</div>';
				dgbox+='<div class="itemcode fRight w55"><input value="(Auto)" readonly class="taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Description:</div>';
				dgbox+='<div class="desc fRight w55"><input class="taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Price:</div>';
				dgbox+='<div class="price fRight w55"><input class="taRight monetary"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Unit:</div>';
				dgbox+='<div class="unit fRight w55"><input value="SRV" class="taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Est. Cost:</div>';
				dgbox+='<div class="estCost fRight w55"><input class="taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				var button = {};
				button.OK = function() {
					$(this).dialog('destroy');
				};
				button.CANCEL = function() {
					$(this).dialog('destroy');
				};
				$('#myDialog').trigger('pop-it', {
					'title': 'Add Menu',
					'msg': dgbox,
					'button': button,
					'modal': true
				});
			}
		});
	
	
	});

	//on barcode trigger populate product data
	$('#itemCheck').bind('getResult', function(e,a){
		var Li = $(a.self).parents('li:first');
		try{
			var prod = a.data['0'];
			console.log(prod);
			Li.find('div.unitView input').val(prod.Unit.alias);
			Li.find('div.unit input').val(prod.Unit.id);
			Li.find('div.desc input').val(prod.Product.name);
			
				
		}catch(e){
			console.log(e);
		}
		
	});
	
	$('div.itemcode .input input.ajax, div.desc .input input.ajax').live('error',function(evt,args){
		console.log('div.itemcode .input input.ajax, div.desc .input input.ajax');
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
		console.log('from error');
    });
	
	$('#MenuIngredientAddForm').bind('form_error',function(evt,args){
		var button = {};
		button.BACK = function() {
			$(this).dialog('destroy');
		};
		$('#myDialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': 'Fill up required field or delete row',
			'button': button,
			'modal': true
		});	
	});
	
	$('#MenuIngredientAddForm').bind('formNeat_sucess',function(e,a){
		var msg = $.parseJSON(a.data);
        console.log(msg);
		var button = {};
		button.OK = function() {
			$(this).dialog('destroy');
		};
		$('#myDialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': msg.msg,
			'button': button,
			'modal': true
		});
		$('#ingredients li.dynamicInput div.itemcode .input input').removeClass('unique'); 
		$(document).trigger('restore_defaults');
	}); 

	$('#ingredients .recordDatagrid').trigger('update_grid');
	
});