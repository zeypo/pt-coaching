<?php

global $themeple_config;

do_action('themeple_excecute_query_var_action','loop-index');

$avatar_bool = themeple_get_option('avatar_bool');
if(isset($_COOKIE['authimg']) && !empty($_COOKIE['authimg']) )
    $avatar_bool = $_COOKIE['authimg'];

if (have_posts()) :



    while (have_posts()) : the_post();



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

        

        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('row-fluid blog-article '.$extra_cl.' v2 normal'); ?>>                    

            <div class="span12">
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


                $content_class = 'span12';


	     ?>
		 
					   
                                    <?php if($post_format != 'quote'): ?>

                                    <?php if($post_format == 'audio' || $post_format == 'gallery' || $post_format == 'video' || get_post_thumbnail_id()): $content_class = 'span6'; ?>
                                    <div class="span6">

                                        
                    
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


                                             } elseif(get_post_thumbnail_id()){ ?>

                                                <img src="<?php echo esc_url(themeple_image_by_id(get_post_thumbnail_id(), 'blog', 'url')) ?>" alt="">
                                                                            
                                            <?php } ?>
                                                                    
                                        </div>
                                        
                                    </div>
                                    <?php endif; ?>
                                    


                                    <div class="<?php echo esc_attr($content_class) ?>">
                                        <div class="content post_format_<?php echo esc_attr($post_format) ?>" >
                                      
                                        <?php if($post_format != 'quote'): ?>
                                        <h1><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h1>
                                        <?php endif; ?>                    
                                        <?php $tags = get_the_tags(); ?>
                                        <?php $tag_out = ''; $num=count($tags); $i=0; if($tags) foreach($tags as $tag): if(++$i === $num){$tag_out .= $tag->name;} else {$tag_out .= $tag->name.', ';}  endforeach; ?>
                                               
                                        <ul class="info">
                                            <li><i class="linecon-icon-user"></i><?php _e('Posted by', 'themeple') ?> <?php echo get_the_author() ?></li>                   
                                            <li><i class="linecon-icon-bubble"></i><?php echo esc_attr($count) ?> <?php _e('Comments', 'themeple') ?></li> 
                                          
                                           

                                            <?php if(is_single()):
                                            
                                            $google_plus_shares = '<a href="https://plus.google.com/share?url='.esc_url(get_permalink()).'" target="_blank">'; 
                                            $facebook_shares = '<a href="http://www.facebook.com/sharer.php?u='.esc_url(get_permalink()).'" target="_blank">';
                                            $twitter_shares = '<a href="http://twitter.com/home?status='.get_the_title().' '.esc_url(get_permalink()).'" target="_blank">';
                                            $linkedin_shares = '<a href="http://linkedin.com/shareArticle?mini=true&amp;url='.esc_url(get_permalink()).'&title='.get_the_title().'" target="_blank">';
                                            $reddit_shares = '<a href="http://reddit.com/submit?url='.esc_url(get_permalink()).'&title='.get_the_title().'" target="_blank">';
                                            $tumblr_shares = '<a href="http://www.tumblr.com/share/link?url='.esc_url(get_permalink()).'&name='.get_the_title().'&description='.get_the_content().'" target="_blank">';
                                            $pinterest_shares ='<a href="http://pinterest.com/pin/create/button/?url='.esc_url(get_permalink()).'&description='.get_the_title().'&media='.esc_url(wp_get_attachment_url(get_post_thumbnail_id())).'" target="_blank">';
                                            $digg_shares ='<a href="http://www.digg.com/submit?url='.esc_url(get_permalink()).' " target="_blank">';
                                            $mail_shares = '<a href="mailto:?subject='.get_the_title().'&body='.esc_url(get_permalink()).'">';

                                            ?>

                                            <ul class="shares">
                                                                    
                                                <?php $social_icons = themeple_get_option('social_icons'); ?>       
                                                    <?php $i = 0; if(!empty($social_icons))  foreach($social_icons as $icon): if(isset($icon['social']) && $icon['sharebutton'] == 'yes' ): $i++; ?>
                                                                            
                                                        <?php    $link_shares = ${$icon['social'].'_shares'}; ?>

                                                            <li class="<?php echo esc_attr($icon['social']) ?>"><?php echo esc_url($link_shares); ?><i class="moon-<?php echo esc_attr($icon['social']) ?>"></i></a></li>

                                                        <?php endif; if($i == 10) break; endforeach; ?>

                                            </ul>

                                            <?php endif; ?>
                                        </ul>
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
                                        </div>
                                        <?php endif; ?>
                                   
                                    </div>
                                 </div>

                                <?php endif; ?>

                                <?php if($post_format == 'quote'): ?>
                                     <div class="quote_box">
                                            <?php echo get_the_excerpt() ?>
                                            <span class="author"><?php the_title(); ?></span>
                                    </div>
                                <?php endif; ?>
                </div>
        </article>




                            

                    

                

        

        

        <?php



    endwhile; ?>

    <div class="p_pagination">
    
        <?php themeple_pagination(); ?>
        <div class="pull-right">
            <div class="nav-previous"><?php next_posts_link( 'Next Page' ); ?></div>
            <div class="nav-next"><?php previous_posts_link( 'Previous Page' ); ?></div>
        </div>
    </div>

<?php endif;

?>