<?php
return array(
	'base' => 'g5plus_product_categories_box',
	'name' => esc_html__('Product Categories Box','g5plus-orson'),
	'icon' => 'fa fa-product-hunt',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'description' => esc_html__('Display product categories box','g5plus-orson'),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'g5plus-orson'),
			'param_name' => 'layout',
			"admin_label" => true,
			'value' => array(
				esc_html__('Vertical', 'g5plus-orson') => 'vertical',
				esc_html__('Horizontal', 'g5plus-orson') => 'horizontal'
			)
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Image', 'g5plus-orson'),
			'param_name' => 'image',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'g5plus-orson'),
			'param_name' => 'title',
			"admin_label" => true,
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Description', 'g5plus-orson'),
			'param_name' => 'description',
			'dependency' => array('element' => 'layout', 'value' => 'horizontal')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Badge', 'g5plus-orson'),
			'param_name' => 'badge',
		),
		array(
			'type' => 'autocomplete',
			'heading' => esc_html__( 'Categories', 'g5plus-orson' ),
			'param_name' => 'category',
			'settings' => array(
				'multiple' => true,
				'sortable' => true,
				'unique_values' => true,
			),
			'save_always' => true,
			'description' => esc_html__( 'Enter List of Product Categories', 'g5plus-orson' ),
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class()
	)
);