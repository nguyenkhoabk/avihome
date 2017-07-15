<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$wp_query = &G5Plus_Global::get_wp_query();
$post_layouts = &G5Plus_Global::get_post_layout();
?>
<?php if (have_posts()): ?>
	<div class="blog-wrap clearfix">
		<?php
		while ( have_posts() ) : the_post();
			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			g5plus_get_template( 'archive/content-'. $post_layouts['layout'] );
		endwhile; ?>
	</div>
<?php else: ?>
	<?php g5plus_get_template( 'archive/content-none'); ?>
<?php endif; ?>
<?php if ($wp_query->max_num_pages > 1) {
	switch($post_layouts['paging']){
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
