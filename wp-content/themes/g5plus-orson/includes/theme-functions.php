<?php
//==============================================================================
// Get Header spacing default
//==============================================================================
if (!function_exists('g5plus_get_header_spacing_default')) {
	function &g5plus_get_header_spacing_default()
	{
		$header_spacing = array(
			'default'  => array(
				'navigation_height'     => '55px',
				'header_padding_top'    => '30px',
				'header_padding_bottom' => '30px',
				'logo_max_height'       => '50px',
				'logo_padding_top'      => '0',
				'logo_padding_bottom'   => '0',
			),
			'header-1' => array(
				'navigation_height'     => '106px',
				'header_padding_top'    => '0',
				'header_padding_bottom' => '0',
				'logo_max_height'       => '106px',
				'logo_padding_top'      => '0',
				'logo_padding_bottom'   => '0',
			),
			'header-3' => array(
				'navigation_height'     => '55px',
				'header_padding_top'    => '0',
				'header_padding_bottom' => '0',
				'logo_max_height'       => '128px',
				'logo_padding_top'      => '0',
				'logo_padding_bottom'   => '0',
			),
		);

		return $header_spacing;
	}
}

//==============================================================================
// PROCESS SPACING DEFAULT
//==============================================================================
if (!function_exists('g5plus_process_spacing_default')) {
	function g5plus_process_spacing_default()
	{
		$top_drawer = &G5Plus_Global::get_top_drawer_var();
		$top_bar = &G5Plus_Global::get_top_bar_var();
		$header = &G5Plus_Global::get_header_var();
		$logo = &G5Plus_Global::get_logo_var();
		$footer = &G5Plus_Global::get_footer_var();
		$header_layout = $header['header_layout'];
		$header_spacing = g5plus_get_header_spacing_default();
		$header_spacing_default = isset($header_spacing[$header_layout]) ? $header_spacing[$header_layout] : $header_spacing['default'];
		// SET DEFAULT LOGO SPACING
		///////////////////////////////////////////////////////////////////////////////
		if ($logo['logo_max_height'] === '' || $logo['logo_max_height'] === 'px') {
			$logo['logo_max_height'] = $header_spacing_default['logo_max_height'];
		}
		if ($logo['logo_padding']['padding-top'] === '' || $logo['logo_padding']['padding-top'] === 'px') {
			$logo['logo_padding']['padding-top'] = $header_spacing_default['logo_padding_top'];
		}
		if ($logo['logo_padding']['padding-bottom'] === '' || $logo['logo_padding']['padding-bottom'] === 'px') {
			$logo['logo_padding']['padding-bottom'] = $header_spacing_default['logo_padding_bottom'];
		}

		if ($logo['mobile_logo_max_height'] === '' || $logo['mobile_logo_max_height'] === 'px') {
			$logo['mobile_logo_max_height'] = '55px';
		}
		if ($logo['mobile_logo_padding']['padding-top'] === '' || $logo['mobile_logo_padding']['padding-top'] === 'px') {
			$logo['mobile_logo_padding']['padding-top'] = '5px';
		}
		if ($logo['mobile_logo_padding']['padding-bottom'] === '' || $logo['mobile_logo_padding']['padding-bottom'] === 'px') {
			$logo['mobile_logo_padding']['padding-bottom'] = '55px';
		}


		// SET DEFAULT TOP DRAWER SPACING
		///////////////////////////////////////////////////////////////////////////////
		if ($top_drawer['top_drawer_padding']['padding-top'] === '' || $top_drawer['top_drawer_padding']['padding-top'] === 'px') {
			$top_drawer['top_drawer_padding']['padding-top'] = '0';
		}
		if ($top_drawer['top_drawer_padding']['padding-bottom'] === '' || $top_drawer['top_drawer_padding']['padding-bottom'] === 'px') {
			$top_drawer['top_drawer_padding']['padding-bottom'] = '0';
		}

		// SET DEFAULT TOP BAR SPACING
		///////////////////////////////////////////////////////////////////////////////
		if ($top_bar['top_bar_padding']['padding-top'] === '' || $top_bar['top_bar_padding']['padding-top'] === 'px') {
			$top_bar['top_bar_padding']['padding-top'] = '5px';
		}
		if ($top_bar['top_bar_padding']['padding-bottom'] === '' || $top_bar['top_bar_padding']['padding-bottom'] === 'px') {
			$top_bar['top_bar_padding']['padding-bottom'] = '5px';
		}

		if ($top_bar['top_bar_mobile_padding']['padding-top'] === '' || $top_bar['top_bar_mobile_padding']['padding-top'] === 'px') {
			$top_bar['top_bar_mobile_padding']['padding-top'] = '5px';
		}
		if ($top_bar['top_bar_mobile_padding']['padding-bottom'] === '' || $top_bar['top_bar_mobile_padding']['padding-bottom'] === 'px') {
			$top_bar['top_bar_mobile_padding']['padding-bottom'] = '5px';
		}


		// SET DEFAULT HEADER SPACING
		///////////////////////////////////////////////////////////////////////////////
		if ($header['header_padding']['padding-top'] === '' || $header['header_padding']['padding-top'] === 'px') {
			$header['header_padding']['padding-top'] = $header_spacing_default['header_padding_top'];
		}
		if ($header['header_padding']['padding-bottom'] === '' || $header['header_padding']['padding-bottom'] === 'px') {
			$header['header_padding']['padding-bottom'] = $header_spacing_default['header_padding_bottom'];
		}
		if ($header['navigation_height'] === '' || $header['navigation_height'] === 'px') {
			$header['navigation_height'] = $header_spacing_default['navigation_height'];
		}

		// Fix Header Navigation height
		///////////////////////////////////////////////////////////////////////////////
		if ($header_layout == 'header-1') {
			$header['navigation_height'] = $logo['logo_max_height'];
		}

		// SET DEFAULT FOOTER SPACING
		///////////////////////////////////////////////////////////////////////////////
		if ($footer['footer_padding']['padding-top'] === '' || $footer['footer_padding']['padding-top'] === 'px') {
			$footer['footer_padding']['padding-top'] = '50px';
		}
		if ($footer['footer_padding']['padding-bottom'] === '' || $footer['footer_padding']['padding-bottom'] === 'px') {
			$footer['footer_padding']['padding-bottom'] = '50px';
		}

		// SET DEFAULT BOTOTOM BAR SPACING
		///////////////////////////////////////////////////////////////////////////////
		if ($footer['bottom_bar_padding']['padding-top'] === '' || $footer['bottom_bar_padding']['padding-top'] === 'px') {
			$footer['bottom_bar_padding']['padding-top'] = '25px';
		}
		if ($footer['bottom_bar_padding']['padding-bottom'] === '' || $footer['bottom_bar_padding']['padding-bottom'] === 'px') {
			$footer['bottom_bar_padding']['padding-bottom'] = '25px';
		}
	}
}

//==============================================================================
// GET CUSTOM CSS VARIABLE
//==============================================================================
if (!function_exists('g5plus_custom_css_variable')) {
	function g5plus_custom_css_variable()
	{
		$header_responsive_breakpoint = G5Plus_Global::get_option('header_responsive_breakpoint');
		$body_font = G5Plus_Global::get_option('body_font', array('font-family' => 'Roboto'));
		$secondary_font = G5Plus_Global::get_option('secondary_font', array('font-family' => 'Roboto Slab'));
		$logo = &G5Plus_Global::get_logo_var();
		$top_drawer = &G5Plus_Global::get_top_drawer_var();
		$top_bar = &G5Plus_Global::get_top_bar_var();
		$header = &G5Plus_Global::get_header_var();
		$header_customize = &G5Plus_Global::get_header_customize_var();
		$footer = &G5Plus_Global::get_footer_var();
		$theme_color = &G5Plus_Global::get_theme_color_var();

		g5plus_process_spacing_default();
		return <<<LESS_VARIABLE
			@responsive_breakpoint: {$header_responsive_breakpoint}px;
			@body_font: '{$body_font["font-family"]}';
			@secondary_font: '{$secondary_font["font-family"]}';

			@accent_color: {$theme_color['accent_color']};
			@foreground_accent_color: {$theme_color['foreground_accent_color']};
			@text_color: {$theme_color['text_color']};
			@border_color: {$theme_color['border_color']};
			@feature_color1: {$theme_color['feature_color1']};
			@feature_color2: {$theme_color['feature_color2']};
			@top_drawer_bg_color: {$theme_color['top_drawer_bg_color']};
			@top_drawer_text_color: {$theme_color['top_drawer_text_color']};
			@header_bg_color: {$theme_color['header_bg_color']};
			@header_text_color: {$theme_color['header_text_color']};
			@header_border_color: {$theme_color['header_border_color']};
			@header_above_border_color: {$theme_color['header_above_border_color']};
			@top_bar_bg_color: {$theme_color['top_bar_bg_color']};
			@top_bar_text_color: {$theme_color['top_bar_text_color']};
			@top_bar_border_color: {$theme_color['top_bar_border_color']};
			@navigation_bg_color: {$theme_color['navigation_bg_color']};
			@navigation_text_color: {$theme_color['navigation_text_color']};
			@navigation_text_color_hover: {$theme_color['navigation_text_color_hover']};

			@top_bar_mobile_bg_color: {$theme_color['top_bar_mobile_bg_color']};
			@top_bar_mobile_text_color: {$theme_color['top_bar_mobile_text_color']};
			@top_bar_mobile_border_color: {$theme_color['top_bar_mobile_border_color']};
			@header_mobile_bg_color: {$theme_color['header_mobile_bg_color']};
			@header_mobile_text_color: {$theme_color['header_mobile_text_color']};
			@header_mobile_border_color: {$theme_color['header_mobile_border_color']};

			@footer_bg_color: {$theme_color['footer_bg_color']};
			@footer_text_color: {$theme_color['footer_text_color']};
			@footer_widget_title_color: {$theme_color['footer_widget_title_color']};
			@footer_border_color: {$theme_color['footer_border_color']};
			@bottom_bar_bg_color: {$theme_color['bottom_bar_bg_color']};
			@bottom_bar_text_color: {$theme_color['bottom_bar_text_color']};
			@bottom_bar_border_color: {$theme_color['bottom_bar_border_color']};

			@top_drawer_padding_top: {$top_drawer['top_drawer_padding']['padding-top']};
			@top_drawer_padding_bottom: {$top_drawer['top_drawer_padding']['padding-bottom']};
			@top_bar_padding_top: {$top_bar['top_bar_padding']['padding-top']};
			@top_bar_padding_bottom: {$top_bar['top_bar_padding']['padding-bottom']};
			@top_bar_mobile_padding_top: {$top_bar['top_bar_mobile_padding']['padding-top']};
			@top_bar_mobile_padding_bottom: {$top_bar['top_bar_mobile_padding']['padding-bottom']};
			@header_padding_top: {$header['header_padding']['padding-top']};
			@header_padding_bottom: {$header['header_padding']['padding-bottom']};
			@navigation_height: {$header['navigation_height']};
			@navigation_spacing: {$header['navigation_spacing']};
			@header_customize_nav_spacing: {$header_customize['header_customize_nav_spacing']};
			@header_customize_left_spacing: {$header_customize['header_customize_left_spacing']};
			@header_customize_right_spacing: {$header_customize['header_customize_right_spacing']};

			@footer_padding_top: {$footer['footer_padding']['padding-top']};
			@footer_padding_bottom: {$footer['footer_padding']['padding-bottom']};
			@bottom_bar_padding_top: {$footer['bottom_bar_padding']['padding-top']};
			@bottom_bar_padding_bottom: {$footer['bottom_bar_padding']['padding-bottom']};

			@logo_max_height: {$logo['logo_max_height']};
			@mobile_logo_max_height: {$logo['mobile_logo_max_height']};
			@logo_padding_top: {$logo['logo_padding']['padding-top']};
			@logo_padding_bottom: {$logo['logo_padding']['padding-bottom']};
			@mobile_logo_padding_top: {$logo['mobile_logo_padding']['padding-top']};
			@mobile_logo_padding_bottom: {$logo['mobile_logo_padding']['padding-bottom']};

LESS_VARIABLE;
	}
}

// GET CUSTOM CSS
//--------------------------------------------------
if (!function_exists('g5plus_custom_css')) {
	function g5plus_custom_css()
	{
		$g5plus_options = &G5Plus_Global::get_options();
		$custom_css = '';
		$background_image_css = '';

		$body_background_mode = G5Plus_Global::get_option('body_background_mode', 'background');
		if ($body_background_mode == 'background') {

			$background_image_url = isset($g5plus_options['body_background']['background-image']) ? $g5plus_options['body_background']['background-image'] : '';
			$background_color = isset($g5plus_options['body_background']['background-color']) ? $g5plus_options['body_background']['background-color'] : '';

			if (!empty($background_color)) {
				$background_image_css .= 'background-color:' . $background_color . ';';
			}

			if (!empty($background_image_url)) {
				$background_repeat = isset($g5plus_options['body_background']['background-repeat']) ? $g5plus_options['body_background']['background-repeat'] : '';
				$background_position = isset($g5plus_options['body_background']['background-position']) ? $g5plus_options['body_background']['background-position'] : '';
				$background_size = isset($g5plus_options['body_background']['background-size']) ? $g5plus_options['body_background']['background-size'] : '';
				$background_attachment = isset($g5plus_options['body_background']['background-attachment']) ? $g5plus_options['body_background']['background-attachment'] : '';

				$background_image_css .= 'background-image: url("' . $background_image_url . '");';


				if (!empty($background_repeat)) {
					$background_image_css .= 'background-repeat: ' . $background_repeat . ';';
				}

				if (!empty($background_position)) {
					$background_image_css .= 'background-position: ' . $background_position . ';';
				}

				if (!empty($background_size)) {
					$background_image_css .= 'background-size: ' . $background_size . ';';
				}

				if (!empty($background_attachment)) {
					$background_image_css .= 'background-attachment: ' . $background_attachment . ';';
				}
			}

		}

		if ($body_background_mode == 'pattern') {
			$background_image_url = G5PLUS_THEME_URL . 'assets/images/theme-options/' . $g5plus_options['body_background_pattern'];
			$background_image_css .= 'background-image: url("' . $background_image_url . '");';
			$background_image_css .= 'background-repeat: repeat;';
			$background_image_css .= 'background-position: center center;';
			$background_image_css .= 'background-size: auto;';
			$background_image_css .= 'background-attachment: scroll;';
		}

		if (!empty($background_image_css)) {
			$custom_css .= 'body{' . $background_image_css . '}';
		}


		if (isset($g5plus_options['custom_css'])) {
			$custom_css .= $g5plus_options['custom_css'];
		}

		$custom_scroll = isset($g5plus_options['custom_scroll']) ? $g5plus_options['custom_scroll'] : 0;
		if ($custom_scroll == 1) {
			$custom_scroll_width = isset($g5plus_options['custom_scroll_width']) ? $g5plus_options['custom_scroll_width'] : '10';
			$custom_scroll_color = isset($g5plus_options['custom_scroll_color']) ? $g5plus_options['custom_scroll_color'] : '#333333';
			$custom_scroll_thumb_color = isset($g5plus_options['custom_scroll_thumb_color']) ? $g5plus_options['custom_scroll_thumb_color'] : '#e8aa00';

			$custom_css .= 'body::-webkit-scrollbar {width: ' . $custom_scroll_width . 'px;background-color: ' . $custom_scroll_color . ';}';
			$custom_css .= 'body::-webkit-scrollbar-thumb{background-color: ' . $custom_scroll_thumb_color . ';}';
		}

		$footer_bg_image = isset($g5plus_options['footer_bg_image']) && isset($g5plus_options['footer_bg_image']['url']) ?
			$g5plus_options['footer_bg_image']['url'] : '';

		if (!empty($footer_bg_image)) {
			$footer_bg_css = 'background-image:url(' . $footer_bg_image . ');';
			$footer_bg_css .= 'background-size: cover;';
			$footer_bg_css .= 'background-attachment: fixed;';
			$custom_css .= 'footer.main-footer-wrapper {' . $footer_bg_css . '}';
		}


		$custom_css = str_replace("\r\n", '', $custom_css);
		$custom_css = str_replace("\n", '', $custom_css);
		$custom_css = str_replace("\t", '', $custom_css);

		return $custom_css;
	}
}

// UNREGISTER CUSTOM POST TYPES
//--------------------------------------------------
if (!function_exists('g5plus_unregister_post_type')) {
	function g5plus_unregister_post_type($post_type, $slug = '')
	{
		$wp_post_types = &G5Plus_Global::wp_post_types();
		$g5plus_options = &G5Plus_Global::get_options();
		if (isset($g5plus_options['cpt_disable'])) {
			$cpt_disable = $g5plus_options['cpt_disable'];
			if (!empty($cpt_disable)) {
				foreach ($cpt_disable as $post_type => $cpt) {
					if ($cpt == 1 && isset($wp_post_types[$post_type])) {
						unset($wp_post_types[$post_type]);
					}
				}
			}
		}
	}
	add_action('init', 'g5plus_unregister_post_type', 20);
}

// GET LOGO URL
if (!function_exists('g5plus_get_meta_box_image')) {
	function g5plus_get_meta_box_image($key, $post_id = null)
	{
		$logo_meta_id = g5plus_get_rwmb_meta($key, array(), $post_id);
		$logo_meta = g5plus_get_rwmb_meta($key, 'type=image_advanced', $post_id);
		if (($logo_meta_id === '') || ($logo_meta === '')) {
			return false;
		}
		$logo_url = '';
		if ($logo_meta !== array() && isset($logo_meta[$logo_meta_id]) && isset($logo_meta[$logo_meta_id]['full_url'])) {
			$logo_url = $logo_meta[$logo_meta_id]['full_url'];
		}
		return $logo_url;
	}
}

//==============================================================================
// SET PAGE SETTING
//==============================================================================
if (!function_exists('g5plus_set_page_setting')) {
	function g5plus_set_page_setting($setting_post_id = 0)
	{
		if ($setting_post_id) {
			$setting_post_id_before = 0;
			if (isset( $GLOBALS['post'] ) ) {
				$setting_post_id_before = isset($GLOBALS['post']->ID) ? $GLOBALS['post']->ID : 0;
			}
			else {
				$GLOBALS['post'] = (object) array();
			}
			$GLOBALS['post']->ID = $setting_post_id;
			G5Plus_Global::set_is_changed_category_setting(true);
		}

		g5plus_set_page_header_setting();
		g5plus_set_page_top_drawer_setting();
		g5plus_set_page_top_bar_setting();
		g5plus_set_page_logo_setting();
		g5plus_set_page_header_customize_setting();
		g5plus_set_page_footer_setting();
		g5plus_set_page_color_setting();
		g5plus_set_page_layout_setting();
		g5plus_set_page_title_setting();

		// Restore post_id
		if ($setting_post_id) {
			if (isset( $GLOBALS['post'] ) ) {
				$GLOBALS['post']->ID = $setting_post_id_before;
			}
		}
	}
}
//==============================================================================
// SET PAGE LOGO SETTING
//==============================================================================
if (!function_exists('g5plus_set_page_logo_setting')) {
	function g5plus_set_page_logo_setting()
	{
		$logo = &G5Plus_Global::get_logo_var();

		$logo_url= g5plus_get_meta_box_image('logo');
		if ($logo_url) {
			$logo['logo'] = $logo_url;
		}

		$logo_retina= g5plus_get_meta_box_image('logo_retina');
		if ($logo_retina) {
			$logo['logo_retina'] = $logo_retina;
		}

		$sticky_logo= g5plus_get_meta_box_image('sticky_logo');
		if ($sticky_logo) {
			$logo['sticky_logo'] = $sticky_logo;
		}

		$sticky_logo_retina= g5plus_get_meta_box_image('sticky_logo_retina');
		if ($sticky_logo_retina) {
			$logo['sticky_logo_retina'] = $sticky_logo_retina;
		}

		$logo_max_height = g5plus_get_rwmb_meta('logo_max_height');
		if (($logo_max_height !== '')) {
			$logo['logo_max_height'] .= 'px';
		}

		$logo_padding = g5plus_get_rwmb_meta('logo_padding');
		if (($logo_padding !== '') && isset($logo_padding['top']) && isset($logo_padding['bottom'])) {
			if ($logo_padding['top']) {
				$logo_padding['top'] .= 'px';
				$logo['logo_padding']['padding-top'] = $logo_padding['top'];
			}
			if ($logo_padding['bottom']) {
				$logo_padding['bottom'] .= 'px';
				$logo['logo_padding']['padding-bottom'] = $logo_padding['bottom'];
			}
		}

		$mobile_logo = g5plus_get_meta_box_image('mobile_logo');
		if ($mobile_logo) {
			$logo['mobile_logo'] = $mobile_logo;
		}

		$mobile_logo_retina = g5plus_get_meta_box_image('mobile_logo_retina');
		if ($mobile_logo_retina) {
			$logo['mobile_logo_retina'] = $mobile_logo_retina;
		}

		$mobile_logo_max_height = g5plus_get_rwmb_meta('mobile_logo_max_height');
		if (($mobile_logo_max_height !== '')) {
			$logo['mobile_logo_max_height'] .= 'px';
		}

		$mobile_logo_padding = g5plus_get_rwmb_meta('mobile_logo_padding');
		if (($mobile_logo_padding !== '') && isset($mobile_logo_padding['top']) && isset($mobile_logo_padding['bottom'])) {
			if ($mobile_logo_padding['top']) {
				$mobile_logo_padding['top'] .= 'px';
				$logo['mobile_logo_padding']['padding-top'] = $mobile_logo_padding['top'];
			}
			if ($mobile_logo_padding['bottom']) {
				$mobile_logo_padding['bottom'] .= 'px';
				$logo['mobile_logo_padding']['padding-bottom'] = $mobile_logo_padding['bottom'];
			}


		}
	}
}

//==============================================================================
// SET TOP DRAWER PAGE SETTING
//==============================================================================
if (!function_exists('g5plus_set_page_top_drawer_setting')) {
	function g5plus_set_page_top_drawer_setting()
	{
		$top_drawer = &G5Plus_Global::get_top_drawer_var();

		$top_drawer_type = g5plus_get_rwmb_meta('top_drawer_type');
		if (($top_drawer_type !== '') && ($top_drawer_type !== '-1')) {
			$top_drawer['top_drawer_type'] = $top_drawer_type;
		}

		$top_drawer_sidebar = g5plus_get_rwmb_meta('top_drawer_sidebar');
		if ($top_drawer_sidebar) {
			$top_drawer['top_drawer_sidebar'] = $top_drawer_sidebar;
		}

		$top_drawer_wrapper_layout = g5plus_get_rwmb_meta('top_drawer_wrapper_layout');
		if (($top_drawer_wrapper_layout !== '') && ($top_drawer_wrapper_layout !== '-1')) {
			$top_drawer['top_drawer_wrapper_layout'] = $top_drawer_wrapper_layout;
		}

		$top_drawer_hide_mobile = g5plus_get_rwmb_meta('top_drawer_hide_mobile');
		if (($top_drawer_hide_mobile !== '') && ($top_drawer_hide_mobile !== '-1')) {
			$top_drawer['top_drawer_hide_mobile'] = $top_drawer_hide_mobile;
		}

		$top_drawer_padding = g5plus_get_rwmb_meta('top_drawer_padding');
		if (($top_drawer_padding !== '') && isset($top_drawer_padding['top']) && isset($top_drawer_padding['bottom'])) {
			if ($top_drawer_padding['top']) {
				$top_drawer_padding['top'] .= 'px';
				$top_drawer['top_drawer_padding']['padding-top'] = $top_drawer_padding['top'];
			}
			if ($top_drawer_padding['bottom']) {
				$top_drawer_padding['bottom'] .= 'px';
				$top_drawer['top_drawer_padding']['padding-bottom'] = $top_drawer_padding['bottom'];
			}
		}
	}
}

//==============================================================================
// SET PAGE TOP BAR SETTING
//==============================================================================
if (!function_exists('g5plus_set_page_top_bar_setting')) {
	function g5plus_set_page_top_bar_setting()
	{
		$top_bar = &G5Plus_Global::get_top_bar_var();

		$top_bar_enable = g5plus_get_rwmb_meta('top_bar_enable');
		if (($top_bar_enable !== '') && ($top_bar_enable !== '-1')) {
			$top_bar['top_bar_enable'] = $top_bar_enable;
		}

		$top_bar_layout = g5plus_get_rwmb_meta('top_bar_layout');
		if ($top_bar_layout) {
			$top_bar['top_bar_layout'] = $top_bar_layout;
		}

		$top_bar_left_sidebar = g5plus_get_rwmb_meta('top_bar_left_sidebar');
		if ($top_bar_left_sidebar) {
			$top_bar['top_bar_left_sidebar'] = $top_bar_left_sidebar;
		}

		$top_bar_right_sidebar = g5plus_get_rwmb_meta('top_bar_right_sidebar');
		if ($top_bar_right_sidebar) {
			$top_bar['top_bar_right_sidebar'] = $top_bar_right_sidebar;
		}

		$top_bar_border = g5plus_get_rwmb_meta('top_bar_border');
		if (($top_bar_border !== '') && ($top_bar_border !== '-1')) {
			$top_bar['top_bar_border'] = $top_bar_border;
		}

		$top_bar_padding = g5plus_get_rwmb_meta('top_bar_padding');
		if (($top_bar_padding !== '') && isset($top_bar_padding['top']) && isset($top_bar_padding['bottom'])) {
			if ($top_bar_padding['top']) {
				$top_bar_padding['top'] .= 'px';
				$top_bar['top_bar_padding']['padding-top'] = $top_bar_padding['top'];
			}
			if ($top_bar_padding['bottom']) {
				$top_bar_padding['bottom'] .= 'px';
				$top_bar['top_bar_padding']['padding-bottom'] = $top_bar_padding['bottom'];
			}
		}

		$top_bar_mobile_enable = g5plus_get_rwmb_meta('top_bar_mobile_enable');
		if (($top_bar_mobile_enable !== '') && ($top_bar_mobile_enable !== '-1')) {
			$top_bar['top_bar_mobile_enable'] = $top_bar_mobile_enable;
		}

		$top_bar_mobile_layout = g5plus_get_rwmb_meta('top_bar_mobile_layout');
		if ($top_bar_mobile_layout) {
			$top_bar['top_bar_mobile_layout'] = $top_bar_mobile_layout;
		}

		$top_bar_mobile_left_sidebar = g5plus_get_rwmb_meta('top_bar_mobile_left_sidebar');
		if ($top_bar_mobile_left_sidebar) {
			$top_bar['top_bar_mobile_left_sidebar'] = $top_bar_mobile_left_sidebar;
		}

		$top_bar_mobile_right_sidebar = g5plus_get_rwmb_meta('top_bar_mobile_right_sidebar');
		if ($top_bar_mobile_right_sidebar) {
			$top_bar['top_bar_mobile_right_sidebar'] = $top_bar_mobile_right_sidebar;
		}

		$top_bar_mobile_border = g5plus_get_rwmb_meta('top_bar_mobile_border');
		if (($top_bar_mobile_border !== '') && ($top_bar_mobile_border !== '-1')) {
			$top_bar['top_bar_mobile_border'] = $top_bar_mobile_border;
		}
	}
}

//==============================================================================
// SET PAGE HEADER SETTING
//==============================================================================
if (!function_exists('g5plus_set_page_header_setting')) {
	function g5plus_set_page_header_setting()
	{
		$header = &G5Plus_Global::get_header_var();

		$header_show_hide = g5plus_get_rwmb_meta('header_show_hide');
		if ($header_show_hide !== '') {
			$header['header_show_hide'] = $header_show_hide;
		}

		$header_layout = g5plus_get_rwmb_meta('header_layout');
		if ($header_layout) {
			$header['header_layout'] = $header_layout;
		}

		$header_container_layout = g5plus_get_rwmb_meta('header_container_layout');
		if (($header_container_layout !== '') && ($header_container_layout !== '-1')) {
			$header['header_container_layout'] = $header_container_layout;
		}

		$header_float = g5plus_get_rwmb_meta('header_float');
		if (($header_float !== '') && ($header_float !== '-1')) {
			$header['header_float'] = $header_float;
		}

		$header_sticky = g5plus_get_rwmb_meta('header_sticky');
		if (($header_sticky !== '') && ($header_sticky !== '-1')) {
			$header['header_sticky'] = $header_sticky;
		}

		$header_border_bottom = g5plus_get_rwmb_meta('header_border_bottom');
		if (($header_border_bottom !== '') && ($header_border_bottom !== '-1')) {
			$header['header_border_bottom'] = $header_border_bottom;
		}

		$header_above_border_bottom = g5plus_get_rwmb_meta('header_above_border_bottom');
		if (($header_above_border_bottom !== '') && ($header_above_border_bottom !== '-1')) {
			$header['header_above_border_bottom'] = $header_above_border_bottom;
		}

		$header_padding = g5plus_get_rwmb_meta('header_padding');
		if (($header_padding !== '') && isset($header_padding['top']) && isset($header_padding['bottom'])) {
			if ($header_padding['top']) {
				$header_padding['top'] .= 'px';
				$header['header_padding']['padding-top'] = $header_padding['top'];
			}
			if ($header_padding['bottom']) {
				$header_padding['bottom'] .= 'px';
				$header['header_padding']['padding-bottom'] = $header_padding['bottom'];
			}
		}

		$navigation_height = g5plus_get_rwmb_meta('navigation_height');
		if (($navigation_height !== '')) {
			$header['navigation_height'] = $navigation_height . 'px';
		}

		$mobile_header_layout = g5plus_get_rwmb_meta('mobile_header_layout');
		if ($mobile_header_layout) {
			$header['mobile_header_layout'] = $mobile_header_layout;
		}

		$mobile_header_menu_drop = g5plus_get_rwmb_meta('mobile_header_menu_drop');
		if (($mobile_header_menu_drop !== '') && ($mobile_header_menu_drop !== '-1')) {
			$header['mobile_header_menu_drop'] = $mobile_header_menu_drop;
		}

		$mobile_header_stick = g5plus_get_rwmb_meta('mobile_header_stick');
		if (($mobile_header_stick !== '') && ($mobile_header_stick !== '-1')) {
			$header['mobile_header_stick'] = $mobile_header_stick;
		}

		$mobile_header_search_box = g5plus_get_rwmb_meta('mobile_header_search_box');
		if (($mobile_header_search_box !== '') && ($mobile_header_search_box !== '-1')) {
			$header['mobile_header_search_box'] = $mobile_header_search_box;
		}

		$mobile_header_shopping_cart = g5plus_get_rwmb_meta('mobile_header_shopping_cart');
		if (($mobile_header_shopping_cart !== '') && ($mobile_header_shopping_cart !== '-1')) {
			$header['mobile_header_shopping_cart'] = $mobile_header_shopping_cart;
		}

		$mobile_header_border_bottom = g5plus_get_rwmb_meta('mobile_header_border_bottom');
		if (($mobile_header_border_bottom !== '') && ($mobile_header_border_bottom !== '-1')) {
			$header['mobile_header_border_bottom'] = $mobile_header_border_bottom;
		}
	}
}

//==============================================================================
// SET PAGE HEADER CUSTOMIZE SETTING
//==============================================================================
if (!function_exists('g5plus_set_page_header_customize_setting')) {
	function g5plus_set_page_header_customize_setting()
	{
		$header_customize = &G5Plus_Global::get_header_customize_var();
		$enable_header_customize_nav = g5plus_get_rwmb_meta('enable_header_customize_nav');
		if ($enable_header_customize_nav) {
			$header_customize_nav = g5plus_get_rwmb_meta('header_customize_nav');
			if ($header_customize_nav !== '') {
				$header_customize_nav_arr = array();
				if (isset($header_customize_nav['enable'])) {
					$header_customize_nav_arr = explode('||', $header_customize_nav['enable']);
				}
				$header_customize['header_customize_nav']['enabled'] = array();
				foreach ($header_customize_nav_arr as $value) {
					$header_customize['header_customize_nav']['enabled'][$value] = $value;
				}
			}

			$header_customize_nav_email = g5plus_get_rwmb_meta('header_customize_nav_email');
			if ($header_customize_nav_email !== '') {
				$header_customize['header_customize_nav_email']['label'] = $header_customize_nav_email['label'];
				$header_customize['header_customize_nav_email']['value'] = $header_customize_nav_email['text'];
			}

			$header_customize_nav_phone = g5plus_get_rwmb_meta('header_customize_nav_phone');
			if ($header_customize_nav_phone !== '') {
				$header_customize['header_customize_nav_phone']['label'] = $header_customize_nav_phone['label'];
				$header_customize['header_customize_nav_phone']['value'] = $header_customize_nav_phone['text'];
			}

			$header_customize_nav_search = g5plus_get_rwmb_meta('header_customize_nav_search');
			if ($header_customize_nav_search !== '') {
				$header_customize['header_customize_nav_search'] = $header_customize_nav_search;
			}

			$header_customize_nav_sidebar = g5plus_get_rwmb_meta('header_customize_nav_sidebar');
			if ($header_customize_nav_sidebar) {
				$header_customize['header_customize_nav_sidebar'] = $header_customize_nav_sidebar;
			}

			$header_customize_nav_text = g5plus_get_rwmb_meta('header_customize_nav_text');
			if ($header_customize_nav_text !== '') {
				$header_customize['header_customize_nav_text'] = $header_customize_nav_text;
			}

			$header_customize_nav_spacing = g5plus_get_rwmb_meta('header_customize_nav_spacing');
			if ($header_customize_nav_spacing !== '') {
				$header_customize['header_customize_nav_spacing'] = $header_customize_nav_spacing . 'px';
			}
		}

		$enable_header_customize_left = g5plus_get_rwmb_meta('enable_header_customize_left');
		if ($enable_header_customize_left) {
			$header_customize_left = g5plus_get_rwmb_meta('header_customize_left');
			if ($header_customize_left !== '') {
				$header_customize_left_arr = array();
				if (isset($header_customize_left['enable'])) {
					$header_customize_left_arr = explode('||', $header_customize_left['enable']);
				}
				$header_customize['header_customize_left']['enabled'] = array();
				foreach ($header_customize_left_arr as $value) {
					$header_customize['header_customize_left']['enabled'][$value] = $value;
				}
			}

			$header_customize_left_email = g5plus_get_rwmb_meta('header_customize_left_email');
			if ($header_customize_left_email !== '') {
				$header_customize['header_customize_left_email']['label'] = $header_customize_left_email['label'];
				$header_customize['header_customize_left_email']['value'] = $header_customize_left_email['text'];
			}

			$header_customize_left_phone = g5plus_get_rwmb_meta('header_customize_left_phone');
			if ($header_customize_left_phone !== '') {
				$header_customize['header_customize_left_phone']['label'] = $header_customize_left_phone['label'];
				$header_customize['header_customize_left_phone']['value'] = $header_customize_left_phone['text'];
			}

			$header_customize_left_search = g5plus_get_rwmb_meta('header_customize_left_search');
			if ($header_customize_left_search !== '') {
				$header_customize['header_customize_left_search'] = $header_customize_left_search;
			}

			$header_customize_left_sidebar = g5plus_get_rwmb_meta('header_customize_left_sidebar');
			if ($header_customize_left_sidebar) {
				$header_customize['header_customize_left_sidebar'] = $header_customize_left_sidebar;
			}

			$header_customize_left_text = g5plus_get_rwmb_meta('header_customize_left_text');
			if ($header_customize_left_text !== '') {
				$header_customize['header_customize_left_text'] = $header_customize_left_text;
			}

			$header_customize_left_spacing = g5plus_get_rwmb_meta('header_customize_left_spacing');
			if ($header_customize_left_spacing !== '') {
				$header_customize['header_customize_left_spacing'] = $header_customize_left_spacing . 'px';
			}
		}

		$enable_header_customize_right = g5plus_get_rwmb_meta('enable_header_customize_right');
		if ($enable_header_customize_right) {
			$header_customize_right = g5plus_get_rwmb_meta('header_customize_right');
			if ($header_customize_right !== '') {
				$header_customize_right_arr = array();
				if (isset($header_customize_right['enable'])) {
					$header_customize_right_arr = explode('||', $header_customize_right['enable']);
				}
				$header_customize['header_customize_right']['enabled'] = array();
				foreach ($header_customize_right_arr as $value) {
					$header_customize['header_customize_right']['enabled'][$value] = $value;
				}
			}

			$header_customize_right_email = g5plus_get_rwmb_meta('header_customize_right_email');
			if ($header_customize_right_email !== '') {
				$header_customize['header_customize_right_email']['label'] = $header_customize_right_email['label'];
				$header_customize['header_customize_right_email']['value'] = $header_customize_right_email['text'];
			}

			$header_customize_right_phone = g5plus_get_rwmb_meta('header_customize_right_phone');
			if ($header_customize_right_phone !== '') {
				$header_customize['header_customize_right_phone']['label'] = $header_customize_right_phone['label'];
				$header_customize['header_customize_right_phone']['value'] = $header_customize_right_phone['text'];
			}

			$header_customize_right_search = g5plus_get_rwmb_meta('header_customize_right_search');
			if ($header_customize_right_search !== '') {
				$header_customize['header_customize_right_search'] = $header_customize_right_search;
			}

			$header_customize_right_sidebar = g5plus_get_rwmb_meta('header_customize_right_sidebar');
			if ($header_customize_right_sidebar) {
				$header_customize['header_customize_right_sidebar'] = $header_customize_right_sidebar;
			}

			$header_customize_right_text = g5plus_get_rwmb_meta('header_customize_right_text');
			if ($header_customize_right_text !== '') {
				$header_customize['header_customize_right_text'] = $header_customize_right_text;
			}

			$header_customize_right_spacing = g5plus_get_rwmb_meta('header_customize_right_spacing');
			if ($header_customize_right_spacing !== '') {
				$header_customize['header_customize_right_spacing'] = $header_customize_right_spacing . 'px';
			}
		}

	}
}

//==============================================================================
// SET PAGE FOOTER SETTING
//==============================================================================
if (!function_exists('g5plus_set_page_footer_setting')) {
	function g5plus_set_page_footer_setting()
	{
		$footer = &G5Plus_Global::get_footer_var();

		$footer_show_hide = g5plus_get_rwmb_meta('footer_show_hide');
		if ($footer_show_hide !== '') {
			$footer['footer_show_hide'] = $footer_show_hide;
		}

		$footer_container_layout = g5plus_get_rwmb_meta('footer_container_layout');
		if (($footer_container_layout !== '') && ($footer_container_layout !== '-1')) {
			$footer['footer_container_layout'] = $footer_container_layout;
		}

		$footer_layout = g5plus_get_rwmb_meta('footer_layout');
		if ($footer_layout) {
			$footer['footer_layout'] = $footer_layout;
		}

		$footer_sidebar_1 = g5plus_get_rwmb_meta('footer_sidebar_1');
		if ($footer_sidebar_1) {
			$footer['footer_sidebar_1'] = $footer_sidebar_1;
		}

		$footer_sidebar_2 = g5plus_get_rwmb_meta('footer_sidebar_2');
		if ($footer_sidebar_2) {
			$footer['footer_sidebar_2'] = $footer_sidebar_2;
		}

		$footer_sidebar_3 = g5plus_get_rwmb_meta('footer_sidebar_3');
		if ($footer_sidebar_3) {
			$footer['footer_sidebar_3'] = $footer_sidebar_3;
		}

		$footer_sidebar_4 = g5plus_get_rwmb_meta('footer_sidebar_4');
		if ($footer_sidebar_4) {
			$footer['footer_sidebar_4'] = $footer_sidebar_4;
		}

		$footer_bg_image= g5plus_get_meta_box_image('footer_bg_image');
		if ($footer_bg_image) {
			$footer['footer_bg_image'] = $footer_bg_image;
		}

		$footer_parallax = g5plus_get_rwmb_meta('footer_parallax');
		if (($footer_parallax !== '') && ($footer_parallax !== '-1')) {
			$footer['footer_parallax'] = $footer_parallax;
		}

		$collapse_footer = g5plus_get_rwmb_meta('collapse_footer');
		if (($collapse_footer !== '') && ($collapse_footer !== '-1')) {
			$footer['collapse_footer'] = $collapse_footer;
		}

		$footer_border_top = g5plus_get_rwmb_meta('footer_border_top');
		if (($footer_border_top !== '') && ($footer_border_top !== '-1')) {
			$footer['footer_border_top'] = $footer_border_top;
		}

		$footer_padding = g5plus_get_rwmb_meta('footer_padding');
		if (($footer_padding !== '') && isset($footer_padding['top']) && isset($footer_padding['bottom'])) {
			if ($footer_padding['top']) {
				$footer_padding['top'] .= 'px';
				$footer['footer_padding']['padding-top'] = $footer_padding['top'];
			}
			if ($footer_padding['bottom']) {
				$footer_padding['bottom'] .= 'px';
				$footer['footer_padding']['padding-bottom'] = $footer_padding['bottom'];
			}


		}

		$bottom_bar_visible = g5plus_get_rwmb_meta('bottom_bar_visible');
		if ($bottom_bar_visible !== '') {
			$footer['bottom_bar_visible'] = $bottom_bar_visible;
		}

		$bottom_bar_layout = g5plus_get_rwmb_meta('bottom_bar_layout');
		if ($bottom_bar_layout) {
			$footer['bottom_bar_layout'] = $bottom_bar_layout;
		}

		$bottom_bar_left_sidebar = g5plus_get_rwmb_meta('bottom_bar_left_sidebar');
		if ($bottom_bar_left_sidebar) {
			$footer['bottom_bar_left_sidebar'] = $bottom_bar_left_sidebar;
		}

		$bottom_bar_right_sidebar = g5plus_get_rwmb_meta('bottom_bar_right_sidebar');
		if ($bottom_bar_right_sidebar) {
			$footer['bottom_bar_right_sidebar'] = $bottom_bar_right_sidebar;
		}

		$bottom_bar_border_top = g5plus_get_rwmb_meta('bottom_bar_border_top');
		if (($bottom_bar_border_top !== '') && ($bottom_bar_border_top !== '-1')) {
			$footer['bottom_bar_border_top'] = $bottom_bar_border_top;
		}

		$bottom_bar_padding = g5plus_get_rwmb_meta('bottom_bar_padding');
		if (($bottom_bar_padding !== '') && isset($bottom_bar_padding['top']) && isset($bottom_bar_padding['bottom'])) {
			if ($bottom_bar_padding['top']) {
				$bottom_bar_padding['top'] .= 'px';
				$footer['bottom_bar_padding']['padding-top'] = $bottom_bar_padding['top'];
			}
			if ($bottom_bar_padding['bottom']) {
				$bottom_bar_padding['bottom'] .= 'px';
				$footer['bottom_bar_padding']['padding-bottom'] = $bottom_bar_padding['bottom'];
			}
		}
	}
}

//==============================================================================
// SET PAGE COLOR SETTING
//==============================================================================
if (!function_exists('g5plus_set_page_color_setting')) {
	function g5plus_set_page_color_setting()
	{
		$theme_color = &G5Plus_Global::get_theme_color_var();
		$header = &G5Plus_Global::get_header_var();

		// Accent Color
		$enable_accent_color = g5plus_get_rwmb_meta('enable_accent_color');
		if ($enable_accent_color) {
			$accent_color = g5plus_get_rwmb_meta('accent_color');
			if ($accent_color) {
				$theme_color['accent_color'] = $accent_color;
			}
			$foreground_accent_color = g5plus_get_rwmb_meta('foreground_accent_color');
			if ($foreground_accent_color) {
				$theme_color['foreground_accent_color'] = $foreground_accent_color;
			}
			if ($header['header_layout'] == 'header-2') {
				$theme_color['navigation_bg_color'] = $accent_color;
			}
		}

		// Top Drawer Color
		$enable_top_drawer_color = g5plus_get_rwmb_meta('enable_top_drawer_color');
		if ($enable_top_drawer_color) {
			$top_drawer_bg_color = g5plus_get_rwmb_meta('top_drawer_bg_color');
			if ($top_drawer_bg_color) {
				$theme_color['top_drawer_bg_color'] = $top_drawer_bg_color;
			}
			$top_drawer_text_color = g5plus_get_rwmb_meta('top_drawer_text_color');
			if ($top_drawer_text_color) {
				$theme_color['top_drawer_text_color'] = $top_drawer_text_color;
			}
		}

		// Header Color
		$enable_header_color = g5plus_get_rwmb_meta('enable_header_color');
		if ($enable_header_color) {
			$header_bg_color = g5plus_get_rwmb_meta('header_bg_color');
			if ($header_bg_color) {
				$theme_color['header_bg_color'] = $header_bg_color;
			}

			$header_text_color = g5plus_get_rwmb_meta('header_text_color');
			if ($header_text_color) {
				$theme_color['header_text_color'] = $header_text_color;
			}

			$header_border_color = g5plus_get_rwmb_meta('header_border_color');
			if ($header_border_color) {
				$theme_color['header_border_color'] = $header_border_color;
			}

			$header_above_border_color = g5plus_get_rwmb_meta('header_above_border_color');
			if ($header_above_border_color) {
				$theme_color['header_above_border_color'] = $header_above_border_color;
			}


			if ($header['header_float']) {
				$header_overlay = g5plus_get_rwmb_meta('header_overlay');
				if ($header_overlay !== '') {
					$theme_color['header_bg_color'] = g5plus_hex2rgba($theme_color['header_bg_color'], $header_overlay);
					$theme_color['header_border_color'] = g5plus_hex2rgba($theme_color['header_border_color'], 0.1);
					$theme_color['header_above_border_color'] = g5plus_hex2rgba($theme_color['header_above_border_color'], 0.1);
				}
			}
		}

		// Top Bar Color
		$enable_top_bar_color = g5plus_get_rwmb_meta('enable_top_bar_color');
		if ($enable_top_bar_color) {
			$top_bar_bg_color = g5plus_get_rwmb_meta('top_bar_bg_color');
			if ($top_bar_bg_color) {
				$theme_color['top_bar_bg_color'] = $top_bar_bg_color;
			}

			$top_bar_text_color = g5plus_get_rwmb_meta('top_bar_text_color');
			if ($top_bar_text_color) {
				$theme_color['top_bar_text_color'] = $top_bar_text_color;
			}

			$top_bar_border_color = g5plus_get_rwmb_meta('top_bar_border_color');
			if ($top_bar_border_color) {
				$theme_color['top_bar_border_color'] = $top_bar_border_color;
			}

			if ($header['header_float']) {
				$top_bar_overlay = g5plus_get_rwmb_meta('top_bar_overlay');
				if ($top_bar_overlay !== '') {
					$theme_color['top_bar_bg_color'] = g5plus_hex2rgba($theme_color['top_bar_bg_color'], $top_bar_overlay);
					$theme_color['top_bar_border_color'] = g5plus_hex2rgba($theme_color['top_bar_border_color'], 0.1);
				}
			}
		}
		// Navigation Color
		$enable_navigation_color = g5plus_get_rwmb_meta('enable_navigation_color');
		if ($enable_navigation_color) {
			$navigation_bg_color = g5plus_get_rwmb_meta('navigation_bg_color');
			if ($navigation_bg_color) {
				$theme_color['navigation_bg_color'] = $navigation_bg_color;
			}

			$navigation_text_color = g5plus_get_rwmb_meta('navigation_text_color');
			if ($navigation_text_color) {
				$theme_color['navigation_text_color'] = $navigation_text_color;
			}

			$navigation_text_color_hover = g5plus_get_rwmb_meta('navigation_text_color_hover');
			if ($navigation_text_color_hover) {
				$theme_color['navigation_text_color_hover'] = $navigation_text_color_hover;
			}

			if ($header['header_float']) {
				$navigation_overlay = g5plus_get_rwmb_meta('navigation_overlay');
				if ($navigation_overlay !== '') {
					$theme_color['navigation_bg_color'] = g5plus_hex2rgba($theme_color['navigation_bg_color'], $navigation_overlay);
				}
			}
		}

		// Footer Color
		$enable_footer_color = g5plus_get_rwmb_meta('enable_footer_color');
		if ($enable_footer_color) {
			$footer_bg_color = g5plus_get_rwmb_meta('footer_bg_color');
			if ($footer_bg_color) {
				$theme_color['footer_bg_color'] = $footer_bg_color;
			}

			$footer_text_color = g5plus_get_rwmb_meta('footer_text_color');
			if ($footer_text_color) {
				$theme_color['footer_text_color'] = $footer_text_color;
			}

			$footer_widget_title_color = g5plus_get_rwmb_meta('footer_widget_title_color');
			if ($footer_widget_title_color) {
				$theme_color['footer_widget_title_color'] = $footer_widget_title_color;
			}

			$footer_border_color = g5plus_get_rwmb_meta('footer_border_color');
			if ($footer_border_color) {
				$theme_color['footer_border_color'] = $footer_border_color;
			}
		}

		// Bottom Bar Color
		$enable_bottom_bar_color = g5plus_get_rwmb_meta('enable_bottom_bar_color');
		if ($enable_bottom_bar_color) {
			$bottom_bar_bg_color = g5plus_get_rwmb_meta('bottom_bar_bg_color');
			if ($bottom_bar_bg_color) {
				$theme_color['bottom_bar_bg_color'] = $bottom_bar_bg_color;
			}

			$bottom_bar_text_color = g5plus_get_rwmb_meta('bottom_bar_text_color');
			if ($bottom_bar_text_color) {
				$theme_color['bottom_bar_text_color'] = $bottom_bar_text_color;
			}

			$bottom_bar_border_color = g5plus_get_rwmb_meta('bottom_bar_border_color');
			if ($bottom_bar_border_color) {
				$theme_color['bottom_bar_border_color'] = $bottom_bar_border_color;
			}
		}
	}
}

//==============================================================================
// Check Change Page Spacing
//==============================================================================
if (!function_exists('g5plus_is_page_changed_spacing')) {
	function g5plus_is_page_changed_spacing($page_setting_id = 0) {
		// LOGO
		//--------------------------------------------------------
		$logo = &G5Plus_Global::get_logo_var();
		$logo_max_height = g5plus_get_page_meta_setting('logo_max_height', $page_setting_id);
		if (($logo_max_height !== '') && ($logo_max_height !== $logo['logo_max_height'])) {
			return true;
		}

		$logo_padding = g5plus_get_page_meta_setting('logo_padding', $page_setting_id, 'padding');
		if ($logo_padding !== '') {
			if (isset($logo_padding['top']) && $logo_padding['top'] && ($logo_padding['top'] != $logo['logo_padding']['padding-top'])) {
				return true;
			}
			if (isset($logo_padding['bottom']) && $logo_padding['bottom'] && ($logo_padding['bottom'] != $logo['logo_padding']['padding-bottom'])) {
				return true;
			}
		}

		$mobile_logo_max_height = g5plus_get_page_meta_setting('mobile_logo_max_height', $page_setting_id);
		if (($mobile_logo_max_height !== '') && ($mobile_logo_max_height !== $logo['mobile_logo_max_height'])) {
			return true;
		}

		$mobile_logo_padding = g5plus_get_page_meta_setting('mobile_logo_padding', $page_setting_id, 'padding');
		if ($mobile_logo_padding !== '') {
			if (isset($mobile_logo_padding['top']) && $mobile_logo_padding['top'] && ($mobile_logo_padding['top'] != $logo['mobile_logo_padding']['padding-top'])) {
				return true;
			}
			if (isset($mobile_logo_padding['bottom']) && $mobile_logo_padding['bottom'] && ($mobile_logo_padding['bottom'] != $logo['mobile_logo_padding']['padding-bottom'])) {
				return true;
			}
		}

		// TOP DRAWER
		//--------------------------------------------------------
		$top_drawer = &G5Plus_Global::get_top_drawer_var();
		$top_drawer_padding = g5plus_get_page_meta_setting('top_drawer_padding', $page_setting_id, 'padding');
		if ($top_drawer_padding !== '') {
			if (isset($top_drawer_padding['top']) && $top_drawer_padding['top'] && ($top_drawer_padding['top'] != $top_drawer['top_drawer_padding']['padding-top'])) {
				return true;
			}
			if (isset($top_drawer_padding['bottom']) && $top_drawer_padding['bottom'] && ($top_drawer_padding['bottom'] != $top_drawer['top_drawer_padding']['padding-bottom'])) {
				return true;
			}
		}

		// TOP BAR
		//--------------------------------------------------------
		$top_bar = &G5Plus_Global::get_top_bar_var();
		$top_bar_padding = g5plus_get_page_meta_setting('top_bar_padding', $page_setting_id, 'padding');
		if ($top_bar_padding !== '') {
			if (isset($top_bar_padding['top']) && $top_bar_padding['top'] && ($top_bar_padding['top'] != $top_bar['top_bar_padding']['padding-top'])) {
				return true;
			}
			if (isset($top_bar_padding['bottom']) && $top_bar_padding['bottom'] && ($top_bar_padding['bottom'] != $top_bar['top_bar_padding']['padding-bottom'])) {
				return true;
			}
		}

		// HEADER
		//--------------------------------------------------------
		$header = &G5Plus_Global::get_header_var();
		$header_padding = g5plus_get_page_meta_setting('header_padding', $page_setting_id, 'padding');
		if ($header_padding !== '') {
			if (isset($header_padding['top']) && $header_padding['top'] && ($header_padding['top'] != $header['header_padding']['padding-top'])) {
				return true;
			}
			if (isset($header_padding['bottom']) && $header_padding['bottom'] && ($header_padding['bottom'] != $header['header_padding']['padding-bottom'])) {
				return true;
			}
		}

		$navigation_height = g5plus_get_page_meta_setting('navigation_height', $page_setting_id);
		if (($navigation_height !== '') && ($navigation_height !== $header['navigation_height'])) {
			return true;
		}

		// CUSTOMIZE
		//--------------------------------------------------------
		$header_customize = &G5Plus_Global::get_header_customize_var();
		$enable_header_customize_nav = g5plus_get_page_meta_setting('enable_header_customize_nav', $page_setting_id);
		if ($enable_header_customize_nav) {
			$header_customize_nav_spacing = g5plus_get_page_meta_setting('header_customize_nav_spacing', $page_setting_id);
			if ($header_customize_nav_spacing !== '') {
				$header_customize_nav_spacing .= 'px';
				if ($header_customize_nav_spacing != $header_customize['header_customize_nav_spacing']) {
					return true;
				}
			}
		}

		$enable_header_customize_left = g5plus_get_page_meta_setting('enable_header_customize_left', $page_setting_id);
		if ($enable_header_customize_left) {
			$header_customize_left_spacing = g5plus_get_page_meta_setting('header_customize_left_spacing', $page_setting_id);
			if ($header_customize_left_spacing !== '') {
				$header_customize_left_spacing .= 'px';
				if ($header_customize_left_spacing != $header_customize['header_customize_left_spacing']) {
					return true;
				}
			}
		}

		$enable_header_customize_right = g5plus_get_page_meta_setting('enable_header_customize_right', $page_setting_id);
		if ($enable_header_customize_right) {
			$header_customize_right_spacing = g5plus_get_page_meta_setting('header_customize_right_spacing', $page_setting_id);
			if ($header_customize_right_spacing !== '') {
				$header_customize_right_spacing .= 'px';
				if ($header_customize_right_spacing != $header_customize['header_customize_right_spacing']) {
					return true;
				}
			}
		}

		// FOOTER
		//--------------------------------------------------------
		$footer = &G5Plus_Global::get_footer_var();
		$footer_padding = g5plus_get_page_meta_setting('footer_padding', $page_setting_id, 'padding');
		if ($footer_padding !== '') {
			if (isset($footer_padding['top']) && $footer_padding['top'] && ($footer_padding['top'] != $footer['footer_padding']['padding-top'])) {
				return true;
			}
			if (isset($footer_padding['bottom']) && $footer_padding['bottom'] && ($footer_padding['bottom'] != $footer['footer_padding']['padding-bottom'])) {
				return true;
			}
		}

		$bottom_bar_padding = g5plus_get_page_meta_setting('bottom_bar_padding', $page_setting_id, 'padding');
		if ($bottom_bar_padding !== '') {
			if (isset($bottom_bar_padding['top']) && $bottom_bar_padding['top'] && ($bottom_bar_padding['top'] != $footer['bottom_bar_padding']['padding-top'])) {
				return true;
			}
			if (isset($bottom_bar_padding['bottom']) && $bottom_bar_padding['bottom'] && ($bottom_bar_padding['bottom'] != $footer['bottom_bar_padding']['padding-bottom'])) {
				return true;
			}
		}

		return false;
	}
}

//==============================================================================
// Set page changed setting
//==============================================================================
if (!function_exists('g5plus_set_page_changed_setting')) {
	function g5plus_set_page_changed_setting($page_setting_id = 0) {
		$header = G5Plus_Global::get_header_var();
		$header_layout = $header['header_layout'];
		$page_header_layout = g5plus_get_page_meta_setting('header_layout', $page_setting_id);
		$is_header_layout_change = $page_header_layout && ($header_layout != $page_header_layout);

		$header_float = $header['header_float'];
		$page_header_float = g5plus_get_page_meta_setting('header_float', $page_setting_id);
		$is_header_float_change = $page_header_float && ($header_float != $page_header_float);


		$changed = &G5Plus_Global::get_page_changed_setting();
		$changed['spacing'] = g5plus_is_page_changed_spacing($page_setting_id);
		$changed['accent_color'] = g5plus_get_page_meta_setting('enable_accent_color', $page_setting_id);
		$changed['top_drawer_color'] = g5plus_get_page_meta_setting('enable_top_drawer_color', $page_setting_id);
		$changed['top_bar_color'] = g5plus_get_page_meta_setting('enable_top_bar_color', $page_setting_id) || $is_header_layout_change || $is_header_float_change;
		$changed['header_color'] = g5plus_get_page_meta_setting('enable_header_color', $page_setting_id) || $is_header_layout_change || $is_header_float_change;
		$changed['navigation_color'] = g5plus_get_page_meta_setting('enable_navigation_color', $page_setting_id) || $is_header_layout_change || $is_header_float_change;
		$changed['footer_color'] = g5plus_get_page_meta_setting('enable_navigation_color', $page_setting_id);
		$changed['bottom_bar_color'] = g5plus_get_page_meta_setting('enable_bottom_bar_color', $page_setting_id);

		$changed['page_setting'] = $changed['spacing']
			|| $changed['accent_color']
			|| $changed['top_drawer_color']
			|| $changed['top_bar_color']
			|| $changed['header_color']
			|| $changed['navigation_color']
			|| $changed['footer_color']
			|| $changed['bottom_bar_color'];
	}
}

//==============================================================================
// Get Page Meta Setting
//==============================================================================
if (!function_exists('g5plus_get_page_meta_setting')) {
	function g5plus_get_page_meta_setting($key, $post_id = 0, $type = '') {
		$meta = '';
		if ($post_id) {
			if ($type == 'image') {
				$meta = g5plus_get_meta_box_image($key, $post_id);
			}
			else {
				$meta = g5plus_get_rwmb_meta($key, array(), $post_id);
			}

			if (is_singular()) {
				switch ($type) {
					case '':
						$meta_temp = g5plus_get_rwmb_meta($key);
						if (($meta_temp !== '') && ($meta_temp !== '-1')) {
							$meta = $meta_temp;
						}
						break;
					case 'padding':
						$meta_temp = g5plus_get_rwmb_meta($key);
						if (($meta_temp !== '')) {
							if (isset($meta_temp['top']) && ($meta_temp['top'] !== '')) {
								$meta['top'] = $meta_temp['top'];
							}
							if (isset($meta_temp['bottom']) && ($meta_temp['bottom'] !== '')) {
								$meta['bottom'] = $meta_temp['bottom'];
							}
						}
						break;
					case 'image':
						$meta_temp = g5plus_get_rwmb_meta($key);
						if ($meta_temp !== '') {
							$meta = $meta_temp;
						}
						break;
				}
			}

		}
		else {
			if (is_singular()) {
				if ($type == 'image') {
					$meta = g5plus_get_meta_box_image($key);
				}
				else {
					$meta = g5plus_get_rwmb_meta($key);
				}
			}
		}


		return $meta;
	}
}

//////////////////////////////////////////////////////////////////
// SET PAGE LAYOUT SETTING
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_set_page_layout_setting')) {
	function g5plus_set_page_layout_setting(){
		$page_layouts = &G5Plus_Global::get_page_layout();

		// custom page layout
		$layout = g5plus_get_rwmb_meta('layout');
		if ($layout != '' && $layout != '-1') {
			$page_layouts['layout'] = $layout;
		}

		// custom sidebar layout
		$sidebar_layout = g5plus_get_rwmb_meta('sidebar_layout');
		if($sidebar_layout != '' && $sidebar_layout != '-1') {
			$page_layouts['sidebar_layout'] = $sidebar_layout;
		}

		// custom sidebar
		$sidebar = g5plus_get_rwmb_meta('sidebar');
		if ($sidebar != '' && $sidebar != '-1') {
			$page_layouts['sidebar'] = $sidebar;
		}

		// custom sidebar width
		$sidebar_width = g5plus_get_rwmb_meta('sidebar_width');
		if ($sidebar_width != '' && $sidebar_width != '-1') {
			$page_layouts['sidebar_width'] = $sidebar_width;
		}

		// custom sidebar mobile enable
		$sidebar_mobile_enable = g5plus_get_rwmb_meta('sidebar_mobile_enable');
		if ($sidebar_mobile_enable != '' && $sidebar_mobile_enable != '-1') {
			$page_layouts['sidebar_mobile_enable'] = $sidebar_mobile_enable;
		}

		// custom sidebar mobile canvas
		$sidebar_mobile_canvas = g5plus_get_rwmb_meta( 'sidebar_mobile_canvas' );
		if ( $sidebar_mobile_canvas != '' && $sidebar_mobile_canvas != '-1' ) {
			$page_layouts['sidebar_mobile_canvas'] = $sidebar_mobile_canvas;
		}

		// custom content padding
		$content_padding = g5plus_get_rwmb_meta('content_padding');
		if (isset($content_padding['top']) &&  ($content_padding['top'] != '')) {
			$page_layouts['padding']['padding-top'] = $content_padding['top'] . 'px';
		}
		if (isset($content_padding['bottom']) &&  ($content_padding['bottom'] != '')) {
			$page_layouts['padding']['padding-bottom'] = $content_padding['bottom'] . 'px';
		}

		// custom content padding
		$content_padding_mobile = g5plus_get_rwmb_meta('content_padding_mobile');
		if (isset($content_padding_mobile['top']) &&  ($content_padding_mobile['top'] != '')) {
			$page_layouts['padding_mobile']['padding-top'] = $content_padding_mobile['top'] . 'px';
		}
		if (isset($content_padding_mobile['bottom']) &&  ($content_padding_mobile['bottom'] != '')) {
			$page_layouts['padding_mobile']['padding-bottom'] = $content_padding_mobile['bottom'] . 'px';
		}
		$page_layouts['remove_content_padding'] = g5plus_get_rwmb_meta('remove_content_padding');
	}
}

//////////////////////////////////////////////////////////////////
// SET PAGE TITLE SETTING
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_set_page_title_setting')){
	function g5plus_set_page_title_setting(){
		$page_title_layouts = &G5Plus_Global::get_page_title_layout();
		// custom page_title_enable
		$page_title_enable = g5plus_get_rwmb_meta('page_title_enable');
		if ($page_title_enable != '' && $page_title_enable != -1) {
			$page_title_layouts['page_title_enable'] = $page_title_enable;
		}

		// custom page_title_layout
		$page_title_layout = g5plus_get_rwmb_meta('page_title_layout');
		if ($page_title_layout != '' && $page_title_layout != -1) {
			$page_title_layouts['layout'] = $page_title_layout;
		}

		// custom page_title
		$page_title_custom = g5plus_get_rwmb_meta('page_title_custom');
		if ($page_title_custom != '') {
			$page_title_layouts['title'] = $page_title_custom;
		} else {
			$page_title_layouts['title'] = get_the_title(get_the_ID());
		}

		// custom page sub title
		$enable_custom_page_subtitle = g5plus_get_rwmb_meta('enable_custom_page_subtitle');
		if ($enable_custom_page_subtitle) {
			$page_title_layouts['sub_title'] = g5plus_get_rwmb_meta('page_subtitle_custom');
		}

		$page_title_padding = g5plus_get_rwmb_meta('page_title_padding');
		// custom padding top
		if (isset($page_title_padding['top']) &&  ($page_title_padding['top'] != '')) {
			$page_title_layouts['padding']['padding-top'] = $page_title_padding['top'] . 'px';
		}

		// custom padding top
		if (isset($page_title_padding['bottom']) &&  ($page_title_padding['bottom'] != '')) {
			$page_title_layouts['padding']['padding-bottom'] = $page_title_padding['bottom'] . 'px';
		}

		// custom background image
		$enable_custom_page_title_bg_image = g5plus_get_rwmb_meta('enable_custom_page_title_bg_image');
		if ($enable_custom_page_title_bg_image) {
			$page_title_bg_image_id = g5plus_get_rwmb_meta('page_title_bg_image',array('multiple' => false));
			if (!empty($page_title_bg_image_id)) {
				$page_title_bg_image = wp_get_attachment_image_src($page_title_bg_image_id,'full');
				if ($page_title_bg_image) {
					$page_title_layouts['background-image']['url'] = $page_title_bg_image[0];
				}
			}
		}

		// custom page title parallax
		$page_title_parallax = g5plus_get_rwmb_meta('page_title_parallax');
		if ($page_title_parallax != '' && $page_title_parallax != -1) {
			$page_title_layouts['parallax'] = $page_title_parallax;
		}

		$breadcrumbs_enable = g5plus_get_rwmb_meta('breadcrumbs_enable');
		if ($breadcrumbs_enable != '' && $breadcrumbs_enable != -1) {
			$page_title_layouts['breadcrumbs_enable'] = $breadcrumbs_enable;
		}
	}
}

//////////////////////////////////////////////////////////////////
// CUSTOM SET PAGE LAYOUT
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_set_custom_page_layout')) {
	function g5plus_set_custom_page_layout(){
		global $post;
		$post_type = get_post_type($post);
		$page_layout_args = array();
		// custom page layout
		if (is_page()) {
			$custom_page_layout_enable = G5Plus_Global::get_option('custom_page_layout_enable');
			if ($custom_page_layout_enable) {
				$page_layout_args = array(
					'layout'                => G5Plus_Global::get_option( 'page_layout' ),
					'sidebar_layout'        => G5Plus_Global::get_option( 'page_sidebar_layout' ),
					'sidebar'               => G5Plus_Global::get_option( 'page_sidebar' ),
					'sidebar_width'         => G5Plus_Global::get_option( 'page_sidebar_width' ),
					'sidebar_mobile_enable' => G5Plus_Global::get_option('page_sidebar_mobile_enable'),
					'sidebar_mobile_canvas' => G5Plus_Global::get_option( 'page_sidebar_mobile_canvas' ),
					'padding'               => G5Plus_Global::get_option( 'page_content_padding' ),
					'padding_mobile'        => G5Plus_Global::get_option( 'page_content_padding_mobile' )
				);
			}
		}


		// custom page layout blog
		if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
			$custom_blog_layout_enable = G5Plus_Global::get_option('custom_blog_layout_enable');
			if ($custom_blog_layout_enable) {
				$page_layout_args = array(
					'layout'                => G5Plus_Global::get_option( 'blog_layout' ),
					'sidebar_layout'        => G5Plus_Global::get_option( 'blog_sidebar_layout' ),
					'sidebar'               => G5Plus_Global::get_option( 'blog_sidebar' ),
					'sidebar_width'         => G5Plus_Global::get_option( 'blog_sidebar_width' ),
					'sidebar_mobile_enable' => G5Plus_Global::get_option('blog_sidebar_mobile_enable'),
					'sidebar_mobile_canvas' => G5Plus_Global::get_option( 'blog_sidebar_mobile_canvas' ),
					'padding'               => G5Plus_Global::get_option( 'blog_content_padding' ),
					'padding_mobile'        => G5Plus_Global::get_option( 'blog_content_padding_mobile' )
				);
			}
		}

		// custom page layout single blog
		if (is_singular('post')) {
			$custom_single_blog_layout_enable = G5Plus_Global::get_option('custom_single_blog_layout_enable');
			if ($custom_single_blog_layout_enable) {
				$page_layout_args = array(
					'layout'                => G5Plus_Global::get_option( 'single_blog_layout' ),
					'sidebar_layout'        => G5Plus_Global::get_option( 'single_blog_sidebar_layout' ),
					'sidebar'               => G5Plus_Global::get_option( 'single_blog_sidebar' ),
					'sidebar_width'         => G5Plus_Global::get_option( 'single_blog_sidebar_width' ),
					'sidebar_mobile_enable' => G5Plus_Global::get_option('single_blog_sidebar_mobile_enable'),
					'sidebar_mobile_canvas' => G5Plus_Global::get_option( 'single_blog_sidebar_mobile_canvas' ),
					'padding'               => G5Plus_Global::get_option( 'single_blog_content_padding' ),
					'padding_mobile'        => G5Plus_Global::get_option( 'single_blog_content_padding_mobile' )
				);
			}
		}



		// custom page layout archive product
		if (is_post_type_archive( 'product' ) || is_tax('product_cat') || is_tax('product_tag') || (is_search() && ($post_type == 'product'))) {
			$custom_archive_product_layout_enable = G5Plus_Global::get_option('custom_archive_product_layout_enable');
			if ($custom_archive_product_layout_enable) {
				$page_layout_args = array(
					'layout'                => G5Plus_Global::get_option( 'archive_product_layout' ),
					'sidebar_layout'        => G5Plus_Global::get_option( 'archive_product_sidebar_layout' ),
					'sidebar'               => G5Plus_Global::get_option( 'archive_product_sidebar' ),
					'sidebar_width'         => G5Plus_Global::get_option( 'archive_product_sidebar_width' ),
					'sidebar_mobile_enable' => G5Plus_Global::get_option('archive_product_sidebar_mobile_enable'),
					'sidebar_mobile_canvas' => G5Plus_Global::get_option( 'archive_product_sidebar_mobile_canvas' ),
					'padding'               => G5Plus_Global::get_option( 'archive_product_content_padding' ),
					'padding_mobile'        => G5Plus_Global::get_option( 'archive_product_content_padding_mobile' )
				);
			}
		}

		// custom page layout single product
		if (is_singular('product')) {
			$custom_single_product_layout_enable = G5Plus_Global::get_option('custom_single_product_layout_enable');
			if ($custom_single_product_layout_enable) {
				$page_layout_args = array(
					'layout'                => G5Plus_Global::get_option( 'single_product_layout' ),
					'sidebar_layout'        => G5Plus_Global::get_option( 'single_product_sidebar_layout' ),
					'sidebar'               => G5Plus_Global::get_option( 'single_product_sidebar' ),
					'sidebar_width'         => G5Plus_Global::get_option( 'single_product_sidebar_width' ),
					'sidebar_mobile_enable' => G5Plus_Global::get_option('single_product_sidebar_mobile_enable'),
					'sidebar_mobile_canvas' => G5Plus_Global::get_option( 'single_product_sidebar_mobile_canvas' ),
					'padding'               => G5Plus_Global::get_option( 'single_product_content_padding' ),
					'padding_mobile'        => G5Plus_Global::get_option( 'single_product_content_padding_mobile' )
				);
			}
		}

		// custom page layout archive portfolio
		if (is_post_type_archive( 'portfolio' ) || is_tax('portfolio-category') || is_tax('portfolio_tag')) {
			$custom_archive_portfolio_layout_enable = G5Plus_Global::get_option('custom_archive_portfolio_layout_enable');
			if ($custom_archive_portfolio_layout_enable) {
				$page_layout_args = array(
					'layout'                => G5Plus_Global::get_option( 'archive_portfolio_layout' ),
					'sidebar_layout'        => G5Plus_Global::get_option( 'archive_portfolio_sidebar_layout' ),
					'sidebar'               => G5Plus_Global::get_option( 'archive_portfolio_sidebar' ),
					'sidebar_width'         => G5Plus_Global::get_option( 'archive_portfolio_sidebar_width' ),
					'sidebar_mobile_enable' => G5Plus_Global::get_option('archive_portfolio_sidebar_mobile_enable'),
					'sidebar_mobile_canvas' => G5Plus_Global::get_option( 'archive_portfolio_sidebar_mobile_canvas' ),
					'padding'               => G5Plus_Global::get_option( 'archive_portfolio_content_padding' ),
					'padding_mobile'        => G5Plus_Global::get_option( 'archive_portfolio_content_padding_mobile' )
				);
			}
		}

		// custom page layout single portfolio
		if (is_singular('portfolio')) {
			$custom_single_portfolio_layout_enable = G5Plus_Global::get_option('custom_single_portfolio_layout_enable');
			if ($custom_single_portfolio_layout_enable) {
				$page_layout_args = array(
					'layout'                => G5Plus_Global::get_option( 'single_portfolio_layout' ),
					'sidebar_layout'        => G5Plus_Global::get_option( 'single_portfolio_sidebar_layout' ),
					'sidebar'               => G5Plus_Global::get_option( 'single_portfolio_sidebar' ),
					'sidebar_width'         => G5Plus_Global::get_option( 'single_portfolio_sidebar_width' ),
					'sidebar_mobile_enable' => G5Plus_Global::get_option('single_portfolio_sidebar_mobile_enable'),
					'sidebar_mobile_canvas' => G5Plus_Global::get_option( 'single_portfolio_sidebar_mobile_canvas' ),
					'padding'               => G5Plus_Global::get_option( 'single_portfolio_content_padding' ),
					'padding_mobile'        => G5Plus_Global::get_option( 'single_portfolio_content_padding_mobile' )
				);
			}
		}

		// custom page layout archive our team
		if (is_post_type_archive( 'ourteam' ) || is_tax('ourteam-category')) {
			$custom_archive_ourteam_layout_enable = G5Plus_Global::get_option('custom_archive_ourteam_layout_enable');
			if ($custom_archive_ourteam_layout_enable) {
				$page_layout_args = array(
					'layout'                => G5Plus_Global::get_option( 'archive_ourteam_layout' ),
					'sidebar_layout'        => G5Plus_Global::get_option( 'archive_ourteam_sidebar_layout' ),
					'sidebar'               => G5Plus_Global::get_option( 'archive_ourteam_sidebar' ),
					'sidebar_width'         => G5Plus_Global::get_option( 'archive_ourteam_sidebar_width' ),
					'sidebar_mobile_enable' => G5Plus_Global::get_option('archive_ourteam_sidebar_mobile_enable'),
					'sidebar_mobile_canvas' => G5Plus_Global::get_option( 'archive_ourteam_sidebar_mobile_canvas' ),
					'padding'               => G5Plus_Global::get_option( 'archive_ourteam_content_padding' ),
					'padding_mobile'        => G5Plus_Global::get_option( 'archive_ourteam_content_padding_mobile' )
				);
			}
		}

		if (sizeof($page_layout_args) > 0) {
			G5Plus_Global::set_page_layout($page_layout_args);
		}
	}
}

//////////////////////////////////////////////////////////////////
// CUSTOM SET PAGE TITLE
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_set_custom_page_title')) {
	function g5plus_set_custom_page_title(){
		global $post;
		$post_type = get_post_type($post);
		$page_title_layout_args = array();

		// custom page title blog
		if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
			$custom_blog_title_enable = G5Plus_Global::get_option('custom_blog_title_enable');
			if ($custom_blog_title_enable) {
				$page_title_layout_args = array(
					'page_title_enable' => G5Plus_Global::get_option('blog_title_enable'),
					'layout' => G5Plus_Global::get_option('blog_title_layout'),
					'sub_title' => G5Plus_Global::get_option('blog_sub_title'),
					'padding' => G5Plus_Global::get_option('blog_title_padding'),
					'background-image' => G5Plus_Global::get_option('blog_title_bg_image'),
					'parallax' => G5Plus_Global::get_option('blog_title_parallax'),
					'breadcrumbs_enable' => G5Plus_Global::get_option('blog_breadcrumbs_enable')
				);
			}
		}

		// custom page title single blog
		if (is_singular('post')) {
			$custom_single_blog_title_enable = G5Plus_Global::get_option('custom_single_blog_title_enable');
			if ($custom_single_blog_title_enable) {
				$page_title_layout_args = array(
					'page_title_enable' => G5Plus_Global::get_option('single_blog_title_enable'),
					'layout' => G5Plus_Global::get_option('single_blog_title_layout'),
					'sub_title' => G5Plus_Global::get_option('single_blog_sub_title'),
					'padding' => G5Plus_Global::get_option('single_blog_title_padding'),
					'background-image' => G5Plus_Global::get_option('single_blog_title_bg_image'),
					'parallax' => G5Plus_Global::get_option('single_blog_title_parallax'),
					'breadcrumbs_enable' => G5Plus_Global::get_option('single_blog_breadcrumbs_enable')
				);
			}
		}

		// custom page title archive product
		if (is_post_type_archive( 'product' ) || is_tax('product_cat') || is_tax('product_tag') || (is_search() && ($post_type == 'product'))) {
			$custom_archive_product_title_enable = G5Plus_Global::get_option('custom_archive_product_title_enable');
			if ($custom_archive_product_title_enable) {
				$page_title_layout_args = array(
					'page_title_enable' => G5Plus_Global::get_option('archive_product_title_enable'),
					'layout' => G5Plus_Global::get_option('archive_product_title_layout'),
					'sub_title' => G5Plus_Global::get_option('archive_product_sub_title'),
					'padding' => G5Plus_Global::get_option('archive_product_title_padding'),
					'background-image' => G5Plus_Global::get_option('archive_product_title_bg_image'),
					'parallax' => G5Plus_Global::get_option('archive_product_title_parallax'),
					'breadcrumbs_enable' => G5Plus_Global::get_option('archive_product_breadcrumbs_enable')
				);
			}
		}

		// custom page title single product
		if (is_singular('product')) {
			$custom_single_product_title_enable = G5Plus_Global::get_option('custom_single_product_title_enable');
			if ($custom_single_product_title_enable) {
				$page_title_layout_args = array(
					'page_title_enable' => G5Plus_Global::get_option('single_product_title_enable'),
					'layout' => G5Plus_Global::get_option('single_product_title_layout'),
					'sub_title' => G5Plus_Global::get_option('single_product_sub_title'),
					'padding' => G5Plus_Global::get_option('single_product_title_padding'),
					'background-image' => G5Plus_Global::get_option('single_product_title_bg_image'),
					'parallax' => G5Plus_Global::get_option('single_product_title_parallax'),
					'breadcrumbs_enable' => G5Plus_Global::get_option('single_product_breadcrumbs_enable')
				);
			}
		}

		// custom page title archive portfolio
		if (is_post_type_archive( 'portfolio' ) || is_tax('portfolio-category') || is_tax('portfolio_tag')) {
			$custom_archive_portfolio_title_enable = G5Plus_Global::get_option('custom_archive_portfolio_title_enable');
			if ($custom_archive_portfolio_title_enable) {
				$page_title_layout_args = array(
					'page_title_enable'  => G5Plus_Global::get_option('archive_portfolio_title_enable'),
					'layout'             => G5Plus_Global::get_option('archive_portfolio_title_layout'),
					'sub_title'          => G5Plus_Global::get_option('archive_portfolio_sub_title'),
					'padding'            => G5Plus_Global::get_option('archive_portfolio_title_padding'),
					'background-image'   => G5Plus_Global::get_option('archive_portfolio_title_bg_image'),
					'parallax'           => G5Plus_Global::get_option('archive_portfolio_title_parallax'),
					'breadcrumbs_enable' => G5Plus_Global::get_option('archive_portfolio_breadcrumbs_enable')
				);
				G5Plus_Global::set_page_title_layout($page_title_layout_args);
			}
		}

		// custom page title single portfolio
		if (is_singular('portfolio')){
			$custom_single_portfolio_title_enable = G5Plus_Global::get_option('custom_single_portfolio_title_enable');
			if ($custom_single_portfolio_title_enable) {
				$page_title_layout_args = array(
					'page_title_enable'  => G5Plus_Global::get_option('single_portfolio_title_enable'),
					'layout'             => G5Plus_Global::get_option('single_portfolio_title_layout'),
					'sub_title'          => G5Plus_Global::get_option('single_portfolio_sub_title'),
					'padding'            => G5Plus_Global::get_option('single_portfolio_title_padding'),
					'background-image'   => G5Plus_Global::get_option('single_portfolio_title_bg_image'),
					'parallax'           => G5Plus_Global::get_option('single_portfolio_title_parallax'),
					'breadcrumbs_enable' => G5Plus_Global::get_option('single_portfolio_breadcrumbs_enable')
				);
				G5Plus_Global::set_page_title_layout($page_title_layout_args);
			}
		}

		// custom page title archive ourteam
		if (is_post_type_archive( 'ourteam' ) || is_tax('ourteam-category')) {
			$custom_archive_ourteam_title_enable = G5Plus_Global::get_option('custom_archive_ourteam_title_enable');
			if ($custom_archive_ourteam_title_enable) {
				$page_title_layout_args = array(
					'page_title_enable' => G5Plus_Global::get_option('archive_ourteam_title_enable'),
					'layout' => G5Plus_Global::get_option('archive_ourteam_title_layout'),
					'sub_title' => G5Plus_Global::get_option('archive_ourteam_sub_title'),
					'padding' => G5Plus_Global::get_option('archive_ourteam_title_padding'),
					'background-image' => G5Plus_Global::get_option('archive_ourteam_title_bg_image'),
					'parallax' => G5Plus_Global::get_option('archive_ourteam_title_parallax'),
					'breadcrumbs_enable' => G5Plus_Global::get_option('archive_ourteam_breadcrumbs_enable')
				);
			}
		}

		if (sizeof($page_title_layout_args) > 0) {
			G5Plus_Global::set_page_title_layout($page_title_layout_args);
		}
	}
}