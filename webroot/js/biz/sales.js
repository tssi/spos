$(document).ready(function(e){
	var MODE = 'CS'; // if (CS) Cash Sale, (PR)Prepaid or (CH)Charge
	var RECORD_SPEED = 'slow';
	var DEF_QTY = 1;
	var DEF_MONEY = 0.00;
    var TODAY = new Date();
	var month = TODAY.getMonth() + 1;
	var day = TODAY.getDate();
	var year = TODAY.getFullYear();
	var commit =13;
	var DONE =121;
	var ESC =27;
	var F7 =118;
	var F8 =119;
	var F9 =120;
	var creditLimit=0;
	var allowCashiering = false;
	var allowKey = false;
	var paymentType=[];
	var saveFlag =true;
	var byPass =false;
	var proceedCharge =false;
    TODAY = year+'-'+month+'-'+day;
	
	$('.trans').hide();
	
	//Add a clickInput class when grid_populated is fired
	$('#counterItems_ui ul.recordDataGrid').livequery(function(){
		var THIS = this;
		$(THIS).bind('grid_populated',function(){
			$(THIS).find('li.dynamicInput').addClass('clickInput');
		});
	});
	
	//Respond when clickInput is clicked
	$('#counterItems ul.recordDatagrid li.clickInput').live('clicked',function(evt,args){
		if (allowCashiering){
			var data = [];
			var obj = args.obj;
			var qty = $('#qty').val();
			var amount = ssUtil.roundNumber(obj['div.price input']*qty,2);    
			obj['div.qty input']=qty;
			obj['div.amount input'] = amount;
			data.push(obj);		
			if($('.picker input.selected').length){
				$('#itemsSold ul.recordDataGrid').trigger('populate_grid',{'data':data});//Populate #itemsSold list with the collected data
				$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
			}
			else{
				dialog_box();
				$('#dialog').html('Select Payment Type');
			} 
			$('#done_button').removeAttr("disabled","disabled").parent().parent().addClass('topaz');
			$('#qty').val(1);
			$('#description').blur().focus();
			$('#description').select();
		}else{
			if(MODE=='CH'){
				$('#dialog').dialog({
					title:'Notification',
					modal:true,
					closeOnEscape: false,
					open: function(event, ui){
					
					$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
					buttons:{Back:function(e, a){
						$(this).dialog('destroy');
						$('#SaleBuyer').focus();
						
					}}
				});
				$('#dialog').html('<center>Enter Valid Id first!!!</center>');
				
			}
			if(MODE=='CS'){
				$('#dialog').dialog({
					title:'Notification',
					modal:true,
					closeOnEscape: false,
					open: function(event, ui){
					
					$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
					buttons:{Back:function(e, a){
						$(this).dialog('destroy');						
					}}
				});
				$('#dialog').html('<center><strong>Select Mode first!</strong><br/>(Cash, Charge, or Prepaid)</center>');
			
			}
		}
	});
	
	//Listen to update_grid and grid_populated then fire auto_compute event
	$('#itemsSold ul.recordDatagrid').live('update_grid',function(){
		$('#total').trigger('auto_compute');
	}).live('grid_populated',function(){
		$('#total').trigger('auto_compute');
	});
	
	//Computes the total automatically
	$('#total').bind('auto_compute', function() {
		var total= 0;
		var list = $('#itemsSold ul.recordDataGrid li.dynamicInput');
		list.each(function(ctr,obj){
			var amount= parseFloat($(obj).find('div.amount input').val());
			total+=amount;
		});
		$('#total').val(ssUtil.roundNumber(total,2));
        $('#qty').trigger('default');
		
		if(MODE=='CH'){ //In Charge Mode, if the accumulating total is greater than credit limit prompt to add cash 
			$('#description').blur();
			var charge = ssUtil.roundNumber(creditLimit,2);
			if(total>creditLimit){
				$('#dialog').dialog({
					title:'Notification',
					modal:true,
					closeOnEscape: false,
					open: function(event, ui){
						$(this).parent().children().children(".ui-dialog-titlebar-close").hide();// Hide close button
					},
					buttons:{
						'CONTINUE':function(){
							$(this).dialog('destroy');
							
							var addCash = ssUtil.roundNumber(total-creditLimit,2);
							var paymentCharge ={};
							var paymentCash ={};
							paymentType=[];
							paymentCharge['SalesPayment']={};
							paymentCharge['SalesPayment']['payment_type_id']=3;
							paymentCharge['SalesPayment']['amount']=charge;
							
							paymentCash['SalesPayment']={};
							paymentCash['SalesPayment']['payment_type_id']=1;
							paymentCash['SalesPayment']['amount']=addCash;
							paymentType.push(paymentCharge);
							paymentType.push(paymentCash);
							$('#charge').val(ssUtil.roundNumber(creditLimit,2)).attr('readonly','readonly');
							$('#added_cash').val(addCash);
							//$('.forSale').show();
							$('#SalePayment').val($.toJSON(paymentType));
							//$('#description').focus();
							//saveFlag =false;
							
						},
						'CANCEL':function(){
							$(this).dialog('destroy');
							$('#itemsSold .recordDatagrid li:last').remove();
							$('#total').trigger('auto_compute');
						}
					}
				});
				$('#dialog').html('<center><br/><img src="/canteen/img/icons/exclamation.png" /><br/><br/><strong> Exceeded credit limit!<br/>Do you want to continue?</strong><br/><br/></center>');
				//$('.ui-dialog-buttonset button:first').focus();	
								
			}else{
				//.select();
				$('#charge').val(ssUtil.roundNumber(total,2));
				var paymentCharge ={};
				paymentType=[];
				paymentCharge['SalesPayment']={};
				paymentCharge['SalesPayment']['payment_type_id']=3;
				paymentCharge['SalesPayment']['amount']=charge;
				paymentType.push(paymentCharge);			
				$('#SalePayment').val($.toJSON(paymentType));
			}
			
			////console.log(paymentType);
		}
		if(MODE=='CS'){
			var paymentCash ={};
			paymentCash['SalesPayment']={};
			paymentCash['SalesPayment']['payment_type_id']=1;
			paymentCash['SalesPayment']['amount']=parseFloat($('#total').val());
			paymentType = [];
			paymentType.push(paymentCash);
			$('#SalePayment').val($.toJSON(paymentType));
			
		}
		if(MODE=='PR'){
			$('#description').blur();
			var prepaid = ssUtil.roundNumber(creditLimit,2);
			////console.log(creditLimit);
			if(total>creditLimit){
				$('#dialog').dialog({
					title:'Notification',
					modal:true,
					closeOnEscape: false,
					open: function(event, ui){
						$(this).parent().children().children(".ui-dialog-titlebar-close").hide();// Hide close button
					},
					buttons:{
							'CONTINUE':function(){
								$(this).dialog('destroy');
								
								var addCash = ssUtil.roundNumber(total-creditLimit,2);
								var paymentPrepaid ={};
								var paymentCash ={};
								paymentType=[];
								paymentPrepaid['SalesPayment']={};
								paymentPrepaid['SalesPayment']['payment_type_id']=2;
								paymentPrepaid['SalesPayment']['amount']=prepaid;
								
								paymentCash['SalesPayment']={};
								paymentCash['SalesPayment']['payment_type_id']=1;
								paymentCash['SalesPayment']['amount']=addCash;
								paymentType.push(paymentPrepaid);
								paymentType.push(paymentCash);
								$('#prepaid').val(ssUtil.roundNumber(creditLimit,2)).attr('readonly','readonly');
								$('#added_cash').val(addCash);
								//$('.forSale').show();
								$('#SalePayment').val($.toJSON(paymentType));
								//$('#description').focus();
								//saveFlag =false;
								
							},
							'CANCEL':function(){
								$(this).dialog('destroy');
								$('#itemsSold .recordDatagrid li:last').remove();
								$('#total').trigger('auto_compute');
							}
					}
				});
				$('#dialog').html('<center><br/><img src="/canteen/img/icons/exclamation.png" /><br/><br/><strong> Exceeded prepaid limit!<br/>Do you want to continue?</strong><br/><br/></center>');
				//$('.ui-dialog-buttonset button:first').focus();	
								
			}else{
				//.select();
				$('#charge').val(ssUtil.roundNumber(total,2));
				var paymentPrepaid ={};
				paymentType=[];
				paymentPrepaid['SalesPayment']={};
				paymentPrepaid['SalesPayment']['payment_type_id']=3;
				paymentPrepaid['SalesPayment']['amount']=charge;
				paymentType.push(paymentPrepaid);			
				$('#SalePayment').val($.toJSON(paymentType));
			}
			
			////console.log(paymentType);
		}
	
	});
    
	
    $('#description').keyup(function(e,a){
       var keyHit = e.which;
       var matched = $("#counterItems [style*='display: block']");
       var desc = !$.trim($('#description').val()) =='';  
       if (keyHit==13){
            if (matched.length==1){
				////console.log(matched);
                if(desc){
                    matched.click();
                    $('#description').val('');
                }
				
            }else{//if no match on the item code
				$('#description').val('').focus();
				if(desc){
					$('#dialog').dialog({
						title:'Warning',
						modal:true,
						closeOnEscape: true,
						open: function(event, ui){
						$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
						buttons:{
							Back:function(e, a){
								$(this).dialog('destroy');
								$('#description').focus();
							}
						}
					});
					$('#dialog').html('No match found!');
				}
				
				
				
			}      
       }
    });
	
	//onEnter on amount received
	$("#amount_received").keypress(function(e,a){
		if(e.which==commit){
			$("#amount_received").trigger('blur');
		
		};
	});
	
	$('#qty').keypress(function(e,o){
		if(e.which==13){
			$('#description').select();
		
		}
	
	});
	
	//Validation for amount receive
	 $("#amount_received").blur(function(){
		if (MODE =='CS'){
			var total = parseFloat($('#total').val());
			var amount_received = parseFloat($("#amount_received").val());
			var change = parseFloat(amount_received - total);
			if(!isNaN(amount_received)){
				$('#amount_received').val(ssUtil.roundNumber(amount_received,2));
				if(amount_received < total){
					$('#amount_received').addClass('bgNone').addClass('b1sCheri').addClass('bgCheri');
					$('#save_button').attr('disabled','disabled');
					dialog_box(this);
					$('#dialog').html('Insufficient amount received...');
				}else{
					$('#amount_received').removeClass('bgNone').removeClass('b1sCheri').removeClass('bgCheri');
					var change_txt = ssUtil.roundNumber(change,2);
					if(change<1 && change>0){
						change_txt = '0'+change_txt;
					}else{
						$('#change').val(change_txt);
					}
					$('#save_button').removeAttr('disabled','').parent().parent().addClass('topaz');
				}
			}
		}
		if (MODE =='CH'){
			var totalAddedCash = parseFloat($('#added_cash').val());
			var amount_received = parseFloat($("#amount_received").val());
			var change = parseFloat(amount_received - totalAddedCash);
			if(!isNaN(amount_received)){
				$('#amount_received').val(ssUtil.roundNumber(amount_received,2));
				if(amount_received < totalAddedCash){
					$('#amount_received').addClass('bgNone').addClass('b1sCheri').addClass('bgCheri');
					$('#save_button').attr('disabled','disabled');
					dialog_box(this);
					$('#dialog').html('Insufficient amount received...');
					
				}else{
					$('#amount_received').removeClass('bgNone').removeClass('b1sCheri').removeClass('bgCheri');
					var change_txt = ssUtil.roundNumber(change,2);
					if(change<1 && change>0){
						change_txt = '0'+change_txt;
					}else{
						$('#change').val(change_txt);
					}
					var paymentCharge ={};
					var paymentCash ={};
					paymentType=[];
					paymentCharge['SalesPayment']={};
					paymentCharge['SalesPayment']['payment_type_id']=3;
					paymentCharge['SalesPayment']['amount']=parseFloat($('#charge').val());
					
					paymentCash['SalesPayment']={};
					paymentCash['SalesPayment']['payment_type_id']=1;
					paymentCash['SalesPayment']['amount']=parseFloat($('#added_cash').val());
					paymentType.push(paymentCharge);
					paymentType.push(paymentCash);
					proceedCharge = true;
					$('#SalePayment').val($.toJSON(paymentType));
					$('#save_button').removeAttr('disabled','').parent().parent().addClass('topaz');
				}
			}
		}
		if (MODE =='PR'){
			var totalAddedCash = parseFloat($('#added_cash').val());
			var amount_received = parseFloat($("#amount_received").val());
			var change = parseFloat(amount_received - totalAddedCash);
			if(!isNaN(amount_received)){
				$('#amount_received').val(ssUtil.roundNumber(amount_received,2));
				if(amount_received < totalAddedCash){
					$('#amount_received').addClass('bgNone').addClass('b1sCheri').addClass('bgCheri');
					$('#save_button').attr('disabled','disabled');
					dialog_box(this);
					$('#dialog').html('Insufficient amount received...');
					
				}else{
					$('#amount_received').removeClass('bgNone').removeClass('b1sCheri').removeClass('bgCheri');
					var change_txt = ssUtil.roundNumber(change,2);
					if(change<1 && change>0){
						change_txt = '0'+change_txt;
					}else{
						$('#change').val(change_txt);
					}
					var paymentPrepaid ={};
					var paymentCash ={};
					paymentType=[];
					paymentPrepaid['SalesPayment']={};
					paymentPrepaid['SalesPayment']['payment_type_id']=2;
					paymentPrepaid['SalesPayment']['amount']=parseFloat($('#prepaid').val());
					
					paymentCash['SalesPayment']={};
					paymentCash['SalesPayment']['payment_type_id']=1;
					paymentCash['SalesPayment']['amount']=parseFloat($('#added_cash').val());
					paymentType.push(paymentPrepaid);
					paymentType.push(paymentCash);
					proceedCharge = true;
					$('#SalePayment').val($.toJSON(paymentType));
					$('#save_button').removeAttr('disabled','').parent().parent().addClass('topaz');
				}
			}
		}
	});
	
	//Cash Button Validation
	$('#cash_button').click(function(){
		$('#prepaid_button').attr("disabled","disabled").parent().parent().removeClass('ruby');
		$('#charge_button').attr("disabled","disabled").parent().parent().removeClass('sapphire');
		$('#cash_button').removeAttr("disabled").parent().parent().addClass('emerald');
		MODE = 'CS';
		$('.omnibox').parent().find('label').html('Buyer');
		$('#SaleBuyer').val('Cash Sale');
		$('#SaleName').val('');
		$('.trans').show();
		$('.forSale').show();
		$('#qty').val(DEF_QTY).focus();
		$('#description').focus();
		$('#SalePaymentTypeId option:contains("CASH")').selected();
		$('.forCharge, .forPrepaid').hide();
		allowCashiering = true;
		
	});
	
	//Charge
	$('#charge_button').click(function(){
		$('#prepaid_button').attr("disabled","disabled").parent().parent().removeClass('ruby');
		$('#cash_button').attr("disabled","disabled").parent().parent().removeClass('emerald');
		MODE = 'CH';
		var htm = '<select id="by" name="data[Sale][category]"><option value="E">Emp</option><option value="S">Stud</option></select>';
		$('.omnibox').parent().find('label').html(htm);
		$('.trans').show();
		$('.forCharge').show();
		$('.forPrepaid').hide();
		$('.forSale').hide();
		$('.cash_added').hide();
		$('#SalePaymentTypeId option:contains("CHAR")').selected();
		allowCashiering = false;
		$('#SaleBuyer').val('').focus();
		$('#by').blur();
	});
	
	//Prepaid
	$('#prepaid_button').click(function(){
		MODE = 'PR';
		$('#cash_button').attr("disabled","disabled").parent().parent().removeClass('emerald');
		$('#charge_button').attr("disabled","disabled").parent().parent().removeClass('sapphire');
		var htm ='<select id="by"><option value="E">Emp</option><option value="S">Stud</option></select>';
		$('.omnibox').parent().find('label').html(htm);
		$('.trans').show();
		$('.forCharge').hide();
		$('.forSale').hide();
		$('.cash_added').hide();
		$('#SalePaymentTypeId option:contains("PREP")').selected();
		allowCashiering = false;
		$('#SaleBuyer').val('').focus();
		$('#by').blur();
	});
	
	//per transaction 
	$('.omnibox').keypress(function(e){
		if(e.which==13){ 
			if (MODE =='CH'){
				var empID = $.trim($('.omnibox').val());
				if(empID!=""){
					$.ajax({
						url:'/canteen/charge201s/checkCharges/'+$('#by').val()+'/'+empID,
						type:'POST',
						beforeSend:function(){
							$('#SaleName').val('');
							$('#dialog').dialog({
								title:'Notification',
								modal:true,
								closeOnEscape: false,
								open: function(event, ui){
								
								$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
								buttons:{}
							});
							$('#dialog').html('<center><br/><img src="/canteen/img/icons/loader.gif"><br/><br/><strong> Checking ID...</strong><br/><br/></center>');
						
						},
						dataType:"json",
						success:function(z){
							$('#dialog').dialog('destroy');
							var exist=false;
							if(z.Buyer.Employee){
								try{
									$('#SaleName').val(z.Buyer.Employee.full_name);
									creditLimit=z.SopCgeVal['0'].amount_balance;
									exist=true;
								}catch(e){
									$('#dialog').dialog({
										title:'Notification',
										modal:true,
										closeOnEscape: false,
										open: function(event, ui){
										
										$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
										buttons:{
										'Back':function(){
												$(this).dialog('destroy');
												$('#SaleBuyer').select();
												
											}
										}
									});
									$('#dialog').html('<center><br/><br/><strong> Insufficient Balance to proceed..</strong><br/><br/></center>');
									
								}
							}else{
								if(z.Buyer.Student){
									try{
										$('#SaleName').val(z.Buyer.Student.FullName);
										creditLimit=z.SopCgeVal['0'].amount_balance;
										exist=true;
									}catch(e){
										$('#dialog').dialog({
										title:'Notification',
										modal:true,
										closeOnEscape: false,
										open: function(event, ui){
										
										$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
										buttons:{
										'Back':function(){
												$(this).dialog('destroy');
												$('#SaleBuyer').select();
												
											}
										}
									});
									$('#dialog').html('<center><br/><br/><strong> Insufficient Balance to proceed..</strong><br/><br/></center>');
									
									}
								}else{
									creditLimit=0;
									$('#dialog').dialog({
										title:'Notification',
										modal:true,
										closeOnEscape: false,
										open: function(event, ui){
										
										$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
										buttons:{
										'Back':function(){
												$(this).dialog('destroy');
												$('#SaleBuyer').select();
												
											}
										}
									});
									$('#dialog').html('<center><br/><br/><strong> ID, Not Existing!!</strong><br/><br/></center>');
								
								}
							}
							
							if(exist){
								////console.log(creditLimit);
								if(creditLimit > 0){
									allowCashiering = true;
								}else{
									allowCashiering = false;
								}
							
								$('#qty').val(DEF_QTY).focus();
								$('#description').focus();
							}
						},
						error:function(){
							$('#dialog').dialog({
								title:'Notification',
								modal:true,
								closeOnEscape: false,
								open: function(event, ui){
									$(this).parent().children().children(".ui-dialog-titlebar-close").hide();// Hide close button
								},
								buttons:{
										'Back':function(){
											$(this).dialog('destroy');
										}
								}
							});
							$('#dialog').html('<center><br/><img src="/canteen/img/icons/loader.gif"><br/><br/><strong> Checking ID...</strong><br/><br/></center>');
						
						}
					});
				}else{
					$('#dialog').dialog({
								title:'Notification',
								modal:true,
								closeOnEscape: false,
								open: function(event, ui){
									$(this).parent().children().children(".ui-dialog-titlebar-close").hide();// Hide close button
								},
								buttons:{
										'Back':function(){
											$(this).dialog('destroy');
											$('#SaleBuyer').focus();
										}
								}
							});
							$('#dialog').html('<center><br/><br/><strong>ID needed!</strong><br/><br/></center>');
						
				
				
				}
			}
			if (MODE =='PR'){
				var empID = $.trim($('.omnibox').val());
				if(empID!=""){
					$.ajax({
						url:'/canteen/prepaid201s/checkCharges/'+$('#by').val()+'/'+empID,
						type:'POST',
						beforeSend:function(){
							$('#SaleName').val('');
							$('#dialog').dialog({
								title:'Notification',
								modal:true,
								closeOnEscape: false,
								open: function(event, ui){
								
								$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
								buttons:{}
							});
							$('#dialog').html('<center><br/><img src="/canteen/img/icons/loader.gif"><br/><br/><strong> Checking ID...</strong><br/><br/></center>');
						
						},
						dataType:"json",
						success:function(z){
							$('#dialog').dialog('destroy');
							var exist=false;
							////console.log(z);
							if(z.Buyer.Employee){
								try{
									$('#SaleName').val(z.Buyer.Employee.full_name);
									creditLimit=z.SopPpVal['0'].amount_balance;
									exist=true;
								}catch(e){
									$('#dialog').dialog({
										title:'Notification',
										modal:true,
										closeOnEscape: false,
										open: function(event, ui){
										
										$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
										buttons:{
										'Back':function(){
												$(this).dialog('destroy');
												$('#SaleBuyer').select();
												
											}
										}
									});
									$('#dialog').html('<center><br/><br/><strong> Insufficient Balance to proceed..</strong><br/><br/></center>');
									
								}
							}else{
								if(z.Buyer.Student){
									try{
										$('#SaleName').val(z.Buyer.Student.FullName);
										creditLimit=z.SopPpVal['0'].amount_balance;
										exist=true;
									}catch(e){
										$('#dialog').dialog({
										title:'Notification',
										modal:true,
										closeOnEscape: false,
										open: function(event, ui){
										
										$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
										buttons:{
										'Back':function(){
												$(this).dialog('destroy');
												$('#SaleBuyer').select();
												
											}
										}
									});
									$('#dialog').html('<center><br/><br/><strong> Insufficient Balance to proceed..</strong><br/><br/></center>');
									
									}
								}else{
									creditLimit=0;
									$('#dialog').dialog({
										title:'Notification',
										modal:true,
										closeOnEscape: false,
										open: function(event, ui){
										
										$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
										buttons:{
										'Back':function(){
												$(this).dialog('destroy');
												$('#SaleBuyer').select();
												
											}
										}
									});
									$('#dialog').html('<center><br/><br/><strong> ID, Not Existing!!</strong><br/><br/></center>');
								
								}
							}
							
							if(exist){
								////console.log(creditLimit);
								if(creditLimit > 0){
									allowCashiering = true;
								}else{
									allowCashiering = false;
								}
							
								$('#qty').val(DEF_QTY).focus();
								$('#description').focus();
							}
						},
						error:function(){
							$('#dialog').dialog({
								title:'Notification',
								modal:true,
								closeOnEscape: false,
								open: function(event, ui){
									$(this).parent().children().children(".ui-dialog-titlebar-close").hide();// Hide close button
								},
								buttons:{
										'Back':function(){
											$(this).dialog('destroy');
										}
								}
							});
							$('#dialog').html('<center><br/><img src="/canteen/img/icons/loader.gif"><br/><br/><strong> Checking ID...</strong><br/><br/></center>');
						
						}
					});
				}else{
					$('#dialog').dialog({
								title:'Notification',
								modal:true,
								closeOnEscape: false,
								open: function(event, ui){
									$(this).parent().children().children(".ui-dialog-titlebar-close").hide();// Hide close button
								},
								buttons:{
										'Back':function(){
											$(this).dialog('destroy');
											$('#SaleBuyer').focus();
										}
								}
							});
							$('#dialog').html('<center><br/><br/><strong>ID needed!</strong><br/><br/></center>');
						
				
				
				}
			}
		}
	
	});
	
	//Done button
	$('#done_button').click(function(){
		////console.log('done');
		var total = $('#total').val();
		if($('#save_button').attr('disabled')){ //if save button is disabled
			if(!$('#done_button').attr('disabled')){
				$('#description').blur();
				$('#amount_received').focus();
				
				if(MODE=='CH'){
					//$('#charge').val(total).blur();
					$('#charge').removeAttr('readonly').select();
				}
				if(MODE=='CS'){
					$('#amount_received').removeAttr('readonly').val('').focus();
					$('#save_button').attr('disabled','disabled').parent().parent().removeClass('topaz');
				}
				if(MODE=='PR'){
					//$('#charge').val(total).blur();
					$('#prepaid').removeAttr('readonly').select();
				}
			}
			
		}
		$('#done_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
	});
	saving
	$('#SaleAddForm').bind('formNeat_sucess',function(evt,args){
	
		var data= $.parseJSON(args.data);
		var invoice_no = data.data.Sale.id;
		$('#invoice_no').val(invoice_no);
		$('#dialog').dialog({
			title:'Warning',
			modal:true,
			closeOnEscape: false,
			open: function(event, ui){$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button		
			buttons:{
				Yes:function(){
					
					$('#print_invoice').submit();
					
					
					$(document).trigger('restore_defaults');
					$(this).dialog('destroy');
					},
				No:function(){
					
					
					$(document).trigger('restore_defaults');
					$(this).dialog('destroy');
					//$('#notify').html('Transaction has been saved!').addClass('bgCheri').addClass('b1sCheri').fadeIn('slow').delay(2500).fadeOut('slow');
					}
				
			}
		});
		$('#dialog').html('Print Receipt?');
		$('.ui-dialog-buttonset button:contains("No")').focus();
		//$('#dialog').focus();
		//$(document).trigger('restore_defaults');
	}); 
	
	$('#by').live('change',function(){
		$('#SaleName').val('');
		$('#SaleBuyer').val('').focus();
	});
	
	$('#by').live('blur',function(){
		$('#categoryIs').val($(this).val());
	});
	
	//Cancel 
	$("#cancel_button").click(function(){
		$(document).trigger({'type':'keydown','which':ESC});
	});

 	//Restore Default
	$(document).bind('restore_defaults', function() {
		allowCashiering = false;

	//Printing and 		$('.trans').hide(); //transactions hide
		$('#SalePaymentTypeId input').removeClass('selected');
		$('.recordDatagrid li.mainInput').hide(); 
		$('#prepaid_button').removeAttr("disabled").parent().parent().addClass('ruby');
		$('#charge_button').removeAttr("disabled").parent().parent().addClass('sapphire');
		$('#cash_button').removeAttr("disabled").parent().parent().addClass('emerald');
		$('#total').val(ssUtil.roundNumber(DEF_MONEY,2));
		$('#amount_received').val(ssUtil.roundNumber(DEF_MONEY,2)).attr('readonly','readonly');
		$('#change').val(ssUtil.roundNumber(DEF_MONEY,2));
		$("#counterItems").empty().html($("#counterItems_ui .iscrollWrapper").clone());
		$('#done_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
		$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');;
		$('#charge').val('');
		
		//Clean Item Sold column
		$('#itemsSold ul.recordDatagrid li.dynamicInput').fadeOut(RECORD_SPEED,function(){
			$('#itemsSold ul.recordDatagrid li.dynamicInput').remove();
		});

        var obj = {};
        $.each($('#counterItems_ui ul.recordDataGrid li'),function(e,a){
            var id = 'li-'+e;
            var key=$(a).find('.desc input').val()+$(a).find('.item_code input').val();
            $(a).attr('id',id);
            obj[key]='#'+id;
        });
		
		$("#counterItems ul.recordDataGrid").empty();
		obj = ssUtil.sortObject(obj);
        $.each(obj, function(i,o){
			$("#counterItems ul.recordDataGrid").append($(o).clone());
		});
		
		$('#SaleBuyer, #SaleName').val('');
	}); 
	
	//Initialize couterItems by fetching an ajax request to server
	$.ajax({
		url:'/canteen/products/findItem/ALL',
		dataType:'json',
		beforeSend:function(){
				var msg = "<br/><center><img src='/canteen/img/icons/loader.gif'><br/><br/><strong>Loading Products..</strong></center>";
				var button = {};
				$('#myDialog').trigger('pop-it', {
					'title': 'Notification',
					'msg': msg,
					'button': button,
					'modal': true
				});
		},
		success:function(data){
			var source = [];
			//Prepare data structure
			$.each(data, function(ctr,obj){
			////console.log(data);
				if(obj.Product){
					var desc= obj.Product.name;
					var price = obj.Product.selling_price;
					var code = obj.Product.item_code;
				}else{
					var desc= obj.Perishable.name;
					var price = obj.Perishable.selling_price;
					var code = obj.Perishable.item_code;
				}
				var aggr={};           
					aggr['div.desc input']=desc;
					aggr['div.price input']=ssUtil.roundNumber(price,2);
					aggr['div.item_code input']=code;
				source.push(aggr);  
			});
			// //console.log(source);
			 
			$('#counterItems_ui ul.recordDataGrid').trigger('populate_grid',{'data':source,'new_class':['dynamicInput','clickInput','productItem']});
			
			//Pass data to populate_grid event
			$.getJSON(ssUtil.cch_brk('/canteen/daily_menus/findDailyMenu/'+TODAY+''),
				function(data){
				  source = [];
				  ////console.log(data);
				  ////console.log(data.length);
				  if(data.length>0){
					  $.each(data, function(ctr,obj){
						  var desc= obj.MenuItem.name;
						  var price = obj.DailyMenu.selling_price;
						  var code = obj.MenuItem.item_code;
						  var aggr={};
						  aggr['div.desc input']=desc;
						  aggr['div.price input']=ssUtil.roundNumber(price,2);
						  aggr['div.item_code input']=code;
						  source.push(aggr);
					  });
					  
					  $('#counterItems_ui ul.recordDataGrid').trigger('populate_grid',{'data':source});
						//$('#qty').trigger('default');
						$(document).trigger('restore_defaults');
						allowKey = true;
					}else{
							$('#dialog').dialog('destroy');
							$('#dialog').dialog({
									title:'Notification',
									modal:true,
									closeOnEscape: false,
									open: function(event, ui){$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button		
									buttons:{
										OK:function(){
												$(this).dialog('destroy');
											}
										}
								});
							$('.ui-widget-overlay').css('opacity','.2');
							$('#dialog').html('<center>No Menu For Day Set!</center>');
							allowKey = true;
							$(document).trigger('restore_defaults');
							//$('.ui-dialog-buttonset button:first').focus();
							
					}
				  });
		}
	
	});  
	
	//delete dataGrid
	$('.recordDatagrid a.recordDelete').live('clicked',function(evt,args){
		$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
	}); 
	
	//Shorcut key designation
	$(document).keydown(function(e){
		console.log(e);
		if(allowKey){
			if(e.which==DONE){ //If F10 is hit
				$('#done_button').click();
			}
			if(e.which==ESC){ //if Esc is hit
				$('#description').blur();
				if (MODE=='CH'){
					$('#SaleBuyer, #SaleName').val('');
				}
				$(document).trigger('restore_defaults');
			}

			if(e.which==F7){
				$(document).trigger('restore_defaults');
				$('#cash_button').click();
			}
			if(e.which==F8){
				$(document).trigger('restore_defaults');
				$('#prepaid_button').click();
			}
			
			if(e.which==F9){
				$(document).trigger('restore_defaults');
				$('#charge_button').click();
			}
		}
	
		if(e.which==commit){ //if Enter is hit
			////console.log('saveFlag: ',saveFlag);
			if(saveFlag){
				if(!($('#save_button').attr('disabled'))){
					if (MODE=='CS'){
						$('#amount_received').blur();
						if(!($('#save_button').attr('disabled'))){
							$('#description').blur();
							$('#save_button').trigger('click');
							$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
						}else{
							$('#amount_received').focus();
						}
					}
					if (MODE=='CH'){
						////console.log('keydown enter');
						if(!($('#save_button').attr('disabled'))){
							$('#description').blur();
							$('#save_button').trigger('click');
							$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
						}
					}
					if (MODE=='PR'){
						////console.log('keydown enter');
						if(!($('#save_button').attr('disabled'))){
							$('#description').blur();
							$('#save_button').trigger('click');
							$('#save_button').attr("disabled","disabled").parent().parent().removeClass('topaz');
						}
					}
					
				}
			}
		}
			
	});
	
	$('#qty').blur(function(){
		if($(this).val()==''){
			$(this).val(1);
		}
	});
	
	$('#save_button').bind('click', function(){
		$(this).attr('disabled','disabled');
	});
	
	$('#charge').live('focus',function(){
		$('#save_button').attr('disabled', 'disabled').parent().parent().removeClass('topaz');
	});
	
	$('#charge').live('blur',function(){
		var thisInput = $(this);
		var chargeAmt = parseFloat($('#charge').val());
		var due = parseFloat($('#total').val());
		
		if(chargeAmt>due){
			$('#charge').val(due)
		}
		if(chargeAmt>creditLimit){
			$('#charge').val(creditLimit);
		}
		
		thisValue = $(this).val();
		$(this).val(ssUtil.roundNumber($(this).val(),2));
		
		
	});
		
	$('#charge').live('keydown', function(e){
		if(e.which == commit){
			////console.log('charge keydown on enter!!');
			$('#charge').blur();
			charge_validate();
		}
	});
	
	$('#prepaid').live('focus',function(){
		$('#save_button').attr('disabled', 'disabled').parent().parent().removeClass('topaz');
	});
	
	$('#prepaid').live('blur',function(){
		var prepaidAmt = parseFloat($('#prepaid').val());
		var due = parseFloat($('#total').val());
		
		if(prepaidAmt>due){
			$('#prepaid').val(due)
		}
		if(prepaidAmt>creditLimit){
			$('#prepaid').val(creditLimit);
		}
		
		thisValue = $(this).val();
		$(this).val(ssUtil.roundNumber($(this).val(),2));
		
		
	});
	
	$('#prepaid').live('keydown', function(e){
		if(e.which == commit){
			////console.log('prepaid keydown on enter!!');
			$('#prepaid').blur();
			charge_validate();
		}
	});
	
	function charge_validate(){ //on charge validation
		////console.log('charge validate');
		if(MODE=='CH'){
			////console.log('charge');
			var chargeAmt = parseFloat($('#charge').val());
			var due = parseFloat($('#total').val());
			
			if(chargeAmt>due){//if input charge is greater than what it must be set it to due
				$('#charge').val(due)
			}
			
			if(!isNaN(chargeAmt)||!isNaN(due)){ //if all have values
				
				if(chargeAmt<=creditLimit){ // if charge is within the bounds of credit balance
						if(!byPass){ //
							////console.log('if(chargeAmt<=creditLimit)');
							if(chargeAmt < due){ //if not full credit
								$('#dialog').dialog({
									title:'Notification',
									modal:true,
									closeOnEscape: false,
									open: function(event, ui){
									
									$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
									buttons:{
										'CONTINUE':function(){
											$(this).dialog('destroy');
											
											$('.cash_added').show();
											$('.forSale').show();
											$('#charge').attr('readonly','readonly').val(ssUtil.roundNumber($('#charge').val(),2));
											$('.cash_added input').attr('readonly','readonly').val(ssUtil.roundNumber(due-chargeAmt,2));
											//$('#save_button').removeAttr('disabled').parent().parent().addClass('topaz');
											byPass = true;
											$('#amount_received').removeAttr('readonly').select();
										},
										'CANCEL':function(){
											$(this).dialog('destroy');
										}
									}
								});
								$('#dialog').html('<center><strong>Insufficient amount..!!</strong></center>');
								$('.ui-widget-overlay').css('opacity','.2');
								$('.ui-dialog-buttonset button:first').focus();
							}
							if(chargeAmt == due){
								$('#charge').blur();
								$('#save_button').removeAttr('disabled').parent().parent().addClass('topaz');
								////console.log('chargeAmt == due');
								saveFlag =true;
							}
						}else{
							byPass = false;
							////console.log('inside bypass');
						}
					}else{
						
						$('#dialog').dialog({
							title:'Notification',
							modal:true,
							closeOnEscape: false,
							open: function(event, ui){
								$(this).parent().children().children(".ui-dialog-titlebar-close").hide();// Hide close button
							},
							buttons:{
									'CONTINUE':function(){
										$(this).dialog('destroy');
										
										var addCash = ssUtil.roundNumber(total-creditLimit,2);
										var paymentCharge ={};
										var paymentCash ={};
										paymentType=[];
										paymentCharge['SalesPayment']={};
										paymentCharge['SalesPayment']['payment_type_id']=3;
										paymentCharge['SalesPayment']['amount']=chargeAmt;
										
										paymentCash['SalesPayment']={};
										paymentCash['SalesPayment']['payment_type_id']=1;
										paymentCash['SalesPayment']['amount']=addCash;
										
										paymentType.push(paymentCharge); //push charge 
										paymentType.push(paymentCash); // push payment
										
										$('#charge').val(ssUtil.roundNumber(creditLimit,2));
										$('#added_cash').val(addCash);
										$('.forSale').show();
										$('.cash_added').show()
										////console.log(paymentType);
										$('#SalePayment').val($.toJSON(paymentType));
										byPass=true;
										$('#amount_received').removeAttr('readonly').select();
										//$('#description').focus();
									},
									'CANCEL':function(){
										$(this).dialog('destroy');
										$('#itemsSold .recordDatagrid li:last').remove();
										$('#total').trigger('auto_compute');
									}
							}
						});
						$('#dialog').html('<center><br/><img src="/canteen/img/icons/exclamation.png" /><br/><br/><strong> Exceeded credit limit!<br/>Do you want to continue?</strong><br/><br/></center>');
						
						
					}
				
			}
			////console.log(paymentType);
		}
		if(MODE=='PR'){
			var prepaidAmt = parseFloat($('#prepaid').val());
			var due = parseFloat($('#total').val());
			
			if(prepaidAmt>due){//if input charge is greater than what it must be set it to due
				$('#prepaid').val(due)
			}
			
			if(!isNaN(prepaidAmt)||!isNaN(due)){ //if all have values
				
				if(prepaidAmt<=creditLimit){ // if prepaid is within the bounds of prepaid balance
						if(!byPass){ //
							////console.log('if(prepaidAmt<=creditLimit)');
							if(prepaidAmt < due){ //if not full credit
								$('#dialog').dialog({
									title:'Notification',
									modal:true,
									closeOnEscape: false,
									open: function(event, ui){
									
									$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
									buttons:{
										'CONTINUE':function(){
											$(this).dialog('destroy');
											
											$('.cash_added').show();
											$('.forSale').show();
											$('#prepaid').attr('readonly','readonly').val(ssUtil.roundNumber($('#prepaid').val(),2));
											$('.cash_added input').attr('readonly','readonly').val(ssUtil.roundNumber(due-prepaidAmt,2));
											//$('#save_button').removeAttr('disabled').parent().parent().addClass('topaz');
											byPass = true;
											$('#amount_received').removeAttr('readonly').select();
										},
										'CANCEL':function(){
											$(this).dialog('destroy');
										}
									}
								});
								$('#dialog').html('<center><strong>Insufficient amount..!!</strong></center>');
								$('.ui-widget-overlay').css('opacity','.2');
								$('.ui-dialog-buttonset button:first').focus();
							}
							if(prepaidAmt == due){
								$('#prepaid').blur();
								$('#save_button').removeAttr('disabled').parent().parent().addClass('topaz');
								////console.log('prepaidAmt == due');
								saveFlag =true;
							}
						}else{
							byPass = false;
							////console.log('inside bypass');
						}
					}else{
						
						$('#dialog').dialog({
							title:'Notification',
							modal:true,
							closeOnEscape: false,
							open: function(event, ui){
								$(this).parent().children().children(".ui-dialog-titlebar-close").hide();// Hide close button
							},
							buttons:{
									'CONTINUE':function(){
										$(this).dialog('destroy');
										
										var addCash = ssUtil.roundNumber(total-creditLimit,2);
										var paymentPrepaid ={};
										var paymentCash ={};
										paymentType=[];
										paymentPrepaid['SalesPayment']={};
										paymentPrepaid['SalesPayment']['payment_type_id']=2;
										paymentPrepaid['SalesPayment']['amount']=prepaidAmt;
										
										paymentCash['SalesPayment']={};
										paymentCash['SalesPayment']['payment_type_id']=1;
										paymentCash['SalesPayment']['amount']=addCash;
										
										paymentType.push(paymentPrepaid); //push preapaid 
										paymentType.push(paymentCash); // push payment
										
										$('#prepaid').val(ssUtil.roundNumber(creditLimit,2));
										$('#added_cash').val(addCash);
										$('.forSale').show();
										$('.cash_added').show()
										//////console.log(paymentType);
										$('#SalePayment').val($.toJSON(paymentType));
										byPass=true;
										$('#amount_received').removeAttr('readonly').select();
										//$('#description').focus();
									},
									'CANCEL':function(){
										$(this).dialog('destroy');
										$('#itemsSold .recordDatagrid li:last').remove();
										$('#total').trigger('auto_compute');
									}
							}
						});
						$('#dialog').html('<center><br/><img src="/canteen/img/icons/exclamation.png" /><br/><br/><strong> Exceeded credit limit!<br/>Do you want to continue?</strong><br/><br/></center>');
					}
			}
		}
	}
	function dialog_box(args){
		$('#dialog').dialog({
			title:'Notification',
			modal:true,
			closeOnEscape: false,
			open: function(event, ui){$(this).parent().children().children(".ui-dialog-titlebar-close").hide();},// Hide close button
			buttons:{
				Back:function(){
					$(this).dialog('destroy');
					$(args).val('').focus();
				}
			}
		});
		$('.ui-widget-overlay').css('opacity','.2');
	}

	
});