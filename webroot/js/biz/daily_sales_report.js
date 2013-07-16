$(document).ready(function(){
	var toPrint;
	$('.detailByOR').hide();
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
    
	$('#go').click(function(){
		var isCollector = parseInt($('#isCollector').val());
		var urlIs='';
		if(isCollector){
			//console.log('isCollector', isCollector);
			urlIs='/canteen/sales/daily_report/';
			
		}
		if(!isCollector){
			//console.log('!isCollector', isCollector);
			urlIs='/canteen/sales/daily_report/'+$('#SaleUserId').val();
		}
		//console.log(urlIs);
		$('#SaleDailyReportForm').ajaxSubmit({
		url:urlIs,
		beforeSend:function(){
			$('.food_Table tbody, .shelf_Table tbody, .salesPayment tbody').fadeOut();
			$('.food_Table tbody, .shelf_Table tbody, .salesPayment tbody').empty();
		},
		success:function(data){
			//console.log($.parseJSON(data));
			toPrint = null;
			toPrint =$.toJSON($.parseJSON(data));
			//console.log(toPrint);
			$('#SaleData').val(toPrint);
			var report = $.parseJSON(data);
			$('#SaleTotalSales').val(report.Total_Sales);
			$('#SaleFood').val(report.Total_Food);
			$('#SaleShelf').val(report.Total_Shelf);
			$('input').blur();
			var htm = '';
			var totalIs= 0;
			$.each(report.Total_Details.Food, function(c,o){
				if(o.Is_SetDtl != 1){
					o.Amount=parseFloat(o.Amount);
					totalIs+=o.Total;
					htm+='<tr>';
					htm+='<td class="taCenter">'+o.Qty+'</td>';
					htm+='<td class="taLeft">'+o.Barcode+'</td>';
					htm+='<td class="taLeft">'+o.Desc+'</td>';
					htm+='<td class="taRight monetary">'+ssUtil.roundNumber(o.Amount,2)+'</td>';
					htm+='<td class="taRight money">'+ssUtil.roundNumber(o.Total, 2)+'</td>';
					htm+='</tr>';
				}
			});
			
			htm+='<tr>';
			htm+='<td colspan=3></td>';
			htm+='<td class="taRight"><strong>Total Amount:<strong></td>';
			htm+='<td class="taRight money"><strong>'+ssUtil.roundNumber(totalIs, 2)+'<strong></td>';
			htm+='</tr>';
			
			totalIs= 0;
			var htm1 = '';
			$.each(report.Total_Details.Shelf, function(c,o){
				if(o.Is_SetDtl != 1){
					totalIs+=o.Total;
					htm1+='<tr>';
					htm1+='<td class="taCenter">'+o.Qty+'</td>';
					htm1+='<td class="taLeft">'+o.Barcode+'</td>';
					htm1+='<td class="taLeft">'+o.Desc+'</td>';
					htm1+='<td class="taRight money">'+ssUtil.roundNumber(o.Amount,2)+'</td>';
					htm1+='<td class="taRight money">'+ssUtil.roundNumber(o.Total,2)+'</td>';
					htm1+='</tr>';
				}
				
			});
			
			htm1+='<tr>';
			htm1+='<td colspan=3></td>';
			htm1+='<td class="taRight"><strong>Total Amount:<strong></td>';
			htm1+='<td class="taRight money"><strong>'+ssUtil.roundNumber(totalIs, 2)+'<strong></td>';
			htm1+='</tr>';
			
			$('.food_Table tbody').append(htm);
			$('.food_Table table').trigger('update_table');
			$('.shelf_Table tbody').append(htm1);
			$('.food_Table tbody, .shelf_Table tbody').fadeIn();
			
			
			$('.detailByOR').empty();
			var ctr = 0;
			var htmOr='';
			$.each(report.Total_byOR, function(c,o){
				htmOr+='<div class="w100 taLeft fwb bgCheri">OR:'+c+'</div>';
				htmOr+='<table class="smart_table '+'table'+(ctr+=1)+' w100 fsSmall shelf_Table">';
				htmOr+='<thead>';
				htmOr+='<th class="w10">QTY</th>';
				htmOr+='<th class="w15 ">Code</th>';
				htmOr+='<th class="w30 ">Desc</th>';
				htmOr+='<th class="w10 ">Amount</th>';
				htmOr+='<th class="w10 ">Total</th>';
				htmOr+='</thead>';
				htmOr+='<tbody>';
				var totalIs=0;
				$.each(o, function(ctr, object){
					console.log(object);
					if(object.Is_SetDtl == 1){
						htmOr+='<tr>';
						htmOr+='<td class="taCenter">'+object.Qty+'</td>';
						htmOr+='<td class="taLeft">'+object.Barcode+'</td>';
						htmOr+='<td class="taLeft">&nbsp;&nbsp;>'+object.Desc+'</td>';
						htmOr+='<td class="taRight money">'+''+'</td>';
						htmOr+='<td class="taRight money">'+''+'</td>';
						htmOr+='</tr>';
					}else{
						htmOr+='<tr>';
						htmOr+='<td class="taCenter">'+object.Qty+'</td>';
						htmOr+='<td class="taLeft">'+object.Barcode+'</td>';
						htmOr+='<td class="taLeft">'+object.Desc+'</td>';
						totalIs+=object.Total;
						htmOr+='<td class="taRight money">'+ssUtil.roundNumber(object.Amount,2)+'</td>';
						htmOr+='<td class="taRight money">'+ssUtil.roundNumber(object.Total,2)+'</td>';
						htmOr+='</tr>';
					}
				});
				htmOr+='<tr><td colspan=3></td>';
				htmOr+='<td class="taRight"><strong>Total Amount:</strong></td>';
				htmOr+='<td class="taRight money"><strong>'+ssUtil.roundNumber(totalIs,2)+'</strong></td>';
				htmOr+='</tr>';
				htmOr+='</tbody>';
				htmOr+='</table>';
			});
			
			htmOr+='<hr>';
			htmOr+='<div class="fLeft w30 topaz pt5">';
			htmOr+='<div class="submit"><input type="button" id="printDetails" value="Print" autocomplete="off"></div>';
			htmOr+='</div><div class="fClear"></div>';
			
			$('.detailByOR').append(htmOr);
			$('.smart_table').find("tbody tr:even").css('background-color','#ffffff');
			$('.smart_table').find("tbody tr:odd").css('background-color','#f7f6f2');
			$('.smart_table').find("tbody tr:last").css('background-color','#C8F0BC');
			
			var htm1SP='';
			htm1SP+='<tr>';
			htm1SP+='<td class="taRight">'+ssUtil.roundNumber(report.bySalesPayment.CASH,2)+'</td>';
			htm1SP+='<td class="taRight">'+ssUtil.roundNumber(report.bySalesPayment.PREPAID,2)+'</td>';
			htm1SP+='<td class="taRight">'+ssUtil.roundNumber(report.bySalesPayment.CHARGE,2)+'</td>';
			htm1SP+='<td class="taRight">'+ssUtil.roundNumber(report.Total_Sales,2)+'</td>';
			htm1SP+='</tr>';
			
			
			$('.salesPayment').append(htm1SP);
			$('.smart_table').find("tbody tr:even").css('background-color','#ffffff');
			$('.smart_table').find("tbody tr:odd").css('background-color','#f7f6f2');
			$('.smart_table').find("tbody tr:last").css('background-color','#C8F0BC');
			$('.salesPayment tbody').fadeIn();
		}
		})
	});
    
	
	$('#cancel').click(function(){
		$('#SaleTotalSales, #SaleFood, #SaleShelf').val('');
		$('.food_Table tbody, .shelf_Table tbody').fadeOut();
		$('.food_Table tbody, .shelf_Table tbody').empty();
		$('.detailByOR').empty();
	})
	
	$('#showDtl').change(function(){
		var isChecked = $('#showDtl:checked');
		isChecked = isChecked.length;
		if(isChecked){
			$('.detailByOR').fadeIn('slow', function(){
				$('.detailByOR').show();
			});
			
		}else{
			$('.detailByOR').fadeOut('slow', function(){
				$('.detailByOR').hide();
			});
		}
	});
	
	$('#print').click(function(){
		$('#SaleDailyReportForm').attr('action','/canteen/sales/report_pdf');
		$('#SaleDailyReportForm').attr('target','_blank');
		$('#SaleDailyReportForm').submit();
		$('#SaleDailyReportForm').attr('action','/canteen/sales/daily_report');
	});
	
	$('#printDetails').live('click',function(){
		$('#SaleDailyReportForm').attr('action','/canteen/sales/details_report');
		$('#SaleDailyReportForm').attr('target','_blank');
		$('#SaleDailyReportForm').submit();
	});
});