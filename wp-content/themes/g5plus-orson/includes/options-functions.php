<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/18/2016
 * Time: 11:36 AM
 */
//////////////////////////////////////////////////////////////////
// Get Page Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_page_layout')) {
	function g5plus_get_page_layout($default = false) {
		$result = apply_filters('g5plus_page_layout',array(
			'full' => esc_html__('Full Width','g5plus-orson'),
			'container' => esc_html__('Container','g5plus-orson')
		));

		if($default) {
			$result = array(-1 => esc_html__('Default','g5plus-orson')) + $result;
		}
		return $result;
	}
}

//////////////////////////////////////////////////////////////////
// Get Sidebar Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_sidebar_layout')) {
	function g5plus_get_sidebar_layout() {
		return apply_filters('g5plus_sidebar_layout',array(
			'none' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-none.png'),
			'left' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-left.png'),
			'right' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-right.png'),
		));
	}
}

//////////////////////////////////////////////////////////////////
// Get Sidebar Width
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_sidebar_width')) {
	function g5plus_get_sidebar_width($default = false) {
		$result = apply_filters('g5plus_sidebar_width',array(
			'small' => esc_html__('Small (1/4)','g5plus-orson'),
			'large' => esc_html__('Large (1/3)','g5plus-orson')
		));

		if($default) {
			$result = array(-1 => esc_html__('Default','g5plus-orson')) + $result;
		}
		return $result;


	}
}

//////////////////////////////////////////////////////////////////
// Get Page Title Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_page_title_layout')) {
	function g5plus_get_page_title_layout($default = false) {
		$result = apply_filters('g5plus_page_title_layout',array(
			'normal' => esc_html__('Tile Left & Breadcrumb Right','g5plus-orson'),
			'center' => esc_html__('Center','g5plus-orson'),
			'only-breadcrumb' => esc_html__('Only Breadcrumb','g5plus-orson'),
		));
		if ($default) {
			$result = array( -1 => esc_html__('Default','g5plus-orson')) + $result;
		}
		return $result;
	}
}

//////////////////////////////////////////////////////////////////
// Get Layout Styles
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_layout_style')) {
	function g5plus_get_layout_style() {
		return apply_filters('g5plus_layout_style',array(
			'boxed' => array('title' => 'Boxed', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/layout-boxed.png'),
			'wide' => array('title' => 'Wide', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/layout-wide.png'),
		));
	}
}

//////////////////////////////////////////////////////////////////
// Get Post Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_post_layout')) {
	function g5plus_get_post_layout() {
		return apply_filters('g5plus_post_layout',array(
			'large-image' => esc_html__('Large Image','g5plus-orson'),
			'medium-image' => esc_html__('Medium Image','g5plus-orson'),
			'masonry' => esc_html__('Masonry','g5plus-orson'),
		));
	}
}

//////////////////////////////////////////////////////////////////
// Get Post Columns
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_post_columns')) {
	function g5plus_get_post_columns() {
		return apply_filters('g5plus_post_columns',array(
			2 => '2',
			3 => '3'
		));
	}
}

//////////////////////////////////////////////////////////////////
// Get Post Paging
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_paging_style')) {
	function g5plus_get_paging_style() {
		return apply_filters('g5plus_paging_style',array(
			'navigation' => esc_html__('Navigation','g5plus-orson'),
			'load-more' => esc_html__('Load More','g5plus-orson'),
			'infinite-scroll' => esc_html__('Infinite Scroll','g5plus-orson')
		));
	}
}

//////////////////////////////////////////////////////////////////
// Get Toggle
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_toggle')) {
	function g5plus_get_toggle($default = false) {
		$result = array(
			1 => esc_html__('On','g5plus-orson'),
			0 => esc_html__('Off','g5plus-orson')

		);
		if ($default) {
			$result = array(-1 => esc_html__('Default','g5plus-orson')) + $result;
		}
		return $result;
	}
}

//////////////////////////////////////////////////////////////////
// Get Product Image Hover Effect
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_product_image_hover_effect')) {
	function g5plus_get_product_image_hover_effect() {
		return apply_filters('g5plus_product_image_hover_effect',array(
			'none' => esc_html__('None','g5plus-orson'),
			'change-image' => esc_html__('Change Image','g5plus-orson'),
			'flip-back' => esc_html__('Flip Back','g5plus-orson')
		));
	}
}

//////////////////////////////////////////////////////////////////
// Get Product Catalog Style
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_product_catalog_style')) {
	function g5plus_get_product_catalog_style() {
		return apply_filters('g5plus_product_catalog_style',array(
			'left' => esc_html__('Left','g5plus-orson'),
			'center' => esc_html__('Center','g5plus-orson'),
		));
	}
}

//==============================================================================
//
//==============================================================================
if (!function_exists('g5plus_get_toggle_color')) {
	function g5plus_get_toggle_color($inherit = false) {
		$result = array(
			0 => esc_html__('Default','g5plus-orson'),
			1 => esc_html__('Customize','g5plus-orson')
		);
		if ($inherit) {
			$result = array(-1 => esc_html__('Inherit','g5plus-orson')) + $result;
		}
		return $result;
	}
}

//==============================================================================
// Get list social profiles
//==============================================================================
if (!function_exists('g5plus_get_social_profiles')) {
	function g5plus_get_social_profiles()
	{
		return apply_filters('g5plus_get_social_profiles', array(
			array(
				'id' => 'twitter_url',
				'type' => 'text',
				'title' => esc_html__('Twitter', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Twitter', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-twitter',
				'link-type' => 'link',
			),
			array(
				'id' => 'facebook_url',
				'type' => 'text',
				'title' => esc_html__('Facebook', 'g5plus-orson'),
				'subtitle' => esc_html__('Your facebook page/profile url', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-facebook',
				'link-type' => 'link',
			),
			array(
				'id' => 'dribbble_url',
				'type' => 'text',
				'title' => esc_html__('Dribbble', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Dribbble', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-dribbble',
				'link-type' => 'link',
			),
			array(
				'id' => 'vimeo_url',
				'type' => 'text',
				'title' => esc_html__('Vimeo', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Vimeo', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-vimeo',
				'link-type' => 'link',
			),
			array(
				'id' => 'tumblr_url',
				'type' => 'text',
				'title' => esc_html__('Tumblr', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Tumblr', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-tumblr',
				'link-type' => 'link',
			),
			array(
				'id' => 'skype_username',
				'type' => 'text',
				'title' => esc_html__('Skype', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Skype username', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-skype',
				'link-type' => 'link',
			),
			array(
				'id' => 'linkedin_url',
				'type' => 'text',
				'title' => esc_html__('LinkedIn', 'g5plus-orson'),
				'subtitle' => esc_html__('Your LinkedIn page/profile url', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-linkedin',
				'link-type' => 'link',
			),
			array(
				'id' => 'googleplus_url',
				'type' => 'text',
				'title' => esc_html__('Google+', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Google+ page/profile URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-google-plus',
				'link-type' => 'link',
			),
			array(
				'id' => 'flickr_url',
				'type' => 'text',
				'title' => esc_html__('Flickr', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Flickr page url', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-flickr',
				'link-type' => 'link',
			),
			array(
				'id' => 'youtube_url',
				'type' => 'text',
				'title' => esc_html__('YouTube', 'g5plus-orson'),
				'subtitle' => esc_html__('Your YouTube URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-youtube',
				'link-type' => 'link',
			),
			array(
				'id' => 'pinterest_url',
				'type' => 'text',
				'title' => esc_html__('Pinterest', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Pinterest', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-pinterest',
				'link-type' => 'link',
			),
			array(
				'id' => 'foursquare_url',
				'type' => 'text',
				'title' => esc_html__('Foursquare', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Foursqaure URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-foursquare',
				'link-type' => 'link',
			),
			array(
				'id' => 'instagram_url',
				'type' => 'text',
				'title' => esc_html__('Instagram', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Instagram', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-instagram',
				'link-type' => 'link',
			),
			array(
				'id' => 'github_url',
				'type' => 'text',
				'title' => esc_html__('GitHub', 'g5plus-orson'),
				'subtitle' => esc_html__('Your GitHub URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-github',
				'link-type' => 'link',
			),
			array(
				'id' => 'xing_url',
				'type' => 'text',
				'title' => esc_html__('Xing', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Xing URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-xing',
				'link-type' => 'link',
			),
			array(
				'id' => 'behance_url',
				'type' => 'text',
				'title' => esc_html__('Behance', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Behance URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-behance',
				'link-type' => 'link',
			),
			array(
				'id' => 'deviantart_url',
				'type' => 'text',
				'title' => esc_html__('Deviantart', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Deviantart URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-deviantart',
				'link-type' => 'link',
			),
			array(
				'id' => 'soundcloud_url',
				'type' => 'text',
				'title' => esc_html__('SoundCloud', 'g5plus-orson'),
				'subtitle' => esc_html__('Your SoundCloud URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-soundcloud',
				'link-type' => 'link',
			),
			array(
				'id' => 'yelp_url',
				'type' => 'text',
				'title' => esc_html__('Yelp', 'g5plus-orson'),
				'subtitle' => esc_html__('Your Yelp URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-yelp',
				'link-type' => 'link',
			),
			array(
				'id' => 'rss_url',
				'type' => 'text',
				'title' => esc_html__('RSS Feed', 'g5plus-orson'),
				'subtitle' => esc_html__('Your RSS Feed URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-rss',
				'link-type' => 'link',
			),
			array(
				'id' => 'vk_url',
				'type' => 'text',
				'title' => esc_html__('VK', 'g5plus-orson'),
				'subtitle' => esc_html__('Your VK URL', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-vk',
				'link-type' => 'link',
			),
			array(
				'id' => 'email_address',
				'type' => 'text',
				'title' => esc_html__('Email address', 'g5plus-orson'),
				'subtitle' => esc_html__('Your email address', 'g5plus-orson'),
				'default' => '',
				'icon' => 'fa fa-envelope',
				'link-type' => 'email',
			),
		));
	}
}

//////////////////////////////////////////////////////////////////
// Get Widget Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_widget_layout')) {
	function g5plus_get_widget_layout($default = false) {
		$result = apply_filters('g5plus_widget_layout',array(
			'widget-classic' => esc_html__('Classic','g5plus-orson'),
			'widget-classic-no-border' => esc_html__('Classic Without Border','g5plus-orson'),
			'widget-border-round' => esc_html__('Border Round','g5plus-orson'),
			'widget-border-round-background' => esc_html__('Border Round Background','g5plus-orson'),
			'widget-border' => esc_html__('Border','g5plus-orson'),
			'widget-border-background' => esc_html__('Border Background','g5plus-orson'),
		))  ;
		if ($default) {
			$result = array('' => esc_html__('Default','g5plus-orson')) + $result;
		}
		return $result;
	}
}

//////////////////////////////////////////////////////////////////
// Get Archive Product Banner Layout
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_archive_product_banner_layout')) {
	function g5plus_get_archive_product_banner_layout($default = false) {
		$result = apply_filters('g5plus_archive_product_banner_layout',array(
			'full' => esc_html__('Full Width','g5plus-orson'),
			'container' => esc_html__('Container','g5plus-orson')
		));

		if($default) {
			$result = array(-1 => esc_html__('Default','g5plus-orson')) + $result;
		}
		return $result;
	}
}

//////////////////////////////////////////////////////////////////
// Get Archive Product Banner Type
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_archive_product_banner_type')) {
	function g5plus_get_archive_product_banner_type($default = false) {
		$result = apply_filters('g5plus_archive_product_banner_type',array(
			'' => esc_html__('No Banner','g5plus-orson'),
			'image' => esc_html__('Image','g5plus-orson'),
			'video' => esc_html__('Video','g5plus-orson'),
			'rev_slider' => esc_html__('Revolution Slider','g5plus-orson')
		));
		if($default) {
			$result = array(-1 => esc_html__('Default','g5plus-orson')) + $result;
		}
		return $result;
	}
}

//////////////////////////////////////////////////////////////////
// Get Revolution Slider
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_rev_slider')) {
	function g5plus_get_rev_slider() {
		$rev_sliders = array(
			'-1' => esc_html__('Select Slider','g5plus-orson')
		);
		if ( class_exists ( "RevSlider" ) ) {
			$revSlider = new RevSlider();
			$sliders = $revSlider->getArrSliders ();
			if ( $sliders ) {
				foreach ( $sliders as $slider ) {
					$rev_sliders[ $slider->getAlias() ] = $slider->getTitle();
				}
			}
		}
		return $rev_sliders;
	}
}

//////////////////////////////////////////////////////////////////
// Get Search Type
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_search_type')) {
	function g5plus_get_search_type() {
		return apply_filters('g5plus_search_type',array(
			'button' => esc_html__('Button','g5plus-orson'),
			'box' => esc_html__('Box','g5plus-orson'),
			'box-small' => esc_html__('Box Small','g5plus-orson'),
			'product-category' => esc_html__('Product Category','g5plus-orson'),
		));
	}
}