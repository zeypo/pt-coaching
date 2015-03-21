<?php
/*
Template Name: Archive
*/
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
                
                                          
                  
             <?php if ( have_posts() )
                        the_post(); ?>
              <h1>
                <?php if ( is_day() ) { ?>
                <?php echo __('Archive for ', 'themeple');  echo get_the_date(); ?>
                <?php  } elseif ( is_month() ) { ?>
                 <?php echo __('Archive for ', 'themeple');  echo get_the_date('F Y'); ?>
                <?php  } elseif ( is_year() ) { ?>
                 <?php echo __('Archive for ', 'themeple');  echo get_the_date('Y'); ?>
                <?php  } elseif(is_category()) { ?>
                <?php echo __('Category: ', 'themeple');  echo get_queried_object()->name; ?>
                <?php  } elseif(is_tag()) { ?>
                <?php echo __('Tag: ', 'themeple');  echo get_queried_object()->name; ?>
                <?php }else{ ?>
                  <?php  echo get_queried_object()->name; ?>
                <?php  } ?>
              </h1>
              <?php  rewind_posts(); ?>
           

                   

                           


            </div>

            

    </div>
   
    
  

<!-- End Page Head -->
 <?php $blog_bg_color = themeple_get_option('blog_bg_color');    ?>
<!-- End Page Head -->
    
<section id="content" style="background: <?php echo esc_attr($blog_bg_color); ?>">
        <div class="container" id="blog">
            <div class="row">
    <?php if($themeple_config['current_sidebar'] == 'sidebar_left') get_sidebar() ?>   
        <div class="span<?php echo esc_attr($spancontent); ?>">
    <?php
        if($themeple_config['current_sidebar'] == 'fullsize'){
            get_template_part( 'template_inc/loop', 'blog-fullwidth' );
        }else
            get_template_part( 'template_inc/loop', 'index' );
    ?>

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