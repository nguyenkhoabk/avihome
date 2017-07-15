<?php
/**
 * The template for displaying content single
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$size = 'large-image';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-single clearfix'); ?>>
	<?php g5plus_get_post_thumbnail( $size, 0, true ); ?>
	<div class="entry-content-wrap">
		<h3 class="entry-post-title text-color-bold"><?php the_title(); ?></h3>
		<?php g5plus_the_post_meta(); ?>
		<div class="entry-content clearfix">
			<?php
			the_content();
			wp_link_pages(array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:','g5plus-orson') . '</span>',
				'after' => '</div>',
				'link_before' => '<span class="page-link">',
				'link_after' => '</span>',
			)); ?>
		</div>
		<?php
			$single_tag_enable = G5Plus_Global::get_option('single_tag_enable');
			if ($single_tag_enable) {
				the_tags('<div class="entry-meta-tag tagcloud"><label class="label">'.esc_html__('Tags','g5plus-orson') .' </label>', '', '</div>');
			}
			$single_share_enable = G5Plus_Global::get_option('single_share_enable');
			if ($single_share_enable) {
				g5plus_the_social_share();
			} ?>
	</div>
	<?php
	/**
	 * @hooked - g5plus_post_nav - 10
	 * @hooked - g5plus_post_author_info - 15
	 * @hooked - g5plus_post_comment - 20
	 * @hooked - g5plus_post_related - 30
	 *
	 **/
	do_action('g5plus_after_single_post');
	?>
</article>

