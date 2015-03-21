<?php
       extract(shortcode_atts(array(
            'dynamic_title' => '',
            'style' => ''

        ), $atts));
       ob_start();
       $output = '<div>';
       if(!empty($dynamic_title)){
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3></div>';
        }
       
         query_posts('posts_per_page = -1' );
       
         get_template_part( 'template_inc/loop', $style);
        wp_reset_query();
        $output .= ob_get_clean();
        $output .= '</div>';
        echo  $output;
?>