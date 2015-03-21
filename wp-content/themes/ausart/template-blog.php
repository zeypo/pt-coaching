<?php

global $themeple_config;
$themeple_config['multi_entry_page'] = true;
$themeple_config['current_sidebar'] = themeple_get_option('blog_sidebar_position');
$spancontent = 12;

if(isset($_COOKIE['themeple_blog']) && $_COOKIE['themeple_blog'] != '' )
    $themeple_config['current_sidebar'] = 'sidebar_right';
    if($themeple_config['current_sidebar'] == 'fullsize')
        $spancontent = 12;
    else
        $spancontent = 9;
    $blog_page = themeple_get_option('blogpage');
    
$themeple_config['current_view'] = 'blog';
$cookie_blog = 'normal';
$cookie_sidebar = 'fullsize';
if(isset($_COOKIE['themeple_blog']) && $_COOKIE['themeple_blog'] != '')
	$cookie_blog = $_COOKIE['themeple_blog'];
if(isset($_COOKIE['themeple_sidebar']) && $_COOKIE['themeple_sidebar'] != ''){
	
	$cookie_sidebar = $_COOKIE['themeple_sidebar'];
	if($cookie_sidebar == 'none')
		$spancontent = 12;
}



get_header();

?>
 <?php
            
            $title = get_the_title();
            $page_parents = themeple_page_parents();
            $blog_style = themeple_get_option('blog_style');
            $subtitle = themeple_post_meta(themeple_get_post_id(), 'page_header_desc');
        ?>
   
    <?php get_template_part('template_inc/page_header') ?>
     <?php 
        global $wp_query;
        $current_page = $wp_query->get_queried_object_id();
        $blog_page = themeple_get_option('blogpage');
        $blog_style = themeple_get_option('blog_style');
        $blog_bg_color = themeple_get_option('blog_bg_color');


     
        $style= 'style=background:'.esc_attr($blog_bg_color).'';
    
     ?>


<section id="content" class="<?php echo esc_attr($blog_style) ?>" <?php echo esc_attr($style) ?>>

    	<div class="container" id="blog">
        	<div class="row">
    <?php if(($themeple_config['current_sidebar'] == 'sidebar_left' && !isset($_COOKIE['themeple_sidebar'])) || (isset($_COOKIE['themeple_sidebar']) && $_COOKIE['themeple_sidebar'] == 'left' )) get_sidebar() ?>   
        <div class="span<?php echo esc_attr($spancontent) ?>">
    <?php
        if(( $blog_style == 'grid' && !isset($_COOKIE['themeple_blog'])) || (isset($_COOKIE['themeple_blog']) && $_COOKIE['themeple_blog'] == 'grid' )){
           
            get_template_part( 'template_inc/loop', 'blog-grid' );
           
        }elseif(( $blog_style == 'second' && !isset($_COOKIE['themeple_blog'])) || (isset($_COOKIE['themeple_blog']) && $_COOKIE['themeple_blog'] == 'second' )){
            get_template_part( 'template_inc/loop', 'blog-second-style' );
        }elseif(( $blog_style == 'masonry' && !isset($_COOKIE['themeple_blog'])) || (isset($_COOKIE['themeple_blog']) && $_COOKIE['themeple_blog'] == 'masonry' )){
            get_template_part( 'template_inc/loop', 'blog-masonry' );
        }else
            get_template_part( 'template_inc/loop', 'index' );
    ?>

        </div>
<?php
    wp_reset_postdata();    
    
    if(($themeple_config['current_sidebar'] == 'sidebar_right'  && !isset($_COOKIE['themeple_sidebar'])) || (isset($_COOKIE['themeple_sidebar']) && $_COOKIE['themeple_sidebar'] == 'right' )) get_sidebar();
?>

            </div>
        </div>
</section>

<?php
    get_footer();


?>