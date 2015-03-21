<?php        

        extract(shortcode_atts(array(

            'staff' => ''



        ), $atts));

        $output = '';

        if(isset($staff)){

        $output .= '<div class="wpb_content_element">';

       

        $query_post = array( 'p' => $staff, 'posts_per_page'=>1, 'post_type'=> 'staff' );

        $additional_loop = new WP_Query($query_post);

        if($additional_loop->have_posts())

        {

            

            while ($additional_loop->have_posts())

            { 

                $additional_loop->the_post();

                

                

                $content = get_the_content();

                 

                 

                $featured = themeple_image_by_id(get_post_thumbnail_id(), array('width' => 2000, 'height' => 2000), 'url');

                $staff_position = themeple_post_meta(get_the_ID(), 'staff_position_');

                 $output .= '<div class="one-staff">';

                            $output .= '<div class="img_staff">';

                            $output .= '<img src="'.$featured.'" alt="">';
            
                            $output .= '</div>';


                            $cl = '';

	

                            $output .= '<div class="content '.$cl.'"><h6>'.get_the_title().'</h6>';

                            $output .='<div class="position_title">';

                            $output .='<span class="position">'.$staff_position.'</span>';

                            $output .='</div>';
				            

                        

                            	$output .= '<p>'.wpb_js_remove_wpautop(get_the_content()).'</p>';

				


                        $output .= '</div>';

                          $output .= '<div class="social_widget">'; 
                          
                        

                                $output .= '<ul>';

                                if(themeple_post_meta(get_the_ID(), 'facebook_link') != '')

                                    $output .= '<li class="facebook"><a href="'.themeple_post_meta(get_the_ID(), 'facebook_link').'" title="Facebook"><i class="moon-facebook"></i></a></li>';

                                if(themeple_post_meta(get_the_ID(), 'twitter_link') != '')

                                    $output .= '<li class="twitter"><a href="'.themeple_post_meta(get_the_ID(), 'twitter_link').'" title="Twitter"><i class="moon-twitter"></i></a></li>';

                                if(themeple_post_meta(get_the_ID(), 'google_link') != '')

                                    $output .= '<li class="google_plus"><a href="'.themeple_post_meta(get_the_ID(), 'google_link').'" title="Google Plus"><i class="moon-google_plus"></i></a></li>';

                                if(themeple_post_meta(get_the_ID(), 'pinterest_link') != '')

                                    $output .= '<li class="pinterest"><a href="'.themeple_post_meta(get_the_ID(), 'pinterest_link').'" title="Pinterest"><i class="moon-pinterest"></i></a></li>';

                                if(themeple_post_meta(get_the_ID(), 'linkedin_link') != '')

                                    $output .= '<li class="linkedin"><a href="'.themeple_post_meta(get_the_ID(), 'linkedin_link').'" title="Linkedin"><i class="moon-linkedin"></i></a></li>';

                                if(themeple_post_meta(get_the_ID(), 'mail_link') != '')

                                    $output .= '<li class="main"><a href="'.themeple_post_meta(get_the_ID(), 'mail_link').'" title="Mail"><i class="moon-mail"></i></a></li>';

                                



                                $output .= '</ul>';
                            

                            $output .= '</div>';

                 $output .= '</div>';

                

            }

            

        }

        

        $output .= '</div>';

        wp_reset_postdata();

        }

    

        echo $output;

?>