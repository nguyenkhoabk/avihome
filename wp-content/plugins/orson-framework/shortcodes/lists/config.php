<?php
$styles = array(
	esc_html__('Simple','g5plus-orson') => 'simple',
	esc_html__('Round','g5plus-orson') => 'round',
);

$sizes = array(
	esc_html__('Mini','g5plus-orson') => 'xs',
	esc_html__('Small','g5plus-orson') => 'sm',
	esc_html__('Normal','g5plus-orson') => 'md',
	esc_html__('Large','g5plus-orson') => 'lg',
);

return array(
	'base' => 'g5plus_lists',
	'name' => esc_html__('Lists','g5plus-orson'),
	'icon' => 'fa fa-list-ol',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'g5plus-orson'),
			'param_name' => 'style',
			'value' => $styles,
			'description' => esc_html__( 'Select lists design style.', 'g5plus-orson' ),
			'admin_label' => true,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Bullet', 'g5plus-orson'),
			'param_name' => 'bullet',
			'value' => array(
				esc_html__('Number','g5plus-orson') => 'number',
				esc_html__('Icon','g5plus-orson') => 'icon',
			),
			'admin_label' => true,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Bullet Color', 'g5plus-orson' ),
			'param_name' => 'color',
			'value' => array(esc_html__( 'Primary', 'g5plus-orson' ) => 'primary' ) + getVcShared( 'colors' ),
			'std' => 'grey',
			'description' => esc_html__( 'Select bullet color.', 'g5plus-orson' ),
			'param_holder_class' => 'vc_colored-dropdown',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Bullet Size', 'g5plus-orson' ),
			'param_name' => 'size',
			'value' => $sizes,
			'std' => 'md',
			'description' => esc_html__( 'Select bullet size', 'g5plus-orson' ),
		),

		array(
			'type' => 'param_group',
			'heading' => esc_html__('Values','g5plus-orson'),
			'param_name' => 'values',
			'description' => esc_html__('Enter values for list - icon and text','g5plus-orson'),
			'value' => '',
			'params' => array(
				g5plus_vc_map_add_icon_font(array('element' => 'bullet','value' => 'icon')) + array('admin_label' => true),
				array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Label', 'g5plus-orson' ),
					'param_name' => 'label',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Bullet color', 'g5plus-orson' ),
					'param_name' => 'color',
					'value' => array( esc_html__( 'Default', 'g5plus-orson' ) => '',esc_html__( 'Primary', 'g5plus-orson' ) => 'primary' ) + getVcShared( 'colors' ),
					'std' => '',
					'description' => esc_html__( 'Select bullet color.', 'g5plus-orson' ),
					'param_holder_class' => 'vc_colored-dropdown',
				)
			)
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class()
	)
);