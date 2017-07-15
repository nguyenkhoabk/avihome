<?php
/*
*
*	Meta Box Functions
*	------------------------------------------------
*	G5Plus Framework
* 	Copyright Swift Ideas 2015 - http://www.g5plus.net
*
*/
/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function g5plus_register_meta_boxes()
{
	$meta_boxes = &G5Plus_Global::get_meta_boxes();
	$prefix = G5PLUS_METABOX_PREFIX;
	/* PAGE MENU */
	$menu_list = array();
	if (function_exists('g5plus_get_menu_list')) {
		$menu_list = g5plus_get_menu_list();
	}

	// PAGE LAYOUT
	$meta_boxes[] = array(
		'id'         => $prefix . 'page_layout_meta_box',
		'title'      => esc_html__('Page Layout', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name'     => esc_html__('Layout Style', 'g5plus-orson'),
				'id'       => $prefix . 'layout_style',
				'type'     => 'button_set',
				'options'  => array(
					'-1'    => esc_html__('Default', 'g5plus-orson'),
					'boxed' => esc_html__('Boxed', 'g5plus-orson'),
					'wide'  => esc_html__('Wide', 'g5plus-orson')
				),
				'std'      => '-1',
				'multiple' => false,
			),
			array(
				'name'     => esc_html__('Layout', 'g5plus-orson'),
				'id'       => $prefix . 'layout',
				'type'     => 'button_set',
				'options'  => g5plus_get_page_layout(1),
				'std'      => -1,
				'multiple' => false,
			),
			array(
				'name'       => esc_html__('Sidebar Layout', 'g5plus-orson'),
				'id'         => $prefix . 'sidebar_layout',
				'type'       => 'image_set',
				'allowClear' => true,
				'options'    => array(
					'none'  => G5PLUS_THEME_URL . '/assets/images/theme-options/sidebar-none.png',
					'left'  => G5PLUS_THEME_URL . '/assets/images/theme-options/sidebar-left.png',
					'right' => G5PLUS_THEME_URL . '/assets/images/theme-options/sidebar-right.png'
				),
				'std'        => '',
				'multiple'   => false,

			),
			array(
				'name'           => esc_html__('Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'sidebar',
				'type'           => 'sidebars',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array($prefix . 'sidebar_layout', '=', array('', 'right', 'left')),
			),

			array(
				'name'           => esc_html__('Sidebar Width', 'g5plus-orson'),
				'id'             => $prefix . 'sidebar_width',
				'type'           => 'button_set',
				'options'        => g5plus_get_sidebar_width(1),
				'std'            => -1,
				'multiple'       => false,
				'required-field' => array($prefix . 'sidebar_layout', '<>', 'none'),
			),

			array(
				'name'           => esc_html__('Sidebar Mobile', 'g5plus-orson'),
				'id'             => $prefix . 'sidebar_mobile_enable',
				'type'           => 'button_set',
				'options'        => g5plus_get_toggle(true),
				'std'            => -1,
				'multiple'       => false,
				'required-field' => array($prefix . 'sidebar_layout', '<>', 'none'),
			),

			array(
				'name'           => esc_html__( 'Canvas Sidebar Mobile', 'g5plus-orson' ),
				'id'             => $prefix . 'sidebar_mobile_canvas',
				'type'           => 'button_set',
				'options'        => g5plus_get_toggle( true ),
				'std'            => - 1,
				'multiple'       => false,
				'required-field' => array( $prefix . 'sidebar_mobile_enable', '=', 1 ),
			),

			//content_padding

			array(
				'name' => esc_html__('Remove Content Padding', 'g5plus-orson'),
				'id'   => $prefix . 'remove_content_padding',
				'type' => 'checkbox',
				'std'  => 0,
			),

			array(
				'id'    => $prefix . 'content_padding',
				'name'  => esc_html__('Content Padding', 'g5plus-orson'),
				'desc'  => esc_html__('Set content top/bottom padding. Do not include units (empty to set default). Allow values (0,5,10,15....100)', 'g5plus-orson'),
				'type'  => 'padding',
				'allow' => array(
					'left'  => false,
					'right' => false
				),
				'required-field' => array($prefix . 'remove_content_padding', '=', '0'),
			),

			array(
				'id'    => $prefix . 'content_padding_mobile',
				'name'  => esc_html__('Content Padding Mobile', 'g5plus-orson'),
				'desc'  => esc_html__('Set content top/bottom padding mobile. Do not include units (empty to set default). Allow values (0,5,10,15....100)', 'g5plus-orson'),
				'type'  => 'padding',
				'allow' => array(
					'left'  => false,
					'right' => false
				),
				'required-field' => array($prefix . 'remove_content_padding', '=', '0'),
			),



			array(
				'name' => esc_html__('Page Class Extra', 'g5plus-orson'),
				'id'   => $prefix . 'page_class_extra',
				'type' => 'text',
				'std'  => ''
			),
		)
	);

	// LOGO
	$meta_boxes[] = array(
		'id'         => $prefix . 'page_logo_meta_box',
		'title'      => esc_html__('Logo', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name' => esc_html__('Desktop Settings', 'g5plus-orson'),
				'id'   => $prefix . 'page_logo_section_1',
				'type' => 'section',
				'std'  => '',
			),
			array(
				'id'               => $prefix . 'logo',
				'name'             => esc_html__('Header Logo', 'g5plus-orson'),
				'desc'             => esc_html__('Upload custom logo in header.', 'g5plus-orson'),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'               => $prefix . 'logo_retina',
				'name'             => esc_html__('Header Logo Retina', 'g5plus-orson'),
				'desc'             => esc_html__('Upload custom logo retina in header.', 'g5plus-orson'),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'               => $prefix . 'sticky_logo',
				'name'             => esc_html__('Sticky Logo', 'g5plus-orson'),
				'desc'             => esc_html__('Upload sticky logo in header (empty to default)', 'g5plus-orson'),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'               => $prefix . 'sticky_logo_retina',
				'name'             => esc_html__('Sticky Logo Retina', 'g5plus-orson'),
				'desc'             => esc_html__('Upload sticky logo retina in header (empty to default)', 'g5plus-orson'),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'   => $prefix . 'logo_max_height',
				'name' => esc_html__('Logo max height', 'g5plus-orson'),
				'desc' => esc_html__('Logo max height (px). Do not include units (empty to set default)', 'g5plus-orson'),
				'type' => 'text',
				'sdt'  => '',
			),
			array(
				'id'    => $prefix . 'logo_padding',
				'name'  => esc_html__('Logo padding', 'g5plus-orson'),
				'desc'  => esc_html__('Logo padding top. Do not include units (empty to set default)', 'g5plus-orson'),
				'type'  => 'padding',
				'allow' => array(
					'left'  => false,
					'right' => false
				),
			),

			array(
				'name' => esc_html__('Mobile Settings', 'g5plus-orson'),
				'id'   => $prefix . 'page_logo_section_2',
				'type' => 'section',
				'std'  => '',
			),
			array(
				'id'               => $prefix . 'mobile_logo',
				'name'             => esc_html__('Mobile Logo', 'g5plus-orson'),
				'desc'             => esc_html__('Upload mobile logo in header.', 'g5plus-orson'),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'               => $prefix . 'mobile_logo_retina',
				'name'             => esc_html__('Mobile Logo Retina', 'g5plus-orson'),
				'desc'             => esc_html__('Upload mobile logo retina in header.', 'g5plus-orson'),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'id'   => $prefix . 'mobile_logo_max_height',
				'name' => esc_html__('Mobile Logo Max Height', 'g5plus-orson'),
				'desc' => esc_html__('Logo max height (px). Do not include units (empty to set default)', 'g5plus-orson'),
				'type' => 'text',
				'sdt'  => '',
			),
			array(
				'id'    => $prefix . 'mobile_logo_padding',
				'name'  => esc_html__('Mobile logo padding', 'g5plus-orson'),
				'desc'  => esc_html__('Mobile logo padding top. Do not include units (empty to set default)', 'g5plus-orson'),
				'type'  => 'padding',
				'allow' => array(
					'left'  => false,
					'right' => false
				),
			),
		)
	);

	// TOP DRAWER
	$meta_boxes[] = array(
		'id'         => $prefix . 'top_drawer_meta_box',
		'title'      => esc_html__('Top drawer', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name'    => esc_html__('Top Drawer Type', 'g5plus-orson'),
				'id'      => $prefix . 'top_drawer_type',
				'type'    => 'button_set',
				'std'     => '-1',
				'options' => array(
					'-1'     => esc_html__('Default', 'g5plus-orson'),
					'none'   => esc_html__('Disable', 'g5plus-orson'),
					'show'   => esc_html__('Always Show', 'g5plus-orson'),
					'toggle' => esc_html__('Toggle', 'g5plus-orson')
				),
				'desc'    => esc_html__('Top drawer type', 'g5plus-orson'),
			),
			array(
				'name'           => esc_html__('Top Drawer Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'top_drawer_sidebar',
				'type'           => 'sidebars',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array($prefix . 'top_drawer_type', '<>', 'none'),
			),

			array(
				'name'           => esc_html__('Top Drawer Wrapper Layout', 'g5plus-orson'),
				'id'             => $prefix . 'top_drawer_wrapper_layout',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'              => esc_html__('Default', 'g5plus-orson'),
					'full'            => esc_html__('Full Width', 'g5plus-orson'),
					'container'       => esc_html__('Container', 'g5plus-orson'),
					'container-fluid' => esc_html__('Container Fluid', 'g5plus-orson')
				),
				'required-field' => array($prefix . 'top_drawer_type', '<>', 'none'),
			),

			array(
				'name'           => esc_html__('Top Drawer hide on mobile', 'g5plus-orson'),
				'id'             => $prefix . 'top_drawer_hide_mobile',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => esc_html__('Show on mobile', 'g5plus-orson'),
					'0'  => esc_html__('Hide on mobile', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'top_drawer_type', '<>', 'none'),
			),
			array(
				'id'    => $prefix . 'top_drawer_padding',
				'name'  => esc_html__('Top drawer padding', 'g5plus-orson'),
				'desc'  => esc_html__('Top drawer padding top. Do not include units (empty to set default)', 'g5plus-orson'),
				'type'  => 'padding',
				'allow' => array(
					'left'  => false,
					'right' => false
				),
			),
		)
	);

	// TOP BAR
	$meta_boxes[] = array(
		'id'         => $prefix . 'top_bar_meta_box',
		'title'      => esc_html__('Top Bar', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name' => esc_html__('Desktop Settings', 'g5plus-orson'),
				'id'   => $prefix . 'top_bar_desktop_section',
				'type' => 'section',
				'std'  => 0,
			),
			array(
				'name'    => esc_html__('Show/Hide Top Bar', 'g5plus-orson'),
				'id'      => $prefix . 'top_bar_enable',
				'type'    => 'button_set',
				'std'     => '-1',
				'options' => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => esc_html__('Show', 'g5plus-orson'),
					'0'  => esc_html__('Hide', 'g5plus-orson')
				),
				'desc'    => esc_html__('Show/Hide Top Bar.', 'g5plus-orson'),
			),

			array(
				'name'           => esc_html__('Top Bar Layout', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_layout',
				'type'           => 'image_set',
				'width'          => '80px',
				'allowClear'     => true,
				'std'            => '',
				'options'        => array(
					'top-bar-1' => G5PLUS_THEME_URL . 'assets/images/theme-options/top-bar-layout-1.jpg',
					'top-bar-2' => G5PLUS_THEME_URL . 'assets/images/theme-options/top-bar-layout-2.jpg',
					'top-bar-3' => G5PLUS_THEME_URL . 'assets/images/theme-options/top-bar-layout-3.jpg',
					'top-bar-4' => G5PLUS_THEME_URL . 'assets/images/theme-options/top-bar-layout-4.jpg'
				),
				'required-field' => array(
					array($prefix . 'top_bar_enable', '<>', '0'),
				),
			),

			array(
				'name'           => esc_html__('Top Left Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_left_sidebar',
				'type'           => 'sidebars',
				'std'            => '',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'required-field' => array(
					array($prefix . 'top_bar_enable', '<>', '0'),
				),
			),

			array(
				'name'           => esc_html__('Top Right Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_right_sidebar',
				'type'           => 'sidebars',
				'std'            => '',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'required-field' => array(
					array($prefix . 'top_bar_enable', '<>', '0'),
				),
			),

			array(
				'name'           => esc_html__('Top Bar Border', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_border',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'               => esc_html__('Default', 'g5plus-orson'),
					'none'             => esc_html__('None', 'g5plus-orson'),
					'full-border'      => esc_html__('Full Border', 'g5plus-orson'),
					'container-border' => esc_html__('Container Border', 'g5plus-orson'),
				),
				'desc'           => esc_html__('Show Hide Top Bar.', 'g5plus-orson'),
				'required-field' => array(
					array($prefix . 'top_bar_enable', '<>', '0'),
				),
			),
			array(
				'id'             => $prefix . 'top_bar_padding',
				'name'           => esc_html__('Top bar padding', 'g5plus-orson'),
				'desc'           => esc_html__('Top bar padding top. Do not include units (empty to set default)', 'g5plus-orson'),
				'type'           => 'padding',
				'allow'          => array(
					'left'  => false,
					'right' => false
				),
				'required-field' => array(
					array($prefix . 'top_bar_enable', '<>', '0'),
				),
			),

			array(
				'name' => esc_html__('Mobile Settings', 'g5plus-orson'),
				'id'   => $prefix . 'top_bar_mobile_section',
				'type' => 'section',
				'std'  => '',
			),
			array(
				'name'    => esc_html__('Show/Hide Top Bar', 'g5plus-orson'),
				'id'      => $prefix . 'top_bar_mobile_enable',
				'type'    => 'button_set',
				'options' => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => esc_html__('Show', 'g5plus-orson'),
					'0'  => esc_html__('Hide', 'g5plus-orson')
				),
				'std'     => '-1',
				'desc'    => esc_html__('Show/Hide Top Bar.', 'g5plus-orson'),
			),
			array(
				'name'           => esc_html__('Top Bar Layout', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_mobile_layout',
				'type'           => 'image_set',
				'width'          => '80px',
				'allowClear'     => true,
				'std'            => '',
				'options'        => array(
					'top-bar-1' => G5PLUS_THEME_URL . 'assets/images/theme-options/top-bar-layout-1.jpg',
					'top-bar-2' => G5PLUS_THEME_URL . 'assets/images/theme-options/top-bar-layout-2.jpg',
					'top-bar-3' => G5PLUS_THEME_URL . 'assets/images/theme-options/top-bar-layout-3.jpg',
					'top-bar-4' => G5PLUS_THEME_URL . 'assets/images/theme-options/top-bar-layout-4.jpg'
				),
				'required-field' => array(
					array($prefix . 'top_bar_mobile_enable', '<>', '0'),
				),
			),

			array(
				'name'           => esc_html__('Top Left Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_mobile_left_sidebar',
				'type'           => 'sidebars',
				'std'            => '',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'required-field' => array(
					array($prefix . 'top_bar_mobile_enable', '<>', '0'),
				),
			),

			array(
				'name'           => esc_html__('Top Right Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_mobile_right_sidebar',
				'type'           => 'sidebars',
				'std'            => '',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'required-field' => array(
					array($prefix . 'top_bar_mobile_enable', '<>', '0'),
				),
			),
			array(
				'name'           => esc_html__('Top Bar Border', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_mobile_border',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'               => esc_html__('Default', 'g5plus-orson'),
					'none'             => esc_html__('None', 'g5plus-orson'),
					'full-border'      => esc_html__('Full Border', 'g5plus-orson'),
					'container-border' => esc_html__('Container Border', 'g5plus-orson'),
				),
				'desc'           => esc_html__('Show Hide Top Bar.', 'g5plus-orson'),
				'required-field' => array(
					array($prefix . 'top_bar_mobile_enable', '<>', '0'),
				),
			),
		)
	);

	// PAGE HEADER
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id'         => $prefix . 'page_header_meta_box',
		'title'      => esc_html__('Header', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name' => esc_html__('Header On/Off?', 'g5plus-orson'),
				'id'   => $prefix . 'header_show_hide',
				'type' => 'checkbox',
				'desc' => esc_html__('Turn ON/Off Header', 'g5plus-orson'),
				'std'  => '1',
			),
			array(
				'name'           => esc_html__('Desktop Settings', 'g5plus-orson'),
				'id'             => $prefix . 'page_header_customize_enable',
				'type'           => 'section',
				'std'            => '',
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'name'           => esc_html__('Header Layout', 'g5plus-orson'),
				'id'             => $prefix . 'header_layout',
				'type'           => 'image_set',
				'allowClear'     => true,
				'std'            => '',
				'options'        => array(
					'header-1'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-1.png',
					'header-2'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-2.png',
					'header-3'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-3.png',
					'header-4'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-4.png',
					'header-5'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-5.png',
					'header-6'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-6.png',
					'header-7'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-7.png',
					'header-8'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-8.png',
					'header-9'  => G5PLUS_THEME_URL . '/assets/images/theme-options/header-9.png',
					'header-10' => G5PLUS_THEME_URL . '/assets/images/theme-options/header-10.png',
					'header-11' => G5PLUS_THEME_URL . '/assets/images/theme-options/header-11.png',
					'header-12' => G5PLUS_THEME_URL . '/assets/images/theme-options/header-12.png',
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'header_container_layout',
				'name'           => esc_html__('Header Container Layout', 'g5plus-orson'),
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'             => esc_html__('Default', 'g5plus-orson'),
					'container'      => esc_html__('Container', 'g5plus-orson'),
					'container-full' => esc_html__('Container Full', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'header_float',
				'name'           => esc_html__('Header Float', 'g5plus-orson'),
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => esc_html__('On', 'g5plus-orson'),
					'0'  => esc_html__('Off', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'header_sticky',
				'name'           => esc_html__('Show/Hide Header Sticky', 'g5plus-orson'),
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => esc_html__('On', 'g5plus-orson'),
					'0'  => esc_html__('Off', 'g5plus-orson')
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'header_border_bottom',
				'name'           => esc_html__('Header border bottom', 'g5plus-orson'),
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'                => esc_html__('Default', 'g5plus-orson'),
					'none'              => esc_html__('None','g5plus-orson'),
					'full-border'       => esc_html__('Full Border','g5plus-orson'),
					'container-border'  => esc_html__('Container Border','g5plus-orson'),
				),
				'required-field' => array(
					array($prefix . 'header_show_hide', '<>', '0'),
					array($prefix . 'header_layout', '=', array('header-1', 'header-3', 'header-4', 'header-5', 'header-7', 'header-11', 'header-12')),
				),
			),
			array(
				'id'             => $prefix . 'header_above_border_bottom',
				'name'           => esc_html__('Header above border bottom', 'g5plus-orson'),
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'                => esc_html__('Default', 'g5plus-orson'),
					'none'              => esc_html__('None','g5plus-orson'),
					'full-border'       => esc_html__('Full Border','g5plus-orson'),
					'container-border'  => esc_html__('Container Border','g5plus-orson'),
				),
				'required-field' => array(
					array($prefix . 'header_show_hide', '<>', '0'),
					array($prefix . 'header_layout', '=', array('header-3', 'header-4', 'header-5', 'header-7', 'header-11', 'header-12')),
				),
			),
			array(
				'id'             => $prefix . 'header_padding',
				'name'           => esc_html__('Header padding', 'g5plus-orson'),
				'desc'           => esc_html__('Header padding top. Do not include units (empty to set default)', 'g5plus-orson'),
				'type'           => 'padding',
				'allow'          => array(
					'left'  => false,
					'right' => false
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'navigation_height',
				'name'           => esc_html__('Navigation height', 'g5plus-orson'),
				'type'           => 'text',
				'desc'           => esc_html__('Set header navigation height (px). Do not include unit.', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array(
					array($prefix . 'header_show_hide', '<>', '0'),
					array($prefix . 'header_layout', '<>', 'header-1')
				),
			),

			//-----------------------------------------------------------------------
			array(
				'name'           => esc_html__('Page Header Mobile', 'g5plus-orson'),
				'id'             => $prefix . 'page_header_section_2',
				'type'           => 'section',
				'std'            => '',
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'name'           => esc_html__('Header Mobile Layout', 'g5plus-orson'),
				'id'             => $prefix . 'mobile_header_layout',
				'type'           => 'image_set',
				'allowClear'     => true,
				'std'            => '',
				'options'        => array(
					'header-mobile-1' => G5PLUS_THEME_URL . 'assets/images/theme-options/header-mobile-layout-1.png',
					'header-mobile-2' => G5PLUS_THEME_URL . 'assets/images/theme-options/header-mobile-layout-2.png',
					'header-mobile-3' => G5PLUS_THEME_URL . 'assets/images/theme-options/header-mobile-layout-3.png',
					'header-mobile-4' => G5PLUS_THEME_URL . 'assets/images/theme-options/header-mobile-layout-4.png',
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'mobile_header_menu_drop',
				'name'           => esc_html__('Menu Drop Type', 'g5plus-orson'),
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'                 => esc_html__('Default', 'g5plus-orson'),
					'menu-drop-dropdown' => esc_html__('Dropdown Menu', 'g5plus-orson'),
					'menu-drop-fly'      => esc_html__('Fly Menu', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'mobile_header_stick',
				'name'           => esc_html__('Header mobile sticky', 'g5plus-orson'),
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => esc_html__('Enable', 'g5plus-orson'),
					'0'  => esc_html__('Disable', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'name'           => esc_html__('Mobile Header Search Box', 'g5plus-orson'),
				'id'             => $prefix . 'mobile_header_search_box',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => esc_html__('Show', 'g5plus-orson'),
					'0'  => esc_html__('Hide', 'g5plus-orson')
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),

			array(
				'name'           => esc_html__('Mobile Header Shopping Cart', 'g5plus-orson'),
				'id'             => $prefix . 'mobile_header_shopping_cart',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => esc_html__('Show', 'g5plus-orson'),
					'0'  => esc_html__('Hide', 'g5plus-orson')
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'mobile_header_border_bottom',
				'name'           => esc_html__('Mobile header border bottom', 'g5plus-orson'),
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'       => esc_html__('Default', 'g5plus-orson'),
					'none'     => esc_html__('None', 'g5plus-orson'),
					'bordered' => esc_html__('Bordered', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'header_show_hide', '<>', '0'),
			),
		)
	);

	// HEADER CUSTOMIZE
	$meta_boxes[] = array(
		'id'         => $prefix . 'page_header_customize_meta_box',
		'title'      => esc_html__('Header Customize', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			//-------------------------------------------------------------------------
			array(
				'name'   => esc_html__('Header Customize Left', 'g5plus-orson'),
				'id'     => $prefix . 'enable_header_customize_left',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Header Customize Left', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_left',
				'type'           => 'sorter',
				'std'            => '',
				'desc'           => esc_html__('Select element for header customize left. Drag to change element order', 'g5plus-orson'),
				'options'        => array(
					'email'         => esc_html__('Email', 'g5plus-orson'),
					'phone'         => esc_html__('Phone', 'g5plus-orson'),
					'shopping-cart' => esc_html__('Shopping Cart', 'g5plus-orson'),
					'search'        => esc_html__('Search Button', 'g5plus-orson'),
					'sidebar'       => esc_html__('Sidebar', 'g5plus-orson'),
					'custom-text'   => esc_html__('Custom Text', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'enable_header_customize_left', '=', '1'),
			),
			array(
				'name'           => esc_html__('Email', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_left_email',
				'type'           => 'label_text',
				'std'            => array(
					'label' => esc_html__('Email Us', 'g5plus-orson'),
					'text'  => ''
				),
				'required-field' => array($prefix . 'enable_header_customize_left', '=', '1'),
			),
			array(
				'name'           => esc_html__('Phone', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_left_phone',
				'type'           => 'label_text',
				'std'            => array(
					'label' => esc_html__('Call Us', 'g5plus-orson'),
					'text'  => ''
				),
				'required-field' => array($prefix . 'enable_header_customize_left', '=', '1'),
			),
			array(
				'name'           => esc_html__('Search Type', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_left_search',
				'type'           => 'button_set',
				'std'            => 'button',
				'options'        => g5plus_get_search_type(),
				'required-field' => array($prefix . 'enable_header_customize_left', '=', '1'),
			),
			array(
				'name'           => esc_html__('Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_left_sidebar',
				'type'           => 'sidebars',
				'std'            => '',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'required-field' => array($prefix . 'enable_header_customize_left', '=', '1'),
			),
			array(
				'name'           => esc_html__('Custom text content left', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_left_text',
				'type'           => 'textarea',
				'std'            => '',
				'required-field' => array($prefix . 'enable_header_customize_left', '=', '1'),
			),
			array(
				'id'             => $prefix . 'header_customize_left_spacing',
				'name'           => esc_html__('Navigation Item Spacing (px)', 'g5plus-orson'),
				'clone'          => false,
				'type'           => 'slider',
				'prefix'         => '',
				'std'            => '40',
				'js_options'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_header_customize_left', '=', '1'),
			),

			//------------------------------------------------------------------
			array(
				'name'   => esc_html__('Header Customize Right', 'g5plus-orson'),
				'id'     => $prefix . 'enable_header_customize_right',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Header Customize Right', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_right',
				'type'           => 'sorter',
				'std'            => '',
				'desc'           => esc_html__('Select element for header customize right. Drag to change element order', 'g5plus-orson'),
				'options'        => array(
					'email'         => esc_html__('Email', 'g5plus-orson'),
					'phone'         => esc_html__('Phone', 'g5plus-orson'),
					'shopping-cart' => esc_html__('Shopping Cart', 'g5plus-orson'),
					'search'        => esc_html__('Search Button', 'g5plus-orson'),
					'sidebar'       => esc_html__('Sidebar', 'g5plus-orson'),
					'custom-text'   => esc_html__('Custom Text', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'enable_header_customize_right', '=', '1'),
			),
			array(
				'name'           => esc_html__('Email', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_right_email',
				'type'           => 'label_text',
				'std'            => array(
					'label' => esc_html__('Email Us', 'g5plus-orson'),
					'text'  => ''
				),
				'required-field' => array($prefix . 'enable_header_customize_right', '=', '1'),
			),
			array(
				'name'           => esc_html__('Phone', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_right_phone',
				'type'           => 'label_text',
				'std'            => array(
					'label' => esc_html__('Call Us', 'g5plus-orson'),
					'text'  => ''
				),
				'required-field' => array($prefix . 'enable_header_customize_right', '=', '1'),
			),
			array(
				'name'           => esc_html__('Search Type', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_right_search',
				'type'           => 'button_set',
				'std'            => 'button',
				'options'        => g5plus_get_search_type(),
				'required-field' => array($prefix . 'enable_header_customize_right', '=', '1'),
			),
			array(
				'name'           => esc_html__('Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_right_sidebar',
				'type'           => 'sidebars',
				'std'            => '',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'required-field' => array($prefix . 'enable_header_customize_right', '=', '1'),
			),
			array(
				'name'           => esc_html__('Custom text content right', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_right_text',
				'type'           => 'textarea',
				'std'            => '',
				'required-field' => array($prefix . 'enable_header_customize_right', '=', '1'),
			),
			array(
				'id'             => $prefix . 'header_customize_right_spacing',
				'name'           => esc_html__('Navigation Item Spacing (px)', 'g5plus-orson'),
				'clone'          => false,
				'type'           => 'slider',
				'prefix'         => '',
				'std'            => '40',
				'js_options'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_header_customize_right', '=', '1'),
			),

			//------------------------------------------------------------------
			array(
				'name'   => esc_html__('Header Customize Navigation', 'g5plus-orson'),
				'id'     => $prefix . 'enable_header_customize_nav',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Header Customize Navigation', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_nav',
				'type'           => 'sorter',
				'std'            => '',
				'desc'           => esc_html__('Select element for header customize navigation. Drag to change element order', 'g5plus-orson'),
				'options'        => array(
					'email'         => esc_html__('Email', 'g5plus-orson'),
					'phone'         => esc_html__('Phone', 'g5plus-orson'),
					'shopping-cart' => esc_html__('Shopping Cart', 'g5plus-orson'),
					'search'        => esc_html__('Search Button', 'g5plus-orson'),
					'sidebar'       => esc_html__('Sidebar', 'g5plus-orson'),
					'custom-text'   => esc_html__('Custom Text', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'enable_header_customize_nav', '=', '1'),
			),
			array(
				'name'           => esc_html__('Email', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_nav_email',
				'type'           => 'label_text',
				'std'            => array(
					'label' => esc_html__('Email Us', 'g5plus-orson'),
					'text'  => ''
				),
				'required-field' => array($prefix . 'enable_header_customize_nav', '=', '1'),
			),
			array(
				'name'           => esc_html__('Phone', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_nav_phone',
				'type'           => 'label_text',
				'std'            => array(
					'label' => esc_html__('Call Us', 'g5plus-orson'),
					'text'  => ''
				),
				'required-field' => array($prefix . 'enable_header_customize_nav', '=', '1'),
			),
			array(
				'name'           => esc_html__('Search Type', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_nav_search',
				'type'           => 'button_set',
				'std'            => 'button',
				'options'        => g5plus_get_search_type(),
				'required-field' => array($prefix . 'enable_header_customize_nav', '=', '1'),
			),
			array(
				'name'           => esc_html__('Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_nav_sidebar',
				'type'           => 'sidebars',
				'std'            => '',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'required-field' => array($prefix . 'enable_header_customize_nav', '=', '1'),
			),
			array(
				'name'           => esc_html__('Custom text content', 'g5plus-orson'),
				'id'             => $prefix . 'header_customize_nav_text',
				'type'           => 'textarea',
				'std'            => '',
				'required-field' => array($prefix . 'enable_header_customize_nav', '=', '1'),
			),
			array(
				'id'             => $prefix . 'header_customize_nav_spacing',
				'name'           => esc_html__('Navigation Item Spacing (px)', 'g5plus-orson'),
				'clone'          => false,
				'type'           => 'slider',
				'prefix'         => '',
				'std'            => '40',
				'js_options'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_header_customize_nav', '=', '1'),
			),
		)
	);

	// MENU
	$meta_boxes[] = array(
		'id'         => $prefix . 'page_menu_meta_box',
		'title'      => esc_html__('Menu', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name'        => esc_html__('Page menu', 'g5plus-orson'),
				'id'          => $prefix . 'page_menu',
				'type'        => 'select_advanced',
				'options'     => $menu_list,
				'placeholder' => esc_html__('Select Menu', 'g5plus-orson'),
				'std'         => '',
				'multiple'    => false,
				'desc'        => esc_html__('Optionally you can choose to override the menu that is used on the page', 'g5plus-orson'),
			),

			array(
				'name'        => esc_html__('Page menu mobile', 'g5plus-orson'),
				'id'          => $prefix . 'page_menu_mobile',
				'type'        => 'select_advanced',
				'options'     => $menu_list,
				'placeholder' => esc_html__('Select Menu', 'g5plus-orson'),
				'std'         => '',
				'multiple'    => false,
				'desc'        => esc_html__('Optionally you can choose to override the menu mobile that is used on the page', 'g5plus-orson'),
			),

			array(
				'name' => esc_html__('Is One Page', 'g5plus-orson'),
				'id'   => $prefix . 'is_one_page',
				'type' => 'checkbox',
				'std'  => '0',
				'desc' => esc_html__('Set page style is One Page', 'g5plus-orson'),
			),
		)
	);


	// PAGE TITLE
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id'         => $prefix . 'page_title_meta_box',
		'title'      => esc_html__('Page Title', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name'    => esc_html__('Show/Hide Page Title?', 'g5plus-orson'),
				'id'      => $prefix . 'page_title_enable',
				'type'    => 'button_set',
				'std'     => -1,
				'options' => g5plus_get_toggle(1)
			),

			array(
				'name'           => esc_html__('Page Title Layout', 'g5plus-orson'),
				'id'             => $prefix . 'page_title_layout',
				'type'           => 'button_set',
				'std'            => -1,
				'options'        => g5plus_get_page_title_layout(1),
				'required-field' => array($prefix . 'page_title_enable', '<>', 0),
			),

			array(
				'name'           => esc_html__('Custom Page Title', 'g5plus-orson'),
				'id'             => $prefix . 'page_title_custom',
				'desc'           => esc_html__("Enter a custom page title if you'd like.", 'g5plus-orson'),
				'type'           => 'text',
				'std'            => '',
				'required-field' => array(
					array($prefix . 'page_title_enable', '<>', 0),
					array($prefix . 'page_title_layout', '<>', 'only-breadcrumb'),
				)
			),

			array(
				'name'           => esc_html__('Custom Page Subtitle?', 'g5plus-orson'),
				'id'             => $prefix . 'enable_custom_page_subtitle',
				'type'           => 'checkbox',
				'std'            => 0,
				'required-field' => array(
					array($prefix . 'page_title_enable', '<>', 0),
					array($prefix . 'page_title_layout', '<>', 'only-breadcrumb'),
				)
			),

			array(
				'name'           => esc_html__('Custom Page Subtitle', 'g5plus-orson'),
				'id'             => $prefix . 'page_subtitle_custom',
				'desc'           => esc_html__("Enter a custom page title if you'd like.", 'g5plus-orson'),
				'type'           => 'text',
				'std'            => '',
				'required-field' => array(
					array($prefix . 'page_title_enable', '<>', 0),
					array($prefix . 'enable_custom_page_subtitle', '=', 1),
					array($prefix . 'page_title_layout', '<>', 'only-breadcrumb'),
				),
			),

			array(
				'id'             => $prefix . 'page_title_padding',
				'name'           => esc_html__('Padding', 'g5plus-orson'),
				'desc'           => esc_html__('Enter a page title padding top value (not include unit)', 'g5plus-orson'),
				'type'           => 'padding',
				'allow'          => array(
					'left'  => false,
					'right' => false
				),
				'required-field' => array(
					array($prefix . 'page_title_enable', '<>', 0),
					array($prefix . 'page_title_layout', '<>', 'only-breadcrumb'),
				)
			),

			array(
				'name'           => esc_html__('Custom Background Image?', 'g5plus-orson'),
				'id'             => $prefix . 'enable_custom_page_title_bg_image',
				'type'           => 'checkbox',
				'std'            => 0,
				'required-field' => array(
					array($prefix . 'page_title_enable', '<>', 0),
					array($prefix . 'page_title_layout', '<>', 'only-breadcrumb'),
				)
			),

			// BACKGROUND IMAGE
			array(
				'id'               => $prefix . 'page_title_bg_image',
				'name'             => esc_html__('Background Image', 'g5plus-orson'),
				'desc'             => esc_html__('Background Image for page title.', 'g5plus-orson'),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'required-field'   => array(
					array($prefix . 'page_title_enable', '<>', 0),
					array($prefix . 'enable_custom_page_title_bg_image', '<>', 0),
					array($prefix . 'page_title_layout', '<>', 'only-breadcrumb'),
				)
			),

			array(
				'name'           => esc_html__('Page Title Parallax', 'g5plus-orson'),
				'id'             => $prefix . 'page_title_parallax',
				'desc'           => esc_html__("Enable Page Title Parallax", 'g5plus-orson'),
				'type'           => 'button_set',
				'options'        => g5plus_get_toggle(1),
				'std'            => -1,
				'required-field' => array(
					array($prefix . 'page_title_enable', '<>', 0),
					array($prefix . 'page_title_layout', '<>', 'only-breadcrumb'),
				)
			),

			// Breadcrumbs in Page Title
			array(
				'name'           => esc_html__('Breadcrumbs Enable', 'g5plus-orson'),
				'id'             => $prefix . 'breadcrumbs_enable',
				'desc'           => esc_html__("Show/Hide Breadcrumbs", 'g5plus-orson'),
				'type'           => 'button_set',
				'options'        => g5plus_get_toggle(1),
				'std'            => -1,
				'required-field' => array(
					array($prefix . 'page_title_enable', '<>', 0),
					array($prefix . 'page_title_layout', '<>', 'only-breadcrumb'),
				)
			),
		)
	);

	// PAGE FOOTER
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id'         => $prefix . 'page_footer_meta_box',
		'title'      => esc_html__('Footer', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name' => esc_html__('General Settings', 'g5plus-orson'),
				'id'   => $prefix . 'page_footer_section_1',
				'type' => 'section',
				'std'  => '',
			),
			array(
				'name' => esc_html__('Show/Hide Footer', 'g5plus-orson'),
				'id'   => $prefix . 'footer_show_hide',
				'type' => 'checkbox',
				'std'  => '1',
				'desc' => esc_html__('Show/hide footer', 'g5plus-orson'),
			),
			array(
				'name'           => esc_html__('Footer Container Layout', 'g5plus-orson'),
				'id'             => $prefix . 'footer_container_layout',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'              => esc_html__('Default', 'g5plus-orson'),
					'full'            => esc_html__('Full Width', 'g5plus-orson'),
					'container-fluid' => esc_html__('Container Fluid', 'g5plus-orson'),
					'container'       => esc_html__('Container', 'g5plus-orson'),
				),
				'desc'           => esc_html__('Select Footer Wrapper Layout', 'g5plus-orson'),
				'required-field' => array($prefix . 'footer_show_hide', '=', '1'),
			),
			array(
				'name'           => esc_html__('Layout', 'g5plus-orson'),
				'id'             => $prefix . 'footer_layout',
				'type'           => 'image_set',
				'allowClear'     => true,
				'width'          => '80px',
				'std'            => '',
				'options'        => array(
					'footer-1' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-1.jpg',
					'footer-2' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-2.jpg',
					'footer-3' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-3.jpg',
					'footer-4' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-4.jpg',
					'footer-5' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-5.jpg',
					'footer-6' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-6.jpg',
					'footer-7' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-7.jpg',
					'footer-8' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-8.jpg',
					'footer-9' => G5PLUS_THEME_URL . '/assets/images/theme-options/footer-layout-9.jpg',
				),
				'desc'           => esc_html__('Select Footer Layout (Not set to default).', 'g5plus-orson'),
				'required-field' => array($prefix . 'footer_show_hide', '<>', '0'),
			),
			array(
				'name'           => esc_html__('Sidebar 1', 'g5plus-orson'),
				'id'             => $prefix . 'footer_sidebar_1',
				'type'           => 'sidebars',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array(
					array($prefix . 'footer_show_hide', '=', '1'),
					array($prefix . 'footer_layout', '=', array('footer-1', 'footer-2', 'footer-3', 'footer-4', 'footer-5', 'footer-6', 'footer-7', 'footer-8', 'footer-9'))
				),
			),

			array(
				'name'           => esc_html__('Sidebar 2', 'g5plus-orson'),
				'id'             => $prefix . 'footer_sidebar_2',
				'type'           => 'sidebars',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array(
					array($prefix . 'footer_show_hide', '=', '1'),
					array($prefix . 'footer_layout', '=', array('footer-1', 'footer-2', 'footer-3', 'footer-4', 'footer-5', 'footer-6', 'footer-7', 'footer-8'))
				),
			),

			array(
				'name'           => esc_html__('Sidebar 3', 'g5plus-orson'),
				'id'             => $prefix . 'footer_sidebar_3',
				'type'           => 'sidebars',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array(
					array($prefix . 'footer_show_hide', '=', '1'),
					array($prefix . 'footer_layout', '=', array('footer-1', 'footer-2', 'footer-3', 'footer-5', 'footer-8'))
				),
			),

			array(
				'name'           => esc_html__('Sidebar 4', 'g5plus-orson'),
				'id'             => $prefix . 'footer_sidebar_4',
				'type'           => 'sidebars',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array(
					array($prefix . 'footer_show_hide', '=', '1'),
					array($prefix . 'footer_layout', '=', array('footer-1'))
				),
			),
			array(
				'id'               => $prefix . 'footer_bg_image',
				'name'             => esc_html__('Background Image', 'g5plus-orson'),
				'desc'             => esc_html__('Set footer background image', 'g5plus-orson'),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'std'              => '',
				'required-field'   => array($prefix . 'footer_show_hide', '<>', '0'),
			),

			array(
				'name'           => esc_html__('Footer Parallax', 'g5plus-orson'),
				'id'             => $prefix . 'footer_parallax',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => 'On',
					'0'  => 'Off'
				),
				'desc'           => esc_html__('Enable Footer Parallax', 'g5plus-orson'),
				'required-field' => array($prefix . 'footer_show_hide', '<>', '0'),
			),

			array(
				'name'           => esc_html__('Collapse footer on mobile device', 'g5plus-orson'),
				'id'             => $prefix . 'collapse_footer',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1' => esc_html__('Default', 'g5plus-orson'),
					'1'  => 'On',
					'0'  => 'Off'
				),
				'desc'           => esc_html__('Enable collapse footer', 'g5plus-orson'),
				'required-field' => array($prefix . 'footer_show_hide', '<>', '0'),
			),
			array(
				'name'           => esc_html__('Footer Border Top', 'g5plus-orson'),
				'id'             => $prefix . 'footer_border_top',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'               => esc_html__('Default', 'g5plus-orson'),
					'none'             => esc_html__('None', 'g5plus-orson'),
					'full-border'      => esc_html__('Full Border', 'g5plus-orson'),
					'container-border' => esc_html__('Container Border', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'footer_show_hide', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'footer_padding',
				'name'           => esc_html__('Footer padding', 'g5plus-orson'),
				'desc'           => esc_html__('Footer padding top. Do not include units (empty to set default)', 'g5plus-orson'),
				'type'           => 'padding',
				'allow'          => array(
					'left'  => false,
					'right' => false
				),
				'required-field' => array($prefix . 'footer_show_hide', '<>', '0'),
			),

			//--------------------------------------------------------------------
			array(
				'name' => esc_html__('Bottom Bar Settings', 'g5plus-orson'),
				'id'   => $prefix . 'page_footer_section_3',
				'type' => 'section',
				'std'  => '',
			),
			array(
				'name' => esc_html__('Show/Hide Bottom Bar', 'g5plus-orson'),
				'id'   => $prefix . 'bottom_bar_visible',
				'type' => 'checkbox',
				'std'  => '1',
				'desc' => esc_html__('Turn ON/OFF Bottom Bar.', 'g5plus-orson'),
			),
			array(
				'name'           => esc_html__('Bottom Bar Layout', 'g5plus-orson'),
				'id'             => $prefix . 'bottom_bar_layout',
				'type'           => 'image_set',
				'allowClear'     => true,
				'width'          => '80px',
				'std'            => '',
				'options'        => array(
					'bottom-bar-1' => G5PLUS_THEME_URL . '/assets/images/theme-options/bottom-bar-layout-1.jpg',
					'bottom-bar-2' => G5PLUS_THEME_URL . '/assets/images/theme-options/bottom-bar-layout-2.jpg',
					'bottom-bar-3' => G5PLUS_THEME_URL . '/assets/images/theme-options/bottom-bar-layout-3.jpg',
					'bottom-bar-4' => G5PLUS_THEME_URL . '/assets/images/theme-options/bottom-bar-layout-4.jpg',
				),
				'desc'           => esc_html__('Bottom bar layout.', 'g5plus-orson'),
				'required-field' => array($prefix . 'bottom_bar_visible', '<>', '0'),
			),

			array(
				'name'           => esc_html__('Bottom Bar Left Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'bottom_bar_left_sidebar',
				'type'           => 'sidebars',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array(
					array($prefix . 'bottom_bar_visible', '<>', '0'),
				),
			),

			array(
				'name'           => esc_html__('Bottom Bar Right Sidebar', 'g5plus-orson'),
				'id'             => $prefix . 'bottom_bar_right_sidebar',
				'type'           => 'sidebars',
				'placeholder'    => esc_html__('Select Sidebar', 'g5plus-orson'),
				'std'            => '',
				'required-field' => array(
					array($prefix . 'bottom_bar_visible', '<>', '0'),
					array($prefix . 'bottom_bar_layout', '<>', 'bottom-bar-4')
				),
			),
			array(
				'name'           => esc_html__('Bottom Bar Border Top', 'g5plus-orson'),
				'id'             => $prefix . 'bottom_bar_border_top',
				'type'           => 'button_set',
				'std'            => '-1',
				'options'        => array(
					'-1'               => esc_html__('Default', 'g5plus-orson'),
					'none'             => esc_html__('None', 'g5plus-orson'),
					'full-border'      => esc_html__('Full Border', 'g5plus-orson'),
					'container-border' => esc_html__('Container Border', 'g5plus-orson'),
				),
				'required-field' => array($prefix . 'bottom_bar_visible', '<>', '0'),
			),
			array(
				'id'             => $prefix . 'bottom_bar_padding',
				'name'           => esc_html__('Bottom bar padding', 'g5plus-orson'),
				'desc'           => esc_html__('Set bottom bar padding. Do not include units (empty to set default)', 'g5plus-orson'),
				'type'           => 'padding',
				'allow'          => array(
					'left'  => false,
					'right' => false
				),
				'required-field' => array($prefix . 'bottom_bar_visible', '<>', '0'),
			),
		)
	);

	// Page Color
	//--------------------------------------------------
	$meta_boxes[] = array(
		'id'         => $prefix . 'page_color_meta_box',
		'title'      => esc_html__('Page Colors', 'g5plus-orson'),
		'post_types' => array('post', 'page', 'portfolio', 'product'),
		'tab'        => true,
		'fields'     => array(
			array(
				'name'   => esc_html__('Accent Color Customize?', 'g5plus-orson'),
				'id'     => $prefix . 'enable_accent_color',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Accent color', 'g5plus-orson'),
				'id'             => $prefix . 'accent_color',
				'type'           => 'color',
				'std'            => '#34A853',
				'required-field' => array($prefix . 'enable_accent_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Foreground Accent color', 'g5plus-orson'),
				'id'             => $prefix . 'foreground_accent_color',
				'type'           => 'color',
				'std'            => '#fff',
				'required-field' => array($prefix . 'enable_accent_color', '=', '1'),
			),

			//------------------------------------------------------------------------
			array(
				'name'   => esc_html__('Top Drawer Customize?', 'g5plus-orson'),
				'id'     => $prefix . 'enable_top_drawer_color',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Top drawer background color', 'g5plus-orson'),
				'id'             => $prefix . 'top_drawer_bg_color',
				'type'           => 'color',
				'std'            => '#2f2f2f',
				'required-field' => array($prefix . 'enable_top_drawer_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Top drawer text color', 'g5plus-orson'),
				'id'             => $prefix . 'top_drawer_text_color',
				'type'           => 'color',
				'std'            => '#c5c5c5',
				'required-field' => array($prefix . 'enable_top_drawer_color', '=', '1'),
			),

			//------------------------------------------------------------------------
			array(
				'name'   => esc_html__('Top Bar Customize?', 'g5plus-orson'),
				'id'     => $prefix . 'enable_top_bar_color',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Top bar background color', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_bg_color',
				'type'           => 'color',
				'std'            => '#eee',
				'required-field' => array($prefix . 'enable_top_bar_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Top bar overlay', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_overlay',
				'desc'           => esc_html__('Set the opacity level of the top bar background color (apply for header float)', 'g5plus-orson'),
				'clone'          => false,
				'type'           => 'slider',
				'prefix'         => '',
				'std'            => '0',
				'js_options'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_top_bar_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Top bar text color', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_text_color',
				'type'           => 'color',
				'std'            => '#777',
				'required-field' => array($prefix . 'enable_top_bar_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Top bar border color', 'g5plus-orson'),
				'id'             => $prefix . 'top_bar_border_color',
				'type'           => 'color',
				'std'            => '#eee',
				'required-field' => array($prefix . 'enable_top_bar_color', '=', '1'),
			),

			//------------------------------------------------------------------------
			array(
				'name'   => esc_html__('Header Customize?', 'g5plus-orson'),
				'id'     => $prefix . 'enable_header_color',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Header background color', 'g5plus-orson'),
				'id'             => $prefix . 'header_bg_color',
				'type'           => 'color',
				'std'            => '#fff',
				'required-field' => array($prefix . 'enable_header_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Header overlay', 'g5plus-orson'),
				'id'             => $prefix . 'header_overlay',
				'desc'           => esc_html__('Set the opacity level of the header background color (apply for header float)', 'g5plus-orson'),
				'clone'          => false,
				'type'           => 'slider',
				'prefix'         => '',
				'std'            => '0',
				'js_options'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_header_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Header text color', 'g5plus-orson'),
				'id'             => $prefix . 'header_text_color',
				'type'           => 'color',
				'std'            => '#212121',
				'required-field' => array($prefix . 'enable_header_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Header border color', 'g5plus-orson'),
				'id'             => $prefix . 'header_border_color',
				'type'           => 'color',
				'std'            => '#eee',
				'required-field' => array($prefix . 'enable_header_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Header above border color', 'g5plus-orson'),
				'id'             => $prefix . 'header_above_border_color',
				'type'           => 'color',
				'std'            => '#eee',
				'required-field' => array($prefix . 'enable_header_color', '=', '1'),
			),



			//------------------------------------------------------------------------
			array(
				'name'   => esc_html__('Navigation Customize?', 'g5plus-orson'),
				'id'     => $prefix . 'enable_navigation_color',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Navigation background color', 'g5plus-orson'),
				'id'             => $prefix . 'navigation_bg_color',
				'type'           => 'color',
				'std'            => '#eee',
				'required-field' => array($prefix . 'enable_navigation_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Navigation overlay', 'g5plus-orson'),
				'id'             => $prefix . 'navigation_overlay',
				'desc'           => esc_html__('Set the opacity level of the top bar background color (apply for header float)', 'g5plus-orson'),
				'clone'          => false,
				'type'           => 'slider',
				'prefix'         => '',
				'std'            => '0',
				'js_options'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_navigation_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Navigation text color', 'g5plus-orson'),
				'id'             => $prefix . 'navigation_text_color',
				'type'           => 'color',
				'std'            => '#212121',
				'required-field' => array($prefix . 'enable_navigation_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Navigation text hover color', 'g5plus-orson'),
				'id'             => $prefix . 'navigation_text_color_hover',
				'type'           => 'color',
				'std'            => '',
				'required-field' => array($prefix . 'enable_navigation_color', '=', '1'),
			),

			//------------------------------------------------------------------------
			array(
				'name'   => esc_html__('Footer Customize?', 'g5plus-orson'),
				'id'     => $prefix . 'enable_footer_color',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Footer background color', 'g5plus-orson'),
				'id'             => $prefix . 'footer_bg_color',
				'type'           => 'color',
				'std'            => '#222',
				'required-field' => array($prefix . 'enable_footer_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Footer text color', 'g5plus-orson'),
				'id'             => $prefix . 'footer_text_color',
				'type'           => 'color',
				'std'            => '#aaa',
				'required-field' => array($prefix . 'enable_footer_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Footer widget title color', 'g5plus-orson'),
				'id'             => $prefix . 'footer_widget_title_color',
				'type'           => 'color',
				'std'            => '#fff',
				'required-field' => array($prefix . 'enable_footer_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Footer border color', 'g5plus-orson'),
				'id'             => $prefix . 'footer_border_color',
				'type'           => 'color',
				'std'            => '#eee',
				'required-field' => array($prefix . 'enable_footer_color', '=', '1'),
			),

			//------------------------------------------------------------------------
			array(
				'name'   => esc_html__('Bottom Bar Customize?', 'g5plus-orson'),
				'id'     => $prefix . 'enable_bottom_bar_color',
				'type'   => 'section',
				'std'    => '0',
				'switch' => true,
			),
			array(
				'name'           => esc_html__('Bottom bar background color', 'g5plus-orson'),
				'id'             => $prefix . 'bottom_bar_bg_color',
				'type'           => 'color',
				'std'            => '#2d2d2d',
				'required-field' => array($prefix . 'enable_bottom_bar_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Bottom bar text color', 'g5plus-orson'),
				'id'             => $prefix . 'bottom_bar_text_color',
				'type'           => 'color',
				'std'            => '#aaa',
				'required-field' => array($prefix . 'enable_bottom_bar_color', '=', '1'),
			),
			array(
				'name'           => esc_html__('Bottom bar border color', 'g5plus-orson'),
				'id'             => $prefix . 'bottom_bar_border_color',
				'type'           => 'color',
				'std'            => '#eee',
				'required-field' => array($prefix . 'enable_bottom_bar_color', '=', '1'),
			),
		)
	);

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if (class_exists('RW_Meta_Box')) {
		foreach ($meta_boxes as $meta_box) {
			new RW_Meta_Box($meta_box);
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action('admin_init', 'g5plus_register_meta_boxes');
