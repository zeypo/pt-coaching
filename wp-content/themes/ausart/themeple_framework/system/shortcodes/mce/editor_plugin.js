(function () {

    tinymce.create("tinymce.plugins.ShortcodeNinjaPlugin", {
        
        init: function (d, e) {
            var final_data = [];
            var _self = this;
            d.addCommand("scnOpenDialog", function (a, c) {

                scnSelectedShortcodeType = c.identifier;

                jQuery.get(e + "/dialog.php", function (b) {

                    jQuery("#scn-dialog").remove();

                    jQuery("body").append(b);

                    jQuery("#scn-dialog").hide();

                    var f = jQuery(window).width();

                    b = jQuery(window).height();

                    f = 720 < f ? 720 : f;

                    f -= 80;

                    b -= 84;

                    tb_show("Insert Shortcode", "#TB_inline?width=" + f + "&height=" + b + "&inlineId=scn-dialog");

                    jQuery("#scn-options h3:first").text("Customize the " + c.title + " Shortcode")

                })

            });

            /*d.onNodeChange.add(function (a, c) {

                c.setDisabled("scn_button", a.selection.getContent().length > 0)

            })*/

            d.addButton( 'scn_button', {
                type: 'menubutton',
                text: "",
                title : 'Insert Shortcode',
                image : themeple_global.frameworkUrl + "system/shortcodes/mce/img/icon.png",
                icons : false,
                menu: _self.createControl(d, final_data)
           });




        },

        

        control_by_key: function(passed_key, a, b)

        {

        	var shortcodes = false, key;

        	if(themeple_global && themeple_global.shortcodes) shortcodes = themeple_global.shortcodes;

        

	        if(shortcodes)

			{	

				for (key in shortcodes)

				{	

					if( passed_key == false && typeof shortcodes[key] == 'string')

					{

						a.addWithDialog(b, shortcodes[key].charAt(0).toUpperCase() + shortcodes[key].slice(1), shortcodes[key].toLowerCase().replace(/ /,'_'));

					} 

					else if(key == passed_key )

					{

						for (sub_key in shortcodes[key])

						{

							a.addWithDialog(b, shortcodes[key][sub_key].charAt(0).toUpperCase() + shortcodes[key][sub_key].slice(1), sub_key);

						}	

					}

				}

            }

        },

        

        createControl: function (d, b) {



                var a = this;

                var shortcodes = false, key, remove = {};

                if(themeple_global && themeple_global.shortcodes) 

                {

                	shortcodes = themeple_global.shortcodes;

                	

                	if(typeof themeple_global.shortcodes.remove != 'undefined')

                	{

	                	remove = themeple_global.shortcodes.remove;

                	}

                }

                

                

                    a.addWithDialog(b, "Content Row", "contentrow");

                    a.addWithDialog(b, "Columns", "columns");

                    a.addWithDialog(b, "Dropcast", "dropcast");
                    
                   
                 
                    a.addWithDialog(b, "Abbreviations", "abbreviations");

                    a.addWithDialog(b, "Header Title", "header_title");

                    a.addWithDialog(b, "Social Icons", "social_icons");
                    
		            a.addWithDialog(b, "Textbar", "textbar");

                    a.addWithDialog(b, "Highlights", "highlights");

                    a.addWithDialog(b, "Light Box", "lightbox");

                    a.addWithDialog(b, "Audio", "player_audio");

                    a.addWithDialog(b, "Lists", "lists");

                    a.addWithDialog(b, "Table", "simple_table");

                    a.control_by_key(  "inline", a , b); 


                    a.addWithDialog(b, "Contact Form", "contact_form");

                    a.addWithDialog(b, "Counter Animation", "counter");

                    a.addImmediate(b, "Google map", "<br> [google_map][/google_map] <br>");

                    a.addImmediate(b, "Word Animation", "<br> [wordanimation]word1 <br /> word2 <br /> word3 <br /> word4 <br /> word5 <br /> word6 <br />[/wordanimation] <br>");


                    a.addWithDialog(b, "Buttons", "buttons");

                    a.addWithDialog(b, "Image Style", "image_style");

                    a.addWithDialog(b, "Icons", "icon");

                    a.addWithDialog(b, "Text Align Container", "text_align");
                    a.addWithDialog(b, "Font Customizer", "font_customizer");

                    a.addWithDialog(b, "Block Quote", "blockquote");

                    /*a.addImmediate(b, "Services List", "[services_list][/services_list]");*/
                    
		           

                    a.addWithDialog(b, "Service Element", "service_element");

		            a.addImmediate(b, "Add full width image", "<br> [full_image] <br> [/full_image] <br>");



                   /* c = b.addMenu({

                        title: "Navigations"

                    });

                    a.addImmediate(c, "Create Navigation", "<br> [navigation] <br> [/navigation] <br>");

                    a.addWithDialog(c, "Add navigation list", "navigation_list");

                    a.addWithDialog(c, "Add Element to list", "navigation_element"); */

                    var c = [];
                    
                    a.addImmediate(c, "Create Breadcrumb", "<br> [breadcrumb] <br> [/breadcrumb] <br>");

                    a.addWithDialog(c, "Add Element", "breadcrumb_element");
                    
                    b.push({

                        text: "Breadcrumbs",
                        menu: c

                    });


                    a.addWithDialog(b, "Labels and badges", "labels");
                    
                    c = [];

                    a.addImmediate(c, "Create Thumbnails Container", "<br> [thumbnails] <br> [/thumbnails] <br>");

                    a.addWithDialog(c, "Add Thumbnail", "thumbnail");

                    b.push({

                        text: "Thumbnails",
                        menu: c

                    });
                   

                    

                    a.addWithDialog(b, "Alerts", "alert");

                    a.addWithDialog(b, "Progress Bar", "progressbar");



                    a.control_by_key(  "inline", a , b); 

                    c = [];

                    a.addImmediate(c, "H1 Heading", "<br> [h1_heading][/h1_heading] <br>");

                    a.addImmediate(c, "H2 Heading", "<br> [h2_heading][/h2_heading] <br>");

                    a.addImmediate(c, "H3 Heading", "<br> [h3_heading][/h3_heading] <br>");

                    a.addImmediate(c, "H4 Heading", "<br> [h4_heading][/h4_heading] <br>");

                    a.addImmediate(c, "H5 Heading", "<br> [h5_heading][/h5_heading] <br>");

                    a.addImmediate(c, "H6 Heading", "<br> [h6_heading][/h6_heading] <br>");

                    b.push({

                        text: "Heading",
                        menu: c

                    });

                  /*  b.addSeparator();

                    c = b.addMenu({

                        title: "Dropdowns"

                    });

                    a.addImmediate(c, "Create Dropdown Container", "<br> [dropdown_container] <br> [/dropdown_container] <br>");

                    a.addWithDialog(c, "Add Button (Select Dropdown)", "buttons");

                    a.addImmediate(c, "Add Dropdown Elements Container", "<br> [dropdown] <br> [/dropdown] <br>");

                    a.addImmediate(c, "Add Sub-Dropdown Elements Container", "<br> [sub_container] <br> [/sub_container] <br>");

                    a.addWithDialog(c, "Add Element to Dropdown", "dropdown_element");

                    a.addWithDialog(c, "Add Element to Sub-Dropdown", "dropdown_subelement"); */

                    a.addWithDialog(b, "Tabs", "tab");

                   /* c = b.addMenu({

                        title: "Modals"

                    });

                    a.addWithDialog(c, "Add Modal Container and button", "modal");

                    a.addImmediate(c, "Add Modal Content", "<br> [modal_content] <br> [/modal_content] <br>");

                    a.addImmediate(c, "Add Modal Footer", "<br> [modal_footer] <br> [/modal_footer] <br>"); */

                    

                    a.addWithDialog(b, "Tooltip", "tooltip");

                   /* a.addWithDialog(b, "Popovers", "popover"); */

                    

                    c = [];

                    a.addWithDialog(c, "Add Toggle Container", "toggle_container");

                    a.addWithDialog(c, "Add Toggle", "toggle");

                    a.control_by_key(  "inline", a , b); 

                    b.push({

                        text: "Toggles",
                        menu: c

                    });


                    c = [];

                    a.addImmediate(c, "Horizontal with border fit to page content", "<br>[border_divider_fit_page_content] <br>");

                    a.addImmediate(c, "Horizontal with border fit to page layout", "<br>[border_divider_fit_page_layout] <br>");

                    a.addImmediate(c, "Whitespace", "<br>[whitespace] <br>");

                    b.push({

                        text: "Dividers",
                        menu: c

                    });

                 

                    c = [];

                    a.addWithDialog(c, "Add Container", "price_table_1_container");

                    a.addWithDialog(c, "Add Column", "price_table_1");

                    a.addWithDialog(c, "Add Row", "price_table_1_row"); 	

                    b.push({

                        text: "Price Table",
                        menu: c

                    });
					

					a.control_by_key(  false, a , b); 

                    

                    

                 

                    

                    /*

                    c = b.addMenu({

                        title: "Social Buttons"

                    });

                    a.addWithDialog(c, "Twitter", "twitter");

                    a.addWithDialog(c, "Tweetmeme", "tweetmeme");

                    a.addWithDialog(c, "Digg", "digg");

                    a.addWithDialog(c, "Like on Facebook", "fblike");

                    */

      

            

            return b;

        },

        addImmediate: function (d, e, a) {

            d.push({

                text: e,

                onclick: function () { tinyMCE.activeEditor.execCommand("mceInsertContent", false, a) }

            })

        },

        addWithDialog: function (d, e, a) {

            d.push({

                text: e,

                onclick: function () {

                    tinyMCE.activeEditor.execCommand("scnOpenDialog", false, {

                        title: e,

                        identifier: a

                    })

                }

            })

        },

        getInfo: function () {

            return {

                longname: "Shortcode Ninja plugin",

                author: "VisualShortcodes.com",

                authorurl: "http://visualshortcodes.com",

                infourl: "http://visualshortcodes.com/shortcode-ninja",

                version: "1.0"

            }

        }

    });

    tinymce.PluginManager.add("ShortcodeNinjaPlugin", tinymce.plugins.ShortcodeNinjaPlugin)

})();