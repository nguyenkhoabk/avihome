<?php
/**
 * Created by PhpStorm.
 * User: duonglh
 * Date: 8/23/14
 * Time: 3:01 PM
 */

//==============================================================================
// Get Less to CSS string
//==============================================================================
if (!function_exists('g5plus_get_less_to_css')) {
	function g5plus_get_less_to_css($compress = true) {
		$g5plus_options = get_option('g5plus_orson_options');
		$loading_animation = isset($g5plus_options['loading_animation']) ? $g5plus_options['loading_animation'] : '';
		$css_variable = g5plus_custom_css_variable();
		$custom_css = g5plus_custom_css();

		if (!class_exists('Less_Parser')) {
			require_once G5PLUS_THEME_DIR . 'g5plus-framework/less/Less.php';
		}
		$parser = new Less_Parser(array( 'compress'=>$compress ));

		$parser->parse($css_variable);



		// Parse style.less
		$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/style.less',G5PLUS_THEME_URL );
		// Parse loading animation
		if (!empty($loading_animation)) {
			$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/loading/'.$loading_animation.'.less' );
		}
		$parser->parse($custom_css);
		$css = $parser->getCss();

		return $css;
	}
}

//==============================================================================
// Get Less to CSS string RTL
//==============================================================================
if (!function_exists('g5plus_get_less_to_css_rtl')) {
	function g5plus_get_less_to_css_rtl($compress = true) {
		$css_variable = g5plus_custom_css_variable();
		if (!class_exists('Less_Parser')) {
			require_once G5PLUS_THEME_DIR . 'g5plus-framework/less/Less.php';
		}
		$parser = new Less_Parser(array( 'compress'=>$compress ));

		$parser->parse($css_variable);

		// Parse rtl.less
		$parser->parseFile(G5PLUS_THEME_DIR . 'assets/less/variable.less');
		$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/rtl.less',G5PLUS_THEME_URL );
		$css = $parser->getCss();
		return $css;
	}
}

//==============================================================================
// Get Less to CSS string tta
//==============================================================================
if (!function_exists('g5plus_get_less_to_css_tta')) {
	function g5plus_get_less_to_css_tta($compress = true) {
		$css_variable = g5plus_custom_css_variable();
		if (!class_exists('Less_Parser')) {
			require_once G5PLUS_THEME_DIR . 'g5plus-framework/less/Less.php';
		}
		$parser = new Less_Parser(array( 'compress'=>$compress ));

		$parser->parse($css_variable);

		// Parse rtl.less
		$parser->parseFile(G5PLUS_THEME_DIR . 'assets/less/variable.less');
		$parser->parseFile( G5PLUS_THEME_DIR . 'assets/less/tta.less',G5PLUS_THEME_URL );
		$css = $parser->getCss();
		return $css;
	}
}

//==============================================================================
// GENERATE LESS TO CSS
//==============================================================================
if (!function_exists('g5plus_generate_less')) {
	function g5plus_generate_less()
	{
		try{
			if ( ! defined( 'FS_METHOD' ) ) {
				define('FS_METHOD', 'direct');
			}

			require_once(ABSPATH . 'wp-admin/includes/file.php');
			WP_Filesystem();
			global $wp_filesystem;

			//////////////////////////////////////////////////////////////////
			// Gen File Style
			//////////////////////////////////////////////////////////////////
			$css = g5plus_get_less_to_css(true);
			if (!$wp_filesystem->put_contents( G5PLUS_THEME_DIR.   "style.min.css", $css, FS_CHMOD_FILE)) {
				return array(
					'status' => 'error',
					'message' => esc_html__('Could not save file','g5plus-orson')
				);
			}

			$theme_info = $wp_filesystem->get_contents( G5PLUS_THEME_DIR . "theme-info.txt" );

			$css = g5plus_get_less_to_css(false);
			$css = $theme_info . "\n" . $css;
			$css = str_replace("\r\n","\n", $css);

			if (!$wp_filesystem->put_contents( G5PLUS_THEME_DIR.   "style.css", $css, FS_CHMOD_FILE)) {
				return array(
					'status' => 'error',
					'message' => esc_html__('Could not save file','g5plus-orson')
				);
			}

			//////////////////////////////////////////////////////////////////
			// Gen File RTL
			//////////////////////////////////////////////////////////////////
			$css = g5plus_get_less_to_css_rtl(true);
			if (!$wp_filesystem->put_contents( G5PLUS_THEME_DIR.   "assets/css/rtl.min.css", $css, FS_CHMOD_FILE)) {
				return array(
					'status' => 'error',
					'message' => esc_html__('Could not save file','g5plus-orson')
				);
			}

			$css = g5plus_get_less_to_css_rtl(false);
			$css = str_replace("\r\n","\n", $css);

			if (!$wp_filesystem->put_contents( G5PLUS_THEME_DIR.   "assets/css/rtl.css", $css, FS_CHMOD_FILE)) {
				return array(
					'status' => 'error',
					'message' => esc_html__('Could not save file','g5plus-orson')
				);
			}

			//////////////////////////////////////////////////////////////////
			// Gen File tta
			//////////////////////////////////////////////////////////////////
			$css = g5plus_get_less_to_css_tta(true);
			if (!$wp_filesystem->put_contents( G5PLUS_THEME_DIR.   "assets/css/tta.min.css", $css, FS_CHMOD_FILE)) {
				return array(
					'status' => 'error',
					'message' => esc_html__('Could not save file','g5plus-orson')
				);
			}

			$css = g5plus_get_less_to_css_tta(false);
			$css = str_replace("\r\n","\n", $css);

			if (!$wp_filesystem->put_contents( G5PLUS_THEME_DIR.   "assets/css/tta.css", $css, FS_CHMOD_FILE)) {
				return array(
					'status' => 'error',
					'message' => esc_html__('Could not save file','g5plus-orson')
				);
			}

			return array(
				'status' => 'success',
				'message' => ''
			);

		}catch(Exception $e){
			$error_message = $e->getMessage();
			return array(
				'status' => 'error',
				'message' => $error_message
			);
		}
	}
}
