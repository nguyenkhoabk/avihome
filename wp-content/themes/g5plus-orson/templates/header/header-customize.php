<?php
$customize = &G5Plus_Global::get_header_customize_var();
$wrapper_class = array('header-customize-wrapper');
$wrapper_class[] = 'header-customize-' . $customize_location;
$header_customize = array();
if (isset($customize['header_customize_' . $customize_location]) && isset($customize['header_customize_' . $customize_location]['enabled'])) {
	foreach ($customize['header_customize_' . $customize_location]['enabled'] as $key => $value) {
		$header_customize[] = $key;
	}
}
?>
<?php if (count($header_customize) > 0): ?>
	<div class="<?php echo join(' ', $wrapper_class); ?>">
		<?php foreach ($header_customize as $key): ?>
			<?php if (!in_array($key, array('email', 'phone', 'sidebar', 'shopping-cart', 'search', 'custom-text'))) { continue; } ?>
			<?php g5plus_get_template('header/customize-' . $key, array('customize_location' => $customize_location)); ?>
		<?php endforeach;?>
	</div>
<?php endif;?>