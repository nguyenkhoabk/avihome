<?php
/**
 * The template for displaying content none
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
?>
<div class="no-results not-found">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<p><?php printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'g5plus-orson' )), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif (is_search()) : ?>
		<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'g5plus-orson' ); ?></p>
		<?php get_search_form(); ?>
	<?php else: ?>
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'g5plus-orson' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>