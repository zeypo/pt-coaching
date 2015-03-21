<?php
global $themeple_config;

if ( ! isset( $content_width ) ) $content_width = 940;

require_once( 'template_inc/admin/admin_portfolio_type.php' );
require_once( 'template_inc/admin/admin_staff_type.php' );
require_once( 'template_inc/admin/admin_testimonial_type.php' );
require_once( 'template_inc/admin/admin_faq_type.php' );
require_once 'template_inc/admin/register-shortcodes.php' ;
require_once 'themeple_framework/themeple_init.php';

add_action( 'after_setup_theme', 'themeple_theme_setup' );

function themeple_theme_setup(){
    add_action('init', 'themeple_language_setup');
    $themeple_config['thumbnail_sizes']['widget']               = array('width'=>36,  'height'=>36);                        // small preview pics eg sidebar news
    $themeple_config['thumbnail_sizes']['slider_thumb']         = array('width'=>70,  'height'=>50);                        // slideshow preview pics
    $themeple_config['thumbnail_sizes']['fullsize']             = array('width'=>930, 'height'=>930, 'crop'=>false);        // big images for lightbox and portfolio single entries
        
    themeple_generate_thumbnail_sizes($themeple_config);


    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    

    add_image_size( 'port3', 514, 368, true );
    add_image_size( 'port2', 460, 275, true );
    add_image_size( 'port4', 514, 360, true );
    add_image_size( 'recent_news', 80, 77, true);
    add_image_size( 'blog', 700, 301, true );
    add_image_size( 'portfolio_bottom', 1100, 400, true );
    add_image_size( 'portfolio_side', 726, 750, true );
    add_image_size( 'thumbs', 125, 96, true);
    

    themeple_widgets(); 
    

    add_action('wp_enqueue_scripts', 'themeple_register_styles');
    add_action('wp_enqueue_scripts', 'themeple_register_scripts');
    

    add_filter('body_class', 'themeple_add_header_class');
    add_filter('body_class', 'themeple_add_slider_class');
    add_filter('body_class', 'themeple_add_featured_img_class');
    add_filter('body_class', 'themeple_add_page_header_class');
    
    add_filter( 'https_ssl_verify', '__return_false' );
    add_filter( 'https_local_ssl_verify', '__return_false' );


    themeple_add_visual_custom_post_type();

    
    add_theme_support( 'post-formats', array( 'quote', 'gallery','video', 'audio' ) ); 
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    add_theme_support( "title-tag" );

}


function themeple_language_setup() {
    $lang_dir = get_template_directory() . '/lang';
    load_theme_textdomain('themeple', $lang_dir);
}


if(!function_exists('themeple_navigation_menus')){ 

    function themeple_navigation_menus(){
    		global $themeple_config;
    	
    		add_theme_support('nav_menus');
    		foreach($themeple_config['navigations'] as $id => $name){ 
    		      register_nav_menu($id, THEMETITLE.' '.$name); 
            }
   	}
    $themeple_config['navigations'] = array('main' => 'Main Navigation');
    themeple_navigation_menus();
}
if(!function_exists('themeple_widgets'))
{

	function themeple_widgets()
	{
		register_widget( 'themepletwitter' );
        register_widget( 'SocialWidget' );
        register_widget( 'FlickrWidget' );
	   // register_widget( 'LatestBlogWidget' );
        register_widget( 'RecentContentWidget' );
        register_widget( 'SlideshowWidget' );
        register_widget( 'VideoWidget' );
        register_widget( 'ListContentWidget' );
        register_widget( 'ShortcodeWidget' );
        register_widget('ContactInfoWidget');
        register_widget('TopNavWidget'); 
        register_widget('TopInfoWidget');
        register_widget('FooterLogoDesc');

	}
	
	 
}

function themeple_register_styles(){
            wp_enqueue_style('style', get_stylesheet_uri());
            wp_enqueue_style('bootstrap-responsive');
            wp_enqueue_style('jquery.fancybox');    
            wp_enqueue_style('hoverex');
            wp_enqueue_style('vector-icons');
            wp_enqueue_style('font-awesome');
            wp_enqueue_style('linecon');
            wp_enqueue_style('steadysets');
            if (class_exists("Vc_Manager")):
                wp_enqueue_style( 'jquery.easy-pie-chart' );
                wp_enqueue_script( 'jquery.easy-pie-chart' );
                wp_enqueue_script( 'modernizr' );
            endif;
            wp_enqueue_script('animations');
            wp_enqueue_script('jquery.appear');
                       
}


function themeple_fonts(){
    $protocol = is_ssl() ? 'https' : 'http';

    $font = themeple_get_option('font_page');
    wp_enqueue_style( 'font', "$protocol://fonts.googleapis.com/css?family=".str_replace(" ", "+", $font).":100,400,300,500,600,700,300italic" );
    $font_heading = themeple_get_option('font_headings');
  
    wp_enqueue_style( 'font_extra', "$protocol://fonts.googleapis.com/css?family=Satisfy" );

}

add_action( 'wp_enqueue_scripts', 'themeple_fonts' );

function themeple_register_scripts(){
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'bootstrap.min' );
    wp_enqueue_script( 'jquery-easing-1-3' );
    wp_enqueue_script( 'jquery.mobilemenu' );
    if(!is_single()):
        wp_enqueue_script( 'isotope');
    endif;
    wp_enqueue_script('layout_mode');
    wp_enqueue_script('masonery');  
    wp_enqueue_script('customSelect');
    wp_enqueue_script('jquery.flexslider-min');
    wp_enqueue_script('jquery.mousewheel');
    wp_enqueue_script('jquery.fancybox');
    wp_enqueue_script('jquery.fancybox-media');
    if(class_exists("Vc_Manager")):
        wp_enqueue_script( 'jquery.cycle' );
        wp_enqueue_script('jquery.carouFredSel-6.1.0-packed');
    endif;
    wp_enqueue_script('tooltip'); 
    wp_enqueue_script('jquery.hoverex'); 
    wp_enqueue_script('jquery.imagesloaded.min');
    if (class_exists("Vc_Manager")):
        wp_enqueue_script( 'jquery.parallax' );
    endif;
    wp_enqueue_script( 'main' );
    if(is_single()):
        wp_enqueue_script('comment-reply');
    endif;
    wp_enqueue_script('placeholder');
    wp_enqueue_script( 'jquery.livequery');
    if (class_exists("Vc_Manager")):
        wp_enqueue_script('countdown');
        wp_enqueue_script( 'waypoints.min');
        wp_enqueue_script('background-check.min');
    endif;
    wp_enqueue_script('jquery.infinitescroll');
    echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
    echo "var themeple_global = { \n \tajaxurl: '".admin_url( 'admin-ajax.php' )."'\n \t}; \n /* ]]> */ \n ";
    echo "</script>\n \n ";
}




function themeple_get_header_class(){
    $header_class = ( isset($_COOKIE['themeple_header']) ) ? 'header_'.$_COOKIE['themeple_header'] : themeple_get_option('header_types'); 
    
   

    return $header_class;
}

function themeple_add_header_class($classes = ''){
    $header_class = themeple_get_header_class().'_body';
    $one_page = themeple_post_meta(themeple_get_post_id(), 'one_page_bool_'); 
    if($one_page == 'yes'){
        $header_class = 'header_2_body';
        $classes[] = 'one_page';
    }
    if(themeple_post_meta(themeple_get_post_id(), 'page_header_animated') == 'yes')
            $classes[] = 'animated_h';
	$classes[] = $header_class;
	if(themeple_get_option('comingsoon') != '')
	if(themeple_get_option('comingsoon') == get_the_ID() ):
		$classes[] = 'comingsoon_page ';
	endif;

    if(themeple_get_option('change_skin_2') == 'dark' || (isset($_COOKIE['themeple_color_skin']) && $_COOKIE['themeple_color_skin'] == 'dark'))
        $classes[] = 'dark_version';

    if(themeple_post_meta(themeple_get_post_id(), 'big_title_bool') == 'yes')
        $classes[] = 'big_title_true';
	return $classes; 
}


function themeple_add_slider_class($classes = ''){
	 $slider = new themeple_slideshow(themeple_get_post_id());

	 if($slider && $slider->slide_number > 0 && $slider->slide_type != '' && 'portfolio' != get_post_type()){

        

	 	if($slider->options['slideshow_layout'] == 'fixed'){
			$classes[] = 'fixed_slider';
		}else{
            $classes[] = 'fullwidth_slider_page';
        }
        $classes[] = 'with_slider_page';
	 }
	 return $classes;

}


function themeple_add_featured_img_class($classes = ''){
    if(has_post_thumbnail(themeple_get_post_id())){
        $classes[] = 'with_featured_img';
    }
    return $classes;
}


function themeple_add_page_header_class($classes = ''){

    if( (themeple_post_meta(themeple_get_post_id(), 'page_header_bool') == 'yes') || (themeple_post_meta(themeple_get_option('blogpage'), 'page_header_bool') == 'yes' && is_single() && 'portfolio' != get_post_type()) || is_404() || is_search() || is_archive() )
        $classes[] = 'page_header_yes';

    if( themeple_post_meta(themeple_get_post_id(), 'page_header_style') == 'centered' )
        $classes[] = 'page_header_centered';
    return $classes;

}
 
if(!function_exists('themeple_get_post_top_ancestor_id')){

    function themeple_get_post_top_ancestor_id(){
        global $post;
        
        if($post->post_parent){
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            return $ancestors[0];
        }
        
        return $post->ID;
    }
}



/**
 * get_twitter_entries()
 * 
 * @param mixed $count
 * @param mixed $username
 * @param mixed $widget_id
 * @param string $time
 * @param string $avatar
 * @param string $used_for
 * @return
 */
function themeple_get_twitter_top_footer($count, $username, $widget_id = 9999, $time='no', $avatar = 'no')
{       
        $filtered_message = "";
        $output = "";
        $iterations = 0;
        
        
        $cache = get_transient(THEMENAME.'_tweetcache_id_'.$username.'_'.$widget_id);
        
        if($cache)
        {
           $tweets = get_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id);
        }
       else
       {
   
     // Include Twitter API Client
           require_once( 'class-wp-twitter-api.php' );

          $twitter_consumer_key = themeple_get_option('twitter_consumer_key');
          $twitter_consumer_secret = themeple_get_option('twitter_consumer_secret');

        // Set your personal data retrieved at https://dev.twitter.com/apps
            $credentials = array(
              'consumer_key' => $twitter_consumer_key,
              'consumer_secret' => $twitter_consumer_secret            );

// Let's instantiate Wp_Twitter_Api with your credentials
$twitter_api = new Wp_Twitter_Api( $credentials );

// Example a - Retrieve last 5 tweets from my timeline (default type statuses/user_timeline)
$query = 'count=5&include_entities=true&include_rts=true&screen_name='.$username;
          
        $response = $twitter_api->query( $query );
        
      
           if (!is_wp_error($response)) 
            {
                
                                       
                        $tweets = array();
                        if(!empty($response)){
                        foreach ($response as $tweet) 
                        {
                            if($iterations == $count) break;
                            
                            $text = (string) $tweet->text;
                            if($text[0] != "@")
                            {
                                $iterations++;
                                $tweets[] = array(
                                    'text' => filter( $text ),
                                    'created' =>  strtotime( $tweet->created_at ),
                                    'user' => array(
                                        'name' => (string)$tweet->user->name,
                                        'screen_name' => (string)$tweet->user->screen_name,
                                        'image' => (string)$tweet->user->profile_image_url,
                                        'utc_offset' => (int) $tweet->user->utc_offset[0],
                                        'follower' => (int) $tweet->user->followers_count));
                            }
                        }
                        
                        set_transient(THEMENAME.'_tweetcache_id_'.$username.'_'.$widget_id, 'true', 60*30);
                        update_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id, $tweets);
                  
               
            }
        }
    }

        
        if(!isset($tweets[0]))
        {
            $tweets = get_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id);
        }
        
        if(isset($tweets[0]))
        {   
            $time_format = get_option('date_format')." - ".get_option('time_format');
            
                foreach ($tweets as $message)
                {   
                    $output .= '<li class="tweet">';
                        $output .= '<h5>'.$message['user']['name'].' @ '.$message['text'].'</h5>';
                    $output .= '</li>';
                }
        
        }
    
        
        if($output != "")
        {
            
                $filtered_message = "<ul class='tweet_list' id='tweet_footer'>".$output."</ul>";
           
        }
        else
        {
            
                $filtered_message = "<ul class='tweet_list' id='tweet_footer'><li> No public Tweets found</li></ul>";
                
        }
    
        return $filtered_message;
}


function themeple_get_img_sizes_array(){
    global $_wp_additional_image_sizes;
    $result = array();
    foreach($_wp_additional_image_sizes as $size_name => $size):
        $name = $size_name.' ('.$size['width'].', '.$size['height'].')';
        $result[$name] = $size_name;
    endforeach;
    return $result;
}

function themeple_add_visual_custom_post_type(){
    
    $post_type = get_option('wpb_js_content_types');

    if(is_array($post_type)){

            if(!in_array('portfolio', $post_type)){
                $post_type[] = 'portfolio';
                update_option('wpb_js_content_types', $post_type);
            }

    }else{

        $post_type = array('page', 'portfolio');
        add_option('wpb_js_content_types', $post_type);
    }

}


function themeple_wp_title_filter( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }
    
    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }

    return $title;
}

add_filter( 'wp_title', 'themeple_wp_title_filter', 10, 2 );

require_once 'template_inc/slideshow.inc.php';
require_once 'template_inc/functions-template.php';
require_once 'template_inc/admin/register-sidebars.php';
require_once 'template_inc/generate_dynamic_template.php';
require_once 'functions-ausart.php';  
?>