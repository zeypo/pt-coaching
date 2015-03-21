<?php

function themeple_generate_video($link){
	$video = "";
	if(themeple_backend_is_file($link, 'html5video'))
					
					{
						$video = themeple_html5_video_embed($link);
					}
					else if(strpos($link,'<iframe') !== false)
					{
						$video = $link;
					}
					else
					{
						global $wp_embed;
						$video = $wp_embed->run_shortcode("[embed]".trim($link)."[/embed]");
					}
					
					if(strpos($video, '<a') === 0)
					{
						$video = '<iframe src="'.$link.'"></iframe>';
	}
	return $video;
}

function themeple_pagination(){
    
      if( is_singular() )
    return;

  global $wp_query;

  /** Stop execution if there's only 1 page */
  if( $wp_query->max_num_pages <= 1 )
    return;

  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = intval( $wp_query->max_num_pages );

  /** Add current page to the array */
  if ( $paged >= 1 )
    $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }

  echo '<div class="pagi"><ul>' . "\n";

  

  /** Link to first page, plus ellipses if necessary */
  if ( ! in_array( 1, $links ) ) {
    $class = 1 == $paged ? ' class="selected"' : '';

    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

    if ( ! in_array( 2, $links ) )
      echo '<li>…</li>';
  }

  /** Link to current page, plus 2 pages in either direction if necessary */
  sort( $links );
  foreach ( (array) $links as $link ) {
    $class = $paged == $link ? ' class="selected"' : '';
    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }

  /** Link to last page, plus ellipses if necessary */
  if ( ! in_array( $max, $links ) ) {
    if ( ! in_array( $max - 1, $links ) )
      echo '<li>… &nbsp;</li>' . "\n";

    $class = $paged == $max ? ' class="selected"' : '';
    printf( '<li%s><a href="%s"">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }

  echo '</ul></div>' . "\n";

}

function themeple_post_pagination_link($link)
{
		$url =  preg_replace('!">$!','',_wp_link_page($link));
		$url =  preg_replace('!^<a href="!','',$url);
		return $url;
}

function themeple_ajax_pagination(){

    $loopFile        = $_POST['loop_file'];
    $paged           = $_POST['page_no'];
    $posts_per_page  = get_option('posts_per_page');
 
    # Load the posts
    query_posts(array('paged' => $paged )); 
    get_template_part( 'template_inc/loop', 'grid' );
 
    exit;
}

add_action('wp_ajax_infinite_scroll', 'themeple_ajax_pagination');           // for logged in user
add_action('wp_ajax_nopriv_infinite_scroll', 'themeple_ajax_pagination');    // if user not logged in


function themeple_box_title($text, $width){
    if($width == 2){
        return themeple_text_limit($text, 2);
    }
    if($width == 3){
        return themeple_text_limit($text, 3);
    }else
    if($width == 4){
        return themeple_text_limit($text, 5);
    }else
    if($width == 6){
        return themeple_text_limit($text, 7);
    }
    if($width == 8 || $width ==  9){
        return themeple_text_limit($text, 10);
    }
}

function themeple_excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      if(strlen($excerpt) > 120 && $limit <= 30)
        return substr($excerpt, 0, 120);
      return $excerpt;
}

function themeple_text_limit($text, $limit) {
      $excerpt = explode(' ', $text, $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      if(strlen($excerpt) > 170 && $limit <= 40)
        return substr($excerpt, 0, 170);
      return $excerpt;
}

function themeple_new_excerpt_more($more) {
return '';
}
add_filter('excerpt_more', 'themeple_new_excerpt_more');
add_post_type_support('page', 'excerpt');
if(!function_exists('themeple_frontend_js'))
{
	if(!is_admin()){
		add_action('init', 'themeple_frontend_js');
	}

	function themeple_frontend_js()
	{	wp_register_script( 'jquery-easing-1-1', THEMEPLE_BASE_URL.'js/jquery.easing.1.1.js', array('jquery'), 1, true );
        wp_register_script( 'jquery-easing-1-3', THEMEPLE_BASE_URL.'js/jquery.easing.1.3.js', array('jquery'), 1, true );
		wp_register_script( 'bootstrap.min', THEMEPLE_BASE_URL.'js/bootstrap.min.js', array('jquery'), 1, true );
		//wp_register_script( 'jquery.cslider', THEMEPLE_BASE_URL.'js/jquery.cslider.js', array('jquery'), 1, false );
        wp_register_script( 'jquery.flexslider-min', THEMEPLE_BASE_URL.'js/jquery.flexslider-min.js', array('jquery'), 1, true );
        //wp_register_script( 'jquery.liquidcarousel', THEMEPLE_BASE_URL.'js/jquery.liquidcarousel.js', array('jquery'), 1, false );
        wp_register_script( 'jquery.mobilemenu', THEMEPLE_BASE_URL.'js/jquery.mobilemenu.js', array('jquery'), 1, true );
        wp_register_script( 'jquery.carouFredSel-6.1.0-packed' , THEMEPLE_BASE_URL.'js/jquery.carouFredSel-6.1.0-packed.js', array('jquery'), 1, true );
        wp_register_script( 'main', THEMEPLE_BASE_URL.'js/main.js', array('jquery'), 1, true);
        wp_register_script( 'modernizr.custom.28468', THEMEPLE_BASE_URL.'js/modernizr.custom.28468.js', array('jquery'), 1, false);
        wp_register_script( 'superfish', THEMEPLE_BASE_URL.'js/superfish.js', array('jquery'), 1, true );
        wp_register_script( 'mediaelementplayer',THEMEPLE_BASE_URL.'js/mediaelement-and-player.min.js', array('jquery'), 1, true ); 
        wp_register_script( 'isotope',THEMEPLE_BASE_URL.'js/isotope.js', array('jquery'), 1, true ); 
        wp_register_script( 'layout_mode', THEMEPLE_BASE_URL.'js/layout-mode.js', array('jquery'), 1, true);
        wp_register_script( 'masonery', THEMEPLE_BASE_URL.'js/masonry.pkgd.min.js', array('jquery'), 1, true);
        //wp_register_script( 'jquery.contentcarousel',THEMEPLE_BASE_URL.'js/jquery.contentcarousel.js', array('jquery'), 1, false  ); 
        wp_register_script( 'jquery.fancybox',THEMEPLE_BASE_URL.'fancybox/source/jquery.fancybox.js', array('jquery'), 1, true  ); 
        wp_register_script( 'jquery.fancybox-media',THEMEPLE_BASE_URL.'fancybox/source/helpers/jquery.fancybox-media.js', array('jquery'), 1, true  ); 
        wp_register_script( 'jquery.touchSwipe.min',THEMEPLE_BASE_URL.'js/jquery.touchSwipe.min.js', array('jquery'), 1, true  ); 
        wp_register_script( 'jquery.mousewheel.min',THEMEPLE_BASE_URL.'js/jquery.mousewheel.min.js', array('jquery'), 1, true ); 
        wp_register_script( 'jquery.imagesloaded.min',THEMEPLE_BASE_URL.'js/imagesloaded.pkgd.min.js', array('jquery'), 1, true); 
        wp_register_script( 'jquery.debouncedresize',THEMEPLE_BASE_URL.'js/jquery.debouncedresize.js', array('jquery'), 1, true);
        wp_register_script( 'jquery.throttledresize',THEMEPLE_BASE_URL.'js/jquery.throttledresize.js', array('jquery'), 1, true);
        wp_register_script( 'customSelect',THEMEPLE_BASE_URL.'js/customSelect.jquery.min.js', array('jquery'), 1, true );
        wp_register_script( 'jquery.cycle',THEMEPLE_BASE_URL.'js/jquery.cycle.all.js', array('jquery'), 1, true  );
        wp_register_script( 'tooltip',THEMEPLE_BASE_URL.'js/tooltip.js', array('jquery'), 1, true  );
        wp_register_script( 'menu',THEMEPLE_BASE_URL.'js/menu.js', array('jquery'), 1, true );
        wp_register_script('jquery.parallax', THEMEPLE_BASE_URL.'js/jquery.parallax.js', array('jquery'), 1, true );
        wp_register_script( 'jquery.hoverex',THEMEPLE_BASE_URL.'js/jquery.hoverex.js', array('jquery'), 1, true );
        wp_register_script( 'modernizr',THEMEPLE_BASE_URL.'js/modernizr.custom.66803.js', array('jquery'), 1, true  );
        wp_register_script( 'placeholder',THEMEPLE_BASE_URL.'js/jquery.placeholder.min.js', array('jquery'), 1, true  );
        wp_register_script('jquery.livequery', THEMEPLE_BASE_URL.'js/jquery.livequery.js', array('jquery'), 1, true );
        wp_register_script('jquery.appear', THEMEPLE_BASE_URL.'js/jquery.appear.js', array('jquery'), 1, false );
        wp_register_script('jquery.easy-pie-chart', THEMEPLE_BASE_URL.'js/jquery.easy-pie-chart.js', array('jquery'), 1, true );
        wp_register_script('odometer.min', THEMEPLE_BASE_URL.'js/odometer.min.js', array('jquery'), 1, true );
        wp_register_script('animations', THEMEPLE_BASE_URL.'js/animations.js', array('jquery', 'modernizr', 'jquery.appear', 'jquery.easy-pie-chart', 'odometer.min'), 1, false );   
        wp_register_script('waypoints.min', THEMEPLE_BASE_URL.'js/waypoints.min.js', array('jquery'), 1, true );
        wp_register_script('countdown', THEMEPLE_BASE_URL.'js/jquery.countdown.min.js', array('jquery'), 1, true );
        wp_register_script('jquery.cookie', THEMEPLE_BASE_URL.'js/jquery.cookie.js', array('jquery'), 1, true );
        wp_register_script('background-check.min', THEMEPLE_BASE_URL.'js/background-check.min.js', array('jquery'), 1, true  );
        wp_register_script('idangerous.swiper.min', THEMEPLE_BASE_URL.'js/idangerous.swiper.min.js', array('jquery'), 1, true  );
        wp_register_script('jquery.infinitescroll', THEMEPLE_BASE_URL.'js/jquery.infinitescroll.js', array('jquery'), 1, true  );
        wp_register_script('switcher', THEMEPLE_BASE_URL.'js/switcher.js', array('jquery'), 1, true  );
        wp_register_style( 'mediaelementplayer',THEMEPLE_BASE_URL.'css/mediaelementplayer.css' );
        wp_register_style( 'jquery.fancybox',THEMEPLE_BASE_URL.'fancybox/source/jquery.fancybox.css?v=2.1.2' );
        wp_register_style( 'hoverex',THEMEPLE_BASE_URL.'css/hoverex-all.css' );
        wp_register_style( 'vector-icons',THEMEPLE_BASE_URL.'css/vector-icons.css' );
        wp_register_style( 'font-awesome',THEMEPLE_BASE_URL.'css/font-awesome.min.css' );
        wp_register_style( 'linecon',THEMEPLE_BASE_URL.'css/linecon.css' );
        wp_register_style( 'steadysets',THEMEPLE_BASE_URL.'css/steadysets.css' );
        wp_register_style( 'bootstrap-responsive',THEMEPLE_BASE_URL.'css/bootstrap-responsive.css' );
        wp_register_style( 'jquery.easy-pie-chart',THEMEPLE_BASE_URL.'css/jquery.easy-pie-chart.css' );  
        wp_register_style( 'odometer-theme-minimal',THEMEPLE_BASE_URL.'css/odometer-theme-minimal.css' );  
        wp_register_style( 'idangerous.swiper',THEMEPLE_BASE_URL.'css/idangerous.swiper.css' );  
    }
}

if(!function_exists('themeple_portfolio_custom_field'))
{

	function themeple_portfolio_custom_field($id = false, $portfolio_keys = false)
	{
		if(!$id) $id = get_the_ID();
		if(!$id) return false;
		
		$output = "";
		$metas = themeple_post_meta($id);
		if(!$portfolio_keys) $portfolio_keys = themeple_get_option('portfolio-meta', array(array('meta'=>'Skills Needed'), array('meta'=>'Client'), array('meta'=>'Project URL')));
		if(empty($metas)) return;
		
		$p_metas = array();
		foreach($metas as $key =>$meta)
		{
			if(strpos($key,'portfolio-meta-') !== false)
			{
				$newkey = str_replace("portfolio-meta-","",$key);
				$p_metas[$newkey-1] = $meta;
			}
		}
		$data = array();
		$counter = 0;
		foreach($portfolio_keys as $key)
		{
			if(!empty($p_metas[$counter]))
			{
				if(themeple_portfolio_url($p_metas[$counter]))
				{
					$linktext = $p_metas[$counter];
					if(strlen($linktext) > 50) $linktext = "Link";
					$p_metas[$counter] = "<a href='".$p_metas[$counter]."'>".$linktext."</a>";
                    $data[$counter] =  array('meta' => "Link", 'value' => $p_metas[$counter]); 
				}
				$data[$counter] = array('meta' => $key['meta'], 'value' => $p_metas[$counter]);
				
			}
			$counter++;
		}
		
		return $data;
	}
}
if(!function_exists('themeple_portfolio_url'))
{

	function themeple_portfolio_url($url)
	{
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}
}


if(!function_exists('themeple_fallback_menu')){
  
    
    function themeple_fallback_menu($args){
        
                $current = "";
    if (is_front_page()){$current = "class='current-menu-item'";} 
    
    
    echo "<ul class='menu'>";
    echo "<li $current><a href='".esc_url(home_url())."'>Home</a></li>";
    wp_list_pages('title_li=&sort_column=menu_order&number=4&depth=0');
    echo "</ul>";
  
    }


}

function themeple_HexToRGB($hex) {
    $hex = str_replace("#", "", $hex);
    $color = array();
 
    if(strlen($hex) == 3) {
      $color['r'] = hexdec(substr($hex, 0, 1) . $r);
      $color['g'] = hexdec(substr($hex, 1, 1) . $g);
      $color['b'] = hexdec(substr($hex, 2, 1) . $b);
    }
    else if(strlen($hex) == 6) {
      $color['r'] = hexdec(substr($hex, 0, 2));
      $color['g'] = hexdec(substr($hex, 2, 2));
      $color['b'] = hexdec(substr($hex, 4, 2));
    }
 
    return $color;
  }



function themeple_page_parents() {
    global $post, $wp_query, $wpdb;
    $post = $wp_query->post;

    $parent_array = array();
    $current_page = $post->ID;
    $parent = 1;

    while($parent) {
    $current_page = esc_sql($current_page);  
    $page_query = $wpdb->get_row($wpdb->prepare("SELECT ID, post_parent FROM $wpdb->posts WHERE ID = %d", $current_page));
    $parent = $current_page = $page_query->post_parent;
    if($parent)
        $parent_array[] = $page_query->post_parent;
    }

    return $parent_array;
}



/*
Plugin Name: SoundCloud Shortcode
Plugin URI: http://wordpress.org/extend/plugins/soundcloud-shortcode/
Description: Converts SoundCloud WordPress shortcodes to a SoundCloud widget. Example: [soundcloud]http://soundcloud.com/forss/flickermood[/soundcloud]
Version: 2.3
Author: SoundCloud Inc.
Author URI: http://soundcloud.com
License: GPLv2

Original version: Johannes Wagener <johannes@soundcloud.com>
Options support: Tiffany Conroy <tiffany@soundcloud.com>
HTML5 & oEmbed support: Tim Bormans <tim@soundcloud.com>
*/


/* Register oEmbed provider
   -------------------------------------------------------------------------- */

wp_oembed_add_provider('#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true);


/* Register SoundCloud shortcode
   -------------------------------------------------------------------------- */

add_shortcode("soundcloud", "themeple_soundcloud_shortcode");


/**
 * SoundCloud shortcode handler
 * @param  {string|array}  $atts     The attributes passed to the shortcode like [soundcloud attr1="value" /].
 *                                   Is an empty string when no arguments are given.
 * @param  {string}        $content  The content between non-self closing [soundcloud]…[/soundcloud] tags.
 * @return {string}                  Widget embed code HTML
 */
function themeple_soundcloud_shortcode($atts, $content = null) {

  // Custom shortcode options
  $shortcode_options = array_merge(array('url' => trim($content)), is_array($atts) ? $atts : array());

  // Turn shortcode option "param" (param=value&param2=value) into array
  $shortcode_params = array();
  if (isset($shortcode_options['params'])) {
    parse_str(html_entity_decode($shortcode_options['params']), $shortcode_params);
  }
  $shortcode_options['params'] = $shortcode_params;

  // User preference options
  $plugin_options = array_filter(array(
    'iframe' => soundcloud_get_option('player_iframe', true),
    'width'  => soundcloud_get_option('player_width'),
    'height' =>  soundcloud_url_has_tracklist($shortcode_options['url']) ? soundcloud_get_option('player_height_multi') : soundcloud_get_option('player_height'),
    'params' => array_filter(array(
      'auto_play'     => soundcloud_get_option('auto_play'),
      'show_comments' => soundcloud_get_option('show_comments'),
      'color'         => soundcloud_get_option('color'),
      'theme_color'   => soundcloud_get_option('theme_color'),
    )),
  ));
  // Needs to be an array
  if (!isset($plugin_options['params'])) { $plugin_options['params'] = array(); }

  // plugin options < shortcode options
  $options = array_merge(
    $plugin_options,
    $shortcode_options
  );

  // plugin params < shortcode params
  $options['params'] = array_merge(
    $plugin_options['params'],
    $shortcode_options['params']
  );

  // The "url" option is required
  if (!isset($options['url'])) {
    return '';
  } else {
    $options['url'] = trim($options['url']);
  }

  // Both "width" and "height" need to be integers
  if (isset($options['width']) && !preg_match('/^\d+$/', $options['width'])) {
    // set to 0 so oEmbed will use the default 100% and WordPress themes will leave it alone
    $options['width'] = 0;
  }
  if (isset($options['height']) && !preg_match('/^\d+$/', $options['height'])) { unset($options['height']); }

  // The "iframe" option must be true to load the iframe widget
  $options['iframe'] = (isset($options['iframe'])?$options['iframe']:'');
  $iframe = soundcloud_booleanize($options['iframe'])
    // Default to flash widget for permalink urls (e.g. http://soundcloud.com/{username})
    // because HTML5 widget doesn’t support those yet
    ? preg_match('/api.soundcloud.com/i', $options['url'])
    : false;

  // Return html embed code
  if ($iframe) {
    return soundcloud_iframe_widget($options);
  } else {
    return soundcloud_flash_widget($options);
  }

}

/**
 * Plugin options getter
 * @param  {string|array}  $option   Option name
 * @param  {mixed}         $default  Default value
 * @return {mixed}                   Option value
 */
function soundcloud_get_option($option, $default = false) {
  $value = get_option('soundcloud_' . $option);
  return $value === '' ? $default : $value;
}

/**
 * Booleanize a value
 * @param  {boolean|string}  $value
 * @return {boolean}
 */
function soundcloud_booleanize($value) {
  return is_bool($value) ? $value : $value === 'true' ? true : false;
}

/**
 * Decide if a url has a tracklist
 * @param  {string}   $url
 * @return {boolean}
 */
function soundcloud_url_has_tracklist($url) {
  return preg_match('/^(.+?)\/(sets|groups|playlists)\/(.+?)$/', $url);
}

/**
 * Parameterize url
 * @param  {array}  $match  Matched regex
 * @return {string}          Parameterized url
 */
function soundcloud_oembed_params_callback($match) {
  global $soundcloud_oembed_params;

  // Convert URL to array
  $url = parse_url(urldecode($match[1]));
  // Convert URL query to array
  parse_str($url['query'], $query_array);
  // Build new query string
  $query = http_build_query(array_merge($query_array, $soundcloud_oembed_params));

  return 'src="' . $url['scheme'] . '://' . $url['host'] . $url['path'] . '?' . $query;
}

/**
 * Iframe widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Iframe embed code
 */
function soundcloud_iframe_widget($options) {

  // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Build URL
  $url = 'http://w.soundcloud.com/player?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : (soundcloud_url_has_tracklist($options['url']) ? '450' : '166');

  return sprintf('<iframe width="%s" height="%s" scrolling="no" frameborder="no" src="%s"></iframe>', $width, $height, $url);
}

/**
 * Legacy Flash widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Flash embed code
 */
function soundcloud_flash_widget($options) {

  // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Build URL
  $url = 'http://player.soundcloud.com/player.swf?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : (soundcloud_url_has_tracklist($options['url']) ? '255' : '81');

  return preg_replace('/\s\s+/', "", sprintf('<object width="%s" height="%s">
                                <param name="movie" value="%s"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
                              </object>', $width, $height, $url, $width, $height, $url));
}



/* Settings
   -------------------------------------------------------------------------- */

/* Add settings link on plugin page */
add_filter("plugin_action_links_" . plugin_basename(__FILE__), 'soundcloud_settings_link');

function soundcloud_settings_link($links) {
  $settings_link = '<a href="'.admin_url().'options-general.php?page=soundcloud-shortcode">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

/* Add admin menu */
add_action('admin_menu', 'soundcloud_shortcode_options_menu');
function soundcloud_shortcode_options_menu() {
  add_options_page('SoundCloud Options', 'SoundCloud', 'manage_options', 'soundcloud-shortcode', 'soundcloud_shortcode_options');
  add_action('admin_init', 'register_soundcloud_settings');
}

function register_soundcloud_settings() {
  register_setting('soundcloud-settings', 'soundcloud_player_height');
  register_setting('soundcloud-settings', 'soundcloud_player_height_multi');
  register_setting('soundcloud-settings', 'soundcloud_player_width ');
  register_setting('soundcloud-settings', 'soundcloud_player_iframe');
  register_setting('soundcloud-settings', 'soundcloud_auto_play');
  register_setting('soundcloud-settings', 'soundcloud_show_comments');
  register_setting('soundcloud-settings', 'soundcloud_color');
  register_setting('soundcloud-settings', 'soundcloud_theme_color');
}

function soundcloud_shortcode_options() {
  if (!current_user_can('manage_options')) {
    wp_die( __('You do not have sufficient permissions to access this page.', 'themeple') );
  }
?>
<div class="wrap">
  <h2>SoundCloud Shortcode Default Settings</h2>
  <p>These settings will become the new defaults used by the SoundCloud Shortcode throughout your blog.</p>
  <p>You can always override these settings on a per-shortcode basis. Setting the 'params' attribute in a shortcode overrides these defaults individually.</p>

  <form method="post" action="options.php">
    <?php settings_fields( 'soundcloud-settings' ); ?>
    <table class="form-table">

      <tr valign="top">
        <th scope="row">Widget Type</th>
        <td>
          <input type="radio" id="player_iframe_true"  name="soundcloud_player_iframe" value="true"  <?php if (strtolower(get_option('soundcloud_player_iframe')) === 'true')  echo 'checked'; ?> />
          <label for="player_iframe_true"  style="margin-right: 1em;">HTML5</label>
          <input type="radio" id="player_iframe_false" name="soundcloud_player_iframe" value="false" <?php if (strtolower(get_option('soundcloud_player_iframe')) === 'false') echo 'checked'; ?> />
          <label for="player_iframe_false" style="margin-right: 1em;">Flash</label>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Player Height for Tracks</th>
        <td>
          <input type="text" name="soundcloud_player_height" value="<?php echo esc_attr(get_option('soundcloud_player_height')); ?>" /> (no unit, or %)<br />
          Leave blank to use the default.
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Player Height for Groups/Sets</th>
        <td>
          <input type="text" name="soundcloud_player_height_multi" value="<?php echo esc_attr(get_option('soundcloud_player_height_multi')); ?>" /> (no unit, or %)<br />
          Leave blank to use the default.
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Player Width</th>
        <td>
          <input type="text" name="soundcloud_player_width" value="<?php echo esc_attr(get_option('soundcloud_player_width')); ?>" /> (no unit, or %)<br />
          Leave blank to use the default.
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Current Default 'params'</th>
        <td>
          <?php echo http_build_query(array_filter(array(
            'auto_play'     => get_option('soundcloud_auto_play'),
            'show_comments' => get_option('soundcloud_show_comments'),
            'color'         => get_option('soundcloud_color'),
            'theme_color'   => get_option('soundcloud_theme_color'),
          ))) ?>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Auto Play</th>
        <td>
          <input type="radio" id="auto_play_none" name="soundcloud_auto_play" value=""<?php if (get_option('soundcloud_auto_play') == '') echo 'checked'; ?> />
          <label for="auto_play_none"  style="margin-right: 1em;">Default</label>
          <input type="radio" id="auto_play_true"  name="soundcloud_auto_play" value="true"<?php if (get_option('soundcloud_auto_play') == 'true') echo 'checked'; ?> />
          <label for="auto_play_true"  style="margin-right: 1em;">True</label>
          <input type="radio" id="auto_play_false" name="soundcloud_auto_play" value="false" <?php if (get_option('soundcloud_auto_play') == 'false') echo 'checked'; ?> />
          <label for="auto_play_false" style="margin-right: 1em;">False</label>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Show Comments</th>
        <td>
          <input type="radio" id="show_comments_none"  name="soundcloud_show_comments" value=""<?php if (get_option('soundcloud_show_comments') == '') echo 'checked'; ?> />
          <label for="show_comments_none" style="margin-right: 1em;">Default</label>
          <input type="radio" id="show_comments_true"  name="soundcloud_show_comments" value="true"<?php if (get_option('soundcloud_show_comments') == 'true') echo 'checked'; ?> />
          <label for="show_comments_true"  style="margin-right: 1em;">True</label>
          <input type="radio" id="show_comments_false" name="soundcloud_show_comments" value="false" <?php if (get_option('soundcloud_show_comments') == 'false') echo 'checked'; ?> />
          <label for="show_comments_false" style="margin-right: 1em;">False</label>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Color</th>
        <td>
          <input type="text" name="soundcloud_color" value="<?php echo esc_attr(get_option('soundcloud_color')); ?>" /> (color hex code e.g. ff6699)<br />
          Defines the color to paint the play button, waveform and selections.
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Theme Color</th>
        <td>
          <input type="text" name="soundcloud_theme_color" value="<?php echo esc_attr(get_option('soundcloud_theme_color')); ?>" /> (color hex code e.g. ff6699)<br />
          Defines the background color of the player.
        </td>
      </tr>

    </table>

      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes', themeple) ?>" />
      </p>

  </form>
</div>
<?php
}

require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'themeple_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function themeple_register_required_plugins() {

  /**
   * Array of plugin arrays. Required keys are name and slug.
   * If the source is NOT from the .org repo, then source is also required.
   */
  $plugins = array(

    // This is an example of how to include a plugin pre-packaged with a theme
    array(
      'name'            => 'LayerSlider WP', // The plugin name
      'slug'            => 'LayerSlider', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/plugins/layersliderwp-5.3.2.installable.zip', // The plugin source
      'required'        => false, // If false, the plugin is only 'recommended' instead of required
      'version'         => '5.3.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ),

    array(
      'name'            => 'Revolution Slider', // The plugin name
      'slug'            => 'revslider', // The plugin slug (typically the folder name)
      'source'          => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
      'required'        => false, // If false, the plugin is only 'recommended' instead of required
      'version'         => '4.3.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'      => '', // If set, overrides default API URL and points to an external URL
    ),

    // This is an example of how to include a plugin from the WordPress Plugin Repository
    array(
      'name'    => 'WP Retina 2x',
      'slug'    => 'wp-retina-2x',
      'required'  => false,
    ),

    array(
      'name'    => 'User Avatar',
      'slug'    => 'user-avatar',
      'required'  => false,
    ),

     array(
            'name'      => 'WPBakery Visual Composer', // The plugin name
            'slug'      => 'js_composer', // The plugin slug (typically the folder name)
            'source'      => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
            'required'      => true, // If false, the plugin is only 'recommended' instead of required
            'version'     => '3.7.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'    => '', // If set, overrides default API URL and points to an external URL
        ),

    array(
  'name'      => 'MailChimp List Subscribe Form',
  'slug'       => 'mailchimp',
  'required'  => false
    )
  );

  // Change this to your theme text domain, used for internationalising strings
  $theme_text_domain = 'themeple';

  /**
   * Array of configuration settings. Amend each line as needed.
   * If you want the default strings to be available under your own theme domain,
   * leave the strings uncommented.
   * Some of the strings are added into a sprintf, so see the comments at the
   * end of each line for what each argument will be.
   */
  $config = array(
    'domain'          => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
    'default_path'    => '',                          // Default absolute path to pre-packaged plugins
    'parent_menu_slug'  => 'themes.php',        // Default parent menu slug
    'parent_url_slug'   => 'themes.php',        // Default parent URL slug
    'menu'            => 'install-required-plugins',  // Menu slug
    'has_notices'       => true,                        // Show admin notices or not
    'is_automatic'      => false,             // Automatically activate plugins after installation or not
    'message'       => '',              // Message to output right before the plugins table
    'strings'         => array(
      'page_title'                            => __( 'Install Required Plugins', $theme_text_domain ),
      'menu_title'                            => __( 'Install Plugins', $theme_text_domain ),
      'installing'                            => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
      'oops'                                  => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
      'notice_can_install_required'           => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_install_recommended'      => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
      'notice_can_activate_required'          => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_activate_recommended'     => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
      'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
      'install_link'                  => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
      'activate_link'                 => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
      'return'                                => __( 'Return to Required Plugins Installer', $theme_text_domain ),
      'plugin_activated'                      => __( 'Plugin activated successfully.', $theme_text_domain ),
      'complete'                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
      'nag_type'                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
    )
  );

  tgmpa( $plugins, $config );

}

if(function_exists('vc_set_as_theme')) vc_set_as_theme();
if (class_exists('WPBakeryVisualComposerAbstract')) {
  function add_themeple_vc(){
    require_once locate_template('/functions-composer.php');
  }
  add_action('init','add_themeple_vc', 5 );
}



function themeple_colourBrightness($hex, $percent) {
  // Work out if hash given
  $hash = '';
  if (stristr($hex,'#')) {
    $hex = str_replace('#','',$hex);
    $hash = '#';
  }
  /// HEX TO RGB
  $rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
  //// CALCULATE
  for ($i=0; $i<3; $i++) {
    // See if brighter or darker
    if ($percent > 0) {
      // Lighter
      $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
    } else {
      // Darker
      $positivePercent = $percent - ($percent*2);
      $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
    }
    // In case rounding up causes us to go to 256
    if ($rgb[$i] > 255) {
      $rgb[$i] = 255;
    }
  }
  //// RBG to Hex
  $hex = '';
  for($i=0; $i < 3; $i++) {
    // Convert the decimal digit to hex
    $hexDigit = dechex($rgb[$i]);
    // Add a leading zero if necessary
    if(strlen($hexDigit) == 1) {
    $hexDigit = "0" . $hexDigit;
    }
    // Append to the hex string
    $hex .= $hexDigit;
  }
  return $hash.$hex;
}













?>