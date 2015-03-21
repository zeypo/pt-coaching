<?php

global $themeple_config;
    
    get_header();
    
    if(empty($themeple_config['current_portfolio']['portfolio_columns'])) $themeple_config['current_portfolio']['portfolio_columns'] = 3;
    $portfolio_layout = $themeple_config['current_portfolio']['portfolio_layout'];
    $portfolio_wide = $themeple_config['current_portfolio']['portfolio_items_layout'];
    $show_type = $themeple_config['current_portfolio']['show_type'];
    $spancontent = 12;
    $themeple_config['current_sidebar'] = $portfolio_layout;
    if($portfolio_layout =='fullsize')
        $spancontent = 12;
    else
        $spancontent = 9;
    $categoriesArray = "";
	if(isset($themeple_config['new_query']['tax_query'][0]['terms'])) 
        $categoriesArray = $themeple_config['new_query']['tax_query'][0]['terms'];
	$themeple_config['current_view'] = 'portfolio';
    
    $portfolio_columns = $themeple_config['current_portfolio']['portfolio_columns'];

	$args = array(
	
		'taxonomy'	=> 'portfolio_entries',
		'hide_empty'=> 0,
		'include'	=> $categoriesArray
	
	);
    $themeple_config['multi_entry_page'] = true;
	$categories = get_categories($args);
            
            $title = get_the_title();
            $page_parents = themeple_page_parents();
            $subtitle = themeple_post_meta(themeple_get_post_id(), 'page_header_desc');
            $big_title = $themeple_config['current_portfolio']['portfolio_big_title']
            
        ?>
    <?php get_template_part('template_inc/page_header');
    
    $page_bg_color = $themeple_config['current_portfolio']['portfolio_bg_color']; ?>
    
    
    <section id="content" class="content_portfolio layout-<?php echo esc_attr($portfolio_layout) ?> items-layout-<?php echo esc_attr($portfolio_wide) ?>" style="background:<?php echo esc_attr($page_bg_color) ?>;">
    	   
              <h1 class="portfolio_big_title"><?php echo esc_attr($big_title) ?></h1>

        <?php
      
        $filters = $themeple_config['current_portfolio']['portfolio_filter'];
            $version = '';
            if($filters == 'v1'):
                $version = 'v1';
            endif;

        if(count($categories) > 0){
            echo '<!-- Portfolio Filter --><nav id="portfolio-filter" class="portfolio_page_nav '.$version.'">'; ?>
                <div class="container">

                  

                        

                <?php        if($filters == 'v1'){


                                echo '<ul class="filters_v1">';
                                    echo '<li class="active all"><a href="#"  data-filter="*"><i class="moon-grid-5"></i>'.__('View All', 'themeple').'</a></li>';
                                    
                                foreach($categories as $cat):
                                    
                                        echo '<li class="other"><a href="#" data-filter=".'.esc_attr($cat->category_nicename).'">'.esc_attr($cat->cat_name).'</a></li>';    
                                    
                                endforeach;
                                
                                echo '</ul>';

                        }else{

                ?>


                            <?php echo '<select id="filters">';
                                echo '<option class="active all" value="*">'.__('Sort Portfolio', 'themeple').'</option>';
                                
                            foreach($categories as $cat):
                                
                                    echo '<option class="other"  value=".'.esc_attr($cat->category_nicename).'" >'.esc_attr($cat->cat_name).'</option>';    
                                
                            endforeach;
                            
                            echo '</select>'; } ?>


                </div>
                
            <?php echo '</nav>';
        } ?>
        <?php if($portfolio_wide != 'wide' || $portfolio_layout != 'fullsize'): ?>
        <div class="container">
        <?php endif;
        
    $grid = 'three-cols';
    switch($portfolio_columns){
        case '3':
            $grid = 'three-cols';
            break;
        case '2':
            $grid = 'two-cols';
            break;
        case '4':
            $grid = 'four-cols';
            break;
        case '5':
            $grid = 'five-cols';
            break;
    }

    ?>
        
        <div class="row-fluid">
        <?php if($portfolio_layout == 'sidebar_left') get_sidebar() ?>
            <section id="portfolio-preview-items" class="<?php echo esc_attr($grid) ?> span<?php echo esc_attr($spancontent) ?>" data-nr="<?php echo esc_attr($portfolio_columns) ?>">
            <?php
                
                if($show_type == 'normal_mode')
                    get_template_part('template_inc/loop', 'portfolio-grid');
                wp_reset_postdata();
                
            ?>
            </section>
        <?php if($portfolio_layout == 'sidebar_right') get_sidebar() ?>

        </div>
    <?php if($portfolio_columns != 'wide' || $portfolio_layout != 'fullsize'): ?>
    </div>
    <?php endif; ?>
</section>
<?php  get_footer(); ?>