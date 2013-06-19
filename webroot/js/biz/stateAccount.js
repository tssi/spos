$(document).ready(function(){
	var MODE;
	var viewBy;
	var reference;
	var searchBy;
	var fromDate;
	var toDate;
	var printIt={};
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
	
	//radio like behavior
	$('.state_mode .submit input').click(function(){
			MODE=$(this).attr('mode');
			if(MODE=='CH'){
				$('#prepaid_button').parent().parent().removeClass('ruby');
				$('#prepaid_button').attr('disabled','disabled');
				$('.transLabel').text('Transaction-Charges');
				
			}
			if(MODE=='PR'){
				$('#charge_button').parent().parent().removeClass('sapphire');
				$('#charge_button').attr('disabled','disabled');
				$('.transLabel').text('Transaction-Prepaid');				
			}
			printIt['MODE_TYPE']=MODE;
	});
	
	$('#cancelIt').click(function(){ // cancel account
		MODE=null;
		$('#prepaid_button').parent().parent().addClass('ruby');
		$('#charge_button').parent().parent().addClass('sapphire');
		$('#prepaid_button,#charge_button').removeAttr('disabled');
		$('.state_mode').find('.submit input').removeClass('selected');
		
	});
	
	$('.viewBy .submit input').click(function(){ //view by
		viewBy=$(this).attr('mode');
		getTrans(MODE,reference,searchBy,'null','null');
		printIt['MODE_BY']=viewBy;
	});
	
	$('#by').click(function(){ // type of reference
		searchBy=$(this).val();
		printIt['SEARCH BY']=searchBy;
		console.log(searchBy);
	});
	
	function getTrans(mode,refer, cat, from, to){
		
		var coverage;
		var modeIs;
		if(!(refer==undefined) || !(cat==undefined)){
					
			console.log('reference:'+refer, 'category:'+cat,'from:'+from, 'to:'+to);
			
			printIt['DATE']={};
			printIt['DATE']['FROM']=from;
			printIt['DATE']['TO']=to;
			
			if(from!="null"){
				if(to!="null"){
					coverage = from+'/'+to;
				}else{
					coverage = from+'/';
				}
			}else{
				if(to!="null"){
					coverage = '/'+to;
				}else{
					coverage = '';
				}
			}
			//console.log('coverage: ',coverage);
			
			switch(MODE){
				case 'CH':
					modeIs='charge201s';
				break;
				case 'PR':
					modeIs='prepaid201s';
				break;
			}
			
			printIt['TRANSACTIONS'] = [];
			
			$.ajax({
				url:'/canteen/'+modeIs+'/getCharges/'+coverage,
				type:'POST',
				data:{'data':{'Charge':{'reference':refer, 'category':cat}}},
				dataType:"json",
				success:function(data){
					var dat  = data;
					console.log(dat);
					if(MODE=='CH'){
						if(dat.Charges['0']){
							$('#forwardBal').val(ssUtil.roundNumber(dat.Charges['0'].Charge201.SopCgeVal['0'].amount_balance,2));
							printIt['FORWARD BALANCE']=dat.Charges['0'].Charge201.SopCgeVal['0'].amount_balance;
							printIt['REF NO']=dat.Charges['0'].Charge201.reference;
							printIt['NAME']=dat.name;
							$('#chargee').val(dat.name);
							$('#reference').attr('disabled','disabled');
							$('#by').attr('disabled','disabled');
							
							switch(viewBy){
							case 'itemized':
								$('#transac ul.recordDataGrid').trigger('clear_grid');
								var source = [];
								var chargeDue = 0.0;
								
								$.each(dat.Charges,function(ctr, obj){
									var totalDue =0;
									var aggr = {};
									var payments={};
									
									$.each(obj.SalePayment,function(wctr, wobj){
										if(wobj.PaymentType.name=="CHAR"){
											payments['Charge']=wobj.amount;
										}
										if(wobj.PaymentType.name=="CASH"){
											payments['Cash']=wobj.amount;
										}
										if(wobj.PaymentType.name=="PREP"){
											payments['Prepaid']=wobj.amount;
										}
									});
									
																	
									$.each(obj.SaleDetail, function(xctr,xobj){
											//console.log(xctr);
											var aggr = {};
											var dateOf = obj.SopCgeTran.created;
											dateOf = dateOf.split(" ");
											dateOf=dateOf[0];
											
											if(xctr==0){
												aggr['div .date input']=dateOf;
											}										
											else{
												aggr['div .date input']='';
											}
											totalDue+=parseFloat(xobj.SaleDetail.amount);
											aggr['div .desc input']='OR'+obj.Sale.id+' - '+xobj.SaleDetail.name;
											aggr['div .due input']= ssUtil.roundNumber(xobj.SaleDetail.amount,2);
											source.push(aggr);
											
											
									});
									
									aggr = {};
									aggr['div .desc input'] = 'OR'+obj.Sale.id+'-'+'Total Due';		
									aggr['div .due input'] = ssUtil.roundNumber(totalDue,2);		
									aggr['div .payment input'] = "";		
									source.push(aggr);
									
									if(payments['Cash']){
										aggr = {};
										aggr['div .desc input'] = 'OR'+obj.Sale.id+'-'+'Cash';		
										aggr['div .due input'] = "";		
										aggr['div .payment input'] = ssUtil.roundNumber(payments['Cash'],2);		
										source.push(aggr);
									}
									if(payments['Charge']){
										aggr = {};
										aggr['div .desc input'] = 'OR'+obj.Sale.id+'-'+'Charge';		
										aggr['div .due input'] = ssUtil.roundNumber(payments['Charge'],2);		
										aggr['div .payment input'] = "";		
										source.push(aggr);
									}
									if(payments['Prepaid']){
										aggr = {};
										aggr['div .desc input'] = 'Prepaid';		
										aggr['div .due input'] = "";		
										aggr['div .payment input'] = payments['Prepaid'];		
										source.push(aggr);
									}
									
									aggr = {};
									aggr['div .desc input'] = "";		
									aggr['div .due input'] = "";		
									aggr['div .payment input'] = "";		
									aggr['div .bal input'] = "";		
									source.push(aggr);
									console.log(source);
								});
								printIt['TRANSACTIONS']=source;
								console.log(source);
								$('#transac ul.recordDataGrid').trigger('populate_grid',{'data':source});
								$('#transac ul.recordDataGrid .mainInput').hide();	
								
							break;
							case 'transaction':
								$('#transac ul.recordDataGrid').trigger('clear_grid');
								var source = [];
								
																
								$.each(dat.Charges,function(zctr, zobj){
									var payments={};
									$.each(zobj.SalePayment,function(pctr, pobj){
										if(pobj.PaymentType.name=="CHAR"){
											payments['Charge']=pobj.amount;
										}
										if(pobj.PaymentType.name=="CASH"){
											payments['Cash']=pobj.amount;
										}
										if(pobj.PaymentType.name=="PREP"){
											payments['Prepaid']=pobj.amount;
										}
									});
									
									var aggr={};
									var dateOf = zobj.SopCgeTran.created;
									dateOf = dateOf.split(" ");
									dateOf=dateOf[0];
									
									aggr['div .date input'] = dateOf;		
									aggr['div .desc input'] = 'OR'+zobj.Sale.id+'-'+'Charge';		
									aggr['div .due input'] = ssUtil.roundNumber(payments['Charge'],2);		
									aggr['div .payment input'] = "";		
									source.push(aggr);
									
								});
							//console.log(source);
							printIt['TRANSACTIONS']=source;
							$('#transac ul.recordDataGrid').trigger('populate_grid',{'data':source});
							$('#transac ul.recordDataGrid .mainInput').hide();
							break;
						}
						}else{
							$('#transac ul.recordDataGrid').trigger('clear_grid');
							alert('No results');
						}
					}
					if(MODE=='PR'){
						if(dat.Charges['0']){
							$('#forwardBal').val(ssUtil.roundNumber(dat.Charges['0'].Prepaid201.SopPpVal['0'].amount_balance,2));
							printIt['FORWARD BALANCE']=dat.Charges['0'].Prepaid201.SopPpVal['0'].amount_balance;
							printIt['REF NO']=dat.Charges['0'].Prepaid201.reference;
							printIt['NAME']=dat.name;
							$('#chargee').val(dat.name);
							$('#reference').attr('disabled','disabled');
							$('#by').attr('disabled','disabled');
							
							switch(viewBy){
							case 'itemized':
								$('#transac ul.recordDataGrid').trigger('clear_grid');
								var source = [];
								//console.log(dat.Charges);
								
								$.each(dat.Charges,function(ctr, obj){ //for each charges
									var totalDue =0;
									var aggr = {};
									var payments={};
									
									$.each(obj.SalePayment,function(wctr, wobj){ //list all payment types
										if(wobj.PaymentType.name=="CHAR"){
											payments['Charge']=wobj.amount;
										}
										if(wobj.PaymentType.name=="CASH"){
											payments['Cash']=wobj.amount;
										}
										if(wobj.PaymentType.name=="PREP"){
											payments['Prepaid']=wobj.amount;
										}
									});
									
									console.log('obj.SaleDetail: ',obj.SaleDetail);			
									$.each(obj.SaleDetail, function(zctr,zobj){ //list all product bought
											
											var aggr = {};
											
											var dateOf = obj.SopPpTran.created;
											dateOf = dateOf.split(" ");
											dateOf=dateOf[0];
											//console.log(dateOf);		
											 if(zctr == 0){
												dateIs = dateOf;
											}else{
												dateIs =" ";
												
											}
											aggr['div .date input'] = dateIs;
											totalDue+=parseFloat(zobj.SaleDetail.amount);
											aggr['div .desc input']='OR'+obj.Sale.id+' - '+zobj.SaleDetail.name;
											aggr['div .due input']= ssUtil.roundNumber(zobj.SaleDetail.amount,2);
											aggr['div .payment input'] = "";
											source.push(aggr);
											console.log(totalDue);
									});
									
									
									var aggr = {};
									aggr['div .desc input'] = 'OR'+obj.Sale.id+'-'+'Total Due';		
									aggr['div .due input'] = ssUtil.roundNumber(totalDue,2);		
									aggr['div .payment input'] = "";
									aggr['div .date input'] = " ";									
									source.push(aggr);
									
									if(payments['Cash']){
										aggr = {};
										aggr['div .desc input'] = 'OR'+obj.Sale.id+'-'+'Cash';		
										aggr['div .due input'] = "";		
										aggr['div .payment input'] = ssUtil.roundNumber(payments['Cash'],2);		
										source.push(aggr);
									}
									if(payments['Charge']){
										aggr = {};
										aggr['div .desc input'] = 'OR'+obj.Sale.id+'-'+'Charge';		
										aggr['div .due input'] = ssUtil.roundNumber(payments['Charge'],2);		
										aggr['div .payment input'] = "";		
										source.push(aggr);
									}
									if(payments['Prepaid']){
										aggr = {};
										aggr['div .desc input'] = 'OR'+obj.Sale.id+'-'+'Prepaid';		
										aggr['div .due input'] = ssUtil.roundNumber(payments['Prepaid'],2);		
										aggr['div .payment input'] = "";		
										source.push(aggr);
									}
									
									aggr = {};
									aggr['div .desc input'] = "";		
									aggr['div .due input'] = "";		
									aggr['div .payment input'] = "";		
									aggr['div .bal input'] = "";		
									source.push(aggr);
								});
								
								//console.log(source);
								printIt['TRANSACTIONS']=source;
								$('#transac ul.recordDataGrid').trigger('populate_grid',{'data':source});
								$('#transac ul.recordDataGrid .mainInput').hide();	
							break;
							case 'transaction':
								$('#transac ul.recordDataGrid').trigger('clear_grid');
								var source = [];
								
																
								$.each(dat.Charges,function(zctr, zobj){
									var payments={};
									$.each(zobj.SalePayment,function(pctr, pobj){
										if(pobj.PaymentType.name=="CHAR"){
											payments['Charge']=pobj.amount;
										}
										if(pobj.PaymentType.name=="CASH"){
											payments['Cash']=pobj.amount;
										}
										if(pobj.PaymentType.name=="PREP"){
											payments['Prepaid']=pobj.amount;
										}
									});
									
									var aggr={};
									var dateOf = zobj.SopPpTran.created;
									dateOf = dateOf.split(" ");
									dateOf=dateOf[0];
									
									aggr['div .date input'] = dateOf;		
									aggr['div .desc input'] = 'OR'+zobj.Sale.id+'-'+'Prepaid';		
									aggr['div .due input'] = ssUtil.roundNumber(payments['Prepaid'],2);		
									aggr['div .payment input'] = "";		
									source.push(aggr);
									
								});
							//console.log(source);
							printIt['TRANSACTIONS']=source;
							$('#transac ul.recordDataGrid').trigger('populate_grid',{'data':source});
							$('#transac ul.recordDataGrid .mainInput').hide();
							break;
						}
						}else{
							$('#transac ul.recordDataGrid').trigger('clear_grid');
							alert('No results');
						}
					}
				}
			});
		}
	}
	
	
	$('.checkDate').change(function(){
		var dFrom = $('.dFrom input:checked');
		var dTo = $('.dTo input:checked');
		console.log('dFrom.length:'+dFrom.length,'dTo.length:'+dTo.length);
		if(dFrom.length){ //with from
			if(dTo.length){
				console.log('with from and to');
				getTrans(MODE,reference,searchBy,$('.dateFrom input').val(),$('.dateTo input').val());
			}else{
				console.log('with from and no to');
				getTrans(MODE,reference,searchBy,$('.dateFrom input').val(),"null");
			}
		}else{ //no from
			if(dTo.length){
				console.log('no from and with to');
				getTrans(MODE, reference,searchBy,"null",$('.dateTo input').val());
			}else{
				console.log('no from and no to');
				getTrans(MODE, reference,searchBy,"null","null");
			}
		}
	});
	
	$('#reference').keydown(function(e){
		reference=$(this).val();
		searchBy=$('#by').val();
		
		if(e.which==13){
			//console.log('reference: '+reference, ' searchBy:'+searchBy);
			getTrans(MODE, reference,searchBy,'null','null');
		}
	});
	
	$('#printIt').click(function(){
		console.log(printIt);
		$('#dataHere').val($.toJSON(printIt));
		$('#SalePaymentSaReportForm').submit();
	});
});