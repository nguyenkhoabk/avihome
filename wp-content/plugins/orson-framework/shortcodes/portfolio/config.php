<?php

return array(
	'name'     => esc_html__('Portfolio', 'g5plus-orson'),
	'base'     => 'g5plus_portfolio',
	'class'    => '',
	'icon'     => 'fa fa-th-large',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params'   => array_merge(g5plus_vc_map_add_heading_title(), array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Layout style', 'g5plus-orson'),
				'param_name'  => 'layout_style',
				'admin_label' => true,
				'value'       => array(
					esc_html__('Grid', 'g5plus-orson')    => 'portfolio-grid',
					esc_html__('Slider', 'g5plus-orson') => 'portfolio-slider',
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Color scheme', 'g5plus-orson'),
				'param_name'  => 'color_scheme',
				'admin_label' => true,
				'value'       => array(
					esc_html__('Light', 'g5plus-orson') => 'portfolio-color-light',
					esc_html__('Dark', 'g5plus-orson')  => 'portfolio-color-dark',
				)
			),
			array(
				'type' => 'dropdown',
				'heading'     => esc_html__('Source', 'g5plus-orson'),
				'param_name'  => 'data_source',
				'admin_label' => true,
				'value'       => array(
					esc_html__('From Category', 'g5plus-orson')      => '',
					esc_html__('From Portfolio IDs', 'g5plus-orson') => 'list_id')
			),
			array_merge(g5plus_vc_map_add_narrow_portfolio_category(), array(
				'dependency' => array('element' => 'data_source', 'value' => array(''))
			)),
			array_merge(g5plus_vc_map_add_portfolio_list(), array(
				'dependency' => array('element' => 'data_source', 'value' => array('list_id'))
			)),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Show category', 'g5plus-orson'),
				'param_name' => 'show_category',
				'value'      => array(
					esc_html__('None', 'g5plus-orson')           => '',
					esc_html__('Show in left', 'g5plus-orson')   => 'left',
					esc_html__('Show in center', 'g5plus-orson') => 'center'),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Category diplay style', 'g5plus-orson'),
				'param_name' => 'category_display',
				'value'      => array(
					esc_html__('As button', 'g5plus-orson') => '',
					esc_html__('As tab', 'g5plus-orson')   => '-tab'
				),
				'std' => '',
				'dependency' => array('element' => 'show_category', 'value' => array('left', 'center')),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Overlay Style', 'g5plus-orson'),
				'param_name' => 'overlay_style',
				'value'      => array(
					esc_html__('None', 'g5plus-orson') => 'portfolio-overlay-none',
					esc_html__('Title - Category', 'g5plus-orson')  => 'portfolio-overlay-title-category',
					esc_html__('Title - Category - Zoom icon', 'g5plus-orson') => 'portfolio-overlay-title-category-icon',
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Zoom icon color scheme', 'g5plus-orson'),
				'param_name' => 'icon_color_scheme',
				'value'      => array(
					esc_html__('Dark', 'g5plus-orson') => 'icon-color-dark',
					esc_html__('Light', 'g5plus-orson')  => 'icon-color-light',
				),
				'dependency' => array('element' => 'overlay_style', 'value' => 'portfolio-overlay-title-category-icon')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Hover effect', 'g5plus-orson'),
				'param_name' => 'hover_effect',
				'std' => 'default-effect',
				'value'      => array(
					esc_html__('Default', 'g5plus-orson') => 'default-effect',
					esc_html__('Layla', 'g5plus-orson')   => 'layla-effect',
					esc_html__('Bubba', 'g5plus-orson')   => 'bubba-effect',
					esc_html__('Jazz', 'g5plus-orson')    => 'jazz-effect',
				),
				'dependency' => array('element' => 'overlay_style', 'value' => array('portfolio-overlay-title-category', 'portfolio-overlay-title-category-icon'))
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Number of item', 'g5plus-orson'),
				'param_name' => 'items',
				'std'      => 8,
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Number of column', 'g5plus-orson'),
				'param_name' => 'columns',
				'value'      => array('2' => '2', '3' => '3', '4' => '4'),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Show Paging', 'g5plus-orson'),
				'param_name' => 'show_pagging',
				'value'      => array(
					esc_html__('Show all', 'g5plus-orson')  => '',
					esc_html__('Load more', 'g5plus-orson')  => 'load-more'),
				'dependency' => array('element' => 'layout_style', 'value' => array('portfolio-grid')),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Items per page', 'g5plus-orson'),
				'param_name' => 'item_per_page',
				'std'      => 4,
				'dependency' => array('element' => 'show_pagging', 'value' => 'load-more'),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show pagination control', 'g5plus-orson'),
				'param_name' => 'dots',
				'dependency' => array('element' => 'layout_style', 'value' => 'portfolio-slider'),
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show navigation control', 'g5plus-orson'),
				'param_name' => 'arrows',
				'dependency' => array('element' => 'layout_style', 'value' => 'portfolio-slider'),
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Navigation Position', 'g5plus-orson'),
				'param_name' => 'arrows_position',
				'value' => array(
					esc_html__('Top','g5plus-orson') => 'top',
					esc_html__('Center','g5plus-orson') => 'center',
					esc_html__('Bottom','g5plus-orson') => 'bottom'
				),
				'std' => 'top',
				'dependency' => array('element' => 'arrows', 'value' => 'true'),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Navigation Style', 'g5plus-orson'),
				'param_name' => 'arrows_style',
				'value' => array(
					esc_html__('Classic','g5plus-orson') => '',
					esc_html__('Round','g5plus-orson') => 'round'
				),
				'std' => '',
				'dependency' => array('element' => 'arrows', 'value' => 'true'),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Padding', 'g5plus-orson'),
				'param_name' => 'column_padding',
				'value'      => array(
					esc_html__('No padding', 'g5plus-orson') => '',
					'20 px' => '20px'
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Image size', 'g5plus-orson'),
				'param_name' => 'image_size',
				'value'      => array(
					'270x185' => 'portfolio-size1',
					'370x250' => 'portfolio-size2',
					'480x300' => 'portfolio-size3',
					'480x424' => 'portfolio-size4',
					'565x380' => 'portfolio-size5',
					'640x400' => 'portfolio-size6'
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			vc_map_add_css_animation(),
			g5plus_vc_map_add_animation_duration(),
			g5plus_vc_map_add_animation_delay(),
			g5plus_vc_map_add_css_editor(),
			g5plus_vc_map_add_extra_class(),
			array(
				'type' => 'hidden',
				'param_name' => 'current_page',
				'value' => 1
			),
			array(
				'type' => 'hidden',
				'param_name' => 'ajax',
				'value' => 0
			),
			array(
				'type'       => 'hidden',
				'param_name' => 'post_not_in',
				'value'      => ''
			)
		)
	)
);