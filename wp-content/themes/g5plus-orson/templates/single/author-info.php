<?php
/**
 * The template for displaying author info
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$single_author_info_enable = G5Plus_Global::get_option('single_author_info_enable');
if (!$single_author_info_enable) return;
?>
<div class="author-info clearfix">
	<h4 class="widget-title"><span><?php esc_html_e('Author','g5plus-orson') ?></span></h4>
	<div class="author-info-inner">
		<div class="author-avatar">
			<?php
			/**
			 * Filter the Orson author bio avatar size.
			 *
			 * @since Orson 1.0
			 *
			 * @param int $size The avatar height and width size in pixels.
			 */
			$author_bio_avatar_size = apply_filters( 'g5plus_author_bio_avatar_size', 80 );
			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
			?>
		</div><!-- .author-avatar -->
		<div class="author-description">
			<h2 class="author-title text-color-medium"><?php the_author_posts_link(); ?></h2>
			<p class="author-bio text-color-light">
				<?php the_author_meta( 'description' ); ?>
			</p><!-- .author-bio -->
		</div><!-- .author-description -->
	</div>
</div><!-- .author-info -->
