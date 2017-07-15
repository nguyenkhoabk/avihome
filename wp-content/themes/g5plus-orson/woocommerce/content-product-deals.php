<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/31/2016
 * Time: 3:32 PM
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $woocommerce_loop;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
$classes = array('product-item-inner');
if (isset($layout) && ($layout == 'border-inner')) {
	$classes[] = 'border-dark';
}
?>
<div <?php post_class('product-item-wrap'); ?>>
	<div class='<?php echo join(' ',$classes); ?>'>
		<div class="product-thumb">
			<?php
			/**
			 * woocommerce_before_shop_loop_deals_item_title hook.
			 *
			 * @hooked g5plus_woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_deals_item_title' );
			?>
		</div>
		<div class="product-info text-center">
			<?php
				$cat_name = '';
				$terms = wc_get_product_terms( get_the_ID(), 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
				if ($terms) {
					$cat_link = get_term_link( $terms[0], 'product_cat' );
					$cat_name = $terms[0]->name;
				}
				if (!empty($cat_name)) {
					echo '<div class="product-cat"><a href="'. esc_url($cat_link).'" title="'. esc_attr($cat_name) .'">'. esc_html($cat_name) .'</a></div>';
				}

				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked g5plus_woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 * @hooked g5plus_woocommerce_template_loop_add_to_cart - 15
				 */
				do_action( 'woocommerce_after_shop_loop_deals_item_title' );
			?>
		</div>
	</div>
</div>
