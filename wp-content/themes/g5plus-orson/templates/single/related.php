<?php
/**
 * The template for displaying post related
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
global $post;
$single_related_post_enable = G5Plus_Global::get_option('single_related_post_enable');
if (!$single_related_post_enable) return;
$single_related_post_condition = G5Plus_Global::get_option('single_related_post_condition',array());
$related_by_category = isset($single_related_post_condition['category']) && $single_related_post_condition['category'] == 1 ? true : false;
$related_by_tag = isset($single_related_post_condition['tag']) && $single_related_post_condition['tag'] == 1 ? true : false;
$single_related_post_total = G5Plus_Global::get_option('single_related_post_total');
$single_related_post_column = G5Plus_Global::get_option('single_related_post_column');

$tag_slugs = wp_get_post_tags($post->ID, array('fields' => 'slugs'));
$cat_ids = wp_get_post_terms($post->ID, 'category', array('fields' => 'term_id'));
if (count($tag_slugs) == 0 && count($cat_ids) == 0) return;

$args = array(
	'numberposts'         => $single_related_post_total,
	'ignore_sticky_posts' => 1,
	'post__not_in'        => array($post->ID),
	'tax_query'           => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array('post-format-quote', 'post-format-link'),
			'operator' => 'NOT IN'
		)
	)
);

if ($related_by_category && isset($cat_ids) && count($cat_ids) > 0) {
	$args['category__in'] = $cat_ids;
}

if ($related_by_tag && isset($tag_slugs) && count($tag_slugs) > 0) {
	$args['tax_query'][] = array(
		'taxonomy' => 'post_tag',
		'field'    => 'slug',
		'terms'    => $tag_slugs,
		'operator' => 'IN'
	);
}

$args = apply_filters('g5plus_related_post_args', $args);
$posts = get_posts($args);
if (sizeof($posts) == 0) return;

$owl_responsive_attributes = array();
$owl_responsive_attributes[] = '"0" : {"items" : 1, "margin": 0}';
$owl_responsive_attributes[] = '"600" : {"items" : 2, "margin": 20}';
$owl_responsive_attributes[] = '"992" : {"items" : 3, "margin": 20}';
$owl_responsive_attributes[] = '"1200" : {"items" : '. $single_related_post_column  .', "margin": 20}';
$owl_attributes = array(
	'"autoHeight": true',
	'"dots": false',
	'"nav": true',
	'"responsive": {'. implode(', ', $owl_responsive_attributes) . '}'
);
?>
<div class="post-related-wrap mg-top-40 clearfix">
	<h4 class="widget-title"><span><?php esc_html_e('Related Posts','g5plus-orson') ?></span></h4>
	<div class="owl-carousel owl-nav-top" data-owl-config='{<?php echo esc_attr(implode(', ', $owl_attributes)); ?>}'>
		<?php foreach ($posts as $item): setup_postdata( $GLOBALS['post'] = &$item );?>
			<?php g5plus_get_template('single/content-related'); ?>
		<?php endforeach; ?>
	</div>
</div>
<?php wp_reset_postdata(); ?>
