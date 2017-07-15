<?php
/**
 * The template for displaying content flat
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$size = 'medium-image';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-flat clearfix'); ?>>
	<?php g5plus_get_post_thumbnail($size,1); ?>
	<div class="entry-content-wrap">
		<div class="entry-post-meta clearfix">
			<div class="entry-meta-date"><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></div>
			<div class="entry-meta-author">
				<i class="fa fa-user"></i> <?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),esc_html( get_the_author() )); ?>
			</div>
		</div>
		<h3 class="entry-post-title"><a title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="entry-excerpt text-color-light">
			<?php if (function_exists('g5plus_string_limit_words')): ?>
				<?php echo g5plus_string_limit_words(get_the_excerpt(), 25);?>
			<?php endif; ?>
		</div>
		<a class="entry-read-more" title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php esc_html_e('Read more','g5plus-orson') ?></a>
	</div>
</article>
