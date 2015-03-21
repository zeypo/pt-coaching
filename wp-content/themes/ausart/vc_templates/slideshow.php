<?php

	

	extract(shortcode_atts(array(

            

            'dynamic_which_post_page' => '',

            'dynamic_page_id' => '',

            'dynamic_post_id' => '',

            'thumbnail_status' => '',

            'size' => 'blog'



    ), $atts));

    $output = '<div class="dynamic_slideshow wpb_content_element">';

    if($thumbnail_status == 'no')
    $output .= '<style type="text/css">.with_thumbnails_container .with_thumbnails_carousel{display:none} .dynamic_slideshow.wpb_content_element{margin-bottom:0px;} </style>';

        switch($dynamic_which_post_page)

        {

            case'post': $query_id = $dynamic_post_id; $type ='post'; break;

            case'page': $query_id = $dynamic_page_id; $type ='page'; break;

            case'self': $query_id = $this->post_id;   $type = get_post_type( $this->post_id ); break;

        }



        $query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );

        $additional_loop = new WP_Query($query_post);

        

        if($additional_loop->have_posts())

        {

            

            while ($additional_loop->have_posts())

            { 

                $additional_loop->the_post();

                

                if($dynamic_which_post_page != 'self' && $query_id != get_the_ID())

                {

                    global $more;

                    $more = 0;

                }

                        

                

                if(!$additional_loop->post->post_excerpt || $query_id == get_the_ID())

                {

                           



                            if(themeple_post_meta(get_the_ID(), '_slideshow_type') != 'layer_slider' || $type == 'post'){

                                

                                             $slider = new themeple_slideshow(get_the_ID(), themeple_post_meta(get_the_ID(), '_slideshow_type'));



                                                if($slider){



                                                    $slider->img_size = $size;

                                                    $sliderHtml = $slider->display();







                                                    $output .= $sliderHtml;



                                                }

                            }else if(themeple_post_meta(get_the_ID(), '_slideshow_type') == 'layer_slider'){



                                $slider = new themeple_slideshow(get_the_ID(), 'layer_slider');

                                if($slider){



                                    $slider->options['layer_slider_id'] = themeple_post_meta(get_the_ID(), '_slideshow_layer_slider');

                                    ob_start();



                                    layerslider($slider->options['layer_slider_id']+1);

                                    $output .= ob_get_clean();

                                }

                            }



                }

                

                 

                

                

            }

            

            

        }

       

        $output .= '</div>';

        echo  $output;



?>