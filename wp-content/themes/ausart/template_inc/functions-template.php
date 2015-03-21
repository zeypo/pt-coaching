<?php


if(!function_exists('themeple_routing_frontpage')){
    
    add_action('themeple_routing_frontpage', 'themeple_routing_frontpage');
    
    /**
     * themeple_routing_frontpage()
     * 
     * @return
     */
    function themeple_routing_frontpage(){
        global $themeple_config, $post;
        
        $front_page = themeple_get_option('frontpage');
       	
        if($front_page != '' && is_front_page() && !isset($themeple_config['front_p_q'])){
            
            $paged = get_query_var('paged');
			if(empty($paged)) $paged = get_query_var('page');
			if(empty($paged)) $paged = 1;
            
            $themeple_config['conditionals']['routed_frontpage'] = true;
            $themeple_config['new_query'] = array("page_id"=> themeple_get_option('frontpage'), "paged" => $paged);

            get_template_part( 'page' );

			exit();		
        }
    }
    
}


if(!function_exists('themeple_routing_template'))
{

	
	add_action('themeple_routing_template', 'themeple_routing_template');
	
	/**
	 * themeple_routing_template()
	 * 
	 * @return
	 */
	function themeple_routing_template( $current_template = false )
	{
		global $themeple_config, $post;
		$dynamic_id = "";
		if(isset($post)) $dynamic_id = $post->ID;
		$frontpage = themeple_get_option('frontpage');
        $blogpage = themeple_get_option('blogpage');
        
        
        if($frontpage && isset($themeple_config['new_query']) && $themeple_config['new_query']['page_id'] == $frontpage)
		{
			$dynamic_id = $frontpage;
			

		}
        
        
		if(themeple_check_dynamic_template($dynamic_id))
		{
            
			get_template_part( 'template', 'dynamic' ); exit();
		}
		
		
        if(isset($post) && $blogpage == $post->ID && !isset($themeple_config['new_query']))
		{ 	
			
			$themeple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
											
			get_template_part( 'template', 'blog' ); exit();
		}
        $portfolios = themeple_get_option('portfolio');
		$c_portfolio = 0;
		
		if(is_array($portfolios))
		{
			$c_portfolio = count($portfolios);
			
			foreach($portfolios as $portfolio)
			{
				if(!empty($portfolio['portfolio_page'])) $themeple_config['conditionals'][$portfolio['portfolio_page']]['is_portfolio'] = true;
			}
            
		}
        
        if(isset($post)) 
            $themeple_config['current_portfolio'] = themeple_get_option_array('portfolio', 'portfolio_page', get_the_ID());
        

        if(isset($themeple_config['current_portfolio']['portfolio_page']))
		{
			$themeple_config['conditionals']['is_portfolio'] = true;
			
			if ( ! session_id() && $c_portfolio > 1) 
                

			if ( $c_portfolio > 1 ) 
                $_SESSION['themeple_portfolio_page'] = get_the_ID();
			
			themeple_set_portfolio_query();
            
			get_template_part( 'template', 'portfolio' ); exit();
            
				
		}
		
	}
}

if(!function_exists('themeple_set_portfolio_query')){
    /**
     * themeple_set_portfolio_query()
     * 
     * @return
     */
    function themeple_set_portfolio_query()
	{
		global $themeple_config;
		
	
		
		if(isset($themeple_config['current_portfolio']['portfolio_cats']))
		{
			
			$terms 	= explode(',', $themeple_config['current_portfolio']['portfolio_cats']);
		}
		$p_per_page = 6;
		switch($themeple_config['current_portfolio']['portfolio_columns']){
			case '5':
				$p_per_page = 10;
			    break;
			case '2':
				$p_per_page = 4;
				break;
			case '3':
				$p_per_page = 9;
				break;
			case '4':
				$p_per_page = 12;
				break;
		}
		if(isset($terms[0]) && !empty($terms[0]) && !is_null($terms[0]) && $terms[0] != "null")
		{	
			$themeple_config['new_query'] = array(	'orderby' 	=> 'ID', 
												    'order' 	=> 'DESC', 
												    'paged' 	=> get_query_var( 'paged' ), 
												    'posts_per_page' => $p_per_page,  
												    'tax_query' => array( 	array( 	'taxonomy' 	=> 'portfolio_entries', 
																				    'field' 	=> 'id', 
																				    'terms' 	=> $terms, 	
																				    'operator' 	=> 'IN')));
		}
		else
		{
			$themeple_config['new_query'] = array(	'paged' 		 => get_query_var( 'paged' ),  
												    'posts_per_page' => -1,  
												    'post_type' 	 => 'portfolio'); 
		}
		
	}
}

if(!function_exists('themeple_execute_query')){
    add_action('themeple_excecute_query_var_action', 'themeple_execute_query');
    /**
     * themeple_execute_query()
     * 
     * @return
     */
    function themeple_execute_query($temp = false){
        global $themeple_config;
       
        if(isset($themeple_config['new_query'])){
            query_posts($themeple_config['new_query']);
            
			if($temp === 'template-dynamic') the_post(); 
        }
    }
}

function is_vc(){
	preg_match_all('/\[vc_row(.*?)\]/', get_the_content((int) themeple_get_post_id()), $matches );
	if ( isset($matches[0]) && !empty($matches[0]) )
		return true;
	return false;
}
?>