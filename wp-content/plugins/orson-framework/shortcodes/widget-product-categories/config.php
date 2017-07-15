<?php
return array(
	'base' => 'g5plus_widget_product_categories',
	'name' => esc_html__('Widget Product Categories','g5plus-orson'),
	'icon' => 'icon-wpb-woocommerce',
	'description' => esc_html__('A list of product categories','g5plus-orson'),
	'category' => G5PLUS_FRAMEWORK_WIDGET_CATEGORY,
	'params' => array(
		g5plus_vc_map_add_widget_layout(),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'g5plus-orson' ),
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'g5plus-orson' ),
			'value' => '',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order by','g5plus-orson'),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__('Category Order','g5plus-orson') => 'order',
				esc_html__('Name','g5plus-orson') => 'name',
			)
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show product counts', 'g5plus-orson'),
			'param_name' => 'count',
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show hierarchy', 'g5plus-orson'),
			'param_name' => 'hierarchical',
			'std' => 'true'
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Hide empty categories', 'g5plus-orson'),
			'param_name' => 'hide_empty',
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor(),
		array(
			'type' => 'hidden',
			'param_name' => 'dropdown',
			'value' => 0
		),
		array(
			'type' => 'hidden',
			'param_name' => 'show_children_only',
			'value' => 0
		),
		array(
			'type' => 'hidden',
			'param_name' => 'widget_id',
			'value' => 'woocommerce_product_categories'
		)
	),
);