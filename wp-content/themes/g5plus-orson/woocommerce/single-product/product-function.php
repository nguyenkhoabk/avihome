<?php
/**
 * Template display single product wishlist and compare
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */

if ((in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && get_option('yith_woocompare_compare_button_in_product_page') == 'yes')
|| (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && (get_option( 'yith_wcwl_enabled' ) == 'yes'))) {
	echo '<div class="single-product-function mg-bottom-30">';
	if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && (get_option( 'yith_wcwl_enabled' ) == 'yes')) {
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}

	if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && get_option('yith_woocompare_compare_button_in_product_page') == 'yes'){
		if (shortcode_exists('yith_compare_button')) {
			echo do_shortcode('[yith_compare_button container="false" type="link"]');
		}
	}
	echo '</div>';
}




