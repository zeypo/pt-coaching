<?php



add_theme_support('woocommerce');

define('WOOCOMMERCE_USE_CSS', false);



add_action('woocommerce_before_shop_loop_item_title', 'themeple_woocommerce_product_thumbnail', 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20);

function themeple_woocommerce_product_thumbnail(){

    global $woocommerce;

    $product_id = get_the_ID();

    $thumbnail_size = 'shop_catalog';

    $items_in_cart = array();



    if($woocommerce->cart->get_cart() && is_array($woocommerce->cart->get_cart())) {

        foreach($woocommerce->cart->get_cart() as $cart) {

            $items_in_cart[] = $cart['product_id'];

        }

    }



   

    $in_array = in_array($product_id, $items_in_cart);

    

    $images = get_post_meta($product_id, '_product_image_gallery', true);


    $attachment_image = '';

    if(!empty($images)) {

        $images = explode(',', $images);

        $first = $images[0];

        $attachment_image = wp_get_attachment_image($first , $thumbnail_size, false, array('class' => 'hover'));
    }

    $original = get_the_post_thumbnail($product_id , $thumbnail_size);



    if($attachment_image) {

        $classes = 'hover_effect';

    } else {

        $classes = 'non_hover_effect';

    }



    echo '<span class="'.$classes.'">';

    

    echo $original;

    echo $attachment_image;

    if($in_array){

        echo '<span class="loading_ef"><i class="moon-checkmark"></i></span>';

    }else{

        echo '<span class="loading_ef"><i class="icon-spin moon-spinner-2" aria-hidden="true"></i></span>';

    }

    

    

    do_action('themeple_woocommerce_rating');

   

    echo '</span>';

}

add_action('themeple_woocommerce_rating', 'woocommerce_template_loop_rating', 10);

apply_filters( 'woocommerce_show_page_title', false );

add_action('admin_init','themeple_active_woocommerce');







add_filter('loop_shop_columns', 'themeple_loop_columns');

if (!function_exists('themeple_loop_columns')) {

    function themeple_loop_columns() {

        return 4; 

    }

}



function themeple_woo_related_products_limit() {

  global $product, $themeple_config;

    if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] != 'fullsize' && $themeple_config['current_sidebar'] != '')
        $limit = 3;
    else
        $limit = 4;

    $args = array(

        'post_type'             => 'product',

        'no_found_rows'         => 1,

        'posts_per_page'        => $limit,

        'ignore_sticky_posts'   => 1,

        'post__not_in'          => array($product->id)

    );

    return $args;

}

add_filter( 'woocommerce_related_products_args', 'themeple_woo_related_products_limit' );



remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_after_single_product_summary', 'themeple_woocommerce_output_upsells', 15 );

 

if ( ! function_exists( 'themeple_woocommerce_output_upsells' ) ) {

    function themeple_woocommerce_output_upsells() {

        woocommerce_upsell_display( 4,1 ); // Display 3 products in rows of 3

    }

}





function themeple_active_woocommerce()

{

    global $pagenow;

    if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) 

    {

        update_option('shop_catalog_image_size', array('width' => 350, 'height' => 450, 0));

        update_option('shop_single_image_size', array('width' => 350, 'height' => 450, 0));

        update_option('shop_thumbnail_image_size', array('width' => 350, 'height' => 450, 0));

    }

}





remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);



add_action('woocommerce_before_shop_loop', 'themeple_woocommerce_catalog_ordering', 30);

function themeple_woocommerce_catalog_ordering() {

    



    parse_str($_SERVER['QUERY_STRING'], $params);



    $query_string = '?'.$_SERVER['QUERY_STRING'];



    $per_page = 12;



    $product_orderby = !empty($params['product_orderby']) ? $params['product_orderby'] : 'default';

    $product_order = !empty($params['product_order'])  ? $params['product_order'] : 'asc';

    $product_count = !empty($params['product_count']) ? $params['product_count'] : $per_page;



    $output = '';

    $output .= '<div class="ordering-container">';



        $output .= '<div class="orderby-container">';



            $output .= '<ul class="orderby dropdown">';

                $output .= '<li>';

                    $output .= '<span class="current-li"><a>'.__('Sort by', 'themeple').' <strong>'.ucfirst($product_orderby).'</strong></a></span>';

                    $output .= '<ul>';

                        $output .= '<li class="'.(($product_orderby == 'default') ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_orderby', 'default').'">'.__('Sort by', 'themeple').' <strong>'.__('Default Sort', 'themeple').'</strong></a></li>';

                        $output .= '<li class="'.(($product_orderby == 'name') ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_orderby', 'name').'">'.__('Sort by', 'themeple').' <strong>'.__('Name', 'themeple').'</strong></a></li>';

                        $output .= '<li class="'.(($product_orderby == 'popularity') ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_orderby', 'populatiry').'">'.__('Sort by', 'themeple').' <strong>'.__('Populatiry', 'themeple').'</strong></a></li>';

                        $output .= '<li class="'.(($product_orderby == 'date') ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_orderby', 'date').'">'.__('Sort by', 'themeple').' <strong>'.__('Date', 'themeple').'</strong></a></li>';

                        $output .= '<li class="'.(($product_orderby == 'rating') ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_orderby', 'rating').'">'.__('Sort by', 'themeple').' <strong>'.__('Rating', 'themeple').'</strong></a></li>';

                        $output .= '<li class="'.(($product_orderby == 'price') ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_orderby', 'price').'">'.__('Sort by', 'themeple').' <strong>'.__('Price', 'themeple').'</strong></a></li>';

                    $output .= '</ul>';

                $output .= '</li>';

            $output .= '</ul>';





            $output .= '<ul class="order">';

            if($product_order == 'desc'):

                $output .= '<li class="desc"><a href="'.themeple_add_param($query_string, 'product_order', 'asc').'"><i class="moon-arrow-up-4"></i></a></li>';

            endif;

            if($product_order == 'asc'):

                $output .= '<li class="asc"><a href="'.themeple_add_param($query_string, 'product_order', 'desc').'"><i class="moon-arrow-down-4"></i></a></li>';

            endif;

            $output .= '</ul>';



        $output .= '</div>';



        $output .= '<ul class="count dropdown">';

            $output .= '<li>';

                $output .= '<span class="current-li"><a>'.__('Show', 'themeple').' <strong>'.$product_count.' '.__(' Products', 'themeple').'</strong></a></span>';

                $output .= '<ul>';

                    $output .= '<li class="'.(($product_count == $per_page) ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_count', $per_page).'">'.__('Show', 'themeple').' <strong>'.$per_page.' '.__('Products', 'Avada').'</strong></a></li>';

                    $output .= '<li class="'.(($product_count == $per_page*2) ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_count', $per_page*2).'">'.__('Show', 'themeple').' <strong>'.($per_page*2).' '.__('Products', 'Avada').'</strong></a></li>';

                    $output .= '<li class="'.(($product_count == $per_page*3) ? 'current': '').'"><a href="'.themeple_add_param($query_string, 'product_count', $per_page*3).'">'.__('Show', 'themeple').' <strong>'.($per_page*3).' '.__('Products', 'Avada').'</strong></a></li>';

                $output .= '</ul>';

            $output .= '</li>';

        $output .= '</ul>';

    $output .= '</div>';



    echo $output;

}



add_action('woocommerce_get_catalog_ordering_args', 'themeple_woocommerce_get_catalog_ordering_args', 20);

function themeple_woocommerce_get_catalog_ordering_args($args)

{

    parse_str($_SERVER['QUERY_STRING'], $params);



    $product_orderby = !empty($params['product_orderby']) ? $params['product_orderby'] : 'default';

    $product_order = !empty($params['product_order'])  ? $params['product_order'] : 'asc';



    switch($product_orderby) {

        case 'date':

            $orderby = 'date';

            $order = 'desc';

            $meta_key = ''; 

        break;

        case 'price':

            $orderby = 'meta_value_num';

            $order = 'asc';

            $meta_key = '_price';

        break;

        case 'popularity':

            $orderby = 'meta_value_num';

            $order = 'desc';

            $meta_key = 'total_sales';

        break;

        case 'title':

            $orderby = 'title';

            $order = 'asc';

            $meta_key = '';

        break;

        case 'default':

        default:

            $orderby = 'menu_order title';

            $order = 'asc';

            $meta_key = '';

        break;

    }



    switch($product_order) {

        case 'desc':

            $order = 'desc';

        break;

        case 'asc':

            $order = 'asc';

        break;

        default:

            $order = 'asc';

        break;

    }



    $args['orderby'] = $orderby;

    $args['order'] = $order;

    $args['meta_key'] = $meta_key;

    

    return $args;

}





add_filter('loop_shop_per_page', 'themeple_shop_loop_per_page');

function themeple_shop_loop_per_page()

{



    parse_str($_SERVER['QUERY_STRING'], $params);

    $per_page = 12;

    $product_count = !empty($params['product_count']) ? $params['product_count'] : $per_page;

    return $product_count;

}





add_filter('add_to_cart_fragments', 'themeple_woocommerce_header_add_to_cart_fragment');

function themeple_woocommerce_header_add_to_cart_fragment( $fragments ) {

    global $woocommerce;

    ob_start();

    ?>
   

            <div class="cart">
               <a class="cart_icon" href="<?php echo esc_url(get_permalink(get_option('woocommerce_cart_page_id'))); ?>"></a>
            
                <div class="content">


                    <div class="items">
                  
                    <?php foreach($woocommerce->cart->cart_contents as $key => $cart_item): ?>

                    

                        <div class="cart_item">

                            <a href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>">

                            <?php echo get_the_post_thumbnail($cart_item['product_id'], array(70, 70)); ?>

                            <div class="description">

                                <span class="title"><?php echo esc_attr($cart_item['data']->post->post_title); ?></span>

                                <span class="price"><?php echo esc_attr($cart_item['quantity']); ?> x <?php echo esc_attr($woocommerce->cart->get_product_subtotal($cart_item['data'], $cart_item['quantity'])); ?></span> 

                            </div>

                            </a>

                            <a class="remove" href="<?php echo esc_url($woocommerce->cart->get_remove_url($key)) ?>"></a>

                        </div>

                    <?php endforeach; ?>

                    </div>
                       
                    <?php if($woocommerce->cart->cart_contents_count != 0){ ?>
                       <div class="subtotal"> 
                                   <span class="subtotal_title"><?php _e('Subtotal:', 'themeple'); ?> </span>
                                   <?php $cart_subtotal = esc_attr($woocommerce->cart->get_cart_subtotal() ); 
                                      echo esc_attr($cart_subtotal);?>
                            </div>
                  <?php  } else {

                                echo '<div class="no-items"> No items are added on the cart! </div>';

                                } ?>

                    <div class="checkout">

                        <div class="view_cart"><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_cart_page_id'))); ?>"><span><?php _e('View Cart', 'themeple'); ?></span><i class="moon-arrow-right-5"></i></a></div>

                        <div class="checkout_link"><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_checkout_page_id'))); ?>"><span><?php _e('Checkout', 'themeple'); ?></span><i class="moon-arrow-right-5"></i></a></div>

                    </div>

                </div>

            
    
    </div>
    </div>

    <?php
    
    $fragments['header#header .cart'] = ob_get_clean();
    $fragments['.sticky_menu .cart'] = $fragments['header#header .cart'] ;
    $fragments['.top_nav .cart'] = $fragments['header#header .cart'];
    

    
    return $fragments;

    

}




    //DISABLE WOOCOMMERCE PRETTY PHOTO SCRIPTS
    add_action( 'wp_print_scripts', 'themeple_my_deregister_javascript', 100 );

    function themeple_my_deregister_javascript() {
        wp_deregister_script( 'prettyPhoto' );
        wp_deregister_script( 'prettyPhoto-init' );
    }









?>