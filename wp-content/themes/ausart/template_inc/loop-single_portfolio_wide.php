<?php
global $themeple_config;
do_action('themeple_excecute_query_var_action','loop-single_portfolio_wide');
//$metas = themeple_portfolio_custom_field(get_the_ID());
$metas = themeple_post_meta(get_the_ID());
$output = '';
$cats = wp_get_object_terms(get_the_ID(), 'portfolio_entries');
$used_template = themeple_get_option_array('portfolio', 'portfolio_cats', $cats[0]->term_id, true);

?>

         
    
            <div class="wide_slider">

                
            <?php $slider = new themeple_slideshow(get_the_ID(), 'flexslider');
                       
                                      if($slider && $slider->slide_number > 0){
                                            $slider->img_size = 'portfolio_bottom';
                                            $sliderHtml = $slider->render_slideshow();
                                            echo $sliderHtml;
                                      }
                       

             ?>
             <div class="container">
               <div class="header_nav">
                            <div class="navigations">
                                <?php if(is_object(get_previous_post())): ?>
                                    <a class="prev" href="<?php echo get_permalink(get_previous_post()->ID); ?>"></a>
                                <?php endif; ?>
                                <a class="portfolio_home" href="?page_id=<?php echo esc_attr($used_template['portfolio_page']); ?>"></a>
                                <?php if(is_object(get_next_post())): ?>
                                    <a class="next" href="<?php echo get_permalink(get_next_post()->ID); ?>"></a>
                                <?php endif; ?>
                            </div>    
               </div>  
            </div>   

             <?php $bg_color = themeple_get_option('second_color');

              $bg_color = themeple_HexToRGB($bg_color);
              $style = 'background-color: rgba('.$bg_color['r'].','.$bg_color['g'].','.$bg_color['b'].', 0.77); ';
              $bg_color_var = 'rgba('.$bg_color['r'].','.$bg_color['g'].','.$bg_color['b'].', 0.77)';

              ?>
             <div class="wpb_row vc_row-fluid transparency_section animate_onoffset row-dynamic-el section-style    no_borders   start_animation" style="<?php echo esc_attr($style) ?>; padding-top: 0px !important; padding-bottom: 0px !important; margin-top: -86px;">
                 <div class="triangle_bottom" style="border-color: <?php echo esc_attr($bg_color_var); ?> transparent transparent transparent ;"></div>
                 <div class="container  light">
                     <div class="vc_span12 wpb_column column_container">
                        <div class="wpb_wrapper">
                            <div class="wpb_content_element dynamic_page_header style_2"><h1 style="font-size:36px;"><?php the_title(); ?></h1></div>
                        </div> 
                    </div> 
                </div>
               
               
                  


           
              
            </div>

           </div> 
            <div class="container">
                <div class="single_content bottom">
                    <div class="row-fluid row-dynamic-el">
                        <div class="span12">
                            
                           <?php

                                  the_content();
                            ?>

                          
                        </div>    
                        
                    </div>
                </div>
            </div>