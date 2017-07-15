<?php
return array(
	'base' => 'g5plus_icon_box',
	'name' => esc_html__('Icon Box','g5plus-orson'),
	'icon' => 'fa fa-diamond',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout Style', 'g5plus-orson'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Default','g5plus-orson') => 'default',
				esc_html__('Classic','g5plus-orson') => 'classic',
				esc_html__('Round','g5plus-orson') => 'round',
				esc_html__('Round Outline','g5plus-orson') => 'round_outline',
				esc_html__('Square','g5plus-orson') => 'square',
				esc_html__('Square Outline','g5plus-orson') => 'square_outline',
				esc_html__('Modern', 'g5plus-orson' ) => 'modern',
				esc_html__('Flat', 'g5plus-orson' ) => 'flat',
			),
			'admin_label' => true,
		),

		array(
			'type' => 'number',
			'heading' => esc_html__('Height', 'g5plus-orson'),
			'param_name' => 'height',
			'value' => '',
			'dependency'=> array('element'=>'layout','value'=>array('modern')),
			'description' => esc_html__('Set height for icon box, default: 270px', 'g5plus-orson')
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Alignment', 'g5plus-orson'),
			'param_name' => 'align',
			'value' => array(
				esc_html__('Default','g5plus-orson') => '',
				esc_html__('Left','g5plus-orson') => 'left',
				esc_html__('Center','g5plus-orson') => 'center',
				esc_html__('Right','g5plus-orson') => 'right',
			),
			'std' => '',
			'dependency'=> array('element'=>'layout','value_not_equal_to'=>array('flat','modern')),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Color Scheme', 'g5plus-orson'),
			'param_name' => 'color_scheme',
			'value' => array(
				esc_html__('Default', 'g5plus-orson') => '',
				esc_html__('Dark', 'g5plus-orson') => 'dark',
				esc_html__('Light', 'g5plus-orson') => 'light',
				esc_html__('Primary', 'g5plus-orson') => 'primary'
			),
			'std' => '',
			'description' => esc_html__('Select Color Scheme.', 'g5plus-orson'),
			'dependency'=> array('element'=>'layout','value_not_equal_to'=>array('modern')),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Size', 'g5plus-orson' ),
			'param_name' => 'size',
			'value' => array(
				esc_html__('Small','g5plus-orson') => 'sm',
				esc_html__('Normal','g5plus-orson') => 'md',
				esc_html__('Large','g5plus-orson') => 'lg',
			),
			'std' => 'md',
			'dependency'=> array('element'=>'layout','value_not_equal_to'=>array('flat')),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'g5plus-orson' ),
			'param_name' => 'title',
			'value' => '',
			'admin_label' => true,
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Description', 'g5plus-orson'),
			'param_name' => 'description',
			'value' => '',
			'description' => esc_html__('Provide the description for this element.', 'g5plus-orson'),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Description Size', 'g5plus-orson' ),
			'param_name' => 'description_size',
			'value' => array(
				esc_html__('Small','g5plus-orson') => 'sm',
				esc_html__('Normal','g5plus-orson') => 'md',
			),
			'std' => 'md',
			'dependency'=> array('element'=>'layout','value_not_equal_to'=>array('flat','modern')),
		),

		g5plus_vc_map_add_icon_type(),
		g5plus_vc_map_add_icon_font(),
		g5plus_vc_map_add_icon_image(),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Color', 'g5plus-orson' ),
			'param_name' => 'icon_color',
			'description' => esc_html__( 'Select icon color.', 'g5plus-orson' ),
			'dependency'=> array('element'=>'icon_type','value'=>array('icon'))
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon Alignment', 'g5plus-orson'),
			'param_name' => 'icon_align',
			'value' => array(
				esc_html__('Left','g5plus-orson') => 'left',
				esc_html__('Center','g5plus-orson') => 'center',
				esc_html__('Right','g5plus-orson') => 'right',
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'dependency'=> array('element'=>'layout','value_not_equal_to'=>array('flat','modern')),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon Vertical Alignment', 'g5plus-orson'),
			'param_name' => 'icon_vertical',
			'value' => array(
				esc_html__('Top','g5plus-orson') => 'top',
				esc_html__('Middle','g5plus-orson') => 'middle',
			),
			'std' => 'top',
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'dependency'=> array('element'=>'icon_align','value'=>array('left','right'))
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon Style', 'g5plus-orson'),
			'param_name' => 'icon_style',
			'value' => array(
				esc_html__('Classic','g5plus-orson') => 'classic',
				esc_html__('Round','g5plus-orson') => 'round',
				esc_html__('Round Outline','g5plus-orson') => 'round_outline',
				esc_html__('Square','g5plus-orson') => 'square',
				esc_html__('Square Outline','g5plus-orson') => 'square_outline',
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'dependency'=> array('element'=>'layout','value_not_equal_to'=>array('flat')),
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Link (url)', 'g5plus-orson'),
			'param_name' => 'link',
			'value' => '',
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__('Read more text', 'g5plus-orson' ),
			'param_name' => 'read_more',
			'value' => '',
		),

		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	)
);