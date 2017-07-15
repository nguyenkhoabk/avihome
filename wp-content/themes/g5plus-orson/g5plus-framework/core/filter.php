<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/6/2015
 * Time: 9:36 AM
 */

/*================================================
FILTER TAG FORMAT
================================================== */
if (!function_exists('g5plus_tag_cloud')) {
    function g5plus_tag_cloud($tag_string) {
        return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
    }
    add_filter('wp_generate_tag_cloud', 'g5plus_tag_cloud', 10, 3);
}

if (!function_exists('g5plus_style_loader_tag')) {
	function g5plus_style_loader_tag($html, $handle ) {
		return str_replace( " href='", " property='stylesheet' href='", $html );
	}
	add_filter( 'style_loader_tag', 'g5plus_style_loader_tag', 10, 2);
}

//////////////////////////////////////////////////////////////////
// Filter Layout Wrap Class
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_layout_wrap_class')) {
	function g5plus_layout_wrap_class($layout_wrap_class){
		global $post;
		$post_type = get_post_type($post);
		$wrap_class = array();

		// custom layout wrap class page
		if (is_page()) {
			$wrap_class[] = 'page-wrap';
		}

		// custom layout wrap class blog
		if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
			$post_layouts = &G5Plus_Global::get_post_layout();

			// set post layout
			$post_layout = isset($_GET['post-layout']) ? $_GET['post-layout'] : '';
			if (array_key_exists($post_layout,g5plus_get_post_layout())) {
				$post_layouts['layout'] = $post_layout;
			}

			// set post column
			$post_column = isset($_GET['column']) ? $_GET['column'] : '';
			if (array_key_exists($post_column,g5plus_get_post_columns())) {
				$post_layouts['post_column'] = $post_column;
			}

			// set paging
			$paging = isset($_GET['paging']) ? $_GET['paging'] : '';
			if (array_key_exists($paging,g5plus_get_paging_style())) {
				$post_layouts['paging'] = $paging;
			}

			$wrap_class[] = 'archive-wrap';
			$wrap_class[] = 'archive-' . $post_layouts['layout'];
			if (in_array($post_layouts['layout'],array('masonry'))) {
				$wrap_class[] = 'archive-columns-' . $post_layouts['post_column'];
			}
		}


		// custom layout wrap class single blog
		if (is_singular('post')) {
			$wrap_class[] = 'single-blog-wrap';
		}

		// custom layout wrap class archive product
		if (is_post_type_archive( 'product' ) || is_tax('product_cat') || is_tax('product_tag') || (is_search() && ($post_type == 'product'))) {
			$wrap_class[] = 'archive-product-wrap';
		}

		// custom layout wrap class single product
		if (is_singular('product')) {
			$wrap_class[] = 'single-product-wrap';
		}


		return array_merge($layout_wrap_class,$wrap_class);

	}
	add_filter('g5plus_filter_layout_wrap_class','g5plus_layout_wrap_class');
}

//////////////////////////////////////////////////////////////////
// Filter Layout Inner Class
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_layout_inner_class')){
	function g5plus_layout_inner_class($layout_inner_class){
		global $post;
		$post_type = get_post_type($post);
		$inner_class = array();

		// custom layout inner class page
		if (is_page()) {
			$inner_class[] = 'page-inner';
		}

		// custom layout inner class blog
		if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
			$inner_class[] = 'archive-inner';
		}

		// custom layout inner class single blog
		if (is_singular('post')) {
			$inner_class[] = 'single-blog-inner';
		}

		// custom layout inner class archive product
		if (is_post_type_archive( 'product' ) || is_tax('product_cat') || is_tax('product_tag') || (is_search() && ($post_type == 'product'))) {
			$inner_class[] = 'archive-product-inner';
		}

		// custom layout inner class single product
		if (is_singular('product')) {
			$inner_class[] = 'single-product-inner';
		}

		return array_merge($layout_inner_class,$inner_class);
	}
	add_filter('g5plus_filter_layout_inner_class','g5plus_layout_inner_class');
}
