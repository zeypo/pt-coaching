<?php

	preg_match_all('/\[creative_tab(.*?)\]/', $content, $matches );


	//preg_match_all( '/creative_tab title="([^\"]+)"(\sicon_number\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
	$tab_titles = array();
	//var_dump($matches);

	if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
	$output = '<div class="wpb_content_element">';
        if(count($tab_titles) > 0){
            $output .= '<div class="creative_tabs">';
            $output .= '<ul class="navigation">';
            $i = 0;

            foreach($tab_titles as $tab):
            
                preg_match('~id\s*=\s*("|\')(?<id>.*?)\1\s*~i', $tab, $m);            	
            	$id = isset($m['id']) ? $m['id']:'';

                preg_match('~title\s*=\s*("|\')(?<title>.*?)\1\s*~i', $tab, $m);            	
            	$title = isset($m['title']) ? $m['title']:'';
            

            	preg_match('~icon_number\s*=\s*("|\')(?<icon_number>.*?)\1\s*~i', $tab, $m);            	
            	$icon_number = isset($m['icon_number']) ? $m['icon_number']:'';
            

            	preg_match('~icon\s*=\s*("|\')(?<icon>.*?)\1\s*~i', $tab, $m);            	
            	$icon = isset($m['icon']) ? $m['icon']:'';
            

            	preg_match('~\s+number\s*=\s*("|\')(?<number>.*?)\1\s*~i', $tab, $m);            	
            	$number = isset($m['number']) ? $m['number']:'';
            	


			    $i++;
			    $active = '';
			    if($id == 1)
			    	$active = 'active';
			  
			        $output .= '<li class="'.$active.'" data-id="t'.$id.'">';
			        $output .= '<div class="circle">';
			        	if($icon_number == 'number')
                            $output .= '<span class="number">'.$number.'</span>';
                        if($icon_number=='icon')
                            $output .= '<i class="'.$icon.'"></i>';
			        $output .= '</div>';
                    $output .= '<span class="title">'.$title.'</span>';
                    $output .= '</li>';
			    
               
            endforeach;
            
            $output .= '</ul>';
            $output .= '<div class="content">';
            	$output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);
            $output .= '</div>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        echo  $output;     

?>