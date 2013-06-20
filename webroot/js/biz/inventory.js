var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
var MyLink = window.location.pathname+'/';


$(document).ready(function(){
	var ACTIVE_CLASS =  'ruby';
	var RECORD_SPEED = 'slow';
	var ERROR_FLAG=-1;
	var AUTO_FLAG='(Auto)';
	var CURRENT_TYPE;
	$('.mainInput').hide();
	$('.uiNotify ').hide();
	
	//Notify user when form has errors
	$('#inventoryList div.itemCode.input input').focus();
	$('li.mainInput div.unit select').prepend(new Option('Select One', '%'));
	
	//SORTER
	function sortIt(type,by){
		$.getJSON(
			'/canteen/products/findItem/'+type+'/'+by,
			function(data){
			  $('#productView .recordDatagrid').trigger('clear_grid');
			  var source = [];
				  //Prepare data structure
			  $.each(data, function(ctr,obj){
				if(obj.Product){
					var id= obj.Product.id;
					var desc= obj.Product.name;
					var price = ssUtil.roundNumber(obj.Product.selling_price,2);
					var avg = ssUtil.roundNumber(obj.Product.avg_price,2);
					var code = obj.Product.item_code;
					var isConsumable;
					//var isConsumable = obj.Product.is_consumable;
					if(obj.Product.is_consumable==1){
						isConsumable='YES';
					}else{
						isConsumable='NO';
					}
					var qty = obj.Product.qty;
					var unit = obj.Unit.alias;
				}else{
					var id= obj.Perishable.id;
					var desc= obj.Perishable.name;
					var price = ssUtil.roundNumber(obj.Perishable.selling_price,2);
					var avg = ssUtil.roundNumber(obj.Perishable.avg_price,2);
					var code = obj.Perishable.item_code;
					var isConsumable;
					//var isConsumable = obj.Product.is_consumable;
					if(obj.Perishable.is_consumable==1){
						isConsumable='YES';
					}else{
						isConsumable='NO';
					}
					var qty = obj.Perishable.qty;
					var unit = obj.Perishable.alias;
				}
				var aggr={};           
					aggr['div.VIEWdesc input']=desc;
					aggr['div.VIEWquantity input']=qty;
					aggr['div.VIEWID input']=id;
					//aggr['div.VIEWconsume select']=isConsumable;
					aggr['div.VIEWconsume input']=isConsumable;
					aggr['div.VIEWprice input']=price;
					aggr['div.VIEWitemCode input']=code;
					aggr['div.VIEWunit input']=unit;
					aggr['div.VIEWavg input']=avg;
					//console.log(aggr);
				source.push(aggr);  
			});
			  
				//Pass data to populate_grid event
				$('#inventoryList_view ul.recordDataGrid').trigger('populate_grid',{'data':source});
				$('#inventoryList_view ul.recordDataGrid').bind('hide', function(){
					$('#inventoryList_view ul.recordDatagrid li.mainInput').hide();
					});
				$('#inventoryList_view ul.recordDataGrid').trigger('hide');
			  });
	
	};
	
	//search button
	$('.search_button').click(function(){
		var by = $('#searchBy').val();
		var type = $('#searchType').val();
		var key = $('#searchKey').val();
		$('#ProductField').val(by);
		$('#ProductType').val(type);
		$('#ProductKey').val(key);
		$('#search').ajaxSubmit({
			success:function(data){
				var json = $.parseJSON(data);
				$('#productView .recordDatagrid').trigger('clear_grid');
				  var source = [];
				  //Prepare data structure
				if(json.length>0){
					  $.each(json, function(ctr,obj){
						if(obj.Product){
							var desc= obj.Product.name;
							var price = ssUtil.roundNumber(obj.Product.selling_price,2);
							var avg = ssUtil.roundNumber(obj.Product.avg_price,2);
							var code = obj.Product.item_code;
							var isConsumable;
							//var isConsumable = obj.Product.is_consumable;
							if(obj.Product.is_consumable==1){
								isConsumable='YES';
							}else{
								isConsumable='NO';
							}
							var qty = obj.Product.qty;
							var unit = obj.Unit.alias;
						}else{
							var desc= obj.Perishable.name;
							var price = ssUtil.roundNumber(obj.Perishable.selling_price,2);
							var avg = ssUtil.roundNumber(obj.Perishable.avg_price,2);
							var code = obj.Perishable.item_code;
							var isConsumable;
							//var isConsumable = obj.Product.is_consumable;
							if(obj.Perishable.is_consumable==1){
								isConsumable='YES';
							}else{
								isConsumable='NO';
							}
							var qty = obj.Perishable.qty;
							var unit = obj.Unit.alias;
						}
						var aggr={};           
							aggr['div.VIEWdesc input']=desc;
							aggr['div.VIEWquantity input']=qty;
							//aggr['div.VIEWconsume select']=isConsumable;
							aggr['div.VIEWconsume input']=isConsumable;
							aggr['div.VIEWprice input']=price;
							aggr['div.VIEWitemCode input']=code;
							aggr['div.VIEWunit input']=unit;
							aggr['div.VIEWavg input']=avg;
							//console.log(aggr);
							source.push(aggr);  
					});
					  
						//Pass data to populate_grid event
						$('#inventoryList_view ul.recordDataGrid').trigger('populate_grid',{'data':source});
						$('#inventoryList_view ul.recordDataGrid').bind('hide', function(){
							$('#inventoryList_view ul.recordDatagrid li.mainInput').hide();
						});
						$('#inventoryList_view ul.recordDataGrid').trigger('hide');
				}else{
						var button = {};			
						button.OK = function() {			 
							$(this).dialog('destroy');
						};
						$('#myDialog').trigger('pop-it', {
							'title': 'Notification',
							'msg': '<center><strong>No results found!</strong></center>',
							'button': button,
							'modal': true
						});
				
				}
			}
		});
		
	});
	
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
	
	//-- Description auto-complete
    $('.productAuto').livequery(function(){
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
		   var myLink = window.location.protocol + "//" + window.location.host + "/" + 'canteen/products/search';
		   var source = [];
		   $('.productAuto').autocomplete('option','source',source);		   
		   $.ajax({
				type:'POST',
				url: myLink,
				data:{'data':{'Product':{'key':productDesc}}},
				beforeSend:function(){
					//console.log('key: ',productDesc);
				},
				success:function(data){
					//try{
					//console.log($.parseJSON(data));
					var prod = $.parseJSON(data);
					$.each(prod, function(c,o){
						var itemsOf = {
							'label':o.Product.name,
							'value':o.Product.name
						};
						source.push(itemsOf);
					})
					//console.log('source: ',source);
					$('.productAuto').autocomplete('option','source',source);
					//}
				}
			});
			return;
		});
	})
	    
    $('div.itemCode .input input.ajax, div.desc .input input.ajax').live('error',function(evt,args){
		var SELF = $(this);
		var button = {};			
		button.BACK = function() {
			SELF.removeAttr('disabled');
			SELF.val('').focus(); 			 
				$(this).dialog('destroy');
		};
		$('#myDialog').trigger('pop-it', {
			'title': 'Notification',
			'msg': args.msg,
			'button': button,
			'modal': true
		});
    });

	$('#ProductAddForm').bind('form_error',function(evt,args){
		//$('#ProductAddForm .uiNotify').html('Fill up required field or delete row').addClass('bgCheri').addClass('b1sCheri').fadeIn('slow').fadeOut('slow');
		$('#ProductAddForm .uiNotify').html('Fill up required field or delete row');//.addClass('bgCheri').addClass('b1sCheri').fadeIn('slow').fadeOut('slow');
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
    
	$('#inventoryList ul.recordDataGrid').bind('new_row',function(){
		$(this).find('li:last div.itemcode .input input').removeAttr('readonly');
		$('#inventoryList ul.recordDataGrid input , #inventoryList ul.recordDataGrid select').blur();
		$('.error-message').remove();
		/* $('#inventoryList .recordDatagrid li:last').find('input[valid="-1"]').attr('valid',1)
		
		; */
		
	}); 
	
	$('.formNeat .picker .submit input').livequery('click',function(){
		$('.formNeat .picker .submit input').parent().parent().removeClass(ACTIVE_CLASS);
		$(this).addClass('selected').parent().parent().addClass(ACTIVE_CLASS);
		$('.formNeat .picker .submit input:not(.selected)').attr('disabled','disabled');
		
		var product_type_id = $(this).attr('data-picker-id');
		$('#inventoryList .productType input').val(product_type_id);
		$('#inventoryList .mainInput').fadeIn(RECORD_SPEED);
	});
	
    //Populate Inventory View
    $('.picker .widebutton').click(function(){
		$('#productView .recordDatagrid').trigger('clear_grid'); // clear product list
		var productType = $(this).attr('data-picker-id');
		CURRENT_TYPE = productType;
		
		
		//--focus
		setTimeout(function () {
			$('#inventoryList li.mainInput div.itemCode .input input').focus();
			$('#inventoryList li.mainInput div.unit select').val('%');
        }, 0);
		//----- Default consumable choice perishable,shelf, supp
		switch(productType){
			case 'PI':
				$('#inventoryList li.mainInput div.consume select').val('1');
				break;
			case 'SI':
				$('#inventoryList li.mainInput div.consume select').val(1);
				break;
			case 'SP':
				$('#inventoryList li.mainInput div.consume select').val('1');
				break;
			default:
				$('#inventoryList li.mainInput div.consume select').val('%');
				break;
		}	
		//---
        var isPerishable = parseInt($(this).attr('data-is-perish'));
        var isConsumable = parseInt($(this).attr('data-is-consume'));
        if( isPerishable){
            $('#ProductAddForm').attr('action', '/canteen/perishables/add');
    		 $('#inventoryList .recordDatagrid').find('li').each(function(ctr,li){
    			$(li).find('input,select').each(function(i,obj){
    				var vname =$(obj).attr('vname')?$(obj).attr('vname'):$(obj).attr('name'); //Get input name
    				var name = vname.replace('Product','Perishable'); //Set new name
    				$(obj).attr('name',name); //Correct input index
    				$(obj).attr('vname',name); //Correct input index
    			});
    		});
        }else{
            $('#ProductAddForm').attr('action', '/canteen/products/add ');
            $('#inventoryList .recordDatagrid').find('li').each(function(ctr,li){
    			$(li).find('input,select').each(function(i,obj){
    				var vname =$(obj).attr('vname')?$(obj).attr('vname'):$(obj).attr('name'); //Get input name
    				var name = vname.replace('Perishable','Product'); //Set new name
    				$(obj).attr('name',name); //Correct input index
    				$(obj).attr('vname',name); //Correct input index
    			});
    		});
        }	

		//Auto check consumable field
		if(isConsumable){
			$('#inventoryList .recordDatagrid').find('li input[type="checkbox"]').attr('checked','checked');
		}else{
			$('#inventoryList .recordDatagrid').find('li input[type="checkbox"]').removeAttr('checked');
		}
		$('#inventoryList .recordDatagrid').trigger('update_grid');
		
		$('#ordering, #searchBy, #searchType, #searchKey').removeAttr('disabled'); //enable search and sorting functionality
		$('.order_button, .search_button').removeAttr('disabled');
		$('.recordDataGrid input, select').removeAttr('disabled');
		var of = $('#ordering :selected').val();
		
		//Populate according to chosen product
		sortIt(CURRENT_TYPE, of);
		$('#search > #ProductKind').val(CURRENT_TYPE);
		
		$('input, select').removeClass('b1sCheri, bgCheri');
    }); 
	
	$('#inventoryList .recordDatagrid input,.recordDatagrid select').livequery(function(){
		var input =  $(this);
		input.bind('next_row',function(evt,args){
			var consume = $('div.consume > div.input select:first').val();
			$('div.consume > div.input select').val(consume);	
		});
	});
		
    //Restore Default
    $(document).bind('restore_defaults', function() {
		$('.formNeat .picker .submit input').parent().parent().removeClass(ACTIVE_CLASS);
		$('.formNeat .picker .submit input').removeClass('selected');
		$('.formNeat .picker .submit input:not(.selected)').removeAttr('disabled','');
		$('#inventoryList .recordDatagrid').find('li input[type="text"]').removeAttr('readonly').removeAttr('valid').val('').removeClass('b1sCheri').removeClass('bgCheri');
		$('#inventoryList .recordDatagrid li.mainInput').fadeOut(RECORD_SPEED);
		$('#inventoryList .recordDatagrid li.dynamicInput').fadeOut(RECORD_SPEED,function(){
			$('#inventoryList .recordDatagrid li.dynamicInput').remove();
		});
		
        $('#inventoryList .recordDatagrid').trigger('update_grid');
		$('#inventoryList_view ul.recordDatagrid').find('li.dynamicInput').remove();
		$('#ordering, #searchBy, #searchType, #searchKey').attr('disabled','disabled');
		$('.order_button, .search_button').attr('disabled','disabled');
		$('.recordDataGrid input, select').attr('disabled', 'disabled')
		
	});
	
	//Cancel Button
	$("#cancel_button, .cancel_button").click(function(){
		$(document).trigger('restore_defaults');
		
	});
	
	$(".close_button").click(function(){
		$(document).trigger('restore_defaults');
		$(this).parents('.tab-content:first').find('.tab-content').slideUp();
	});

	$('#ProductAddForm').bind('formNeat_sucess',function(e,a){
		var msg = $.parseJSON(a.data);
       // console.log(msg);
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
		$('#inventoryList li.dynamicInput div.itemCode .input input').removeClass('unique'); 
		$(document).trigger('restore_defaults');
	}); 
    
	//MarkIt
	$('#inventoryList .markIt').live('focus', function(e,a){
		var SELF = $(this);
		var row = $(this).parents('li:first');
		if(SELF.val()==''){
			MarkIt(SELF,row);
		}
	});
	$('#productView .markIt').live('focus', function(e,a){
		var SELF = $(this);
		var row = $(this).parents('li:first');
		MarkIt(SELF,row);
	});
	
	
	function MarkIt(SELF,row){
		var id = row.find('.ID input').val();
		var title;
		var dg;
		if(id != ""){
			$.ajax({
				type:'POST',
				dataType: 'json',
				url: BASE_URL+'products/getByProductId',
				data:{'data':{'Product':{'id':id}}},
				success:function(json){
						title = 'Estimated Purchase Price'; 
						dg = '<div class="dgForm fwb">';			
						dg+='<div class="fLeft w45 pt5">Estimated Purchase Price:</div>';
						dg+='<div class="avgPrice fRight w55"><input value="'+json.Product.avg_price+'" class="monetary numeric taRight nextnode"/></div>';
						dg+='<div class="fClear"></div>';
						dg+='<div class="fLeft w45 pt5">Markup Unit:</div>';
						dg+='<div class="emUnit fRight w55"><select class="nextnode">';
						if(json.Product.markup_unit){
							dg+='<option value="%">%</option>';
							dg+='<option value="1">Php.</option>';
						}else{
							dg+='<option value="1">Php.</option>';
							dg+='<option value="%">%</option>';
						}
						dg+='</select></div>';
						dg+='<div class="fClear"></div>';
						dg+='<div class="fLeft w45 pt5">Estimated Markup:</div>';
						dg+='<div class="em fRight w55"><input value="'+json.Product.markup+'" class=" numeric taRight nextnode"/></div>';
						dg+='<div class="fClear"></div>';
						dg+='</div>';
						buildmodal(title,dg,SELF,row);
				}
			});
		}else{
				title = 'Estimated Purchase Price'; 
				dg = '<div class="dgForm fwb">';			
				dg+='<div class="fLeft w45 pt5">Estimated Purchase Price:</div>';
				dg+='<div class="avgPrice fRight w55"><input class="monetary numeric taRight nextnode"/></div>';
				dg+='<div class="fClear"></div>';
				dg+='<div class="fLeft w45 pt5">Markup Unit:</div>';
				dg+='<div class="emUnit fRight w55"><select class="nextnode">';
				dg+='<option value="1">Php.</option>';
				dg+='<option value="%">%</option>';
				dg+='</select></div>';
				dg+='<div class="fClear"></div>';
				dg+='<div class="fLeft w45 pt5">Estimated Markup:</div>';
				dg+='<div class="em fRight w55"><input class=" numeric taRight nextnode"/></div>';
				dg+='<div class="fClear"></div>';
				dg+='</div>';
				buildmodal(title,dg,SELF,row);

		}	
		
	}
	
	function buildmodal(title,dg,SELF,row){
		console.log(title);					
		var button = {};
		button.OK = function(){
			var avgPrice = parseFloat($('div.dgForm .avgPrice input').val());
			var em = parseFloat($('div.dgForm .em input').val());
			var emUnit = $('div.dgForm .emUnit select').val();
			if (avgPrice !='' && em !='' && emUnit!=''){
				SELF.parents('li:first').find('div.em input').val(em);
				SELF.parents('li:first').find('div.emUnit input').val(emUnit);
				SELF.parents('li:first').find('div.avgPrice input').val(avgPrice);
				SELF.parents('li:first').find('div.avgPrice input').blur();
				SELF.parents('li:first').find('div.avgPrice input').trigger('keypress',{'which':13});
				if(emUnit == '%'){
					SELF.parents('li:first').find('div.price input').val((avgPrice+(avgPrice*(em/100))).toFixed(2));
				}
				if(emUnit == 1 ){
					SELF.parents('li:first').find('div.price input').val((avgPrice+em).toFixed(2));
				}
				$(this).dialog('destroy');
			}				
		}
		button.CANCEL =function(){
			$(this).dialog('destroy');
			SELF.parents('li:first').find('div.avgPrice input').blur();
		}
		$('#myDialog').trigger('pop-it', {
			'title': title,
			'msg': dg,
			'button': button,
			'modal': true
		});
		$('.dgForm .avgPrice input:first').select();
	}
	
	//SRP
	$('#productView .VIEWprice input').live('change', function(){
		var row = $(this).parents('li:first');
		var THIS = $(this);				
		var button = {};
		var epp = parseFloat(row.find('.avgPrice input').val());
		var srp = parseFloat(row.find('.price input').val());
		if(epp > srp){
			var msg = "EPP must not less than SRP!";
			button.Back =function(){
				$(this).dialog('destroy');
				THIS.val(oldSRP);
			}
		}else{
			var msg = "Change SRP?";
			button.OK = function(){
				row.find('.ow input').val('O');
				$(this).dialog('destroy');
			}
			button.CANCEL =function(){
				row.find('.ow input').val('');
				$(this).dialog('destroy');
				THIS.val(oldSRP);
			}
		}
		$('#myDialog').trigger('pop-it', {
			'title': 'Notify',
			'msg': msg,
			'button': button,
			'modal': true
		});
	});
	var oldSRP;
	$('#productView .VIEWprice input').live('focus', function(){
		oldSRP = $(this).val();
	});

	
    $('.itemcode input').livequery(function(){
		var THIS = this;
		$(THIS).bind('keydown',function(e){
			//Alt+A trapping
			//console.log(e.which);
			if(e.which==73 && e.altKey){
				$(THIS).attr('valid','1');
				$(THIS).removeClass('b1sCheri');
				$(THIS).removeClass('bgCheri');
				$(THIS).val($.trim('(Auto)')).blur().attr('readonly','readonly').trigger('keypress',{'which':13});
			}
		});
	});

	$('#inventoryList ul.recordDatagrid input, #inventoryList ul.recordDatagrid select').live('blur',function(){
		var input = $(this);
		var valueOf = $.trim(input.val());
		input.trigger('check_valid');
		
		/* if (valueOf=='' || valueOf=='%'){
			
			var thisLast = $(this).parents('li:first');
			var recordLast = $('#inventoryList .recordDatagrid li:last');
			thisLast = thisLast[0];
			recordLast =recordLast[0];
			if(!thisLast==recordLast){
				input.focus();
			};
		}
		if(input.attr('valid')==ERROR_FLAG){
			input.focus();
		} */
	});
	
	$('#inventoryList .moreThanZero').live('blur', function(e,a){
		var SELF = $(this);
			if( parseInt($.trim(SELF.val())) <=0){
				SELF.val('');
				SELF.attr('valid','-1');
				
				var button = {};
				button.OK = function() {
					$(this).dialog('destroy');
					SELF.focus();
				};
				$('#myDialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': 'Must be greater than zero',
					'button': button,
					'modal': true
				});
			}else{
				SELF.attr('valid','1')
			}
	});
	
	$('.order_button').click(function(){
		
		var orderItby =$('#ordering :selected').val();
		sortIt(CURRENT_TYPE, orderItby);
	
	});
	
	$(document).trigger('restore_defaults');
	
	//Edit
	$('.edit-product').livequery('click',function(){
		var row = $(this).parents('li:first');
		row.find('.editable').removeAttr('readonly','readonly');
		row.find('.VIEWavg input').addClass('markIt');
		row.find('.VIEWdesc input').focus().select();
		row.find('.action').html('<a class="save-product"><img src="'+BASE_URL+'img/icons/disk.png"></img></a>');
	});
	//Save(Edit)Update
	$('.save-product').livequery('click',function(){
		var row = $(this).parents('li:first');
		row.find('.VIEWavg input').removeClass('markIt');
		row.find('.editable').attr('readonly','readonly').attr('onfocus','blur()');
		row.find('.action').html('<a class="edit-product"><img src="'+BASE_URL+'img/icons/pencil.png"></img></a>');
		var id = row.find('.VIEWID input').val();
		var desc = row.find('.VIEWdesc input').val();
		var qty = row.find('.VIEWquantity input').val();
		var srp = row.find('.VIEWprice input').val();
		var epp = row.find('.VIEWavg input').val();
		var em = row.find('.em input').val();
		var ow = row.find('.ow input').val();
		var emUnit = row.find('.emUnit input').val();
			$.ajax({
				type:'POST',
				url: BASE_URL+'products/update',
				data:{'data':{'Product':{'id':id,'name':desc,'qty':qty,'selling_price':srp,'avg_price':epp,'markup':em,'markup_unit':emUnit,'ow':ow}}},
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