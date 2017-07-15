<?php
return array(
	'base' => 'g5plus_product_sidebar',
	'name' => esc_html__('Product Sidebar','g5plus-orson'),
	'icon' => 'fa fa-product-hunt',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'description' => esc_html__('Show multiple product sidebar','g5plus-orson'),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout','g5plus-orson'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Classic','g5plus-orson')  => '',
				esc_html__('Classic Without Border','g5plus-orson') => 'widget-classic-no-border',
				esc_html__('Border Round','g5plus-orson') => 'widget-border-round',
				esc_html__('Border Round Background','g5plus-orson') => 'widget-border-round-background',
				esc_html__('Border','g5plus-orson') => 'widget-border',
				esc_html__('Border Background','g5plus-orson') => 'widget-border-background',
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'g5plus-orson' ),
			'param_name' => 'title',
			'value' => '',
			'admin_label' => true,
		),
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
			'dependency' => array('element' => 'show','value' => array('all','sale','new-in','featured','top-rated','recent-review','best-selling'))
		)),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of products', 'g5plus-orson' ),
			'description' => esc_html__('Enter number of products to display.', 'g5plus-orson' ),
			'param_name' => 'number',
			'value' => 3,
			'admin_label' => true,
			'dependency' => array('element' => 'show','value' => array('all','sale','new-in','featured','top-rated','recent-review','best-selling'))
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
		/*array(
			'type' => 'checkbox',
			'heading' => esc_html__('Display Slider?', 'g5plus-orson' ),
			'param_name' => 'is_slider',
			'admin_label' => true,
		),*/
		g5plus_vc_map_add_slider(),
		g5plus_vc_map_add_pagination(),
		g5plus_vc_map_add_navigation(),
		array(
			'type' => 'number',
			'heading' => esc_html__('Rows', 'g5plus-orson'),
			'param_name' => 'rows',
			'value' => 3,
			'dependency' => array('element' => 'is_slider', 'value' => 'true'),
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),
		array_merge( g5plus_vc_map_add_navigation_position(),array(
			'value' => array(
				esc_html__('Top','g5plus-orson') => 'top',
				esc_html__('Bottom','g5plus-orson') => 'bottom'
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		)),
		array_merge( g5plus_vc_map_add_navigation_style(),array('edit_field_class' => 'vc_col-sm-4 vc_column')),
		/*array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show navigation control', 'g5plus-orson'),
			'param_name' => 'arrows',
			'dependency' => array('element' => 'is_slider', 'value' => 'true'),
			'std' => 'true',
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),*/
		/*array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show pagination control', 'g5plus-orson'),
			'param_name' => 'dots',
			'dependency' => array('element' => 'is_slider', 'value' => 'true'),
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),*/
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class()
	)
);