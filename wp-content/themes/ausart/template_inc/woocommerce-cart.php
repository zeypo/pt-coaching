<?php global $woocommerce; ?>



            <div class="cart">
               <a class="cart_icon" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"></a>
            
                <div class="content">


                    <div class="items">
                  
                    <?php foreach($woocommerce->cart->cart_contents as $key => $cart_item): ?>

                    

                        <div class="cart_item">

                            <a href="<?php echo get_permalink($cart_item['product_id']); ?>">

                            <?php echo get_the_post_thumbnail($cart_item['product_id'], array(70, 70)); ?>

                            <div class="description">

                                <span class="title"><?php echo esc_attr($cart_item['data']->post->post_title;) ?></span>

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
                                   <?php $cart_subtotal = $woocommerce->cart->get_cart_subtotal(); 
                                      echo esc_attr($cart_subtotal);?>
                            </div>
                  <?php  } else {

                                echo '<div class="no-items"> No items are added on the cart! </div>';

                                } ?>

                    <div class="checkout">

                        <div class="view_cart"><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><span><?php _e('View Cart', 'themeple'); ?></span><i class="moon-arrow-right-5"></i></a></div>

                        <div class="checkout_link"><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>"><span><?php _e('Checkout', 'themeple'); ?></span><i class="moon-arrow-right-5"></i></a></div>

                    </div>

                </div>

            
    
    </div>
   