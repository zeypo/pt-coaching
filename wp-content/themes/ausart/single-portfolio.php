<?php
global $themeple_config;

get_header();

$themeple_config['current_sidebar'] = themeple_get_option('single_portfolio_sidebar_pos');
$title = get_the_title();

$metas = themeple_portfolio_custom_field(get_the_ID());
    $cats = wp_get_object_terms(get_the_ID(), 'portfolio_entries');

    $used_template = themeple_get_option_array('portfolio', 'portfolio_cats', $cats[0]->term_id, true);
    
    $title = get_the_title();
    
    $page_parents = themeple_page_parents();
    $subtitle = themeple_post_meta(get_the_ID(), 'desc');        
        ?>

   
    <!-- Page Head -->
    
    <?php 

    if(!isset($_COOKIE['portfolio_single']) || $_COOKIE['portfolio_single'] != 'wide')
        get_template_part('template_inc/page_header'); 
    
    ?>
    

     
    
   
    
    

<!-- Main Content -->
   
    <section id="content" style="background:<?php echo esc_attr($used_template['portfolio_single_bg_color']) ?>;">
    	
        <?php $themeple_config['port_base_id'] = $used_template['portfolio_page']; if(have_posts()){ while (have_posts()) : the_post(); ?>
        
                <div class="row-fluid">
                    <div class="span12 portfolio_single" data-id="<?php echo esc_attr(get_the_ID()) ?>">
                        <div class="container">
                        <?php if(isset($_COOKIE['portfolio_single'])){
                            
					           get_template_part('template_inc/loop', 'single_portfolio_'.$_COOKIE['portfolio_single']);
				        }else{
				    
                            if($used_template['portfolio_single_style'] == 'bottom')
                                get_template_part('template_inc/loop', 'single_portfolio_bottom');
                            else if($used_template['portfolio_single_style'] == 'left')
                                get_template_part('template_inc/loop', 'single_portfolio_left');
                            else if($used_template['portfolio_single_style'] == 'wide')
                                get_template_part('template_inc/loop', 'single_portfolio_wide');
                            else   
                                get_template_part('template_inc/loop', 'single_portfolio_right');
                         }
				?> 
                        </div>

         
                        

                    </div>
                </div>


                
        <?php endwhile; } ?>
            
       
    </section><!-- #content -->    
<?php get_footer() ?>