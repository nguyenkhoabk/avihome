<?php
/**
 * The template for displaying content masonry
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$size = 'full';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-masonry clearfix'); ?>>
	<?php g5plus_get_post_thumbnail($size); ?>
	<div class="entry-content-wrap">
		<h3 class="entry-post-title"><a class="text-color-bold" title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="entry-excerpt text-color-light">
			<?php the_excerpt(); ?>
		</div>
		<div class="entry-meta-wrap clearfix">
			<?php g5plus_the_post_meta(); ?>
			<a href="<?php echo get_permalink() ?>" class="read-more btn btn-sm"><?php esc_html_e('Read more','g5plus-orson'); ?></a>
		</div>
	</div>
</article>
