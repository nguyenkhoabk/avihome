<?php
/**
 * The template for displaying breadcrumb
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */
?>
<?php if (!is_front_page()) : ?>
	<?php g5plus_get_breadcrumb(); ?>
<?php else: ?>
	<ul class="breadcrumbs">
		<li><a href="<?php echo home_url('/') ?>" class="home"><?php esc_html_e('Home','g5plus-orson');?></a></li>
		<li><span><?php esc_html_e('Blog', 'g5plus-orson'); ?></span></li>
	</ul>
<?php endif; ?>
