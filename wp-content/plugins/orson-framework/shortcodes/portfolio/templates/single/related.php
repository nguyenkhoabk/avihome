<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/20/15
 * Time: 1:58 PM
 */
$column = 4;
$image_size = '271x183';

$column_get = G5Plus_Framework_Global::get_option('portfolio_related_column');
$image_related = G5Plus_Framework_Global::get_option('custom_portfolio_related_image_size');
if (isset($column_get)) {
	$column = $column_get;
}
if (isset($image_related)) {
	$image_size = $image_related;
}
$item = $column;
$post_not_in = get_the_ID();
echo do_shortcode('[g5plus_portfolio title="Related Works" title_style="' . $title_style . '" layout_style="portfolio-slider" category="' . implode(',', $arrCatId) . '" items="-1" columns="' . $column . '" column_padding="20px" image_size="' . $image_size . '" current_page="1" ajax="2" arrows="true" post_not_in="' . $post_not_in . '"]'); ?>
