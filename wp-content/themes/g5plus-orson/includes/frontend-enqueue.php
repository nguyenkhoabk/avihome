<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 6:16 PM
 */
/*================================================
LOAD STYLESHEETS
================================================== */
if (!function_exists('g5plus_enqueue_styles')) {
	function g5plus_enqueue_styles() {
		$g5plus_options = &G5Plus_Global::get_options();
		$min_suffix = (isset($g5plus_options['enable_minifile_css']) && $g5plus_options['enable_minifile_css'] == 1) ? '.min' :  '';

		/*font-awesome*/
		$url_font_awesome = G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';
		if (isset($g5plus_options['cdn_font_awesome']) && !empty($g5plus_options['cdn_font_awesome'])) {
			$url_font_awesome = $g5plus_options['cdn_font_awesome'];
		}
		wp_enqueue_style('fontawesome', $url_font_awesome, array());
		wp_enqueue_style('fontawesome_animation', G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome-animation.min.css', array());

		/*bootstrap*/
		$url_bootstrap = G5PLUS_THEME_URL . 'assets/plugins/bootstrap/css/bootstrap.min.css';
		if (isset($g5plus_options['cdn_bootstrap_css']) && !empty($g5plus_options['cdn_bootstrap_css'])) {
			$url_bootstrap = $g5plus_options['cdn_bootstrap_css'];
		}
		wp_enqueue_style('bootstrap', $url_bootstrap, array());

		// pe-icon-7-stroke font icon
		wp_enqueue_style('pe-icon-7-stroke', G5PLUS_THEME_URL . 'assets/plugins/pe-icon-7-stroke/css/pe-icon-7-stroke.min.css', array());
		wp_enqueue_style('pe-icon-7-stroke-helper', G5PLUS_THEME_URL . 'assets/plugins/pe-icon-7-stroke/css/helper.min.css', array());

		/*light-gallery*/
		wp_enqueue_style('lightGallery', G5PLUS_THEME_URL . 'assets/plugins/light-gallery/css/lightgallery.min.css', array());

		/*peffect_scrollbar*/
		wp_enqueue_style('peffect_scrollbar', G5PLUS_THEME_URL . 'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css', array());

		/*owl.carousel*/
		wp_enqueue_style('owl.carousel', G5PLUS_THEME_URL. 'assets/plugins/owl.carousel.2.1.0/assets/owl.carousel.min.css',array(),'2.1.0');


		if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
			wp_enqueue_style('g5plus_framework_style', G5PLUS_THEME_URL . 'style'.$min_suffix.'.css');
		}
		else {
			wp_enqueue_style( 'g5plus-dev-style-css', admin_url( 'admin-ajax.php' ) . '?action=g5plus_dev_less_to_css', array(), false );
		}


	}
	add_action('wp_enqueue_scripts', 'g5plus_enqueue_styles',11);
}

//////////////////////////////////////////////////////////////////
// Load file rtl css
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_enqueue_styles_rtl')) {
	function g5plus_enqueue_styles_rtl() {
		$min_suffix = G5Plus_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
		$enable_rtl_mode = G5Plus_Global::get_option('enable_rtl_mode',0);
		if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {
			if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
				wp_enqueue_style('g5plus_framework_rtl', G5PLUS_THEME_URL . 'assets/css/rtl'.$min_suffix.'.css');
			}
			else {
				wp_enqueue_style( 'g5plus_framework_rtl', admin_url( 'admin-ajax.php' ) . '?action=g5plus_dev_less_to_css_rtl', array(), false );
			}
		}
	}
	add_action('wp_footer','g5plus_enqueue_styles_rtl');
}

/*================================================
LOAD SCRIPTS
================================================== */
if (!function_exists('g5plus_enqueue_script')) {
	function g5plus_enqueue_script() {
		$g5plus_options = &G5Plus_Global::get_options();
		$min_suffix = (isset($g5plus_options['enable_minifile_js']) && $g5plus_options['enable_minifile_js'] == 1) ? '.min' :  '';

		/*bootstrap*/
		$url_bootstrap = G5PLUS_THEME_URL . 'assets/plugins/bootstrap/js/bootstrap.min.js';
		if (isset($g5plus_options['cdn_bootstrap_js']) && !empty($g5plus_options['cdn_bootstrap_js'])) {
			$url_bootstrap = $g5plus_options['cdn_bootstrap_js'];
		}
		wp_enqueue_script('g5plus_framework_bootstrap', $url_bootstrap, array('jquery'), false, true);

		if (is_singular())	wp_enqueue_script('comment-reply');

		/*plugins*/
		wp_enqueue_script('g5plus_framework_plugins', G5PLUS_THEME_URL . 'assets/js/plugin'.$min_suffix.'.js', array(), false, true);

		/*smooth-scroll*/
		if ( isset($g5plus_options['smooth_scroll']) && ($g5plus_options['smooth_scroll'] == 1)) {
			wp_enqueue_script('g5plus_framework_smooth_scroll', G5PLUS_THEME_URL . 'assets/plugins/smoothscroll/SmoothScroll' . $min_suffix . '.js', array(), false, true);
		}

		wp_enqueue_script('g5plus_framework_app', G5PLUS_THEME_URL . 'assets/js/main' . $min_suffix . '.js', array(), false, true);

		// Localize the script with new data
		$translation_array = array(
			'product_compare' => esc_html__('Compare','g5plus-orson'),
			'owl_next' => esc_html__('Next','g5plus-orson'),
			'owl_prev' => esc_html__('Back','g5plus-orson')
		);
		wp_localize_script('g5plus_framework_app', 'g5plus_framework_constant', $translation_array);
		wp_localize_script(
			'g5plus_framework_app',
			'g5plus_app_variable',
			array(
				'ajax_url' => get_site_url() . '/wp-admin/admin-ajax.php?activate-multi=true',
				'theme_url' => G5PLUS_THEME_URL,
				'site_url' => site_url()
			)
		);


	}
	add_action('wp_enqueue_scripts', 'g5plus_enqueue_script');
}

/* CUSTOM CSS OUTPUT
	================================================== */
if(!function_exists('g5plus_enqueue_custom_css')){
    function g5plus_enqueue_custom_css() {
        $g5plus_options = &G5Plus_Global::get_options();
        $custom_css = $g5plus_options['custom_css'];
	    echo '<style id="g5plus_custom_style" type="text/css"></style>';
	    if ( $custom_css) {
            echo sprintf('<style type="text/css">%s %s</style>',"\n",$custom_css);
        }
    }
    add_action( 'wp_head', 'g5plus_enqueue_custom_css' );
}

if (!function_exists('g5plus_woocompare_custom_style')) {
	function g5plus_woocompare_custom_style() {
		$action = isset($_GET['action']) ? $_GET['action'] : '';
		if ($action == 'yith-woocompare-view-table') {
			$custom_css = '
			.woocommerce-compare-page h1 {
			font-size: 24px;
			background-color: #f4f4f4;
			color: #444;
			}';
			echo '<style id="g5plus_woocompare_custom_style" type="text/css"></style>';
			echo sprintf('<style type="text/css">%s %s</style>',"\n",$custom_css);
		}

	}
	add_action('wp_print_footer_scripts','g5plus_woocompare_custom_style');
}


/* CUSTOM JS OUTPUT
	================================================== */
if(!function_exists('g5plus_enqueue_custom_script')){
    function g5plus_enqueue_custom_script() {
        $g5plus_options = &G5Plus_Global::get_options();
        $custom_js = $g5plus_options['custom_js'];
        if ( $custom_js ) {
            echo sprintf('<script type="text/javascript">%s</script>',$custom_js);
        }
    }
    add_action( 'wp_footer', 'g5plus_enqueue_custom_script' );
}
