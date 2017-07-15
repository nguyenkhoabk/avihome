<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 5:50 PM
 */

/*================================================
BODY CLASS
================================================== */
if (!function_exists('g5plus_body_class_name')) {
	function g5plus_body_class_name($classes) {
		$g5plus_options = &G5Plus_Global::get_options();
		$header = &G5Plus_Global::get_header_var();


		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE) $classes[] = 'ie';
		else $classes[] = 'unknown';
		if($is_iphone) $classes[] = 'iphone';

		$action = isset($_GET['action']) ? $_GET['action'] : '';
		$page_transition = isset($g5plus_options['page_transition']) ? $g5plus_options['page_transition'] : '0';
		if (($page_transition == '1') && ($action != 'yith-woocompare-view-table')) {
			$classes[] = 'page-transitions';
		}

		if ($action == 'yith-woocompare-view-table') {
			$classes[] = 'woocommerce-compare-page';
		}

		$loading_animation = isset($g5plus_options['loading_animation']) ? $g5plus_options['loading_animation'] : '';
		if (!empty($loading_animation)) {
			$classes[] = 'page-loading';
		}

		if (is_singular()) {
			$page_class_extra =  g5plus_get_rwmb_meta('page_class_extra');
			if (!empty($page_class_extra)) {
				$classes[] = $page_class_extra;
			}
		}

		$layout_style = g5plus_get_rwmb_meta('layout_style');
		if (!is_singular() || $layout_style == '-1') {
			$layout_style = G5Plus_Global::get_option('layout_style');
		}

		if ($layout_style == 'boxed') {
			$classes[] =  'boxed';
		}

		if ($header['header_float']) {
			$classes[] = 'header-is-float';
		}


		$enable_rtl_mode = '0';
		if (isset($g5plus_options['enable_rtl_mode'])) {
			$enable_rtl_mode =  $g5plus_options['enable_rtl_mode'];
		}
		if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {
			$classes[] = 'rtl';
		}


		$page_layouts = &G5Plus_Global::get_page_layout();
		if (is_active_sidebar($page_layouts['sidebar']) && ($page_layouts['sidebar_layout'] != 'none')) {
			$classes[] = 'has-sidebar';
			if (is_post_type_archive( 'product' ) || is_tax('product_cat')) {
				$sidebar_layout = isset($_GET['sidebar-layout']) ? $_GET['sidebar-layout'] : '';
				if (!$sidebar_layout) {
					$custom_archive_product_layout_enable = G5Plus_Global::get_option('custom_archive_product_layout_enable');
					if ($custom_archive_product_layout_enable) {
						$sidebar_layout = G5Plus_Global::get_option('archive_product_sidebar_layout');
					}
				}
				if (!$sidebar_layout) {
					$sidebar_layout = $page_layouts['sidebar_layout'];
				}
				$classes[] = 'page-sidebar-'. esc_attr($sidebar_layout);
			}
		}

		return $classes;
	}
	add_filter('body_class','g5plus_body_class_name');
}

/*================================================
SITE LOADING
================================================== */
if (!function_exists('g5plus_site_loading')) {
	function g5plus_site_loading(){
        g5plus_get_template('site-loading');
	}
	add_action('g5plus_before_page_wrapper','g5plus_site_loading',5);
}

//////////////////////////////////////////////////////////////////
// PAGE TITLE
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_page_title')){
	function g5plus_page_title(){
		g5plus_get_template('page-title');
	}
	add_action('g5plus_before_single','g5plus_page_title',5);
	add_action('g5plus_before_archive','g5plus_page_title',5);
}

/*================================================
ABOVE HEADER
================================================== */
if (!function_exists('g5plus_page_top_drawer')) {
	function g5plus_page_top_drawer() {
		g5plus_get_template('top-drawer-template');
	}
	add_action('g5plus_before_page_wrapper_content','g5plus_page_top_drawer',10);
}

/*================================================
HEADER
================================================== */
if (!function_exists('g5plus_page_header')) {
	function g5plus_page_header() {
		$header = &G5Plus_Global::get_header_var();
		if ($header['header_show_hide']) {
			g5plus_get_template('header-desktop-template');
			g5plus_get_template('header-mobile-template');
		}
	}
	add_action('g5plus_before_page_wrapper_content','g5plus_page_header',15);
}

/*================================================
EMPTY SHOPPING CART
================================================== */
if (!function_exists('g5plus_woocommerce_clear_cart_url')) {
	function g5plus_woocommerce_clear_cart_url() {
		global $woocommerce;
		if (class_exists( 'WooCommerce' ) && isset($woocommerce)) {
			if ( isset( $_GET['empty-cart'] ) ) {
				$woocommerce->cart->empty_cart();
			}
		}
	}
	add_action( 'init', 'g5plus_woocommerce_clear_cart_url' );
}
