<?php
/**
 * @var $customize_location
 */
$customize = &G5Plus_Global::get_header_customize_var();
$location = 'header_customize_' . $customize_location . '_sidebar';
if (!is_active_sidebar($customize[$location])) {
	return;
}
?>
<div class="header-customize-item item-sidebar">
	<?php dynamic_sidebar($customize[$location]) ?>
</div>