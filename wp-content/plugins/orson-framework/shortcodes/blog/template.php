<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout
 * @var $columns
 * @var $max_items
 * @var $post_paging
 * @var $posts_per_page
 * @var $orderby
 * @var $order
 * @var $meta_key
 * @var $category
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Blog
 */

$layout = $columns = $max_items = $post_paging = $posts_per_page = $orderby = $order = $meta_key = $category = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $wp_query;
$wrapper_classes = array(
	'archive-wrap',
	'clearfix',
	$this->getExtraClass( $el_class )
);


$wrapper_classes[] = 'archive-' . $layout;
if (in_array($layout,array('masonry'))) {
	$wrapper_classes[] = 'archive-columns-' . $columns;
}

if (is_front_page()) {
	$paged   = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
} else {
	$paged   = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
}

$args = array(
	'post_type'=> 'post',
	'paged' => $paged,
	'ignore_sticky_posts' => true,
	'posts_per_page' => $max_items > 0 ? $max_items : $posts_per_page,
	'orderby' => $orderby,
	'order' => $order,
	'meta_key' => $orderby == 'meta_key' ? $meta_key : '',
);

if ($post_paging == 'all' && $max_items == -1) {
	$args['nopaging'] = true;
}

if (!empty($category)) {
	$args['tax_query'] = array(
		array(
			'taxonomy' 		=> 'category',
			'terms' 		=>  explode(',',$category),
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		)
	);
}
query_posts($args);


$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>
<div class="<?php echo esc_attr($css_class) ?>">
	<div class="blog-wrap clearfix">
		<?php
		if ( have_posts() ) :
			// Start the Loop.
			while ( have_posts() ) : the_post();
				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				g5plus_get_template( 'archive/content-'. $layout );
			endwhile;
		else :
			// If no content, include the "No posts found" template.
			g5plus_get_template( 'archive/content-none');
		endif;
		?>
	</div>
	<?php if ($wp_query->max_num_pages > 1 && $max_items == -1) {
		switch($post_paging){
			case 'load-more':
				g5plus_paging_load_more();
				break;
			case 'infinite-scroll':
				g5plus_paging_infinite_scroll();
				break;
			default:
				g5plus_paging_navigation();
				break;
		}
	}?>
</div>
<?php wp_reset_query(); ?>