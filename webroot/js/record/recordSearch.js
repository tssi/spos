$(document).ready(function(){
		//var Book_EDT = '/isms/student201s/edit';
		$('.search_keys').live('change',function(){
			var obj ='#'+$(this).val();
			var row = $(this).parent().parent();
			var ui;
			if($(obj).length&&$(obj).attr('type')!='hidden'){
				ui = $(obj).clone();
				$(ui).removeAttr('disabled');
				$(ui).find('option').show();
				$(ui).find('option:first').attr('selected','selected');
				$(ui).find('input').val('');
				$(ui).addClass('xlarge').removeClass('uiSmartList');
				$(ui).css({'opacity':1});
				$(ui).attr('id','').removeAttr('name');
				$(ui).addClass('search_input');
			}else{
				ui='<input class="search_input" type="text" class="xlarge notrequired" />';
			}
			$(row).find('.search_ui').html($(ui));
		});
		$('.criteria_action').live('click',function(){
			if($(this).text()=='+'){
				var ui = $('#search_template').clone();
				$(ui).show();
				$(ui).attr('id','').attr('name','');
				$(ui).find('.criteria_action').text('+');
				$(this).text('-');
				$(ui).appendTo('#search_advance_table');
			}else{
				$(this).parent().parent().remove();
			}
		}).click().text('');
		$('.search_keys').live('change',function(){
			var field =  $(this).find('option:selected').attr('field');
			$(this).parent().find('.search_field').val(field);
		});
		$('.search_table').bind('update_table',function(evt,args){
			var index =  0;
			$.each($(this).find('tbody tr'),function(i,e){
				$.each($(e).find('input[type="hidden"]'),function(j,f){
					var vname = $(f).attr('vname');
					$(f).attr('name',vname.replace('%',index));
				});
				index+=1;
			});
		}).bind('collect_values',function(evt,args){
			$.each($(this).find('tbody tr'),function(i,e){
				var value = $(e).find('.search_input').val();
				$(e).find('.search_value').val(value);
			});
		});
		
		$('#search_button').click(function(){
			$('#search_advance_table').trigger('collect_values');
			$('#search_advance_table').trigger('update_table');
			$('#advance_search_results').show();
			$('#advance_search').ajaxSubmit({
				beforeSend:function(){
					var row ='<tr>';
						row +='<td colspan="4" style="text-align:center"> Searching... </td>';
						row +='</tr>';
					$('#advance_search_results tbody').html(row);
				},
				success:function(data){
					var row='';
					var model= $('#advance_search').attr('data-model');
					if(data.results.length==0){
						var row ='<tr>';
						row +='<td colspan="4" style="text-align:center"> No results found. </td>';
						row +='</tr>';
						$('#advance_search_results tbody').html(row).delay(2000).fadeOut('slow');
					}else{
						$.each(data.results,function(ctr,obj){
							if(model==('Book')){
								row+='<tr class="book txtc" id="'+obj[model]['id']+'">';
								row+='<td class="small txtc">'+obj[model]['isbn']+'</td>';
								row+='<td class="xlarge txtc">'+obj[model]['title']+'</td>';
								row+='<td class="xlarge txtc">'+obj[model]['primary_author']+'</td>';
								row+='<td class="mini txtc"><a class="edit_button" href="javascript:void()">'
								row+='<img src="/isms/img/icons/pencil.png" />';
								row+='</a></td>';
								row+='</tr>';
							}else if(model==('Periodical')){
								row+='<tr class="book txtc" id="'+obj[model]['id']+'">';
								row+='<td class="small txtc">'+obj[model]['issn']+'</td>';
								row+='<td class="xlarge txtc">'+obj[model]['title_of_article']+'</td>';
								row+='<td class="xlarge txtc">'+obj[model]['primary_author']+'</td>';
								row+='<td class="mini txtc"><a class="edit_button" href="javascript:void()">'
								row+='<img src="/isms/img/icons/pencil.png" />';
								row+='</a></td>';
								row+='</tr>';
							}else if(model==('AudioVisual')){
								row+='<tr class="book txtc" id="'+obj[model]['id']+'">';
								row+='<td class="small txtc">'+obj[model]['issn']+'</td>';
								row+='<td class="xlarge txtc">'+obj[model]['audio_visual']+'</td>';
								row+='<td class="xlarge txtc">'+obj[model]['primary_author']+'</td>';
								row+='<td class="mini txtc"><a class="edit_button" href="javascript:void()">'
								row+='<img src="/isms/img/icons/pencil.png" />';
								row+='</a></td>';
								row+='</tr>';
							}
						});
						
						$('#advance_search_results tbody').fadeOut('slow',function(){
							$('#advance_search_results tbody').html(row).fadeIn('slow');
							$('#advance_search_results').trigger('update_table');
						});	
					}
				}
			});
		});
		$('.edit_button').live('click',function(){
			//$('#student201_cancel,#student201_submit').removeAttr('disabled').parent().removeClass('hover');
			
			var id = $(this).parent().parent().attr('id');
			$('#quick_id').val(id);
			var form= $('#quick_search').attr('data-form');
			var model= $(form).attr('data-model');
			var edit= $(form).attr('data-edit');
			$('#quick_search').ajaxSubmit({
				beforeSend:function(){
					$(document).trigger('smart_scroll',{'target':$(form)});
				},
				success:function(data){
					$(form).attr('action',edit);
					var obj =  data.results[0];
					var elem =  data.elem;
					$.each(obj[model],function(fld,value){
						$('#'+elem[fld]).val(value).removeAttr('disabled').focus();
						if(fld!='isbn'){
							$('#'+elem[fld]).blur();
						}
					});
					$.each(obj['Author'],function(i,e){
						$('#Author'+i+'Name').focus().val(e.name).attr('author_id',e.id).trigger('keypress',{which:13}).trigger('add',{'id':e.id,'name':e.name});
					});
					$.each(obj['Editor'],function(i,e){
						$('#Editor'+i+'Name').focus().val(e.name).attr('editor_id',e.id).trigger('keypress',{which:13}).trigger('add',{'id':e.id,'name':e.name});
					});
					$.each(obj['Compiler'],function(i,e){
						$('#Compiler'+i+'Name').focus().val(e.name).attr('compiler_id',e.id).trigger('keypress',{which:13}).trigger('add',{'id':e.id,'name':e.name});
					});
					$.each(obj['Heading'],function(i,e){
						$('#Heading'+i+'SubjectHeading').focus().val(e.subject_heading).attr('heading_id',e.id).trigger('keypress',{which:13}).trigger('add',{'id':e.id,'subject_heading':e.subject_heading});
					});	
				}
			});
		});
});
		