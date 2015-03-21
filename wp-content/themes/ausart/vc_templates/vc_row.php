<?php



	extract(shortcode_atts(array(

	  "type" => 'in_container',

	  'bg_image'=> '', 

	  'bg_position'=> '', 

	  'color_lines' => '',

	  'bg_repeat' => '', 

	  'parallax_bg' => '', 

	  'bg_color'=> '',

	  'overlay'=> '', 

	  'overlay_color'=> '',  

	  'overlay_opacity'=> '.65',  
	  
	  'overlay_zindex'=> '1',

	  'video_bg'=> '', 

	  'video_webm'=> '', 

	  'video_mp4'=> '', 

	  

	  "top_padding" => "0", 

	  "bottom_padding" => "0",

	  'text_color' => 'dark',  

	  'custom_text_color' => '',  

	  'transparency' => '',

	  'borders' => '',

	  'triangle_top' => '',

	  'triangle_bottom' => '',

	  'second_section' => '',

	  'bg_image_2'=> '', 

	  'bg_position_2'=> '', 

	  'bg_repeat_2' => '', 

	  'parallax_bg_2' => '', 

	  'bg_color_2'=> '',

	  'overlay_2'=> '', 

	  'overlay_color_2'=> '',  

	  'overlay_opacity_2'=> '.65',  
	  
	  'overlay_zindex_2'=> '1',

	  'video_bg_2'=> '', 

	  'video_webm_2'=> '', 

	  'video_mp4_2'=> '', 

	  'class' => '',

	  'section_name' => ''), 

	$atts));

	

	wp_enqueue_style( 'js_composer_front' );

	wp_enqueue_script( 'wpb_composer_front_js' );

	

    $style = null;

	$etxra_class = null;

	$bg_im = '';

	if(!empty($bg_image)) {

			

		if(strpos($bg_image, "http://") !== false){

				
			if(!$parallax_bg){
				$style .= 'background-image: url('. $bg_image . '); ';

				$style .= 'background-position: '. $bg_position .'; ';
			}
			

			$bg_im = $bg_image;

		} else {

			$bg_image_src = wp_get_attachment_image_src($bg_image, 'full');

			
			if(!$parallax_bg){
				$style .= 'background-image: url('. $bg_image_src[0]. '); ';

				$style .= 'background-position: '. $bg_position .'; ';
			}
			

			$bg_im = $bg_image_src[0];

		}

		

		//for pattern bgs

		if(strtolower($bg_repeat) == 'repeat'){

			$style .= 'background-repeat: '. strtolower($bg_repeat) .'; ';

			$etxra_class = 'no-cover';

		} else {

			$style .= 'background-repeat: '. strtolower($bg_repeat) .'; ';

			$etxra_class = null;

		}

	}

	

	if(!empty($bg_color)) {
		$bg_color_var = '';
		if($bg_color == 'base'){
			$bg_color = themeple_get_option('base_color');
		}else if($bg_color == 'second')
			$bg_color = themeple_get_option('second_color');

		if($transparency){
			$bg_color = themeple_HexToRGB($bg_color);
			$style .= 'background-color: rgba('.$bg_color['r'].','.$bg_color['g'].','.$bg_color['b'].', 0.77); ';
			$bg_color_var = 'rgba('.$bg_color['r'].','.$bg_color['g'].','.$bg_color['b'].', 0.77)';
		}else{
			$style .= 'background-color: '. $bg_color.'; ';
			$bg_color_var = $bg_color;
		}

	}
	

	if(strtolower($parallax_bg) == 'true'){

		$parallax_class = 'parallax_section';

	} else {

		$parallax_class = '';

	}

	

	$style .= 'padding-top: '. $top_padding .'px !important; ';

	$style .= 'padding-bottom: '. $bottom_padding .'px !important; ';

	

	if($text_color == 'custom' && !empty($custom_text_color)) {

		$style .= 'color: '. $custom_text_color .'; ';

	}

	

	//main class

	if($type == 'in_container') {

		

		$main_class = "standard_section ";

		

	} else if($type == 'full_width_background'){

		

		$main_class = "section-style ";

	

	} else if($type == 'full_width_content'){

		

		$main_class = "full-width-content section-style ";

	}

	

	if($video_bg)

		$etxra_class .= ' video_section '; 

	 

	$video_markup = '';

	$overlay_markup = ''; 

	$parallax_markup = '';

	if($video_bg) {



		$video_markup = '<div class="video-wrap"><video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0"> 

                                                                        <source src="'.$video_webm.'" type="video/webm"> 

                                                                        <source src="'.$video_mp4.'" type="video/mp4"> 

                                                      

                                                                        Video not supported </video></div>';

	

	} 



	if($overlay){
		if($overlay_color == 'base')
			$overlay_color = themeple_HexToRGB(themeple_get_option('base_color'));
		else if($overlay_color == 'second')
			$overlay_color = themeple_HexToRGB(themeple_get_option('second_color'));
		else
			$overlay_color = themeple_HexToRGB($overlay_color);

		$overlay_markup = '<div class="bg-overlay" style="background:rgba('.$overlay_color['r'].', '.$overlay_color['g'].', '.$overlay_color['b'].', '.$overlay_opacity.');z-index:'.$overlay_zindex.';"></div>';
		if($bg_color_var == '')
			$bg_color_var = 'rgba('.$overlay_color['r'].', '.$overlay_color['g'].', '.$overlay_color['b'].', 1)';
	}
	$triangle_top_html = '';
	if($triangle_top){
		$triangle_top_html = '<div class="triangle_top" style="border-color: transparent transparent '.$bg_color_var.' transparent;"></div>';
	}

	$triangle_bottom_html = '';
	if($triangle_bottom){
		$triangle_bottom_html = '<div class="triangle_bottom" style="border-color: '.$bg_color_var.' transparent transparent transparent;"></div>';
	}
	$animate_onoffset = '';
	$animate_onoffset_c = '';
	if($parallax_bg){

		$parallax_markup = '<div class="parallax_bg"  style="background-image: url('.$bg_im.'); background-position: 50% 0px; background-attachment:fixed !important"></div>';
		$animate_onoffset_c = 'animate_onoffset';
	}else
		$animate_onoffset = 'animate_onoffset';


	$transparency_markup = '';
	$transparency_class = '';
	if($transparency){
		$transparency_markup = '';
		$transparency_class = 'transparency_section';
	}

	if($borders)
		$etxra_class .= ' borders ';


	$style_2 = $bg_im_2 = $etxra_class_2 = $bg_color_var_2 = $parallax_class_2 = '';
	if($second_section == 'second_yes'){

			if(!empty($bg_image_2)) {

				if(strpos($bg_image_2, "http://") !== false){

						
					if(!$parallax_bg_2){
						$style_2 .= 'background-image: url('. $bg_image_2 . '); ';

						$style_2 .= 'background-position: '. $bg_position_2 .'; ';
					}
					

					$bg_im_2 = $bg_image_2;

				} else {

					$bg_image_src = wp_get_attachment_image_src($bg_image_2, 'full');

					
					if(!$parallax_bg_2){
						$style_2 .= 'background-image: url('. $bg_image_src[0]. '); ';

						$style_2 .= 'background-position: '. $bg_position_2 .'; ';
					}
					

					$bg_im_2 = $bg_image_src[0];

				}

				

				//for pattern bgs

				if(strtolower($bg_repeat_2) == 'repeat'){

					$style_2 .= 'background-repeat: '. strtolower($bg_repeat_2) .'; ';

					$etxra_class_2 = 'no-cover';

				} else {

					$style_2 .= 'background-repeat: '. strtolower($bg_repeat_2) .'; ';

					$etxra_class_2 = null;

				}

			}

			if(!empty($bg_color_2)) {
				$bg_color_var_2 = '';
				if($bg_color_2 == 'base'){
					$bg_color_2 = themeple_get_option('base_color');
				}else if($bg_color_2 == 'second')
					$bg_color_2 = themeple_get_option('second_color');

				
				$style_2 .= 'background-color: '. $bg_color_2.'; ';
				$bg_color_var_2 = $bg_color_2;
				

			}

			if(strtolower($parallax_bg_2) == 'true'){

				$parallax_class_2 = 'parallax_section';

			} else {

				$parallax_class_2 = '';

			}

			if($video_bg_2)

				$etxra_class_2 .= ' video_section '; 

			 

			$video_markup_2 = '';

			$overlay_markup_2 = ''; 

			$parallax_markup_2 = '';

			if($video_bg_2) {



				$video_markup_2 = '<div class="video-wrap"><video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0"> 

		                                                                        <source src="'.$video_webm_2.'" type="video/webm"> 

		                                                                        <source src="'.$video_mp4_2.'" type="video/mp4"> 

		                                                      

		                                                                        Video not supported </video></div>';

			

			} 



			if($overlay_2){
				if($overlay_color_2 == 'base')
					$overlay_color_2 = themeple_HexToRGB(themeple_get_option('base_color'));
				else if($overlay_color_2 == 'second')
					$overlay_color_2 = themeple_HexToRGB(themeple_get_option('second_color'));
				else
					$overlay_color_2 = themeple_HexToRGB($overlay_color);

				$overlay_markup_2 = '<div class="bg-overlay" style="background:rgba('.$overlay_color_2['r'].', '.$overlay_color_2['g'].', '.$overlay_color_2['b'].', '.$overlay_opacity_2.');z-index:'.$overlay_zindex_2.';"></div>';
				if($bg_color_var_2 == '')
					$bg_color_var_2 = 'rgba('.$overlay_color_2['r'].', '.$overlay_color_2['g'].', '.$overlay_color_2['b'].', 1)';
			}

			$animate_onoffset_2 = '';
			$animate_onoffset_c_2 = '';
			if($parallax_bg_2){

				$parallax_markup_2 = '<div class="parallax_bg"  style="background-image: url('.$bg_im_2.'); background-position: 50% 0px; background-attachment:fixed !important"></div>';
				$animate_onoffset_c_2 = 'animate_onoffset';
			}else
				$animate_onoffset_2 = 'animate_onoffset';


			$etxra_class .= ' with_second_section ';
	}

	echo'<div id="'.uniqid("fws_").'" class="wpb_row animate_onoffset  vc_row-fluid '.$transparency_class.' '.$animate_onoffset.' row-dynamic-el '. $main_class . $parallax_class . ' ' . $class . ' ' . $etxra_class.' " style="'.$style.'">';

	echo $triangle_top_html;
    echo $triangle_bottom_html;

	echo $transparency_markup;

    echo $parallax_markup;
    if($second_section == 'second_yes')
    	echo '<div class="first_section_over">';

    echo $video_markup;

	echo $overlay_markup;

    if($second_section == 'second_yes')
    	echo '</div>';

    if($second_section == 'second_yes'){
		echo '<div class="second_section_over '. $parallax_class_2 . ' ' . $etxra_class_2.' " style="'.$style_2.'">';
			echo $parallax_markup_2;
			echo $video_markup_2;
			echo $overlay_markup_2;
		echo '</div>';
	}


	if($type != 'full_width_content')

		$cl_class = 'container';

	else
 
		$cl_class = 'col span_12';

	
 
    echo '<div class="'.$cl_class.' '.$animate_onoffset_c.' '.strtolower($text_color).'">';
 
    	if($cl_class == 'container')
    		echo '<div class="section_clear">';
    	 

    	echo wpb_js_remove_wpautop($content);

    	if($cl_class == 'container')
    		echo '</div>';
    	
 
   	 echo '</div>';


 	echo '</div>';
    



?>