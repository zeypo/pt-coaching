<?php
        
        extract(shortcode_atts(array(
            
            'dynamic_title' => '',

            "dynamic_from_where" => '', 

            'dynamic_cat' => '',

            'posts_number' => '2',

            'style' => ''

        ), $atts));

        if($style == 'style_2'):

            $extra_class = 'style_2'; 

        endif;    

        $output = '<div class="recent_news wpb_content_element">';
      
            if(!empty($dynamic_title))
            $output .= '<div class="header"><h2>'.$dynamic_title.'</h2></div>';
      
            $output .= '<div class="pagination news"><a href="#" class="prev"></a><a href="#" class="next"></a></div>';
        
        if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> $posts_number, 'post_type'=> 'post' );                          
        }else{
           $query_post = array('posts_per_page'=> $posts_number, 'post_type'=> 'post', 'cat' => $dynamic_cat ); 
        }
        

            $output .= '<div class="row">';
                $output .= '<div class="news-carousel '.$extra_class.'">';
                $i = 0;   
                       
                        $loop = new WP_Query($query_post);
                                    
                                     if($loop->have_posts()){
                                        while($loop->have_posts()){
                                            $loop->the_post();     
                                            $post_id = get_the_ID();      
                                                $post_format = get_post_format($post_id);
                                                $i++;
                                                if(strlen($post_format) == 0)
                                                    $post_format = 'standart';
						      if($post_format == 'standart'){
								$icon_class="pencil";
		    					}elseif($post_format == 'audio'){
		    						$icon_class="music";
		    					}elseif($post_format == 'soundcloud'){
		    						$icon_class="music";
		    					}elseif($post_format == 'video'){
		    						$icon_class="play-circle";
		    					}elseif($post_format == 'quote'){
		    						$icon_class="quotes-left";
		    					}elseif($post_format == 'gallery'){
		    						$icon_class="images";
		    					}

                                $count = 0;

                                $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                                if(count($comment_entries) > 0){

                                    foreach($comment_entries as $comment){

                                        if($comment->comment_approved)

                                            $count++;

                                    }

                                }
                                if($style == 'style_2'){

                                    $output .= '<div class="news-carousel-item">';
                             
 
                                               $output .= '<dl class="news-article blog-article dl-horizontal style_2">';
                                                    $output .= '<dt>';

                                                
                                                        $output .='<div class="date_div">'.get_the_time('d').'</div>';
                                                        $output .='<div class="month_div">'.get_the_time('M').'</div>';
                                                        $output .='<div class="post_type"><i class="moon-'.$icon_class.'"></i></div>';
                                                   
                                                        
                                                   
                                                    
                                                    $output .= '</dt>';   
                                                    $output .= '<dd>';
                                                        
                                                        $output .= '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
                                                        

                                                        $output .= '<div class="tags">'.__('by', 'themeple').' '.get_the_author().' | '.$count.' '.__('Comments', 'themeple').'</div>';

                                                        $output .= '<div class="blog-content">';        
                                                        
                                                        $output .=      themeple_text_limit(get_the_excerpt(), 30);

                                                        $output .= '<div class="read_right"><a href="'.get_permalink().'">'.__('En savoir plus', 'themeple').'</a></div>';
         
                                                        $output .= '</div>'; 
                                                    $output .= '</dd>';
                                               $output .= '</dl>'; 

                                    $output .='</div>';  

                                } else {

                                  
                                    $output .= '<div class="news-carousel-item">';
                                           

                                               $output .= '<dl class="news-article blog-article dl-horizontal">';
                                                    $output .= '<dt>';

                                                 
                                                        $output .= '<img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'recent_news', 'url').'" alt="">';
                                            
                                                      
                                                    
                                                    $output .= '</dt>';   
                                                    $output .= '<dd>';
                                                        
                                                        $output .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
                                                       
                                                        $output .= '<div class="blog-content">';        
                                                        
                                                        $output .=      themeple_text_limit(get_the_excerpt(), 20);
         
                                                        $output .= '</div>'; 

                                                        $output .= '<div class="read_more"><a href="'.get_permalink().'">'.__('En savoir plus', 'themeple').'</a></div>';

                                                    $output .= '</dd>';
                                               $output .= '</dl>'; 

                                     $output .= '</div>';         
                                                     
                                  
                              

                                            }
                                            
                                        };
                                    };
                         
                                    wp_reset_query(); 
                                   
                    $output .= '</div>';       
            $output .= '</div>';
        $output .= '</div>';


        echo $output;
        
?>