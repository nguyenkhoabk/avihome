<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 18/5/2016
 * Time: 3:47 PM
 */
return array(
	'name' => esc_html__('Social Icon','g5plus-orson'),
	'base' => 'g5plus_social_icons',
	'icon' => 'fa fa-share-alt',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout Style','g5plus-orson'),
			'param_name' => 'layout_style',
			'admin_label' => true,
			'value' => array(
				esc_html__('Border and Text','g5plus-orson')=>'style_01',
				esc_html__('Border and Icon','g5plus-orson')=>'style_02',
				esc_html__('Background and Text','g5plus-orson')=>'style_03',
				esc_html__('Background and Icon','g5plus-orson')=>'style_04',
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Size','g5plus-orson'),
			'param_name' => 'size',
			'admin_label' => true,
			'value' => array(
				esc_html__('Small','g5plus-orson')=>'size-sm',
				esc_html__('Medium','g5plus-orson')=>'size-md',
				esc_html__('Large','g5plus-orson')=>'size-lg',
			),
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__('Values','g5plus-orson'),
			'param_name' => 'values',
			'description'=>esc_html__('Enter values for title social-icon, icon, color. ','g5plus-orson'),
			'value' => urlencode(json_encode(array(
				array(
					'name' => esc_html__('Facebook','g5plus-orson'),
					'link' => 'https://www.facebook.com/',
				),
				array(
					'name' => esc_html__('Twitter','g5plus-orson'),
					'link' => 'https://www.twitter.com/',
				),
				array(
					'name' => esc_html__('Google Plus','g5plus-orson'),
					'link' => 'https://www.google.com/',
				),
			))),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Name','g5plus-orson'),
					'param_name' => 'name',
					'value' => '',
					'admin_label' => true,
					'description' => esc_html__('Enter Name','g5plus-orson')
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Link','g5plus-orson'),
					'param_name' => 'link',
					'value' => '',
					'std' => '#',
					'description' => esc_html__('Enter Link','g5plus-orson')
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'g5plus-orson' ),
					'param_name' => 'color',
					'description' => esc_html__( 'Select background color.', 'g5plus-orson' ),
				),
				g5plus_vc_map_add_icon_font(),
			),
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	)
);