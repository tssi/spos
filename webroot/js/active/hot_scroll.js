$(document).ready(function(){
	var HOT_SPOTS = {};
	
	$(document).bind('keypress',function(evt,args){
	console.log(HOT_SPOTS);
	console.log(HOT_SPOTS['_'+evt.which]);
	console.log(evt.which);
	console.log('_'+evt.which);
		$(document).trigger('quick_scroll',{target:HOT_SPOTS['_'+evt.which]});
	}).bind('quick_scroll',function(evt,args){
	console.log(args);
		var offset = $(args.target).offset().top;
		switch(args.speed){
				case null:
					speed = 500;
					break;
				case 'slow':
					speed=1000;
					break;
				case 'fast':
					speed = 250;
					break;
		}
		$('html,body').animate({scrollTop:offset},speed);
	});
	$('.hot_scroll').trigger('register_hotkeys');
	$.each($('.hot_scroll'),function(i,e){
		var hot_key  =$(e).attr('hotkey');
		var hot_id = $(e).attr('id');
		var hot_spot = HOT_SPOTS['_'+hot_key+''] = '#'+hot_id;
	});
});