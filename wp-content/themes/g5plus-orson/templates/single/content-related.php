<?php
/**
 * The template for displaying content related
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$size = 'medium-image';
$noImage = G5Plus_Global::get_option('single_related_enable_no_image',0);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-related clearfix'); ?>>
	<?php g5plus_get_post_thumbnail( $size, $noImage ); ?>
	<div class="entry-content-wrap">
		<?php if (has_post_format('video')): ?>
			<i class="pe-7s-film"></i>
		<?php elseif (has_post_format('image')): ?>
			<i class="pe-7s-photo"></i>
		<?php elseif (has_post_format('gallery')): ?>
			<i class="pe-7s-photo-gallery"></i>
		<?php else: ?>
			<i class="pe-7s-news-paper"></i>
		<?php endif; ?>
		<div class="entry-content-inner">
			<h3 class="entry-post-title"><a class="text-color-bold" title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="text-color-light entry-date"><?php the_time(get_option('date_format')); ?></p>

			<div class="entry-excerpt text-color-light">
				<?php echo g5plus_string_limit_words(get_the_excerpt(), 15);?>&hellip;<a class="text-color-accent" title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php esc_html_e('Read more','g5plus-orson') ?></a>
			</div>
		</div>
	</div>
</article>
