var ESTIMATED_COST=0;
var SRP=0;
$(document).ready(function(e){
	$('.uiNotify').wrap('<span style="display:none"/>');// hide notify
 	//Restore Default
	$(document).bind('restore_defaults', function() {
		//ESTIMATED_COST=0;
		//SRP=0;
		$('#SetMealItem li.mainInput').hide();
		$('#SetMealItem .recordDatagrid li.dynamicInput').fadeOut('slow',function(){
			$('#SetMealItem .recordDatagrid li.dynamicInput').remove();
		});
		$('#qty').focus().blur();
		$('.inline-block input').val('');
		$('#MenuItemItemCode').removeAttr('readonly');
		$('#MenuItemName').removeClass('ignore');
		$('.required input,select').removeClass('b1sCheri bgCheri');
		$('.submit-button').removeAttr('disabled');
		$('#MenuItemAvgPrice').val('');
		$('#MenuItemSellingPrice').val('');
	}).trigger('restore_defaults');
	//Cancel 
	$("#cancel").click(function(){
		$(document).trigger('restore_defaults');
	});
	
	function sort(){
		$("#MasterListItems").empty().html($("#MasterListItems_ui .iscrollWrapper").clone());
        var obj = {};
        $.each($('#MasterListItems_ui ul.recordDataGrid li'),function(e,a){
            var id = 'li-'+e;
            var key=$(a).find('.desc input').val()+$(a).find('.item_code input').val();
            $(a).attr('id',id);
            obj[key]='#'+id;
        });
		$("#MasterListItems ul.recordDataGrid").empty();
		obj = ssUtil.sortObject(obj);
        $.each(obj, function(i,o){
			$("#MasterListItems ul.recordDataGrid").append($(o).clone());
		});
		$('#MasterListItems li.mainInput').hide();
	}
	
	//Master List
	$.ajax({
		url:'/canteen/set_meals/MerchandiseItems',
		dataType:'json',
		success:function(data){
			var source = [];
			$.each(data, function(ctr,obj){
				if(obj.Product){
					var desc= obj.Product.name;
					var price = obj.Product.selling_price;
					var avg_price = obj.Product.avg_price;
					var code = obj.Product.item_code;
					var unit = obj.Unit.name;
					var id = obj.Product.id;
					var menu_item = '';
					var product_item = obj.Product.id;
				}else{
					var desc= obj.Perishable.name;
					var price = obj.Perishable.selling_price;
					var avg_price = obj.Perishable.avg_price;
					var code = obj.Perishable.item_code;
					var unit = obj.Unit.name;
					var id = obj.Perishable.id;
					var menu_item ='';
					var product_item = obj.Perishable.id;
				}
				var aggr={};           
					aggr['div.desc input']=desc;
					aggr['div.price input']=ssUtil.roundNumber(price,2);
					aggr['div.avg_price input']=ssUtil.roundNumber(avg_price,2);
					aggr['div.item_code input']=code;
					aggr['div.unit input']=unit;
					aggr['div.id input']=id;
					aggr['div.product_item input']=product_item;
					aggr['div.menu_item input']='';
				source.push(aggr);  
				
			});
			$('#MasterListItems_ui ul.recordDataGrid').trigger('populate_grid',{'data':source,'new_class':['dynamicInput','clickInput','productItem']});
			sort();
			allowKey = true;
			//Menu Item except set meal
			$.getJSON(ssUtil.cch_brk('/canteen/set_meals/MenuItems'),function(data){
				source = [];
				if(data.length>0){
					$.each(data, function(ctr,obj){
						var desc= obj.MenuItem.name;
						var price = obj.MenuItem.selling_price;
						var avg_price = obj.MenuItem.avg_price;
						var code = obj.MenuItem.item_code;
						var unit = obj.Unit.name;
						var id = obj.MenuItem.id;
						var menu_item = obj.MenuItem.id;
						var product_item = '';
						var aggr={};
						aggr['div.desc input']=desc;
						aggr['div.price input']=ssUtil.roundNumber(price,2);
						aggr['div.avg_price input']=ssUtil.roundNumber(avg_price,2);
						aggr['div.item_code input']=code;
						aggr['div.unit input']=unit;
						aggr['div.id input']=id;
						aggr['div.menu_item input']=id;
						aggr['div.product_item input']='';
						source.push(aggr);
					});
					$('#MasterListItems_ui ul.recordDataGrid').trigger('populate_grid',{'data':source});
					sort();
					allowKey = true;
				}
			});
		}
	});  
	
	//Auto Code
	$('.itemcode').livequery(function(){
		var THIS = this;
		$(THIS).bind('keydown',function(e){
			//Alt+I trapping
			if(e.which==73 && e.altKey){
				$(THIS).val('(Auto)').attr('readonly','readonly').trigger('keypress',{'which':13});
			}
		});      
	});

	//MaterList Description
	$('#description').keyup(function(e,a){
		var keyHit = e.which;
		var matched = $("#MasterListItems [style*='display: block']");
		var desc = !$.trim($('#description').val()) =='';  
		if (keyHit==13){
            if (matched.length){
                if(desc){
                    matched.click();
                    $('#description').val('');
                }
            }else{
				$('#description').val('').focus();
				if(desc){
					var msg = 'No match found!';
					var button = {};
					button.Back = function() {
						$(this).dialog('destroy');
						$('#description').focus();
					}
					$('#dialog').trigger('pop-it',{'title': 'Notification','msg': msg,'button': button,'modal': true});			
				}
			}      
       }
    });
	//Qty
	$('#qty').keypress(function(e,o){
		if(e.which==13){$('#description').select()}
	});
	$('#qty').blur(function(){
		if($(this).val()==''){$(this).val('1')}
	});
	
	//Respond when clickInput is clicked
	$('#MasterListItems ul.recordDatagrid li.clickInput').live('clicked',function(evt,args){  
		var data = [];
		var obj = args.obj;
		var qty = $('#qty').val();
		var amount = ssUtil.roundNumber(obj['div.price input']*qty,2);    
			obj['div.qty input']=qty;
			obj['div.amount input'] = amount;
			data.push(obj);
		$('#SetMealItem ul.recordDataGrid').trigger('populate_grid',{'data':data});
		$('#qty').focus().blur();
		$('#description').blur().focus().select();
		var avg_price = qty*obj['div.avg_price input'];
		var price = qty*obj['div.price input'];
		//ESTIMATED_COST = ESTIMATED_COST + avg_price;
		//SRP = SRP + price;
		//$('#MenuItemAvgPrice').val(ESTIMATED_COST.toFixed(2));
		//$('#MenuItemSellingPrice').val(SRP.toFixed(2));

	});
	
	$('#MenuItemName').blur(function(){
		var desc = $(this).val();
		$.ajax({
			url:'/canteen/set_meals/validate_duplicate',
			dataType:'json',
			type:'post',
			data:{'data':{'name':desc}},
			success:function(data){
				$('#MenuItemName').addClass('ignore');
				if(data instanceof Object){
					var msg = 'Set meal name has already used!</br>Would you like to continue?';
					var button = {};
					button.Continue = function() {
						$(this).dialog('destroy');
						$('#SetMealItem .recordDatagrid li.dynamicInput').remove();
						$('#MenuItemId').val(data.MenuItem.id);
						$('#MenuItemSellingPrice').val(data.MenuItem.selling_price);
						$('#MenuItemItemCode').val(data.MenuItem.item_code).attr('readonly','readonly');
						populate_set_meal_component(data);
					};
					button.Back = function() {
						$(this).dialog('destroy');
						var name = $('#MenuItemName').val();
						$(document).trigger('restore_defaults');
						$('#MenuItemName').val(name).select();
					};
					$('#dialog').trigger('pop-it',{'title': 'Notification','msg': msg,'button': button,'modal': true});
				}
			}
		});
	});
	
	function populate_set_meal_component(data){
		var source = [];
			if(!data.SetMeal.length){
				var msg = 'No item found with this set meal.</br>Would you like to add item?';
				var button = {};
				button.Yes = function() {
					$(this).dialog('destroy');
				}
				button.No = function() {
					$(this).dialog('destroy');
					$(document).trigger('restore_defaults');
				}
				$('#dialog').trigger('pop-it',{'title': 'Notification','msg': msg,'button': button,'modal': true});
			}else{
				$.each(data.SetMeal, function(i,o){
					var source = [];
					if(!(o.SetComponentMenuItem instanceof Array)){
						//ESTIMATED_COST = parseFloat(ESTIMATED_COST) + parseFloat(o.SetComponentMenuItem.avg_price);//compute estimated cost
						//SRP = parseFloat(SRP) + parseFloat(o.SetComponentMenuItem.selling_price);//compute srp
						var desc= o.SetComponentMenuItem.name;
						var qty= o.qty;
						var price =o.SetComponentMenuItem.selling_price;
						var avg_price = o.SetComponentMenuItem.avg_price;
						var code = o.SetComponentMenuItem.item_code;
						var product_item = '';
						var menu_item= o.menu_item;
						var aggr={};
						aggr['div.desc input']=desc;
						aggr['div.qty input']=qty;
						aggr['div.amount input']=ssUtil.roundNumber(price*qty,2);
						aggr['div.avg_price input']=ssUtil.roundNumber(avg_price,2);
						aggr['div.price input']=price;
						aggr['div.item_code input']=code;
						aggr['div.menu_item input']=menu_item;
						aggr['div.product_item input']=product_item;
						source.push(aggr);
					}
					if(!(o.SetComponentProduct instanceof Array)){
						//ESTIMATED_COST = parseFloat(ESTIMATED_COST) + parseFloat(o.SetComponentProduct.avg_price);//compute estimated cost
						//SRP = parseFloat(SRP) + parseFloat(o.SetComponentMenuItem.selling_price);//compute srp
						var desc= o.SetComponentProduct.name;
						var qty= o.qty;
						var price = o.SetComponentProduct.selling_price;
						var avg_price = o.SetComponentProduct.avg_price;
						var code = o.SetComponentProduct.item_code;
						var product_item = o.product_item;
						var menu_item = '';
						var aggr={};
						aggr['div.desc input']=desc;
						aggr['div.qty input']=qty;
						aggr['div.amount input']=ssUtil.roundNumber(price*qty,2);
						aggr['div.price input']=price;
						aggr['div.avg_price input']=ssUtil.roundNumber(avg_price,2);
						aggr['div.item_code input']=code;
						aggr['div.menu_item input']= menu_item;
						aggr['div.product_item input']=product_item;
						source.push(aggr);
						
					}
					$('#SetMealItem ul.recordDataGrid').trigger('populate_grid',{'data':source}).trigger('update_grid');
				});
				//$('#MenuItemAvgPrice').val(ESTIMATED_COST.toFixed(2));
				//$('#MenuItemSellingPrice').val(SRP.toFixed(2));
			}
	}
	
	//-- Description auto-complete
    $('#MenuItemName').livequery(function(){
		var input =  $(this);		
		input.autocomplete({
			source: [],
			select: function(event, ui) {
				$(event.target).val(ui.item.label);
				$(event.target).focus().blur();//.trigger('keypress',{'which':13});
				return false;
			}
		}).keypress(function(){
		   var productDesc = $(this).val();
		   var myLink = '/canteen/set_meals/autocomplete';
		   var source = [];
		   $('#MenuItemName').autocomplete('option','source',source);		   
		   $.ajax({
				type:'POST',
				url: myLink,
				data:{'data':{'MenuItem':{'key':productDesc}}},
				success:function(data){
					var prod = $.parseJSON(data);
					$.each(prod, function(c,o){
						var itemsOf = {
							'label':o.MenuItem.name,
							'value':o.MenuItem.name
						};
						source.push(itemsOf);
					})
					$('#MenuItemName').autocomplete('option','source',source);
				}
			});
			return;
		});
	});
	
	$('#MenuItemAddForm').bind('formNeat_sucess',function(e,a){
		var msg = $.parseJSON(a.data);
        console.log(msg);
		var button = {};
		button.OK = function() {
			$(this).dialog('destroy');
		};
		$('#dialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': msg.msg,
			'button': button,
			'modal': true
		});
		$(document).trigger('restore_defaults');
	});
	//--pop dialog constructor
    $('#dialog').bind('pop-it', function(evt, args) {
		console.log(args);
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
	
	//Re-Compute SRP & Est. Cost
	$('.recordDatagrid a.recordDelete').live('click',function(){
		var row = $(this).parents('li:first');
		var avg_price = row.find('.avg_price input').val();
		var price = row.find('.price input').val();
		//ESTIMATED_COST = ESTIMATED_COST - avg_price;
		//SRP = SRP - price;

		var PARENT  =  $(row[0]).parent();
		var COUNT =  $(PARENT).find('li:visible').length;
		//Resets the page to default when last item is deleted
		if(COUNT == 1){
			$(document).trigger('restore_defaults');
		}
		else{
			$('#MenuItemAvgPrice').val(ESTIMATED_COST.toFixed(2));
			$('#MenuItemSellingPrice').val(SRP.toFixed(2));
		}
		
	});
});  
	