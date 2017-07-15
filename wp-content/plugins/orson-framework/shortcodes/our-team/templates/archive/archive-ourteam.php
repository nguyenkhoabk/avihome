<?php
/**
 * The template for displaying archive our-team pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */

get_header();
$custom_ourteam_layout_style = G5Plus_Framework_Global::get_option('custom_ourteam_layout_style');
$custom_ourteam_tab = G5Plus_Framework_Global::get_option('custom_ourteam_tab') == 1;
$custom_ourteam_slider = G5Plus_Framework_Global::get_option('custom_ourteam_slider') == 1;
$custom_ourteam_column = G5Plus_Framework_Global::get_option('custom_ourteam_column');
$custom_ourteam_paging = G5Plus_Framework_Global::get_option('custom_ourteam_paging');
$custom_ourteam_post_per_page = G5Plus_Framework_Global::get_option('custom_ourteam_post_per_page');

if (!isset($custom_ourteam_layout_style)) $custom_ourteam_layout_style = 'style1';
if (!isset($custom_ourteam_column)) $custom_ourteam_column = '4';
if (!isset($custom_ourteam_post_per_page)) $custom_ourteam_post_per_page = 8;
if (!isset($custom_ourteam_paging)) {
	$custom_ourteam_paging = '';
}
if ($custom_ourteam_paging == '') {
	$custom_ourteam_post_per_page = -1;
}

$category = '';
$cat = get_queried_object();
if ($cat && property_exists($cat, 'term_id')) {
	$category = $cat->slug;
}
echo do_shortcode('[g5plus_our_team title="" item_amount="-1"
				 columns=' . $custom_ourteam_column . ' layout_style="' . $custom_ourteam_layout_style . '" category="' . $category . '" is_slider="'.$custom_ourteam_slider.'"
				 page_paging="' . $custom_ourteam_paging . '" post_per_page="' . $custom_ourteam_post_per_page . '" show_tab="' . $custom_ourteam_tab . '" ajax=2]');
get_footer();
