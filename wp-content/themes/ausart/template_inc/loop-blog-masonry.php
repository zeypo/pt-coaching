<?php
global $themeple_config;
global $post;

do_action('themeple_excecute_query_var_action','loop-index');

$avatar_bool = themeple_get_option('avatar_bool');
if(isset($_COOKIE['authimg']) && !empty($_COOKIE['authimg']) )
    $avatar_bool = $_COOKIE['authimg'];

echo '<div id="blogmasonry"><div class="row filterable">';
if (have_posts()) :

    $i = 0;
 


    while (have_posts()) : the_post();



        $i++;



        
        


        $post_id    = get_the_ID();



        $title      = get_the_title();



        $content    = get_the_content();



        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));



                



        $post_format = get_post_format($post_id);



        if(strlen($post_format) == 0)



            $post_format = 'standart';



        $count = 0;



        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));



        if(count($comment_entries) > 0){



            foreach($comment_entries as $comment){



                if($comment->comment_approved)



                    $count++;



            }



        }

        $extra_cl = '';

        if($post_format == 'standart' && !get_post_thumbnail_id())
            $extra_cl = 'no_thumbnail';

        ?>



        



        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class(' blog-article '.$extra_cl.' grid normal'); ?>>                    



           

         <?php if($post_format == 'standart'){

            $icon_class="pencil";

            }elseif($post_format == 'audio'){

                $icon_class="music";

            }elseif($post_format == 'soundcloud'){

                $icon_class="music";

            }elseif($post_format == 'video'){

                $icon_class="play";

            }elseif($post_format == 'quote'){

                $icon_class="quote-left";

            }elseif($post_format == 'gallery'){

                $icon_class="image";

            }elseif($post_format == 'image'){

                $icon_class="images";

            }else

                $icon_class="pencil";





         ?>

         

                <?php if($post_format == 'audio' || $post_format == 'gallery' || $post_format == 'video' ||  $post_format == 'quote'  || get_post_thumbnail_id()): ?>
                    
                    <div class="media">
                                            
                    <?php if($post_format == 'audio'){ ?>

                        <?php echo do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]'); ?>
                    
                    <?php }elseif($post_format == 'gallery'){ ?>

                        <?php $slider = new themeple_slideshow(get_the_ID(), 'flexslider');

                            if($slider && $slider->slide_number > 0){
                                    
                                    $slider->img_size = 'blog';
                                    $sliderHtml = $slider->render_slideshow(); 
                                    echo $sliderHtml;

                            } 

                        }elseif($post_format == 'video'){

                            $video = ""; 

                            if(themeple_backend_is_file( get_the_excerpt(), 'html5video'))

                            {

                                $video = themeple_html5_video_embed(get_the_excerpt());

                            }

                            else if(strpos(get_the_excerpt(),'<iframe') !== false)

                            {

                                $video = get_the_excerpt();

                            }

                            else

                            {

                                global $wp_embed;

                                $video = $wp_embed->run_shortcode("[embed]".trim(get_the_excerpt())."[/embed]");

                            }

                                                    

                            if(strpos($video, '<a') === 0)

                            {

                                $video = '<iframe src="'.esc_url(get_the_excerpt()).'"></iframe>';

                            } 

                            echo $video;

                        
                        }elseif ($post_format == 'quote') { ?>
                            
                            <div class="quote_box">
                                    <?php echo get_the_excerpt() ?>
                                    <span class="author"><?php the_title(); ?></span>
                            </div>
 
                        <?php } elseif(get_post_thumbnail_id()){ ?>

                            <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>" alt="">
                                                        
                        <?php } ?>
                                                
                    </div>
                    <?php endif; ?>
                    
                    <div class="content post_format_<?php echo esc_attr($post_format) ?>" >
                                      
                            <?php if($post_format != 'quote'): ?>
                            <h1><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h1>

                        
                            <div class="categories">
                                <?php 
                                /* Get category loop */
                                 $post_categories = wp_get_post_categories($post->ID);

                                     $i = 0;   
                                     foreach($post_categories as $c):    
                                        
                                        $i++;

                                        $cat = get_category($c);  
                                        
                                        if(count($post_categories) > $i )    
                                            
                                             echo esc_attr($cat->name).', '; 
                                        
                                        else

                                            echo esc_attr($cat->name);
                                         

                                     endforeach; ?>
                            
                            </div> 

                            <ul class="info">
                                <li><i class="moon-calendar"></i><?php the_time('d') ?> <?php the_time('M') ?> </li> 
                                <li><i class="moon-user-3"></i><?php echo esc_attr(get_the_author()) ?></li>                  
                                <li><i class="moon-bubble"></i><?php echo esc_attr($count) ?> <?php _e('Comments', 'themeple') ?></li> 

                            </ul>
                            <?php endif; ?> 
                            <?php if($post_format != 'quote'): ?>
                            <div class="blog-content">        
                            <?php if(is_single()){

                                the_content();

                            }else{

                                if($post_format == 'video' || $post_format == 'audio')

                                        echo  themeple_text_limit(get_the_content(),50);

                                else

                                        echo get_the_excerpt();
                                                                                                        
                            } ?>
                            <a href="<?php echo get_permalink() ?>" class="readm"><?php echo __('En savoir plus', 'themeple'); ?></a>
                            <?php endif; ?>
                                
                            </div>
                            
        </article>

        <?php endwhile; ?>
           
      




    </div></div>




<?php endif;
?>
 <a id="inifiniteLoader"><img src="<?php echo esc_url( get_template_directory_uri() ) ?>/img/ajax-loader.GIF" /></a>

 <div class="load_more_pagination">

    
        <a class="load_new"><?php echo __('Load More', 'themeple'); ?></a> 

</div>


