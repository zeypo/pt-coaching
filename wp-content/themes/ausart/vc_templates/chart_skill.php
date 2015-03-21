<?php



	extract(shortcode_atts(array(

            'percent' => '',

            'text' => '',

            'color_skill' => '',

            'desc' => ''

        ), $atts)); 

	$output = '<div class="wpb_content_element chart_skill animate_onoffset">';

        $base = themeple_get_option('base_color');

	 if(isset($_COOKIE['themeple_skin'])){



		include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');



		if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){

			$base = $predefined[$_COOKIE['themeple_skin']]['base_color'];

		}

	 }

  

        $output .= '<div class="chart" data-percent="'.$percent.'%" data-color="'.$color_skill.'" data-color2="#f6f6f6">';


            $output .= '<span class="text" style="'.themeple_get_option('second_color').';">'.$percent.'%</span>';



        $output .= '</div>';

       

        $output .= '<span class="new_color">'.themeple_get_option('second_color').'</span>';

        

        $output .= '<h5>'.$text.'</h5>';

        $output .= '<p>'.$desc.'</p>';

        $output .= '</div>';

        echo $output;



?>