<?php
/**
 * Description: Create custom meta boxes and custom fields for any post type in WordPress.
 * Version: 4.8.7
 * Author: Rilwis
 * Author URI: http://www.deluxeblogtips.com
 * License: GPL2+
 */

if ( defined( 'ABSPATH' ) && ! class_exists( 'RWMB_Loader' ) )
{
	require G5PLUS_THEME_DIR . 'g5plus-framework/meta-box/inc/loader.php';
	new RWMB_Loader;
}
