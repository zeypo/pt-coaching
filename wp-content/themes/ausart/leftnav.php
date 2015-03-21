<?php
/*
Template Name: Left Navigation
*/
global $themeple_config;
    
    do_action( 'themeple_routing_template' , 'page' );
    $themeple_config['current_view'] = 'page';
    $meta = themeple_post_meta(themeple_get_post_id());


    if(!isset($themeple_config['current_sidebar']) ){
        $themeple_config['current_sidebar'] = 'fullsize';
    }

    if(isset($meta['layout']))
        $themeple_config['current_sidebar'] = $meta['layout'];
    $spancontent = 12;
    if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] == 'fullsize')
        $spancontent = 12;
    elseif(isset($themeple_config['current_sidebar']) && ($themeple_config['current_sidebar'] == 'sidebar_left' || $themeple_config['current_sidebar'] == 'sidebar_right'))
        $spancontent = 9;

    get_header();
    
    
    ?>
    
        <?php
            
            $title = get_the_title();
            $page_parents = themeple_page_parents();
            $subtitle = themeple_post_meta(themeple_get_post_id(), 'page_header_desc');
        ?>

    <?php get_template_part('template_inc/page_header'); ?>

  <?php 
    
    $left_nav_bg = esc_attr(themeple_get_option('left_nav_bg'));
    $left_nav_bg_color = esc_attr(themeple_get_option('left_nav_bg_color'));

    if(!empty($left_nav_bg)){


   $bg = 'style=background:'.$left_nav_bg_color.' url('.$left_nav_bg.') no-repeat;'; 
   
   }else{

    $bg = 'style=background:'.$left_nav_bg_color.';'; 

   }
  ?>
  
<section id="content" class="left-navigation" <?php echo esc_html($bg); ?>>
 
        <div class="container" id="page">
            <div class="row">
                    <div class="span3">
                            <ul class="side-nav">
                                <?php if(is_page('$post->post_parent')): ?><?php endif; ?>
                                <li <?php if(is_page($post->post_parent)): ?>class="current_page_item"<?php endif; ?>><a href="<?php echo esc_url(get_permalink($post->post_parent)); ?>" title="Back to Parent Page"><?php echo get_the_title($post->post_parent); ?></a></li>
                               
                            <?php
                                  if($post->post_parent) {
                                  $children = wp_list_pages("title_li=&child_of=".esc_attr(themeple_get_post_top_ancestor_id())."&echo=0");
                              
                                  }else{
                                  $children = wp_list_pages("title_li=&child_of=".esc_attr($post->ID)."&echo=0");
                                 
                                  }
                                  if ($children) { ?>

                               
                                  <ul>
                                  <?php echo $children; ?>
                                  </ul>

                            <?php } ?>



                    </div>

                    <div class="span9">
			   <?php if(isset($genDynamic))	
            				$genDynamic->display();
        			  else
                        		the_content() 
			   ?>
                    </div>

            </div>
        </div>
</section>
<?php
    get_footer();


?>