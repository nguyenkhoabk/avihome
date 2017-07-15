<?php
$header = &G5Plus_Global::get_header_var();
$header_class = array('main-header');
if ($header['header_float']) {
	$header_class[] = 'header-float';
}
if ($header['header_border_bottom'] != 'none') {
	$header_class[] = $header['header_border_bottom'];
}
$header_class[] = $header['header_layout'];

?>
<header class="<?php echo join(' ', $header_class); ?>">
	<?php g5plus_get_template('header/top-bar'); ?>
	<?php g5plus_get_template('header/' . $header['header_layout']); ?>
</header>