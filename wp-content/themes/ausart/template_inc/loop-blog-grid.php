<?php



global $themeple_config;



do_action('themeple_excecute_query_var_action','loop-index');


if (have_posts()) : 



    $i = 0;



	while (have_posts()) : the_post();



        $grid_blog_columns = 4;



        $i++;



        if( ($i % $grid_blog_columns) == 1 && $i != 1){

            echo '</div>';

            echo '<div class="row-fluid grid_row">';

        }

        if($i == 1){

            echo '<div class="row-fluid grid_row">';

        }



        $post_id    = get_the_ID();



        $title   	= get_the_title();



        $content 	= get_the_content();



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

        $item_grid_class = 4;

        switch($grid_blog_columns){

            case "1": $item_grid_class = 12; break;

            case "2": $item_grid_class = 6; break;

            case "3": $item_grid_class = 4; break;

            case "4": $item_grid_class = 3; break;

        }

        $extra_cl = '';

        if($post_format == 'standart' && !get_post_thumbnail_id())
            $extra_cl = 'no_thumbnail';

        ?>


    
        



        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('span'.$item_grid_class.' '.$extra_cl.' blog-article grid normal'); ?>>                    



           

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

		 

					<?php if($post_format == 'audio' || $post_format == 'gallery' || $post_format == 'video' || $post_format == 'quote' || get_post_thumbnail_id()): ?>

                            <dl class="dl-horizontal">
                                <dt>
                    
                                    <div class="avatar box"><?php echo get_avatar(get_the_author_meta('ID')) ?></div>
                                    <div class="date box"><span class="d"><?php the_time('d') ?></span><span class="month"><?php the_time('F') ?></span></div>
                                   

                                 </dt>

                                 <dd>


                                  
                                  <div class="row-fluid">


                                 <?php if ($post_format != 'quote'){ ?>

                                    <div class="span12">



                                        <div class="media">

							                 
                                             <?php if(!is_single()): ?>
                                             <div class="he-wrap tpl2">
                                             <?php endif; ?>

                                            <?php if($post_format == 'audio'){ ?>



                                                





                                                <?php echo do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]'); ?>











                                            <?php }elseif($post_format == 'gallery'){ ?>



                                                  







                                                  <?php $slider = new themeple_slideshow(get_the_ID(), 'flexslider');



               



                                                  if($slider && $slider->slide_number > 0){



                                                        $slider->img_size = 'port1_list';

                                                        $sliderHtml = $slider->render_slideshow();



                                                        echo $sliderHtml;



                                                  }?>











                                            <?php }elseif($post_format == 'video'){ ?>







                                               



                                                <?php $video = ""; if(themeple_backend_is_file( get_the_excerpt(), 'html5video'))



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



                                                ?>

						  
                                               
							

                                            <?php } elseif(get_post_thumbnail_id()){ ?>



                                           
                                               

                                                <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), 'port1_list', 'url')) ?>" alt="">
                                                
                                            

                                            <?php } ?>
                                           
                                        </div>

                                    </div>

                                </div>
                                <?php }?>

				    <?php endif; ?>

                                <div class="row-fluid">

                                    <div class="span12">

                                        <div class="content post_format_<?php echo esc_attr($post_format) ?>" >

                                             <?php $ex_class = ''; if($avatar_bool == 'yes'): $ex_class = 'with_avatar' ?>

                                            <?php echo get_avatar(get_the_author_meta('ID')) ?>

                                            <?php endif; ?>

                                            <div class="top_c <?php echo esc_attr($ex_class) ?>">

                                                <h1><a href="<?php echo esc_url(get_permalink()) ?>"><?php echo get_the_title() ?></a></h1>

                                               

                                                <?php $tags = get_the_tags(); ?>

                                                <?php $tag_out = ''; if($tags) foreach($tags as $tag): $tag_out .= $tag->name.', ';  endforeach; ?>

                                               

                                            </div>

                                            <?php if($post_format != 'quote'): ?>

                                                    <div class="author_name">

                                                            <?php the_author(); ?>
                                                    </div>

                                            <?php endif; ?>

                                            <div class="blog-content">        

                                                        <?php if(is_single()){ ?>



                                                                    <?php the_content() ?>



                                                        <?php }else{



                                                                    if($post_format == 'video' || $post_format == 'audio')



                                                                        echo themeple_text_limit(get_the_content(), 30);



                                                                    elseif($post_format == 'quote')

                                                                        the_excerpt();
                                                                
                                                                    else

                                                                        echo themeple_text_limit(get_the_excerpt(), 40);            

                                                        }



                                                         ?>

                                            </div> 

                                            <?php if($post_format == 'quote'): ?>

                                                <div class="author_name">

                                                            <?php the_author(); ?>
                                                </div>

                                             <?php endif; ?>       

                                            <div class="grid_item_footer">
                                                <a href="<?php echo get_permalink() ?>" class="read_m"><?php _e('En savoir plus', 'themeple') ?></a>
                                                <a class="grid_comments" href="<?php echo get_permalink(); ?>"><?php echo esc_attr($count) ?></a>
                                            </div>
                                        </div>

                                        

                                    </div>

                                </div>
                                </dd>
                                </dl>
                             

               

        </article>

        <?php



        if($wp_query->found_posts == $i)

            echo '</div>';

    endwhile; ?>

    <div class="p_pagination">

    

        <?php themeple_pagination(); ?>

        <div class="pull-right">

            <div class="nav-previous"><?php next_posts_link( 'Next Page' ); ?></div>

            <div class="nav-next"><?php previous_posts_link( 'Previous Page' ); ?></div>

        </div>

    </div>



<?php endif; ?>