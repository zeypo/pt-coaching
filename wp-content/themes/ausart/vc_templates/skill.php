<?php

		extract(shortcode_atts(array(

            'title' => '',

            'percentage' => '',

            'color' => ''

        ), $atts)); 



        $base = themeple_get_option('base_color');

		 if(isset($_COOKIE['themeple_skin'])){



			include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');



			if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){

				$base = $predefined[$_COOKIE['themeple_skin']]['base_color'];

			}

		 }

		/*if(!isset($skill['color']))

            $color = 'base';

        */

        if($color == 'base'){

            $color = $base;
        }    

      

        $output .= '<div class="skill animate_onoffset" data-percentage="'.$percentage.'">';

        $output .= '<h6 class="skill_title">'.$title.'</h6>';

 		$output .= '<div class="prog" style="width:0%; background:'.$color.';"><span style="float:right">'.$percentage.'%</span></div>';

    	$output .= '</div>'; 

    	echo $output;

?>