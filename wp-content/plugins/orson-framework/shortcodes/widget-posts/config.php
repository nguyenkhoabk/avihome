<?php
return array(
	'base' => 'g5plus_widget_posts',
	'name' => esc_html__('Widget Posts','g5plus-orson'),
	'icon' => 'fa fa-file-text-o',
	'category' => G5PLUS_FRAMEWORK_WIDGET_CATEGORY,
	'params' => array(
		g5plus_vc_map_add_widget_layout(),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'g5plus-orson' ),
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'g5plus-orson' ),
			'value' => '',
		),

		array(
			'type' => 'select2',
			'heading' => esc_html__('Source', 'g5plus-orson'),
			'param_name' => 'source',
			'options' => array(
			    esc_html__('Random','g5plus-orson') => 'random',
				esc_html__('Popular','g5plus-orson') => 'popular',
				esc_html__('Recent', 'g5plus-orson' ) => 'recent',
				esc_html__('Oldest','g5plus-orson') => 'oldest'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of posts', 'g5plus-orson' ),
			'description' => esc_html__('Enter number of posts to display.', 'g5plus-orson' ),
			'param_name' => 'number',
			'value' => 5,
			'admin_label' => true,
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	),
);