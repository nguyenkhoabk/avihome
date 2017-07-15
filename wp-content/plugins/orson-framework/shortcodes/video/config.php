<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 28/5/2016
 * Time: 8:27 AM
 */
return array(
	'name' => esc_html__( 'Video', 'g5plus-orson' ),
	'base' => 'g5plus_video',
	'icon' => 'fa fa-play-circle',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon Style', 'g5plus-orson'),
			'param_name' => 'layout_style',
			'admin_label' => true,
			'value' => array(
				esc_html__('Icon Play', 'g5plus-orson') => 'style_01',
				esc_html__('Icon Play - border ', 'g5plus-orson') => 'style_02'
			),
			'description' => esc_html__('Select Icon Style.', 'g5plus-orson')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Link', 'g5plus-orson' ),
			'param_name' => 'link',
			'value' => '',
			'description' => esc_html__( 'Enter link video', 'g5plus-orson' ),
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	)
);