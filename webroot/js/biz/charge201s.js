var GoTo;
var Model;
$(document).ready(function(){

	radioButtonHandler();
	
	$('#Charge201CategoryE,#Charge201CategoryS').click(function(){
		radioButtonHandler();
	});
	
	
	//REFERENCE ID EVENT HANDLER
	$('#Charge201Reference').change(function(){
		refencesAjax($(this).val());
	});
	
	$('#SaveButton').click(function(){
		$('#Charge201AddForm').submit();
	});
	
});

function refencesAjax(reference_id){
	$.ajax({
		url:'/canteen/charge201s/'+GoTo+'/'+reference_id,
		dataType:'json',
		success:function(json){
			console.log(json);
			if(json){
				if(json.hasCharge201){
					alert('Has Charge 201');
					restore();
					return;
				}
				$('#Charge201Name').val(json[Model]['full_name']);
				$('#SaveButton').removeAttr('disabled');
				return;
			}
		
			alert('No result Found');
			restore();
		}
	});
}

function radioButtonHandler(){
	$('#Charge201Reference,#Charge201Name').val('');
	$('#SaveButton').attr('disabled','disabled');
	
	var category = $('[type="radio"]:checked').val();
	switch(category){
		case 'S':  
				GoTo = 'getStudent';
				Model = 'Student';
			break;
		case 'E': 
				GoTo = 'getEmployee';
				Model = 'Employee';
			break;
	}
}

function restore(){
	$('#SaveButton').attr('disabled','disabled');
	$('#Charge201Name').val('');
	$('#Charge201Reference').select();
}