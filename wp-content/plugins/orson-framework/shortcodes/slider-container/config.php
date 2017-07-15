<?php
return array(
	'name' => esc_html__('Slider Container', 'g5plus-orson'),
	'base' => 'g5plus_slider_container',
	'icon' => 'fa fa-ellipsis-h',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'as_parent' => array('except' => 'g5plus_slider_container'),
	'content_element' => true,
	'show_settings_on_create' => true,
	'params' => array(
		array_merge(g5plus_vc_map_add_navigation(),array(
			'dependency' => array()
		)),
		array_merge(g5plus_vc_map_add_pagination(),array(
			'dependency' => array()
		)),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Loop Infinite ?', 'g5plus-orson'),
			'param_name' => 'infinite',
			'std' => 'true',
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),
		g5plus_vc_map_add_navigation_position(),
		g5plus_vc_map_add_navigation_style(),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns gap', 'g5plus-orson' ),
			'param_name' => 'gap',
			'value' => array(
				'0px' => '0',
				'10px' => '10',
				'20px' => '20',
				'30px' => '30',
			),
			'std' => '20',
			'description' => esc_html__( 'Select gap between columns in row.', 'g5plus-orson' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Items Desktop', 'g5plus-orson'),
			'param_name' => 'items_lg',
			'description' => esc_html__('Browser Width > 1199', 'g5plus-orson'),
			'value' => '',
			'std' => '5',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Items Desktop Small', 'g5plus-orson'),
			'param_name' => 'items_md',
			'description' => esc_html__('Browser Width < 1199', 'g5plus-orson'),
			'value' => '',
			'std' => '4',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Items Tablet', 'g5plus-orson'),
			'param_name' => 'items_sm',
			'description' => esc_html__('Browser Width < 992', 'g5plus-orson'),
			'value' => '',
			'std' => '3',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Items Tablet Small', 'g5plus-orson'),
			'param_name' => 'items_xs',
			'description' => esc_html__('Browser Width < 768', 'g5plus-orson'),
			'value' => '',
			'std' => '2',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Items Mobile', 'g5plus-orson'),
			'param_name' => 'items_mb',
			'description' => esc_html__('Browser Width < 480', 'g5plus-orson'),
			'value' => '',
			'std' => '1',
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	),
	'js_view' => 'VcColumnView'
);