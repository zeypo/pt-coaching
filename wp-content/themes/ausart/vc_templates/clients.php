<?php

	

	extract(shortcode_atts(array(

            

            'title' => '',

            'dark_light' => ''



    	), $atts));



	

        $clients = themeple_get_option('client-logo');



        $output = '<div class="'.$dark_light.'_clients clients_el '.$carousel.'">';

        $output .= '<div class="header"><h2>'.$title.'</h2></div>';

        $output .= '<section class="row clients clients_caro">';

        $i = 0;

        foreach($clients as $client):                            
                $i ++;
                if($dark_light == 'light'){
                    $client['logo'] = $client['logo_light'];
                }


                $output .= '                    <div class="item">

                                                    <a href="'.$client['link'].'"  title="'.$client['title'].'">

                                                        <img src="'.$client['logo'].'" alt="'.$client['title'].'" >

                                                        

                                                    </a></div>';

                if($i == 3){
                        $output .= '<div class="separator"></div>';
                }

        endforeach;

                          

        $output .= '</section>';

        $output .='<div class="controls"><a  class="prev"></a><a class="next"></a></div>';

        $output .= '</div>';





        echo $output;

	

?>