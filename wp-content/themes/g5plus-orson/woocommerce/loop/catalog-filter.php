<?php
/**
 * The template for displaying Catalog Filter
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if (!woocommerce_products_will_display()) return;
?>
<div class="catalog-filter clearfix">
	<div class="catalog-filter-left">
		<?php woocommerce_catalog_ordering(); ?>
	</div>
	<div class="catalog-filter-right">
		<?php
		/**
		 * woocommerce_before_shop_loop hook.
		 *
		 * @hooked catalog_page_size - 10
		 * @hooked woocommerce_pagination - 20
		 */
		do_action( 'g5plus_woocommerce_catalog_filter' );
		?>
	</div>
</div>
