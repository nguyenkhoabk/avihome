<?php
/**
 * The template for displaying content
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */

/**
 * @var $size
 * @var $show_image
 * @var $show_icon
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-related clearfix'); ?>>
	<?php if ($show_image && function_exists('g5plus_get_post_thumbnail')) {
		g5plus_get_post_thumbnail($size,1);
	} ?>
	<div class="entry-content-wrap">
		<?php if ($show_icon): ?>
			<?php if (has_post_format('video')): ?>
				<i class="pe-7s-film"></i>
			<?php elseif (has_post_format('image')): ?>
				<i class="pe-7s-photo"></i>
			<?php elseif (has_post_format('gallery')): ?>
				<i class="pe-7s-photo-gallery"></i>
			<?php else: ?>
				<i class="pe-7s-news-paper"></i>
			<?php endif; ?>
		<?php endif; ?>
		<div class="entry-content-inner">
			<h3 class="entry-post-title"><a class="text-color-bold" title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="text-color-light entry-date"><?php the_time(get_option('date_format')); ?></p>

			<div class="entry-excerpt text-color-light">
				<?php if (function_exists('g5plus_string_limit_words')): ?>
					<?php echo g5plus_string_limit_words(get_the_excerpt(), 14);?>&hellip;<a class="text-color-accent" title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php esc_html_e('Read more','g5plus-orson') ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>