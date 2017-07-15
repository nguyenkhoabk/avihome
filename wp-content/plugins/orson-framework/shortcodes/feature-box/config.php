<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 16/5/2016
 * Time: 3:22 PM
 */
return array(
	'name' => esc_html__('Feature Box', 'g5plus-orson'),
	'base' => 'g5plus_feature',
	'class' => '',
	'icon' => 'fa fa-th-list',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout Style', 'g5plus-orson'),
			'param_name' => 'layout_style',
			'value' => array(
				esc_html__('Inline','g5plus-orson') => '',
				esc_html__('Vertical','g5plus-orson') => 'style_02',
			),
			'admin_label' => true,
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Image:', 'g5plus-orson'),
			'param_name' => 'image',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Video Url', 'g5plus-orson'),
			'param_name' => 'video_url',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'g5plus-orson'),
			'param_name' => 'title',
			'value' => '',
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Description', 'g5plus-orson'),
			'param_name' => 'description',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text Link', 'g5plus-orson'),
			'param_name' => 'text_link',
			'value' => '',
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Link (url)', 'g5plus-orson'),
			'param_name' => 'link',
			'value' => '',
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	)
);