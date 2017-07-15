<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $layout
 * @var $show
 * @var $slugs
 * @var $category
 * @var $number
 * @var $columns
 * @var $badge
 * @var $is_slider
 * @var $rows
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Product_Deals
 */

$title = $layout = $show = $slugs = $category  = $number =  $columns = $badge = $is_slider = $rows = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();

$wrapper_classes = array(
	'woocommerce',
	'g5plus-product-deals',
	'layout-'. $layout,
	'clearfix',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

if ($layout == 'border-wrap') {
	$wrapper_classes[] = 'border-dark';
}

if (($layout == 'border-wrap') && !empty($badge)) {
	$wrapper_classes[] = 'has-badge';
}

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}


// get sources
$query_args = array(
	'post_type'           => 'product',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $number,
	'meta_query'          => WC()->query->get_meta_query()
);

if (!empty($category) && ($show != 'products')) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' 		=> 'product_cat',
			'terms' 		=>  explode(',',$category),
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		)
	);
}

switch($show) {
	case 'sale':
		$product_ids_on_sale = wc_get_product_ids_on_sale();
		$query_args['post__in'] = array_merge( array( 0 ), $product_ids_on_sale );
		break;
	case 'products':
		$product_ids = g5plus_get_product_ids_by_slugs($slugs);
		$query_args['post__in'] = array_merge( array( 0 ), $product_ids );
		$query_args['posts_per_page'] = -1;
		break;
}

$r = new WP_Query( apply_filters( 'woocommerce_shortcode_product_deals_query', $query_args, $atts ) );

$totalRecord = $r->post_count;
$per_page = $rows * $columns;
$index = 0;
$index_sub = 0;

$g5plus_woocommerce_loop = &G5Plus_Framework_Global::get_woocommerce_loop();
$g5plus_woocommerce_loop['columns'] = $columns;
if ($is_slider && ($totalRecord > $per_page)) {
	$g5plus_woocommerce_loop['layout'] = 'slider';
	if ($rows > 1) {
		$g5plus_woocommerce_loop['rows'] = $rows;
	}
}
$g5plus_woocommerce_loop['sale_count_down_enable'] = 1;
$g5plus_woocommerce_loop['catalog_style'] = 'center';
$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'product-deals', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/product-deals/assets/css/product-deals'.$min_suffix.'.css'), array(), false, 'all');
}
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php if (!empty($badge) && ($layout == 'border-wrap')): ?>
		<span class="badge"><?php echo esc_html($badge); ?></span>
	<?php endif; ?>
	<?php if (!empty($title)): ?>
		<div class="widget-title">
			<span><?php echo esc_html($title); ?></span>
		</div>
	<?php endif; ?>
	<?php if ($r->have_posts()): ?>
		<?php woocommerce_product_loop_start(); ?>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && (($index % $per_page) === 0)): ?>
				<?php $index_sub = 0; ?>
				<div>
			<?php endif; ?>
			<?php wc_get_template( 'content-product-deals.php',array('layout' =>  $layout) ); ?>
			<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && ($index_sub == ($per_page - 1))) : ?>
				</div><!-- End Loop -->
			<?php endif; ?>
			<?php
				$index_sub++;
				$index++;
			?>
		<?php endwhile; // end of the loop. ?>
		<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && ($index_sub != $per_page) && ($index > 0)) : ?>
			</div><!-- End Loop -->
		<?php endif; ?>
		<?php woocommerce_product_loop_end(); ?>
	<?php else: ?>
		<div class="item-not-found"><?php esc_html_e('No item found','g5plus-orson'); ?></div>
	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>