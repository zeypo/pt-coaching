<?php        
        
        extract(shortcode_atts(array(
            'title' => ''
        ), $atts));   
        $output = '<div class="wpb_content_element contact_info">';
            if(!empty($title))
                $output .='<div class="header">';
                $output .= '<h2>'.$title.'</h2>';
                $output .='</div>';
            $output .= '<div class="content">';
                $output .= '<p>'.do_shortcode($content).'</p>';
                $output .= '<div class="social">';
                    $socials = themeple_get_option('social_icons');
                    if(is_array($socials) && !empty($socials) ):
                        $output .= '<ul>';
                        foreach($socials as $s):
                            $output .= '<li><a href="'.$s['link'].'"><i class="icon-'.$s['social'].'"></i></a></li>';
                        endforeach;
                        $output .= '</ul>';
                    endif;

                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
        echo $output;
?>