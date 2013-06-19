function checkTime(i){
	if (i<10){
		i="0" + i;
	  }
	return i;
}

function timeIt(){ //time ticker
		d = new Date();
		dateIs = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+checkTime(d.getHours())+':'+checkTime(d.getMinutes())+':'+checkTime(d.getSeconds());
		$('#PettyCashCreated').val(dateIs);
		
		setTimeout("timeIt()",1000);
	}
$(document).ready(function(){
	timeIt();
	
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
	
	// Get Employee Petty Cash 
	function getPetties(empId){ //args as employee id
		$.ajax({
			type:'GET',
			url: '/canteen/petty_cashes/getEmpPetty',
			data: {data:{'PettyCash':{'employee':empId}}},
			beforeSend:function(){
				//console.log('key: ',productDesc);
				$('#petty_view ul.recordDataGrid').trigger('clear_grid');
			},
			success:function(data){
				var pty = $.parseJSON(data);
				var empPetty = $(pty).toArray().length;
				if (empPetty>0){
					  var source = [];
								//Prepare data structure
					  $.each(pty, function(ctr,obj){
							var aggr={};           
								aggr['div.created input']=obj.PettyCash.created;
								aggr['div.ttype input']=obj.PettyCash.trans_type;
								aggr['div.purpose input']=obj.PettyCash.purpose;
								aggr['div.amt input']=obj.PettyCash.amount;
								
							source.push(aggr);  
						});
						console.log(source);
						$('#petty_view ul.recordDataGrid').trigger('populate_grid',{'data':source});
						$('#petty_view ul.recordDataGrid').bind('hide', function(){
							$('#petty_view ul.recordDatagrid li.mainInput').hide();
							});
						$('#petty_view ul.recordDataGrid').trigger('hide');
						$('.monetary').blur();
				}
			},
			error:function(){
				alert('Reload');
			}
		});
	
	};
	
	//Restore Default
    $(document).bind('restore_defaults', function(){
		$('.picker input').removeClass('selected');
		$('#PettyCashAddForm').resetForm();
		$('#PettyCashEmployee, #PettyCashAmount, #PettyCashPurpose').attr('readonly', 'readonly');
	});
	
	
	$('.picker input').click(function(){
		if($(this).attr('equals')=='PTY'){
			$('#PettyCashTransType').val($(this).attr('equals'));
			$('#PettyCashFlag').val(1);
			$('#PettyCashEmployeeName, #PettyCashAmount, #PettyCashPurpose').removeAttr('readonly');
			$('#PettyCashEmployeeName').select();
		}
	});
	
	//$('.picker input[equals="ADV"]').trigger('click');
	
	//Auto complete employee
	$('.employeeAuto').livequery(function(){
			var input =  $(this);		
			input.autocomplete({
				source: [],
				select: function(event, ui) {
					$(event.target).val(ui.item.label);
					$(event.target).focus().blur();//.trigger('keypress',{'which':13});
					$('#PettyCashEmployee').val(ui.item.id);
					console.log(ui.item.id);
					getPetties(ui.item.id);
					return false;
				}
			}).keypress(function(){
			   var empName = $(this).val();
			   var myLink = window.location.protocol + "//" + window.location.host + "/" + 'canteen/petty_cashes/employeefind';
			   var source = [];
			   $('.employeeAuto').autocomplete('option','source',source);		   
			   $.ajax({
					type:'POST',
					url: myLink,
					data:{'data':{'PettyCash':{'employee':empName}}},
					success:function(data){
						var prod = $.parseJSON(data);
						prod = $.parseJSON(prod);
						$.each(prod, function(c,o){
							var itemsOf = {
								'label':o.Employee.full_name,
								'value':o.Employee.full_name,
								'id':o.Employee.id,
							};
							source.push(itemsOf);
						})
						$('.employeeAuto').autocomplete('option','source',source);
						
					},
					error:function(){
						alert('Reload');
					}
				});
				return;
			});
		});


	$('#cancel_button').click(function(){
		$(document).trigger('restore_defaults');
	});

	//$.getJSON('canteen/petty_cashes/getAll', function(data){console.log($.parseJSON(data))});
	
	
	
	
	$('#PettyCashAddForm').bind('formNeat_sucess',function(e,a){
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
		$('#inventoryList li.dynamicInput div.itemCode .input input').removeClass('unique'); 
		$(document).trigger('restore_defaults');
	}); 

	$('.main input').livequery(function(){
		input = $(this);
		input.bind('blur',function(){
			if(input.attr('id')=='PettyCashAmount'){
				if (input.val()!==''){
					var amount = $(this).val();
					console.log(amount);
					$('#PettyCashAmtwords').val(amountToWords(amount));
				}
			}
			
		}).bind('focus', function(){
		if(input.attr('id')=='PettyCashEmployeeName'){
				console.log('employee', input);
				input.select();
			}
		
		});
	    
	});
		
		
	
});