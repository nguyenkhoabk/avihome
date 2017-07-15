<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $title_style
 * @var $title_size
 * @var $title_align
 * @var $title_scheme
 * @var $show
 * @var $category
 * @var $number
 * @var $columns
 * @var $orderby
 * @var $order
 * @var $hide_empty
 * @var $is_slider
 * @var $rows
 * @var $arrows
 * @var $dots
 * @var $arrows_position
 * @var $arrows_style
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Product_Categories
 */

$title = $title_style = $title_size = $title_align = $title_scheme = $show  = $category =  $number = $columns = $orderby = $order = $hide_empty = $is_slider = $rows = $arrows = $dots = $css_animation = $animation_duration = $animation_delay = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();

$wrapper_classes = array(
	'g5plus-product-categories',
	'heading-' . $title_style,
	'clearfix',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}


$product_categories = array();
if ($show == 'all') {
	$args = array(
		'taxonomy' => 'product_cat',
		'orderby'    => $orderby,
		'order'      => $order,
		'hide_empty' => $hide_empty  ? true : false,
		'pad_counts' => true
	);
	$product_categories = get_categories($args);
	$product_categories = array_slice( $product_categories, 0, $number );
} else {
	$slugs = explode( ',', $category );
	$slugs = array_map( 'trim', $slugs );
	foreach ($slugs as $slug) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );
		if (is_object($term)) {
			$product_categories[] = $term;
		}
	}
}

if ( $hide_empty ) {
	foreach ( $product_categories as $key => $category ) {
		if ( $category->count == 0 ) {
			unset( $product_categories[ $key ] );
		}
	}
}
$totalRecord = sizeof($product_categories);
$per_page = $rows * $columns;
$index = 0;
$index_sub = 0;
$g5plus_woocommerce_loop = &G5Plus_Framework_Global::get_woocommerce_loop();
$g5plus_woocommerce_loop['columns'] = $columns;
if ($is_slider && ($totalRecord > $per_page)) {
	$g5plus_woocommerce_loop['layout'] = 'slider';
	$g5plus_woocommerce_loop['dots'] = ($dots ? 'true' : 'false');
	$g5plus_woocommerce_loop['arrows'] = ($arrows ? 'true' : 'false');
	$g5plus_woocommerce_loop['arrows_position'] = $arrows_position;
	$g5plus_woocommerce_loop['arrows_style'] = $arrows_style;
	if ($rows > 1) {
		$g5plus_woocommerce_loop['rows'] = $rows;
	}
}


$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php $this->the_title($title,$title_style,$title_size,$title_align,$title_scheme); ?>
	<?php if ($totalRecord > 0): ?>
		<?php woocommerce_product_loop_start(); ?>
			<?php foreach ( $product_categories as $category ) : ?>
				<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && (($index % $per_page) === 0)): ?>
					<?php $index_sub = 0; ?>
					<div>
				<?php endif; ?>

				<?php  wc_get_template( 'content-product_cat.php', array(
					'category' => $category
				) ); ?>

				<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && ($index_sub == ($per_page - 1))) : ?>
					</div><!-- End Loop -->
				<?php endif; ?>
				<?php
				$index_sub++;
				$index++;
				?>
			<?php endforeach; // end of the loop. ?>
			<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && ($index_sub != $per_page) && ($index > 0)) : ?>
				</div><!-- End Loop -->
			<?php endif; ?>
		<?php woocommerce_product_loop_end(); ?>
	<?php else: ?>
		<div class="item-not-found"><?php esc_html_e('No item found','g5plus-orson'); ?></div>
	<?php endif; ?>
</div>
