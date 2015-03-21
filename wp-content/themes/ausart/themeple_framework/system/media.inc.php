<?php

add_action( 'init', array('themeple_media', 'generate_media_type' ));
if(!class_exists('themeple_media')){
    /**
     * themeple_media
     * 
     * @package  
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     * @access public
     */
    class themeple_media{
        
        /**
         * themeple_media::generate_media_type()
         * 
         * @return
         */
        static function generate_media_type(){
            register_post_type( 'themeple_fw_post', 
                array(
        			'labels' => array('name' => 'Themeple FW' ),
        			'show_ui' => false,
        			'query_var' => true,
        			'capability_type' => 'post',
        			'hierarchical' => false,
        			'rewrite' => false,
        			'supports' => array( 'editor', 'title' ), 
        			'can_export' => true,
        			'public' => true,
        			'show_in_nav_menus' => false
        		) 
            );
        }
        
        /**
         * themeple_media::get_custom_post()
         * 
         * @return
         */
        public static function get_custom_post( $post_title )
		{
			$save_title = themeple_admin_safe_string( $post_title );
			
			$args = array( 	'post_type' => 'themeple_fw_post', 
							'post_title' => 'themeple_' . $save_title,
							'post_status' => 'draft', 
							'comment_status' => 'closed', 
							'ping_status' => 'closed');
							
			$post = themeple_media::get_post_by_title( $args['post_title'] );

			if(!isset($post['ID']) ) 
			{ 
				$post_id = wp_insert_post( $args );
			}
			else
			{
				$post_id = $post['ID'];
			}
            
			return $post_id;
		}
		
		/**
		 * themeple_media::get_post_by_title()
		 * 
		 * @return
		 */
		public static function get_post_by_title($post_title) {
		    global $wpdb;
                $post_title = esc_sql($post_title);
		        $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type='themeple_fw_post'", $post_title ));
		        if ( $post )
		            return get_post($post, 'ARRAY_A');
		
		    return null;
		}
        
        
    }
}



?>