<?php
$footer = &G5Plus_Global::get_footer_var();
if (!$footer['bottom_bar_visible']) {
	return;
}

$left_sidebar = $footer['bottom_bar_left_sidebar'];
$right_sidebar = $footer['bottom_bar_right_sidebar'];
if ('bottom-bar-4' == $footer['bottom_bar_layout']) {
	$right_sidebar = '';
}

$bottom_bar_matrix = array(
	'bottom-bar-1' => array('col-md-6', 'col-md-6'),
	'bottom-bar-2' => array('col-md-8', 'col-md-4'),
	'bottom-bar-3' => array('col-md-4', 'col-md-8'),
	'bottom-bar-4' => array('col-md-12', 'col-md-12'),
);
$col_left_sidebar = $bottom_bar_matrix[$footer['bottom_bar_layout']][0];
$col_right_sidebar = $bottom_bar_matrix[$footer['bottom_bar_layout']][1];


if (!is_active_sidebar($left_sidebar) || !is_active_sidebar($right_sidebar)) {
	$col_right_sidebar = 'col-md-12';
	$col_left_sidebar = 'col-md-12';
}
$bottom_bar_class = array('bottom-bar-wrapper', 'bar-wrapper');
if ($footer['bottom_bar_layout'] === 'bottom-bar-4') {
	$bottom_bar_class[] = 'text-center';
}

if ($footer['bottom_bar_border_top'] !== 'none') {
	$bottom_bar_class[] = $footer['bottom_bar_border_top'];
}
$exists_bottom_bar = is_active_sidebar($left_sidebar) || is_active_sidebar($right_sidebar);
?>
<?php if ($exists_bottom_bar): ?>
	<div class="<?php echo join(' ', $bottom_bar_class); ?>">
		<div class="<?php echo esc_attr($footer['footer_container_layout']); ?>">
			<div class="bottom-bar-inner">
				<div class="row">
					<?php if (is_active_sidebar($left_sidebar)): ?>
						<div class="bottom-bar-left bar-left <?php echo esc_attr($col_left_sidebar); ?>">
							<?php dynamic_sidebar( $left_sidebar );?>
						</div>
					<?php endif;?>
					<?php if (is_active_sidebar($right_sidebar)): ?>
						<div class="bottom-bar-right bar-right <?php echo esc_attr($col_right_sidebar); ?>">
							<?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php endif;?>
					</div>
			</div>
		</div>
	</div>
<?php endif;?>