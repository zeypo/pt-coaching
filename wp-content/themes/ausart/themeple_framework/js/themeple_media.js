(function($)
{
	var themeple_media = {
	   postId: false,
       formContainer: false,
       bind_click: function(){
            $('.themeple_upload').live('click', function(){
                
                var title = this.title;
                themeple_media.postId = this.hash.substr(1);
                themeple_media.formContainer  = $(this).parents('.themeple_box');
                tb_show( title, 'media-upload.php?post_id='+themeple_media.postId+"&amp;TB_iframe=true" );
                $('.fancybox-overlay').css('z-index', 0);
                themeple_media.get_src();
            });

       },
       
       get_src: function(){
            window.original_send_to_editor = window.send_to_editor;
     		window.send_to_editor = function(html)
     		{     			
   				var container = themeple_media.formContainer,
                    returned = $(html),
                    img = returned.attr('src') || returned.find('img').attr('src') || returned.attr('href'),
                    visualInsert = '';
					
          if(container.length > 0){
					           container.find('.themeple_upload_input').val(img).trigger('change');
                     container.find('.image_prev').find('img').attr('src', img);
          }
					tb_remove();
          $('.fancybox-overlay').css('z-index', 9999);
				}	
				
	   }
       
    };
	

	
	$(function()
	{
		themeple_media.bind_click();
		
 	});

	
})(jQuery);	
 