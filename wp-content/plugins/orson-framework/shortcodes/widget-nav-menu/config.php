<?php
$menu_arr = array();
$menus = wp_get_nav_menus();
foreach ($menus as $menu) {
	$menu_arr[$menu->term_id] = $menu->name;
}

return array(
	'base' => 'g5plus_widget_nav_menu',
	'name' => esc_html__('Widget Custom Menu','g5plus-orson'),
	'icon' => 'icon-wpb-wp',
	'description' => esc_html__('Add a custom menu','g5plus-orson'),
	'category' => G5PLUS_FRAMEWORK_WIDGET_CATEGORY,
	'params' => array(
		g5plus_vc_map_add_widget_layout(),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'g5plus-orson' ),
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'g5plus-orson' ),
			'value' => '',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Select Menu','g5plus-orson'),
			'param_name' => 'nav_menu',
			'value' => $menu_arr
		),
		vc_map_add_css_animation(),
		g5plus_vc_map_add_animation_duration(),
		g5plus_vc_map_add_animation_delay(),
		g5plus_vc_map_add_extra_class(),
		g5plus_vc_map_add_css_editor()
	),
);