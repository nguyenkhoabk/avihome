<?php
return array(
    'name' => esc_html__('Counter', 'g5plus-orson'),
    'base' => 'g5plus_counter',
    'class' => '',
    'icon' => 'fa fa-tachometer',
    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title', 'g5plus-orson'),
            'param_name' => 'counter_title',
            'value' => '',
            'admin_label' => true,
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Value', 'g5plus-orson'),
            'param_name' => 'counter_value',
            'value' => '',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Unit', 'g5plus-orson'),
            'param_name' => 'counter_unit',
            'value' => '',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Unit position', 'g5plus-orson'),
            'param_name' => 'counter_unit_align',
            'value' => array(
                esc_html__('Left', 'g5plus-orson') => 'left',
                esc_html__('Right', 'g5plus-orson') => 'right'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Content Align', 'g5plus-orson' ),
            'param_name' => 'text_align',
            'description' => esc_html__('Select Counter alignment.', 'g5plus-orson' ),
            'value' => array(
                esc_html__('Left', 'g5plus-orson' ) => 'left',
                esc_html__('Right', 'g5plus-orson' ) => 'right',
                esc_html__('Center', 'g5plus-orson' ) => 'center',
            ),
            'admin_label' => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Color Scheme', 'g5plus-orson'),
            'param_name' => 'color_scheme',
            'value' => array(
                esc_html__('Dark', 'g5plus-orson') => 'dark',
                esc_html__('Light', 'g5plus-orson') => 'light'),
            'description' => esc_html__('Select Color Scheme.', 'g5plus-orson')
        ),
        vc_map_add_css_animation(),
        g5plus_vc_map_add_animation_duration(),
        g5plus_vc_map_add_animation_delay(),
        g5plus_vc_map_add_extra_class(),
        g5plus_vc_map_add_css_editor()
    ),
);