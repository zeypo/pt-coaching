<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class=" tabbable style_1 tabs-top">
		<ul class="nav nav-tabs">
			<?php $i = 0; foreach ( $tabs as $key => $tab ) : $i++; ?>

				<li class="<?php echo $key ?>_tab <?php if($i == 1) echo 'active' ?> " >
					<a href="#tab<?php echo $key ?>"  data-toggle="tab" class="yes"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>
		</ul>
		<div class="tab-content">
		<?php $i = 0;  foreach ( $tabs as $key => $tab ) : $i++; ?>

			<div class="tab-pane panel entry-content <?php if($i == 1) echo 'active' ?>" id="tab<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>