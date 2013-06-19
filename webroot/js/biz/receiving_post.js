$(document).ready(function(){
	var currentReceiveId;

	function computeNEPP(old_qty, new_qty, avg_p, new_pp ){
		if(old_qty>0){
			old_qty=0;
		}
		var neep = ((old_qty*avg_p)+(new_qty*new_pp))/(old_qty+new_qty);
		console.log('old_qty:', old_qty);
		console.log('new_qty:', new_qty);
		console.log('avg_p:', avg_p);
		console.log('new_pp:', new_pp);
		return neep;
	};
	
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

	function postOut(a){
		var msg = a;
		var button = {};
			button.OK = function() {
				$(this).dialog('destroy');
			};
			$('#myDialog').trigger('pop-it', {
				'title': 'Notification',
				'msg': a.msg,
				'button': button,
				'modal': true
			});
			$('.ui-dialog-buttonset button:first').show();	
	
	
	}
	
	
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
	
	//Restore Default
    $(document).bind('restore_defaults', function(){
		$('#search_results tbody').fadeOut(function(){
				$('#search_results tbody').empty();
				$('#receiving .recordDatagrid').trigger('clear_grid');
		});
		$('.search_input ').val('');
		$('.listLabel').text('List');
	});
    
	
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
		});
	});
	
	$('.recordSearch input, select').livequery(function(){
		var input = $(this);
				
		if(input.hasClass('search_keys')){
			input.bind('change', function(){
				$('.search_input').show('').val('');
				$('#CanteenDocTypeId, .mrkUp').hide();
				field = input.find('option:selected').attr('field');
				$('.search_field').val(''); // clear search field first
				$('.search_input').datepicker("destroy");
				$('.vendorAuto').autocomplete({ disabled: true });
				$('.search_input, .viewBy, .sortBy').removeAttr('disabled');
				if (field!='undefined'){ // if equals to ==
					$('.search_field').val(field);
				}
				var searchKey = input.val();
				
				switch(searchKey){
					case 'ReceivingCreated':
						$('.search_input').datepicker({ 
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
						$(".datepicker").datepicker('setDate', new Date());
					break;
					case 'ReceivingDocTypeId':
						$('.search_input').hide();
						$('#CanteenDocTypeId').removeClass('hide').show();
					break;
					case 'ReceivingStatus':
						$('.search_input').hide();
						$('.mrkUp').removeClass('hide').show();
					break;
					case 'ReceivingVendorName':
						$('.search_input').addClass('vendorAuto');
						$('.vendorAuto').autocomplete({ disabled: false });
					break;
					case 'ReceivingUser':
					break;
					case 'ReceivingDocNum':
					break;
						
					default:
						$('.search_input, .viewBy, .sortBy').attr('disabled','disabled');
					break;
					}	
				
				
			});
			
		}
		if(input.hasClass('search_button')){
			input.bind('click', function(){
				var fieldIs = $('.search_field').val();
				var valueIs = $('.search_input').val();
				var viewIs = $('.viewBy').val();
				var sortIs = $('.sortBy').val();
				var missing = $('.search_tmplt [disabled]');
				console.log(missing.length);
				if(!missing.length){
					$.ajax({
						type:'POST',
						url: '/canteen/receivings/search/',
						data:{'data':{'Receiving':{
												'field':fieldIs,
												'key':valueIs,
												'view':viewIs,
												'sort':sortIs
												}
												}},
						beforeSend:function(){
							$('#search_results tbody').fadeOut('slow', function(){
								$('#search_results tbody').empty();
							});
							
						},
						success:function(data){
							var json = $.parseJSON(data);
							//console.log(json);
							var row="";
							$.each(json, function(c,o){
								//console.log('date: ',o.Receiving.created);
								var dateGet = new Date(o.Receiving.created);
								var posted = parseInt(o.Receiving.status);
								//console.log(o.Receiving.status);
								var status;
								if(!posted){
									status = 'Not Posted';
								}else{
									status = 'Posted';
								}
								dateIs = dateGet.toDateString();
								
								row+="<tr data='"+$.toJSON(o)+"'>";
								row+="<td class='w25 b1White vName'>"+o.Vendor.name+"</td>";
								row+="<td class='w10 b1White vId'>"+o.Vendor.id+"</td>";
								row+="<td class='w15 b1White vDate'>"+dateIs+"</td>";
								row+="<td class='w10 b1White vDocType'>"+o.DocType.name+"</td>";
								row+="<td class='w10 b1White vUser'>"+o.Receiving.user+"</td>";
								row+="<td class='w10 b1White vDocNum'>"+o.Receiving.doc_num+"</td>";
								row+="<td class='w10 b1White vStatus'>"+status+"</td>";
								row+="<td class='w10 b1White'>";
								row+="<button class= 'hot_button skinless viewRecieved' >";
								row+='<img src="/canteen/img/icons/eye.png" class=""/>';
								row+='</button>';
								row+='</td>';
								row+="</tr>";
							});
							$('#search_results tbody').fadeIn('slow', function(){
								$('#search_results tbody').append(row);
								$('#search_results').trigger('update_table');
							});
						}
					});
				}
			
			})
		
		}
		if(input.hasClass('doc_typeIs')){
			input.bind('change', function(){
				console.log(input.val());
				$('.search_input').val(input.val());
			});
		}
		if(input.hasClass('mrkUp')){
			input.bind('change', function(){
				$('.search_input').val(input.val());
			});
		}
	});

	$('.viewRecieved').live('click', function(){
		/* $('#search_results tbody tr').removeClass('selected');
		$('#search_results tbody tr:not(.selected)').css({
			'opacity': 1,
			'font-weight': 'normal'
		}); */
		
		$(this).parent().parent().addClass('selected');
		$('#search_results tbody tr:not(.selected)').css({
			'opacity': 0.4
		});
		$('#search_results tbody tr:not(.selected)').find('button:first').hide();
		$('#search_results tbody tr.selected').css({
			'font-weight': 'bold'
		});
		var row =$(this).parents('tr:first');
		var data= $.parseJSON(row.attr('data'));
		var listName = '('+row.find('td.vName').text()
		listName+=' * '+row.find('td.vDate').text();
		listName+=' * '+row.find('td.vDocType').text();
		listName+=' * '+row.find('td.vDocNum').text();
		listName+=')';
		$('.listLabel').text($('h2 .listLabel').text()+listName);

		console.log('view Received',data);
		
		if(parseInt(data.Receiving.status)){
			$('.post-button').attr('disabled','disabled');
		}else{
			$('.post-button').removeAttr('disabled');
		}
		currentReceiveId = data.Receiving.id;
		data = data.ReceivingDetail;
		var source = [];
		$.each(data, function(ctr,obj){
			var aggr={}; 
			aggr['div.data input']=$.toJSON(obj);
			aggr['div.itemcode input']=obj.item_code;
			aggr['div.desc input']=obj.name;
			aggr['div.qty input']=obj.qty;
			aggr['div.unit input']=obj.Unit.alias;
			aggr['div.pp input']=obj.purchase_price;
			aggr['div.amt input']=obj.amount;
			aggr['div.app input']=obj.avg_purchase_price;
			aggr['div.epp input']=obj.est_purchasing_price;
			aggr['div.csr input']=obj.current_selling_price;
			aggr['div.rsrp input']=obj.revise_srp;
			source.push(aggr);
			//console.log(aggr);
		});
		$('#receiving ul.recordDataGrid').trigger('clear_grid');
		$('#receiving ul.recordDataGrid').trigger('populate_grid',{'data':source});
		$('#receiving ul.recordDatagrid li.dynamicInput input').blur();
		$('#receiving ul.recordDatagrid li.mainInput').hide();
	});

	
	$('.editThis').live('click', function(){
		var row =$(this).parents('li:first');
		units = $('#units').html();
		//console.log(units);
		dataRow = $.parseJSON($(row).find('div.data input:first').val());
		console.log('dataRow',dataRow);
		var receivingId = dataRow.Receiving.id;
		var receivingDetailId = dataRow.id;
		var itemcode = row.find('div.itemcode input:first').val();
		var desc = row.find('div.desc input:first').val();
		console.log('desc:',desc);
		$.ajax({
					type:'POST',
					url:'/canteen/products/getByProductName',
					data:{'data':{'Product':{'name':desc}}},
					success:function(data){
						var json = $.parseJSON(data);
						console.log('json', json);
						var markup = json.Product.markup;
						var markUpUnit = json.Product.markup_unit;
						var avg_price = json.Product.avg_price;
						//console.log('status',typeof(json.Product.status),json.Product.status);
						
						
						if(!parseInt(json.Product.status)){
							old_qty = 0;
						}else{
							old_qty = json.Product.qty;
						}
						
						var qty = row.find('div.qty input:first').val();
						var pp = row.find('div.pp input:first').val();
						var amt = row.find('div.amt input:first').val();
						var capp = row.find('div.app input:first').val();
						var nepp = row.find('div.epp input:first').val();
						var csrp = row.find('div.csr input:first').val();
						var rsrp = row.find('div.rsrp input:first').val();

						var msg = '<div class="dgRC fwb">';
						msg+='<div class="fLeft w45 pt5">ItemCode:</div>';
						msg+='<div class="itemcode fRight w55"><input class="taRight numeric"  value="'+itemcode+'" readonly="readonly" disabled="disabled"/></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">Description:</div>';
						msg+='<div class="desc fRight w55"><input class="taRight" value="'+desc+'" readonly="readonly" disabled="disabled""/></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">Qty:</div>';
						msg+='<div class="qty fRight w55"><input class="taRight numeric" value="'+qty+'" old_qty="'+old_qty+'" /></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">Unit:</div>';
						msg+='<div class="unit fRight w55"> <select class="taRight" disabled="disabled">'+units+'</select></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">Purchase Price:</div>';
						msg+='<div class="pp fRight w55"><input class="taRight monetary numeric" value="'+pp+'" avg_price="'+avg_price+'"/></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">Amount:</div>';
						msg+='<div class="amt fRight w55"><input class="taRight monetary numeric" value="'+amt+'" readonly="readonly" disabled="disabled"/></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">CAPP:</div>';
						msg+='<div class="capp fRight w55"><input class="taRight monetary numeric" value="'+capp+'" readonly="readonly" disabled="disabled"/></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">NEPP:</div>';
						msg+='<div class="nepp fRight w55"><input class="taRight monetary numeric" value="'+nepp+'" readonly="readonly" disabled="disabled"/></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">CSRP:</div>';
						msg+='<div class="csrp fRight w55"><input class="taRight monetary numeric" value="'+csrp+'" readonly="readonly" disabled="disabled"/></div>';
						msg+='<div class="fClear"></div>';

						msg+='<div class="fLeft w45 pt5">RSRP:</div>';
						msg+='<div class="rsrp fRight w55"><input class="taRight monetary numeric" value="'+rsrp+'" markup="'+markup+'" markup-unit="'+markUpUnit+'" /></div>';
						msg+='<div class="fClear"></div>';

						msg+='</div>';

						
						var button = {};
						button.OK = function(){
							
							var itemcode = $('.dgRC .itemcode input:first').val();
							var name = $('.dgRC .desc input:first').val();
							var qty = $('.dgRC .qty input:first').val();
							var uniId = dataRow.Unit.id;
							var amt = $('.dgRC .amt input:first').val();
							var pp = $('.dgRC .pp input:first').val();
							var app = $('.dgRC .pp input:first').attr('avg_price');
							var csrp = $('.dgRC .csrp input:first').val();
							var rsrp = $('.dgRC .rsrp input:first').val();
							var epp = $('.dgRC .nepp input:first').val();
							
							$('#ReceivingDetailEditForm > #ReceivingDetailReceivingId').val(receivingId);
							$('#ReceivingDetailEditForm > #ReceivingDetailReceivingDetailId').val(receivingDetailId);
							$('#ReceivingDetailEditForm > #ReceivingDetailItemCode').val(itemcode);
							$('#ReceivingDetailEditForm > #ReceivingDetailName').val(name);
							$('#ReceivingDetailEditForm > #ReceivingDetailQty').val(qty);
							$('#ReceivingDetailEditForm > #ReceivingDetailUnitId').val(uniId);							
							$('#ReceivingDetailEditForm > #ReceivingDetailAmount').val(amt);
							$('#ReceivingDetailEditForm > #ReceivingDetailPurchasePrice').val(pp);
							$('#ReceivingDetailEditForm > #ReceivingDetailAvgPurchasePrice').val(app);
							$('#ReceivingDetailEditForm > #ReceivingDetailCurrentSellingPrice').val(csrp);
							$('#ReceivingDetailEditForm > #ReceivingDetailReviseSrp').val(rsrp);
							$('#ReceivingDetailEditForm > #ReceivingDetailEstPurchasingPrice').val(epp);
							
							$('#ReceivingDetailEditForm').ajaxSubmit({
								success:function(data){
									var returned = $.parseJSON(data);
									postOut(returned);
									
									row.find('div.qty input:first').val(qty);
									row.find('div.pp input:first').val(pp);
									row.find('div.amt input:first').val(amt);
									row.find('div.app input:first').val(app);
									row.find('div.epp input:first').val(epp);
									row.find('div.csr input:first').val(csrp);
									row.find('div.rsrp input:first').val(rsrp);
									row.find('input').blur();
									
								}
							
							});
							
							$(this).dialog('destroy');
						};
						button.CANCEL = function() {
							$(this).dialog('destroy');
						};
						$('#myDialog').trigger('pop-it', {
							'title':'Edit Receiving Detail',
							'msg': msg,
							'button': button,
							'modal': true
						});
						$('.dgRC .unit select').val(dataRow.Unit.id);
						
						
					}
		});
		
		
	});	

	$('.search_input').keypress(function(e){
		if(e.which==13){
			e.preventDefault();
		}
	});
	
	$('.post-button').click(function(){
		$.ajax({
			type: 'POST',       
			url: '/canteen/receivings/postToInventory/',          
			data:{'data':{'Receiving':{'post':currentReceiveId}}},
			success:function(data){
				$('#ReceivingAddForm').trigger('formNeat_sucess',{'data':data});
			}  
		});
	});
	
	$('.clear_button').click(function(){
		$('#search_results tbody').fadeOut('slow',function(){
			$('#search_results tbody').empty();
			$('.listLabel').text('List');
			$('#receiving .recordDatagrid').trigger('clear_grid');
			$('.search_input').val(''); 
		});
	});
	
	//dialog box controller
	$('.dgRC input, .dgRC select').livequery(function(){
		var input=$(this);
		$('.ui-dialog-buttonset button:first').hide();
		
		input.bind('blur', function(){
			var emptyField = $('div.dgRC select option[value="null"]:selected');
			emptyField = emptyField.length;
			var inputs = $('div.dgRC input');
			var emptyExist;
			
			console.log(inputs);
			$.each(inputs, function(ctr, input){
				//console.log($(input),$(input).val());
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
		
		});
		
		input.bind('focus', function(){
			$('.ui-dialog-buttonset button:first').hide();
		});
		
		if(input.parent().hasClass('qty') || input.parent().hasClass('pp')){
			input.bind('blur', function(){
				var qty = $('.dgRC .qty input').val();
				var pp = $('.dgRC .pp input').val();
				
				isNaN( parseFloat(pp)) ? pp=0.0 : pp=parseFloat(pp);
				isNaN(parseFloat(qty)) ? qty=0.0 : qty=parseFloat(qty);
				
				
				var amt = qty*pp;
				if(amt==0){
					amt='';
					$('.dgRC .amt input').val('');
				}else{
					$('.dgRC .amt input').val(amt).blur();
				}
				
				var old_qty = $('.dgRC .qty input:first').attr('old_qty');
				var new_qty =qty;
				var avg_p = $('.dgRC .pp input:first').attr('avg_price');
				var new_pp = pp;
				var emUnit=$('.dgRC .rsrp input:first').attr('markup-unit');
				var em=$('.dgRC .rsrp input:first').attr('markup');
				
				$('.dgRC .nepp input:first').val(computeNEPP(old_qty, new_qty, avg_p, new_pp)).blur(); //setting nepp
				if(emUnit=='%'){
					esrp = pp*(em/100)+pp;
				}else{
					esrp=pp+em;
				}
				
				isNaN(esrp) ? esrp=0.0 : esrp=parseFloat(esrp);
				if(esrp==0){
					esrp='';
					$('.dgRC .rsrp input').val('');
				}else{
					$('.dgRC .rsrp input').val(esrp).blur();
				}
			});
		}
	});
});