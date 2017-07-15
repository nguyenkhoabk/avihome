<?php
/**
 * The template for displaying page title
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */

/**
 * @var $type
*/
$page_title_layouts = &G5Plus_Global::get_page_title_layout();
if (is_home()) {
	if (empty($page_title_layouts['title'])) {
		$page_title_layouts['title'] = esc_html__("Blog", 'g5plus-orson');
	}
} elseif (!is_singular() && !is_front_page()) {
	$page_sub_title = strip_tags(term_description());
	if (!empty($page_sub_title)) {
		$page_title_layouts['sub_title'] = $page_sub_title;
	}
	if (!have_posts()) {
		$page_title_layouts['title'] = esc_html__('Nothing Found','g5plus-orson');
	} elseif (is_tag() || is_tax( 'product_tag')) {
		$page_title_layouts['title'] = single_tag_title(esc_html__("Tags: ", 'g5plus-orson'), false);
	} elseif (is_category() || is_tax()) {
		$page_title_layouts['title'] = single_cat_title('', false);
	}  elseif (is_author()) {
		$page_title_layouts['title'] = sprintf(esc_html__('Author: %s', 'g5plus-orson'), get_the_author());
	} elseif (is_day()) {
		$page_title_layouts['title'] = sprintf(esc_html__('Daily Archives: %s', 'g5plus-orson'), get_the_date());
	} elseif (is_month()) {
		$page_title_layouts['title'] = sprintf(esc_html__('Monthly Archives: %s', 'g5plus-orson'), get_the_date(_x('F Y', 'monthly archives date format', 'g5plus-orson')));
	} elseif (is_year()) {
		$page_title_layouts['title'] = sprintf(esc_html__('Yearly Archives: %s', 'g5plus-orson'), get_the_date(_x('Y', 'yearly archives date format', 'g5plus-orson')));
	} elseif (is_search()) {
		$page_title_layouts['title'] = sprintf( esc_html__( 'Search Results: &ldquo;%s&rdquo;', 'g5plus-orson' ), get_search_query() );
	} elseif (is_tax('post_format', 'post-format-aside')) {
		$page_title_layouts['title'] = esc_html__('Asides', 'g5plus-orson');
	} elseif (is_tax('post_format', 'post-format-gallery')) {
		$page_title_layouts['title'] = esc_html__('Galleries', 'g5plus-orson');
	} elseif (is_tax('post_format', 'post-format-image')) {
		$page_title_layouts['title'] = esc_html__('Images', 'g5plus-orson');
	} elseif (is_tax('post_format', 'post-format-video')) {
		$page_title_layouts['title'] = esc_html__('Videos', 'g5plus-orson');
	} elseif (is_tax('post_format', 'post-format-quote')) {
		$page_title_layouts['title'] = esc_html__('Quotes', 'g5plus-orson');
	} elseif (is_tax('post_format', 'post-format-link')) {
		$page_title_layouts['title'] = esc_html__('Links', 'g5plus-orson');
	} elseif (is_tax('post_format', 'post-format-status')) {
		$page_title_layouts['title'] = esc_html__('Statuses', 'g5plus-orson');
	} elseif (is_tax('post_format', 'post-format-audio')) {
		$page_title_layouts['title'] = esc_html__('Audios', 'g5plus-orson');
	} elseif (is_tax('post_format', 'post-format-chat')) {
		$page_title_layouts['title'] = esc_html__('Chats', 'g5plus-orson');
	} elseif (is_post_type_archive('product')) {
		if (empty($page_title_layouts['title'])) {
			$page_title_layouts['title'] = woocommerce_page_title(false);
		}
	} elseif (is_post_type_archive('ourteam')) {
		if (empty($page_title_layouts['title'])) {
			$page_title_layouts['title'] = esc_html__('Our Team', 'g5plus-orson');
		}
	} elseif (is_post_type_archive('portfolio')) {
		if (empty($page_title_layouts['title'])) {
			$page_title_layouts['title'] = esc_html__('Portfolio', 'g5plus-orson');
		}
	} else {
		$page_title_layouts['title'] = esc_html__('Archives', 'g5plus-orson');
	}

	$cat = get_queried_object();
	// custom page title background
	if ($cat && property_exists( $cat, 'term_id' )) {
		$page_title_enable = g5plus_get_tax_meta($cat->term_id,'page_title_enable');
		if ($page_title_enable != '' && $page_title_enable != -1) {
			$page_title_layouts['page_title_enable'] = $page_title_enable;
		}
		$page_title_bg_image = g5plus_get_tax_meta($cat->term_id,'page_title_bg_image');
		if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {
			$page_title_layouts['background-image']['url'] = $page_title_bg_image['url'];
		}
	}
}

if(!$page_title_layouts['page_title_enable']) return;
$page_title_class = array('page-title');
$page_title_class[] = 'page-title-layout-' . $page_title_layouts['layout'];


// region Custom Styles
$custom_style= '';
if ($page_title_layouts['layout'] != 'only-breadcrumb') {
	$custom_styles = array();
	if (isset($page_title_layouts['padding']['padding-top']) && !empty($page_title_layouts['padding']['padding-top']) && ($page_title_layouts['padding']['padding-top'] != 'px') ) {
		$custom_styles[] = "padding-top:" . $page_title_layouts['padding']['padding-top'];
	}

	if (isset($page_title_layouts['padding']['padding-bottom']) && !empty($page_title_layouts['padding']['padding-bottom'])  && ($page_title_layouts['padding']['padding-bottom'] != 'px')) {
		$custom_styles[] = "padding-bottom:" . $page_title_layouts['padding']['padding-bottom'];
	}

	if (isset($page_title_layouts['background-image']['url']) && !empty($page_title_layouts['background-image']['url'])) {
		$custom_styles[] = 'background-image: url(' . $page_title_layouts['background-image']['url'] . ')';
		$page_title_class[] = 'page-title-background';

		if ($page_title_layouts['parallax']) {
			$page_title_class[] = 'parallax';
		}
	}

	if ($custom_styles) {
		$custom_style = 'style="'. join(';',$custom_styles).'"';
	}

	if (isset($page_title_layouts['background-image']['url']) && !empty($page_title_layouts['background-image']['url']) && $page_title_layouts['parallax']) {
		$custom_style.= ' data-stellar-background-ratio="0.5"';
	}
}



// endregion
?>
<section class="<?php echo join(' ', $page_title_class); ?>" <?php echo wp_kses_post($custom_style); ?>>
	<div class="container">
		<?php if ($page_title_layouts['layout'] != 'only-breadcrumb'): ?>
			<div class="page-title-inner">
				<h1><?php echo esc_html($page_title_layouts['title']) ?></h1>
				<?php if (!empty($page_title_layouts['sub_title'])): ?>
					<p><?php echo esc_html($page_title_layouts['sub_title']) ?></p>
				<?php endif; ?>
				<?php if($page_title_layouts['breadcrumbs_enable']) {
					g5plus_the_breadcrumb();
				} ?>
			</div>
		<?php else: ?>
			<div class="page-title-inner">
				<?php g5plus_the_breadcrumb(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
