<?php

global $themeple_config;
$themeple_config['multi_entry_page'] = false;
$themeple_config['current_sidebar'] = themeple_get_option('single_post_sidebar_pos');
$spancontent = 12;
    if($themeple_config['current_sidebar'] == 'fullsize')
        $spancontent = 12;
    else
        $spancontent = 9;
get_header();
$themeple_config['current_view'] = 'blog';

    $blog_style = themeple_get_option('blog_style');
    $id = themeple_get_option('blogpage');



?>

    <!-- Page Head -->
    
   <?php if(themeple_post_meta($id, 'page_header_bool') == 'yes' || is_single() ): 

            $extra_class = '';
            $extra_style = '';
            
            $style = themeple_post_meta($id, 'page_header_style');
            if($style == 'modern')
                $style = 'centered';
            $title = get_the_title();

            $page_parents = themeple_page_parents();

            $extra_class .= $style;

            if(themeple_post_meta($id, 'background_image') != '' && themeple_post_meta($id, 'header_type') == 'image'){

                $extra_style .= 'background-image:url('.esc_url(themeple_post_meta($id, 'background_image')).');background-repeat: no-repeat;';

                $extra_class .= ' background_image';

            }

            if(themeple_post_meta($id, 'color_pick') != '' && themeple_post_meta($id, 'header_type') == 'color'){

                $extra_class .= ' colored_bg';

                $extra_style .= ' background-color:'.esc_attr(themeple_post_meta($id, 'color_pick')).';';

            }

            $centered = themeple_post_meta($id, 'centered');

            if(isset($centered) && $centered == 'centered'){

                $extra_style .= ' background-position:center;';

            }else{

                $extra_style .= ' -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;';

            }
    ?>
   <div class="header_page basic single" style="<?php echo esc_attr($extra_style) ?>">

            <div class="container">

                    <h1><?php echo esc_attr($title) ?></h1>
                    <div class="breadcrumbss">
                        
                        <ul class="page_parents pull-right">
                            <li class="breadcrumbs_c"><i class="moon-home-3"></i>&nbsp;&nbsp;&nbsp;<?php echo __('You are here', 'themeple'); ?></li>
                            <li class="breadcrumbs_c" ><a class="breadcrumbs_c" href="<?php echo esc_url(home_url()) ?>">Home</a></li>
                            <li class="breadcrumbs_c" ><a class="breadcrumbs_c" href="?page_id=<?php echo esc_attr($id) ?>">Blog</a></li>
                            <?php for($i = count($page_parents) - 1; $i >= 0; $i-- ){ ?>

                            <li class="breadcrumbs_c"><a class="breadcrumbs_c" href="<?php echo get_permalink($page_parents[$i]) ?>"><?php echo esc_attr(get_the_title($page_parents[$i])) ?> </a>/</li>

                            <?php }  ?>
                            <li class="breadcrumbs_c" ><a class="breadcrumbs_c" href="<?php echo get_permalink() ?>"><?php echo esc_html($title) ?></a></li>

                        </ul>
                    </div>

            </div>

            

    </div>
   
    
    <?php endif; ?>



<?php  

 // Get the single blog page background color

 ?>   
        
<section id="content">


    <div class="container" id="blog">
        <div class="row">
    <?php if($themeple_config['current_sidebar'] == 'sidebar_left') get_sidebar() ?>   
        <div class="span<?php echo esc_attr($spancontent) ?>">
    

    <div class="posts_here">
    <?php
        get_template_part( 'template_inc/loop', 'index' );
    ?>
    </div> 

        <?php $name = themeple_post_meta(get_the_ID(), 'post_author_name'); if(!empty($name)): ?>
	    <div class="single_testimonial blog_post_author">
            <dl class="dl-horizontal">
                <dt>
                    <img src="<?php echo esc_url(themeple_post_meta(get_the_ID(), 'post_author_img')) ?>" alt="">
                </dt>
                <dd>
                    <h4><?php echo esc_attr($name);  ?></h4>
                    
                    <p><?php echo esc_attr(themeple_post_meta(get_the_ID(), 'post_author_desc')) ?></p>
                </dd>
            </dl>
        </div>
        <?php endif; ?>
        
        <?php
            $layout = themeple_post_meta(get_the_ID(), 'layout');

            if(!empty($layout)){
                $l = explode("-", $layout);
                if($l[0] == 'dynamic_template'){
                    $themeple_config['current_view'] = 'page';
                    $genDynamic = new GenerateDynamicTemplate($layout);
                    $genDynamic->createView(); 
                    echo  '<section id="post-single-widget-area">';
                                
                    $genDynamic->display();
                                
                    echo '</section>';
                }
            }
        ?>
       

        
        
	 
        </div> 
  
<?php
    wp_reset_postdata();    
    $themeple_config['current_view'] = 'blog';
    if($themeple_config['current_sidebar'] == 'sidebar_right') get_sidebar();
?>
       
            </div>
    
</section>
<?php
    get_footer();


?>