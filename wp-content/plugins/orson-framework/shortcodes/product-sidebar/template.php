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
 * @var $orderby
 * @var $order
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
 * @var $this WPBakeryShortCode_G5Plus_Product_Sidebar
 */

$title = $layout = $show = $slugs = $category =  $number = $orderby = $order = $is_slider = $rows = $arrows = $arrows_position = $arrows_style = $dots = $css_animation = $animation_duration = $animation_delay = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();
$content_attributes = array();

$wrapper_classes = array(
	'woocommerce',
	'g5plus-product-sidebar',
	'clearfix',
	$layout,
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

$content_classes = array(
	'product_list_widget',
	'clearfix'
);

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
	case 'new-in':
		$query_args['orderby'] = 'DESC';
		$query_args['order'] = 'date';
		break;
	case 'featured':
		$query_args['meta_query'][] = array(
			'key'   => '_featured',
			'value' => 'yes'
		);
		break;
	case 'top-rated':
		add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
		break;
	case 'recent-review':
		add_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' ) );
		break;
	case 'best-selling' :
		$query_args['meta_key'] = 'total_sales';
		$query_args['orderby'] = 'meta_value_num';
		break;
	case 'products':
		$product_ids = g5plus_get_product_ids_by_slugs($slugs);
		$query_args['post__in'] = array_merge( array( 0 ), $product_ids );
		$query_args['posts_per_page'] = -1;
		break;
}

if (in_array($show,array('all','sale','featured'))) {
	$query_args['order'] = $order;
	switch ( $orderby ) {
		case 'price' :
			$query_args['meta_key'] = '_price';
			$query_args['orderby']  = 'meta_value_num';
			break;
		case 'rand' :
			$query_args['orderby']  = 'rand';
			break;
		case 'sales' :
			$query_args['meta_key'] = 'total_sales';
			$query_args['orderby']  = 'meta_value_num';
			break;
		default :
			$query_args['orderby']  = 'date';
	}
}

$r = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts ) );

if($show =='top-rated'){
	remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
}
if($show =='recent-review' ){
	remove_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' )  );
}

$totalRecord = $r->post_count;
$index = 0;
$index_sub = 0;
$per_page = $rows;

if ($is_slider && ($totalRecord > $per_page)){
	$content_classes[] = 'owl-carousel';
	if ($arrows) {
		$content_classes[] = 'owl-nav-'. $arrows_position;
		$content_classes[] = 'owl-nav-'. $arrows_style;
	}
	$owl_carousel_attributes = array(
		'"items": 1',
		'"autoHeight": true',
		'"dots": ' . ($dots ? 'true' : 'false'),
		'"nav": ' . ($arrows ? 'true' : 'false'),
	);
	$content_attributes[] = "data-owl-config='{". implode(', ', $owl_carousel_attributes) ."}'";
}

if (!empty($layout)) {
	$title_style = '';
	$title_align = 'left';
	$title_scheme = '';
}

$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$css_content_class = implode(' ', $content_classes);
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php if (!empty($title)): ?>
		<h4 class="widget-title"><span><?php echo esc_html($title); ?></span></h4>
	<?php endif; ?>
	<?php if ($r->have_posts()): ?>
		<ul class="<?php echo esc_attr($css_content_class); ?>" <?php echo implode(' ', $content_attributes); ?>>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && (($index % $per_page) === 0)): ?>
				<?php $index_sub = 0; ?>
				<div>
			<?php endif; ?>
			<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => true ) ); ?>
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
		</ul>
	<?php else: ?>
		<div class="item-not-found"><?php esc_html_e('No item found','g5plus-orson'); ?></div>
	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>