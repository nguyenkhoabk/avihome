<?php
return array(
    'name' => esc_html__( 'Testimonials', 'g5plus-orson' ),
    'base' => 'g5plus_testimonials',
    'icon' => 'fa fa-user',
    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
    'params' => array(
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Testimonials', 'g5plus-orson' ),
            'param_name' => 'values',
            'value' => urlencode( json_encode( array(
                array(
                    'label' => esc_html__( 'Author', 'g5plus-orson' ),
                    'value' => '',
                ),
            ) ) ),
            'params' => array(
				array(
					'type' => 'textarea',
					'heading' => esc_html__('Quote from author', 'g5plus-orson'),
					'param_name' => 'quote',
					'value' => ''
				),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Avatar:', 'g5plus-orson'),
                    'param_name' => 'avatar',
                    'value' => '',
                    'description' => esc_html__('Choose the author picture.', 'g5plus-orson'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Author Name', 'g5plus-orson'),
                    'param_name' => 'author',
                    'admin_label' => true,
                    'description' => esc_html__('Enter Author information.', 'g5plus-orson')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Author Info', 'g5plus-orson'),
                    'param_name' => 'author_info',
                    'admin_label' => true,
                    'description' => esc_html__('Enter Author information.', 'g5plus-orson')
                ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Layout Style', 'g5plus-orson'),
            'param_name' => 'layout_style',
            'admin_label' => true,
            'value' => array(
                esc_html__('Testimonials Scroller', 'g5plus-orson') => 'style1',
                esc_html__('Testimonials Carousel', 'g5plus-orson') => 'style2',
                esc_html__('Testimonials Border Box', 'g5plus-orson') => 'style3'),
            'description' => esc_html__('Select Layout Style.', 'g5plus-orson')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Layout Type', 'g5plus-orson'),
            'param_name' => 'layout_type',
            'admin_label' => true,
            'value' => array(
                esc_html__('Quote Background Transparent', 'g5plus-orson') => 'st1_type1',
                esc_html__('Quote Background Text Color', 'g5plus-orson') => 'st1_type2',
                esc_html__('Quote Background Primary Color', 'g5plus-orson') => 'st1_type3'
            ),
            'description' => esc_html__('Select Layout Type.', 'g5plus-orson'),
            'dependency' => array(
                'element' => 'layout_style',
                'value' => array( 'style1' ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Layout Type', 'g5plus-orson'),
            'param_name' => 'layout_type_2',
            'admin_label' => true,
            'value' => array(
                esc_html__('Type 1', 'g5plus-orson') => 'st2_type1',
                esc_html__('Type 2', 'g5plus-orson') => 'st2_type2'
            ),
            'description' => esc_html__('Select Layout Type.', 'g5plus-orson'),
            'dependency' => array(
                'element' => 'layout_style',
                'value' => array( 'style2' ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Info Alignment', 'g5plus-orson'),
            'param_name' => 'text_align',
            'value' => array(
                esc_html__('Center', 'g5plus-orson') => 'info-center',
                esc_html__('Left', 'g5plus-orson') => 'info-left',
                esc_html__('Right', 'g5plus-orson') => 'info-right'
            ),
            'description' => esc_html__('Select Text Alignment', 'g5plus-orson'),
            'dependency' => array(
                'element' => 'layout_style',
                'value' => array( 'style1' ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Color Scheme', 'g5plus-orson'),
            'param_name' => 'color_scheme',
            'admin_label' => true,
            'value' => array(
				esc_html__('Dark', 'g5plus-orson') => 'color-dark',
                esc_html__('Light', 'g5plus-orson') => 'color-light'
			),
            'std' => 'color-dark',
            'description' => esc_html__('Select Color Scheme.', 'g5plus-orson')
        ),
		array_merge(g5plus_vc_map_add_navigation(),array(
			'dependency' => array(),
		)),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Navigation Position', 'g5plus-orson'),
			'param_name' => 'arrows_position',
			'value' => array(
				esc_html__('Bottom','g5plus-orson') => 'bottom',
				esc_html__('Center','g5plus-orson') => 'center'
			),
			'dependency' => array(
				'element' => 'layout_style',
				'value' => array('style2'),
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		),
		array_merge(g5plus_vc_map_add_navigation_style(),array(
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		)),
		array_merge(g5plus_vc_map_add_pagination(),array(
			'dependency' => array(
				'element' => 'layout_style',
				'value' => array( 'style1','style2'),
			),
		)),
        vc_map_add_css_animation(),
        g5plus_vc_map_add_animation_duration(),
        g5plus_vc_map_add_animation_delay(),
        g5plus_vc_map_add_extra_class(),
        g5plus_vc_map_add_css_editor()
    )
);
