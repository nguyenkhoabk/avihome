<?php
/*---------------------------------------------------
/* Mobile Nav Overlay
/*---------------------------------------------------*/
if (!function_exists('g5plus_add_mobile_nav_overlay')) {
	function g5plus_add_mobile_nav_overlay($params) {
		$header = &G5Plus_Global::get_header_var();
		if ($header['mobile_header_menu_drop'] === 'menu-drop-fly') {
			echo '<div class="mobile-nav-overlay"></div>';
		}
	}
	add_action('wp_footer','g5plus_add_mobile_nav_overlay');
}

/*---------------------------------------------------
/* CUSTOM CSS
/*---------------------------------------------------*/
if (!function_exists('g5plus_page_customize_css')) {
	function g5plus_page_customize_css() {
		if (!is_singular() && !G5Plus_Global::is_changed_category_setting()) {
			return;
		}

		$page_setting_changed = &G5Plus_Global::get_page_changed_setting();
		if (!$page_setting_changed['page_setting']) {
			return;
		}

		$css_variable = g5plus_custom_css_variable();
		if (!class_exists('Less_Parser')) {
			require_once G5PLUS_THEME_DIR . 'g5plus-framework/less/Less.php';
		}
		$parser = new Less_Parser(array( 'compress'=>true ));
		$parser->parse($css_variable, G5PLUS_THEME_URL);
		$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/variable.less', G5PLUS_THEME_URL );
		if ($page_setting_changed['page_setting']) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/spacing.less', G5PLUS_THEME_URL );
		}

		if ($page_setting_changed['accent_color']) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/accent-color.less', G5PLUS_THEME_URL );
		}

		if ($page_setting_changed['top_drawer_color']) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/top-drawer-color.less', G5PLUS_THEME_URL );
		}

		if ($page_setting_changed['top_bar_color']) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/top-bar-color.less', G5PLUS_THEME_URL );
		}

		if ($page_setting_changed['header_color']) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/header-color.less', G5PLUS_THEME_URL );
		}

		if ($page_setting_changed['navigation_color']) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/navigation-color.less', G5PLUS_THEME_URL );
		}

		$enable_footer_color = g5plus_get_rwmb_meta('enable_footer_color');
		if ($enable_footer_color) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/footer-color.less', G5PLUS_THEME_URL );
		}

		$enable_bottom_bar_color = g5plus_get_rwmb_meta('enable_bottom_bar_color');
		if ($enable_bottom_bar_color) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/bottom-bar-color.less', G5PLUS_THEME_URL );
		}

		$css = $parser->getCss();

		echo "<style id='g5plus_page_custom_css' type='text/css'>$css</style>";

	}
	add_action('wp_head', 'g5plus_page_customize_css', 100);
}

/*---------------------------------------------------
/* CUSTOM TTA CSS
/*---------------------------------------------------*/
if (!function_exists('g5plus_page_customize_tta_css')) {
	function g5plus_page_customize_tta_css() {
		if (!is_singular() && !G5Plus_Global::is_changed_category_setting()) {
			return;
		}

		$page_setting_changed = &G5Plus_Global::get_page_changed_setting();
		if (!$page_setting_changed['page_setting']) {
			return;
		}

		$css_variable = g5plus_custom_css_variable();
		if (!class_exists('Less_Parser')) {
			require_once G5PLUS_THEME_DIR . 'g5plus-framework/less/Less.php';
		}
		$parser = new Less_Parser(array( 'compress'=>true ));
		$parser->parse($css_variable, G5PLUS_THEME_URL);
		$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/variable.less', G5PLUS_THEME_URL );

		if ($page_setting_changed['accent_color']) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/customize/tta.less', G5PLUS_THEME_URL );
		}

		$css = $parser->getCss();

		echo "<style id='g5plus_page_custom_tta_css' type='text/css' scoped>$css</style>";

	}
	add_action('wp_footer', 'g5plus_page_customize_tta_css', 100);
}

/**
 * Set page setting
 */
if (!function_exists('g5plus_set_page_setting_action')) {
	function g5plus_set_page_setting_action() {

		// set custom page layout
		g5plus_set_custom_page_layout();
		// set custom page title
		g5plus_set_custom_page_title();

		global $post;
		$post_type = get_post_type($post);

		$page_setting_id = 0;
		// Setting product
		if (is_post_type_archive( 'product' ) || is_tax('product_cat') || is_tax('product_tag') || (is_search() && ($post_type == 'product'))) {
			if (function_exists('wc_get_page_id')) {
				$page_setting_id = wc_get_page_id( 'shop' );
			}
		}

		if (is_singular('product')) {
			$product_id = G5Plus_Global::get_option('product_apply_setting');
			if ($product_id) {
				if ($product_id) {
					$page_setting_id = $product_id;
				}
			}
		}

		if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
			$page_setting_id = get_option( 'page_for_posts' );
		}

		if (is_singular('post')) {
			$post_id = G5Plus_Global::get_option('post_apply_setting');
			if ($post_id) {
				if ($post_id) {
					$page_setting_id = $post_id;
				}
			}
		}

		// Setting page 404
		if (is_404()) {
			$page_404_id = G5Plus_Global::get_option('404_apply_setting');
			if ($page_404_id) {
				$page_setting_id = $page_404_id;
			}
		}

		g5plus_set_page_changed_setting($page_setting_id);


		if ($page_setting_id) {
			g5plus_set_page_setting($page_setting_id);
		}
		if (is_singular()) {
			g5plus_set_page_setting();
		}
	}
	add_action('g5plus_before_header', 'g5plus_set_page_setting_action', 1);
}
