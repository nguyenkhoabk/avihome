<?php
global $portfolio_metabox;
$post_id = get_the_ID();
$categories = get_the_terms($post_id, G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY);
$meta = get_post_meta($post_id, 'portfolio-custom-field', true);
$client = get_post_meta($post_id, 'portfolio-client', true);
$client_size = get_post_meta($post_id, 'portfolio-client-site', true);
$established_date = get_post_meta($post_id, 'established-date', true);
$portfolio_link = get_post_meta($post_id, 'portfolio-link', true);
$video = get_post_meta($post_id, 'portfolio-video', true);
$detail_style = get_post_meta($post_id, 'portfolio_detail_style', true);
if (!isset($detail_style) || $detail_style == 'none' || $detail_style == '') {
	$detail_style = G5Plus_Framework_Global::get_option('portfolio-single-style');
}
$meta_values = get_post_meta($post_id, 'portfolio-format-gallery', false);
$attach_id = get_post_thumbnail_id();
$title_style = $imgPretty = '';
if ($detail_style == 'two-columns') {
	$imgThumbs = gf_get_image_src($attach_id, 'portfolio-single-sm');
	$title_style = 'style_01';
} else {
	$imgThumbs = gf_get_image_src($attach_id, 'portfolio-single-md');
	$title_style = 'style_02';
	if ($detail_style == 'single-image') {
		$image_src_arr = wp_get_attachment_image_src($attach_id, 'full');
		if ($image_src_arr) {
			$imgPretty = $image_src_arr[0];
		}
	}
}
$cat = $arrCatId = $cat_link = array();
if ($categories) {
	foreach ($categories as $category) {
		$cat[count($cat)] = $category->name;
		$cat_link[count($cat_link)] = get_term_link($category->slug, 'portfolio-category');
		$arrCatId[count($arrCatId)] = $category->slug;
	}
}

G5plus_FrameWork::g5plus_get_template('shortcodes/portfolio/templates/single/' . $detail_style,
	array('imgThumbs' => $imgThumbs, 'client' => $client, 'client_size' => $client_size,
	      'portfolio_link' => $portfolio_link, 'cate' => $cat, 'cate_link' => $cat_link,
	      'meta_values' => $meta_values, 'video' => $video, 'imgPretty' => $imgPretty, 'meta' => $meta,
			'established_date' => $established_date));

//related portfolio
$portfolio_related = G5Plus_Framework_Global::get_option('show_portfolio_related');
if (isset($portfolio_related) && ($portfolio_related == '1' || $portfolio_related == 1)) {
	G5plus_FrameWork::g5plus_get_template('shortcodes/portfolio/templates/single/related', array('arrCatId' => $arrCatId, 'title_style' => $title_style));
}

