<?php

global $themeple_config;

do_action('themeple_excecute_query_var_action','loop-page');



if (have_posts()) :



	while (have_posts()) : the_post();

    

        $post_id    = get_the_ID();

        $title   	= get_the_title();

        $content 	= get_the_content();

        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));

        

        

        ?>

        

        



            <?php echo $content?>

            

        

        

        <?php

    endwhile;

endif;

?>