<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */

$page_layouts = &G5Plus_Global::get_page_layout();
$sidebar_class = array('primary-sidebar', 'sidebar');
$has_sidebar = false;
if (is_active_sidebar($page_layouts['sidebar']) && ($page_layouts['sidebar_layout'] != 'none')) {
	$has_sidebar = true;
	$sidebar_col = 3;
	if ($page_layouts['sidebar_width'] == 'large') {
		$sidebar_col = 4;
	}
	$sidebar_class[] = 'col-md-'.$sidebar_col;
	if ($page_layouts['sidebar_layout'] == 'left') {
		$sidebar_class[] = 'col-md-pull-'.(12-$sidebar_col);
	}

	if ($page_layouts['sidebar_mobile_enable'] == 0) {
		$sidebar_class[] = 'hidden-sm hidden-xs';
	}
}
?>
<?php if ($has_sidebar): ?>
	<?php
	if ( $page_layouts['sidebar_mobile_enable'] == 1 && $page_layouts['sidebar_mobile_canvas'] == 1 ) { ?>
		<div class="sidebar-mobile-canvas-icon"
		     title="<?php esc_attr_e('Click to show Canvas Sidebar', 'g5plus-orson' ) ?>">
			<i class="fa fa-sliders"></i>
		</div>
		<div class="<?php echo esc_attr(join(' ',$sidebar_class)); ?> sidebar-mobile-canvas">
			<div class="sidebar-mobile-canvas-icon-close"
			     title="<?php esc_attr_e('Click to hide Canvas Sidebar', 'g5plus-orson' ) ?>">
				<i class="fa fa-close"></i>
			</div>
	<?php } else {?>
		<div class="<?php echo esc_attr(join(' ',$sidebar_class)); ?>">
	<?php }?>
			<?php dynamic_sidebar( $page_layouts['sidebar'] );?>
		</div>
<?php endif; ?>

