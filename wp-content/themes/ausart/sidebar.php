<?php

global $themeple_config;

$sidebar_style = "";



if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] != 'fullsize'){

    

    ?>

    

    <aside class="span3 sidebar" id="widgetarea-sidebar">

    

    <?php

    $use_defailt = true;

    if ($themeple_config['current_view'] == 'blog' && dynamic_sidebar(__('Sidebar Blog', 'themeple')) ) : $use_defailt = false; endif;

    if ($themeple_config['current_view'] == 'portfolio' && dynamic_sidebar(__('Sidebar Portfolio', 'themeple')) ) : $use_defailt = false; endif;

    if ($themeple_config['current_view'] == 'page' && dynamic_sidebar(__('Sidebar Pages','themeple'))) : $use_defailt = false; endif;

    if ($themeple_config['current_view'] == 'woocommerce' && dynamic_sidebar(__('Sidebar Woocommerce','themeple'))) : $use_defailt = false; endif;

    $page_title = themeple_check_custom_widget('page');

    if (function_exists('dynamic_sidebar') &&  dynamic_sidebar(__('Page','themeple').': '.$page_title) ) : $use_defailt = false; endif;

    $cat_title = themeple_check_custom_widget('cat');

    if (function_exists('dynamic_sidebar') && dynamic_sidebar(__('Category','themeple').': '.$cat_title) ) : $use_defailt = false; endif;

    

    if ($use_defailt)

    {

		//themeple_default_widgets('categories');

	}

    ?>

    

    

    

    

    

    </aside>



<?php

}



?>

