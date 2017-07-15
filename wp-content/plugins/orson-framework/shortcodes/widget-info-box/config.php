<?php
return array(
	'base' => 'g5plus_widget_info_box',
	'name' => esc_html__('Widget Info Box','g5plus-orson'),
	'icon' => 'fa fa-info-circle',
	'category' => G5PLUS_FRAMEWORK_WIDGET_CATEGORY,
	'params' => array(
		g5plus_vc_map_add_widget_layout(),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'g5plus-orson' ),
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'g5plus-orson' ),
			'value' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'g5plus-orson'),
			'param_name' => 'style',
			'value' => array(
				esc_html__('Icon Classic', 'g5plus-orson') => 'classic',
				esc_html__('Icon Round', 'g5plus-orson') => 'round',
			),
			'std' => 'classic',
			'admin_label' => true
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__('Values','g5plus-orson'),
			'param_name' => 'values',
			'description' => esc_html__('Enter values for icon - title and description','g5plus-orson'),
			'value' => '',
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'g5plus-orson' ),
					'param_name' => 'title',
					'value' => '',
					'admin_label' => true
				),
				array_merge(g5plus_vc_map_add_icon_font(),array('param_name' => 'icon')),
				array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Description', 'g5plus-orson' ),
					'param_name' => 'description',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link', 'g5plus-orson' ),
					'param_name' => 'link',
					'value' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Read more text', 'g5plus-orson' ),
					'param_name' => 'read_more',
					'value' => '',
				),
			)
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	),
);