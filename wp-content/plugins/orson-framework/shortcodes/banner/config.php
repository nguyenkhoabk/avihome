<?php
return array(
    'base' => 'g5plus_banner',
    'name' => esc_html__('Banner','g5plus-orson'),
    'icon' => 'fa fa-picture-o',
    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
    'params' => array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Hover effect', 'g5plus-orson'),
			'param_name' => 'hover_effect',
			'std'        => '',
			'value'      => array(
				esc_html__('None', 'g5plus-orson')    => '',
				esc_html__('Suprema', 'g5plus-orson') => 'suprema-effect',
				esc_html__('Layla', 'g5plus-orson')   => 'layla-effect',
				esc_html__('Bubba', 'g5plus-orson')   => 'bubba-effect',
				esc_html__('Jazz', 'g5plus-orson')    => 'jazz-effect',
			)
		),
        array(
            'type' => 'attach_image',
			'heading'    => esc_html__('Select Banner image', 'g5plus-orson'),
			'param_name' => 'banner_image',
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
    ),
);