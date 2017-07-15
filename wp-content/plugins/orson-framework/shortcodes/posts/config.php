<?php
return array(
	'base' => 'g5plus_posts',
	'name' => esc_html__('Posts','g5plus-orson'),
	'icon' => 'fa fa-file-text',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array_merge(g5plus_vc_map_add_heading_title(),array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout Style', 'g5plus-orson'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Classic','g5plus-orson') => 'style_01',
				esc_html__('Boxed','g5plus-orson') => 'style_02',
				esc_html__('Classic icon', 'g5plus-orson' ) => 'style_03',
				esc_html__('Classic icon without image','g5plus-orson') => 'style_04',
				esc_html__('Flat','g5plus-orson') => 'style_05',
				esc_html__('Flat 2','g5plus-orson') => 'style_06'
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'admin_label' => true,
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Icon light?', 'g5plus-orson' ),
			'param_name' => 'icon_light',
			'dependency' => array('element' => 'layout', 'value' => array('style_03','style_04')),
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),

		g5plus_vc_map_add_narrow_category(),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Source', 'g5plus-orson'),
			'param_name' => 'source',
			'value' => array(
				esc_html__('Random','g5plus-orson') => 'random',
				esc_html__('Popular','g5plus-orson') => 'popular',
				esc_html__('Recent', 'g5plus-orson' ) => 'recent',
				esc_html__('Oldest','g5plus-orson') => 'oldest'
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of posts', 'g5plus-orson' ),
			'description' => esc_html__('Enter number of posts to display.', 'g5plus-orson' ),
			'param_name' => 'number',
			'value' => 5,
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'g5plus-orson'),
			'param_name' => 'columns',
			'value' => array( '1' => 1, '2' => 2 , '3' => 3),
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),
		g5plus_vc_map_add_slider(),
		g5plus_vc_map_add_pagination(),
		g5plus_vc_map_add_navigation(),
		g5plus_vc_map_add_navigation_position(),
		g5plus_vc_map_add_navigation_style(),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Medium devices', 'g5plus-orson'),
			'param_name' => 'items_md',
			'description' => esc_html__('Browser Width >= 992px and < 1200px', 'g5plus-orson'),
			'value' => array( esc_html__('Default','g5plus-orson') => -1, '1' => 1, '2' => 2 , '3' => 3),
			'std' => -1,
			'group' => esc_html__('Responsive','g5plus-orson')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Small devices', 'g5plus-orson'),
			'param_name' => 'items_sm',
			'description' => esc_html__('Browser Width >= 768px and < 991px', 'g5plus-orson'),
			'value' => array( esc_html__('Default','g5plus-orson') => -1, '1' => 1, '2' => 2 , '3' => 3),
			'std' => -1,
			'group' => esc_html__('Responsive','g5plus-orson')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Extra small devices', 'g5plus-orson'),
			'param_name' => 'items_xs',
			'description' => esc_html__('Browser Width >= 480px and < 767px', 'g5plus-orson'),
			'value' => array( esc_html__('Default','g5plus-orson') => -1, '1' => 1, '2' => 2 , '3' => 3),
			'std' => 2,
			'group' => esc_html__('Responsive','g5plus-orson')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Mobile', 'g5plus-orson'),
			'param_name' => 'items_mb',
			'description' => esc_html__('Browser Width < 480px', 'g5plus-orson'),
			'value' => array( esc_html__('Default','g5plus-orson') => -1, '1' => 1, '2' => 2 , '3' => 3),
			'std' => 1,
			'group' => esc_html__('Responsive','g5plus-orson')
		)
	))
);