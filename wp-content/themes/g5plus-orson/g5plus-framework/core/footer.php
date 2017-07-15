<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 6/10/15
 * Time: 11:47 AM
 */

/*================================================
FOOTER
================================================== */
if (!function_exists('g5plus_footer_template')) {
    function g5plus_footer_template() {
        g5plus_get_template('footer-template');
    }
    add_action('g5plus_main_wrapper_footer','g5plus_footer_template',10);
}

/*================================================
ADD BACK TO TOP BUTTON
================================================== */
if (!function_exists('g5plus_back_to_top')) {
    function g5plus_back_to_top() {
	    g5plus_get_template('back-to-top');
    }
    add_action('g5plus_after_page_wrapper','g5plus_back_to_top',5);
}