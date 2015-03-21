<?php $sticky_class = themeple_get_option('sticky_menu'); if($sticky_class == 'yes') $sticky_class = 'sticky_header'; else $sticky_class = '';  ?>
<div  class="header_wrapper header_2 one_page_header transparency_section">
        <header id="header" class="<?php echo esc_attr($sticky_class) ?>">
            <div class="container">
               <div class="row-fluid">
                    <div class="span12">
                        <?php if(!isset($css_class)) $css_class=''; ?>
                        <div id="logo" class="<?php echo esc_attr($css_class) ?>">
                            <?php echo themeple_logo() ?>
                            <span class="logo_desc"><?php echo esc_attr(themeple_get_option('desc_logo')) ?></span>   
                        </div>
                        <div id="navigation" class="nav_top pull-right  <?php echo esc_attr($css_class) ?>">
                                        <nav>
                                            <?php 
                                                $args = array("menu" => themeple_post_meta(themeple_get_post_id(), 'one_page_menu'), "container" => false, "fallback_cb" => 'themeple_fallback_menu');
                                                wp_nav_menu($args);  
                                            ?>
                                        </nav>
                        </div>
                        <a href="#" class="mobile_small_menu open"></a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Responsive Menu -->
        <?php get_template_part('template_inc/menu', 'small'); ?>
        <!-- End Responsive Menu -->
    </div>