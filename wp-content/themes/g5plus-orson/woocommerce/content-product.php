<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
?>
<div <?php post_class( 'product-item-wrap' ); ?>>

	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
	<div class="product-item-inner">
		<div class="product-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked g5plus_woocommerce_template_loop_sale_count_down - 10
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked g5plus_woocommerce_template_loop_product_thumbnail - 20
				 * @hooked g5plus_woocomerce_template_loop_link - 30
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<div class="product-actions">
				<?php
				/**
				 * g5plus_woocommerce_product_action hook
				 *
				 * @hooked g5plus_woocomerce_template_loop_compare - 5
				 * @hooked g5plus_woocomerce_template_loop_wishlist - 10
				 * @hooked g5plus_woocomerce_template_loop_quick_view - 15
				 */
				do_action( 'g5plus_woocommerce_product_actions' );
				?>
			</div>
		</div>
		<div class="product-info">
			<?php

			// show product category
			$g5plus_woocommerce_loop = &G5Plus_Woocommerce::get_woocommerce_loop();
			$product_category_enable = G5Plus_Global::get_option('product_category_enable');
			if ($g5plus_woocommerce_loop['category_enable'] !== '') {
				$product_category_enable = $g5plus_woocommerce_loop['category_enable'];
			}
			if ($product_category_enable) {
				$cat_name = '';
				$terms = wc_get_product_terms( get_the_ID(), 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
				if ($terms) {
					$cat_link = get_term_link( $terms[0], 'product_cat' );
					$cat_name = $terms[0]->name;
				}
				if (!empty($cat_name)) {
					echo '<div class="product-cat"><a href="'. esc_url($cat_link).'" title="'. esc_attr($cat_name) .'">'. esc_html($cat_name) .'</a></div>';
				}
				//echo $product->get_categories ( ', ', '<div class="product-cats">', '</div>' );
			}

			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked g5plus_woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );


			$product_rating_enable = G5Plus_Global::get_option('product_rating_enable');
			if (!$product_rating_enable) {
				remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
			}

			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked product_price_rating_open - 4
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 * @hooked product_price_rating_close - 11
			 * @hooked g5plus_woocommerce_template_loop_add_to_cart - 15
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			if (!$product_rating_enable) {
				add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
			}
			?>
		</div>
	</div>
	<?php
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</div>
