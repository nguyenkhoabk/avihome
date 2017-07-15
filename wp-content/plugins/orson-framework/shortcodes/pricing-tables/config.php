<?php
return array(
    'name' => esc_html__( 'Pricing Tables', 'g5plus-orson' ),
    'base' => 'g5plus_pricing_tables',
    'icon' => 'fa fa-usd',
    'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
    'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Name', 'g5plus-orson'),
			'param_name' => 'name',
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Price', 'g5plus-orson'),
			'param_name' => 'price',
			'admin_label' => true,
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Pricing Tables', 'g5plus-orson' ),
			'param_name' => 'values',
			'value' => urlencode( json_encode( array(
				array(
					'label' => esc_html__( 'Author', 'g5plus-orson' ),
					'value' => '',
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Features', 'g5plus-orson'),
					'param_name' => 'features',
					'admin_label' => true,
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Button Text', 'g5plus-orson' ),
			'param_name' => 'title',
			'admin_label' => true,
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'g5plus-orson' ),
			'param_name' => 'link',
			'description' => esc_html__('Add link to button.', 'g5plus-orson' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Recommend ?', 'g5plus-orson' ),
			'param_name' => 'recommend',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
        vc_map_add_css_animation(),
        g5plus_vc_map_add_animation_duration(),
        g5plus_vc_map_add_animation_delay(),
        g5plus_vc_map_add_extra_class(),
        g5plus_vc_map_add_css_editor()
    )
);
