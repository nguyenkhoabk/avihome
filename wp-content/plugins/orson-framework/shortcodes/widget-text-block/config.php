<?php
return array(
	'base' => 'g5plus_widget_text_block',
	'name' => esc_html__('Widget Text Block','g5plus-orson'),
	'icon' => 'icon-wpb-layer-shape-text',
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
			'type' => 'textarea',
			'heading' => esc_html__( 'Text', 'g5plus-orson' ),
			'param_name' => 'text',
			'value' => '',
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	),
);