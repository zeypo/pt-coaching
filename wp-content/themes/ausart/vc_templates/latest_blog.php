<?php 

        
        extract(shortcode_atts(array(


            'dynamic_from_where' => '',

            'post_selected' => ''

        ), $atts));

        $output = '<div class="latest_blog wpb_content_element">';

     
           query_posts('p= '.$post_selected); 

        

            $size_span_class = '';
           
            $output .= '<div class="blog_posts">';

                $output .= '<div class="posts">';   

                                                

                while (have_posts()) : the_post();

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
                        
                        if($post_format == 'standart' && get_post_thumbnail_id()){

                            $output .= '<div class="blog-article grid" >';
                            $output .='<img alt="image_blog" src="'.themeple_image_by_id(get_post_thumbnail_id(), array(300, 160), 'url').'">';        
                            $output .= '<div class="blog_content">';      
                            
                            $output .='<dl>'; 
                               $output .= '<dt class="dt_latest_blog">';

                                        $output .='<div class="date_divs">'.get_the_time('d').'</div>';
                                        $output .='<div class="month_div">'.get_the_time('M').'</div>';
                                        $output .='<div class="post_type"><i class="moon-'.$icon_class.'"></i></div>';
      
                                                    
                                $output .= '</dt>'; 

                                $output .= '<dd>'; 

                                 
                                            
                                            $output .= '<div class="content">';

                                                $output .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
                                                $output .= '<ul class="overlay"><li class="author">'.__('by', 'themeple').' '.get_the_author().'</li> <li class="author">|</li> <li class="comments_nr">'.get_comments_number().' '.__('Comments', 'themeple').'</li> </ul>';
                                                $output .= '<p>'.themeple_text_limit(get_the_excerpt(), 30).'</p>';
                                                $output .= '<a class="readmore" href="'.get_permalink().'">'.__('Read More', 'themeple').'</a>';

                                            $output .= '</div>';

                                $output .='</dd>'; 

                            $output .= '</dl>';    

                                    $output .= '</div>';  


                             $output .= '</div>';         
                        }
                    
                
                endwhile;
                wp_reset_query();
      
                $output .= '</div>';    
            $output .= '</div>';
        $output .= '</div>';
        echo $output;

?>