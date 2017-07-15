<?php
return array(
	'base' => 'g5plus_product_deals',
	'name' => esc_html__('Product Deals','g5plus-orson'),
	'icon' => 'fa fa-product-hunt',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'description' => esc_html__('Show multiple product sale count down','g5plus-orson'),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'g5plus-orson' ),
			'param_name' => 'title',
			'value' => '',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'g5plus-orson'),
			'param_name' => 'layout',
			"admin_label" => true,
			'std' => 'border-wrap',
			'value' => array(
				esc_html__('Border Wrap', 'g5plus-orson') => 'border-wrap',
				esc_html__('Border Inner', 'g5plus-orson') => 'border-inner'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Show', 'g5plus-orson'),
			'param_name' => 'show',
			"admin_label" => true,
			'value' => array(
				esc_html__('Sale Off', 'g5plus-orson') => 'sale',
				esc_html__('Narrow Products', 'g5plus-orson') => 'products'
			)
		),

		array(
			'type' => 'autocomplete',
			'heading' => esc_html__( 'Narrow Products', 'g5plus-orson' ),
			'param_name' => 'slugs',
			'settings' => array(
				'multiple' => true,
				'sortable' => true,
				'unique_values' => true,
			),
			'save_always' => true,
			'description' => esc_html__( 'Enter List of Products', 'g5plus-orson' ),
			'dependency' => array('element' => 'show','value' => 'products'),
		),
		array_merge(g5plus_vc_map_add_narrow_product_category(),array(
			'dependency' => array('element' => 'show','value_not_equal_to' => array('products'))
		)),

		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of products', 'g5plus-orson' ),
			'description' => esc_html__('Enter number of products to display.', 'g5plus-orson' ),
			'param_name' => 'number',
			'value' => 4,
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'show','value_not_equal_to' => array('products'))
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'g5plus-orson'),
			'param_name' => 'columns',
			'value' => array( '1' => 1, '2' => 2),
			'std' => 1,
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Badge', 'g5plus-orson'),
			'param_name' => 'badge',
			'dependency' => array('element' => 'layout','value' => 'border-wrap')
		),
		array_merge(g5plus_vc_map_add_slider(),array('edit_field_class' => 'vc_col-sm-6 vc_column')) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Rows', 'g5plus-orson'),
			'param_name' => 'rows',
			'value' => array( '1' => 1, '2' => 2 , '3' => 3,'4' => 4),
			'std' => 1,
			'dependency' => array('element' => 'is_slider', 'value' => 'true'),
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	)
);