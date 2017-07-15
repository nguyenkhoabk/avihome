<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2016
 * Time: 8:06 AM
 */



//////////////////////////////////////////////////////////////////
// Add theme icon
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_add_theme_icon')) {
	function g5plus_add_theme_icon($icons){
		$font_theme = &G5Plus_Framework_Global::get_theme_font_icon();
		$icons['Pe Icon 7 Stroke'] = $font_theme;
		return $icons;
	}
	add_filter('vc_iconpicker-type-fontawesome','g5plus_add_theme_icon');
}


//////////////////////////////////////////////////////////////////
// Animation Duration Param
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_animation_duration')) {
	function g5plus_vc_map_add_animation_duration(){
		return array(
			'type' => 'textfield',
			'heading' => esc_html__('Animation Duration', 'g5plus-orson'),
			'param_name' => 'animation_duration',
			'value' => '',
			'description' => wp_kses_post(__('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'g5plus-orson')),
			'dependency' => array('element' => 'css_animation', 'value' => array('top-to-bottom','bottom-to-top','left-to-right','right-to-left','appear')),
		);
	}
}

//////////////////////////////////////////////////////////////////
// Animation Delay Param
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_animation_delay')) {
	function g5plus_vc_map_add_animation_delay(){
		return array(
			'type' => 'textfield',
			'heading' => esc_html__('Animation Delay', 'g5plus-orson'),
			'param_name' => 'animation_delay',
			'value' => '',
			'description' => esc_html__('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'g5plus-orson'),
			'dependency' => array('element' => 'css_animation', 'value' => array('top-to-bottom','bottom-to-top','left-to-right','right-to-left','appear')),
		);
	}
}

//////////////////////////////////////////////////////////////////
// Extra Class Param
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_extra_class')) {
	function g5plus_vc_map_add_extra_class(){
		return array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'g5plus-orson'),
			'param_name' => 'el_class',
			'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'g5plus-orson'),
		);
	}
}

//////////////////////////////////////////////////////////////////
// Css Editor Param
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_css_editor')) {
	function g5plus_vc_map_add_css_editor(){
		return array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'g5plus-orson'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'g5plus-orson'),
		);
	}
}

//////////////////////////////////////////////////////////////////
// Icon Type Param
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_icon_type')) {
	function g5plus_vc_map_add_icon_type($dependency = array()){
		return array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon library', 'g5plus-orson'),
			'value' => array(
				esc_html__('Icon', 'g5plus-orson') => 'icon',
				esc_html__('Image', 'g5plus-orson') => 'image',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__('Select icon library.', 'g5plus-orson'),
			'dependency' => $dependency
		);
	}
}

//////////////////////////////////////////////////////////////////
// Icon Font Awesome
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_icon_font')) {
	function g5plus_vc_map_add_icon_font($dependency = array()){
		if (count($dependency) == 0) {
			$dependency = array('element' => 'icon_type','value' => 'icon');
		}
		return  array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'g5plus-orson'),
			'param_name' => 'icon_font',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 100,
				'type' => 'fontawesome'
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => $dependency,
			'description' => esc_html__('Select icon from library.', 'g5plus-orson'),
		);

	}
}

//////////////////////////////////////////////////////////////////
// Icon Images
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_icon_image')) {
	function g5plus_vc_map_add_icon_image(){
		return array(
			'type' => 'attach_image',
			'heading' => esc_html__('Upload Image Icon:', 'g5plus-orson'),
			'param_name' => 'icon_image',
			'value' => '',
			'description' => esc_html__('Upload the custom image icon.', 'g5plus-orson'),
			'dependency' => array('element' => 'icon_type','value' => 'image'),
		);
	}
}

//////////////////////////////////////////////////////////////////
// Heading Title
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_heading_title')){
	function g5plus_vc_map_add_heading_title(){
		return array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'g5plus-orson' ),
				'param_name' => 'title',
				'value' => '',
				'admin_label' => true,
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Title Style', 'g5plus-orson' ),
				'description' => esc_html__('Select title display style.', 'g5plus-orson' ),
				'param_name' => 'title_style',
				'value' => array(
					esc_html__('Border Bottom Full', 'g5plus-orson' ) => 'style_01',
					esc_html__('Border Bottom', 'g5plus-orson' ) => 'style_02',
					esc_html__('Background', 'g5plus-orson' ) => 'style_03',
				),
				'std' => '',
				'dependency' => array('element' => 'title', 'not_empty' => true),
				'group' => esc_html__('Heading Options', 'g5plus-orson'),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Size', 'g5plus-orson' ),
				'description' => esc_html__('Select title size.', 'g5plus-orson' ),
				'param_name' => 'title_size',
				'value' => array(
					esc_html__('Normal','g5plus-orson') => 'md',
					esc_html__('Large','g5plus-orson') => 'lg',
				),
				'std' => 'md',
				'dependency' => array('element' => 'title', 'not_empty' => true),
				'group' => esc_html__('Heading Options', 'g5plus-orson'),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Title Align', 'g5plus-orson' ),
				'param_name' => 'title_align',
				'description' => esc_html__('Select title alignment.', 'g5plus-orson' ),
				'value' => array(
					esc_html__('Left', 'g5plus-orson' ) => 'left',
					esc_html__('Right', 'g5plus-orson' ) => 'right',
					esc_html__('Center', 'g5plus-orson' ) => 'center',
				),
				'dependency' => array('element' => 'title', 'not_empty' => true),
				'group' => esc_html__('Heading Options', 'g5plus-orson'),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Title Scheme', 'g5plus-orson'),
				'param_name' => 'title_scheme',
				'value' => array(
					esc_html__('Dark', 'g5plus-orson') => 'dark',
					esc_html__('Light', 'g5plus-orson') => 'light'),
				'description' => esc_html__('Select title Scheme.', 'g5plus-orson'),
				'dependency' => array('element' => 'title', 'not_empty' => true),
				'group' => esc_html__('Heading Options', 'g5plus-orson'),
			),
		);
	}
}

//////////////////////////////////////////////////////////////////
// Narrow Category
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_narrow_category')){
	function g5plus_vc_map_add_narrow_category(){
		$category = array();
		$categories = get_categories();
		if (is_array($categories)) {
			foreach ($categories as $cat) {
				$category[$cat->name] = $cat->slug;
			}
		}
		return array(
			'type' => 'select2',
			'heading' => esc_html__('Narrow Category', 'g5plus-orson'),
			'param_name' => 'category',
			'options' => $category,
			'multiple' => true,
			'description' => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed).', 'g5plus-orson' ),
			"admin_label" => true,
			'std' => ''
		);
	}
}

//////////////////////////////////////////////////////////////////
// Narrow Product Category
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_narrow_product_category')){
	function g5plus_vc_map_add_narrow_product_category(){
		$category = array();
		$categories = get_categories(array( 'taxonomy' => 'product_cat','hide_empty' => false));
		if (is_array($categories)) {
			foreach ($categories as $cat) {
				$category[$cat->name] = $cat->slug;
			}
		}
		return array(
			'type' => 'select2',
			'heading' => esc_html__('Narrow Category', 'g5plus-orson'),
			'param_name' => 'category',
			'options' => $category,
			'multiple' => true,
			'description' => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'g5plus-orson' ),
			"admin_label" => true,
			'std' => ''
		);
	}
}

//////////////////////////////////////////////////////////////////
// Narrow OurTeam Category
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_narrow_ourteam_category')){
	function g5plus_vc_map_add_narrow_ourteam_category(){
		$category = array();
		$categories = get_categories(array('taxonomy' => G5PLUS_OURTEAM_CATEGORY_TAXONOMY,'hide_empty' => false,'orderby' => 'ASC'));
		if (is_array($categories)) {
			foreach ($categories as $cat) {
				$category[$cat->name] = $cat->slug;
			}
		}
		return array(
			'type' => 'select2',
			'heading' => esc_html__('Narrow Category', 'g5plus-orson'),
			'param_name' => 'category',
			'options' => $category,
			'multiple' => true,
			'description' => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'g5plus-orson' ),
			'std' => ''
		);
	}
}

//////////////////////////////////////////////////////////////////
// Narrow Portfolio Category
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_narrow_portfolio_category')){
	function g5plus_vc_map_add_narrow_portfolio_category(){
		$category = array();
		$categories = get_categories(array('taxonomy' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY,'hide_empty' => false,'orderby' => 'ASC'));
		if (is_array($categories)) {
			foreach ($categories as $cat) {
				$category[$cat->name] = $cat->slug;
			}
		}
		return array(
			'type' => 'select2',
			'heading' => esc_html__('Narrow Category', 'g5plus-orson'),
			'param_name' => 'category',
			'options' => $category,
			'multiple' => true,
			'description' => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'g5plus-orson' ),
			'std' => ''
		);
	}
}

//////////////////////////////////////////////////////////////////
// Portfolio List
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_portfolio_list')){
	function g5plus_vc_map_add_portfolio_list(){
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => G5PLUS_PORTFOLIO_POST_TYPE,
			'post_status'    => 'publish');
		$list_portfolio = array();
		$post_array = get_posts($args);
		foreach ($post_array as $post) : setup_postdata($post);
			$list_portfolio[$post->post_title] = $post->post_name;
		endforeach;
		wp_reset_postdata();
		return array(
			'type' => 'select2',
			'heading' => esc_html__('Select Portfolio', 'g5plus-orson'),
			'param_name' => 'portfolio_names',
			'options' => $list_portfolio,
			'multiple' => true
		);
	}
}

//////////////////////////////////////////////////////////////////
// Custom params vc_row
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_custom_param_vc_row')){
	function g5plus_custom_param_vc_row(){
		$vc_row = WPBMap::getShortCode('vc_row');
		$vc_row_params = $vc_row['params'];
		$index = 100;
		$background_overlay_index = 0;
		foreach($vc_row_params as $key => $param){
			$param['weight'] = $index;
			if ($param['param_name'] == 'parallax_speed_bg') {
				$background_overlay_index = $index - 1;
				$index = $index - 1;
			}
			vc_update_shortcode_param( 'vc_row', $param );
			$index--;
		}
		$params = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show background overlay', 'g5plus-orson'),
				'param_name' => 'overlay_mode',
				'description' => esc_html__('Hide or Show overlay on background images.', 'g5plus-orson'),
				'value' => array(
					esc_html__('Hide, please', 'g5plus-orson') => '',
					esc_html__('Show Overlay Color', 'g5plus-orson') => 'color',
					esc_html__('Show Overlay Image', 'g5plus-orson') => 'image',
				),
				'weight' => $background_overlay_index
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Overlay color', 'g5plus-orson'),
				'param_name' => 'overlay_color',
				'description' => esc_html__('Select color for background overlay.', 'g5plus-orson'),
				'value' => '',
				'dependency' => array('element' => 'overlay_mode', 'value' => array('color')),
				'weight' => ($background_overlay_index - 1)
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image Overlay:', 'g5plus-orson'),
				'param_name' => 'overlay_image',
				'value' => '',
				'description' => esc_html__('Upload image overlay.', 'g5plus-orson'),
				'dependency' => array('element' => 'overlay_mode', 'value' => array('image')),
				'weight' => ($background_overlay_index - 2)
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => esc_html__('Overlay opacity', 'g5plus-orson'),
				'param_name' => 'overlay_opacity',
				'value' => '50',
				'min' => '1',
				'max' => '100',
				'suffix' => '%',
				'description' => esc_html__('Select opacity for overlay.', 'g5plus-orson'),
				'dependency' => array('element' => 'overlay_mode', 'value' => array('image')),
				'weight' => ($background_overlay_index - 3)
			),
		);
		vc_add_params( 'vc_row', $params );

		$full_width = array(
			esc_html__('Default (no paddings)','g5plus-orson') => 'row_content_no_spaces'
		);
		$param_full_width = WPBMap::getParam('vc_row','full_width');
		$param_full_width['value'] = array_merge($param_full_width['value'],$full_width);
		$param_full_width['std'] = '';
		vc_update_shortcode_param( 'vc_row', $param_full_width );

	}
	add_action( 'vc_after_init', 'g5plus_custom_param_vc_row' );
}


//////////////////////////////////////////////////////////////////
// Custom vc_tta_accordion param
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_custom_param_vc_tta_accordion')) {
	function g5plus_custom_param_vc_tta_accordion(){

		$styles = array(
			esc_html__('Classic No Fill Color','g5plus-orson') => 'classic vc_tta-no-fill-color'
		);
		$param_style = WPBMap::getParam('vc_tta_accordion','style');
		$param_style['value'] = array_merge($param_style['value'],$styles);
		$param_style['std'] = 'classic';
		vc_update_shortcode_param( 'vc_tta_accordion', $param_style );

		$colors = array(
			esc_html__( 'Primary', 'g5plus-orson' ) => 'primary'
		);
		$param_color = WPBMap::getParam('vc_tta_accordion','color');
		$param_color['value'] = array_merge($colors,$param_color['value']);
		vc_update_shortcode_param( 'vc_tta_accordion', $param_color );

	}
	add_action( 'vc_after_init', 'g5plus_custom_param_vc_tta_accordion' );
}

//////////////////////////////////////////////////////////////////
// Custom vc_toggle param
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_custom_param_vc_toggle')) {
	function g5plus_custom_param_vc_toggle() {
		$style =  array(
			esc_html__('Rounded','g5plus-orson') => 'rounded',
			esc_html__('Rounded Outline','g5plus-orson') => 'rounded_outline',
			esc_html__('Square','g5plus-orson') => 'square',
			esc_html__('Square Outline','g5plus-orson') => 'square_outline',
			esc_html__('Text Only','g5plus-orson') => 'text_only',
		);

		$param_style = WPBMap::getParam('vc_toggle','style');
		$param_style['value'] = $style;
		$param_style['std'] = 'square_outline';
		vc_update_shortcode_param( 'vc_toggle', $param_style );

		$colors = array(
			esc_html__( 'Primary', 'g5plus-orson' ) => 'primary'
		);
		$param_color = WPBMap::getParam('vc_toggle','color');
		$param_color['value'] = array_merge($colors,$param_color['value']);
		$param_color['heading'] = esc_html__('Color','g5plus-orson');
		$param_color['std'] = 'default';
		vc_update_shortcode_param( 'vc_toggle', $param_color );

	}
	add_action( 'vc_after_init', 'g5plus_custom_param_vc_toggle' );
}

//////////////////////////////////////////////////////////////////
// Custom param vc_tta_tabs
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_custom_param_vc_tta_tabs')) {
	function g5plus_custom_param_vc_tta_tabs() {

		$styles = array(
			esc_html__('Border Bottom','g5plus-orson') => 'default',
			esc_html__('No Border','g5plus-orson') => 'no_border'
		);
		$param_style = WPBMap::getParam('vc_tta_tabs','style');
		$param_style['value'] = array_merge($param_style['value'],$styles);
		$param_style['std'] = 'classic';
		vc_update_shortcode_param( 'vc_tta_tabs', $param_style );


		$param_shape = WPBMap::getParam('vc_tta_tabs','shape');
		$param_shape['dependency'] = array(
			'element' => 'style',
			'value' => array('classic','modern','flat','outline')
		);
		vc_update_shortcode_param( 'vc_tta_tabs', $param_shape );

		$param_color = WPBMap::getParam('vc_tta_tabs','color');
		$param_color['dependency'] = array(
			'element' => 'style',
			'value' => array('classic','modern','flat','outline')
		);
		vc_update_shortcode_param( 'vc_tta_tabs', $param_color );

		$param_no_fill_content_area = WPBMap::getParam('vc_tta_tabs','no_fill_content_area');
		$param_no_fill_content_area['dependency'] = array(
			'element' => 'style',
			'value' => array('classic','modern','flat','outline')
		);
		vc_update_shortcode_param( 'vc_tta_tabs', $param_no_fill_content_area );

		/*$colors = array(
			esc_html__( 'Grey (#eee)', 'g5plus-orson' ) => 'grey-2',
		);
		$param_color = WPBMap::getParam('vc_tta_tabs','color');
		$param_color['value'] = array_merge($colors,$param_color['value']);
		$param_color['std'] = 'grey-2';
		vc_update_shortcode_param( 'vc_tta_tabs', $param_color );*/
	}

	add_action( 'vc_after_init', 'g5plus_custom_param_vc_tta_tabs' );
}

//////////////////////////////////////////////////////////////////
// Custom icon param
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_custom_param_icon')) {
	function g5plus_custom_param_icon() {
		$icons = array(
			'icon_fontawesome',
			'icon_openiconic',
			'icon_entypo',
			'icon_linecons',
			'icon_monosocial'
		);
		$shortcodes = array(
			'vc_tta_section'
		);
		foreach ($shortcodes as $shortcode) {
			foreach ($icons as $icon) {
				${$icon} = WPBMap::getParam($shortcode,'i_' . $icon);
				${$icon}['settings']['iconsPerPage'] = 50;
				vc_update_shortcode_param( $shortcode, ${$icon} );
			}
		}
	}
	add_action( 'vc_after_init', 'g5plus_custom_param_icon' );
}

//////////////////////////////////////////////////////////////////
// Get Product ids by slugs
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_product_ids_by_slugs')) {
	function g5plus_get_product_ids_by_slugs($slugs){
		global $wpdb;
		$slugs = preg_split("/[\s,]+/",$slugs);
		$format = implode(', ', array_fill(0, count($slugs), '%s'));
		$query = "SELECT p.ID as ID
		FROM {$wpdb->posts} as p
		WHERE (p.post_type = 'product')
			  AND (p.post_status = 'publish')
			  AND (p.post_name IN({$format}))";
		$products = $wpdb->get_results( $wpdb->prepare($query, $slugs) );
		$product_ids = array_unique( array_map( 'absint', array_merge( wp_list_pluck( $products, 'ID' ) ) ) );
		return $product_ids;
	}
}

//////////////////////////////////////////////////////////////////
// Get Product Id by slug
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_product_id_by_slug')) {
	function g5plus_get_product_id_by_slug( $slug ) {
		global $wpdb;
		$product_id = $wpdb->get_var( $wpdb->prepare( "
		SELECT posts.ID
		FROM $wpdb->posts AS posts
		WHERE posts.post_type = 'product'
		AND posts.post_name = '%s'
		LIMIT 1
	 ", $slug ) );
		return ( $product_id ) ? intval( $product_id ) : 0;
	}
}

//////////////////////////////////////////////////////////////////
// Get Widget Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_widget_layout')){
	function g5plus_vc_map_add_widget_layout(){
		return array(
			'type' => 'dropdown',
			'heading' => esc_html__('Widget Layout','g5plus-orson'),
			'param_name' => 'widget_layout',
			'value' => array(
				esc_html__('Default','g5plus-orson') => '',
				esc_html__('Classic','g5plus-orson')  => 'widget-classic',
				esc_html__('Classic Without Border','g5plus-orson') => 'widget-classic-no-border',
				esc_html__('Border Round','g5plus-orson') => 'widget-border-round',
				esc_html__('Border Round Background','g5plus-orson') => 'widget-border-round-background',
				esc_html__('Border','g5plus-orson') => 'widget-border',
				esc_html__('Border Background','g5plus-orson') => 'widget-border-background'
			)
		);
	}
}

//////////////////////////////////////////////////////////////////
// Get Slider
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_slider')) {
	function g5plus_vc_map_add_slider(){
		return array(
			'type' => 'checkbox',
			'heading' => esc_html__('Display Slider?', 'g5plus-orson' ),
			'param_name' => 'is_slider',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		);
	}
}

//////////////////////////////////////////////////////////////////
// Get Pagination
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_pagination')) {
	function g5plus_vc_map_add_pagination(){
		return array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show pagination control', 'g5plus-orson'),
			'param_name' => 'dots',
			'dependency' => array('element' => 'is_slider', 'value' => 'true'),
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		);
	}
}


//////////////////////////////////////////////////////////////////
// Get Navigation
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_navigation')) {
	function g5plus_vc_map_add_navigation(){
		return array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show navigation control', 'g5plus-orson'),
			'param_name' => 'arrows',
			'dependency' => array('element' => 'is_slider', 'value' => 'true'),
			'std' => 'true',
			'edit_field_class' => 'vc_col-sm-4 vc_column'
		);
	}
}

//////////////////////////////////////////////////////////////////
// Get Navigation Position
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_navigation_position')) {
	function g5plus_vc_map_add_navigation_position(){
		return array(
			'type' => 'dropdown',
			'heading' => esc_html__('Navigation Position', 'g5plus-orson'),
			'param_name' => 'arrows_position',
			'value' => array(
				esc_html__('Top','g5plus-orson') => 'top',
				esc_html__('Center','g5plus-orson') => 'center',
				esc_html__('Bottom','g5plus-orson') => 'bottom'
			),
			'std' => 'top',
			'dependency' => array('element' => 'arrows', 'value' => 'true'),
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		);
	}
}

//////////////////////////////////////////////////////////////////
// Get Navigation Style
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_vc_map_add_navigation_style')) {
	function g5plus_vc_map_add_navigation_style(){
		return array(
			'type' => 'dropdown',
			'heading' => esc_html__('Navigation Style', 'g5plus-orson'),
			'param_name' => 'arrows_style',
			'value' => array(
				esc_html__('Classic','g5plus-orson') => 'classic',
				esc_html__('Round','g5plus-orson') => 'round',
				esc_html__('Square','g5plus-orson') => 'square'
			),
			'std' => '',
			'dependency' => array('element' => 'arrows', 'value' => 'true'),
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		);
	}
}
//////////////////////////////////////////////////////////////////
// Custom vc_icon param
//////////////////////////////////////////////////////////////////

if (!function_exists('g5plus_custom_param_vc_icon')) {
	function g5plus_custom_param_vc_icon() {
		$align = array(
			esc_html__( 'Inline', 'g5plus-orson' ) => 'inline'
		);
		$param_align = WPBMap::getParam('vc_icon','align');
		$param_align['value'] = array_merge($align,$param_align['value']);
		vc_update_shortcode_param( 'vc_icon', $param_align );

	}
	add_action( 'vc_after_init', 'g5plus_custom_param_vc_icon' );
}

//////////////////////////////////////////////////////////////////
// Custom vc_progress_bars
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_custom_param_vc_progress_bar')){
	function g5plus_custom_param_vc_progress_bar(){
		$vc_progress_bar = WPBMap::getShortCode('vc_progress_bar');
		$vc_progress_bar_params = $vc_progress_bar['params'];
		$index = 100;
		$background_overlay_index = 0;
		foreach($vc_progress_bar_params as $key => $param){
			$param['weight'] = $index;
			if ($param['param_name'] == 'bgcolor') {
				$background_overlay_index = $index - 1;
				$index = $index - 1;
			}
			vc_update_shortcode_param( 'vc_progress_bar', $param );
			$index--;
		}
		$params = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Layout Style', 'g5plus-orson'),
				'param_name' => 'layout_style',
				'value' => array(
					esc_html__('Normal', 'g5plus-orson') => '',
					esc_html__('Text value move', 'g5plus-orson') => 'style_01',
					esc_html__('Vertical Progess Bar', 'g5plus-orson') => 'v-progress-bar',
				),
				'admin_label' => true,
				'description' => esc_html__('Select Layout Style.', 'g5plus-orson'),
				'weight' => ($background_overlay_index + $background_overlay_index),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Bar height (px)', 'g5plus-orson'),
				'param_name' => 'height',
				'std' => '30',
				'dependency' => array(
					'element' => 'layout_style',
					'value' => array('','style_01'),
				),
				'weight' => $background_overlay_index
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Bar margin (px)', 'g5plus-orson'),
				'param_name' => 'margin',
				'std' => '40',
				'dependency' => array(
					'element' => 'layout_style',
					'value' => array('','style_01'),
				),
				'weight' => ($background_overlay_index - 1)
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Bar rounded (px)', 'g5plus-orson'),
				'param_name' => 'rounded',
				'std' => '5',
				'dependency' => array(
					'element' => 'layout_style',
					'value' => array('','style_01'),
				),
				'weight' => ($background_overlay_index - 2)
			),
		);
		vc_add_params( 'vc_progress_bar', $params );
	}
	add_action( 'vc_after_init', 'g5plus_custom_param_vc_progress_bar' );
}

//////////////////////////////////////////////////////////////////
// Custom vc_mesage_box
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_custom_param_vc_message')){
	function g5plus_custom_param_vc_message(){
		$param_color = WPBMap::getParam('vc_message','color');
		$param_color_options = array();
		foreach ($param_color['options'] as $option) {
			if ($option['value'] == 'info') {
				$option['params'] = array_merge($option['params'],array('icon_fontawesome' => 'fa fa-expand'));
			}
			if ($option['value'] == 'warning') {
				$option['params'] = array_merge($option['params'],array('icon_fontawesome' => 'fa fa-exclamation-triangle'));
			}
			if ($option['value'] == 'success') {
				$option['params'] = array_merge($option['params'],array('icon_fontawesome' => 'fa fa-check-square'));
			}
			if ($option['value'] == 'danger') {
				$option['params'] = array_merge($option['params'],array('icon_fontawesome' => 'fa fa-external-link-square'));
			}
			$param_color_options[] = $option;
		}

		$param_color['options'] = $param_color_options;


		vc_update_shortcode_param( 'vc_message', $param_color );

	}
	add_action( 'vc_after_init', 'g5plus_custom_param_vc_message' );
}