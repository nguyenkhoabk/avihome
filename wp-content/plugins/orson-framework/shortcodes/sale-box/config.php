<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 24/5/2016
 * Time: 10:47 AM
 */
return array(
	'name' => esc_html__( 'Sale Box', 'g5plus-orson' ),
	'base' => 'g5plus_sale_box',
	'icon' => 'fa fa-money',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Sale', 'g5plus-orson'),
			'param_name' => 'sale',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'g5plus-orson'),
			'param_name' => 'title',
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'g5plus-orson' ),
			'param_name' => 'link',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Description', 'g5plus-orson'),
			'param_name' => 'description',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Featured', 'g5plus-orson'),
			'param_name' => 'featured',
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	)
);
