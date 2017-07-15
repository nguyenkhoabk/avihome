<?php
return array(
	'base' => 'g5plus_heading',
	'name' => esc_html__('Heading','g5plus-orson'),
	'icon' => 'fa fa-header',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text', 'g5plus-orson' ),
			'param_name' => 'title',
			'value' => esc_html__('Text on the heading', 'g5plus-orson' ),
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'g5plus-orson' ),
			'description' => esc_html__('Select heading display style.', 'g5plus-orson' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__('Border Bottom Full', 'g5plus-orson' ) => 'style_01',
				esc_html__('Border Bottom', 'g5plus-orson' ) => 'style_02',
				esc_html__('Background', 'g5plus-orson' ) => 'style_03',
			),
			'std' => '',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Size', 'g5plus-orson' ),
			'description' => esc_html__('Select heading size.', 'g5plus-orson' ),
			'param_name' => 'size',
			'value' => array(
				esc_html__('Normal','g5plus-orson') => 'md',
				esc_html__('Large','g5plus-orson') => 'lg',
			),
			'std' => 'md',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Text Align', 'g5plus-orson' ),
			'param_name' => 'align',
			'description' => esc_html__('Select heading alignment.', 'g5plus-orson' ),
			'value' => array(
				esc_html__('Left', 'g5plus-orson' ) => 'left',
				esc_html__('Right', 'g5plus-orson' ) => 'right',
				esc_html__('Center', 'g5plus-orson' ) => 'center',
			),
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Color Scheme', 'g5plus-orson'),
			'param_name' => 'color_scheme',
			'value' => array(
				esc_html__('Dark', 'g5plus-orson') => 'dark',
				esc_html__('Light', 'g5plus-orson') => 'light'),
			'description' => esc_html__('Select Color Scheme.', 'g5plus-orson')
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	),
);