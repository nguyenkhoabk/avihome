<?php
/**
 * @var $customize_location
 */
$customize = &G5Plus_Global::get_header_customize_var();
$location = 'header_customize_' . $customize_location . '_email';
if (!$customize[$location]['label'] && !$customize[$location]['value']) {
	return;
}
$wrapper_class = array('header-customize-item', 'item-info', 'item-email');
if (!$customize[$location]['label'] || !$customize[$location]['value']) {
	$wrapper_class[] = 'full-height';
}
?>
<div class="<?php echo join(' ', $wrapper_class); ?>">
	<a href="mailto:<?php echo esc_attr($customize[$location]['value']); ?>"><i class="fa fa-envelope"></i></a>
	<?php if ($customize[$location]['label']): ?>
		<span class="label"><?php echo wp_kses_post($customize[$location]['label']); ?></span>
	<?php endif;?>
	<?php if ($customize[$location]['label']): ?>
		<span class="info"><?php echo wp_kses_post($customize[$location]['value']); ?></span>
	<?php endif;?>
</div>