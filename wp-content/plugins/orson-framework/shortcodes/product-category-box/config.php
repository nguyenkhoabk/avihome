<?php
return array(
	'base' => 'g5plus_product_category_box',
	'name' => esc_html__('Product Category Box','g5plus-orson'),
	'icon' => 'fa fa-product-hunt',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'description' => esc_html__('Display product category box','g5plus-orson'),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout Style', 'g5plus-orson'),
			'param_name' => 'layout_style',
			'admin_label' => true,
			'value' => array(
				esc_html__('Image and Information', 'g5plus-orson') => '',
				esc_html__('Image', 'g5plus-orson') => 'pcb-image'),
			'description' => esc_html__('Select Layout Style.', 'g5plus-orson')
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Background', 'g5plus-orson'),
			'param_name' => 'image',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'g5plus-orson'),
			'param_name' => 'title',
			"admin_label" => true,
			'dependency' => array('element' => 'layout_style','value' => array('')),
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Description', 'g5plus-orson'),
			'param_name' => 'description',
			'dependency' => array('element' => 'layout_style','value' => array('')),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text', 'g5plus-orson' ),
			'param_name' => 'title_bt',
			'description' => esc_html__('Text on the button', 'g5plus-orson' ),
			'admin_label' => true,
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'g5plus-orson' ),
			'param_name' => 'link',
			'description' => esc_html__('Add link to button.', 'g5plus-orson' ),
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class()
	)
);