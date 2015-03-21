<?php

global $themeple_config;

    

    do_action( 'themeple_routing_template' , 'page' );

    $themeple_config['current_view'] = 'woocommerce';

    $meta = themeple_post_meta(themeple_get_post_id());

    if(isset($meta['layout']))

        $themeple_config['current_sidebar'] = $meta['layout'];

    $spancontent = 12;

    if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] == 'fullsize')

        $spancontent = 12;

    elseif(isset($themeple_config['current_sidebar']) && ($themeple_config['current_sidebar'] == 'sidebar_left' || $themeple_config['current_sidebar'] == 'sidebar_right'))

        $spancontent = 9;

    get_header();

    

    

    ?>

    

        <?php

            

            $title = get_the_title(themeple_get_post_id() );

            $page_parents = themeple_page_parents();

            $subtitle = themeple_post_meta(themeple_get_post_id(), 'page_header_desc');

        ?>



   <?php get_template_part('template_inc/page_header'); ?>

        

    

   <section id="content"  <?php if(themeple_post_meta(themeple_get_post_id(), 'page_header_bool') == 'no'): echo 'style=""'; endif; ?> >

        <div class="container <?php echo $themeple_config['current_sidebar'] ?>" id="woocommerce">

            <div class="row">

    <?php if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] == 'sidebar_left') get_sidebar() ?>   

        <div class="span<?php echo $spancontent ?>">

    <?php



            woocommerce_content();

    ?>



        </div>

<?php

    wp_reset_query();    

    

    if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] == 'sidebar_right') get_sidebar();

?>



            </div>

        </div>



</section>



    <?php

    get_footer();



?>