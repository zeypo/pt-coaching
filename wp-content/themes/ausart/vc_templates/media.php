<?php



		extract(shortcode_atts(array(

            'type' => '',

            'image' => '',

            'video' => '',

            'slideshow' => '',

            'slideshow_post' => '',

            'slideshow_page' => '',

            'alignment' => '',

            'width' => '',

            'animation' => '',

            'absolute' => '',
            
            'top' => '',

            'left' => '',

            'right' => '',

            'bottom' => ''    

        ), $atts));  

		$output = '<div class="wpb_content_element media media_el animate_onoffset">';

        $width_style="";

        if($alignment == 'center')

            $width_style = ' width:'.$width.'px !important;position:relative; left:50%; margin-left:-'.($width/2).'px; ';

        if($type == 'image'){

            if(isset($image)){

            	if(!empty($image)) {

            

	                if(strpos($image, "http://") !== false){

	                    $image = $image;

	                } else {

	                    $bg_image_src = wp_get_attachment_image_src($image, 'full');

	                    $image = $bg_image_src[0];

	                }

	            }

                if($absolute){
                    $width_style = 'position:absolute; ';
                    if(!empty($left) )
                        $width_style .= ' left: '.$left.'; ';
                    if(!empty($right) )
                        $width_style .= ' right: '.$right.'; ';
                    if(!empty($top) )
                        $width_style .= ' top: '.$top.'; ';
                    if(!empty($bottom) )
                        $width_style .= ' bottom: '.$bottom.'; ';
                }
                $output .= '<img src="'.$image.'" alt="" class="type_image media_animation animation_'.$animation.' alignment_'.$alignment.'" style="'.$width_style.'" />';

            }

        }



        if($type == 'video'){

            $output .= '<div class="video_embeded" '.$width_style.'>';

            if(isset($video)){

                global $wp_embed;

                $output .= $wp_embed->run_shortcode('[embed class="animation_'.$animation.' video alignment_'.$alignment.' '.$width_style.'"]'.trim($video).'[/embed]');

            }

            $output .= '</div>';

        }



        if($type == 'slideshow'){

            switch($slideshow)

            {

                case'posts': $query_id = $slideshow_post; $type ='post'; break;

                case'pages': $query_id = $slideshow_page; $type ='page'; break;

                

            }



            $query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );

            $additional_loop = new WP_Query($query_post);

            

            if($additional_loop->have_posts())

            {

                

                while ($additional_loop->have_posts())

                { 

                    $additional_loop->the_post();

                    

                            

                    

                    if(!$additional_loop->post->post_excerpt || $query_id == $this->post_id)

                    {



                            



                                                    $slider = new themeple_slideshow(get_the_ID(), 'flexslider');



                   



                                                    if($slider && $slider->slide_number > 0){

                                                        

                                                        $slider->slide_container_class .= ' type_slideshow media_animation animation_'.$animation.' alignment_'.$alignment;



                                                        $slider->additional_attr .= $width_style;



                                                        $sliderHtml = $slider->render_slideshow();



                                                        $output .= $sliderHtml;



                                                    }

                            

                    }

                    

                     

                    

                    

                }

                

                

            }

        }

        

        $output .= '</div>';

        echo $output; 

?>