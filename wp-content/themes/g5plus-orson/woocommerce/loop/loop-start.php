<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce_loop;
$g5plus_woocommerce_loop = &G5Plus_Woocommerce::get_woocommerce_loop();
$columns = !empty($g5plus_woocommerce_loop['columns']) ? $g5plus_woocommerce_loop['columns'] :  $woocommerce_loop['columns'];
$column_gap = !empty($g5plus_woocommerce_loop['column_gap']) ? $g5plus_woocommerce_loop['column_gap'] :  '';
$rows = !empty($g5plus_woocommerce_loop['rows']) ? $g5plus_woocommerce_loop['rows'] : 1;

$product_listing_class = array('product-listing woocommerce clearfix');
if (!empty($column_gap)) {
	$product_listing_class[] = 'column-gap-' . $column_gap;
}

$columns_md = $columns_sm = $columns_xs = $columns_mb = $columns;
if ($columns > 4) {
	$columns_md = 4;
}
if ($columns > 3) {
	$columns_sm = 3;
}
if ($columns > 2) {
	$columns_xs = 2;
}

if ($columns > 1) {
	$columns_mb = 1;
}

if (!empty($g5plus_woocommerce_loop['columns_md'])){
	$columns_md = $g5plus_woocommerce_loop['columns_md'];
}

if (!empty($g5plus_woocommerce_loop['columns_sm'])){
	$columns_sm = $g5plus_woocommerce_loop['columns_sm'];
}

if (!empty($g5plus_woocommerce_loop['columns_xs'])){
	$columns_xs = $g5plus_woocommerce_loop['columns_xs'];
}

if (!empty($g5plus_woocommerce_loop['columns_mb'])){
	$columns_mb = $g5plus_woocommerce_loop['columns_mb'];
}



$product_listing_class[] = 'columns-' . $columns ;
$product_listing_class[] = 'columns-md-' . $columns_md;
$product_listing_class[] = 'columns-sm-' . $columns_sm;
$product_listing_class[] = 'columns-xs-' . $columns_xs;
$product_listing_class[] = 'columns-mb-' . $columns_mb;

if ($g5plus_woocommerce_loop['layout'] == 'slider') {
	$slidesToShow = $columns;

	if ($rows > 1) {
		$slidesToShow = 1;
		$columns = $columns_md = $columns_sm = $columns_xs = $columns_mb = 1;
	} else {
		$product_listing_class[] = 'product-slider';
	}
	$owl_class = array('owl-carousel');
	if ($g5plus_woocommerce_loop['arrows']) {
		if (!empty($g5plus_woocommerce_loop['arrows_position'])) {
			$owl_class[] = 'owl-nav-' . $g5plus_woocommerce_loop['arrows_position'];
		}

		if (!empty($g5plus_woocommerce_loop['arrows_style'])) {
			$owl_class[] = 'owl-nav-' . $g5plus_woocommerce_loop['arrows_style'];
		}
	}

	$owl_responsive_attributes = array();

	// Mobile <= 480px
	$owl_responsive_attributes[] = '"0" : {"items" : '. $columns_mb .'}';

	// Extra small devices ( < 768px)
	$owl_responsive_attributes[] = '"481" : {"items" : '. $columns_xs .'}';

	// Small devices Tablets ( < 992px)
	$owl_responsive_attributes[] = '"768" : {"items" : '. $columns_sm .'}';

	// Medium devices ( < 1199px)
	$owl_responsive_attributes[] = '"992" : {"items" : '. $columns_md .'}';

	// Medium devices ( > 1199px)
	$owl_responsive_attributes[] = '"1200" : {"items" : '. $columns .'}';

	$owl_attributes = array(
		'"autoHeight": true',
		'"dots": ' . $g5plus_woocommerce_loop['dots'],
		'"nav": ' . $g5plus_woocommerce_loop['arrows'],
		'"responsive": {'. implode(', ', $owl_responsive_attributes) . '}'
	);
}

if (!empty($g5plus_woocommerce_loop['size'])) {
	$product_listing_class[] = 'product-listing-'.$g5plus_woocommerce_loop['size'];
}

// product catalog style
$product_catalog_style = G5Plus_Global::get_option('product_catalog_style','left');
if (!empty($g5plus_woocommerce_loop['catalog_style'])) {
	$product_catalog_style = $g5plus_woocommerce_loop['catalog_style'];
}
if ($product_catalog_style != 'left') {
	$product_listing_class[] = 'product-listing-' . $product_catalog_style;
}

?>
<div class="<?php echo join(' ', $product_listing_class); ?>">
	<?php if ($g5plus_woocommerce_loop['layout'] == 'slider'): ?>
		<div class="<?php echo join(' ',$owl_class); ?>" data-owl-config='{<?php echo implode(', ', $owl_attributes) ?>}'>
	<?php endif; ?>

