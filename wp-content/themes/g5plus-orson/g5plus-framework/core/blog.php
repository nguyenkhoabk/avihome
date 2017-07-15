<?php
/**
 * Orson blog function
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
//////////////////////////////////////////////////////////////////
// Paging Navigation
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_paging_navigation')) {
	function g5plus_paging_navigation() {
		g5plus_get_template('paging/navigation');
	}
}

//////////////////////////////////////////////////////////////////
// Paging Load More
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_paging_load_more')) {
	function g5plus_paging_load_more() {
		g5plus_get_template('paging/load-more');
	}
}

//////////////////////////////////////////////////////////////////
// Paging Infinite Scroll
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_paging_infinite_scroll')) {
	function g5plus_paging_infinite_scroll() {
		g5plus_get_template('paging/infinite-scroll');
	}
}

//////////////////////////////////////////////////////////////////
// Get Post Thumb
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_post_thumbnail')) {
	function g5plus_get_post_thumbnail( $size, $noImage = 0, $is_single = false )
	{
		$args = array(
			'size' => $size,
			'noImage'   => $noImage,
			'is_single' => $is_single
		);
		g5plus_get_template('archive/thumbnail',$args);
	}
}

//////////////////////////////////////////////////////////////////
// Get Post Thumbnail
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_post_image')) {
	function g5plus_get_post_image($image_id, $size, $gallery = 0, $is_single = false)
	{
		$image_src = g5plus_get_image_src($image_id,$size);
		if (!empty($image_src)) {
			g5plus_get_image_hover($image_id, $image_src, $size, get_permalink(), the_title_attribute('echo=0'), $gallery, $is_single);
		}
	}
}

//////////////////////////////////////////////////////////////////
// Get Image Size
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_image_size')) {
	function g5plus_get_image_size() {
		return apply_filters('g5plus_image_size',array(
			'large-image' => array(
				'width' => 858,
				'height' => 370
			),
			'medium-image' => array(
				'width' => 422,
				'height' => 240
			),
			'small-image' => array(
				'width' => 370,
				'height' => 170
			)
		));
	}
}

//////////////////////////////////////////////////////////////////
// Get Image Src
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_image_src')) {
	function g5plus_get_image_src($image_id,$size) {
		$image_src = '';
		$image_sizes = g5plus_get_image_size();
		if (isset($image_sizes[$size])) {
			$width = $image_sizes[$size]['width'];
			$height = $image_sizes[$size]['height'];
			$image_src = matthewruddy_image_resize_id($image_id,$width,$height);
		}else {
			$image_src_arr = wp_get_attachment_image_src( $image_id, $size );
			if ($image_src_arr) {
				$image_src = $image_src_arr[0];
			}
		}
		return $image_src;
	}
}

//////////////////////////////////////////////////////////////////
// Get Image Hover
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_image_hover')) {
	function g5plus_get_image_hover($image_id, $image_src, $size, $link, $title, $gallery = 0, $is_single = false)
	{
		$image_full_arr = wp_get_attachment_image_src($image_id,'full');
		$image_full_src = $image_src;
		$image_thumb = wp_get_attachment_image_src($image_id);
		$image_thumb_link = '';
		if (sizeof($image_thumb) > 0) {
			$image_thumb_link = $image_thumb['0'];
		}
		if ($image_full_arr) {
			$image_full_src = $image_full_arr[0];
		}
		$width = '';
		$height = '';
		$image_sizes = g5plus_get_image_size();
		if (isset($image_sizes[$size])) {
			$width = $image_sizes[$size]['width'];
			$height = $image_sizes[$size]['height'];
		} else {
			$_wp_additional_image_sizes = get_intermediate_image_sizes();
			if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
				$width = get_option( $size . '_size_w' );
				$height = get_option( $size . '_size_h' );
			} elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
				$width = $_wp_additional_image_sizes[ $size ]['width'];
				$height = $_wp_additional_image_sizes[ $size ]['height'];
			}
		}
		$args = array(
			'image_src' => $image_src,
			'image_full_src' => $image_full_src,
			'image_thumb_link' => $image_thumb_link,
			'width' => $width,
			'height' => $height,
			'link'      => $link,
			'title'     => $title,
			'galleryId' => $gallery,
			'is_single' => $is_single
		);
		g5plus_get_template('archive/image-hover',$args);
	}
}

//////////////////////////////////////////////////////////////////
// Display Post Meta
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_the_post_meta')) {
	function g5plus_the_post_meta() {
		g5plus_get_template('archive/post-meta');
	}
}

//////////////////////////////////////////////////////////////////
// Display Social Share
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_the_social_share')) {
	function g5plus_the_social_share() {
		g5plus_get_template('social-share');
	}
}

//////////////////////////////////////////////////////////////////
// Single Post Navigation
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_post_nav')) {
	function g5plus_post_nav() {
		g5plus_get_template('single/post-nav');
	}
	add_action('g5plus_after_single_post','g5plus_post_nav',10);
}

//////////////////////////////////////////////////////////////////
// Author Info
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_post_author_info')) {
	function g5plus_post_author_info() {
		g5plus_get_template('single/author-info');
	}
	add_action('g5plus_after_single_post','g5plus_post_author_info',15);
}

//////////////////////////////////////////////////////////////////
// Post Comment
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_post_comment')) {
	function g5plus_post_comment() {
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	}
	add_action('g5plus_after_single_post','g5plus_post_comment',20);
}



//////////////////////////////////////////////////////////////////
// Related Post
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_post_related')) {
	function g5plus_post_related() {
		g5plus_get_template('single/related');
	}
	add_action('g5plus_after_single_post','g5plus_post_related',30);
}


//////////////////////////////////////////////////////////////////
// Get Limit Word
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_string_limit_words')) {
	function g5plus_string_limit_words($string, $word_limit)
	{
		$words = explode(' ', $string, ($word_limit + 1));

		if(count($words) > $word_limit) {
			array_pop($words);
		}

		return implode(' ', $words);
	}
}

//////////////////////////////////////////////////////////////////
// Render Comment
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_render_comments')) {
	function g5plus_render_comments($comment, $args, $depth) {
		g5plus_get_template('single/comment',array('comment' => $comment, 'args' => $args, 'depth' => $depth));
	}
}


