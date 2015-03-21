<?php
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
        
   <section id="content"  <?php if(themeple_post_meta(themeple_get_post_id(), 'page_header_bool') == 'no'): echo 'style=""'; endif; ?> class="composer_content">
        <?php if($spancontent != 12 || ($spancontent == 12 && !is_vc())){ ?>   
        <div class="container <?php  echo esc_attr($themeple_config['current_sidebar']) ?>" id="blog">
            <div class="row">
            <?php if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] == 'sidebar_left') get_sidebar() ?>   
                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php get_template_part( 'template_inc/loop', 'page' ); ?>

                </div>
                <?php
                
                wp_reset_postdata();    
    
                if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] == 'sidebar_right') get_sidebar();
                 
                ?>  

            </div>
        </div>
        <?php }else{ ?>

            <?php get_template_part( 'template_inc/loop', 'page' ); wp_reset_postdata(); ?>            
             
        <?php } ?>

</section>

    <?php
    get_footer();

?>