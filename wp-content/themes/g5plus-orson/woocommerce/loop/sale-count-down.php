<?php
/**
 * The template for displaying sale count down
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$g5plus_woocommerce_loop = &G5Plus_Woocommerce::get_woocommerce_loop();
$product_sale_count_down_enable = G5Plus_Global::get_option('product_sale_count_down_enable');
if ($g5plus_woocommerce_loop['sale_count_down_enable'] != '') {
	$product_sale_count_down_enable = $g5plus_woocommerce_loop['sale_count_down_enable'];
}
if (!$product_sale_count_down_enable) {
	return;
}

global $post, $product;
$sales_price_to = '';
if ($product->is_on_sale() && $product->product_type != 'grouped') {
	if ($product->product_type == 'variable') {
		$available_variations = $product->get_available_variations();
		for ($i = 0; $i < count($available_variations); ++$i) {
			$sales_price_to_temp = '';
			$variation_id = $available_variations[$i]['variation_id'];
			$variable_product = new WC_Product_Variation( $variation_id );
			$regular_price = $variable_product->get_regular_price();
			$sales_price = $variable_product->get_sale_price();
			$price = $variable_product->get_price();
			if ( $sales_price != $regular_price && $sales_price == $price ) {
				$sales_price_to_temp = get_post_meta($variation_id, '_sale_price_dates_to', true);
				if (isset($sales_price_to_temp) && !empty($sales_price_to_temp) && ($sales_price_to_temp > $sales_price_to)) {
					$sales_price_to = $sales_price_to_temp;
				}
			}
		}
	} else {
		$sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
	}
}
if ( !empty($sales_price_to)) {
	$sales_price_to = date("Y/m/d", $sales_price_to);
	?>
	<div class="product-deal-countdown" data-date-end="<?php echo esc_attr($sales_price_to); ?>">
		<div class="product-deal-countdown-inner">
			<div class="countdown-section">
				<span class="countdown-amount countdown-day"></span>
				<span class="countdown-period"><?php esc_html_e('Days','g5plus-orson'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-hours"></span>
				<span class="countdown-period"><?php esc_html_e('Hours','g5plus-orson'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-minutes"></span>
				<span class="countdown-period"><?php esc_html_e('Mins','g5plus-orson'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-seconds"></span>
				<span class="countdown-period"><?php esc_html_e('Secs','g5plus-orson'); ?></span>
			</div>
		</div>
	</div>
<?php
}