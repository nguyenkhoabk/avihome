<?php
$dependency_add_icon = array(
	'element' => 'add_icon',
	'value' => 'true',
);
return array(
	'base' => 'g5plus_button',
	'name' => esc_html__('Button','g5plus-orson'),
	'icon' => 'fa fa-bold',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'description' => esc_html__('Eye catching button', 'g5plus-orson' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text', 'g5plus-orson' ),
			'param_name' => 'title',
			'value' => esc_html__('Text on the button', 'g5plus-orson' ),
			'admin_label' => true,
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'g5plus-orson' ),
			'param_name' => 'link',
			'description' => esc_html__('Add link to button.', 'g5plus-orson' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'g5plus-orson' ),
			'description' => esc_html__('Select button display style.', 'g5plus-orson' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__('Background', 'g5plus-orson' ) => '',
				esc_html__('Border', 'g5plus-orson' ) => 'btn-bordered'
			),
			'std' => '',
			'admin_label' => true,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Color', 'g5plus-orson' ),
			'param_name' => 'color',
			'description' => esc_html__('Select button color.', 'g5plus-orson' ),
			'value' => array(
					esc_html__('Primary', 'g5plus-orson' ) => '',
					esc_html__('Gray', 'g5plus-orson' ) => 'btn-gray',
					esc_html__('Light', 'g5plus-orson' ) => 'btn-light',
					esc_html__('White', 'g5plus-orson' ) => 'btn-white',
				),
			'std' => '',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Size', 'g5plus-orson' ),
			'param_name' => 'size',
			'description' => esc_html__('Select button display size.', 'g5plus-orson' ),
			'std' => '',
			'value' => array(
				esc_html__('Normal', 'g5plus-orson') => '',
				esc_html__('Small', 'g5plus-orson') => 'btn-sm',
				esc_html__('Medium', 'g5plus-orson') => 'btn-md',
				esc_html__('Large', 'g5plus-orson') => 'btn-lg',
			),
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Alignment', 'g5plus-orson' ),
			'param_name' => 'align',
			'description' => esc_html__('Select button alignment.', 'g5plus-orson' ),
			// compatible with btn2, default left to be compatible with btn1
			'value' => array(
				esc_html__('Inline', 'g5plus-orson' ) => 'inline',
				// default as well
				esc_html__('Left', 'g5plus-orson' ) => 'left',
				// default as well
				esc_html__('Right', 'g5plus-orson' ) => 'right',
				esc_html__('Center', 'g5plus-orson' ) => 'center',
			),
			'admin_label' => true,
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Set full width button?', 'g5plus-orson' ),
			'param_name' => 'button_block',
			'dependency' => array(
				'element' => 'align',
				'value_not_equal_to' => 'inline',
			),
			'admin_label' => true,
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Add icon?', 'g5plus-orson' ),
			'param_name' => 'add_icon',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon Alignment', 'g5plus-orson' ),
			'description' => esc_html__('Select icon alignment.', 'g5plus-orson' ),
			'param_name' => 'icon_align',
			'value' => array(
				esc_html__('Left', 'g5plus-orson' ) => 'left',
				// default as well
				esc_html__('Right', 'g5plus-orson' ) => 'right',
			),
			'dependency' => $dependency_add_icon,
		),
		g5plus_vc_map_add_icon_font($dependency_add_icon),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	),
);