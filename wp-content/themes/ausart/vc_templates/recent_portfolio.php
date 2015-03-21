<?php

        

        extract(shortcode_atts(array(

            'dynamic_title' => '',

            'desc_bool' => '',

            "desc_text" => '', 

            "portfolio_style" => '', 

            'show_text_bool' => '', 

            'show_type' => '',

            'rows' => '',

            'dynamic_block_size' => '',

            'dynamic_from_where' => '',

            'dynamic_cat' => '',

            'pagination_position' => ''



        ), $atts));

        ob_start();

        global $themeple_config;

        $themeple_config['used_for_element'] = true;

        $classs = '';

        if(themeple_get_option('dynamic_greyscale') == 'yes')

                $classs=  'image-desaturate';

        

        $output = '<div class="recent_portfolio '.$classs.' wpb_content_element">';

        

        if(!isset($dynamic_title))

            $dynamic_title = '';

        if(!isset($dynamic_desc))

            $dynamic_desc = '';

        if(isset($dynamic_num_rows))

            $rows = $dynamic_num_rows;

        

        if(!isset($rows))

          $rows = 1;

        if(!empty($dynamic_title) || $rows == 1 && $pagination_position != 'right'){

            $output .= '<div class="header">';

            if($dynamic_title != '')

                $output .= '    <h2>'.$dynamic_title.'</h2>';

            

            if($rows == 1) 

           

            $output .= '</div>'; 

        }

          

        $columns = $dynamic_block_size;   

        $grid = 'three-cols';

        switch($columns){

            case '3':

                $grid = 'three-cols';

                break;

            case '2':

                $grid = 'two-cols';

                break;

            case '4':

                $grid = 'four-cols';

                break;

            case '1':

                $grid = 'one-cols';

                break;

        }

        $posts_per_page = 9999;

        if($rows == 1){

            $coe = 9999;

        }else{

            $coe = $columns*2;

        }

            

        if($dynamic_from_where == 'all_cat'){

            $query_post = array('posts_per_page'=> $coe, 'post_type'=> 'portfolio' );

        }else{

           $category = get_term($dynamic_cat, "portfolio_entries");

           $query_post = array('posts_per_page'=> $coe, 'post_type'=> 'portfolio',  'taxonomy' => 'portfolio_entries', 'portfolio_entries' => $category->slug );

        }

        if(isset($desc_bool) && $desc_bool == 'yes'):

               $size_span_class = 'little_small';

                        $output .= '<div class="row-fluid desc">';

                            $output .= '<div class="span3">';

                               

                                $output .= '<p>'.$desc_text.'</p>';

                          
                            $output .= '</div>';

                            $output .= '<div class="span9">';



        endif; 

        $output .= '<section id="portfolio-preview-items" class="row '.$grid.' rows_'.$rows.' animate_onoffset">';

        if($desc_bool != 'yes'){
        

        $output .= '<div class="recent_portfolio pagination"><a href="#" class="prev"></a><a href="#" class="next"></a></div>';

        }
    

        if($rows == 1){ $output .= '<div class="carousel carousel_portfolio">'; }

        

        $themeple_config['current_portfolio']['portfolio_columns'] = $columns;

        $themeple_config['current_sidebar'] = 'fullsize';

        $themeple_config['dynamic_portfolio']['portfolio_style'] = $portfolio_style;

        $themeple_config['dynamic_portfolio']['show_desc_bool'] = false;

        if(isset($show_text_bool))

            $themeple_config['dynamic_portfolio']['show_desc_bool'] = $show_text_bool;

        $themeple_config['new_query'] = $query_post;



        if($show_type == 'normal_mode')

            get_template_part('template_inc/loop', 'portfolio-grid');

        else if($show_type == 'list')

            get_template_part('template_inc/loop', 'portfolio-list');

        else if($show_type == 'masonry')

            get_template_part('template_inc/loop', 'portfolio-masonry');

        

        $output .= ob_get_clean();

        if($rows == 1){ $output .= '</div>'; }  

        $output .= '</section>';

        if(isset($desc_bool) && $desc_bool == 'yes'):    

                $output .= '</div></div>';

        endif;

        wp_reset_query();

        

        $output .= '</div>';


        echo $output;

?>