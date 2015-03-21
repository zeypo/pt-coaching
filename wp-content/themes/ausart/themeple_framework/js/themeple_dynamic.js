

jQuery(function($) { 
    
    $('body').themeple_event_listener();
    $('.themeple_section').themeple_generate_dynamic(); 

                     $('.themeple_sortable').themeple_dynamic_active();
                     
                     $('.themeple_set').themeple_generate_sets();
    	
   	
    });
	
	

(function($)
{
	
    themeple_global.added_bool = false;
	$.fn.themeple_generate_dynamic = function(variables) 
	{
		return this.each(function()
		{

			var container = $(this);
			if(container.length != 1) return;
			
			var createButton = $('.themeple_add_option_page', this),
				createElementButton = $('a.themeple_add_dynamic_element'),
				hiddenDataContainer = $('#themeple_js_data'),
				deletePage = $('.themeple_remove_dynamic_page',this),
                select_columns = $('.themeple_select_columns', this),
				deleteElement = $('.themeple_remove_dynamic_element',this),
				nameElement = createButton.parents('.themeple_create_option_page_container:eq(0)').find('input.themeple_create_input_name'),
				saveData = {
								
								ajaxUrl :		    $('input[name=admin_ajax_url]', hiddenDataContainer).val(),
								prefix :		    $('input[name=db_options_prefix]', hiddenDataContainer).val(),
								optionSlug :	    $('input[name=page_slug]', hiddenDataContainer).val(),
								_wpnonce  :			$('input[name=nonce_save_data]', hiddenDataContainer).val(),
								_wp_http_referer:	$('input[name=_wp_http_referer]', hiddenDataContainer).val()
							 };
			container.not('.active_section').bind('loading_elements', {}, methods.loading_elements);				 
			createButton.bind('click', {set: saveData}, methods.add_options_page);

			createElementButton.live('click', {set: saveData}, methods.add_element);
			
			deletePage.live('click', {set: saveData}, methods.delete_options_page);
			
			deleteElement.live('click', {set: saveData}, methods.delete_element);
			select_columns.live('change', {set:saveData}, methods.select_columns);

			nameElement.bind('keydown change keyup keypress', function(event)
			{
				if(nameElement.val() != "" && nameElement.val().length > 2)
				{
					createButton.removeClass('themeple_btn_inactive');
                    createButton.addClass('themeple_btn_active');
				}
				else if(!createButton.is('.themeple_btn_inactive'))
				{
                    createButton.removeClass('themeple_btn_active');
					createButton.addClass('themeple_btn_inactive');
				}
				
				if(event.keyCode == 13)
				{
					if(event.type == 'keyup') createButton.trigger('click');
					return false;
				}
				
			});

			
			});
	};
	
	var	methods = {

			loading_elements: function(event, saveData, slug_){
				var subContainer = saveData.subContainer;
				
				event.stopPropagation();
				if(subContainer.find('.elements_').length == 0){
					$.ajax({
													type: "POST",
													url: saveData.ajaxUrl,
													data: 
													{
														action: saveData.action,
														_wpnonce: saveData.nonce,
														_wp_http_referer: saveData.ref,
														prefix: saveData.prefix,
														slug: saveData.optionSlug,
														slug_: slug_
														
														
													},
								                    beforeSend: function(){
								                        
								                         
								                    	
								                    },
													error: function()
													{
														subContainer.trigger('finish_loading');
													    alert("error");
													},
													success: function(response)
													{
														
														subContainer.append(response);
														subContainer.themeple_dynamic_active();
														if($.fn.themeple_form_requirement) 			
															$('.themeple_required_container', subContainer).not('.themeple_delay_required .themeple_required_container').themeple_form_requirement();

								                         $('.themeple_set', subContainer).themeple_generate_sets();
								                         $('.radio-image-wrapper input').each(function(){
													    	var dt = $(this).data('value');
													    	$(this).val(dt);
													    });
													},
								                    complete: function(response){
								                       
								                       subContainer.trigger('finish_loading');

								                    }
								                    
								                    
					});
				}else{
					subContainer.trigger('finish_loading');
				}

				 

			},

			add_options_page: function(passed)
			{
			     
				var params = passed.data.set,
					clickedButton = $(this),
					wrapper = clickedButton.parents('.themeple_create_option_page_container:eq(0)'),
					nameElement = $('input.themeple_create_input_name', wrapper);


				
				
				if(clickedButton.is('.themeple_btn_inactive')) return false;

				params.action = 'themeple_ajax_create_dynamic_options';
				params.method = 'add_option_page';
				params.name = nameElement.val();
                params.parent = $('.themeple_option_page_parent', wrapper).val();
				params.default_elements = $('.themeple_subelements_dynamic_page', wrapper).val();
                params.sortable = $('.themeple_option_page_sortable', wrapper).val();
	
				if(params.name == "")
				{
					alert('Ooops!<br/>You forgot to enter a Name for your template');
					return false;
				}

				
                $.ajax({
					type: "POST",
					url: params.ajaxUrl,
					data: params,
					
					success: function(response)
					{
						var save_result = response.match(/\{themeple_ajax_option_page\}(.+|\s+)\{\/themeple_ajax_option_page\}/);
				        
						if(save_result != null)
						{	

							var newSet = $(save_result[1]).insertAfter('.themeple_section:last');
							newSet.themeple_generate_nav(true);
							nameElement.val('');
							alert('Template added');
							newSet.addClass('new_added');
							var default_elements = response.match(/\{themeple_ajax_element\}(.+|\s+)\{\/themeple_ajax_element\}/);
							if(default_elements != null)
							{
								var newElements = $(default_elements[1]).appendTo(newSet); 
							}
							newSet.themeple_dynamic_active();
							if($.fn.themeple_form_requirement) 			
								$('.themeple_required_container', newSet).not('.themeple_delay_required .themeple_required_container').themeple_form_requirement();
                            
						}
					   
						
					},
					complete: function(response)
					{	
						
					}
				});
				
				return false;
			},
            
            add_element: function(passed){
                var params = passed.data.set,
					clickedButton = $(this),
					wrapper = clickedButton.parents('.themeple_dynamical_add_elements_container:eq(0)'),
					currentpage = wrapper.parents('.themeple_section:eq(0)'),
					selectElement = $('select.themeple_dynamical_add_elements_select', wrapper),
					loading = $('.themeple_loading',  wrapper);

				if(themeple_global.added_bool) return false;
                themeple_global.added_bool = true; 
				if(selectElement.val() == "") return false;
				
				
				
				params.elementSlug = selectElement.val();
				params.optionSlug = $('input.themeple_dynamical_add_elements_parent', wrapper).val();
				params.configFile = $('input.themeple_dynamical_add_elements_config_file', wrapper).val();
				params.action = 'themeple_ajax_modify_table';
				params.context = 'custom_set';
				params.method = 'add';

				$.ajax({
					type: "POST",
					url: params.ajaxUrl,
					data: params,
					
					success: function(response)
					{
						var save_result = response.match(/\{themeple_ajax_element\}(.+|\s+)\{\/themeple_ajax_element\}/);
						
						if(save_result != null)
						{	

							var newSet = $(save_result[1]).css('display','none');
							
							newSet.appendTo(currentpage).slideDown(400, function()
							{

								
							});

							
                            
							
						}
						else
						{
							var resulttext = "Something went wrong, please try again in a few seconds.";
							if(response) resulttext +=  "The script returned the following error: <br/><br/>"+response;
							alert(resulttext);
						}
						$('.themeple_set').themeple_generate_sets();
						$('.themeple_required_container').not('.themeple_delay_required .themeple_required_container').themeple_form_requirement();
						var nr = new Array({col:3, name:"1/4"},{col:4, name:"1/3"},{col:6, name:"1/2"},{col:8, name:"2/3"},{col:9, name:"3/4"},{col:12, name:"1/1"});
						$('.themeple_row .plus_column').bind('click', function(){
							var $row = $(this).parent().parent().parent();
							var actual = $row.attr('class');
							actual = actual.split("element");
							actual = actual[1].substring(0,2);
							var actual_index = 0;
							for(i = 0; i < nr.length; i++){
								if(nr[i].col == actual)
									actual_index = i;	
							}
							var index = actual_index+1;
							if(index > nr.length-1)
								index = nr.length-1;
							setTimeout(function(){
								$row.removeClass('element'+actual).addClass('element'+nr[index].col);
								$row.find('input.hidden_size').val(nr[index].col);
								$row.find('.size_column span').html(nr[index].name);
							},500);
					});	
					$('.themeple_row .minus_column').bind('click', function(){
							var $row = $(this).parent().parent().parent();
							var actual = $row.attr('class');
							actual = actual.split("element");
							actual = actual[1].substring(0,2);
							var actual_index = 0;
							for(i = 0; i < nr.length; i++){
								if(nr[i].col == actual)
									actual_index = i;	
							}
							var index = actual_index-1;
							
							if(index < 0)
								index = 0;
							setTimeout(function(){
								$row.removeClass('element'+actual).addClass('element'+nr[index].col);
								$row.find('input.hidden_size').val(nr[index].col);
								$row.find('.size_column span').html(nr[index].name);
							},500);
							

					});	
					
					$(".fancycontent").magnificPopup({
					  type:'inline',
					  midClick: true
					});


					},
					complete: function(response)
					{
						themeple_global.added_bool = false;
						
					}
				});
				
					
				return false;
            },
            delete_element: function(passed)
			{
				
				if( themeple_global.added_bool) return false;
				 themeple_global.added_bool = true;
			
				var params = passed.data.set,
					link = $(this);
					
				var container = link.parents('.themeple_row:eq(0)');
				if(!container.length) container = link.parents('.themeple_section:eq(0)');

				params.elementSlug = this.hash.substring(1);
				
				params.action = 'themeple_ajax_delete_dynamic_element';
				
				$.ajax({
					type: "POST",
					url: params.ajaxUrl,
					data: params,
					
					success: function(response)
					{
						if(response.match(/themeple_removed_element/))
						{
							container.slideUp(400, function()
							{
								container.remove();
								
								 themeple_global.added_bool = false;
							});
								
							
							
						}
						else
						{
							alert("Error. Please try again");
							themeple_global.added_bool = false;
						}
						
					}
				});
					
					
					return false;
			},
            delete_options_page: function(passed)
			{
				if( themeple_global.added_bool) return false;
				 themeple_global.added_bool = true;
			
				var params = passed.data.set,
					link = $(this),
					container = link.parents('.themeple_section:eq(0)'),
					answer = confirm("Do you really want to delete this page?");


				params.action = 'themeple_ajax_delete_dynamic_options';
				params.elementSlug = this.hash.substring(1);
				
				if(answer)
				{
					$.ajax({
					type: "POST",
					url: params.ajaxUrl,
					data: params,
					success: function(response)
					{
						if(response.match(/themeple_removed_page/))
						{
							$('.themeple_navigation .active').remove();
							container.remove();
							
							$('.themeple_section').filter(':eq(0)').addClass('active_section').css({opacity:1, display:'block'});
							$('.themeple_navigation .themeple_header_nav:eq(0)').addClass('active');
								
						}
						else
						{
							alert("Error.Please try again "+ response);
						}
						
						themeple_global.added_bool = false;
					}
				  });

				}
				else
				{ 
						themeple_global.added_bool = false;
				}
					
				return false;
			},
				
		};
	
	
})(jQuery);	 

(function($)
{
	

	$.fn.themeple_dynamic_active = function(variables) 
	{
		return this.each(function()
		{

			var container = $(this);
			if(container.length != 1) return;
			
			container.sortable({
				
				handle: '.themeple-row-header',
				cancel: 'a',
				items: '.themeple_row',
				update: function(event, ui) 
				{
					$('.themeple_btn_inactive').removeClass('themeple_btn_inactive').addClass('themeple_btn_active');
				}

			});
			
			$( ".themeple-row-header" ).disableSelection();	
			
			$(".fancycontent").magnificPopup({
			  type:'inline',
			  midClick: true
			});
			
		   
			var nr = new Array({col:3, name:"1/4"},{col:4, name:"1/3"},{col:6, name:"1/2"},{col:8, name:"2/3"},{col:9, name:"3/4"},{col:12, name:"1/1"});
			$('.themeple_row .plus_column', container).bind('click', function(){
							var $row = $(this).parent().parent().parent();
							var actual = $row.attr('class');
							actual = actual.split("element");
							actual = actual[1].substring(0,2);
							var actual_index = 0;
							for(i = 0; i < nr.length; i++){
								if(nr[i].col == actual)
									actual_index = i;	
							}
							var index = actual_index+1;
							if(index > nr.length-1)
								index = nr.length-1;
							
							$row.removeClass('element'+actual).addClass('element'+nr[index].col);
							$row.find('input.hidden_size').val(nr[index].col);
							$row.find('.size_column span').html(nr[index].name);

					});	
					$('.themeple_row .minus_column', container).bind('click', function(){
							var $row = $(this).parent().parent().parent();
							var actual = $row.attr('class');
							actual = actual.split("element");
							actual = actual[1].substring(0,2);
							var actual_index = 0;
							for(i = 0; i < nr.length; i++){
								if(nr[i].col == actual)
									actual_index = i;	
							}
							var index = actual_index-1;
							
							if(index < 0)
								index = 0;
							
							$row.removeClass('element'+actual).addClass('element'+nr[index].col);
							$row.find('input.hidden_size').val(nr[index].col);
							$row.find('.size_column span').html(nr[index].name);

					});	

				
			
		});
		
	}
	
})(jQuery);	 



jQuery(function($) {

	
   
    $('.themeple_required_container').not('.themeple_delay_required .themeple_required_container').themeple_form_requirement();
 

    
  });
(function($)
{
	$.fn.themeple_form_requirement = function(variables) 
	{	
		return this.each(function()
		{
			
			var container = $(this),
				basicData = { 
							el: container,
							elHeight : container.css({display:"block", height:"auto"}).height(),
							elPadd : { top: container.css("paddingTop"), bottom: container.css("paddingBottom")  },
							required : $('.themeple_required', this).val().split('::')
						};
				
				var base_id = $('.themeple_required', this).parents('.themeple_box:eq(0)').attr('id');
				

				if(typeof base_id != 'string') base_id = $('.themeple_required', this).parents('.themeple_visual_set:eq(0)').attr('id');
				
				var unique_event_id = base_id.split('-__-');
				
				if(typeof unique_event_id[1] != 'undefined') 
				{
					unique_event_id = unique_event_id[unique_event_id.length-1];
				}
				else
				{
					unique_event_id = unique_event_id[0];
				}
				
				container.css({display:'none'});
				

				var elementToWatchWrapper = container.siblings('div[id$='+basicData.required[0]+']');
				
				
			
				if(elementToWatchWrapper.length == 0) elementToWatchWrapper = container.parents('.inside').find('div[id$='+basicData.required[0]+']');
				if(elementToWatchWrapper.length == 0) elementToWatchWrapper = container.parents('.inside').parent().parent().find('div[id$='+basicData.required[0]+']');
				
				var elementToWatch = $(':input[name$='+basicData.required[0]+']', elementToWatchWrapper);
				
				
				if(elementToWatch.length == 0) elementToWatch = $(':input[name$='+basicData.required[0]+']');
				
				if(container.is('.inactive_visible'))
				{
					$('<div class="themeple_inactive_overlay"><span>'+container.data('group-inactive')+'</span></div>').appendTo(container);
				}

				if(elementToWatch.is(':checkbox'))
				{	
					if((elementToWatch.attr('checked') && basicData.required[1]) || (!elementToWatch.attr('checked') && !basicData.required[1]) ) 
					{ 
						if(container.is('.inactive_visible'))
						{
							container.addClass('themeple_visible');
						}
						else
						{
							container.css({display:'block'}); 
						}
					}
				}
				else
				{
					if(elementToWatch.val() == basicData.required[1] || 
					  (elementToWatch.val() != "" && basicData.required[1] == "{true}") || (elementToWatch.val() == "" && basicData.required[1] == "{false}") ||
					  (basicData.required[1].indexOf('{contains}') !== -1 && elementToWatch.val().indexOf(basicData.required[1].replace('{contains}','')) !== -1) ||
					  (basicData.required[1].indexOf('{higher_than}') !== -1 && parseInt(elementToWatch.val()) >= parseInt((basicData.required[1].replace('{higher_than}',''))))
					
					) 
					{ 
						if(container.is('.inactive_visible'))
						{
							container.addClass('themeple_visible');
						}
						else
						{
							container.css({display:'block'}); 
						}
					}
				}
				
				elementToWatch.bind('change', {set: basicData}, methods.change);
				
						
		});
	};
	
	

	var methods = 
	{
		change: function(passed)
		{
			
			$('.themeple_required').parent().addClass('.inactive_visible');
			var data = passed.data.set,
				elToCheck = $(this);
			
			if(elToCheck.val() == data.required[1] ||
			(elToCheck.val() != "" && data.required[1] == "{true}") || (elToCheck.val() == "" && data.required[1] == "{false}") ||
			(elToCheck.is(':checkbox') && (elToCheck.attr('checked') && data.required[1] || !elToCheck.attr('checked') && !data.required[1])) ||
			(data.required[1].indexOf('{contains}') !== -1 && elToCheck.val().indexOf(data.required[1].replace('{contains}','')) !== -1) ||
			(data.required[1].indexOf('{higher_than}') !== -1 && parseInt(elToCheck.val()) >= parseInt((data.required[1].replace('{higher_than}',''))))
			)
			{
				if(data.el.is('.inactive_visible'))
				{
					data.el.addClass('themeple_visible');
					return;
				}
				
				
				if(data.el.css('display') == 'none')
				{
					
					if(data.elHeight == 0)
					{
						data.elHeight = data.el.css({visibility:"hidden", position:'absolute'}).height();
					}
				
					data.el.css( {height:0, opacity:0, overflow:"hidden", display:"block", paddingBottom:0, paddingTop:0, visibility:"visible", position:'relative'}).animate(
							{height: data.elHeight, opacity:1, paddingTop: data.elPadd.top, paddingBottom: data.elPadd.bottom}, function()
							{
								data.el.css({overflow:"visible", height:"auto"});
							});
				}
			}
			else
			{
									
				if(data.el.is('.inactive_visible'))
				{
					data.el.removeClass('themeple_visible');
					return;
				}
				
				if(data.el.css('display') == 'block')
				{
					if(data.el.is('.set_blank_on_hide')) { var blank_el = data.el.find('.set_blank_on_hide'); blank_el.val("").trigger('change'); }
					data.el.css({overflow:"hidden"}).animate({height:0, opacity:0, paddingBottom:0, paddingTop:0}, function()
					{
						data.el.css({display:"none", overflow:"visible", height:"auto"});
						
					});
				}
			}
		}
	};
	
})(jQuery);	

