<?php

	/** 

     * @author roshi

     * @copyright roshi[www.themeforest.net/user/roshi]

     * @version 2012

     */

if(!function_exists('themeple_admin_safe_string'))

{



	/**

	 * themeple_admin_safe_string()

	 * 

	 * @param mixed $string

	 * @param string $replace

	 * @return

	 */

	function themeple_admin_safe_string( $string , $replace = "_")

	{

		$string = strtolower($string);

	

		$trans = array(

					'&\#\d+?;'				=> '',

					'&\S+?;'				=> '',

					'\s+'					=> $replace,

					'ä'					=> 'ae',

					'ö'					=> 'oe',

					'ü'					=> 'ue',

					'Ä'					=> 'Ae',

					'Ö'					=> 'Oe',

					'Ü'					=> 'Ue',

					'ß'					=> 'ss',

					'[^a-z0-9\-\._]'		=> '',

					$replace.'+'			=> $replace,

					$replace.'$'			=> $replace,

					'^'.$replace			=> $replace,

					'\.+$'					=> ''

				  );



		$string = strip_tags($string);



		foreach ($trans as $key => $val)

		{

			$string = preg_replace("#".$key."#i", $val, $string);

		}

		

		return stripslashes($string);

	}

}





if(!function_exists('themeple_admin_get_dynamic_templates')){

    

    /**

     * themeple_admin_get_dynamic_templates()

     * 

     * @param string $prepend

     * @return

     */

    function themeple_admin_get_dynamic_templates($prepend = ''){

        global $themeple_controller;

        $templates = array();

        

        

        if(is_array($themeple_controller->admin_pages)){

            foreach($themeple_controller->admin_pages as $page){

                if(array_key_exists('sortable', $page)){

                    $templates[$page['title']] = $prepend.$page['slug'];

                }

            }

        }

        

        return $templates;

        

        

    }

    

}



if(!function_exists('themeple_entity_decode')){

    /**

     * themeple_entity_decode()

     * 

     * @param mixed $els

     * @return

     */

    function themeple_entity_decode($els){

        if(is_array($els) || is_object($els)){

            foreach($els as $key => $val){

                $els[$key]  = themeple_entity_decode($val);

            }

        }

        else{

            $els = html_entity_decode($els, ENT_QUOTES, get_bloginfo('charset'));

        }

        return $els;

    }

}



if(!function_exists('themeple_create_video_insert')){

            

    /**

     * themeple_create_video_insert()

     * 

     * @return

     */

    function themeple_create_video_insert(){            

            $video_description = '<p class="help">Enter the URL to the Video. <br/> A list of all supported Video Services can be found <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">here</a>

								<br/> <br/> 

								Working examples:<br/>

								<strong>http://vimeo.com/18439821</strong><br/> 

								<strong>http://www.youtube.com/watch?v=G0k3kHtyoqc</strong><br/> 

								</p>';

					

			$video_description = apply_filters('themeple_filter_video_insert_desc', $video_description);

			

			$output = "<form>";

			$output .='<h3 class="media-title">Insert media from another website</h3>';			

			$output .= '<div id="media-items">';

			$output .= '<div class="media-item media-blank">';

			$output .=	'<table class="describe themeple_video_insert"><tbody>

						<tr>

							<th valign="top" scope="row" class="label" style="width:130px;">

								<span class="alignleft"><label for="src">' . 'Enter Video URL' . '</label></span>

								<span class="alignright"><abbr id="status_img" title="required" class="required">*</abbr></span>

							</th>

							<td class="field">

								<input id="src" name="src" value="" type="text" aria-required="true"  />

								'.$video_description.'								

							</td>

						</tr>

						<tr>

							<td></td>

							<td>

								<input type="button" class="button" id="themeple_upload_video" value="' . esc_attr__('Insert Video') . '" />

							</td>

						</tr>';

			$output .= '</tbody></table>';

			$output .= '</div>';

			$output .= '</div>';

			$output .= '</form>';

			echo $output;

   }

}



if(!function_exists('themeple_video_tab')){

        /**

         * themeple_video_tab()

         * 

         * @param mixed $default_tabs

         * @return

         */

        function themeple_video_tab($default_tabs){	

			if(isset($_REQUEST['tab']) && 'themeple_video_tab' == $_REQUEST['tab'] )

			{

				$default_tabs['themeple_video_tab'] = 'Insert Video';

			}

			return $default_tabs;

		}

        add_filter( 'media_upload_tabs', 'themeple_video_tab', 11);

}



if(!function_exists('themeple_create_video_tab')){

    /**

     * themeple_create_video_tab()

     * 

     * @return

     */

    function themeple_create_video_tab(){

        wp_iframe('themeple_create_video_insert');

    }

    add_action('media_upload_themeple_video_tab', 'themeple_create_video_tab');

}



if(!function_exists('themeple_backend_is_file'))

{

	/**

	 * themeple_backend_is_file()

	 * 

	 * @param mixed $passedNeedle

	 * @param mixed $haystack

	 * @return

	 */

	function themeple_backend_is_file($passedNeedle, $haystack)

	{	



		$needle = substr($passedNeedle, strrpos($passedNeedle, '.') + 1);



		if(strlen($needle) > 4)

		{

			if(!is_array($haystack))

			{

				switch($haystack)

				{

					case 'videoService': $haystack = array('youtube.com/','vimeo.com/'); break;

				}

			}

			

			if(is_array($haystack))

			{

				foreach ($haystack as $regex)

				{

					if(preg_match("!".$regex."!", $passedNeedle)) return true;

				}

			}	

		}

		else

		{



			if(!is_array($haystack))

			{

				switch($haystack)

				{

					case 'image':

						$haystack = array('png','gif','jpeg','jpg','pdf','tif');

						

					break;

					

					case 'text':

						$haystack = array('doc','docx','rtf','ttf','txt','odp');

					break;

					

					case 'html5video':

						$haystack = array('ogv','webm','mp4');

					break;

				}

			}



			if(is_array($haystack))

			{

				if (in_array($needle,$haystack))

				{

					return true;

				}

			}

		}

		

		return false;

	}

	function themeple_aasort (&$array, $key) {
	    $sorter=array();
	    $ret=array();
	    reset($array);
	    foreach ($array as $ii => $va) {
	        $sorter[$ii]=$va[$key];
	    }
	    asort($sorter);
	    foreach ($sorter as $ii => $va) {
	        $ret[$ii]=$array[$ii];
	    }
	    $array=$ret;
	}

}











?>