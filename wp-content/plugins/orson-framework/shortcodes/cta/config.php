<?php
$dependency_add_icon = array(
	'element' => 'button_add_icon',
	'value' => 'true',
);
return array(
	'base' => 'g5plus_cta',
	'name' => esc_html__('Call To Action','g5plus-orson'),
	'icon' => 'fa fa-play',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__( 'Text', 'g5plus-orson' ),
			'param_name' => 'content',
			"admin_label" => true,
			'value' => esc_html__( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'g5plus-orson' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Text Size', 'g5plus-orson'),
			'param_name' => 'content_size',
			"admin_label" => true,
			'value' => array(
				esc_html__('Medium', 'g5plus-orson') => 'text-medium',
				esc_html__('Large', 'g5plus-orson') => 'text-large'
			)
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text', 'g5plus-orson' ),
			'param_name' => 'button_text',
			'value' => esc_html__('Purchase Now', 'g5plus-orson' ),
			'admin_label' => true,
			'group' => esc_html__('Button','g5plus-framework')
		),

		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'g5plus-orson' ),
			'param_name' => 'button_link',
			'description' => esc_html__('Add link to button.', 'g5plus-orson' ),
			'group' => esc_html__('Button','g5plus-framework')
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'g5plus-orson' ),
			'description' => esc_html__('Select button display style.', 'g5plus-orson' ),
			'param_name' => 'button_style',
			'value' => array(
				esc_html__('Background', 'g5plus-orson' ) => '',
				esc_html__('Border', 'g5plus-orson' ) => 'btn-bordered'
			),
			'std' => '',
			'group' => esc_html__('Button','g5plus-framework')
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Color', 'g5plus-orson' ),
			'param_name' => 'button_color',
			'description' => esc_html__('Select button color.', 'g5plus-orson' ),
			'value' => array(
				esc_html__('Primary', 'g5plus-orson' ) => '',
				esc_html__('Gray', 'g5plus-orson' ) => 'btn-gray',
				esc_html__('Light', 'g5plus-orson' ) => 'btn-light',
				esc_html__('White', 'g5plus-orson' ) => 'btn-white',
			),
			'std' => '',
			'group' => esc_html__('Button','g5plus-framework')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Size', 'g5plus-orson' ),
			'param_name' => 'button_size',
			'description' => esc_html__('Select button display size.', 'g5plus-orson' ),
			'std' => '',
			'value' => array(
				esc_html__('Normal', 'g5plus-orson') => '',
				esc_html__('Small', 'g5plus-orson') => 'btn-sm',
				esc_html__('Medium', 'g5plus-orson') => 'btn-md',
				esc_html__('Large', 'g5plus-orson') => 'btn-lg',
			),
			'group' => esc_html__('Button','g5plus-framework')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Add icon?', 'g5plus-orson' ),
			'param_name' => 'button_add_icon',
			'std' => 'false',
			'group' => esc_html__('Button','g5plus-framework')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon Alignment', 'g5plus-orson' ),
			'description' => esc_html__('Select icon alignment.', 'g5plus-orson' ),
			'param_name' => 'button_icon_align',
			'value' => array(
				esc_html__('Left', 'g5plus-orson' ) => 'left',
				// default as well
				esc_html__('Right', 'g5plus-orson' ) => 'right',
			),
			'dependency' => $dependency_add_icon,
			'group' => esc_html__('Button','g5plus-framework')
		),
		array_merge(g5plus_vc_map_add_icon_font($dependency_add_icon),array('param_name' => 'button_icon_font','group' => esc_html__('Button','g5plus-framework'))),


/*
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Button Text', 'g5plus-orson' ),
			'param_name' => 'button_text',
			'value' => esc_html__('Purchase Now', 'g5plus-orson' ),
			"admin_label" => true,
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'g5plus-orson' ),
			'param_name' => 'button_link',
			'description' => esc_html__('Add link to button.', 'g5plus-orson' ),
		),
*/
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	)
);