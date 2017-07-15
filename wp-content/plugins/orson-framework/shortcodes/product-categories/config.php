<?php
return array(
	'base' => 'g5plus_product_categories',
	'name' => esc_html__('Product Categories','g5plus-orson'),
	'icon' => 'fa fa-product-hunt',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'description' => esc_html__('Display product categories loop','g5plus-orson'),
	'params' => array_merge(g5plus_vc_map_add_heading_title(), array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Show', 'g5plus-orson'),
			'param_name' => 'show',
			"admin_label" => true,
			'value' => array(
				esc_html__('All', 'g5plus-orson') => 'all',
				esc_html__('Narrow Categories', 'g5plus-orson') => 'categories'
			)
		),
		array(
			'type' => 'autocomplete',
			'heading' => esc_html__( 'Narrow Categories', 'g5plus-orson' ),
			'param_name' => 'category',
			'settings' => array(
				'multiple' => true,
				'sortable' => true,
				'unique_values' => true,
			),
			'save_always' => true,
			'description' => esc_html__( 'Enter List of Product Categories', 'g5plus-orson' ),
			'dependency' => array('element' => 'show', 'value' => 'categories'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of product categories', 'g5plus-orson' ),
			'description' => esc_html__('Enter number of product categories to display.', 'g5plus-orson' ),
			'param_name' => 'number',
			'value' => 8,
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'show', 'value' => 'all'),
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
				esc_html__('Name', 'g5plus-orson') => 'name',
				esc_html__('Order', 'g5plus-orson') => 'order'
			),
			'description' => esc_html__('Select how to sort retrieved product categories.', 'g5plus-orson'),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'show', 'value' => 'all'),
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
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'show', 'value' => 'all'),
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Hide Empty?', 'g5plus-orson' ),
			'param_name' => 'hide_empty',
			'admin_label' => true,
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
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class()
	))
);