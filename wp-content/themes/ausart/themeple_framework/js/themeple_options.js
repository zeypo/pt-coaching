jQuery(function($) {

    $('.themeple_container').option_pages();

    $('.themeple_main_section').themeple_generate_nav();

    $('.radio-image-wrapper input').live('change', function(){

		$(this).parent().parent().parent().find(".check-list").removeClass("check-list");

		$(this).parent().find('label').find("#check-list").addClass("check-list");

		$(this).parent().parent().parent().find('input').removeAttr('checked');

		var v = $(this).data('value');

		$(this).val(v);

		$(this).attr('checked', '');

	});	

	
    
	
    $('select.wpb-select.icon, select.wpb-select.icon_1, select.wpb-select.icon_2, select.wpb-select.icon_3, select.wpb-select.icon_4, select.wpb-select.icon_5').live('change', function(){
    	$(this).fontIconPicker();
    });


	$('.switch-button-wrapper').live('click', function(){

					var $check = $(this).find('label .ckeck-switch');

					if($check.hasClass('checked-switch-yes')){

						$check.removeClass('checked-switch-yes').addClass('checked-switch-no');

						$(this).find('input').val('no').change();

						

					}else if($check.hasClass('checked-switch-no') ){

						$check.removeClass('checked-switch-no').addClass('checked-switch-yes');

						$(this).find('input').val('yes').change();

						

					}

				});

	

    	

  });

(function($)
{
	$.fn.themeple_generate_nav = function() 
	{
		return this.each(function()
		{
			if(!$('.themeple_main_section').length) return;
		
			var container = $(this),
				headContainer = $('.themeple_header_nav',container),
				sidebar = $('.themeple_navigation ul'),
				urlHash = window.location.hash.replace(/^\#goto_/,"themeple-") || 'bosh',
				hashActive = $('.themeple_section', container).filter('[id='+urlHash+']');
					
			headContainer.each(function()
			{
				var heading = $(this),
					subContainer = heading.parent('.themeple_section'),
					slug_ = subContainer.attr('id');
					if(slug_.length > 0)
						slug_ = slug_.split('-');
					if(slug_.length > 0)
						slug_ = slug_[1];

					
					if($(subContainer).hasClass('sub_section')){
						heading.addClass('sub_section');
					}

					if(hashActive.length)
					{
						if(subContainer.is('#'+urlHash))
						{
							slug_ = urlHash;
							heading.addClass('active');
							$('.themeple_section').removeClass('active_section');
							subContainer.addClass('active_section');
						}
					}
					else
					{
						if(subContainer.is(':visible'))
						{
							heading.addClass('active');
						}
					}
					
					var hiddenDataContainer = $('#themeple_js_data', container),
						saveData = {
								container: 		container,
								subContainer:   subContainer,
								ajaxUrl :		$('input[name=admin_ajax_url]', hiddenDataContainer).val(),
								prefix :		$('input[name=db_options_prefix]', hiddenDataContainer).val(),
								optionSlug :	$('input[name=page_slug]', hiddenDataContainer).val(),
								action :		'themeple_get_options_ajax',
								ref	   :		$('input[name=_wp_http_referer]', hiddenDataContainer).val(),
								first_call:		$('input[name=first_call]', hiddenDataContainer),
                                nonceImport  :	$('input[name=themeple-nonce-dummy]', container).val(),
                                nonce:          $('input[name=nonce_save_data]', hiddenDataContainer).val()
                                
							 };
					
					heading.clone(false)
						   .appendTo(sidebar)
						   .css({display:'block'})
						   .click(function()
						   {
						   		
						   		var a = true;
						   		if(!subContainer.is(':visible'))
						   		{
						   			
						   			$('.themeple_main_section .big_loading').css({opacity:0, display:"block", visibility:'visible'}).animate({opacity:1}, 200, 'easeInOutExpo');
						   			
						   			setTimeout(function(){
						   				$('.themeple_section').not(subContainer).removeClass('active_section').css({opacity:1}).animate({opacity:0}, 200, 'easeInOutExpo').css({display:'none'});
						   			
							   			

							   			var html = subContainer.find('.elements_').html();
							   			
							   			if(subContainer.find('.elements_').length == 0){
							   				
								   		
								   			if(!subContainer.hasClass('active_section')){
								   				subContainer.trigger('loading_elements', [saveData, slug_] );
								   				
								   			}else{
								   				$('.themeple_main_section .big_loading').fadeOut();
								   			}
										}else{
											$('.themeple_main_section .big_loading').fadeOut();
										}


										
							   			subContainer.addClass('active_section').css({opacity:0, display:"block"}).animate({opacity:1}, 200, 'easeInOutExpo');



							   			
						   			}, 400);
						   			$('.themeple_header_nav').not($(this)).removeClass('active');
							   		$(this).addClass('active');
						   			
									
									
						   		}else{
						   			$('.themeple_main_section .big_loading').fadeOut();
						   		}
						   		
						   		if(subContainer.attr('id') == 'themeple-builder' || subContainer.attr('id') == 'themeple-themeple' || subContainer.hasClass('new_added')){
						   			$('.themeple_main_section .big_loading').fadeOut();
						   		}
							   		

						   		subContainer.on('finish_loading', function(){
						   			$('.themeple_main_section .big_loading').fadeOut();
						   		});	
						   });
				});
				

		});
		
		
		
	}
})(jQuery);





(function($)

{

	$.fn.option_pages = function() 

	{

		return this.each(function()

		{

			var container = $(this);

			if(container.length != 1) return;

			

			var saveButtons = $('.save_button', this),

				change_skin = $('.change_skin', this),

				dummyDataButton = $('.themeple_dummy_data', this),

				hiddenDataContainer = $('#themeple_js_data', this),

				saveData = {

								container: 		$(this),

								ajaxUrl :		$('input[name=admin_ajax_url]', hiddenDataContainer).val(),

								prefix :		$('input[name=db_options_prefix]', hiddenDataContainer).val(),

								optionSlug :	$('input[name=page_slug]', hiddenDataContainer).val(),

								action :		$('input[name=action]', hiddenDataContainer).val(),

								ref	   :		$('input[name=_wp_http_referer]', hiddenDataContainer).val(),

								first_call:		$('input[name=first_call]', hiddenDataContainer),

                                nonceImport  :	$('input[name=themeple-nonce-dummy]', container).val(),

                                nonce:          $('input[name=nonce_save_data]', hiddenDataContainer).val(),

								saveButtons: 	saveButtons

							 };



			saveButtons.bind('click', {set: saveData}, methods.save); 		//saves the current form

			

			dummyDataButton.bind('click', {set: saveData}, methods.insert_dummy_data);



			change_skin.live('click', {set: saveData}, methods.change_skin);

			

			saveButtons.removeClass('themeple_btn_inaction').addClass('themeple_btn_active');

			

			

		});

	};

	

	var	methods = {



 

		save: function(passed, hiddensave)

		{

			if(typeof hiddensave == 'undefined') hiddensave = false;

			

			var me = hiddensave == true ? passed : passed.data.set,

				buttonClicked = $(this),

				elements_input	= $('input:text','.themeple_box'),

				elements_select	= $('select','.themeple_box'),

				elements_textarea	= $('textarea','.themeple_box'),

				elements_radio	= $('input:checked','.themeple_box'),

				elements_hidden	= $('input[type=hidden]','.themeple_box'),

				dataString = "";	

			

			

			

			 

			elements_input.each(function()

			{

                

				var currentElement = $(this),		

					value = currentElement.val(),		

					name = currentElement.attr('name');		

				

				if(name != '')

				{	

					dataString  += "&" + name + "=" + encodeURIComponent(value);

				}

			});





			elements_select.each(function()

			{

                

				var currentElement = $(this),		

					value = currentElement.val(),		

					name = currentElement.attr('name');		

				

				if(name != '')

				{	

					dataString  += "&" + name + "=" + encodeURIComponent(value);

				}

			});

			

			elements_textarea.each(function()

			{

                

				var currentElement = $(this),		

					value = currentElement.val(),		

					name = currentElement.attr('name');		

				

				if(name != '')

				{	

					dataString  += "&" + name + "=" + encodeURIComponent(value);

				}

			});

			elements_radio.each(function()

			{

                

				var currentElement = $(this),		

					value = currentElement.val(),		

					name = currentElement.attr('name');		

				

				if(name != '')

				{	

					dataString  += "&" + name + "=" + encodeURIComponent(value);

				}

			});



			elements_hidden.each(function()

			{

                

				var currentElement = $(this),		

					value = currentElement.val(),		

					name = currentElement.attr('name');		

				

				if(name != '')

				{	

					dataString  += "&" + name + "=" + encodeURIComponent(value);

				}

			});

			

			dataString = dataString.substr(1);

			

			var dynamicOrder = "",

				dynamicElements = $('.themeple_box, .themeple_set').not('.themeple_single_set .themeple_box'),

				id_order_string = "";

				

			if(dynamicElements.length && $('.themeple_row').length)

			{

				

				dynamicElements.each(function()

				{

				    

					id_order_string = this.id.replace(/^themeple_/,'').replace(/-__-0$/,'');

					dynamicOrder += id_order_string + '-__-';

                    

				});

			}



			$.ajax({

					type: "POST",

					url: me.ajaxUrl,

					data: 

					{

						action: me.action,

						_wpnonce: me.nonce,

						_wp_http_referer: me.ref,

						prefix: me.prefix,

						slug: me.optionSlug,

                        dynamicOrder: dynamicOrder,

						data: dataString

						

					},

                    beforeSend: function(){

                        $('.loading', me.container).css({opacity:0, display:"block", visibility:'visible'}).animate({opacity:1});  

                    },

					error: function()

					{

						

                        if(hiddensave) return;

					    $('.save_message').html("Error. Please try again");

					},

					success: function(response)

					{

						

                        $('.save_message').html("Saved with success.");	

                        if(hiddensave) return;

                        

					},

                    complete: function(response){

                        $('.loading', me.container).fadeOut();

                    }

                    

                    

				});

			

			return false;

		},

        insert_dummy_data: function(passed){

            var button = $(this),

				me = passed.data.set,

				answer = "";

    

			$.ajax({

						type: "POST",

						url: me.ajaxUrl,

						data: 

						{

							action: 'themeple_ajax_dummy_data',

							_wpnonce: me.nonceImport,

							_wp_http_referer: me.ref

						},

                        beforeSend: function(){

                          $('.loading', me.container).css({opacity:0, display:"block", visibility:'visible'}).animate({opacity:1});   

                        },

						error: function()

						{

							$('.save_message').html("Error. Please try again");

							

						},

						success: function(response)

						{

							if(response.match('themeple_dummy'))

							{

								response = response.replace('themeple_dummy','');

								$('.save_message').html("Imported with success.");

								setTimeout(function(){

								    window.location.hash = "#wpwrap";

						 			window.location.reload(true);

								

                                }, 3000);

							}

							else

							{

								$('.save_message').html("Error. Please try again");

							}

						},

                        complete: function(response){

                            $('.loading', me.container).fadeOut();

                        }

					});

					

			return false;

        },

        change_skin: function(passed){

            var button = $(this),

            	parent = button.parent();

				me = passed.data.set,

				array_name = button.data('array_name'),

				answer = "";

    

			$.ajax({

						type: "POST",

						url: me.ajaxUrl,

						data: 

						{

							action: 'themeple_ajax_change_skin',

							_wpnonce: me.nonce,

							_wp_http_referer: me.ref,

							prefix: me.prefix,

							slug: me.optionSlug,

							color: button.attr("id"),

							array_name : array_name

						},

                        beforeSend: function(){

                          $('.loading', parent).css({opacity:0, display:"block", visibility:'visible'}).animate({opacity:1});   

                        },

						error: function()

						{

							alert("error");

							

						},

						success: function(response)

						{

							if(response.match('themeple_changed_skin'))

							{

								response = response.replace('themeple_changed_skin','');

								alert("Changed with success :)");

								setTimeout(function(){

								    window.location.hash = "#wpwrap";

						 			window.location.reload(true);

								

                                }, 3000);

							}

							else

							{

								alert("Error. please try again");

							}

						},

                        complete: function(response){

                            $('.loading', parent).fadeOut();

                        }

					});

					

			return false;

        }



	};

	

	

})(jQuery);





(function($)

{

	$.fn.themeple_event_binding = function(variables) 

	{		

		return this.each(function()

		{		

			if(window.parent && window.parent.document && variables != 'skip')

			{

				parent.jQuery(window.parent.document.body).trigger('themeple_event_binding',[this]);

				return;

			}

			

			var container = $(this);

			

			if($.fn.themeple_generate_sets) 		container.themeple_generate_sets();

			if($.fn.themeple_form_requirement) 			$('.themeple_required_container', container).not('.themeple_delay_required .themeple_required_container').themeple_form_requirement();

			$('.radio-image-wrapper input').each(function(){
		    	var dt = $(this).data('value');
		    	$(this).val(dt);
		    });

		});

	};

})(jQuery);	





(function($)

{

	$.fn.themeple_generate_sets = function(variables) 

	{

		return this.each(function()

		{



			var container = $(this);

			

			if(container.length != 1) return;

			var hiddenDataContainer = $('#themeple_js_data'),

				saveData = {

							container    : 	container,

							createButton : 	$('.themeple_clone', this),

							removeButton : 	$('.themeple_remove', this),

							nonce:          $('input[name=nonce_save_data]', hiddenDataContainer).val(),

							ajaxUrl :		$('input[name=admin_ajax_url]', hiddenDataContainer).val(),

							ref	   :		$('input[name=_wp_http_referer]', hiddenDataContainer).val(),

							prefix :		$('input[name=db_options_prefix]', hiddenDataContainer).val(),

							meta_active:	$('input[name=meta_active]', hiddenDataContainer)

							};

            

			

            saveData.createButton.unbind('click').bind('click', {set: saveData}, methods.add); 

			saveData.removeButton.unbind('click').bind('click', {set: saveData}, methods.remove); 

			

			

		});

	};

	

	var currentlyModifying = false,

	 	methods = {

	



 

		add: function(passed)

		{

			

			if(currentlyModifying) return false;

			currentlyModifying = true;

		



			var data = passed.data.set,

				currentButton = $(this),

				

				cloneContainer = currentButton.parents('.themeple_set:eq(0)'),

				parentCloneContainer = currentButton.parents('.themeple_set:eq(1)'),

				elementSlug = cloneContainer.attr('id');

			

			if(parentCloneContainer.length == 1)

			{

				var removeString = parentCloneContainer.attr('id');

				

				elementSlug = elementSlug.replace(removeString+'-__-','').replace(/-__-\d+/,'');

			}

			else

			{

				elementSlug = elementSlug.replace('themeple_','').replace(/-__-\d+/,'');

			}



			var page_context = 'admin_page';

			if(data.meta_active.length) page_context = 'metabox';

	

			$.ajax({

					type: "POST",

					url: data.ajaxUrl,

					data: 

					{

						action: 'themeple_ajax_modify_table',

						method: 'add',

						elementSlug: elementSlug,

						context: page_context

						

					},

					beforeSend: function()

					{

						

					},

					error: function()

					{

						alert('error');

					},

					success: function(response)

					{

						var save_result = response.match(/\{themeple_ajax_element\}(.+|\s+)\{\/themeple_ajax_element\}/);

						

						if(save_result != null)

						{	



							var newSet = $(save_result[1]).css('display','none');

							

							methods.setBlank(newSet);

							newSet.insertAfter(cloneContainer).slideDown(400, function()

							{



								data.currentSet = newSet;

								methods.recalcIds(data);



								newSet.themeple_event_binding();

							});



							if(save_result[0] != response)

							{

								response = response.replace(save_result[0],'');

								alert(response);	

							}

							

						}



					},

					complete: function(response)

					{	

						

						currentlyModifying = false;

					}

				});		



			return false;

		},

		

		remove: function(passed)

		{

            

			if(currentlyModifying) return false;

			currentlyModifying = true;

            

			var data = passed.data.set,

				currentButton = $(this),

				singleSet = currentButton.parents('.themeple_set:eq(0)'),

				id = singleSet.attr('id').replace(/-__-\d+$/,'-__-');

				

				data.setsToCount = singleSet.siblings('.themeple_set').filter('[id*='+id+']');



				if(data.setsToCount.length || data.removeButton.is('.remove_all_allowed'))

				{

					data.currentSet = data.setsToCount.filter(':eq(0)');

					

					singleSet.slideUp(400, function()

					{

						singleSet.remove();

						methods.recalcIds(data);

						currentlyModifying = false;	

					});

				

				}

				else

				{

					methods.setBlank(singleSet);

					data.setsToCount = false;

					currentlyModifying = false;	

					

				}

					

			return false;

		},



		setBlank: function(container)

		{

			$('input:text, input:hidden, textarea, input:radio', container).not('.themeple_upload_insert_label, .themeple_required').val('').trigger('change');						

			$('input:checkbox, input:radio, select, input:radio', container).removeAttr("checked").removeAttr("selected").trigger('change');

			$('.themeple_preview_pic, .themeple_color_picker_div', container).html("").css({backgroundColor:'transparent'});

		},





		recalcIds: function(data)

		{

			themeple_recalcIds(data);

		}

		



	};



	

	    

	    themeple_recalcIds = function(data)

		{	

					if(!data.setsToCount)

			{					

				var id = data.container.attr('id').replace(/-__-\d+$/,'-__-');

				data.setsToCount = data.currentSet.siblings('.themeple_set').filter('[id*='+id+']').add(data.currentSet);



			var parentGroup = data.currentSet.parents('.themeple_set:eq(0)'),

				newId = "";



			

			if(parentGroup.length == 1)

			{

				newId = data.currentSet.attr('id').replace('themeple_','');

				newId = parentGroup.attr('id') +'-__-'+ newId.replace(/\d+$/,'');

			}

			else

			{	

				if(data.currentSet.attr('id'))

				{

					newId = data.currentSet.attr('id').replace(/\d+$/,'');

				}

			}

			



 

			data.setsToCount.each(function(i)

			{

				var currentSet = $(this),

					elements = $('[id*=-__-], [name*=-__-]', this),

					setId = newId + i;

				

				this.id = setId;



				elements.each(function()

				{

					

					var element = $(this),

						el_attr = this.id,

						parentSet = element.parents('.themeple_set:eq(0)'),

						replacementString = parentSet[0].id.replace('themeple_','');

							

						var match = el_attr.match(/[a-z0-9](-__-[-_a-zA-Z0-9]+-__-\d+)$/);

						

						if(match == null)

						{

							var myRegexp = /.+-__-([-_a-zA-Z0-9]+)$/;

							match = myRegexp.exec(el_attr);

							

							id_string = replacementString + '-__-' + match[1];

							

							if(this.name)

							{

								this.name = id_string;

							}

							else

							{

								id_string = 'themeple_' +id_string;

							}

							this.id = id_string;

							

						}

						else 

						{

							el_attr_array = match[1];

							this.id = 'themeple_' + replacementString + el_attr_array;

						}

					

				});

			});



			data.setsToCount = "";

			

			

			return;			

		}

        } 



	

})(jQuery);	





(function($)

{

	$.fn.themeple_event_listener = function(variables) 

	{	

		this.bind('themeple_event_binding', function(event, element)

		{

			parent.jQuery(element).themeple_event_binding('skip');

		});

	};

})(jQuery);

jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});