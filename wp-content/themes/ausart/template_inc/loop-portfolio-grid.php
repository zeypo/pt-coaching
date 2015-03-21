<?php
global $themeple_config;
global $portfolio_p;
do_action('themeple_excecute_query_var_action', 'loop-portfolio-grid');
$count_portfolio = 0;
$nr_columns = 3;
if(!isset($portfolio_p) || empty($portfolio_p))
	$portfolio_p = get_the_ID();

if(have_posts()){
    $item_grid_class = '';
    if(isset($themeple_config['current_portfolio']['portfolio_columns'])){
        $nr_columns = $themeple_config['current_portfolio']['portfolio_columns'];
    }
    $excerpt_length = 36;
    if(isset($themeple_config['current_portfolio']['portfolio_layout']) && $themeple_config['current_portfolio']['portfolio_layout'] != 'fullsize')
        $excerpt_length = 6;
    switch($nr_columns){
        case "5": $item_grid_class = 2; break;
        case "2": $item_grid_class = 6; break;
        case "3": $item_grid_class = 4; break;
        case "4": $item_grid_class = 3; break;
    }
    if($themeple_config['current_sidebar'] != 'fullsize')
            $item_grid_class = round( ($item_grid_class*3) / 4);
    if( (isset($themeple_config['used_for_element']) && !$themeple_config['used_for_element']) || !isset($themeple_config['used_for_element']) ){
    ?>
    
                	<div class="row filterable">
    
    <?php
    }
    $the_id = 0;
    $loop_counter = 0;


    if(isset($portfolio_p) && $portfolio_p != '')
        $used_template_p = themeple_get_option_array('portfolio', 'portfolio_page', $portfolio_p, true); 




    while (have_posts()) : the_post();	
	
		$loop_counter++;
    	$the_id 	= get_the_ID();
    	$metas = themeple_post_meta($the_id);
    	$sort_classes = "";
    	$item_categories = get_the_terms( $the_id, 'portfolio_entries' );
    
    	if(is_object($item_categories) || is_array($item_categories))
    	{
    		foreach ($item_categories as $cat)
    		{
    			$sort_classes .= $cat->slug.' ';
    		}
    	}

        $cats = wp_get_object_terms(get_the_ID(), 'portfolio_entries');
        if( (isset($themeple_config['used_for_element']) && !$themeple_config['used_for_element']) || !isset($themeple_config['used_for_element']) ){
            if(!isset($used_template_p))
                $used_template = themeple_get_option_array('portfolio', 'portfolio_cats', $cats[0]->term_id, true);	
            
            $portfolio_style = 'v1';
            
            if(isset($used_template_p)){
                
                $used_template = $used_template_p;
                $portfolio_style = $used_template['portfolio_style'];
                
    	    }
        }else{
            $portfolio_style = $themeple_config['dynamic_portfolio']['portfolio_style'];
        }

    ?>
      
       <!-- Portfolio Normal Mode -->
       
    <!-- item -->
        
    	                    <div class="portfolio-item <?php echo esc_attr($sort_classes) ?> <?php echo esc_attr($portfolio_style) ?>" data-id="<?php echo esc_attr(get_the_ID()) ?>">
                                        <div class="he-wrap tpl2">
                                            <?php if($portfolio_style == 'v1'): ?>
                                                <?php if($item_grid_class == 3){ ?>
                                                    <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), 'port4', 'url')) ?>" alt="">
                                                    <div class="shape4"></div>
                                                <?php } ?>
                                                <?php if($item_grid_class == 4){ ?>
                                                    <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), 'port3', 'url')) ?>" alt="">
                                                    <div class="shape3"></div>
        						                <?php } ?>
                                                <?php if($item_grid_class == 6){ ?>
                                                    <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), 'port2', 'url')) ?>" alt="">
                                                    <div class="shape2"></div>
        						                <?php } ?>
                                                <?php if($item_grid_class == 12){ ?>
                                                    <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), 'port1', 'url')) ?>" alt="">
                                               	  <div class="shape"></div>	
        						                <?php } ?>
                                                <?php if($item_grid_class == 2){ ?>
                                                    <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), 'port4', 'url')) ?>" alt="">
                                                <?php } ?>
                                            <?php endif; ?>

                                            <?php if($portfolio_style == 'v2'): ?>
                                                <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), 'port4', 'url')) ?>" alt="">
                                            <?php endif; ?>
                                            <div class="overlay he-view">
                                                <div class="bg a0" data-animate="fadeIn">
                                                    <div class="center-bar v1">
                                                        <div class="centered"> 
                                                            <div class="portfolio_go a0" data-animate="zoomIn" >
                                                                <a href="<?php echo esc_url(get_permalink()) ?>"><i class="moon-redo"></i></a>
                                                            </div>    
                                                        </div>    
                                                        <a href="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>" class="title a1 lightbox-gallery lightbox" data-animate="fadeInUp"><?php echo get_the_title() ?></a>
                                                        <a href="#" class="categories a2" data-animate="zoomIn"><?php echo esc_attr($sort_classes) ?></a>             
                                                     </div>
                                                </div>
                                                 
                                            </div>         
                                        </div>          
                                     <?php if($portfolio_style == 'v1'): ?>
                                    <div class="info">
                                        <h3><a href="<?php echo esc_url(get_permalink()) ?>"><?php echo get_the_title() ?></a></h3>
                                        <span class="categories"><?php echo esc_attr($sort_classes) ?></span>
                                    </div>      
                                    <?php endif; ?> 
                                     
                                           
	                    </div>
    
        <!-- Portfolio Normal Mode End -->
       
<?php

    
    endwhile;

}

if( (isset($themeple_config['used_for_element']) && !$themeple_config['used_for_element']) || !isset($themeple_config['used_for_element']) ){
?>

<div class="p_pagination">
    
    <?php themeple_pagination(); ?>
    <div class="pull-right">
        <div class="nav-previous"><?php next_posts_link( 'Next Page' ); ?></div>
        <div class="nav-next"><?php previous_posts_link( 'Previous Page' ); ?></div>
    </div>
</div>
<?php } ?>