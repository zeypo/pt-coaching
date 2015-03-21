(function($){

    

    var themeple_upload_gallery = {

        

        window: parent || top,

        

        bind_upload_button: function(){

            

            $('.themeple_upload_gallery_btn').live('click', function(){

                var element = $(this),

                    

                    gallery_container       = element.parents('.themeple_upload_gallery_container:eq(0)');

                    themeple_set            = element.parents('.themeple_set:eq(0)');

                    sortable_container      = gallery_container.find('.themeple_upload_gallery_sortable_container');

                    

                    title                   = this.title;

                    gallery_image_value	    = themeple_set.find('.themeple_gallery_img_value'),

                    image_field		        = gallery_image_value.parents('.themeple_gallery_img:eq(0)'),

                    meta_active             = $('input[name=meta_active]', '#themeple_js_data'),

                    context                 = 'admin_page';

                    if(meta_active.val()) context = 'metabox';

                    var uri_string  = 'media-upload.php?post_id='+element.data('attach-to-post');

					    uri_string += '&amp;themeple_upload_gallery_active=true';

                        if(element.data('video-insert'))	

                            uri_string += '&amp;tab='+element.data('video-insert')+'&amp;height=300';

		                uri_string += '&amp;themeple_upload_gallery_label='+element.data('label'),

					    uri_string += '&amp;TB_iframe=true';

                        

                    themeple_upload_gallery.window.themeple_global.gallery_editor = {

        					

                            element: 		        element,

        					gallery_container: 		gallery_container,

        					gallery_image_value:	gallery_image_value,

        					image_field:	        image_field,	

                            context:                context

                    };

                    tb_show("", uri_string);

            });

        },

        

        sort: function(){

            $( ".sortable_element" ).disableSelection();	

		

			$('.themeple_upload_gallery_sortable_container').sortable({

				

				handle: '.sortable_element',

				cancel: 'a',

				items: '.themeple_row',

				update: function(event, ui) 

				{

					var pass = {currentSet: ui.item, container: ui.item, setsToCount: false};

					themeple_recalcIds(pass);

				}



			});

        },

        modify_filter_url: function()

		{

			var filter = $("#filter"),

				gallery_data = themeple_upload_gallery.window.themeple_global.gallery_editor;



			if(filter.length)

			{

				var labelInsert	 = filter.find("input[name=themeple_upload_gallery_label]"),

					galleryInsert= filter.find("input[name=themeple_upload_gallery_active]");

				

				if(gallery_data && gallery_data.label && !labelInsert.length)

				{

					filter.prepend("<input type='hidden' name='themeple_upload_gallery_label' value='"+gallery_data.element.data('label')+"'/>");

				}

				

				if(gallery_data && !galleryInsert.length)

				{

					filter.prepend("<input type='hidden' name='themeple_upload_gallery_active' value='true'/>");

				}

			}

		},

        modify_tb_remove: function(){

            window.original_tb_remove_func = window.tb_remove;

            

            window.tb_remove = function(){

                

                var gallery_data = themeple_upload_gallery.window.themeple_global.gallery_editor;

                if(gallery_data){

                    

                    themeple_upload_gallery.window.themeple_global.gallery_editor = false;

                    

                    

                }

                

                window.original_tb_remove_func();

                

            }

            

        },

        

        bind_add_to_slideshow_button: function(){

            $('.themeple_add_to_slideshow').live('click', function(){

                var link 			= $(this),

					attachment_id 	= link.data('attachment-id');

                    

                if(themeple_upload_gallery.window.themeple_global.gallery_editor &&

                    themeple_upload_gallery.window.themeple_global.gallery_editor.element.data('overwrite')){

                    

                    themeple_upload_gallery.replace_image(attachment_id);        

                }else{

                    themeple_upload_gallery.request_image(attachment_id);

                }

                alert('Inserted');

                return false;

            });

        },

        

        create_add_to_slideshow_button: function(){

            if(!themeple_upload_gallery.window.themeple_global.gallery_editor) return false;

			var media_upload_container 	= $('#media-upload');

			

			if(media_upload_container.length && !themeple_upload_gallery.window.themeple_global.gallery_editor.element.data('video-insert'))

			{

			    

				var items = media_upload_container.find('.media-item').not('.button_cloned');

				items.each(function()

				{

                    var id          = $(this).attr('id').split('-');

                   

					var current 	= $(this).addClass('button_cloned'),

                        html        = '<a href="#" data-attachment-id="'+id[2]+'" class="button themeple_add_to_slideshow">Add to slideshow</a>';

						filename 	= current.find('.filename'),

						button 		= current.prepend(html);

                    

				});

			}

        },

        

        create_add_all_to_slideshow_button: function(){

            var gallery 	= $('#gallery-form'),

				gallery_data = themeple_upload_gallery.window.themeple_global.gallery_editor;

			

			if(gallery.length && gallery_data && !gallery_data.element.data('overwrite'))

			{

    			var submit = $('.ml-submit:eq(0)'),

    				update_gal = $('<input type="submit" id="themeple_insert_all_to_slideshow" class="button savebutton" value="Add all Images to Slideshow"/>');

    						

    							

    				update_gal.appendTo(submit).bind('click', function()

    				{

    					var data = {};

    					data.apply_filter = 'themeple_ajax_fetch_all';

    					

    					themeple_upload_gallery.request_image( '' , data, true);

    					return false;

    				});

				

				

			}

        },

        

        replace_image: function(attachment_id)

		{	

			var gallery_data = themeple_upload_gallery.window.themeple_global.gallery_editor;

						

			$.ajax({

	 		  type: "POST",

	 		  url: window.ajaxurl,

	 		  data: "action=themeple_get_image_ajax&attachment_id="+attachment_id,

	 		  success: function(msg)

	 		  {

	 		  	

	 		  	gallery_data.gallery_image_value.val(attachment_id);

	 		  	

	 		  	if(msg.match(/^<img/))

	 		  	{	

					gallery_data.image_field.find('a').html(msg);

	 		  	}

	 		  	else 

	 		  	{

					gallery_data.image_field.find('a').html('<img src="'+themeple_global.frameworkUrl+'images/video.png" alt="" />');

	 		  	}

	 		  	

	 		  	

	 		  	themeple_upload_gallery.window.tb_remove();

	 		  }

	 		});

		},

        

        request_image: function(attachment_id, data_passed, close){

            var gallery_data = themeple_upload_gallery.window.themeple_global.gallery_editor;

			

			var data = 

			{

				method:			'add',

				action: 		'themeple_ajax_modify_table',

				elementSlug: 	gallery_data.element.data('real-id'),

				context: 		gallery_data.context,

				apply_all:		gallery_data.element.data('attach_to_post'),

				std:			{slideshow_image: attachment_id},

				ajax_decode:	true

			};

            

			var i = 0;

			var data = $.extend(data, data_passed);

            

			if(i == 0){

                $.ajax({

    				type: "POST",

    				url: window.ajaxurl,

    				data: data,

    				success: function(response)

    				{

    					

    					var save_result = response.match(/\{themeple_ajax_element\}(.+|\s+)\{\/themeple_ajax_element\}/),

    						pass = {};

    						

    					if(save_result != null)

    					{	

    					   

    						var newSet = $(save_result[1]);

    						newSet.themeple_event_binding();

    						newSet.appendTo(gallery_data.gallery_container.find('.themeple_upload_gallery_sortable_container'));

    						

    						if(newSet.length < 5)

    						{

    							newSet.css('display','none').slideDown(400);

    						}

    							

    						

    						var single_set = newSet.filter(':eq(0)');

    						pass = {currentSet: single_set, container: single_set, setsToCount: false};

    						themeple_recalcIds(pass);

    						

    						

    						if(data.std.slideshow_video)

                                $('.slideshow_video_input', newSet).show()

    						

    				        			

    					

  							if(close == true) setTimeout( themeple_upload_gallery.window.tb_remove, 500);

    						

    						

    					}

                        

    				}

                    

    			});

                i = i+1;

            }

        },

        

        bind_video_button: function(button, content_field, close_tb)

		{

			button = $(button)

			content_field = $(content_field);

			button.click(function()

			{

				var content = content_field.val();

				if(content != "")

				{

					var data = {};

					data.std = {slideshow_image: '', slideshow_video: encodeURIComponent(content)}; 

                    

					themeple_upload_gallery.request_image(content, data, close_tb);

				}

				

				return false;

			});

		},

        

        toggle_image_info: function(){

            $('.open_img_info').live('click', function()

			{

				var element_this = $(this),

					parent = element_this.parents('.themeple_set:eq(0)');



				if(!parent.is('.set_is_open'))

				{

					parent.addClass('set_is_open');

					element_this.text(element_this.data('closedset'));

                    

                    

				}

				else

				{

					parent.removeClass('set_is_open');

					element_this.text(element_this.data('openset'));

				}

				

				return false;

			});

        }

        

        

    };

    

    $(function()

	{

	   themeple_upload_gallery.modify_tb_remove();

       

       themeple_upload_gallery.sort();

       themeple_upload_gallery.bind_upload_button();

       themeple_upload_gallery.modify_filter_url();

       themeple_upload_gallery.create_add_to_slideshow_button();

	   themeple_upload_gallery.bind_add_to_slideshow_button();

       themeple_upload_gallery.bind_video_button('#themeple_upload_video', '#src', true);

       themeple_upload_gallery.toggle_image_info();

       themeple_upload_gallery.create_add_all_to_slideshow_button();

       

	   $(".media-item").live('mouseenter',themeple_upload_gallery.create_add_to_slideshow_button());

    });

    

    

    

})(jQuery);	