<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 9/5/2016
 * Time: 4:44 PM
 */
return array(
		'name' => esc_html__('Partner Carousel', 'g5plus-orson'),
		'base' => 'g5plus_partner_carousel',
		'icon' => 'fa fa-exchange',
		'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
		'params' => array_merge(g5plus_vc_map_add_heading_title(),array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Layout Style', 'g5plus-orson'),
				'param_name' => 'layout_style',
				'admin_label' => true,
				'value' => array(
					esc_html__('Normal', 'g5plus-orson') => '',
					esc_html__('Border', 'g5plus-orson') => 'bordered',
				),
				'description' => esc_html__('Select Layout Style.', 'g5plus-orson'),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Size Partner', 'g5plus-orson'),
				'param_name' => 'size',
				'admin_label' => true,
				'value' => array(
					esc_html__('Small', 'g5plus-orson') => 'size_01',
					esc_html__('Medium', 'g5plus-orson') => 'size_02',
					esc_html__('Custom Size', 'g5plus-orson') => 'size_03',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Height', 'g5plus-orson'),
				'param_name' => 'height',
				'value' => '',
				'dependency' => array('element' => 'size', 'value' => 'size_03'),
			),
			array(
				'type' => 'attach_images',
				'heading' => esc_html__('Images', 'g5plus-orson'),
				'param_name' => 'images',
				'value' => '',
				'description' => esc_html__('Select images Partner.', 'g5plus-orson')
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => esc_html__('Images opacity', 'g5plus-orson'),
				'param_name' => 'images_opacity',
				'value' => '50',
				'min' => '1',
				'max' => '100',
				'suffix' => '%',
				'description' => esc_html__('Select opacity for images.', 'g5plus-orson'),
			),
			array(
				'type' => 'exploded_textarea',
				'heading' => esc_html__('Custom links', 'g5plus-orson'),
				'param_name' => 'custom_links',
				'description' => esc_html__('Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'g5plus-orson'),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Open link in a new tab ?', 'g5plus-orson' ),
				'param_name' => 'custom_links_target',
				'std' => 'false',
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			),
			array_merge(g5plus_vc_map_add_navigation(),array(
				'dependency' => array(),
			)),
			array_merge(g5plus_vc_map_add_pagination(),array(
				'dependency' => array(),
			)),
			array_merge(g5plus_vc_map_add_navigation_position(),array(
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			)),
			array_merge(g5plus_vc_map_add_navigation_style(),array(
				'edit_field_class' => 'vc_col-sm-4 vc_column'
			)),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Items Desktop', 'g5plus-orson'),
				'param_name' => 'items_lg',
				'description' => esc_html__('Browser Width > 1199', 'g5plus-orson'),
				'value' => '',
				'std' => '5',
				'group'=> 'Reponsive'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Items Desktop Small', 'g5plus-orson'),
				'param_name' => 'items_md',
				'description' => esc_html__('Browser Width < 1199', 'g5plus-orson'),
				'value' => '',
				'std' => '4',
				'group'=> 'Reponsive'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Items Tablet', 'g5plus-orson'),
				'param_name' => 'items_sm',
				'description' => esc_html__('Browser Width < 992', 'g5plus-orson'),
				'value' => '',
				'std' => '3',
				'group'=> 'Reponsive'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Items Tablet Small', 'g5plus-orson'),
				'param_name' => 'items_xs',
				'description' => esc_html__('Browser Width < 768', 'g5plus-orson'),
				'value' => '',
				'std' => '2',
				'group'=> 'Reponsive'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Items Mobile', 'g5plus-orson'),
				'param_name' => 'items_mb',
				'description' => esc_html__('Browser Width < 480', 'g5plus-orson'),
				'value' => '',
				'std' => '1',
				'group'=> 'Reponsive'
			),
			vc_map_add_css_animation(),
			g5plus_vc_map_add_animation_duration(),
			g5plus_vc_map_add_animation_delay(),
			g5plus_vc_map_add_extra_class(),
			g5plus_vc_map_add_css_editor()
	))
);