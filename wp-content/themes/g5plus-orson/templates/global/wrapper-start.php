<?php
/**
 * The template used for displaying wrapper start
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$page_layouts = &G5Plus_Global::get_page_layout();
$remove_content_padding = false;
$layout_wrap_class = array();
$layout_inner_class = array();
if (is_singular()) {
	$remove_content_padding = $page_layouts['remove_content_padding'];
}

// set page layout
$layout = isset($_GET['layout']) ? $_GET['layout'] : '';
if (array_key_exists($layout,g5plus_get_page_layout())) {
	$page_layouts['layout'] = $layout;
}

// set sidebar_layout
$sidebar_layout = isset($_GET['sidebar-layout']) ? $_GET['sidebar-layout'] : '';
if(array_key_exists($sidebar_layout,g5plus_get_sidebar_layout())) {
	$page_layouts['sidebar_layout'] = $sidebar_layout;
}

// set sidebar_width
$sidebar_width = isset($_GET['sidebar-width']) ? $_GET['sidebar-width'] : '';
if (array_key_exists($sidebar_width,g5plus_get_sidebar_width())) {
	$page_layouts['sidebar_width'] = $sidebar_width;
}


$has_sidebar = false;
if (is_active_sidebar($page_layouts['sidebar']) && ($page_layouts['sidebar_layout'] != 'none')) {
	$has_sidebar = true;
	$sidebar_col = 3;
	if ($page_layouts['sidebar_width'] == 'large') {
		$sidebar_col = 4;
	}
	$layout_inner_class[] = 'col-md-'. (12 - $sidebar_col);
	if ($page_layouts['sidebar_layout'] == 'left') {
		$layout_inner_class[] = 'col-md-push-' . $sidebar_col;
	}
}

if (!$remove_content_padding) {
	if (isset($page_layouts['padding']['padding-top']) && ($page_layouts['padding']['padding-top'] != '') && ($page_layouts['padding']['padding-top'] != 'px') ) {
		$layout_wrap_class[] = 'pd-top-' . str_replace('px','',$page_layouts['padding']['padding-top']);
	}
	if (isset($page_layouts['padding']['padding-bottom']) && ($page_layouts['padding']['padding-bottom'] != '')  && ($page_layouts['padding']['padding-bottom'] != 'px')) {
		$layout_wrap_class[] = 'pd-bottom-' . str_replace('px','',$page_layouts['padding']['padding-bottom']);
	}

	if (isset($page_layouts['padding_mobile']['padding-top']) && ($page_layouts['padding_mobile']['padding-top'] != '') && ($page_layouts['padding_mobile']['padding-top'] != 'px') ) {
		$layout_wrap_class[] = 'sm-pd-top-' . str_replace('px','',$page_layouts['padding_mobile']['padding-top']);
	}
	if (isset($page_layouts['padding_mobile']['padding-bottom']) && ($page_layouts['padding_mobile']['padding-bottom'] != '')  && ($page_layouts['padding_mobile']['padding-bottom'] != 'px')) {
		$layout_wrap_class[] = 'sm-pd-bottom-' . str_replace('px','',$page_layouts['padding_mobile']['padding-bottom']);
	}
}

$layout_wrap_class = apply_filters('g5plus_filter_layout_wrap_class',$layout_wrap_class);
$layout_inner_class = apply_filters('g5plus_filter_layout_inner_class',$layout_inner_class);

if (is_singular()) {
	/**
	 * @hooked - g5plus_page_title - 5
	 **/
	do_action('g5plus_before_single');
} else {
	/**
	 * @hooked - g5plus_page_title - 5
	 * @hooked - g5plus_archive_product_banner_full - 10
	 **/
	do_action('g5plus_before_archive');
}
?>
<div id="primary-content" class="<?php echo esc_attr(join(' ',$layout_wrap_class));?>">
	<?php if ($page_layouts['layout'] != 'full'): ?>
		<div class="<?php echo esc_attr($page_layouts['layout']) ?> clearfix">
	<?php endif;?>
		<?php if (($has_sidebar) && ($page_layouts['layout'] != 'full')): ?>
			<div class="row">
		<?php endif; ?>
			<div class="<?php echo esc_attr(join(' ',$layout_inner_class)); ?>">
