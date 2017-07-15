<?php
return array(
	'name'     => esc_html__('Our Team', 'g5plus-orson'),
	'base'     => 'g5plus_our_team',
	'class'    => '',
	'icon'     => 'fa fa-users',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params'   => array_merge(g5plus_vc_map_add_heading_title(), array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Layout style', 'g5plus-orson'),
				'param_name'  => 'layout_style',
				'admin_label' => true,
				'value'       => array(
					esc_html__('Default', 'g5plus-orson')      => 'style1',
					esc_html__('Excerpt hide', 'g5plus-orson') => 'style2'),
				'description' => esc_html__('Select layout style.', 'g5plus-orson')
			),
			g5plus_vc_map_add_narrow_ourteam_category(),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Item Amount', 'g5plus-orson'),
				'param_name' => 'item_amount',
				'value'      => '8',
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Columns', 'g5plus-orson'),
				'param_name' => 'columns',
				'value' => array('2' => 2 , '3' => 3,'4' => 4),
				'std' => 4,
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Slider style', 'g5plus-orson'),
				'param_name' => 'is_slider',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show pagination control', 'g5plus-orson'),
				'param_name' => 'dots',
				'dependency' => array('element' => 'is_slider', 'value' => 'true'),
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show navigation control', 'g5plus-orson'),
				'param_name' => 'arrows',
				'dependency' => array('element' => 'is_slider', 'value' => 'true'),
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
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show category?', 'g5plus-orson'),
				'param_name' => 'show_tab',
				'edit_field_class' => 'vc_col-sm-6 vc_column'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Page Paging', 'g5plus-orson'),
				'param_name' => 'page_paging',
				'std'=>'',
				'value' => array(
					esc_html__('Show all', 'g5plus-orson') => '',
					esc_html__('Load more', 'g5plus-orson') => 'load-more'
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'dependency' => array('element'=>'is_slider','is_empty'=>true)
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Post per Page', 'g5plus-orson'),
				'param_name' => 'post_per_page',
				'std' => 8,
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'dependency' => array('element'=>'page_paging','value'=>'load-more')
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
			)
		)
	)
);