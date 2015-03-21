<?php
global $themeple_config;
do_action('themeple_excecute_query_var_action','loop-single_portfolio_right');
//$metas = themeple_portfolio_custom_field(get_the_ID());
$metas = themeple_post_meta(get_the_ID());
$output = '';
$cats = wp_get_object_terms(get_the_ID(), 'portfolio_entries');
$used_template = themeple_get_option_array('portfolio', 'portfolio_cats', $cats[0]->term_id, true);
$big_title_bool = themeple_post_meta(get_the_ID(), 'big_title_bool');
?>


	<?php  if($big_title_bool == 'yes'): ?>
		<div class="row-fluid portfolio_single_header">
	
                <h1 class="portfolio_big_title"><?php echo themeple_post_meta(get_the_ID(), 'big_title_page'); ?></h1>


             <ul class="portfolio_single_nav">
                      <?php if(is_object(get_previous_post())): ?>         
                        <li class="prev"><a href="<?php echo get_permalink(get_previous_post()->ID); ?>"></a></li>
                      <?php endif; ?>
                        <li class="all"><a href="<?php echo get_permalink($used_template['portfolio_page']); ?>"></a></li>
                      <?php if(is_object(get_next_post())): ?>
                        <li class="next"><a href="<?php echo get_permalink(get_next_post()->ID); ?>"></a></li>
                      <?php endif; ?>
                </ul>
          
        </div>  
    <?php  endif; ?>     
      
    <div class="row-fluid single_content side_single">
                  
    <div class="row-fluid"  style="margin-top:0px;">
            
            <div class="span8 slider_full with_thumbnails_container">

               <?php if(themeple_post_meta(get_the_ID(), '_slideshow_type') == 'no_slider'){

                    $slider = new themeple_slideshow(get_the_ID(), 'no_slider');

                    }else  {

                   $slider = new themeple_slideshow(get_the_ID(), 'flexslider_thumb');   

                  }
               ?>
             
                       
                                <?php   

                                    if($slider && $slider->slide_number > 1){
                                            $slider->img_size = 'portfolio_side';
                                            $sliderHtml = $slider->render_slideshow();
                                            echo $sliderHtml;
                                      }else{
                                        
                                           $image_string = themeple_image_by_id($slider->slides[0]['slideshow_image'], 'portfolio_side', 'image'); 
                                           echo $image_string;
                                      }
                       
 
             ?>
            </div>
                    <?php  $id_float_side = ''; ?>
            <?php  if(themeple_post_meta(get_the_ID(), '_slideshow_type') == 'no_slider') 
                      $id_float_side = 'id=float_side';
            ?>
            <div class="span4" <?php echo esc_attr($id_float_side); ?>>
                  
                  <div class="details_side"> 
                      <span class="cats">      
                        <?php 
                            $post_id = get_the_ID();
                           
                            $portfolio_cates = wp_get_object_terms( $post->ID,  'portfolio_entries' );
                              
                            $i = 0;
                                $len = count($portfolio_cates);

                                    foreach($portfolio_cates as $c):
                                        if($i == $len - 1 )

                                            echo $c->name;
                                        else

                                            echo $c->name.', ';

                                        $i++;

                                    endforeach;            
                            ?>
                        </span>  
                          <h1><?php the_title() ?></h1>
                         
                  </div>
                  <div class="details_content">
                      <?php the_excerpt(); ?>
                  </div>  
                  <?php 

                          $portfolio_metas = themeple_get_option('portfolio-meta'); 
                          $counter = 0;

                          ?>
                      
                          
                    

                          <div class="meta-content">
                                  <div class="meta">

                            <h1><?php _e('Date', 'themeple') ?></h1>        
                                   
                                      <span> <?php echo get_the_date(); ?> </span>
                                      
                                  </div>
                               
                                 
                             		   <?php foreach($portfolio_metas as $meta): $counter++; ?>
		                                    <?php if(!empty($metas['meta_'.$counter])): ?>
		                                      <div class="meta">
		                                     	
		                                     

				                                <span class="uppertitle">Our Crazy Skills</span>
                                                       
                                                  <h1><?php _e('Things We are Good for', 'themeple') ?></h1>
                                                    
				                                  <div class="custom_content">
                                                      <p><?php echo do_shortcode($metas['meta_'.$counter]) ?></p>
				                                  </div>          

		                                      

		                                      </div>
                                      
                                      
                                     
                                   
                                    <?php endif; ?>
                                  <?php endforeach; ?>
                                  
                               
                            </div>         

                </div>

            
        </div>

</div>