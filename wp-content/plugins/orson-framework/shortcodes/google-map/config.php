<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 9/6/2016
 * Time: 7:57 AM
 */
return array(
	'name' => esc_html__('Orson Google Map', 'g5plus-orson'),
	'base' => 'g5plus_google_map',
	'icon' => 'fa fa-map-marker',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Markers', 'g5plus-orson' ),
			'param_name' => 'markers',
			'value' => urlencode( json_encode( array(
				array(
					'label' => esc_html__( 'Title', 'g5plus-orson' ),
					'value' => '',
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Latitude ', 'g5plus-orson'),
					'param_name' => 'lat',
					'value' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Longitude ', 'g5plus-orson'),
					'param_name' => 'lng',
					'value' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Title', 'g5plus-orson'),
					'param_name' => 'title',
					'admin_label' => true,
					'value' => '',
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__('Description', 'g5plus-orson'),
					'param_name' => 'description',
					'value' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Marker Icon', 'g5plus-orson' ),
					'param_name' => 'icon',
					'value' => '',
					'description' => esc_html__( 'Select an image from media library.', 'g5plus-orson' ),
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('API Url', 'g5plus-orson'),
			'param_name' => 'api_url',
			'std' => 'http://maps.googleapis.com/maps/api/js?key=AIzaSyAwey_47Cen4qJOjwHQ_sK1igwKPd74J18',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Map height (px or %)', 'g5plus-orson'),
			'param_name' => 'map_height',
			'edit_field_class' => 'vc_col-sm-6',
			'std' => '500px',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Map Color', 'g5plus-orson'),
			'param_name' => 'map_color',
			'value' => '',
			'edit_field_class' => 'vc_col-sm-6',
		),
	vc_map_add_css_animation(),
	g5plus_vc_map_add_animation_duration(),
	g5plus_vc_map_add_animation_delay(),
	g5plus_vc_map_add_extra_class(),
	g5plus_vc_map_add_css_editor()
	)
);