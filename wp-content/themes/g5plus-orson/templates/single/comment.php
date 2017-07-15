<?php
/**
 * The template for displaying comment item
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
		<div class="comment-meta-wrap clearfix">
			<span class="author-name text-color-medium"><?php printf('%s', get_comment_author_link()) ?></span>
			<div class="comment-meta">
				<?php edit_comment_link(esc_html__('Edit','g5plus-orson')); ?>
				<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
		<?php echo get_avatar($comment, $args['avatar_size']); ?>
		<div class="comment-text entry-content">
			<div class="text text-color-light">
				<?php comment_text() ?>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php esc_html_e('Your comment is awaiting moderation.','g5plus-orson');?></em>
				<?php endif; ?>
			</div>
		</div>
	</div>

