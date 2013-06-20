$(document).ready(function(){
	var RECORD_SPEED = 'slow';
	var ERROR_FLAG=-1;
	
	$('.uiNotify').hide(); 
	//$('#receiving ul.recordDatagrid input').blur();
	$('#ReceivingDocTypeId, #dgProductProductType').prepend(new Option('Select One', 'null'));
	$('#ReceivingDocTypeId, #dgProductProductType').val('null');
	
	var prodtype = $.trim($('div.productType').html());
	
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
		$('.ui-dialog-buttonset button:first').show();
	});
	
	//datepicker
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
	
	$(".datepicker").datepicker('setDate', new Date());
	
	//auto Vendor
	$('.vendorAuto').livequery(function(){
		var input =  $(this);		
		input.autocomplete({
			source: [],
			select: function(event, ui) {
				$(event.target).val(ui.item.label);
				$('#ReceivingVendorId').val(ui.item.idIS);
				$(event.target).focus().blur();//.trigger('keypress',{'which':13});
				return false;
			}
		}).keypress(function(){
		   var Desc = $(this).val();
		   var myLink = '/canteen/vendors/search_vendor_match';
		   var source = [];
		   $('.vendorAuto').autocomplete('option','source',source);		   
		   $.ajax({
				type:'POST',
				url: myLink,
				data:{'data':{'Vendor':{'key':Desc}}},
				beforeSend:function(){
					//console.log('key: ',productDesc);
				},
				success:function(data){
					//try{
					var prod = $.parseJSON(data);
					$.each(prod, function(c,o){
						var itemsOf = {
							'label':o.Vendor.name,
							'value':o.Vendor.name,
							'idIS':o.Vendor.id,
						};
						source.push(itemsOf);
					})
					//console.log('source: ',source);
					$('.vendorAuto').autocomplete('option','source',source);
					//}
				}
			});
			return;
		}).blur(function(){
			if ($(this).val()!=''){
				var Desc = ssUtil.toProperCase($(this).val());
				 $.ajax({
					type:'POST',
					url : '/canteen/vendors/search_vendor_match/1',
					data:{'data':{'Vendor':{'key':Desc}}},
					success:function(data){
							var json = $.parseJSON(data);
							if(json){
								//console.log(json);
								$('#ReceivingVendorId').val(json.Vendor.id);
							}else{
								var msg = '<center><strong>Vendor name does not exist.<br/>Do you want to add it?</strong></center>';
								var button = {};
								button.ADD = function() {
								
									$(this).dialog('destroy');
									var msg = '<strong>Vendor Name: &nbsp;</strong><input value ="'+Desc+'" readonly class="w100"/></div>';
									var button = {};
									button.OK = function() {
										$('#VendorName').val(Desc);
										$('#VendAdd').ajaxSubmit({
											url:'/canteen/vendors/add/',
											success:function(data){
												var json = $.parseJSON(data);
												$('#ReceivingVendorId').val(json.data.Vendor.id);
											}
										})
										$(this).dialog('destroy');
									};
									button.CANCEL = function() {
										$(this).dialog('destroy');
									};
									$('#myDialog').trigger('pop-it', {
										'title': 'Add Vendor',
										'msg': msg,
										'button': button,
										'modal': true
									});
									
								};
								button.CANCEL = function() {
									$('#ReceivingVendorName').select();
									$(this).dialog('destroy');
								};
								$('#myDialog').trigger('pop-it', {
									'title': 'Notification',
									'msg': msg,
									'button': button,
									'modal': true
								});
							}
					}
				});
		} 
		});
	})
	
	//$('.submit-button').attr('disabled','disabled');
	
	function computeNEPP(old_qty, new_qty, avg_p, new_pp ){
		if(old_qty>0){
			old_qty=0;
		}
		var neep = ((old_qty*avg_p)+(new_qty*new_pp))/(old_qty+new_qty);
		/* console.log('old_qty:', old_qty);
		console.log('new_qty:', new_qty);
		console.log('avg_p:', avg_p);
		console.log('new_pp:', new_pp); */
		return neep;
	};
	
	$('#ReceivingVendorName, #ReceivingVendorId, #ReceivingDocNo').livequery(function(){
			//prevent reloading on keying enter
			$(this).bind('keypress',function(e){
				if(e.which==13){
					e.preventDefault();
				 } 
			});
			
		});
	
	//Vendor Name Validation
	$('#ReceivingVendorName').keypress(function(e){
		var Desc = ssUtil.toProperCase($(this).val());
		if(e.which==13){
			if($(this).val()==''){
				var msg = '<center><strong>Invalid Vendor Name!</strong></center>';
				var button = {};
				button.BACK = function() {
					$('#ReceivingVendorName').select();
					$(this).dialog('destroy');
				};
				$('#myDialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': msg,
					'button': button,
					'modal': true
				});
			}
			else if( $(this).val()!='' && $('#ReceivingVendorId').val()==''){
				var msg = '<center><strong>Vendor name does not exist.<br/>Do you want to add it?</strong></center>';
				var button = {};
				button.ADD = function() {
					$(this).dialog('destroy');
							var msg = '<strong>Vendor Name: &nbsp;</strong><input value ="'+Desc+'" readonly class="w100"/></div>';
							var button = {};
							button.OK = function() {
								$('#VendorName').val(Desc);
								$('#VendAdd').ajaxSubmit({
									url:'/canteen/vendors/add/',
									success:function(data){
										var json = $.parseJSON(data);
										$('#ReceivingVendorId').val(json.data.Vendor.id);
									}
								})
								$(this).dialog('destroy');
							};
							button.CANCEL = function() {
								$('#ReceivingVendorName').select();
								$(this).dialog('destroy');
							};
							$('#myDialog').trigger('pop-it', {
								'title': 'Add Vendor',
								'msg': msg,
								'button': button,
								'modal': true
							});
					
				};
				button.CANCEL = function() {
					$('.ui-dialog-buttonset button:first').show();
					$('#ReceivingVendorName').select();
					$(this).dialog('destroy');
				};
				$('#myDialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': msg,
					'button': button,
					'modal': true
				});
			}
		} 
	});
	
	 $('.hdrReceive input').bind('blur',function(e){
		if($(this).val()==''){
			$('.submit-button').attr('disabled','disabled');
		}else{
			$('.submit-button').removeAttr('disabled');
		}
	}); 
	
	//Restore Default
    $(document).bind('restore_defaults', function() {
		$('#receiving .recordDatagrid').find('li input[type="text"]').removeAttr('readonly').removeAttr('valid').val('').removeClass('b1sCheri').removeClass('bgCheri');
		$('#receiving .recordDatagrid li.mainInput').fadeOut(RECORD_SPEED);
		$('#receiving .recordDatagrid li.dynamicInput').fadeOut(RECORD_SPEED,function(){
			$('#receiving .recordDatagrid li.dynamicInput').remove();
		});
		$('#receiving .recordDatagrid li.mainInput').fadeIn(RECORD_SPEED);
        $('#receiving .recordDatagrid').trigger('update_grid');
		$('#ReceivingVendorName, #ReceivingVendorId, #ReceivingDocNum').val('');
		$(".datepicker").datepicker('setDate', new Date());
		$('#receiving .recordDatagrid input[old_qty]').removeAttr('old_qty');
		$('#receiving .recordDatagrid input[markup]').removeAttr('markup');
		$('#receiving .recordDatagrid input[markup-unit]').removeAttr('markup-unit');
		$('#receiving .recordDatagrid input[old_pp]').removeAttr('old_pp');
		$('#receiving .recordDatagrid input').val('');
		x=$('#ReceivingDocTypeId');
		x[0].selectedIndex=0;
		$('.submit-button').attr('disabled','disabled');
	});
	
	//auto product
	$('.productAuto').livequery(function(){
		var input =  $(this);		
		input.autocomplete({
			source: [],
			select: function(event, ui) {
				$(event.target).val(ui.item.label);
				input.parents('li:first').find('div.itemcode input').val(ui.item.itemcode).blur();
				input.parents('li:first').find('div.csr input').val(ui.item.selling_price).blur();
				
				//Getting average purchase prise
				$.ajax({
					type:'POST',
					url:'/canteen/receivings/getAvgPP/'+ui.item.itemcode,
					success:function(data){
						var avgpp = $.parseJSON(data);
						avgpp = avgpp.Product.avg_price
						input.parents('li:first').find('div.app input').val(avgpp); 
					}
				});
				
				//$(event.target).focus().trigger('keypress',{'which':13});
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
							'value':o.Product.name,
							'itemcode':o.Product.item_code,
							'selling_price':o.Product.selling_price
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

	//moreThanZero class
	$('#receiving .moreThanZero').live('blur', function(e,a){
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
	
	//on barcode trigger populate product data
	$('#itemCheck').bind('getResult', function(e,a){
		var Li = $(a.self).parents('li:first');
		var code = Li.find('div.itemcode input:first').val();
		var units = Li.find('div.unit select:first').parent().html();
		try{
			var prod = a.data['0'];
			//console.log(prod);
			Li.find('div.unit select').val(prod.Product.unit_id);
			Li.find('div.csr input').val(prod.Product.selling_price).blur();
			Li.find('div.desc input').val(prod.Product.name);//.focus().trigger('keypress',{'which':13});
			$.ajax({
					type:'POST',
					url:'/canteen/receivings/getAvgPP/'+prod.Product.item_code,
					success:function(data){
						var avgpp = $.parseJSON(data);
						avgpp = avgpp.Product.avg_price
						Li.find('div.app input').val(avgpp);
					}
				});
				
		}catch(e){
			var msg ='<center><strong>Product not found!<br /><br />Do you want to add this product?</strong></center>';
			var button = {};
			button.YES = function(){
				$(this).dialog('destroy');
				
				var dgbox = '<div class="dgForm fwb">';
				dgbox+='<div class="fLeft w45 pt5">Product Type:</div>';
				dgbox+='<div class="type fRight w55">' +prodtype +'</div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Item Code:</div>';
				dgbox+='<div class="itemcode fRight w55"><input value="'+code+'" readonly class="taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Description:</div>';
				dgbox+='<div class="desc fRight w55"><input id="dgProductName" maxlength="50" class="productAuto ajax unique taRight" linkto="#ProductName" frm="#nameCheck"/></div>';
				dgbox+='<div class="fClear"></div>';
			
				dgbox+='<div class="fLeft w45 pt5">Unit:</div>';
				dgbox+='<div class="unit fRight w55">'+units+'</div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Qty:</div>';
				dgbox+='<div class="qty fRight w55"><input class="taRight numeric"/></div>';
				dgbox+='<div class="fClear"></div>';			
				
				dgbox+='<div class="fLeft w45 pt5">Purchase Price/Unit:</div>';
				dgbox+='<div class="pp fRight w55"><input class="monetary numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Amount:</div>';
				dgbox+='<div class="amount fRight w55"><input readonly="readonly" class="monetary numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				
				dgbox+='<div class="fLeft w45 pt5">Estimated Markup:</div>';
				dgbox+='<div class="em fRight w55"><input class="numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Markup Unit:</div>';
				dgbox+='<div class="emUnit fRight w55"><select>';
				dgbox+='<option value="1">Php.</option>';
				dgbox+='<option value="%">%</option>';
				dgbox+='</select></div>';
				dgbox+='<div class="fClear"></div>';
				
				
				dgbox+='<div class="fLeft w45 pt5">Estimated SRP:</div>';
				dgbox+='<div class="esrp fRight w55"><input readonly="readonly" class="monetary numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">SRP:</div>';
				dgbox+='<div class="srp fRight w55"><input  class="monetary numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				var button = {};
				button.OK = function(){
					
					var prodType = $('div.dgForm .type select:first').val();
					var prodDesc = $('div.dgForm .desc input:first').val();
					var prodUnit = $('div.dgForm .unit select:first').val();
					var prodQty = $('div.dgForm .qty input:first').val();
					var prodSrp = $('div.dgForm .srp input:first').val();
					var prodASrp = $('div.dgForm .esrp input:first').val();
					var prodMarkup = $('div.dgForm .em input:first').val();
					var prodMarkupUnit = $('div.dgForm .emUnit select:first').val();
					$('#addProduct > #ProductItemCode').val(code);
					$('#addProduct > #ProductName').val(prodDesc);
					$('#addProduct > #ProductUnitId').val(prodUnit);
					$('#addProduct > #ProductProductTypeId').val(prodType);
					$('#addProduct > #ProductQty').val(prodQty);
					$('#addProduct > #ProductSellingPrice').val(prodSrp);
					$('#addProduct > #ProductAvgPrice').val(prodASrp);
					$('#addProduct > #ProductMarkup').val(prodMarkup);
					$('#addProduct > #ProductMarkupUnit').val(prodMarkupUnit);
					
					$(this).dialog('destroy');
					$('#addProduct').ajaxSubmit({
						success: function(data){
							var msg =($.parseJSON(data));
							var prod = msg.data;
							var button = {};
							button.OK = function() {
								var source = [];
								var aggr={};           
								aggr['div.itemcode input']=prod.Product.item_code;
								aggr['div.desc input']=prod.Product.name;
								aggr['div.csr input']=prod.Product.selling_price;
								aggr['div.qty input']=prod.Product.qty;
								source.push(aggr);
								$('#receiving ul.recordDataGrid').trigger('fill_this_grid',{'data':source, 'row':Li});
								$(Li[0]).find('div.pp input').attr('old_pp',prod.Product.avg_price);
								$(Li[0]).find('div.rsrp input').attr('markup',prod.Product.markup);
								$(Li[0]).find('div.rsrp input').attr('markup-unit',prod.Product.markup_unit);
								$(Li[0]).find('div.itemcode input').attr('valid','1');
								$(Li[0]).find('div.itemcode input').removeClass('b1sCheri');
								$(Li[0]).find('div.itemcode input').removeClass('bgCheri');
								$(this).dialog('destroy');
							};
							$('#myDialog').trigger('pop-it', {
								'title': 'Notification',
								'msg': msg.msg,
								'button': button,
								'modal': true
							});
							$('.ui-dialog-buttonset button:first').show();
						}
					});
				};
				button.CANCEL = function() {
					$(this).dialog('destroy');
					Li.find('div.itemcode input:first').val('').select();
					$('.ui-dialog-buttonset button:first').show();
				};
				
				$('#myDialog').trigger('pop-it',{
					'title': 'Adding Product',
					'msg': dgbox,
					'button': button,
					'modal': true
				});
				$('.ui-dialog-buttonset button:first').show();
				
			};
			button.NO = function() {
				$(this).dialog('destroy');
				Li.find('div.itemcode input:first').focus().blur().select();
				
			};
			$('.ui-dialog-buttonset button:first').show();
			$('#myDialog').trigger('pop-it', {
				'title': 'Notification',
				'msg': msg,
				'button': button,
				'modal': true
			});
		}
		
	});
	
	// on form submit error
	$('#ReceivingAddForm').bind('form_error',function(evt,args){
		//$('#ProductAddForm .uiNotify').html('Fill up required field or delete row').addClass('bgCheri').addClass('b1sCheri').fadeIn('slow').fadeOut('slow');
		$('#ReceivingAddForm .uiNotify').html('Fill up required field or delete row');//.addClass('bgCheri').addClass('b1sCheri').fadeIn('slow').fadeOut('slow');
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
	
	// on form submit success
	$('#ReceivingAddForm').bind('formNeat_sucess',function(e,a){
		var msg = $.parseJSON(a.data);
        console.log(msg);
		console.log('hey');
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
		$('.ui-dialog-buttonset button:first').show();	
		//$(document).trigger('restore_defaults');
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
	
	//trigger on new row
	$('#receiving ul.recordDataGrid').bind('new_row',function(){
		$(this).find('li:last div.itemcode .input input').removeAttr('readonly');
		$(this).find('li:last div.qty .input input[old_qty]').removeAttr('old_qty');
		$(this).find('li:last div.rsrp .input input[markup]').removeAttr('markup');
		$(this).find('li:last div.rsrp .input input[markup-unit]').removeAttr('markup-unit');
		$(this).find('li:last div.pp .input input[old_pp]').removeAttr('old_pp');
	});
	
	
	function triggerThis(obj,evt){
			var Li = $(obj).parents('li:first');
			var units = Li.find('div.unit select:first').parent().html();
			
			var desc = $(obj).parents('li:first').find('div .desc input:first').val();
			var code = $(obj).parents('li:first').find('div .itemcode input:first').val();
			if (code=='' && $(obj).val()!=''){
				$(this).dialog('destroy');
				var msg ='<center><strong>Product description not found!<br /><br />Do you want to add this product?</strong></center>';
				var button = {};
				button.YES = function(){
					var dgbox = '<div class="dgForm fwb">';
					dgbox+='<div class="fLeft w45 pt5">Product Type:</div>';
					dgbox+='<div class="type fRight w55">' +prodtype +'</div>';
					dgbox+='<div class="fClear"></div>';
					
					dgbox+='<div class="fLeft w45 pt5">Item Code:</div>';
					dgbox+='<div class="itemcode fRight w55"><input value="(Auto)" class ="taRight" readonly/></div>';
					dgbox+='<div class="fClear"></div>';
					
					dgbox+='<div class="fLeft w45 pt5">Description:</div>';
					dgbox+='<div class="desc fRight w55"><input id="dgProductName" maxlength="50" class="productAuto ajax unique taRight" linkto="#ProductName" frm="#nameCheck" value="'+desc+'" readonly/>';
					dgbox+='</div>';
					dgbox+='<div class="fClear"></div>';
				
					dgbox+='<div class="fLeft w45 pt5">Unit:</div>';
					dgbox+='<div class="unit fRight w55">'+units+'</div>';
					dgbox+='<div class="fClear"></div>';
					
					dgbox+='<div class="fLeft w45 pt5">Qty:</div>';
					dgbox+='<div class="qty fRight w55"><input class ="taRight numeric"/></div>';
					dgbox+='<div class="fClear"></div>';			
					
					dgbox+='<div class="fLeft w45 pt5">Purchase Price/Unit:</div>';
					dgbox+='<div class="pp fRight w55"><input class="monetary numeric taRight"/></div>';
					dgbox+='<div class="fClear"></div>';
					
					dgbox+='<div class="fLeft w45 pt5">Amount:</div>';
					dgbox+='<div class="amount fRight w55"><input readonly="readonly" class="monetary numeric taRight"/></div>';
					dgbox+='<div class="fClear"></div>';
					
					
					dgbox+='<div class="fLeft w45 pt5">Estimated Markup:</div>';
					dgbox+='<div class="em fRight w55"><input class="numeric taRight"/></div>';
					dgbox+='<div class="fClear"></div>';
					
					dgbox+='<div class="fLeft w45 pt5">Markup Unit:</div>';
					dgbox+='<div class="emUnit fRight w55"><select>';
					dgbox+='<option value="1">Php.</option>';
					dgbox+='<option value="%">%</option>';
					dgbox+='</select></div>';
					dgbox+='<div class="fClear"></div>';
					
					
					dgbox+='<div class="fLeft w45 pt5">Estimated SRP:</div>';
					dgbox+='<div class="esrp fRight w55"><input readonly="readonly" class="monetary numeric taRight"/></div>';
					dgbox+='<div class="fClear"></div>';
					
					dgbox+='<div class="fLeft w45 pt5">SRP:</div>';
					dgbox+='<div class="srp fRight w55"><input  class="monetary numeric taRight"/></div>';
					dgbox+='<div class="fClear"></div>';
					
					
					var button = {};
					button.OK = function(){
						var prodCode = $('div.dgForm .itemcode input:first').val();
						var prodType = $('div.dgForm .type select:first').val();
						var prodDesc = $('div.dgForm .desc input:first').val();
						var prodUnit = $('div.dgForm .unit select:first').val();
						var prodQty = $('div.dgForm .qty input:first').val();
						var prodSrp = $('div.dgForm .srp input:first').val();
						var prodASrp = $('div.dgForm .esrp input:first').val();
						var prodMarkup = $('div.dgForm .em input:first').val();
						var prodMarkupUnit = $('div.dgForm .emUnit select:first').val();
					
						$('#addProduct > #ProductItemCode').val(prodCode);
						$('#addProduct > #ProductName').val(prodDesc);
						$('#addProduct > #ProductUnitId').val(prodUnit);
						$('#addProduct > #ProductQty').val(prodQty);
						$('#addProduct > #ProductSellingPrice').val(prodSrp);
						$('#addProduct > #ProductAvgPrice').val(prodASrp);
						$('#addProduct > #ProductProductTypeId').val(prodType);
						$('#addProduct > #ProductMarkup').val(prodMarkup);
						$('#addProduct > #ProductMarkupUnit').val(prodMarkupUnit);
						
						$('#addProduct').ajaxSubmit({
							success: function(data){
								//console.log(data);
								var msg =$.parseJSON(data);
								var prod = msg.data;
								var button = {};
								button.OK = function() {
									var source = [];
									var aggr={};           
									aggr['div.itemcode input']=prod.Product.item_code;
									aggr['div.desc input']=prod.Product.name;
									aggr['div.csr input']=prod.Product.selling_price;
									aggr['div.qty input']=prod.Product.qty;
									source.push(aggr);
									$('#receiving ul.recordDataGrid').trigger('fill_this_grid',{'data':source, 'row':Li});
									$(Li[0]).find('div.pp input').attr('old_pp',prod.Product.avg_price);
									$(Li[0]).find('div.rsrp input').attr('markup',prod.Product.markup);
									$(Li[0]).find('div.rsrp input').attr('markup-unit',prod.Product.markup_unit);
									$(Li[0]).find('div.itemcode input').attr('valid','1');
									$(Li[0]).find('div.itemcode input').removeClass('b1sCheri');
									$(Li[0]).find('div.itemcode input').removeClass('bgCheri');
									$(this).dialog('destroy');
								};
								$('#myDialog').trigger('pop-it', {
									'title': 'Notification',
									'msg': msg.msg,
									'button': button,
									'modal': true
								});
								$('.ui-dialog-buttonset button:first').show();
							}
						});
					};
					button.CANCEL = function() {
						$(this).dialog('destroy');
						Li.find('div.desc input:first').val('').select();
					};
					
					$('#myDialog').trigger('pop-it',{
						'title': 'Adding Product',
						'msg': dgbox,
						'button': button,
						'modal': true
					});
					
				};
			    button.NO = function(){
					$(this).dialog('destroy');
				};
				
				$('#myDialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': msg,
					'button': button,
					'modal': true
				});
				$('.ui-dialog-buttonset button:first').show();
			};
			
		};
	
	var proceed =0; //to avoid dialog box overriding
	//if any input or select blurred
	$('#receiving ul.recordDatagrid input, #receiving ul.recordDatagrid select').live('blur',function(){
		var input = $(this);
		var THIS = this;
		var valueOf = $.trim(input.val());
		$(this).trigger('check_valid');
		
		var field = input.parent().parent();
		if(field.hasClass('qty') || field.hasClass('pp')){
			if(proceed){
				console.log(input.parents('li:first').find('.desc input:first').val());
				var qty = parseInt($(this).parents('li:first').find('.qty input:first').val());
				var pp = $(this).parents('li:first').find('.pp input:first').val();
				var app = $(this).parents('li:first').find('.app input:first').val();
				var itemcode = $.trim($(this).parents('li:first').find('.itemcode input:first').val());
				var markup = parseInt($(this).parents('li:first').find('.rsrp input:first').attr('markup'));
				var markupUnit = $.trim($(this).parents('li:first').find('.rsrp input:first').attr('markup-unit'));
				
				amt = parseFloat(pp)*qty;
				isNaN(amt)?amt='':amt=parseFloat(amt);
				
				$(this).parents('li:first').find('.amt input:first').val(amt).blur();
				
				isNaN(parseFloat(app))?$(this).parents('li:first').find('.app input:first').val(pp):app=app;
				
				//console.log(qty,' <qty  pp> ',pp);
				old_qty = parseFloat($(this).parents('li:first').find('.qty input:first').attr('old_qty'));
				new_qty = parseFloat($(this).parents('li:first').find('.qty input:first').val());
				avg_p = parseFloat($(this).parents('li:first').find('.pp input:first').attr('old_pp'));
				new_pp = parseFloat($(this).parents('li:first').find('.pp input:first').val());
				
				if(isNaN(old_qty)){
					old_qty = new_qty;
				}
				
				thisNEEP = parseFloat(computeNEPP(old_qty, new_qty, avg_p, new_pp));
				if(isNaN(thisNEEP)){
					thisNEEP='';
					$(this).parents('li:first').find('.epp input:first').val(thisNEEP)
				}else{
					$(this).parents('li:first').find('.epp input:first').val(thisNEEP).blur();
				}
				
				var rsrp;
				switch(markupUnit){
					case '%':
						rsrp = parseFloat(pp)*(markup/100)+parseFloat(pp);
						break;
					case '1':
						rsrp = parseFloat(pp)+markup;
						break;
					
				}
				if(isNaN(rsrp)){
					rsrp='';
					$(this).parents('li:first').find('.rsrp input:first').val(rsrp)
				}else{
					$(this).parents('li:first').find('.rsrp input:first').val(rsrp).blur();
				}
				
				//proceed =0;
			}
		}
		
		if(field.hasClass('desc')){
			if(valueOf!=''){
				$.ajax({
					type:'POST',
					url:'/canteen/products/getByProductName',
					data:{data:{Product:{name:valueOf}}},
					success:function(data){
						json = $.parseJSON(data);
						console.log(json);
						if(json){
							proceed =1;
							input.val(json.Product.name);
							input.parents('li:first').find('.itemcode input:first').val(json.Product.item_code);
							input.parents('li:first').find('.csr input:first').val(json.Product.selling_price).blur();
							input.parents('li:first').find('.unit select:first').val(json.Unit.id);
							input.parents('li:first').find('.pp input:first').attr('old_pp',json.Product.avg_price);
							input.parents('li:first').find('.rsrp input:first').attr('markup',json.Product.markup);
							input.parents('li:first').find('.rsrp input:first').attr('markup-unit',json.Product.markup_unit);
							input.parents('li:first').find('.qty input:first').attr('old_qty',json.Product.qty).select();
							input.parents('li:first').find('.itemcode input').attr('valid','1');
							input.parents('li:first').find('.itemcode input').removeClass('b1sCheri');
							input.parents('li:first').find('.itemcode input').removeClass('bgCheri');
							
							$.ajax({
								type:'POST',
								url:'/canteen/receivings/getAvgPP/'+json.Product.item_code,
								success:function(data){
									var avgpp = $.parseJSON(data);
									avgpp = avgpp.Product.avg_price
									input.parents('li:first').find('div.app input').val(avgpp).blur();
								}
							});
							
						}else{
							proceed =0;
							triggerThis(THIS);
						}
					}
				});
			}
		}
		
	
		/* if(input.attr('valid')==ERROR_FLAG){
			input.focus();
		} */
	});
	
	$('label[for="ReceivingDocNum"]').css('margin-left', '-73');
	
	//Cancel Button
	$("#cancel_button, .cancel_button").click(function(){
		$(document).trigger('restore_defaults');
	});
	
	//if Alt I was hit on itemcode column
	$('.itemcode input').livequery(function(e,a){
		var THIS = this;
		var Li = $(THIS).parents('li:first');
		var units = Li.find('div.unit select:first').parent().html();
		$(THIS).bind('keydown',function(e){
			//Alt+I trapping
			if(e.which==73 && e.altKey){
				var dgbox = '<div class="dgForm fwb">';
				dgbox+='<div class="fLeft w45 pt5">Product Type:</div>';
				dgbox+='<div class="type fRight w55">' +prodtype +'</div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Item Code:</div>';
				dgbox+='<div class="itemcode fRight w55"><input value="(Auto)" type="text" readonly class="taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Description:</div>';
				dgbox+='<div class="desc fRight w55"><input id="dgProductName" maxlength="50" class="productAuto ajax unique taRight" linkto="#ProductName" frm="#nameCheck"/></div>';
				dgbox+='<div class="fClear"></div>';
			
				dgbox+='<div class="fLeft w45 pt5">Unit:</div>';
				dgbox+='<div class="unit fRight w55">'+units+'</div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Qty:</div>';
				dgbox+='<div class="qty fRight w55"><input  class="numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';			
				
				dgbox+='<div class="fLeft w45 pt5">Purchase Price/Unit:</div>';
				dgbox+='<div class="pp fRight w55"><input class="monetary numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5 ">Amount:</div>';
				dgbox+='<div class="amount fRight w55"><input readonly="readonly" class="monetary numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				
				dgbox+='<div class="fLeft w45 pt5">Estimated Markup:</div>';
				dgbox+='<div class="em fRight w55"><input class="numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">Markup Unit:</div>';
				dgbox+='<div class="emUnit fRight w55"><select>';
				dgbox+='<option value="1">Php.</option>';
				dgbox+='<option value="%">%</option>';
				dgbox+='</select></div>';
				dgbox+='<div class="fClear"></div>';
				
				
				dgbox+='<div class="fLeft w45 pt5">Estimated SRP:</div>';
				dgbox+='<div class="esrp fRight w55"><input readonly="readonly" class="monetary numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				dgbox+='<div class="fLeft w45 pt5">SRP:</div>';
				dgbox+='<div class="srp fRight w55"><input  class="monetary numeric taRight"/></div>';
				dgbox+='<div class="fClear"></div>';
				
				$('#myDialog').dialog('destroy');
				var button = {};
				button.OK = function(){
					
					var prodCode = $('div.dgForm .itemcode input:first').val();
					var prodType = $('div.dgForm .type select:first').val();
					var prodDesc = $('div.dgForm .desc input:first').val();
					var prodUnit = $('div.dgForm .unit select:first').val();
					var prodQty = $('div.dgForm .qty input:first').val();
					var prodSrp = $('div.dgForm .srp input:first').val();
					var prodASrp = $('div.dgForm .esrp input:first').val();
					var prodMarkup = $('div.dgForm .em input:first').val();
					var prodMarkupUnit = $('div.dgForm .emUnit select:first').val();
					
					$('#addProduct > #ProductItemCode').val(prodCode);
					$('#addProduct > #ProductName').val(prodDesc);
					$('#addProduct > #ProductUnitId').val(prodUnit);
					$('#addProduct > #ProductQty').val(prodQty);
					$('#addProduct > #ProductSellingPrice').val(prodSrp);
					$('#addProduct > #ProductAvgPrice').val(prodASrp);
					$('#addProduct > #ProductProductTypeId').val(prodType);
					$('#addProduct > #ProductMarkup').val(prodMarkup);
					$('#addProduct > #ProductMarkupUnit').val(prodMarkupUnit);
					
					$(this).dialog('destroy');
					$('.ui-dialog-buttonset button:first').show();
					$('#addProduct').ajaxSubmit({
						success: function(data){
							$('.ui-dialog-buttonset button:first').show();
							console.log('hey');
							var msg =($.parseJSON(data));
							var prod = msg.data;
							console.log(prod);
							var button = {};
							button.OK = function() {
								proceed =1;
								var source = [];
								var aggr={};           
								aggr['div.itemcode input']=prod.Product.item_code;
								aggr['div.desc input']=prod.Product.name;
								aggr['div.csr input']=prod.Product.selling_price;
								aggr['div.qty input']=prod.Product.qty;
								aggr['div.pp input']=prod.Product.avg_price;
								source.push(aggr);
								$('#receiving ul.recordDataGrid').trigger('fill_this_grid',{'data':source, 'row':Li});								
								$(Li[0]).find('div.pp input').attr('old_pp',prod.Product.avg_price);
								$(Li[0]).find('div.rsrp input').attr('markup',prod.Product.markup);
								$(Li[0]).find('div.rsrp input').attr('markup-unit',prod.Product.markup_unit);
								$(Li[0]).find('div.itemcode input').attr('valid','1');
								$(Li[0]).find('div.itemcode input').removeClass('b1sCheri');
								$(Li[0]).find('div.itemcode input').removeClass('bgCheri');
								$(Li[0]).find('input').blur();
								$(Li[0]).find('div.rsrp input').trigger('keypress',{'which':13});
								$(this).dialog('destroy');
							};
							
							$('#myDialog').trigger('pop-it', {
								'title': 'Notification',
								'msg': msg.msg,
								'button': button,
								'modal': true
							});
							$('.ui-dialog-buttonset button:first').show();
						}
					});
				};
				button.CANCEL = function() {
					$(this).dialog('destroy');
					$('.ui-dialog-buttonset button:first').show();
				};
				
				$('#myDialog').trigger('pop-it',{
					'title': 'Adding Product',
					'msg': dgbox,
					'button': button,
					'modal': true
				});
				$('.ui-dialog-buttonset button:first').show();
				
			}
		});
	});
	
	//adding product controller
	$('div.dgForm select, div.dgForm input').livequery(function(){
		$('.ui-dialog-buttonset button:first').hide();
		var THIS = $(this);
		
		THIS.bind('focus', function(){
			$('.ui-dialog-buttonset button:first').hide();
		});
		
		THIS.bind('blur', function(){
			onblurselect()
		});
		THIS.bind('change', function(){
			onblurselect();
		});
		
		function onblurselect(){
			var emptyField = $('div.dgForm select option[value="null"]:selected');
			emptyField = emptyField.length;
			var inputs = $('div.dgForm input,div.dgForm select');
			var emptyExist;
			
			$.each(inputs, function(ctr, input){
				//console.log($(input).val());
				if($(input).val()==""){
					emptyExist=true;
					$('.ui-dialog-buttonset button:first').hide();
				}
			});
			
			if (emptyExist == undefined){
				emptyExist = false;
			}			
			if(!emptyExist && !emptyField){
				$('.ui-dialog-buttonset button:first').show();
			}
			console.log('emptyExist:',emptyExist);
			
			//console.log(THIS.parent());
			if(THIS.parent().hasClass('qty') || THIS.parent().hasClass('pp')){
				var qty = $('.dgForm .qty input').val();
				var pp = $('.dgForm .pp input').val();
				isNaN( parseFloat(pp)) ? pp=0.0 : pp=parseFloat(pp);
				isNaN(parseFloat(qty)) ? qty=0.0 : qty=parseFloat(qty);
				
				console.log(qty,'<qty pp>',pp);
				var amt = qty*pp;
				if(amt==0){
					amt='';
					$('.dgForm .amount input').val('');
				}else{
					$('.dgForm .amount input').val(amt).blur();
				}
				
			};
			if(THIS.parent().hasClass('em') || THIS.parent().hasClass('emUnit')){
				//console.log('qty or pp');
				var pp = parseFloat($('.dgForm .pp input').val());
				var em = parseInt($('.dgForm .em input').val());
				var emUnit = $('.dgForm .emUnit select').val();
				var esrp;
				
				if(emUnit=='%'){
					esrp = pp*(em/100)+pp;
				}else{
					esrp=pp+em;
				}
				//console.log('esrp: ', esrp);
				isNaN(esrp) ? esrp=0.0 : esrp=parseFloat(esrp);
				if(esrp==0){
					esrp='';
					$('.dgForm .esrp input').val('');
					$('.dgForm .srp input').val('');
				}else{
					$('.dgForm .esrp input').val(esrp).blur();
					$('.dgForm .srp input').val(esrp).blur();
				}
			}
		}
		
	});
	
    $('.desc input').livequery(function(){
		var THIS = this;
		var valueOf = $(THIS).val()
		$(THIS).bind('keypress',function(e){
			//console.log(e.which);
			if(e.which==13){
				if(valueOf!=''){
					$.ajax({
						type:'POST',
						url:'/canteen/products/getByProductName',
						data:{data:{Product:{name:valueOf}}},
						success:function(data){
							json = $.parseJSON(data);
							if(json){
								input.val(json.Product.name);
								input.parents('li:first').find('.itemcode input:first').val(json.Product.item_code);
								input.parents('li:first').find('.csr input:first').val(json.Product.selling_price).blur();
								input.parents('li:first').find('.unit select:first').val(json.Unit.id);
								
							}else{
								triggerThis(THIS);
							}
						}
					});
				}
			}
		});
	});
	
	//Auto for doc type
	$('#ReceivingDocTypeId').livequery(function(){
		var self =$(this);
		self.bind('blur', function(){
			var selectedIs = $.trim($('#ReceivingDocTypeId option:selected').text());
			var index = self[0];
				if (selectedIs.toLowerCase() =='none'){
					$('#ReceivingDocNum').val('(Auto)');
				}
		});
		
	});
		
	$('#receiving .recordDatagrid').trigger('update_grid');
});

