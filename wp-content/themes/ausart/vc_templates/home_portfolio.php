<?php

        ob_start();

        extract(shortcode_atts(array(

            'dynamic_columns' => '',

            'dynamic_rows' => '',
 
            'portfolio_selected' => '',

            'portfolio_style' => 'v2',

            'portfolio_space' => 'no',

            'portfolio_carousel' => 'no'


        ), $atts));

        

        global $portfolio_p;

        global $themeple_config; 
 
        if($portfolio_space == 'yes')
          $home_class = 'with_space';
      

        $output = '<div class="home_portfolio '.$home_class.'">';

        $portfolio_p = $portfolio_selected;


        if(isset($portfolio_p) && $portfolio_p != ''){

        $used_template_p = themeple_get_option_array('portfolio', 'portfolio_page', $portfolio_p, true); 

       

           }



       if(isset($used_template_p))

            $used_template = $used_template_p;

        $cats_port = array();

        if(isset($used_template['portfolio_cats']))

          $cats_port = explode(',', $used_template['portfolio_cats']);

        
        if(!empty($cats_port))
          $args = array(

            'post_type'=> 'portfolio',

            'posts_per_page' => $dynamic_columns*$dynamic_rows,

            'tax_query' => array(   array(  'taxonomy'  => 'portfolio_entries', 
                                              'field'   => 'id', 
                                              'terms'   => $cats_port,  
                                              'operator'  => 'IN'))

          );

        $themeple_config['current_sidebar'] = 'fullsize';

        $themeple_config['used_for_element'] = true;

        $themeple_config['home_portfolio'] = true;

        

       $themeple_config['current_portfolio']['portfolio_columns']  = $dynamic_columns;
       $themeple_config['dynamic_portfolio']['portfolio_style'] = $portfolio_style;
        $grid = 'three-cols';

       switch($dynamic_columns){

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

      

    $spancontent = 12;
      if($portfolio_carousel == 'yes')
          $carousel_class = 'portfolio_carousel';

       $output .= '<div class="'.$carousel_class.'">';

       $output .='<section id="portfolio-preview-items" class="'.$grid.' animate_onoffset" data-nr="'.$dynamic_columns.'">';
       wp_reset_postdata();
       if(!isset($args))
          $args = 'post_type=portfolio&posts_per_page='.$dynamic_columns*$dynamic_rows;
       query_posts( $args );

       get_template_part( 'template_inc/loop', 'portfolio-grid');
       
       wp_reset_query();
       

       $output .= ob_get_clean();

       $output .= '</section>';

       $output .= '</div>';

       

       $output .= '</div>';

       echo $output;

?>