<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 20/5/2016
 * Time: 3:57 PM
 */
return array(
	'name' => esc_html__('Countdown', 'g5plus-orson'),
	'base' => 'orson_countdown',
	'class' => '',
	'icon' => 'fa fa-clock-o',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'datetimepicker',
			'heading' => esc_html__('Time Off', 'g5plus-orson'),
			'param_name' => 'time',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Color Scheme', 'g5plus-orson'),
			'param_name' => 'color_scheme',
			'admin_label' => true,
			'value' => array(
				esc_html__('Light', 'g5plus-orson') => '',
				esc_html__('Dark', 'g5plus-orson') => 'cl_dark',
				esc_html__('Primary', 'g5plus-orson') => 'cl_primary'),
			'description' => esc_html__('Select Color Scheme.', 'g5plus-orson')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Size', 'g5plus-orson'),
			'param_name' => 'size',
			'admin_label' => true,
			'value' => array(
				esc_html__('Normal', 'g5plus-orson') => '',
				esc_html__('Large', 'g5plus-orson') => 's_large'),
			'description' => esc_html__('Select Size', 'g5plus-orson')
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	)
);