<?php
/**
 * The template for displaying post meta
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
?>
<div class="entry-post-meta">
	<div class="entry-meta-date"><i class="fa fa-calendar-o"></i> <?php the_time(get_option('date_format')); ?></div>
	<div class="entry-meta-author">
		<i class="fa fa-user"></i> <span><?php esc_html_e('Posted by','g5plus-orson') ?></span> <?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),esc_html( get_the_author() )); ?>
	</div>
	<?php if (has_category()): ?>
		<div class="entry-meta-cat"><i class="fa fa-folder-open"></i> <span><?php esc_html_e('in','g5plus-orson') ?></span> <?php the_category(' | ');?></div>
	<?php endif; ?>
	<?php if ( comments_open() || get_comments_number() ) : ?>
		<div class="entry-meta-comment">
			<?php comments_popup_link( wp_kses_post(__('<i class="fa fa-comments"></i> 0 comments','g5plus-orson')), wp_kses_post(__('<i class="fa fa-comments"></i> 1 comment','g5plus-orson')), wp_kses_post(__('<i class="fa fa-comments"></i> % comments','g5plus-orson')), '', ''); ?>
		</div>
	<?php endif; ?>
	<?php edit_post_link(esc_html__( 'Edit', 'g5plus-orson' ), '<div class="edit-link"><i class="fa fa-pencil"></i> ', '</div>' ); ?>
</div>
