$(document).ready(function(){
  $(document).bind("smart_scroll",function(event,args){
    var offset = $(args.target).offset().top;
    $('html, body').animate({scrollTop:offset}, 500);
  });
});
