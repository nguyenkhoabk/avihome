<?php
/**
 * @var $customize_location
 */
$customize = &G5Plus_Global::get_header_customize_var();
$location = 'header_customize_' . $customize_location . '_text';
?>
<div class="header-customize-item item-custom-text">
	<?php echo wp_kses_post($customize[$location]); ?>
</div>