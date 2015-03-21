<?php

global $themeple_config;
$themeple_config['multi_entry_page'] = true;
$themeple_config['current_sidebar'] = themeple_get_option('blog_sidebar_position');
$spancontent = 12;
    if($themeple_config['current_sidebar'] == 'fullsize')
        $spancontent = 12;
    else
        $spancontent = 9;
$themeple_config['current_view'] = 'blog';
get_header();
           $id = themeple_get_option('blogpage');
        ?>

    <!-- Page Head -->
    
   
  

   <div class="header_page basic colored_bg" style=" background-color:#f7f7f7; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; color:#2f383d; ">

            <div class="container">
                
                                          
                        <h1><?php echo __('Search Results' , 'themeple'); ?></h1>

                           


            </div>

            

    </div>
   
    
  

<!-- End Page Head -->
 <?php $blog_bg_color = themeple_get_option('blog_bg_color');    ?>
    
<section id="content" style="background: <?php echo esc_attr($blog_bg_color); ?>">
        <div class="container" id="blog">
            <div class="row">
    <?php if($themeple_config['current_sidebar'] == 'sidebar_left') get_sidebar() ?>   
        <div class="span<?php echo esc_attr($spancontent) ?>">
    
    <?php
        if(have_posts()){
            
            if(( $themeple_config['current_sidebar'] == 'fullsize' && !isset($_COOKIE['themeple_blog'])) || (isset($_COOKIE['themeple_blog']) && $_COOKIE['themeple_blog'] == 'fullwidth' )){
                get_template_part( 'template_inc/loop', 'blog-fullwidth' );
            }else
                get_template_part( 'template_inc/loop', 'index' );
    
        }else{

    ?>
        <h3 style="font-weight:normal;"><?php _e('Your search did not match any entries', 'themeple') ?></h3>
        <p></p>
        <p><?php _e('Suggestions', 'themeple') ?>:</p>
        <ul style="margin-left:40px">
            <li><?php _e('Make sure all words are spelled correctly', 'themeple') ?>.</li>
            <li><?php _e('Try different keywords', 'themeple') ?>.</li>
            <li><?php _e('Try more general keywords', 'themeple') ?>.</li>
        </ul>
    <?php } ?>

        </div>
<?php
    wp_reset_postdata();    
    
    if($themeple_config['current_sidebar'] == 'sidebar_right') get_sidebar();
?>

            </div>
        </div>
</section>
<?php
    get_footer();


?>