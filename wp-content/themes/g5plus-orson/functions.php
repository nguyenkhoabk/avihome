<?php
/**
 * Orson functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
define('G5PLUS_HOME_URL', trailingslashit(home_url('/')));
define('G5PLUS_THEME_DIR', trailingslashit(get_template_directory()));
define('G5PLUS_THEME_URL', trailingslashit(get_template_directory_uri()));
define('G5PLUS_METABOX_PREFIX', 'g5plus_');

if (!function_exists('g5plus_add_custom_mime_types')) {
	function g5plus_add_custom_mime_types($mimes)
	{
		return array_merge($mimes, array(
			'eot' => 'application/vnd.ms-fontobject',
			'woff' => 'application/x-font-woff',
			'ttf' => 'application/x-font-truetype'
		));
	}

	add_filter('upload_mimes', 'g5plus_add_custom_mime_types');
}


if (!function_exists('g5plus_include_library')) {
	function g5plus_include_library()
	{
		require_once(G5PLUS_THEME_DIR . 'g5plus-framework/g5plus-framework.php');
		require_once(G5PLUS_THEME_DIR . 'g5plus-framework/options/framework.php');
		require_once(G5PLUS_THEME_DIR . 'g5plus-framework/option-extensions/loader.php');
		require_once(G5PLUS_THEME_DIR . 'includes/options-functions.php');
		require_once(G5PLUS_THEME_DIR . 'includes/register-require-plugin.php');
		require_once(G5PLUS_THEME_DIR . 'includes/theme-setup.php');
		require_once(G5PLUS_THEME_DIR . 'includes/sidebar.php');
		require_once(G5PLUS_THEME_DIR . 'includes/meta-boxes.php');
		require_once(G5PLUS_THEME_DIR . 'includes/admin-enqueue.php');
		require_once(G5PLUS_THEME_DIR . 'includes/theme-functions.php');
		require_once(G5PLUS_THEME_DIR . 'includes/theme-action.php');
		require_once(G5PLUS_THEME_DIR . 'includes/theme-filter.php');
		require_once(G5PLUS_THEME_DIR . 'includes/frontend-enqueue.php');
		require_once(G5PLUS_THEME_DIR . 'includes/tax-meta.php');
		require_once(G5PLUS_THEME_DIR . 'includes/options-config.php');
	}

	g5plus_include_library();
}
