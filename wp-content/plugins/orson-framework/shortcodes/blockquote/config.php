<?php
return array(
	'base' => 'g5plus_blockquote',
	'name' => esc_html__('BlockQuote','g5plus-orson'),
	'icon' => 'fa fa-quote-left',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'g5plus-orson'),
			'param_name' => 'layout',
			"admin_label" => true,
			'std' => 'border_left',
			'value' => array(
				esc_html__('Border Left', 'g5plus-orson') => 'border_left',
				esc_html__('Border Left Primary', 'g5plus-orson') => 'border_left_primary',
				esc_html__('Border Round', 'g5plus-orson') => 'border_round',
				esc_html__('Border Round Large', 'g5plus-orson') => 'border_round_large'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Border size','g5plus-framework'),
			'param_name' => 'border_size',
			'value' => array(
				esc_html__('Small','g5plus-framework') => 'sm',
				esc_html__('Normal','g5plus-framework') => 'md'
			),
			'std' => 'md',
			'dependency' => array(
				'element' => 'layout',
				'value' => array('border_left','border_left_primary'),
			),
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Content', 'g5plus-orson' ),
			'param_name' => 'quote_content',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Author Name', 'g5plus-orson' ),
			'param_name' => 'author_name',
			'value' => '',
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Author (Link)', 'g5plus-orson' ),
			'param_name' => 'author_link',
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class()
	),
);