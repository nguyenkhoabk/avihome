<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pages'); ?>>
    <div class="entry-content clearfix">
        <?php
        the_content();
        wp_link_pages(array(
	        'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:','g5plus-orson') . '</span>',
	        'after' => '</div>',
	        'link_before' => '<span class="page-link">',
	        'link_after' => '</span>',
        ));
        ?>
    </div><!-- .entry-content -->

	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>
</article><!-- #post-## -->
