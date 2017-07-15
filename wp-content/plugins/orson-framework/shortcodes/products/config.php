<?php
return array(
	'base' => 'g5plus_products',
	'name' => esc_html__('Products','g5plus-orson'),
	'icon' => 'fa fa-product-hunt',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'description' => esc_html__('Show multiple products','g5plus-orson'),
	'params' => array_merge(g5plus_vc_map_add_heading_title(), array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Show', 'g5plus-orson'),
			'param_name' => 'show',
			"admin_label" => true,
			'value' => array(
				esc_html__('All', 'g5plus-orson') => 'all',
				esc_html__('Sale Off', 'g5plus-orson') => 'sale',
				esc_html__('New In', 'g5plus-orson') => 'new-in',
				esc_html__('Featured', 'g5plus-orson') => 'featured',
				esc_html__('Top rated', 'g5plus-orson') => 'top-rated',
				esc_html__('Recent review', 'g5plus-orson') => 'recent-review',
				esc_html__('Best Selling', 'g5plus-orson') => 'best-selling',
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
			'value' => 8,
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'show','value_not_equal_to' => array('products'))
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'g5plus-orson'),
			'param_name' => 'columns',
			'value' => array( '1' => 1, '2' => 2 , '3' => 3,'4' => 4, '5' => 5),
			'std' => 4,
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'g5plus-orson'),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__('Date', 'g5plus-orson') => 'date',
				esc_html__('Price', 'g5plus-orson') => 'price',
				esc_html__('Random', 'g5plus-orson') => 'rand',
				esc_html__('Sales', 'g5plus-orson') => 'sales'
			),
			'description' => esc_html__('Select how to sort retrieved products.', 'g5plus-orson'),
			'dependency' => array('element' => 'show','value' => array('all', 'sale', 'featured')),
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sort order', 'g5plus-orson'),
			'param_name' => 'order',
			'value' => array(
				esc_html__('Descending', 'g5plus-orson') => 'DESC',
				esc_html__('Ascending', 'g5plus-orson') => 'ASC'
			),
			'description' => esc_html__('Designates the ascending or descending order.', 'g5plus-orson'),
			'dependency' => array('element' => 'show','value' => array('all', 'sale', 'featured')),
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		g5plus_vc_map_add_slider(),
		g5plus_vc_map_add_pagination(),
		g5plus_vc_map_add_navigation(),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Rows', 'g5plus-orson'),
			'param_name' => 'rows',
			'value' => array( '1' => 1, '2' => 2 , '3' => 3,'4' => 4),
			'std' => 1,
			'dependency' => array('element' => 'is_slider', 'value' => 'true'),
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),
		array_merge( g5plus_vc_map_add_navigation_position(),array('edit_field_class' => 'vc_col-sm-4 vc_column')),
		array_merge( g5plus_vc_map_add_navigation_style(),array('edit_field_class' => 'vc_col-sm-4 vc_column')),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Custom Catalog Style?', 'g5plus-orson' ),
			'param_name' => 'custom_catalog_style_enable',
			'description' => esc_html__('Turn On this option if you want to custom catalog style in Theme Options.', 'g5plus-orson'),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Catalog Style', 'g5plus-orson' ),
			'param_name' => 'product_catalog_style',
			'value' => array(
				esc_html__('Left', 'g5plus-orson') => 'left',
				esc_html__('Center', 'g5plus-orson') => 'center'
			),
			'std' => 'left',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'custom_catalog_style_enable', 'value' => 'true'),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Column Gap', 'g5plus-orson'),
			'param_name' => 'column_gap',
			'value' => array( '20px' => 20, '15px' => 15),
			'std' => 20,
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'custom_catalog_style_enable', 'value' => 'true'),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show Category?', 'g5plus-orson' ),
			'param_name' => 'product_category_enable',
			'std' => 0,
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'custom_catalog_style_enable', 'value' => 'true'),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show Sale Count Down?', 'g5plus-orson' ),
			'param_name' => 'product_sale_count_down_enable',
			'std' => 0,
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'custom_catalog_style_enable', 'value' => 'true'),
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Medium devices', 'g5plus-orson'),
			'param_name' => 'items_md',
			'description' => esc_html__('Browser Width >= 992px and < 1200px', 'g5plus-orson'),
			'value' => array( esc_html__('Default','g5plus-orson') => 0, '1' => 1, '2' => 2 , '3' => 3,'4' => 4, '5' => 5),
			'std' => 0,
			'group' => esc_html__('Responsive','g5plus-orson')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Small devices', 'g5plus-orson'),
			'param_name' => 'items_sm',
			'description' => esc_html__('Browser Width >= 768px and < 991px', 'g5plus-orson'),
			'value' => array( esc_html__('Default','g5plus-orson') => 0, '1' => 1, '2' => 2 , '3' => 3,'4' => 4, '5' => 5),
			'std' => 0,
			'group' => esc_html__('Responsive','g5plus-orson')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Extra small devices', 'g5plus-orson'),
			'param_name' => 'items_xs',
			'description' => esc_html__('Browser Width >= 480px and < 767px', 'g5plus-orson'),
			'value' => array( esc_html__('Default','g5plus-orson') => 0, '1' => 1, '2' => 2 , '3' => 3,'4' => 4, '5' => 5),
			'std' => 0,
			'group' => esc_html__('Responsive','g5plus-orson')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items Mobile', 'g5plus-orson'),
			'param_name' => 'items_mb',
			'description' => esc_html__('Browser Width < 480px', 'g5plus-orson'),
			'value' => array( esc_html__('Default','g5plus-orson') => 0, '1' => 1, '2' => 2 , '3' => 3,'4' => 4, '5' => 5),
			'std' => 0,
			'group' => esc_html__('Responsive','g5plus-orson')
		),
		g5plus_vc_map_add_css_editor()
	))
);