jQuery(function($) {


	if($('.top_menu_h').length > 0){
		$('.top_menu_h .menu').each(function(){
			var width = $(this).width();
			var half = width/2;
			$(this).css('margin-left', -half+'px');
			$(this).css('left', '50%');
		});
	}
	


});