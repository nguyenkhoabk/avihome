<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $title_style
 * @var $title_size
 * @var $title_align
 * @var $title_scheme
 * @var $layout
 * @var $icon_light
 * @var $category
 * @var $source
 * @var $number
 * @var $columns
 * @var $is_slider
 * @var $arrows
 * @var $arrows_position
 * @var $arrows_style
 * @var $dots
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $items_md
 * @var $items_sm
 * @var $items_xs
 * @var $items_mb
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Posts
 */

$title = $title_style = $title_size = $title_align = $title_scheme = $layout = $category = $source = $number = $columns = $is_slider = $arrows = $arrows_position = $arrows_style = $dots = $css_animation = $animation_duration = $animation_delay = $el_class = $items_md = $items_sm = $items_xs = $items_mb = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();
$content_attributes = array();
// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

$wrapper_classes = array(
	'g5plus-posts',
	'clearfix',
	'heading-' . $title_style,
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

$content_classes = array(
	'g5plus-posts-listing',
	'clearfix'
);

if (($layout == 'style_03' || $layout == 'style_04') && $icon_light ) {
	$content_classes[] = 'icon-light';
}

if ($layout == 'style_02') {
	$content_classes[] = 'boxed';
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

if ($items_md == -1) {
	$items_md = $columns;
}

if ($items_sm == -1) {
	$items_sm = $columns;
}

if ($items_xs == -1) {
	$items_xs = $columns;
}

if ($items_mb == -1) {
	$items_mb = $columns;
}

$content_classes[] = 'columns-' . $columns;
$content_classes[] = 'columns-md-' . $items_md;
$content_classes[] = 'columns-sm-' . $items_sm;
$content_classes[] = 'columns-xs-' . $items_xs;
$content_classes[] = 'columns-mb-' . $items_mb;
if ($is_slider){
	$content_classes[] = 'owl-carousel';

	if ($arrows) {
		$content_classes[] = 'owl-nav-'. $arrows_position;
		if (!empty($arrows_style)) {
			$content_classes[] = 'owl-nav-' . $arrows_style;
		}
	}

	$owl_responsive_attributes = array();
	$owl_margin = 20;
	// Mobile <= 480px
	$owl_responsive_attributes[] = '"0" : {"items" : '. $items_mb .', "margin": 0}';

	// Extra small devices ( < 768px)
	$owl_responsive_attributes[] = '"481" : {"items" : '. $items_xs .', "margin": '. $owl_margin .'}';

	// Small devices Tablets ( < 992px)
	$owl_responsive_attributes[] = '"768" : {"items" : '. $items_sm .', "margin": '. $owl_margin .'}';

	// Medium devices ( < 1199px)
	$owl_responsive_attributes[] = '"992" : {"items" : '. $items_md .', "margin": '. $owl_margin .'}';

	// Medium devices ( > 1199px)
	$owl_responsive_attributes[] = '"1200" : {"items" : '. $columns .', "margin": '. $owl_margin .'}';

	$owl_attributes = array(
		'"dots": ' . ($dots ? 'true' : 'false'),
		'"nav": ' . ($arrows ? 'true' : 'false'),
		'"responsive": {'. implode(', ', $owl_responsive_attributes) . '}'
	);
	$content_attributes[] = "data-owl-config='{". implode(', ', $owl_attributes) ."}'";

}

// get sources
$query_args = array(
	'posts_per_page' => $number,
	'no_found_rows' => true,
	'post_status' => 'publish',
	'ignore_sticky_posts' => true,
	'post_type' => 'post',
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio'),
			'operator' => 'NOT IN'
		)
	)
);
switch ($source) {
	case 'random' :
		$query_order_args = array(
			'orderby' => 'rand',
			'order' => 'DESC',
		);
		break;
	case 'popular':
		$query_order_args = array(
			'orderby' => 'comment_count',
			'order' => 'DESC',
		);
		break;
	case 'recent':
		$query_order_args = array(
			'orderby' => 'post_date',
			'order' => 'DESC',
		);
		break;
	case 'oldest':
		$query_order_args = array(
			'orderby' => 'post_date',
		);
		break;
}
$query_args = array_merge($query_args,$query_order_args);
if (!empty($category)) {
	$query_args['tax_query'][] = array(
		'taxonomy' => 'category',
		'terms' => explode(',', $category),
		'field' => 'slug',
		'operator' => 'IN'
	);
}
$r = new WP_Query($query_args);

$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

$css_content_class = implode(' ', $content_classes);

$show_image = true;
$show_icon = false;
$size = 'small-image';
if ($layout == 'style_04') {
	$show_image = false;
}
if ($layout == 'style_04' || $layout == 'style_03') {
	$show_icon = true;
}

if ($layout == 'style_02'){
	$size = 'medium-image';
}

$layout_args = array(
	'size' => $size,
	'show_image' => $show_image,
	'show_icon' => $show_icon
);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'posts', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/posts/assets/css/posts'.$min_suffix.'.css'), array(), false, 'all');
}

?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php $this->the_title($title,$title_style,$title_size,$title_align,$title_scheme); ?>
	<?php if ($r->have_posts()): ?>
		<div class="<?php echo esc_attr($css_content_class);?>" <?php echo implode(' ', $content_attributes) ?>>
			<?php while ( $r->have_posts() ) : $r->the_post();
					if ($layout == 'style_05') {
						G5plus_FrameWork::g5plus_get_template('shortcodes/posts/content-flat');
					} elseif ($layout == 'style_06') {
						G5plus_FrameWork::g5plus_get_template('shortcodes/posts/content-flat-2');
					} else {
						G5plus_FrameWork::g5plus_get_template('shortcodes/posts/content',$layout_args);
					}
			 endwhile; ?>
		</div>
	<?php else: ?>
		<div class="item-not-found"><?php esc_html_e('No item found','g5plus-orson'); ?></div>
	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>