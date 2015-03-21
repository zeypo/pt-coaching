<?php



if(!function_exists('themeple_sc_column'))

{

	/**

	 * themeple_sc_column()

	 * 

	 * @param mixed $atts

	 * @param string $content

	 * @param string $shortcodename

	 * @return

	 */

	function themeple_sc_column($atts, $content = "", $shortcodename = "")

	{	

	    extract(shortcode_atts(array('nr' => ''), $atts));

	    $output = '';

        if($nr == 'first')

            $output .= '<div class="row-fluid">';

        $span = 12;

		if($shortcodename == 'one_third')

            $span = 4;

        else

        if($shortcodename == 'two_third')

            $span = 8;

        else

        if($shortcodename == 'one_fourth')

            $span = 3;

        else

        if($shortcodename == 'three_fourth')

            $span = 9;

        else

        if($shortcodename == 'one_half')

            $span = 6;

        else

        if($shortcodename == 'one_sixth')

            $span = 2;

        else

        if($shortcodename == 'five_sixth')

            $span = 10;

		$output .= '<div class="span'.$span.' sc-col">';

            $output .= do_shortcode($content);

        $output .= '</div>';

        if($nr == 'last')

            $output .= '</div>';

		return $output;

	}



	add_shortcode('one_third'	, 'themeple_sc_column');

	add_shortcode('two_third'	, 'themeple_sc_column');

	add_shortcode('one_fourth'	, 'themeple_sc_column');

	add_shortcode('three_fourth', 'themeple_sc_column');

	add_shortcode('one_half'	, 'themeple_sc_column');

	add_shortcode('one_sixth'	, 'themeple_sc_column');

	add_shortcode('two_sixth'	, 'themeple_sc_column');

	add_shortcode('three_sixth'	, 'themeple_sc_column');

	add_shortcode('four_sixth'	, 'themeple_sc_column');

    add_shortcode('five_sixth'	, 'themeple_sc_column');

}



if(!function_exists('themeple_sc_contentrow')){

    /**

     * themeple_sc_contentrow()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_contentrow($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('style' => '', 'marginbottom' => '40px'), $atts));

        $output = '<div class="row-fluid sc-col row-dynamic-el" style="margin-bottom:'.$marginbottom.';">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        if($style == 'border'){

            $output .= '<div class="divider_shortcodes row-fluid row-dynamic-el"></div>';

        }

        return $output;

    }

    add_shortcode('contentrow', 'themeple_sc_contentrow');

}

if(!function_exists('themeple_sc_noshortcode')){
 /**

     * themeple_sc_noshortcode()

     *  

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */
 function themeple_sc_noshortcode($atts, $content=null, $shortcodename =""){


        $output = '<div class="code">'.$content.'</div>';

        return $output;

    }

    add_shortcode('noshortcode', 'themeple_sc_noshortcode');


}

if(!function_exists('themeple_sc_leftalign')){
 /**

     * themeple_sc_noshortcode()

     *  

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */
 function themeple_sc_leftalign($atts, $content=null, $shortcodename =""){


        $output = '<span class="alignleft">'.$content.'</span>';

        return $output;

    }

    add_shortcode('leftalign', 'themeple_sc_leftalign');


}



if(!function_exists('themeple_sc_abbreviation')){

    /**

     * themeple_sc_abbreviation()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_abbreviation($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => ''), $atts));

        $output = '<abbr title="'.$title.'">'.do_shortcode($content).'</abbr>';

        return $output;

    }

    add_shortcode('abbreviation', 'themeple_sc_abbreviation');

}

if(!function_exists('themeple_sc_textbar')){


 /**

     * themeple_sc_textbar()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

function themeple_sc_textbar($atts, $content=null, $shortcodename =""){
	extract(shortcode_atts(array('title' => '', 'description'=>'', 'button_title'=>'', 'button_link'=>'' ), $atts));
	$output = '<div class="themeple_sc">';
	$output .=  '<div class="container">';    
       $output .= '<div class="row-fluid">';    
       $output .= '<div class="textbar-container">';     
       $output .= '<div class="textbar">';  
	$output .= '<h2>'.$title.'</h2>';         
	$output .= '<span>'.$description.'</span>';
	$output .= '<a href="'.$button_link.'" class="btn-system blue pull-right"><span>'.$button_title.'</span></a></div>';       
	$output .='</div></div></div></div>';
       return $output;
     }
	//add_shortcode('textbar', 'themeple_sc_textbar'); 
  }

if(!function_exists('themeple_sc_blockquote')){

    /**

     * themeple_sc_blockquote()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_blockquote($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('source' => '', 'background' => ''), $atts));

        if(!empty($background)){

            $bg = 'style="background-color: '.$background.'; border-top:none; border-right:none; border-bottom:none;"';
        }
        
        $output = '<div class="themeple_sc pull-left">';

        $output .='<div class="themeple_blockquote" '.$bg.'>';
        
        $output .= do_shortcode($content);

        $output .='<br /><span>'.$source.'</span>';
        
        $output .='</div></div>';  
        

        return $output;

    }

    add_shortcode('blockquote', 'themeple_sc_blockquote');

}

if(!function_exists('themeple_sc_header_title')){

    /**

     * themeple_sc_header_title()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_header_title($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'header_size'=> '', 'pagination_bool' => 'no'), $atts));

        $output = '<div class="themeple_sc">';
        $output .= '<div class="header">';
       
        switch ($header_size) {
            case 'h6':
                $output .= '<h6>'.$title.'</h6>';
                break;
            case 'h4':
                $output .= '<h4>'.$title.'</h4>';
                break;
            case 'h5':    
                $output .= '<h5>'.$title.'<h5>';
                break;
            case 'h3':
                $output .= '<h3>'.$title.'</h3>';
                break;

        }
        if($pagination_bool == 'yes')
                $output .= '<div class="pagination"><a href="#" class="prev"></a><a href="#" class="next"></a></div>';

        $output .= '</div></div>';

        return $output;

    }

    add_shortcode('header_title', 'themeple_sc_header_title');

}

if(!function_exists('themeple_sc_social_icons')){

    /**

     * themeple_sc_social_icons()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */


    function themeple_sc_social_icons($atts, $content=null, $shortcodename =""){

       extract(shortcode_atts(array('icon' => '', 'link'=>'' ), $atts));

       $output =  '<div class="themeple_sc">'; 
       $output .= '<ul class="social_icons">';
       $output .= '<a href="'.$link.'">'; 
       $output .= '<li class="moon-'.$icon.'">';
       $output .= '</li>';
       $output .= '</a>';
       $output .='</ul></div>';
       return $output;

    }

    add_shortcode( 'social_icons', 'themeple_sc_social_icons' );


}    

if(!function_exists('themeple_word_animation')){
   
    /**

     * themeple_word_animation()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */
    function themeple_word_animation($atts, $content=null, $shortcodename =""){

       $output = '<b class="word_animation"><span1>'.$content.'</span1></b>';

       return $output;
    }

    add_shortcode('wordanimation', 'themeple_word_animation');
    

}


if(!function_exists('themeple_sc_button')){

    /**

     * themeple_sc_button()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_button($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('icon' => '', 'type' => '', 'link' => '', 'onclick' => '', 'color' => '', 'size' => '', 'icon_color' => '', 'fontcolor'=> '', 'bordercolor'=>'', 'target'=>''), $atts));

        $classes = "";

        $background =   'background:'.$color;
        
        $border = 'border-color:'.$border_color.' !important;';

        $classes .= ' '.($size != 'default')?'btn-'.$size.' ':'';

        $classes .= ' '.($block_level == 'no')?'':'btn-block ';

        $classes .= ' '.($state == 'active')?'':'disabled ';

      
        

        $output = "";

        if($type == 'only_border'){

            $output .= '<a target="'.$target.'" href="'.$link.'" class="btn-system '.$size.' '.$type.'" style="border:1px solid '.$bordercolor.'">';

        }else

        if($type == 'gradient'){

        	$output .= '<a target="'.$target.'" href="'.$link.'" class="btn-system '.$size.' '.$type.'" style="border:1px solid '.$bordercolor.'">';
        }else

        if($type == 'normal'){

            $output .= '<a  target="'.$target.'" href="'.$link.'" class="btn-system normal '.$size.'" style="'.$background.'; border:1px solid '.$bordercolor.';">';  

        }else

        if($type == 'button'){

            $output .= '<button onclick="'.$onclick.'" class="btn-system '.$size.'">';

        }else

            $output .= '<input type="submit"  class="btn-system '.$size.'" />';

        

        

        

       $icon_class = "";

       $icon_class .= ' '.($icon != 'none')?$icon.' ':'';

       

       

        if(!empty($fontcolor)){

        $output .= '<i style="color:'.$icon_color.'" class="'.$icon_class.'"></i><span style="color:'.$fontcolor.'">'.do_shortcode($content).'</span>';

        }else{

        $output .= '<i class="'.$icon_class.'"></i><span>'.do_shortcode($content).'</span>';

        }

       if($type == 'gradient' || $type == 'only_border'){
       	 $output .= '</a>';
       	}

        if($type == 'normal'){

            $output .= '</a>';

            if($dropdown == 'yes'){

                $output .= '<a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>';

            }

        }else

        if($type == 'button'){

            $output .= '</button>';

            if($dropdown == 'yes'){

                $output .= '<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';

            }

        }

        

        

        

        return $output;

    }

    add_shortcode('button', 'themeple_sc_button');

}



if(!function_exists('themeple_sc_imagestyle')){

    /**

     * themeple_sc_imagestyle()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_imagestyle($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('style' => ''), $atts));

        $output = '<img src="'.do_shortcode($content).'" class="img-'.$style.'">';

        return $output;

    }

    add_shortcode('imagestyle', 'themeple_sc_imagestyle');

}

if(!function_exists('themeple_sc_navigation')){

    /**

     * themeple_sc_navigation()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_navigation($atts, $content=null, $shortcodename =""){

        $output = '<ul class="nav nav-list">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('navigation', 'themeple_sc_navigation');

}



if(!function_exists('themeple_sc_navigation_list')){

    /**

     * themeple_sc_navigation_list()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_navigation_list($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => ''), $atts));

        $output = '<li class="nav-header">';

        $output .= do_shortcode($title);

        $output .= do_shortcode($content);

        $output .= '</li>';

        return $output;

    }

    add_shortcode('navigation_list', 'themeple_sc_navigation_list');

}



if(!function_exists('themeple_sc_navigation_element')){

    /**

     * themeple_sc_navigation_element()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_navigation_element($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('link' => '', 'icon' => '', 'active' => ''), $atts));

        $active = ($active == 'yes')?'active':'';

        $icon_active = ($active == 'yes')?'icon-white':'';

        $output = '<li class="'.$active.'"><a href="'.$link.'">';

        if($icon != 'none'){

            $output .= '<i class="'.$icon.' '.$icon_active.'"></i> ';

        }

        $output .= do_shortcode($content);

        $output .= '</a></li>';

        return $output;

    }

    add_shortcode('navigation_element', 'themeple_sc_navigation_element');

}



if(!function_exists('themeple_sc_breadcrumb')){

    /**

     * themeple_sc_breadcrumb()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_breadcrumb($atts, $content=null, $shortcodename =""){

        $output = '<ul class="breadcrumb">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('breadcrumb', 'themeple_sc_breadcrumb');

}



if(!function_exists('themeple_sc_breadcrumb_element')){

    /**

     * themeple_sc_breadcrumb_element()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_breadcrumb_element($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('link' => '', 'active' => ''), $atts));

        if($active == 'yes'){

            $output = '<li class="active">';

            $output .= do_shortcode($content);

            $output .= '</li>';

        }else{

            $output = '<li><a href="'.$link.'">';

            $output .= do_shortcode($content);

            $output .= '</a><span class="divider">/</span></li>';

        }

        return $output;

    }

    add_shortcode('breadcrumb_element', 'themeple_sc_breadcrumb_element');

}



if(!function_exists('themeple_sc_label_badget')){

    /**

     * themeple_sc_label_badget()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_label_badget($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('style' => '', 'type' => ''), $atts));

        $style = ($style == 'default')?'':$style;

        

        $output = '<span class="'.$type.' '.$type.'-'.$style.'">'.do_shortcode($content).'</span>'; 

        return $output;

    }

    add_shortcode('label_badget', 'themeple_sc_label_badget');

}





if(!function_exists('themeple_sc_thumbnails')){

    /**

     * themeple_sc_thumbnails()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_thumbnails($atts, $content=null, $shortcodename =""){

        

        $output = '<ul class="thumbnails">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('thumbnails', 'themeple_sc_thumbnails');

}



if(!function_exists('themeple_sc_thumbnail')){

    /**

     * themeple_sc_thumbnail()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_thumbnail($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'desc' => '', 'size' => '3', 'link' => ''), $atts));

        $output = '<li class="span'.$size.'">';

        

            if($title != '' && $desc != ''){

                $output .= '<div class="thumbnail">';

                

                    $output .= '<img src="'.do_shortcode($content).'" alt="" />';

                    $output .= '<h1><a href="'.$link.'">'.$title.'</a></h1>';

                    $output .= '<p>'.$desc.'</p>';

                $output .= '</div>';

            }else{

                $output .= '<a href="'.$link.'" class="thumbnail"><img src="'.do_shortcode($content).'" alt="" /></a>';

            }

        

        $output .= '</li>';

        return $output;

    }

    add_shortcode('thumbnail', 'themeple_sc_thumbnail');

}



if(!function_exists('themeple_sc_alert')){

    /**

     * themeple_sc_alert()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_alert($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'style' => ''), $atts));

        $style = ($style == 'default')?'':$style;

        $output = '<div class="alert alert-'.$style.'">';

        $output .= '<a class="close" data-dismiss="alert" href="#">&times;</a>';

        $output .= '<strong>'.$title.'</strong> '.do_shortcode($content);

       

        $output .= '</div>';

        return $output;

    }

    add_shortcode('alert', 'themeple_sc_alert');

}



if(!function_exists('themeple_sc_progressbar')){

    /**

     * themeple_sc_progressbar()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_progressbar($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title'=>'', 'percentage' => '','striped' => '', 'type' => '', 'style' => '', 'animated' => '', 'success' => '', 'warning' => '', 'danger' => '', 'description'=> ''), $atts));

        

        $style = ($style == 'default')?'':' progress-'.$style;

        $animated = ($animated == 'yes')?' active':'';

        $striped = ($striped == 'yes')?' progress-striped':'';

        $output = '';

        

        if($type != 'default'){


            $output .= '<div class="progress '.$animated.' '.$striped.'">';

            $output .= '<div class="bar bar-success" style="width: '.$success.'%;"></div>';

            $output .= '<div class="bar bar-warning" style="width: '.$warning.'%;"></div>';

            $output .= '<div class="bar bar-danger" style="width: '.$danger.'%;"></div>';

            $output .= '</div>';

        }else{
            $output .= '<div class="skill animate_onoffset start_animation" data-percentage="'.$percentage.'" >';
            
             $new_color = themeple_colourBrightness(themeple_get_option('base_color'), ($percentage/100));

           

            $output .= ' <div class="prog" style="width:'.$percentage.'%; background:'.$new_color.';"><h6>'.$title.'</h6><span class="big_percentage">'.$percentage.'%</span></div>';

          
            $output .= '</div>';

        }
 
        

        

        return $output;

    }

    add_shortcode('progressbar', 'themeple_sc_progressbar');

}



if(!function_exists('themeple_sc_dropdown_container')){

    /**

     * themeple_sc_dropdown_container()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropdown_container($atts, $content=null, $shortcodename =""){

        $output = '<div class="btn-group">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('dropdown_container', 'themeple_sc_dropdown_container');

}



if(!function_exists('themeple_sc_dropdown')){

    /**

     * themeple_sc_dropdown()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropdown($atts, $content=null, $shortcodename =""){

        $output = '<ul class="dropdown-menu" role="menu">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('dropdown', 'themeple_sc_dropdown');

}



if(!function_exists('themeple_sc_sub_dropdown')){

    /**

     * themeple_sc_sub_dropdown()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_sub_dropdown($atts, $content=null, $shortcodename =""){

        $output = '<ul class="dropdown-menu">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('sub_dropdown', 'themeple_sc_sub_dropdown');

}



if(!function_exists('themeple_sc_dropdown_element')){

    /**

     * themeple_sc_dropdown_element()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropdown_element($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'submenu' => '', 'link' => '', 'icon' => ''), $atts));

        $icon = ($icon == 'none')?'':'<i class="'.$icon.'"></i> ';

        $el = '<a tabindex="-1" href="'.$link.'">'.$icon.$title.'</a>';

        $output = '<li class="'.(($submenu == 'yes')?'dropdown-submenu':'').'">';

            $output .= $el;

        $output .= do_shortcode($content);

        $output .= '</li>';

        return $output;

    }

    add_shortcode('dropdown_element', 'themeple_sc_dropdown_element');

}



if(!function_exists('themeple_sc_dropdown_subelement')){

    /**

     * themeple_sc_dropdown_subelement()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropdown_subelement($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'link' => '', 'icon' => ''), $atts));

        $icon = ($icon == 'none')?'':'<i class="'.$icon.'"></i> ';

        $el = '<a tabindex="-1" href="'.$link.'">'.$icon.$title.'</a>';

        $output = '<li>';

            $output .= $el;

        $output .= do_shortcode($content);

        $output .= '</li>';

        return $output;

    }

    add_shortcode('dropdown_subelement', 'themeple_sc_dropdown_subelement');

}

if(!function_exists('themeple_sc_tab_container')){

    /**

     * themeple_sc_tab_container()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tab_container($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('fade' => '', 'position' => '', 'style' => 'style_1'), $atts));

        $output = '<div class="tabbable tabs-'.$position.' '.$style.'" id"tabs'.rand(0,5000).'">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    /*add_shortcode('tab_container', 'themeple_sc_tab_container');*/

}



if(!function_exists('themeple_sc_nav_tabs')){

    /**

     * themeple_sc_nav_tabs()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_nav_tabs($atts, $content=null, $shortcodename =""){

        

        $output = '<ul class="nav nav-tabs" id="navtabs'.rand(0,5000).'">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

   /* add_shortcode('nav_tabs', 'themeple_sc_nav_tabs'); */

}



if(!function_exists('themeple_sc_tab_content_container')){

    /**

     * themeple_sc_tab_content_container()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tab_content_container($atts, $content=null, $shortcodename =""){

        

        $output = '<div class="tab-content">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

  /* add_shortcode('tab_content_container', 'themeple_sc_tab_content_container');*/

}

if(!function_exists('themeple_sc_tab_content')){

    /**

     * themeple_sc_tab_content()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tab_content($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('id' => '', 'first' => 'no'), $atts));

        $fade = "";

        $output = '<div class="tab-pane '.(($first == 'yes')?'active':'').' '.(($fade =='yes')?'fade':'').'" id="tab'.$id.'">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

 /*   add_shortcode('tab_content', 'themeple_sc_tab_content'); */

}

if(!function_exists('themeple_sc_tab')){

    /**

     * themeple_sc_tab()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tab($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('id' => '', 'title' => '', 'first' => 'no'), $atts));

        $output = '<li class="'.(($first == 'yes')?'active':'').'"><a href="#tab'.$id.'" data-toggle="tab">'.$title.'</a></li>';

        return $output;

    }

  /*  add_shortcode('tab', 'themeple_sc_tab'); */

}





if(!function_exists('themeple_sc_modal')){

    /**

     * themeple_sc_modal()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_modal($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'button_text' => ''), $atts));

        $output =  '<a href="#'.trim(str_replace(" ", '_', $title)).'" role="button" class="btn" data-toggle="modal">'.$button_text.'</a>';

        $output .= '<div class="modal hide fade" id="'.trim(str_replace(" ", '_', $title)).'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

        $output .= '<div class="modal-header">';

        

        $output .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';

        $output .= '<h1>'.$title.'</h1>';

        

        $output .= '</div>';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('modal', 'themeple_sc_modal');

}



if(!function_exists('themeple_sc_modal_content')){

    /**

     * themeple_sc_modal_content()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_modal_content($atts, $content=null, $shortcodename =""){

        

        $output = '<div class="modal-body">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('modal_content', 'themeple_sc_modal_content');

}

if(!function_exists('themeple_sc_modal_footer')){

    /**

     * themeple_sc_modal_footer()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_modal_footer($atts, $content=null, $shortcodename =""){

        

        $output = '<div class="modal-footer">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('modal_footer', 'themeple_sc_modal_footer');

}

if(!function_exists('themeple_sc_tooltip')){

    /**

     * themeple_sc_tooltip()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tooltip($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => ''), $atts));

        $output = '<a href="#" rel="tooltip" title="'.$title.'">'.do_shortcode($content).'</a>';

        return $output;

    }

    add_shortcode('tooltip', 'themeple_sc_tooltip');

}



if(!function_exists('themeple_sc_popover')){

    /**

     * themeple_sc_popover()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_popover($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'style' => '', 'size' => '', 'type' => '', 'button_text' => ''), $atts));

        $classes = "btn ";

        $classes .= ' '.($style != 'default')?'btn-'.$style.' ':'';

        $classes .= ' '.($size != 'default')?'btn-'.$size.' ':'';

        $output = '';

        if($type == 'anchor'){

            $output .= '<a href="#" class="'.$classes.'"  rel="popover" data-content="'.do_shortcode($content).'" data-original-title="'.$title.'">'.$button_text.'</a>';

        }else

        if($type == 'button')

            $output .= '<button class="'.$classes.'" rel="popover" data-content="'.do_shortcode($content).'" data-original-title="'.$title.'">'.$button_text.'</button>';

        return $output;

    }

    add_shortcode('popover', 'themeple_sc_popover');

}

global $toggles_i;

$toggles_i = 0;

if(!function_exists('themeple_sc_toggle_container')){

    /**

     * themeple_sc_toggle_container()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_toggle_container($atts, $content=null, $shortcodename =""){

        global $toggles_i;

        extract(shortcode_atts(array('type' => '', 'style' => 'style_1'), $atts));

        $toggles_i++;

        $output = '<div class="accordion '.$type.' '.$style.'" id="accordion'.$toggles_i.'">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('toggle_container', 'themeple_sc_toggle_container');

}



if(!function_exists('themeple_sc_toggle')){

    /**

     * themeple_sc_toggle()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_toggle($atts, $content=null, $shortcodename =""){

        global $toggles_i;

        extract(shortcode_atts(array('title' => '', 'open' => ''), $atts));
        $in_head = '';
        if(!empty($open)){
              if($open == 'yes')
                $open = 'in';
               $in_head = 'in_head';
        }  
        $output = '<div class="accordion-group">';

            $output .= '<div class="accordion-heading '.$in_head.'">';

            $id = rand(0, 50000);

                $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$toggles_i.'" href="#toggle'.$id.'">'.$title.'</a>';

            $output .= '</div>';

            $output .= '<div id="toggle'.$id.'" class="accordion-body collapse '.$open.'">';

                $output .= '<div class="accordion-inner">';

                    $output .= do_shortcode($content);

                $output .= '</div>';

            $output .= '</div>';

        $output .= '</div>';

        return $output;

    }

    add_shortcode('toggle', 'themeple_sc_toggle');

}



if(!function_exists('themeple_sc_border_divider_fit_page_content')){

    /**

     * themeple_sc_border_divider_fit_page_content()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_border_divider_fit_page_content($atts, $content=null, $shortcodename =""){

        $output = '<div class="divider row-fluid"></div>';

        return $output;

    }

    add_shortcode('border_divider_fit_page_content', 'themeple_sc_border_divider_fit_page_content');

}



if(!function_exists('themeple_sc_border_divider_fit_page_layout')){

    /**

     * themeple_sc_border_divider_fit_page_layout()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_border_divider_fit_page_layout($atts, $content=null, $shortcodename =""){

        $output = '<div class="divider_ row-fluid"></div>';

        return $output;

    }

    add_shortcode('border_divider_fit_page_layout', 'themeple_sc_border_divider_fit_page_layout');

}



if(!function_exists('themeple_sc_whitespace')){

    /**

     * themeple_sc_whitespace()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_whitespace($atts, $content=null, $shortcodename =""){

        $output = '<div class="row-fluid"></div>';

        return $output;

    }

    add_shortcode('whitespace', 'themeple_sc_whitespace');

}



/*if(!function_exists('themeple_sc_contact_form')){

    /**

     * themeple_sc_contact_form()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

   /* function themeple_sc_contact_form($atts, $content = null, $shortcodename= ""){

        extract(shortcode_atts(array('heading' => '', 'success' => '', 'submit_text' => ''), $atts));

        

        $attr = array(

    		"success" => '<p>'.$success.'</p>',

    		"submit"  => $submit_text,

            "submit_class" => "btn-system blue",

            "form_class" => "contact_form",

    		"action"  => get_permalink(),

    		"myemail" => themeple_get_option('email'),

    		"myblogname" => get_option('blogname'),

    		"autoresponder" => themeple_get_option('autoresponder'),

    		"autoresponder_subject" => themeple_get_option('autoresponder_subject'),

    		"autoresponder_email" => themeple_get_option('email')

	    );

        $custom_elements = themeple_get_option('contact_elements');

	

    

    	$elements = array();

        if(is_array($custom_elements))

    	{

    		foreach($custom_elements as $new_element)

    		{

    			$elements[strtolower( $new_element['label'] ) ] = $new_element;

    		}

    	}

        $contact_form = new themeple_form($attr);

    	$contact_form->create_elements($elements);

    	return '<div class="row-fluid">'.$contact_form->display_form().'</div>';

    }

    add_shortcode('contact_form', 'themeple_sc_contact_form');

} */









if(!function_exists('themeple_sc_contact_form_slider')){

    /**

     * themeple_sc_contact_form()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_contact_form_slider($atts, $content = null, $shortcodename= ""){

        extract(shortcode_atts(array('heading' => '', 'success' => '', 'submit_text' => ''), $atts));

        

        $attr = array(

            "success" => '<p>Your message has been sent</p>',

            "submit"  => $submit_text,

            "form_class" => "slider_form",

            "submit_class" => "more-large",

            "action"  => get_permalink(),

            "myemail" => themeple_get_option('email'),

            "myblogname" => get_option('blogname'),

            "autoresponder" => themeple_get_option('autoresponder'),

            "autoresponder_subject" => themeple_get_option('autoresponder_subject'),

            "autoresponder_email" => themeple_get_option('email')

        );

        $custom_elements = themeple_get_option('contact_elements');

    

    

        $elements = array();

        if(is_array($custom_elements))

        {

            $i = 0;

            foreach($custom_elements as $new_element)

            {

                $i++;

                if($new_element['type'] != 'textarea'){

                    $elements[strtolower( $new_element['label'] ) ] = $new_element;

                    if($i > 1)

                        $elements[strtolower( $new_element['label'] ) ]['class'] = 'half';

                    if($i == count($custom_elements))

                        $elements[strtolower( $new_element['label'] ) ]['class'] = '';

                    if($i % 2 != 0 && $i == count($custom_elements))

                       $elements[strtolower( $new_element['label'] ) ]['class'] = 'half';

                }



            }

        }

        $contact_form = new themeple_form($attr);

        $contact_form->create_elements($elements);

        return '<div class="row">'.$contact_form->display_form().'</div>';

    }

    add_shortcode('contact_form_slider', 'themeple_sc_contact_form_slider');

}











/*if(!function_exists('themeple_sc_google_map')){

    /**

     * themeple_sc_google_map()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

   /* function themeple_sc_google_map($atts, $content = null, $shortcodename=""){

        

        return '<div class="row-fluid row-google-map"><iframe class="googlemap" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.do_shortcode($content).'&amp;output=embed"></iframe><span class="map_shadow"></span></div>';

    }

    add_shortcode('google_map', 'themeple_sc_google_map');

}*/



if(!function_exists('themeple_sc_h1')){

    /**

     * themeple_sc_h1()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h1($atts, $content = null, $shortcodename=""){

        return '<h1 class="shortcode_h1">'.do_shortcode($content).'</h1>';

    }

    add_shortcode('h1_heading', 'themeple_sc_h1');

}

if(!function_exists('themeple_sc_h2')){

    /**

     * themeple_sc_h2()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h2($atts, $content = null, $shortcodename=""){

        return '<h2 class="shortcode_h2">'.do_shortcode($content).'</h2>';

    }

    add_shortcode('h2_heading', 'themeple_sc_h2');

}

if(!function_exists('themeple_sc_h3')){

    /**

     * themeple_sc_h3()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h3($atts, $content = null, $shortcodename=""){

        return '<h3 class="shortcode_h3">'.do_shortcode($content).'</h3>';

    }

    add_shortcode('h3_heading', 'themeple_sc_h3');

}

if(!function_exists('themeple_sc_h4')){

    /**

     * themeple_sc_h4()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h4($atts, $content = null, $shortcodename=""){

        return '<h4 class="shortcode_h4">'.do_shortcode($content).'</h4>';

    }

    add_shortcode('h4_heading', 'themeple_sc_h4');

}

if(!function_exists('themeple_sc_h5')){

    /**

     * themeple_sc_h5()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h5($atts, $content = null, $shortcodename=""){

        return '<h4 class="shortcode_h5">'.do_shortcode($content).'</h5>';

    }

    add_shortcode('h5_heading', 'themeple_sc_h5');

}

if(!function_exists('themeple_sc_h6')){

    /**

     * themeple_sc_h6()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h6($atts, $content = null, $shortcodename=""){

        return '<h6 class="shortcode_h6">'.do_shortcode($content).'</h6>';

    }

    add_shortcode('h6_heading', 'themeple_sc_h6');

}
if(!function_exists('themeple_sc_dropcast')){

    /**

     * themeple_sc_dropcast()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropcast($atts, $content = null, $shortcodename=""){
         extract(shortcode_atts(array('form' => '', 'color' => '', 'fontcolor' => ''), $atts));

        return '<span class="dropcast '.$form.'" style="background:'.$color.'; color:'.$fontcolor.'!important">'.do_shortcode($content).'</span>';

    }

    add_shortcode('dropcast', 'themeple_sc_dropcast');

}



if(!function_exists('themeple_sc_full_image')){

   

    function themeple_sc_full_image($atts, $content = null, $shortcodename=""){

        return '<img src="'.do_shortcode($content).'" class="full_width_image" alt="" />';

    }

    add_shortcode('full_image', 'themeple_sc_full_image');

}















if(!function_exists('themeple_player_audio')){

    /**

     * themeple_palyer_audio()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_player_audio($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array('title' => '', 'link' => '', 'audio_type'=>''), $atts));

            $output.='<audio id="player2" src="'.$link.'" type="audio/'.$audio_type.'" controls="controls" style="width:100% !important">';       

            $output.='</audio>';

            return $output;   

    }

    add_shortcode('player_audio', 'themeple_player_audio');

}



if(!function_exists('themeple_services_list')){

    

    function themeple_services_list($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array(), $atts));

            $output ='<ul class="services_list themeple_sc">';

            $output .= do_shortcode($content);       

            $output .= '</ul>' ; 

            return $output;   

    }

    add_shortcode('services_list', 'themeple_services_list');

}



if(!function_exists('themeple_service_element')){

    

    function themeple_service_element($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array("title" => "", 'link' => '', 'icon'=> '', 'icon_color' => ''), $atts));

            $output .= '<ul class="themeple_sc_services_element">';
            $output .= '<li><i class="'.$icon.' '.(($icon_color === 'white')?' icon-white':'').'"></i> <a href="'.$link.'">'.$title.'</a></li>';  
            $output .= '</ul>';
            return $output;   

    }

    add_shortcode('service_element', 'themeple_service_element');

}
 

if(!function_exists('themeple_lightbox')){

    

    function themeple_lightbox($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array("image_link" => "", 'video' => ''), $atts));

            $output = '';

            if($video != ''){

                    $output .= '<a class="lightbox-media" href="'.$video.'">';

            }else{

                    $output .= '<a class="lightbox-gallery" href="'.$image_link.'" title="">';

            }

            $output .= '<div class="visual lightbox">';

                $output .= '<img src="'.$image_link.'" />';
                $output .= '<span class="click_icon"></span>';     

            $output .='</div></a>';

            return $output;   

    }

    add_shortcode('lightbox', 'themeple_lightbox');

}







if(!function_exists('themeple_sc_price_1')){

    function themeple_sc_price_1($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array( 'type' => '', 'header_bool' => '', 'header_title' => '', 'header_money' => '', 'period'=>'', 'header_small' => '', 'footer_bool' => '', 'footer_button_text' => '', 'footer_link' => '', 'title_bg'=>'#2c2c2c', 'price_bg'=>'#3a3a3a' ), $atts));



        $output = '<div class="price_1_col '.$type.'">';

        $output .= '<div class="header">';

        if($header_bool == 'yes'){


            $output .= '<div class="title" style="background:'.$title_bg.';"><h2>'.$header_title.'</h2></div>';
          
            $output .= '<div class="price" style="background:'.$price_bg.'"><h1>'.$header_money.'</h1></div>';

            $output .= '<div class="period" style="background:'.$price_bg.'">'.$period.'</div>';

        }

        $output .= '</div>';

        $margin = "";
        
       if($header_bool == 'no'){
        $margin = "margin-top:160px;";
       }

        $output .= '<ul style="'.$margin.'">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

      if($footer_bool == 'yes'){

        $output .= '<div class="footer">';

       

            $output .= '<a href="'.$footer_link.'" class="btn-system default only_border" style="border:2px solid "><span>'.$footer_button_text.'</span></a>';

      

        $output .= '</div>';
    }







        $output .= '</div>';





        return $output;

    }

    add_shortcode('price_table_1', 'themeple_sc_price_1');

}







if(!function_exists('themeple_sc_price_1_row')){

    function themeple_sc_price_1_row($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array( 'type' => '' ), $atts));

        

        $output = '<li>';

        if($type == 'Tick')

            $output .= '<span class="moon-checkmark"></span>';

        if($type == 'Not')

            $output .= '<span class="moon-close"></span>';

        

        $output .= do_shortcode($content);

        $output .= '</li>';

        return $output;

    }

    add_shortcode('price_table_1_row', 'themeple_sc_price_1_row');

}



if(!function_exists('themeple_sc_price_table_1_container')){

    function themeple_sc_price_table_1_container($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array( 'col' => '', 'type' => '' ), $atts));

        

        $output = '<div class="price_container col-'.$col.' '.$type.'">';

            $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('price_table_1_container', 'themeple_sc_price_table_1_container');

}

if(!function_exists('themeple_sc_testimonials')){

    function themeple_sc_testimonials($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array('cat' => '' ), $atts));
   


        $query_post = array('posts_per_page'=> 999, 'post_type'=> 'testimonial', 'taxonomy' => 'testimonial_entries', 'testimonial_entries' => $cat);

        
        $output = '<div id="testimonials">';
               $loop = new WP_Query($query_post);
                         if($loop->have_posts()){
                            while($loop->have_posts()){
                                $loop->the_post();                                    
                                            
       
                $output .='<div class="testimon">' ;

                $output .='<p>'.get_the_content().'</p>';

                $output .= '<span class="arrow"></span>';

                $output .= '<div class="user-testimonial">'.get_the_title().'</div>';  

                 $output .='</div>';


        

       }

     }

     wp_reset_postdata();

     $output .= '</div>';
    return $output;
  }
    
    add_shortcode('testimonials', 'themeple_sc_testimonials');

}

if(!function_exists('themeple_sc_recent_portfolio')){

    function themeple_sc_recent_portfolio($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array( ), $atts));
       
          $output ='<div class="pagination"><a href="" class="prev" title="Previous"></a><a href="" class="next" title="Next"></a></div>';

         $output .='<div class="recent_sc_portfolio">';
        
          
                $posts = get_posts( 'posts_per_page=18&post_type=portfolio');
                    if($posts){
                     foreach($posts as $post){
    
   
                            $id = $post->ID;
                         
                           $output .='<div class="portfolio_sc_item">' ;

                           $output .='<a href="'.get_permalink($id).'"><img src="'.themeple_image_by_id(get_post_thumbnail_id($id),  'recent_sc_portfolio' , 'url').'" alt=""></a>';

                           $output .='</div>';
                          }  

              

                    }
     
     
     $output .= '</div>';
    
     return $output;


  }
    
   /*  add_shortcode('recent_portfolio', 'themeple_sc_recent_portfolio'); */

} 

if(!function_exists('themeple_sc_lists')){

    function themeple_sc_lists($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('type' => ''), $atts));
        
         $output ='<li class="'.$type.'">'.do_shortcode($content).'</li>';
     
         return $output;

    }
    
     add_shortcode('lists', 'themeple_sc_lists');

} 
if(!function_exists('themeple_sc_highlights')){

    function themeple_sc_highlights($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('color' => '', 'color_s' => '', 'font_color' => '', 'fcolor_bool'=>'' ), $atts));
         if(!empty($color)){
             $base_color = $color;
             $second_color = $color_s;
             
         }else{
             $base_color = themeple_get_option('base_color');
            
         }
         
	  if(isset($_COOKIE['themeple_skin'])){

		include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

		if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){
			$base_color = $predefined[$_COOKIE['themeple_skin']]['base_color']; 
		}
	  }
       if($fcolor_bool == 'yes'){
           $output .=  '<span class="highlights" style="color: '.$base_color.'; font-weight:600; font-size:inherit;">'.$content.'</span>';       
       }elseif(!empty($second_color)){
            $output ='<span class="highlights"  style="color:'.$font_color.'; background: -webkit-linear-gradient(top, '.$base_color.' 0%, '.$second_color.' 100%);
       
            background: -o-linear-gradient(top, '.$base_color.' 0%, '.$second_color.' 100%);
            background: -ms-linear-gradient(top, '.$base_color.' 0%, '.$second_color.');
            background: linear-gradient(to bottom,'.$base_color.' 0%, '.$second_color.');
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$base_color.', endColorstr='.$second_color.',GradientType=0 );; font-weight:500; font-size:inherit;">'.do_shortcode($content).'</span>';
     		
            }elseif($fcolor_bool == 'no'){

            $output =  '<span style="color: '.$font_color.'; background:'.$base_color.'; font-weight:500; font-size:inherit; padding-top:10px; padding-bottom:10px;">'.do_shortcode($content).'</span>';        

            }


         return $output;

    }
    
     add_shortcode('highlights', 'themeple_sc_highlights');

} 
if(!function_exists('themeple_simple_table')){
    function themeple_simple_table( $atts ) {
       extract( shortcode_atts( array('cols' => 'none', 'data' => 'none', 'color'=>'', 'font_color' => '' ), $atts ) );
    if(empty($color))
        $color='#f0f0f0';
    if(empty($font_color)) 
       $font_color = '#666666';
    $cols = explode(',',$cols);
    $data = explode(',',$data);
    $total = count($cols);
    $output='<div class="themeple_sc">';;
    $output .= '<div class="border-table">';
    $output .= '<table class="table table-bordered"><tr class="th">';
    foreach($cols as $col):
        $output .= '<td style="background:'.$color.'; color:'.$font_color.'">'.$col.'</td>';
    endforeach;
    $output .= '</tr><tr>';
    $counter = 1;
    foreach($data as $datum):
        $output .= '<td>'.$datum.'</td>';
        if($counter%$total==0):
            $output .= '</tr>';
        endif;
        $counter++;
    endforeach;
        $output .= '</table></div></div>';
    return $output;
}
add_shortcode( 'simple_table', 'themeple_simple_table' );
}

if(!function_exists('themeple_icon')){
    function themeple_icon($atts, $content = null, $shortcodename=""){
		
        extract( shortcode_atts( array('size' => '', 'color' => '', 'link'=> ''), $atts ) );

        if($size != '' || $color != '' && $link != '' ){
        
      return '<a href="'.$link.'"><i style="font-size:'.$size.'; color:'.$color.'" class="'.do_shortcode( $content ).'"></i></a>';

	}else{

      return '<i class="'.do_shortcode( $content ).'"></i>';

	}
    }

    add_shortcode( 'icon', 'themeple_icon' );

}

if(!function_exists('themeple_media')){
    function themeple_media($atts, $content = null, $shortcodename=""){
	 global $wp_embed;
	 $video = $wp_embed->run_shortcode("[embed]".trim($content)."[/embed]");
        return $video;

    }

    add_shortcode( 'sc_media', 'themeple_media' );

}

if(!function_exists('chart_shortcode')){
function chart_shortcode( $atts ) {
    extract(shortcode_atts(array(
        'data' => '',
        'colors' => '',
        'size' => '400x200',
        'bg' => 'ffffff',
        'title' => '',
        'labels' => '',
        'advanced' => '',
        'type' => 'pie'
    ), $atts));
    $string = '';
    switch ($type) {
        case 'line' :
            $charttype = 'lc'; break;
        case 'xyline' :
            $charttype = 'lxy'; break;
        case 'sparkline' :
            $charttype = 'ls'; break;
        case 'meter' :
            $charttype = 'gom'; break;
        case 'scatter' :
            $charttype = 's'; break;
        case 'venn' :
            $charttype = 'v'; break;
        case 'pie' :
            $charttype = 'p3'; break;
        case 'pie2d' :
            $charttype = 'p'; break;
        default :
            $charttype = $type;
        break;
    }
 
    if ($title) $string .= '&chtt='.$title.'';
    if ($labels) $string .= '&chl='.$labels.'';
    if ($colors) $string .= '&chco='.$colors.'';
    $string .= '&chs='.$size.'';
    $string .= '&chd=t:'.$data.'';
    $string .= '&chf='.$bg.'';
 
    return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$charttype.''.$string.$advanced.'" alt="'.$title.'" />';
}
add_shortcode('chart', 'chart_shortcode');
}

if(!function_exists('themeple_list')){
    function themeple_list( $atts, $content = null, $shortcodename="" ) {
        extract( shortcode_atts( array('style' => 'check', 'color' => 'default'), $atts ) ); 
        if($style == 'number')
            $output = '<ol class="default_list '.$color.' '.$style.'" >';
        else
            $output  = '<ul class="default_list '.$color.' '.$style.'"  >';
            
        $output .= do_shortcode($content);
        if($style == 'number')
            $output .= '</ol>';
        else
            $output .= '</ul>';
        return $output;
    }
    
    add_shortcode( 'list', 'themeple_list' );
}

if(!function_exists('themeple_list_li')){
    function themeple_list_li( $atts, $content = null, $shortcodename="" ) {
        extract( shortcode_atts( array('icon' => ''), $atts ) ); 
        $output = '<li>';
            if(isset($icon) && !empty($icon))
                $output .= '<i class="'.$icon.'"></i>';
            $output .= '<span>'.$content.'</span>';
        $output .= '</li>';
        return $output;
    }
    
    add_shortcode( 'list_li', 'themeple_list_li' );
}

if(!function_exists('themeple_dynamic_shortcode')){
    function themeple_dynamic_shortcode( $atts, $content = null, $shortcodename="" ) {
	
	 $genDynamic = new GenerateDynamicTemplate(false);

     if(isset($atts['pass_dynamic']) && !empty($atts['pass_dynamic'])){
        $keyy = $atts['pass_dynamic'];
        $values = $atts[$keyy];
        $a = array();
        $b = array();
        if(strpos($values, ';') === FALSE)
            $a[0] = $values;
            
        else{
            $a = explode(";", $values);
        }

       
            for($i = 0; $i < count($a); $i++){
                $ex = array();
                if(strpos($a[$i], ',') === FALSE){
                   $ex[0] = $a[$i];
                   
                }else{
                   
                     $ex = explode(',', $a[$i]); 
                }
                
                for($u = 0; $u < count($ex); $u++){
                        $another = explode(':', $ex[$u] );
                        $key = $another[0];
                        $b[$i][$key] = $another[1];
                }
            }
        
        $atts[$keyy] = $b;
        
     }

     $element['saved'][0] = $atts;
	 return $genDynamic->$atts['element']($element);
    }
    
    add_shortcode( 'dynamic', 'themeple_dynamic_shortcode' );
}

if(!function_exists('themeple_sc_highlights')){

    function themeple_sc_highlights($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('color' => '' ), $atts));
         if(!empty($color)){ 
            $output ='<span style="color:#'.$color.'; font-weight:600;font-size:inherit !important;">'.do_shortcode($content).'</span>';
         }else{
	     $base_color = themeple_get_option('base_color');
         
	  if(isset($_COOKIE['themeple_skin'])){

		include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

		if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){
			$base_color = $predefined[$_COOKIE['themeple_skin']]['base_color'];
		}
	  }

            $output ='<span style="color:'.$base_color.';  font-weight:500;font-size:inherit !important;">'.do_shortcode($content).'</span>';
         }
         return $output;

    }
    
     add_shortcode('highlights', 'themeple_sc_highlights');

} 
if(!function_exists('themeple_sc_custom_button')){

    function themeple_sc_custom_button($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('font_color' => '#fff', 'link' => '#', 'background' => themeple_get_option('base_color'), 'padding' => '12px 31px', 'box_shadow_color' => themeple_get_option('second_color') , 'font_size' => '14px', 'float' => 'left' ), $atts));
         $id = rand(0,100);
	   $output = '<p class="perspective"><a class="custom_btn" id="btn_'.$id.'" style="
				padding: '.$padding.';
				background: '.$background.';
				
				font-weight: bold;
				color: '.$font_color.';
				font-size: '.$font_size.'; 
			       float:'.$float.';" 
			   href="'.$link.'">'.$content.'</a></p><style>#btn_'.$id.':after{background:'.$box_shadow_color.'}</style>';
         return $output;

    }
    
     add_shortcode('custom_button', 'themeple_sc_custom_button');

} 


if(!function_exists('themeple_sc_little_icon')){

    function themeple_sc_little_icon($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('icon' => ''), $atts));
        
         $output = '<span class="little_icon">';
         if(!empty($icon))
            $output .= '<i class="moon-'.$icon.'"></i>';

         $output .= '<span class="text">'.do_shortcode($content).'</span>';
         $output .= '</span>';
         return $output;

    }
    
     add_shortcode('little_icon', 'themeple_sc_little_icon');

} 

if(!function_exists('themeple_list_simple')){
    function themeple_list_simple( $atts, $content = null, $shortcodename="" ) {
        extract( shortcode_atts( array(), $atts ) ); 
        $output  = '<ul class="list_simple">';
            $output .= do_shortcode($content);
        $output .= '</ul>';
        return $output;
    }
    
    add_shortcode( 'list_simple', 'themeple_list_simple' );
}

if(!function_exists('themeple_footer_logo')){
    function themeple_footer_logo( $atts, $content = null, $shortcodename="" ) {
        extract( shortcode_atts( array(), $atts ) ); 
        $footer_logo = themeple_get_option('footer_logo');
        if(isset($_COOKIE['themeple_skin']) && $_COOKIE['themeple_skin'] != ''){
            $footer_logo = THEMEPLE_BASE_URL.'img/skins/'.$_COOKIE['themeple_skin'].'/footer_logo.png';
        }
        $output  = '<img src="'.$footer_logo.'" class="footer_logo" />';
        return $output;
    }
    
    add_shortcode( 'footer_logo', 'themeple_footer_logo' );
}


if(!function_exists('themeple_list_simple_li')){

    function themeple_list_simple_li($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('title' => '', 'desc' => '', 'social' => 'no'), $atts));
        
         $output = '<li class="">';
         $output .= '<span class="title">'.$title.'</span>';

         if(!empty($desc))
            $output .= '<span class="desc">'.$desc.'</span>';
         if($social == 'yes'):

                $social_icons = themeple_get_option('social_icons');
                $output .= '<ul class="social_icons">';
                    foreach($social_icons as $icon):



                        $output .= '<li class="'.$icon['social'].'"><a href="'.$icon['link'].'"><i class="moon-'.$icon['social'].'"></i></a></li>';



                    endforeach;



                $output .= '</ul>';

         endif;
         $output .= '</span>';
         return $output;

    }
    
     add_shortcode('list_simple_li', 'themeple_list_simple_li');

} 

if(!function_exists('themeple_data_visualization')){

    function themeple_data_visualization($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('icon' => '', 'big' => '', 'small' => '', 'size' => 'big'), $atts));
         $output = '<div class="data_visualization '.$size.'">';
            $output .= '<i class="'.$icon.'"></i>';
            $output .= '<span class="text"><span class="big">'.$big.'</span><span class="small">'.$small.'</span></span>';
         $output .= '</div>';
         return $output;

    }
    
     add_shortcode('data_visualization', 'themeple_data_visualization');

} 

/*if(!function_exists('themeple_counter')){ 

    function themeple_counter($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('number' => 50, 'text' => 'Default', 'speed' => 2000, 'color'=>'', 'prepend' => '', 'postpend' => ''), $atts));
         $color_timer = '#555';
         $color_text = '#555';
         if($color == 'base'){
            $base_color = themeple_get_option('base_color');
         
            if(isset($_COOKIE['themeple_skin'])){

                include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

                if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){
                    $base_color = $predefined[$_COOKIE['themeple_skin']]['base_color'];
                }
            }
            $color_timer = $base_color;
         }else{
            $color_timer = $color;
            $color_text = $color;
         }
         $output = '<div class="count_to span3 animate_onoffset style_1"  >';
            $output .= '<span class="timer_span"><span style="color:'.$color_timer.'; '.$line_height.'">'.$prepend.'</span><span style="color:'.$color_timer.'; '.$line_height.'" class="timer" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'"></span><span style="color:'.$color_timer.'; '.$line_height.'">'.$postpend.'</span></span>';
            $output .= '<span style="color:'.$color_text.'" class="text">'.$text.'</span>';
         $output .= '</div>';
         return $output;

    }
    
     add_shortcode('counter', 'themeple_counter');

} */


if(!function_exists('themeple_font_customizer')){

    function themeple_font_customizer($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('size' => '50px', 'font_weight' => '', 'color'=>'', 'header' => 'yes', 'line_height'=>''), $atts));
         if($header == 'yes'){
           $output = '<h1 style="font-size:'.$size.'; font-weight:'.$font_weight.'; color:'.$color.'; line-height:'.$line_height.'; ">'.$content.'</h1>';
         }else{
        
         $output = '<span style="font-size:'.$size.'; font-weight:'.$font_weight.'; color:'.$color.'; line-height:'.$line_height.';">'.$content.'</span>';
         
         } 

         return $output;

    }
    
     add_shortcode('font_customizer', 'themeple_font_customizer');

} 

if(!function_exists('themeple_text_align')){

  function themeple_text_align($atts, $content = null, $shortcodename=""){

    extract(shortcode_atts(array('align' => 'center'), $atts));

   
    $output = '<div style="text-align:'.$align.'">'.do_shortcode($content).'</div>';

    return $output;

  }
  add_shortcode('text_align', 'themeple_text_align');

}

if(!function_exists('themeple_carousel')){

    function themeple_carousel($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array(), $atts));
         $output = '<div class="carousel_shortcode row">';
            $output .= do_shortcode($content);
         $output .= '</div>';
         return $output;

    }
    
     add_shortcode('carousel', 'themeple_carousel');

} 



?>