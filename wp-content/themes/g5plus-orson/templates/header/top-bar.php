<?php
$topBar = &G5Plus_Global::get_top_bar_var();
if (!$topBar['top_bar_enable']) {
	return;
}
$left_sidebar = $topBar['top_bar_left_sidebar'];
$right_sidebar = $topBar['top_bar_right_sidebar'];

if (!is_active_sidebar($left_sidebar) && !is_active_sidebar($right_sidebar)) {
	return;
}

$topBar_Class = array('top-bar-wrapper', 'bar-wrapper');
if ($topBar['top_bar_border'] != 'none') {
	$topBar_Class[] = esc_attr($topBar['top_bar_border']);
}

if ($topBar['top_bar_layout'] == 'top-bar-4') {
	$topBar_Class[] = 'text-center';
}

$topBar_layout_matrix = array(
	'top-bar-1' => array('col-md-6', 'col-md-6'),
	'top-bar-2' => array('col-md-8', 'col-md-4'),
	'top-bar-3' => array('col-md-4', 'col-md-8'),
	'top-bar-4' => array('col-md-12', 'col-md-12')
);
$col_left_sidebar = $topBar_layout_matrix[$topBar['top_bar_layout']][0];
$col_right_sidebar = $topBar_layout_matrix[$topBar['top_bar_layout']][1];


if (!is_active_sidebar($left_sidebar) || !is_active_sidebar($right_sidebar)) {
	$col_right_sidebar = 'col-md-12';
	$col_left_sidebar = 'col-md-12';
}
?>
<div class="<?php echo join(' ', $topBar_Class); ?>">
	<div class="container">
		<div class="top-bar-inner">
			<div class="row">
				<?php if (is_active_sidebar($left_sidebar)): ?>
					<div class="top-bar-left bar-left <?php echo esc_attr($col_left_sidebar); ?>">
						<?php dynamic_sidebar( $left_sidebar );?>
					</div>
				<?php endif;?>
				<?php if (is_active_sidebar($right_sidebar)): ?>
					<div class="top-bar-right bar-right <?php echo esc_attr($col_right_sidebar); ?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
				<?php endif;?>

			</div>
		</div>
	</div>
</div>