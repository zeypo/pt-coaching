<?php





$admin_pages = array( 

     

     array( 'slug' => 'themeple',  'parent'=>'themeple', 'icon'=>"option.png" ,      'title' =>  'Theme Option' ),

     array( 'slug' => 'styling',   'parent'=>'themeple', 'icon'=>"styling.png",      'title' =>  'Styling'  ),

     array( 'slug' => 'font_type', 'parent'=>'themeple', 'icon'=>"fontixon.png",      'title' =>   'Font Type',  'sub' => true  ),

     array( 'slug' => 'font_size', 'parent'=>'themeple', 'icon'=>"fontsizeicon.png",      'title' =>   'Font Size',  'sub' => true  ),

     array( 'slug' => 'header', 'parent'=>'themeple', 'icon'=>"headeroptionicon.png",      'title' =>   'Header',  'sub' => true  ),

     /*array( 'slug' => 'dynamic_elements', 'parent'=>'themeple', 'icon'=>"dyelemetsicon.png",      'title' =>   'Dynamic Elements',  'sub' => true  ),*/

     array( 'slug' => 'footer', 'parent'=>'themeple', 'icon'=>"footeroptionicon.png",      'title' =>   'Footer',  'sub' => true  ),

     array( 'slug' => 'layout',    'parent'=>'themeple', 'icon'=>"layout.png",       'title' =>  'Layout'  ),

     array( 'slug' => 'portfolio', 'parent'=>'themeple', 'icon'=>"portfolio.png" ,   'title' =>  'Portfolio' ),

     array( 'slug' => 'contact',   'parent'=>'themeple', 'icon'=>"contact.png" ,     'title' =>  'Contact' ),

     array( 'slug' => 'sidebar',   'parent'=>'themeple', 'icon'=>"sidebar1.png",     'title' =>  'Sidebar'  )

     //array( 'slug' => 'builder',   'parent'=>'builder','icon'=>"pagebuilder.png",    'title' =>  'Page Builder'  )

     

                          

);



/* GENERAL */

/*------------------------------------------------*/

/*------------------------------------------------*/



$page_elements[] =  array(

                         "slug"              => "themeple",

                         "name"              => "Import Dummy Data",

                         "desc"              => "Here you can automatically add all needed files to create pages like preview",

                         "id"                => "dummy_dataa",

                         "type"              => "dummy_data"

);

$page_elements[] =  array(

                         "slug"              => "themeple",

                         "name"              => "Select FrontPage",

                         "desc"              => "Select the page you want to show on the home",

                         "id"                => "frontpage",

                         "type"              => "select",

                         "css_class"         => "full_select",

                         "subtype"           => "page"

);

$page_elements[] =  array(

                         "slug"              => "themeple",

                         "name"              => "Select Blog Page",

                         "desc"              => "Select the page you want to use for blog",

                         "id"                => "blogpage",

                         "type"              => "select",

                         "css_class"         => "full_select",

                         "subtype"           => "page"

);

$page_elements[] =  array(

                         "slug"              => "themeple",

                         "name"              => "Select Coming Soon Page",

                         "desc"              => "Select a page you want to use as comming soon page",

                         "id"                => "comingsoon",

                         "type"              => "select",

                         "css_class"         => "full_select",

                         "subtype"           => "page"

);

$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "name"              => "Logo",

                         "desc"              => "Select your logo to be uploaded.",

                         "id"                => "logo",

                         "type"              => "upload",

                         'std'               => THEMEPLE_BASE_URL.'img/logo.png',

                         "btn_text"          => "Upload",

                         "label"             => "Use Image as logo"

);


$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "name"              => "Logo for dark backgrounds",

                         "desc"              => "Select your logo to be uploaded.",

                         "id"                => "logo_light",

                         "type"              => "upload",

                         'std'               => THEMEPLE_BASE_URL.'img/logo_light.png',

                         "btn_text"          => "Upload",

                         "label"             => "Use Image as logo"

);


$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "name"              => "Logo Width",

                         "desc"              => "Select your logo to be uploaded.",

                         "id"                => "logo_width",

                         "type"              => "input_text",

                         'std'               => '150px'


);

$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "name"              => "Logo Margin Top",

                         "desc"              => "Set the logo margin top",

                         "id"                => "logo_margin_top",

                         "type"              => "input_text",

                         'std'               => '0px'


);

$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "name"              => "Logo Margin Bottom",

                         "desc"              => "Set the logo margin bottom",

                         "id"                => "logo_margin_bottom",

                         "type"              => "input_text",

                         'std'               => '0px'


);




$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "name"              => "Logo Description",

                         "desc"              => "Set your logo description.",

                         "id"                => "desc_logo",

                         "type"              => "input_text",

                         'std'               => 'Its show time now!'

);


$page_elements[] =  array(

                         "slug"              => "themeple",

                         "name"              => "Sticky Menu ?",

                         "desc"              => "Activate the fixed menu when you navigate into the page",

                         "id"                => "sticky_menu",

                         "type"              => "switchbutton",

                         "std"               => "no"

);

$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "name"              => "Favicon",

                         "desc"              => "Upload the favicon.<br/>Accepted formats: .ico, .png, .gif",

                         "id"                => "favicon",

                         "type"              => "upload",

                         "btn_text"          => "Upload",

                         "label"             => "Use Image as favicon");  



$page_elements[] = array(

                         "slug"              => "themeple",

                         "name"              => "404 Error message",

                         "desc"              => "Set the message will be showed on 404 not found error pages",

                         "id"                => "404_error_message",

                         "type"              => "input_text",

                         "std"               => " <strong>Ohh!!</strong>You have requested the page that its no longer avaible"

);    



$page_elements[] = array(

                         "slug"              => "themeple",

                         "name"              => "Twitter Account for the footer",

                         "desc"              => "Add the twitter account name",

                         "id"                => "twitter_account",

                         "type"              => "input_text",

                         "std"               => "envato"

);  

$page_elements[] = array(

                         "slug"              => "themeple",

                         "name"              => "Twitter Account Consumer Key",

                         "desc"              => "Set the keys that will be generated into dev.twitter.com",

                         "id"                => "twitter_consumer_key",

                         "type"              => "input_text",

                         "std"               => ""

);  



$page_elements[] = array(

                         "slug"              => "themeple",

                         "name"              => "Twitter Account Consumer Secret",

                         "desc"              => "Set the keys that will be generated into dev.twitter.com",

                         "id"                => "twitter_consumer_secret",

                         "type"              => "input_text",

                         "std"               => ""

);  

$page_elements [] = array(

                         "name" => "Clients width item size",

                         "desc" => "Set the width of the clients item area",

                         "id" => "item_width_size",

                         "std" => "162px",

                         "type" => "input_text",
                        
                         "slug" => "themeple",

                         

                         );

$page_elements [] = array(

                         "name" => "Clients height item size",

                         "desc" => "Set the height of the clients item area",

                         "id" => "item_height_size",

                         "std" => "106px",

                         "type" => "input_text",

                         "slug" => "themeple",


                         );

$page_elements[] =  array(    

                         "name"              => "Add new Clients Images",

                         "desc"              => "Add or edit your clients logo",

                         "std"               => "",

                         "slug"              => "themeple",

                         "type"              => "description_h",

                         "nodescription"     =>true);



$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "type"              => "layout_section", 

                         "id"                => "client-logo", 

                         "linktext"          => "Add another Client Logo",

                         "deletetext"        => "Remove Client Logo",

                         "blank"             => true, 

                         "std"               => array(

                                                       array('logo'=>'', 'logo_light'=>'', 'title' => '', 'link' => ''),

                                                       array('logo'=>'', 'logo_light'=>'', 'title' => ''),

                                                       array('logo'=>'', 'logo_light'=>'', 'title' => ''),

                                                ),

                         'subelements'  => array( 

                              

                                   array(    

                                        "name"         => "Client Logo (Dark Version):",

                                        "slug"         => "themeple",

                                        "desc"         => "",

                                        "id"           => "logo",

                                        "std"          => "",

                                        "btn_text"     => "Upload",

                                        "type"         => "upload"

                                   ),

                                   array(    

                                        "name"         => "Client Logo (Light Version):",

                                        "slug"         => "themeple",

                                        "desc"         => "",

                                        "id"           => "logo_light",

                                        "std"          => "",

                                        "btn_text"     => "Upload",

                                        "type"         => "upload"

                                   ),

                                   array(    

                                        "name"         => "Client title:",

                                        "slug"         => "themeple",

                                        "desc"         => "",

                                        "id"           => "title",

                                        "std"          => "",

                                        "type"         => "input_text"

                                   ),

                                   array(    

                                        "name"         => "Link",

                                        "slug"         => "themeple",

                                        "desc"         => "",

                                        "id"           => "link",

                                        "std"          => "#",

                                        "type"         => "input_text"

                                   )

 

 

                         )             

                                    

);

$page_elements[] =  array(    

                         "slug"              => "themeple",

                         "type"              => "layout_section", 

                         "desc"              => "Add the social icons for the bar above the footer",

                         "id"                => "social_icons", 

                         "linktext"          => "Add another Social Icon",

                         "deletetext"        => "Remove Social Icon",

                         "blank"             => true, 

                         "std"               => array(

                                                       array('social'=>'google_plus', 'link' => '#'),

                                                       array('social'=>'linkedin', 'link' => '#'),

                                                       array('social'=>'pinterest', 'link' => '#'),

                                                       

                                                       array('social'=>'twitter', 'link' => '#'),

               							     array('social'=>'facebook', 'link' => '#')

                                                ),

                         'subelements'  => array( 

                              

                                   array(    

                                        "name"         => "Social Icon:",

                                        "slug"         => "themeple",

                                        "desc"         => "",

                                        "id"           => "social",

                                        "std"          => "",

                                        

                                        "type"         => "select",

                                        "subtype"      => array("Mail"=>'mail', 'Dribbble'=>'dribble', 'Flickr' => 'flickr', 'Search'=>'search', 'Delicious'=> 'delicious', 'Skype'=>'skype', 'Forrst'=>'forrst', 'Paypal'=>'paypal', 'Behance'=>'behance', 'DeviantArt'=>'deviantart', 'Digg'=>'digg', 'Vimeo'=>'vimeo', 'Yahoo'=>'yahoo', 'Youtube'=>'youtube', 'Picasa'=>'picasa', 'Reddit'=>'reddit', "Twitter" => "twitter", "Facebook" => 'facebook', "Linkedin" => 'linkedin', "GooglePlus" => "google_plus", 'Pinterest' => 'pinterest', 'RSS' => 'rss', 'Viadeo' => 'viadeo')

                                   ), 

                                   

                                   array(    

                                        "name"         => "Link",

                                        "slug"         => "themeple",

                                        "desc"         => "",

                                        "id"           => "link",

                                        "std"          => "http://",

                                        "type"         => "input_text"

                                   ),

                                  array(    

                                        "name"         => "Add this social as sharing button on single posts",

                                        "slug"         => "themeple",

                                        "desc"         => "Not all the socials provide sharing capability",

                                        "id"           => "sharebutton",

                                        "std"          => "yes",

                                        "type"         => "switchbutton"

                                   )



 

 

                         )             

                                    

);




/* End  Themeple */











/*------------------------------------------------*/

/*------------------------------------------------*/

/*------------------------------------------------*/





/* General Styles */

/*------------------------------------------------*/

/*------------------------------------------------*/





$page_elements[] = array(

     

     "slug"                        => "styling",

     "name"                        => "Select Color Scheme",

     "desc"                        => "Select the predefined skins for the theme",

     "std"                         => "blue",

     "array_name"                  => 'predefined',

     "id"                          => "change_skin",

     "type"                        => "change_skin"



);


/*$page_elements[] = array(

     

     "slug"                        => "styling",

     "name"                        => "Select Skin",

     "std"                         => "light",

     "array_name"                  => 'skin',

     "id"                          => "change_skin_2",

     "type"                        => "change_complete_skin"



);*/


$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Background Color',

     "desc"                        => 'Set the background color when the page its setup with boxed version',

     "type"                        => "colorpicker", 

     "id"                          => "bg_color",

     "std"                         => '#fff'

);



$page_elements[] =array (

     

    "slug"                        => "styling",

    "name"                        => 'Custom Css Box',

    "desc"                        => 'Type custom css line',

    "type"                        => "textarea", 

    "id"                          => "custom_css"

	

);



$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Background Image Pattern',

     "desc"                        => "Set the pattern for the background that will be visible on boxed version",

     "type"                        => "radioimage", 

     "class"			   => 'pattern',

     "id"                          => "bg_img",

     "std"                         => "none",

     "subtype"                     => array( 

					array('name' => 'No Pattern', 'value' =>'none', 'img' => 'pattern/none.png'),

                                        array('name' => 'Pattern 1', 'value' =>'pattern1', 'img' => 'pattern/pattern1.png'),

                                        array('name' => 'Pattern 2', 'value' =>'pattern2', 'img' => 'pattern/pattern2.png'),

                                        array('name' => 'Pattern 3', 'value' =>'pattern3', 'img' => 'pattern/pattern3.png'),

					array('name' => 'Pattern 4', 'value' =>'pattern4', 'img' => 'pattern/pattern4.png'),

                                        array('name' => 'Pattern 5', 'value' =>'pattern5', 'img' => 'pattern/pattern5.png'),

                                        array('name' => 'Pattern 6', 'value' =>'pattern6', 'img' => 'pattern/pattern6.png'),

					array('name' => 'Pattern 7', 'value' =>'pattern7', 'img' => 'pattern/pattern7.png')

                                   )

);



$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Upload your background image',

     "desc"                        => 'Set a background image for the boxed version',

     "type"                        => "upload", 

     "btn_text"                    => "Upload",

     "id"                          => "bg_your_img"

     

);


$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Repeat Image or Fixed ? (Background)',

     "desc"                        => 'Set the background image as fixed or with repeat mode',

     "type"                        => "select", 

     "no_first"                    => true,

     "id"                          => "bg_type",

     "subtype"                     => array("Repeat" => 'repeat', 'Fixed' => 'fixed')

     

);




$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Base Color',

     "desc"                        => "Set the base color for the website",

     "type"                        => "colorpicker", 

     "id"                          => "base_color",

     "std"                         => '#009dcd'

);

$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Second Color',

     "desc"                        => 'Set the second color for the website',

     "type"                        => "colorpicker", 

     "id"                          => "second_color",

     "std"                         => '#7c7c7c'

);

$page_elements[] = array(


      "slug"                        => "styling",

     "name"                        => 'Third Color',

     "desc"                        => 'Menu hover color, icons color, and breadcrumbs',

     "type"                        => "colorpicker", 

     "id"                          => "third_color",

     "std"                         => '#f6f6f6'



     );




$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Body Font Color',

     "desc"                        => 'Set the body font color',

     "type"                        => "colorpicker", 

     "id"                          => "body_font_color",

     'std'                         => "#969ba2"

     

);

$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Hyperlink Color',

     "desc"                        => 'Set the hyperlinks font color',

     "type"                        => "colorpicker", 

     "id"                          => "hyperlink_font_color",

     'std'                         => "#e54d26"

     

);




$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Base Border color',

     "desc"                        => 'Set the borders color',

     "type"                        => "colorpicker", 

     "id"                          => "base_border",

     'std'                         => "#e1e1e1"

     

);

$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Single Post Header BG',

     "desc"                        => 'Set the page header single blog background color',

     "type"                        => "colorpicker", 

     "id"                          => "single_post_bg",

     "std"                         => '#f6f6f6'

);


$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Single Title Color',

     "desc"                        => 'Single post title font color ',

     "type"                        => "colorpicker", 

     "id"                          => "single_post_title_color",

     "std"                         => '#000000'

);



$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Top Navigation',

     "desc"                        => 'Set the top navigation background color',

     "type"                        => "colorpicker", 

     "id"                          => "top_nav_bg_color",

     "std"                         => '#f6f6f6'                    


                    );



$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Top Navigation Font Color',

     "desc"                        => 'Set the top navigation font color',

     "type"                        => "colorpicker", 

     "id"                          => "top_nav_font_color",

     "std"                         => '#7c7c7c'                    


                    );




$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Sub Navigation Background Color',

     "desc"                        => 'Sub navigation Background Color',

     "type"                        => "colorpicker", 

     "id"                          => "sub_background_color",

     "std"                         => '#f7f7f7'                    


                    );


$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Sub Navigation Font Color',

     "desc"                        => 'Sub Navigation Font Color',

     "type"                        => "colorpicker", 

     "id"                          => "sub_font_color",

     "std"                         => '#7c7c7c'                    


                    );


$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Sub Navigation Hover Background Color',

     "desc"                        => 'Hover Sub navigation background',

     "type"                        => "colorpicker", 

     "id"                          => "sub_background_hover_color",

     "std"                         => '#f3f3f3'                    


                    );

$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Header Menu Hover Font Color',

     "desc"                        => 'Set the header menu font color hover',

     "type"                        => "colorpicker", 

     "id"                          => "top_nav_hover_font_color",

     "std"                         => '#555'                    


                    );


$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Sub Navigation Border Color',

     "desc"                        => 'Set the sub navigation of border bottom color',

     "type"                        => "colorpicker", 

     "id"                          => "sub_border_color",

     "std"                         => '#e1e1e1'                    


                    );




$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Top Navigation border Color',

     "desc"                        => 'Set the top navigation border color',

     "type"                        => "colorpicker", 

     "id"                          => "top_nav_border_color",

     "std"                         => '#e2e3e2'                    


                    );


$page_elements[] = array(

     "slug"                        => "styling",

     "name"                        => 'Top Navigation font hover Color',

     "desc"                        => 'Set the top navigation font hover color',

     "type"                        => "colorpicker", 

     "id"                          => "top_nav_hover_color",

     "std"                         => '#009dcd'                    


                    );


$page_elements[] = array(



     "slug"                        => "styling",

     "name"                        => 'Left Navigation Background color',

     "desc"                        => 'Set the left navigation background color',

     "type"                        => "colorpicker", 

     "id"                          => "left_nav_bg_color",

     "std"                         => '#fff'

);



/* End General Styles */

/*------------------------------------------------*/

/*------------------------------------------------*/

/* Font Type */

/*------------------------------------------------*/

/*------------------------------------------------*/

$page_elements[] = array(

                         "slug"                   => 'font_type',

                         "name"                   => 'Select Font',

                         "desc"                   => 'Font to be used for your site',

                         'type'                   => 'select',

                         'id'                     => 'font_page',

                         'std'                    => 'Open Sans',

                         'subtype'                => array(           

                                                       'HelveticaLTStd-Bold' => "HelveticaLTStd-Bold",

                                                       'Alice'=>'Alice',

                                                       'Allerta'=>'Allerta',

                                                       'Arvo'=>'Arvo',

                                                       'Antic'=>'Antic',                                

                                                       'Bangers'=>'Bangers',

                                                       'Bitter'=>'Bitter',                                                       

                                                       'Cabin'=>'Cabin',

                                                       'Cardo'=>'Cardo',

                                                       'Carme'=>'Carme',

                                                       'Coda'=>'Coda',

                                                       'Coustard'=>'Coustard',

                                                       'Damion'=>'Damion',

                                                       'Dancing Script'=>'Dancing Script',

                                                       'Droid Sans'=>'Droid Sans',

                                                       'Droid Serif'=>'Droid Serif',                                                       

                                                       'EB Garamond'=>'EB Garamond',

                                                       

                                                       'Fjord One'=>'Fjord One',

                                                       

                                                       'Inconsolata'=>'Inconsolata',

                                                       

                                                       'Josefin Sans' => 'Josefin Sans',

                                                       'Josefin Slab'=>'Josefin Slab',

                                                       

                                                       'Kameron'=>'Kameron',

                                                       'Kreon'=>'Kreon',

                                                       'Lato' => 'Lato',

                                                       'Lobster'=>'Lobster',

                                                       'League Script'=>'League Script',



                                                       'Mate SC'=>'Mate SC',

                                                       'Mako'=>'Mako',

                                                       'Merriweather'=>'Merriweather',

                                                       'Metrophobic'=>'Metrophobic',

                                                       'Molengo'=>'Molengo',

                                                       'Muli'=>'Muli',



                                                       'Nobile'=>'Nobile',

                                                       'News Cycle'=>'News Cycle',



                                                       'Open Sans'=>'Open Sans',

                                                       'Bebas Neue' => 'Bebas Neue',

                                                       'Orbitron'=>'Orbitron',

                                                       'Oswald'=>'Oswald',

                                                       

                                                       'Pacifico'=>'Pacifico',

                                                       'Poly'=>'Poly',

                                                       'Podkova'=>'Podkova',

                                                       'PT Sans' => 'PT Sans',

                                                       'Quattrocento'=>'Quattrocento',

                                                       'Questrial'=>'Questrial',

                                                       'Quicksand'=>'Quicksand',

                                                       

                                                       'Raleway'=>'Raleway',

                                                       'Roboto'=>'Roboto',

                                                       'Roboto Slab' => 'Roboto Slab',

                                                       'Salsa'=>'Salsa',

                                                       'Sunshiney'=>'Sunshiney',

                                                       'Signika Negative'=>'Signika Negative',

                                                       'Tangerine'=>'Tangerine',

                                                       'Terminal Dosis'=>'Terminal Dosis',

                                                       'Tenor Sans'=>'Tenor Sans',

                                                       'Varela Round'=>'Varela Round',

                                                       'Yellowtail'=>'Yellowtail'

                    

                                                  )                

);



$page_elements[] = array(

                         "slug"                   => 'font_type',

                         "name"                   => 'Select Headings',

                         "desc"                   => 'Font to be used for your site',

                         'type'                   => 'select',

                         'id'                     => 'font_headings',

                         'std'                    => 'HelveticaLTStd-Bold',

                         'subtype'                => array(            

                                                       
                                                  
                                                       'HelveticaLTStd-Bold' => "HelveticaLTStd-Bold",

                                                       'Big Noodle' => 'bignoodletitling',

                                                       'Bebas Neue' => "Bebas Neue",

                                                       'Alice'=>'Alice',

                                                       'Allerta'=>'Allerta',

                                                       'Arvo'=>'Arvo',

                                                       'Antic'=>'Antic',

                                

                                                       'Bangers'=>'Bangers',

                                                       'Bitter'=>'Bitter',

                                                       

                                                       'Cabin'=>'Cabin',

                                                       'Cardo'=>'Cardo',

                                                       'Carme'=>'Carme',

                                                       'Coda'=>'Coda',

                                                       'Coustard'=>'Coustard',



                                                       'Damion'=>'Damion',

                                                       'Dancing Script'=>'Dancing Script',

                                                       'Droid Sans'=>'Droid Sans',

                                                       'Droid Serif'=>'Droid Serif',

                                                       

                                                       'EB Garamond'=>'EB Garamond',

                                                       

                                                       'Fjord One'=>'Fjord One',

                                                       

                                                       'Inconsolata'=>'Inconsolata',

                                                       

                                                       'Josefin Sans' => 'Josefin Sans',

                                                       'Josefin Slab'=>'Josefin Slab',

                                                       

                                                       'Kameron'=>'Kameron',

                                                       'Kreon'=>'Kreon',

                                                       'Lato' => 'Lato',

                                                       'Lobster'=>'Lobster',

                                                       'League Script'=>'League Script',



                                                       'Mate SC'=>'Mate SC',

                                                       'Mako'=>'Mako',

                                                       'Merriweather'=>'Merriweather',

                                                       'Metrophobic'=>'Metrophobic',

                                                       'Molengo'=>'Molengo',

                                                       'Muli'=>'Muli',



                                                       'Nobile'=>'Nobile',

                                                       'News Cycle'=>'News Cycle',



                                                       'Open Sans'=>'Open Sans',

                                                       'Orbitron'=>'Orbitron',

                                                       'Oswald'=>'Oswald',

                                                       

                                                       'Pacifico'=>'Pacifico',

                                                       'Poly'=>'Poly',

                                                       'Podkova'=>'Podkova',

                                                       'PT Sans' => 'PT Sans',


                                                       'Quattrocento'=>'Quattrocento',

                                                       'Questrial'=>'Questrial',

                                                       'Quicksand'=>'Quicksand',

                                                       

                                                       'Raleway'=>'Raleway',

                                                       'Roboto'=>'Roboto',

                                                       'Roboto Slab' => 'Roboto Slab',

                                                       'Salsa'=>'Salsa',

                                                       'Sunshiney'=>'Sunshiney',

                                                       'Signika Negative'=>'Signika Negative',





                                                       'Tangerine'=>'Tangerine',

                                                       'Terminal Dosis'=>'Terminal Dosis',

                                                       'Tenor Sans'=>'Tenor Sans',



                                                       'Varela Round'=>'Varela Round',

                                                       

                                                       'Yellowtail'=>'Yellowtail'

                    

                                                  )
                              );



$page_elements[] = array(

                         "slug"                   => 'font_type',

                         "name"                   => 'Select Menu Font',

                         "desc"                   => 'Font to be used in the Menu',

                         'type'                   => 'select',

                         'id'                     => 'font_menu',

                         'std'                    => 'HelveticaLTStd-Bold',

                         'subtype'                => array(            

                                                       
                                                  
                                                       'HelveticaLTStd-Bold' => "HelveticaLTStd-Bold",

                                                       'Big Noodle' => 'bignoodletitling',

                                                       'Bebas Neue' => "Bebas Neue",

                                                       'Alice'=>'Alice',

                                                       'Allerta'=>'Allerta',

                                                       'Arvo'=>'Arvo',

                                                       'Antic'=>'Antic',

                                

                                                       'Bangers'=>'Bangers',

                                                       'Bitter'=>'Bitter',

                                                       

                                                       'Cabin'=>'Cabin',

                                                       'Cardo'=>'Cardo',

                                                       'Carme'=>'Carme',

                                                       'Coda'=>'Coda',

                                                       'Coustard'=>'Coustard',



                                                       'Damion'=>'Damion',

                                                       'Dancing Script'=>'Dancing Script',

                                                       'Droid Sans'=>'Droid Sans',

                                                       'Droid Serif'=>'Droid Serif',

                                                       

                                                       'EB Garamond'=>'EB Garamond',

                                                       

                                                       'Fjord One'=>'Fjord One',

                                                       

                                                       'Inconsolata'=>'Inconsolata',

                                                       

                                                       'Josefin Sans' => 'Josefin Sans',

                                                       'Josefin Slab'=>'Josefin Slab',

                                                       

                                                       'Kameron'=>'Kameron',

                                                       'Kreon'=>'Kreon',

                                                       'Lato' => 'Lato',

                                                       'Lobster'=>'Lobster',

                                                       'League Script'=>'League Script',



                                                       'Mate SC'=>'Mate SC',

                                                       'Mako'=>'Mako',

                                                       'Merriweather'=>'Merriweather',

                                                       'Metrophobic'=>'Metrophobic',

                                                       'Molengo'=>'Molengo',

                                                       'Muli'=>'Muli',



                                                       'Nobile'=>'Nobile',

                                                       'News Cycle'=>'News Cycle',



                                                       'Open Sans'=>'Open Sans',

                                                       'Orbitron'=>'Orbitron',

                                                       'Oswald'=>'Oswald',

                                                       

                                                       'Pacifico'=>'Pacifico',

                                                       'Poly'=>'Poly',

                                                       'Podkova'=>'Podkova',

                                                       'PT Sans' => 'PT Sans',


                                                       'Quattrocento'=>'Quattrocento',

                                                       'Questrial'=>'Questrial',

                                                       'Quicksand'=>'Quicksand',

                                                       

                                                       'Raleway'=>'Raleway',

                                                       'Roboto'=>'Roboto',

                                                       'Roboto Slab' => 'Roboto Slab',

                                                       'Salsa'=>'Salsa',

                                                       'Sunshiney'=>'Sunshiney',

                                                       'Signika Negative'=>'Signika Negative',





                                                       'Tangerine'=>'Tangerine',

                                                       'Terminal Dosis'=>'Terminal Dosis',

                                                       'Tenor Sans'=>'Tenor Sans',



                                                       'Varela Round'=>'Varela Round',

                                                       

                                                       'Yellowtail'=>'Yellowtail'

                    

                                                  )
                              );



/* End Font Type */



















/*------------------------------------------------*/

/*------------------------------------------------*/

/*------------------------------------------------*/



















/* Font Sizes */

/*------------------------------------------------*/

/*------------------------------------------------*/

$page_elements[] = array(



     "slug"                        => "font_size",

     "name"                        => 'Body Font Size',

     "type"                        => "select", 

     "id"                          => "font_size_page",

     "std"                         => '14',

     "subtype"                     => array('10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19, '20'=>20, '21'=>21, '22'=>22, '23'=>23, '24'=>24, '25'=>25, '26'=>26, '27'=>27, '28'=>28, '29'=>29, '30'=>30, '31'=>31, '32'=>32, '33' => 33, '34' => 34, "35" => 35, "36" => 36 )



);



$page_elements[] = array(



     "slug"                        => "font_size",

     "name"                        => 'Menu Font Size',

     "type"                        => "select", 

     "id"                          => "menu_font_size",

     "std"                         => '14',

     "subtype"                     => array('10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19, '20'=>20, '21'=>21, '22'=>22, '23'=>23, '24'=>24, '25'=>25, '26'=>26, '27'=>27, '28'=>28, '29'=>29, '30'=>30, '31'=>31, '32'=>32, '33' => 33, '34' => 34, "35" => 35, "36" => 36 )



);


$page_elements[] = array(



     "slug"                        => "font_size",

     "name"                        => 'H1 Font Size',

     "type"                        => "select", 

     "id"                          => "font_size_1",

     "std"                         => '30',

     "subtype"                     => array('10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19, '20'=>20, '21'=>21, '22'=>22, '23'=>23, '24'=>24, '25'=>25, '26'=>26, '27'=>27, '28'=>28, '29'=>29, '30'=>30, '31'=>31, '32'=>32, '33' => 33, '34' => 34, "35" => 35, "36" => 36 )



);



$page_elements[] = array(



     "slug"                        => "font_size",

     "name"                        => 'H2 Font Size',

     "type"                        => "select", 

     "id"                          => "font_size_2",

     "std"                         => '24',

     "subtype"                     => array('10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19, '20'=>20, '21'=>21, '22'=>22, '23'=>23, '24'=>24, '25'=>25, '26'=>26, '27'=>27, '28'=>28, '29'=>29, '30'=>30, '31'=>31, '32'=>32, '33' => 33, '34' => 34, "35" => 35, "36" => 36 )



);



$page_elements[] = array(



     "slug"                        => "font_size",

     "name"                        => 'H3 Font Size',

     "type"                        => "select", 

     "id"                          => "font_size_3",

     "std"                         => '17',

     "subtype"                     => array('10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19, '20'=>20, '21'=>21, '22'=>22, '23'=>23, '24'=>24, '25'=>25, '26'=>26, '27'=>27, '28'=>28, '29'=>29, '30'=>30, '31'=>31, '32'=>32, '33' => 33, '34' => 34, "35" => 35, "36" => 36 )



);



$page_elements[] = array(



     "slug"                        => "font_size",

     "name"                        => 'H4 Font Size',

     "type"                        => "select", 

     "id"                          => "font_size_4",

     "std"                         => '16',

     "subtype"                     => array('10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19, '20'=>20, '21'=>21, '22'=>22, '23'=>23, '24'=>24, '25'=>25, '26'=>26, '27'=>27, '28'=>28, '29'=>29, '30'=>30, '31'=>31, '32'=>32, '33' => 33, '34' => 34, "35" => 35, "36" => 36 )



);



$page_elements[] = array(



     "slug"                        => "font_size",

     "name"                        => 'H5 Font Size',

     "type"                        => "select", 

     "id"                          => "font_size_5",

     "std"                         => '15',

     "subtype"                     => array('10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19, '20'=>20, '21'=>21, '22'=>22, '23'=>23, '24'=>24, '25'=>25, '26'=>26, '27'=>27, '28'=>28, '29'=>29, '30'=>30, '31'=>31, '32'=>32, '33' => 33, '34' => 34, "35" => 35, "36" => 36 )



);



$page_elements[] = array(



     "slug"                        => "font_size",

     "name"                        => 'H6 Font Size',

     "type"                        => "select", 

     "id"                          => "font_size_6",

     "std"                         => '14',

     "subtype"                     => array('10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19, '20'=>20, '21'=>21, '22'=>22, '23'=>23, '24'=>24, '25'=>25, '26'=>26, '27'=>27, '28'=>28, '29'=>29, '30'=>30, '31'=>31, '32'=>32, '33' => 33, '34' => 34, "35" => 35, "36" => 36 )



);

/* Font Sizes */

/*------------------------------------------------*/

/*------------------------------------------------*/

/* Header */

/*------------------------------------------------*/

/*------------------------------------------------*/







$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Navigation Item Font Color',

     "desc"                        => 'Select the color for the font menu item',

     "type"                        => "colorpicker", 

     "id"                          => "nav_font_color",

     "std"                         => '#7c7c7c'

     

);




$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Header Background Color',

     "desc"                        => 'Set the Header Background color',

     "type"                        => "colorpicker", 

     "id"                          => "header_bg_color",

     "std"                         => '#ffffff'

);






$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Header logo description font color',

     "desc"                        => 'Font color of logo description',

     "type"                        => "colorpicker", 

     "id"                          => "header_logo_desc_font_color",

     "std"                         => '#999'

);




$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Header borders color',

     "desc"                        => 'Header border color',

     "type"                        => "colorpicker", 

     "id"                          => "header_border_color",

     "std"                         => '#e1e1e1'

);





$page_elements[] = array(


     "slug"                        => "header",

     "name"                        => 'Header Logo Light Activation',

     "desc"                        => 'Enable or disable the header logo light',

     "type"                        => "switchbutton", 

     "id"                          => "header_logo_light_activation",

     "std"                         => 'no'




);


$page_elements[] = array(


     "slug"                        => "header",

     "name"                        => 'Header Bar ',

     "desc"                        => 'Enable or disable the header bar',

     "type"                        => "switchbutton", 

     "id"                          => "header_bar",

     "std"                         => 'no'




);

$page_elements[] = array(


     "slug"                        => "header",

     "name"                        => 'Header top border ',

     "desc"                        => 'Enable or disable header top border',

     "type"                        => "switchbutton", 

     "id"                          => "header_border",

     "std"                         => 'no'




);


$page_elements[] = array(


     "slug"                        => "header",

     "name"                        => 'Header Bar left content',

     "desc"                        => 'Set the left bar content',

     "type"                        => "textarea", 

     "id"                          => "header_bar_left_text",

     "std"                         => '102580 Santa Monica BLVD      Los Angeles +3 045 224 33 12'




);

$page_elements[] = array(


     "slug"                        => "header",

     "name"                        => 'Header Bar font color',

     "desc"                        => 'Set the font color for the header bar',

     "type"                        => "colorpicker", 

     "id"                          => "header_bar_font_color",

     "std"                         => '#f6f6f6'




);

/*$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Top Navigation Widgets Separator Color',

     "type"                        => "colorpicker", 

     "id"                          => "topnav_separator_color",

     "std"                         => '#e1e5e7'

     

);*/




/*$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Creative Header Font Color',

     "type"                        => "colorpicker", 

     "id"                          => "creative_header_color",

     "std"                         => '#222'

     

);*/

/*$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Header Shadow',

     "type"                        => "select", 

     "id"                          => "header_shadow", 

     "subtype"                     => array("First" => "shadow1", "Second" => "shadow2", "Third" => "shadow3", 'None' => 'shadow_none'),

     "std"                         => 'shadow_none',

     "no_first"                    => true

     

);*/



/*$page_elements[] = array(

     "slug"                        => "header",

     "name"                        => 'Header DropShadow',

     "type"                        => "switchbutton", 

     "id"                          => "header_dropshadow", 

     "std"                         => 'yes'

);*/


$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Headers Styles',

     "desc"                        => 'Select the header you want to use (sometimes you need to change the options above to get the right configuration)',

     "type"                        => "select", 

     "id"                          => "header_types", 

     "subtype"			          => array("Header 1" => "header_1", "Header 2" => "header_2", "Header 3" => "header_3"),

     "std"                         => 'header_1',

     "no_first"			     => true

     

);



$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Top Widgetized Area',

     "desc"                        => 'Activate the top widget area (Add widgets you want into Appearances ->Widgets -> Top Header Right or Left )',

     "type"                        => "switchbutton", 

     "id"                          => "top_widget", 

     "std"                         => 'no'

     

);

$page_elements[] = array(



     "slug"                        => "header",

     "name"                        => 'Activate Search',

     "desc"                        => 'Activate the search button in the right side of header without widget',

     "type"                        => "switchbutton", 

     "id"                          => "right_search", 

     "std"                         => 'yes'

     

);









/* End Header */

/*------------------------------------------------*/

/*------------------------------------------------*/

/* DYNAMIC Elements */



$page_elements[] = array(



     "slug"                        => "dynamic_elements",

     "name"                        => 'Recent Portfolio GreyScale',

     "desc"                        => 'Set the portfolio images into greyscale mode',

     "type"                        => "switchbutton", 

     "id"                          => "dynamic_greyscale",

     "std"                         => 'no'

     

);








$page_elements[] = array(



     "slug"                        => "dynamic_elements",

     "name"                        => 'Page Intro Font Color',

     "desc"                        => "Page intro element font color",

     "type"                        => "colorpicker", 

     "id"                          => "page_intro_font_color",

     "std"                         => '#333'

     

);






/*$page_elements[] = array(



     "slug"                        => "dynamic_elements",

     "name"                        => 'Single Testimonial BG Color',

     "type"                        => "colorpicker", 

     "id"                          => "single_testimonial_bg_color",

     "std"                         => '#f5f5f5'

     

);*/







/* End Dynamic Elements */

/*------------------------------------------------*/

/* Footer */

/*------------------------------------------------*/

/*------------------------------------------------*/

$page_elements[] = array(



     "slug"                        => "footer",

     "name"                        => 'Footer Bg Color',

     "desc"                        => 'Footer background color (footer widgets area)',

     "type"                        => "colorpicker", 

     "std"                         => "#3c3c3c",

     "id"                          => "footer_bg_color"  

);


$page_elements[] = array(



     "slug"                        => "footer",

     "name"                        => 'Footer Twitter Second Bg Color',

     "desc"                        => 'Footer Twitter Second Bg Color',

     "type"                        => "colorpicker", 

     "std"                         => "#00799E",

     "id"                          => "footer_twitter_bg_color"  

);


$page_elements[] = array(



     "slug"                        => "footer",

     "name"                        => 'Footer Copyright Bg Color',

     "desc"                        => 'The last field under the footer where is the copyright description',

     "type"                        => "colorpicker", 

     "std"                         => "#323232",

     "id"                          => "footer_copyright_bg"  

);


$page_elements[] = array(



     "slug"                        => "footer",

     "name"                        => 'Footer border color',

     "desc"                        => 'Set the footer border color',

     "type"                        => "colorpicker", 

     "std"                         => "#45494f",

     "id"                          => "footer_border_color"  

);




$page_elements[] = array(



     "slug"                        => "footer",

     "name"                        => 'Footer Text Color',

     "desc"                        => 'Set the footer font color (footer widgets area font color)',

     "type"                        => "colorpicker", 

     "id"                          => "footer_font_color",

     "std"                         => "#7c7c7c"

);

$page_elements[] = array(

     "slug"                   => "footer",

     "name"                   => "Footer Copyright Font Color",

     "desc"                   => "Footer copyright font color",

     "type"                   => "colorpicker",

     "id"                     => "copyright_font_color",

     "std"                    => "#7c7c7c"



     );

$page_elements[] = array(

     "slug"                   => "footer",

     "name"                   => "Footer Twitter Bar",

     "desc"                   => "Footer social Icons for the upper footer",

     "type"                   => "switchbutton",

     "id"                     => "footer_social_bar",

     "std"                    => "no"



     );




/*$page_elements[] = array(

     "slug"                   => "footer",

     "name"                   => "Footer Header Title Color",

     "type"                   => "colorpicker",

     "id"                     => "footer_font_header_color",

     "std"                    => "#fff"



     );*/




/*$page_elements[] = array(



     "slug"                        => "footer",

     "name"                        => 'Footer Skin',

     "type"                        => "select", 

     "id"                          => "footer_skin",

     "std"                         => "dark",

     "no_first"                    => true,

     "subtype"                     => array('Dark Version' => 'dark', 'Ligh Version' => 'light', 'Skin Color' => 'skin_color', 'Change Color with the Footer Bg Color Option' => 'change_option')

); */










/* End Footer */

/*------------------------------------------------*/

/*------------------------------------------------*/











/* Builder */

/*------------------------------------------------*/

/*------------------------------------------------*/

$page_elements[] = array(

                        "slug"                         => "builder",

                        "name"                         => "Create Page Template",

                        "desc"                         => "Insert the name of the template",

                        "id"                           => "page_builder",

                        "type"                         => "pagebuilder",

                        "btn_text"                     => "Create",

                        "parent"                       => "builder",

                        "sortable"                     => "themeple_sortable",

                        "default_elements"             => array(

                                        

                                                            array(    

                                                                 "slug"              => "builder",

                                                                 "name"              => "Dynamic Template Page Layout",

                                                                 "desc"              => "Choose the layout of your template",

                                                                 "id"                => "dynamic_page_layout",

                                                                 "type"              => "radioimage",

                                                                 "std"               => "fullsize",

                                                                 "css_class"         => "full_select",

                                                                 "no_first"          =>true,

                                                                 "subtype"           => array( 

                                                                                          array('name' => 'Left Sidebar', 'value' =>'sidebar_left', 'img' => '90x62/sidebarleft.png'),

                                                                                          array('name' => 'Right Sidebar', 'value' =>'sidebar_right', 'img' => '90x62/sidebarright.png'),

                                                                                          array('name' => 'FullWidth', 'value' =>'fullsize', 'img' => '90x62/fullwidth.png')

                                                                                     )

                                                            ),



                                                            array(

                                                                 "type"              => "add_dynamic_element",

                                                                 "slug"              => 'builder',

                                                                 "name"              => "Add Elements",

                                                                 "class"             => "semi_select",

                                                                 "desc"              => "Select the element to be added in the template that you have created. Use Drag and Drop to sort elements",

                                                                 "std"               => "",

                                                                 "id"                => "add_template_option",

                                                                 "options_file"      => "template_inc/admin/admin_dynamic_options.php"

                                                            )

                                                       )

);

                    



/* End Builder */



















/*------------------------------------------------*/

/*------------------------------------------------*/

/*------------------------------------------------*/























/* Portfolio */

/*------------------------------------------------*/

/*------------------------------------------------*/

$page_elements[] =  array(    

                         "name"                   => "Change Portfolio Slug",

                         "desc"                   => "Please add a portfolio slug for your permalinks, make sure that dont contains special characters or a name that is used as another page",

                         "std"                    => "portfolio_ausart",

                         "slug"                   => "portfolio",

                         "type"                   => "input_text",

                         "id"                     => "portfolio_slug"

);


$page_elements[] =  array(    

                    "slug"              => "portfolio",

                    "type"              => "layout_section", 

                    "id"                => "portfolio-meta", 

                    "linktext"          => "Add another Meta Field",

                    "deletetext"   => "Remove Meta Field",

                    "blank"        => true, 

                    "std"               => array(

                                                  array('meta'=>'Custom Field'),

                                           ),

                    'subelements'  => array( 

                              

                                   array(    

                                   "name"    => "Portfolio Meta Field:",

                                   "slug"    => "portfolio",

                                   "desc"    => "",

                                   "id"      => "meta",

                                   "std"     => "",

                                   "type"    => "input_text"),

 

                    ),              

                                    

               );


$page_elements[] =  array(    

                         "name"                   => "Add new portfolios",

                         "desc"                   => "Here you can add new portfolio pages but before you need to add a new page in the pages section of the wordpress to be used for this portfolio",

                         "std"                    => "",

                         "slug"                   => "portfolio",

                         "type"                   => "description_h",

                         "nodescription"          => true

);





$page_elements[] =  array(    

                         "slug"                   => "portfolio",

                         "type"                   => "layout_section", 

                         "id"                     => "portfolio", 

                         "linktext"               => "Add another Portfolio",

                         "deletetext"             => "Remove Portfolio",

                         "blank"                  => true, 

                         "nodescription"          => true,

                         'subelements'            => array( 

                              

                                                       array(    

                                                            "name"              => "Which categories should be used for the portfolio?",

                                                            "desc"              => "Here you can select multiple or single cateories to be used for this portfolio page.",

                                                            "id"                => "portfolio_cats",

                                                            "type"              => "select",

                                                            "slug"              => "portfolio",

                                                            "multiple"          =>6,

                                                            "taxonomy"          => "portfolio_entries",

                                                            "subtype"           => "cat"

                                                       ),

                                                       array(

                                                       	 	"name"              => "Portfolio big Title",

                                                            "desc"              => "The big title before the portfolio",

                                                            "id"                => "portfolio_big_title",

                                                            "type"              => "textarea",

                                                            "slug"              => "portfolio"


                                                       	),


                                                       array(    

                                                            "name"              => "Single Portfolio Dynamic page on the bottom",

                                                            "desc"              => "",

                                                            "id"                => "portfolio_dynamic_page",

                                                            "type"              => "select",

                                                            "slug"              => "portfolio",

                                                            "subtype"           => 'page' 

                                                       ),

                                                              

                                                                                     

                                                       array(    

                                                            "name"              => "Which page should display the portfolio?",

                                                            "slug"              => "portfolio",

                                                            "desc"              => "Please assign which page you want this portfolio to be on",

                                                            "id"                => "portfolio_page",

                                                            "type"              => "select",

                                                            "subtype"           => "page"

                                                       ),

                                                              

                                                      array(    

                                                            "name"              => "Portfolio Style",

                                                            "slug"              => "portfolio",

                                                            "desc"              => "",

                                                            "id"                => "portfolio_style",

                                                            "type"              => "select",

                                                            "std"               => 'v1',

                                                            "no_first"          => true,

                                                            "subtype"           => array('First Version' => 'v1', 'Second Version' => 'v2')

                                                       ),


                                                        array(    

                                                            "name"              => "Portfolio Filter Style",

                                                            "slug"              => "portfolio",

                                                            "desc"              => "",

                                                            "id"                => "portfolio_filter",

                                                            "type"              => "select",

                                                            "std"               => 'v1',

                                                            "no_first"          => true,

                                                            "subtype"           => array('Normal Style' => 'v1', 'Dropdown Filter' => 'v2')

                                                       ),



                                                      array(    

                                                            "name"              => "Portfolio Layout",

                                                            "slug"              => "portfolio",

                                                            "desc"              => "",

                                                            "id"                => "portfolio_items_layout",

                                                            "type"              => "select",

                                                            "std"               => 'boxed',

                                                            "no_first"          => true,

                                                            "subtype"           => array('Boxed' => 'boxed', 'Wide' => 'wide')

                                                       ),


                                                      array(    

                                                            "name"              => "Portfolio page bg color",

                                                            "slug"              => "portfolio",

                                                            "id"                => "portfolio_bg_color",

                                                            "type"              => "colorpicker",

                                                            "std"               => '#ffffff',

                                                       ),


                                                  array(    

                                                            "name"              => "Select the way you want to show the items",

                                                            "slug"              => "portfolio",

                                                            "desc"              => "",

                                                            'std'               => 'normal_mode',

                                                            "no_first"          => true,

                                                            "id"                => "show_type",

                                                            "type"              => "select",

                                                            "subtype"           => array("Normal" => "normal_mode")

                                                       ),


                                                      array(    

                                                            "name"              => "Portfolio Single Style",

                                                            "slug"              => "portfolio",

                                                            "desc"              => "",

                                                            "id"                => "portfolio_single_style",

                                                            "type"              => "select",

                                                            "std"               => 'bottom',

                                                             "no_first"          => true,

                                                            "subtype"           => array('Left' => 'left', 'Right' => "right", "Bottom" => 'bottom')

                                                       ),
 

                                                       array(    

                                                            "name"              => "Portfolio Single bg color",

                                                            "slug"              => "portfolio",

                                                            "id"                => "portfolio_single_bg_color",

                                                            "type"              => "colorpicker",

                                                            "std"               => '#f6f6f6',

                                                       ),
                                                              

                                                       array(    

                                                            "slug"         => "portfolio",

                                                            "name"         => "Portfolio Columns",

                                                            "desc"         => "How many columns should be displayed?",

                                                            "id"           => "portfolio_columns",

                                                            "type"         => "radioimage",

                                                            "no_first"     =>true,

                                                            "std"          => "3",

                                                            "subtype"      => array( 

                                                                                array('name' => '2 Columns', 'value' =>'2', 'img' => '90x62/2columns/2columns.png'),

                                                                                array('name' => '3 Columns', 'value' =>'3', 'img' => '90x62/3columns/3columns.png'),

                                                                                array('name' => '4 Columns', 'value' =>'4', 'img' => '90x62/4columns.png'),

                                                                                array('name' => '5 Column', 'value' =>'5', 'img' => '90x62/5column.png'),

                                                                           )

                                                       ),

       

                                                       array(    

                                                            "slug"         => "portfolio",

                                                            "name"         => "Portfolio Page Layout",

                                                            "desc"         => "Choose the portfolio layout here. This will change the default layout",

                                                            "id"           => "portfolio_layout",

                                                            "type"         => "radioimage",

                                                            "std"          => "fullsize",

                                                            "no_first"     =>true,

                                                            "subtype"           => array( 

                                                                 array('name' => 'Left Sidebar', 'value' =>'sidebar_left', 'img' => '90x62/sidebarleft.png'),

                                                                 array('name' => 'Right Sidebar', 'value' =>'sidebar_right', 'img' => '90x62/sidebarright.png'),

                                                                 array('name' => 'FullWidth', 'value' =>'fullsize', 'img' => '90x62/fullwidth.png')

                                                            )

                                                       )

                                        



     

                    )

               );

            

/* End Portfolio */















/*------------------------------------------------*/

/*------------------------------------------------*/

/*------------------------------------------------*/















// Layout

/*------------------------------------------------*/

/*------------------------------------------------*/

$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Responsive",

                         "desc"              => "If you want the page to be responsive select yes",

                         "id"                => "responsive_layout",

                         "type"              => "switchbutton",

                         "std"               => 'yes'

                         

                         

);  





$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Select the overall pages layout",

                         "desc"              => "Select the page layout for the website",

                         "id"                => "overall_layout",

                         "type"              => "radioimage",

                         "std"               => 'fullwidth',

                         "no_first"          => true,

                         "subtype"           => array( 

                                                  array('name' => 'Fullwidth', 'value' =>'fullwidth', 'img' => '90x62/fullwidth.png'),

                                                  array('name' => 'Boxed', 'value' =>'boxed', 'img' => 'boxed.png')

                                             )

);  



$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Select the sidebar position on the single blog post",

                         "desc"              => "",

                         "id"                => "single_post_sidebar_pos",

                         "type"              => "radioimage",

                         "std"               => "sidebar_right",

                         "subtype"           => array( 

                                                  array('name' => 'Left Sidebar', 'value' =>'sidebar_left', 'img' => '90x62/sidebarleft.png'),

                                                  array('name' => 'Right Sidebar', 'value' =>'sidebar_right', 'img' => '90x62/sidebarright.png')

                                             )

); 







$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Select blog page sidebar position",

                         "desc"              => "",

                         "id"                => "blog_sidebar_position",

                         "type"              => "radioimage",

                         "std"               => "sidebar_right",

                         "subtype"           => array( 

                                                  array('name' => 'Left Sidebar', 'value' =>'sidebar_left', 'img' => '90x62/sidebarleft.png'),

                                                  array('name' => 'Right Sidebar', 'value' =>'sidebar_right', 'img' => '90x62/sidebarright.png'),

                                                  array('name' => 'FullWidth', 'value' =>'fullsize', 'img' => '90x62/fullwidth.png')

                                             )

);




$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Select Blog Style Type",

                         "desc"              => "",

                         "id"                => "blog_style",

                         "type"              => "select",

                         "no_first"          => true,

                         "std"               => "normal", 

                         "subtype"           => array( 'Normal Style'=>'normal', 'Second Style' =>'second', 'Masonry' => 'masonry' )

);

$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Choose the background color for the blog page",

                         "desc"              => "",

                         "id"                => "blog_bg_color",

                         "type"              => "colorpicker",

                         "std"               => "#ffffff", 

                       


 );    



/*$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Show Author Avatar on Posts ?",

                         "desc"              => "",

                         "id"                => "avatar_bool",

                         "type"              => "switchbutton",

                      

                         "std"               => "no"

);*/

$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Show sharing buttons on posts ?",

                         "desc"              => "Set the sharing buttons for socials into blog single posts",

                         "id"                => "sharing_bool",

                         "type"              => "switchbutton",

                      

                         "std"               => "yes"

);

$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Show meta tags on posts ?",

                         "desc"              => "",

                         "id"                => "meta_bool",

                         "type"              => "switchbutton",

                      

                         "std"               => "yes"

);

$page_elements[] = array(

                         "slug"              => "layout",

                         "name"              => "Footer number of columns",

                         "desc"              => "Here you can select how many columns you want to use in the footer. By selecting any number this will automatically add the footer columns in the widgets section, where you can edit your footer",

                         "std"               => 2,

                         "id"                => "footer_number_columns",

                         "type"              => "radioimage",

                         "no_first"          => true,

                         "subtype"           => array( 

                                                  array('name' => '1 Column', 'value' =>1, 'img' => '90x62/1column.png'),

                                                  array('name' => '2 Columns', 'value' =>2, 'img' => '90x62/2columns/2columns.png'),

                                                  array('name' => '3 Columns', 'value' =>3, 'img' => '90x62/3columns/3columns.png'),

                                                  array('name' => '4 Columns', 'value' =>4, 'img' => '90x62/4columns.png')

                                             )

); 





/* End Layout */













/*------------------------------------------------*/

/*------------------------------------------------*/

/*------------------------------------------------*/











/* Sidebars */



$page_elements[] =  array(    

                         "name"              => "Add new widget areas for pages and categories that will show up in sidebar:",

                         "desc"              => "You can create sidebars for any page or category you want. This sidebar can be edit with any widget that you like",

                         "id"                => "widgetdescription",

                         "std"               => "",

                         "slug"              => "sidebar",

                         "type"              => "description_h",

                         "nodescription"     =>true);

               

               

                         

$page_elements[] =  array("slug"    => "sidebar", "type" => "visual_group_start", "id" => "sidebar_left", "nodescription" => true);

$page_elements[] =  array(

                         "type"              => "layout_section", 

                         "id"                => "widget_pages", 

                         "slug"              => "sidebar",

                         "linktext"          => "Add another widget",

                         "deletetext"        => "Remove widget",

                         "blank"             => true, 

                         "nodescription"     => true,

                         'subelements'       => array( 

     

                                                  array(    

                                                       "name"    => "Select a PAGE that you want to have a individual sidebar.",

                                                       "desc"    => "",

                                                       "id"      => "widget_page",

                                                       "type"    => "select",

                                                       "slug"    => "sidebar",

                                                       "subtype" => 'page'),                              

                                                     )   

);

$page_elements[] =  array("slug"    => "sidebar", "type" => "visual_group_end", "nodescription" => true);











$page_elements[] =  array("slug"    => "sidebar", "type" => "visual_group_start", "id" => "sidebar_right", "nodescription" => true);

$page_elements[] =  array(

                         "type"              => "layout_section", 

                         "slug"              => "sidebar",

                         "id"                => "widget_categories", 

                         "linktext"          => "Add another widget",

                         "deletetext"        => "Remove widget",

                         "blank"             => true, 

                         "nodescription"     => true,

                         'subelements'       => array(

                              

                                                  array(    

                                                       "name"    => "Select a CATEGORY that you want to have a individual sidebar.",

                                                       "desc"    => "",

                                                       "id"      => "widget_cat",

                                                       "slug"    => "sidebar",

                                                       "type"    => "select",

                                                       "subtype" => 'cat'),                               

                                                  )   

);

$page_elements[] =  array("slug"    => "sidebar", "type" => "visual_group_end", "nodescription" => true);



/* End Sidebars */





















/*------------------------------------------------*/

/*------------------------------------------------*/

/*------------------------------------------------*/















/* Contact */

/*------------------------------------------------*/

/*------------------------------------------------*/

$page_elements[] =  array(    

                         "name"                        => "Description",

                         "desc"                        => "Here you can make your contact form. After you done your contact form will be ready as a shortcode and you can use it anywhere you like.",

                         "id"                          => "contactdesc",

                         "std"                         => "",

                         "slug"                        => "contact",

                         "type"                        => "description_h",

                         "nodescription"               =>true

);            

$page_elements[] =  array(    

                         "name"                        => "Your email adress",

                         "slug"                        => "contact",

                         "desc"                        => "Select or add the email address that you want to use for the contact form",

                         "id"                          => "email",

                         "std"                         => get_option('admin_email'),

                         "type"                        => "input_text"

);



$page_elements[] =  array(    

                         "slug"                        => "contact",

                         "name"                        => "Autoresponder Subject",

                         "desc"                        => "",

                         "id"                          => "autoresponder_subject",

                         "std"                         => "",

                         "type"                        => "input_text"

);                  

$page_elements[] =  array(    

                         "slug"                        => "contact",

                         "name"                        => "Autoresponder",

                         "desc"                        => "Write the message to be sent as an auto responde",

                         "id"                          => "autoresponder",

                         "std"                         => "",

                         "type"                        => "textarea"

);             

          

               

$page_elements[] =  array(    

                         "name"                        => "Add new form elements to your contact form:",

                         "desc"                        => "Here you can add or edit contact form fields.",

                         "id"                          => "contactformdescription",

                         "std"                         => "",

                         "slug"                        => "contact",

                         "type"                        => "description_h",

                         "nodescription"               =>true

);

$page_elements[] =  array(    

                         "slug"                        => "contact",

                         "type"                        => "layout_section", 

                         "id"                          => "contact_elements", 

                         "linktext"                    => "Add another Form Element",

                         "deletetext"                  => "Remove Form Element",

                         "blank"                       => true, 

                         "nodescription"               => true,

                         "std"                         => array(

                                                            array('label'=>'Name', 'type'=>'text', 'check'=>'is_empty'),

                                                            array('label'=>'E-Mail', 'type'=>'text', 'check'=>'is_email'),

                                                            array('label'=>'Subject', 'type'=>'text', 'check'=>'is_empty'),

                                                            array('label'=>'Priority', 'type'=>'select', 'check'=>'', 'options'=>'Low, Medium, High, Urgent as Hell, ASAP DUDE!!!'),

                                                            array('label'=>'Message', 'type'=>'textarea', 'check'=>'is_empty')

                                                       ),

                         'subelements'                 => array( 

                              

                                                            array(    

                                                                 "name"    => "Form Element Label",

                                                                 "slug"    => "contact",

                                                                 "desc"    => "",

                                                                 "id"      => "label",

                                                                 "std"     => "",

                                                                 "type"    => "input_text"

                                                            ),

                                 

                                    

                                                            array( 

                                                                 "slug"    => "contact",

                                                                 "name"    => "Form Element Type",

                                                                 "desc"    => "",

                                                                 "id"      => "type",

                                                                 "type"    => "select",

                                                                 "std"     => "text",

                                                                 "no_first"=>true,

                                                                 "subtype" => array('Text input'=>'text', 'Text Area'=>'textarea', 'Select Element'=>'select')

                                                            ),    

                              

                                                            array(     

                                                                 "slug"    => "contact",

                                                                 "name"    => "Form Element Validation",

                                                                 "desc"    => "",

                                                                 "id"      => "check",

                                                                 "type"    => "select",

                                                                 "std"     => "",

                                                                 "no_first"=>true,

                                                                 "subtype" => array('No Validation'=>'', 'Is not empty'=>'is_empty', 'Valid Mail adress'=>'is_email', 'Valid Phone Number'=>'is_phone', 'Valid Number'=>'is_number')

                                                            ), 

                                                                 

                                                            array(    

                                                                 "name"    => "Form Element Options",

                                                                 "slug"    => "contact",

                                                                 "desc"    => "If you are a make a select options field, please write options divided by commas Op1, Op2, Op3",

                                                                 "id"      => "options",

                                                                 "required" => array('type','select'),

                                                                 "std"     => "",

                                                                 "type"    => "input_text"

                                                            ),   

                         ),              

                                    

);



/* End Contact */

/*------------------------------------------------*/

/*------------------------------------------------*/









?>