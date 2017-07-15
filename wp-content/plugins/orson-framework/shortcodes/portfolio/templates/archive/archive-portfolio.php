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

$custom_portfolio_layout_style = G5Plus_Framework_Global::get_option('custom_portfolio_layout_style');
$custom_portfolio_cate = G5Plus_Framework_Global::get_option('custom_portfolio_cate');
$custom_portfolio_category_display = G5Plus_Framework_Global::get_option('custom_portfolio_category_display');
$custom_portfolio_column = G5Plus_Framework_Global::get_option('custom_portfolio_column');
$custom_portfolio_paging = G5Plus_Framework_Global::get_option('custom_portfolio_paging');
$custom_portfolio_post_per_page = G5Plus_Framework_Global::get_option('custom_portfolio_post_per_page');
$custom_portfolio_overlay_style = G5Plus_Framework_Global::get_option('custom_portfolio_overlay_style');
$custom_portfolio_hover_effect = G5Plus_Framework_Global::get_option('custom_portfolio_hover_effect');
$custom_portfolio_icon_color_scheme = G5Plus_Framework_Global::get_option('custom_portfolio_icon_color_scheme');
$custom_portfolio_column_padding = G5Plus_Framework_Global::get_option('custom_portfolio_column_padding');
$custom_portfolio_image_size = G5Plus_Framework_Global::get_option('custom_portfolio_image_size');

if (!isset($custom_portfolio_layout_style)) $custom_portfolio_layout_style = 'portfolio-grid';
if (!isset($custom_portfolio_cate)) $custom_portfolio_cate = '';
if (!isset($custom_portfolio_category_display)) $custom_portfolio_category_display = '';
if (!isset($custom_portfolio_column)) $custom_portfolio_column = 4;
if (!isset($custom_portfolio_paging)) $custom_portfolio_paging = '';
if (!isset($custom_portfolio_post_per_page)) $custom_portfolio_post_per_page = 8;
if ($custom_portfolio_paging == '') $custom_portfolio_post_per_page = -1;
if (!isset($custom_portfolio_overlay_style)) $custom_portfolio_overlay_style = 'portfolio-overlay-none';
if (!isset($custom_portfolio_hover_effect)) $custom_portfolio_hover_effect = 'default-effect';
if ($custom_portfolio_overlay_style == 'portfolio-overlay-none') {
	$custom_portfolio_hover_effect = "";
}
if (!isset($custom_portfolio_icon_color_scheme)) $custom_portfolio_icon_color_scheme = 'icon-color-dark';
if (!isset($custom_portfolio_column_padding)) $custom_portfolio_column_padding = '';
if (!isset($custom_portfolio_image_size)) $custom_portfolio_image_size = 'portfolio-size1';

$category = '';
$cat = get_queried_object();
if ($cat && property_exists($cat, 'term_id')) {
	$category = $cat->slug;
}
$shortCode = '[g5plus_portfolio title=""
					 layout_style="' . $custom_portfolio_layout_style . '" category="' . $category . '"
					 show_category="' . $custom_portfolio_cate . '" category_display="' . $custom_portfolio_category_display . '"
					 items="-1" columns="' . $custom_portfolio_column . '"
					 overlay_style="' . $custom_portfolio_overlay_style . '" icon_color_scheme="' . $custom_portfolio_icon_color_scheme . '"
					 show_pagging="' . $custom_portfolio_paging . '" item_per_page="' . $custom_portfolio_post_per_page . '"
					 column_padding="' . $custom_portfolio_column_padding . '" image_size="' . $custom_portfolio_image_size . '" current_page="1"
					 ajax="3" arrows="true" hover_effect="' . $custom_portfolio_hover_effect . '" arrows_position="bottom" arrows_style="round"]';
echo do_shortcode($shortCode);
get_footer();
