<?php
$top_drawer = &G5Plus_Global::get_top_drawer_var();
if ((!$top_drawer['top_drawer_type']) || ($top_drawer['top_drawer_type'] === 'none')) {
	return;
}

if (!is_active_sidebar($top_drawer['top_drawer_sidebar'])) {
	return;
}

$top_drawer_class = array(
	'top-drawer-wrapper',
	'top-drawer-type-' . esc_attr($top_drawer['top_drawer_type'])
);
if ($top_drawer['top_drawer_hide_mobile']) {
	$top_drawer_class[] = 'top-drawer-mobile-invisible';
}

$top_drawer_container_class = array('top-drawer-container');
if ($top_drawer['top_drawer_wrapper_layout'] && ($top_drawer['top_drawer_wrapper_layout'] !== 'full')) {
	$top_drawer_container_class[] = esc_attr($top_drawer['top_drawer_wrapper_layout']);
}
?>
<div class="<?php echo join(' ', $top_drawer_class); ?>">
	<div class="<?php echo join(' ', $top_drawer_container_class); ?>">
		<div class="top-drawer-inner">
			<?php dynamic_sidebar($top_drawer['top_drawer_sidebar']); ?>
		</div>
	</div>
	<?php if ($top_drawer['top_drawer_type'] === 'toggle'): ?>
		<span class="top-drawer-toggle"><i class="fa fa-plus"></i></span>
	<?php endif;?>
</div>
