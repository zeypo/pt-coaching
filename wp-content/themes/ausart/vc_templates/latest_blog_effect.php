<?php

        



        extract(shortcode_atts(array(

            'dynamic_title' => '',

            'dynamic_from_where' => '',

            "dynamic_cat" => ''



        ), $atts));

        $posts_per_page = 9999;

     

        



        $output = '<div class="latest_blog_effect wpb_content_element">';

        if(!empty($title)){

            $output .= '<div class="header"><h3>'.$title.'</h3></div>';

        }

        if($dynamic_from_where == 'all_cat'){

            $query_post = array('posts_per_page'=> 3, 'post_type'=> 'post'  );                          

        }else{

           $query_post = array('posts_per_page'=> 3, 'post_type'=> 'post', 'cat' => $dynamic_cat ); 

        }

            $size_span_class = '';

            

            $output .= '<div class="row">';

                $output .= '<div class="latest_blog_effect">';

                                            

                        $loop = new WP_Query($query_post);

                                     $i = 0;

                                     if($loop->have_posts()){

                                        while($loop->have_posts()){

                                            $loop->the_post();

                                            

                                            $post_id = get_the_ID();      

                                            $post_format = get_post_format($post_id);



                                                if(strlen($post_format) == 0)

                                                    $post_format = 'standart';    

                                                if($post_format == 'standart'){

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

                              $active = '';

                              if($i == 0)

                                $active = 'active'; 

                                        if($post_format == 'standart'){

                                            $i++;

                                                $output .= '<div class="blog-article '.$size_span_class.' '.$active.'">';



                                                $output .= '            <div class="media">';





                                              

                                                            $output .= '<div class="he-wrap tpl2">';

                                                                    $output .= '<img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'port4', 'url').'" alt="">';

                                                                    $output .= '<div class="overlay he-view">';

                                                                    $output .= '   <div class="bg a0" data-animate="fadeIn">';

                                                                    $output .= '        <div class="center-bar v1">';

                                                                    $output .= '            <a href="'.get_permalink().'" class="link a0" data-animate="zoomIn"><i class="moon-'.$icon_class.'"></i></a></a>';

                                                               

                                                               

                                                                    $output .= '        </div>';

                                                                    $output .= '    </div>';

                                                                    $output .= '</div>';

                                                        $output .= '</div>';   

                               

                                          

                               

                                

                                $output .= '</div>';



                                $output .= '<dl class="">';

                                $output .= '        <h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';

                                $output .= '        <ul class="info">';

                                                  

                                $output .= '            <li>'.$count.' '.__('Comments', 'themeple').'</li>';

                                $output .= '            <li>'.get_the_date().'</li>';

                                    

                                $output .= '        </ul>';

                                $output .= '    <dd>';



                                $output .= '        <div class="blog-content">';        

                                $output .=              themeple_text_limit(get_the_excerpt(), 17);



                                                                   

                                $output .= '        </div>'; 

                                $output .= '    </dd>';

    

                                $output .= '</dl>';                                 

                                            

                                                                       





                                $output .= '</div>';

                                           

                                }     

                                        };

                                    };

                                    wp_reset_query();
                                    wp_reset_query();

                

                    $output .= '</div>';       





        $output .= '</div>';





        echo $output;

?>