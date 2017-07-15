<?php
/**
 * Show options for page-size
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$product_per_page = G5Plus_Global::get_option('product_per_page','12,24,36');
$product_per_page_arr = explode ( ",", $product_per_page );
$page_size = isset( $_GET['page_size'] ) ? wc_clean( $_GET['page_size'] ) : $product_per_page_arr[0];



?>
<form class="woocommerce-page-size" method="get">
	<span class="catalog-filter-label"><?php esc_html_e('View:','g5plus-orson') ?></span>
	<select name="page_size" id="page_size" onchange="this.form.submit()">
		<?php foreach ( $product_per_page_arr as $number ) { ?>
			<option value="<?php echo esc_attr($number); ?>" <?php selected ( $number, $page_size ); ?>><?php echo esc_attr($number); ?></option>
		<?php } ?>
	</select>
	<?php
	// Keep query string vars intact
	foreach ( $_GET as $key => $val ) {
		if ( 'page_size' === $key || 'submit' === $key ) {
			continue;
		}
		if ( is_array( $val ) ) {
			foreach( $val as $innerVal ) {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
			}
		} else {
			echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
		}
	}
	?>
</form>

