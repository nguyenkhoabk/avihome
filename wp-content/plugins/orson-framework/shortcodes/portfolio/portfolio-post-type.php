<?php
if (!defined('ABSPATH')) die('-1');

if (!defined('G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY'))
	define('G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY', 'portfolio-category');

if (!defined('G5PLUS_PORTFOLIO_POST_TYPE'))
	define('G5PLUS_PORTFOLIO_POST_TYPE', 'portfolio');

if (!defined('G5PLUS_PORTFOLIO_DIR_PATH'))
	define('G5PLUS_PORTFOLIO_DIR_PATH', plugin_dir_path(__FILE__));

if (!class_exists('G5PlusFramework_Portfolio')) {
	class G5PlusFramework_Portfolio
	{
		function __construct()
		{
			$g5plus_options = G5Plus_Framework_Global::get_options();
			$enable_single_style = isset($g5plus_options['portfolio-single-style-enable']) && $g5plus_options['portfolio-single-style-enable'] == '0' ? false : true;

			add_action('init', array($this, 'register_taxonomies'), 5);
			add_action('init', array($this, 'register_post_types'), 6);

			add_filter('rwmb_meta_boxes', array($this, 'register_meta_boxes'));
			add_filter('g5plus_image_size',array($this,'register_image_size'));

			add_filter('g5plus_filter_layout_wrap_class',array($this,'get_layout_wrap_class'));
			add_filter('g5plus_filter_layout_inner_class',array($this,'get_layout_inner_class'));

			add_action('wp_ajax_nopriv_portfolio_load_more', array($this,'load_more_callback'));
			add_action('wp_ajax_portfolio_load_more',  array($this,'load_more_callback'));

			add_action('wp_ajax_nopriv_portfolio_filter_carousel', array($this,'filter_carousel_callback'));
			add_action('wp_ajax_portfolio_filter_carousel',  array($this,'filter_carousel_callback'));

			add_action('wp_ajax_nopriv_portfolio_load_gallery', array($this, 'load_gallery_callback'));
			add_action('wp_ajax_portfolio_load_gallery', array($this, 'load_gallery_callback'));


			if($enable_single_style) {
				add_filter('single_template', array($this, 'get_portfolio_single_template'));
			}
			add_filter('archive_template', array($this, 'get_portfolio_archive_template'));
			if (is_admin()) {
				add_filter('manage_edit-' . G5PLUS_PORTFOLIO_POST_TYPE . '_columns', array($this, 'add_portfolios_columns'));
				add_action('manage_' . G5PLUS_PORTFOLIO_POST_TYPE . '_posts_custom_column', array($this, 'set_portfolios_columns_value'), 10, 2);
				add_action('restrict_manage_posts', array($this, 'portfolio_manage_posts'));
				add_filter('parse_query', array($this, 'convert_taxonomy_term_in_query'));
				add_action('admin_menu', array($this, 'addMenuChangeSlug'));
			}
		}

		function register_image_size($image_sizes){
			$sizes = array(
				'portfolio-size1' => array(
					'width'  => 270,
					'height' => 185
				),
				'portfolio-size2' => array(
					'width'  => 370,
					'height' => 250
				),
				'portfolio-size3' => array(
					'width'  => 480,
					'height' => 300
				),
				'portfolio-size4' => array(
					'width'  => 480,
					'height' => 424
				),
				'portfolio-size5' => array(
					'width'  => 565,
					'height' => 380
				),
				'portfolio-size6' => array(
					'width'  => 640,
					'height' => 400
				),
				'portfolio-single-md' => array(
					'width'  => 1150,
					'height' => 570
				),
				'portfolio-single-sm' => array(
					'width'  => 565,
					'height' => 382
				)
			);
			return array_merge($image_sizes,$sizes);
		}

		function get_layout_wrap_class($layout_wrap_class){
			$wrap_class = array();

			// archive portfolio
			if (is_post_type_archive(G5PLUS_PORTFOLIO_POST_TYPE) || is_tax(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY)) {
				$wrap_class[] = 'archive-portfolio-wrap';
			}

			// single portfolio
			if (is_singular(G5PLUS_PORTFOLIO_POST_TYPE)) {
				$wrap_class[] = 'single-portfolio-wrap';
			}
			return array_merge($layout_wrap_class,$wrap_class);
		}

		function get_layout_inner_class($layout_inner_class){
			$inner_class = array();

			// archive portfolio
			if (is_post_type_archive(G5PLUS_PORTFOLIO_POST_TYPE) || is_tax(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY)) {
				$inner_class[] = 'archive-portfolio-inner';
			}

			// single portfolio
			if (is_singular(G5PLUS_PORTFOLIO_POST_TYPE)) {
				$inner_class[] = 'single-portfolio-inner';
			}
			return array_merge($layout_inner_class,$inner_class);
		}

		function load_more_callback(){
			if (class_exists('WPBMap')) {
				WPBMap::addAllMappedShortcodes();
			}
			$category = $_REQUEST['category'];
			$current_page = $_REQUEST['current_page'];
			$columns = $_REQUEST['columns'];
			$item_per_page = $_REQUEST['item_per_page'];
			$overlay_style = $_REQUEST['overlay_style'];
			$icon_color_scheme = $_REQUEST['icon_color_scheme'];
			$image_size = $_REQUEST['image_size'];
			$padding = $_REQUEST['padding'];
			echo do_shortcode('[g5plus_portfolio title="" layout_style="portfolio-grid" category="'.$category.'" show_category="" category_display="" overlay_style="'.$overlay_style.'" icon_color_scheme="'.$icon_color_scheme.'" items="-1" columns="'.$columns.'" show_pagging="load-more" column_padding="'.$padding.'" item_per_page='.$item_per_page.' image_size="'.$image_size.'" current_page="'.$current_page.'" ajax="1"]');
			die();
		}

		function filter_carousel_callback() {
			if (class_exists('WPBMap')) {
				WPBMap::addAllMappedShortcodes();
			}
			$category = str_replace('.','',$_REQUEST['category']);
			if($category =='*') {
				$category = '';
			}
			$columns           = $_REQUEST['columns'];
			$hover_effect      = $_REQUEST['hover_effect'];
			$overlay_style     = $_REQUEST['overlay_style'];
			$icon_color_scheme = $_REQUEST['icon_color_scheme'];
			$image_size        = $_REQUEST['image_size'];
			$padding           = $_REQUEST['padding'];
			$short_code        = '[g5plus_portfolio title="" layout_style="portfolio-slider" show_category="" category_display="" category="' . $category . '" overlay_style="' . $overlay_style . '" icon_color_scheme="' . $icon_color_scheme . '" items="-1" columns="' . $columns . '" hover_effect="' . $hover_effect . '" show_pagging="" column_padding="' . $padding . '" image_size="' . $image_size . '" ajax="2"]';
			echo do_shortcode( $short_code );
			die();
		}

		function load_gallery_callback()
		{
			$post_id = $_REQUEST['post_id'];
			$meta_values = get_post_meta($post_id, 'portfolio-format-gallery', false);
			$galleries = array();
			$meta_values[] = get_post_thumbnail_id($post_id);
			if (is_array($meta_values) && count($meta_values) > 0) {
				$args_attachment = array(
					'orderby'        => 'post__in',
					'post__in'       => $meta_values,
					'post_type'      => 'attachment',
					'posts_per_page' => '-1',
					'post_status'    => 'inherit');
				$attachments = new WP_Query($args_attachment);
				global $post;
				while ($attachments->have_posts()) : $attachments->the_post();
					$attach_id = get_post_thumbnail_id();
					$image_thumb = wp_get_attachment_image_src($attach_id);
					$image_thumb_link = '';
					if (sizeof($image_thumb) > 0) {
						$image_thumb_link = $image_thumb['0'];
					}
					$galleries[] = array(
						'subHtml' => $post->post_title,
						'thumb' => $image_thumb_link,
						'src'     => $post->guid,
					);
				endwhile;
				wp_reset_postdata();
				echo json_encode($galleries);
			}
			wp_die();
		}

		function register_post_types()
		{
			$post_type = G5PLUS_PORTFOLIO_POST_TYPE;
			if (post_type_exists($post_type)) {
				return;
			}
			$post_type_slug = get_option('g5plus-orson-' . $post_type . '-config');
			if (!isset($post_type_slug) || !is_array($post_type_slug)) {
				$slug = 'portfolio';
				$name = $singular_name = 'Portfolio';
			} else {
				$slug = $post_type_slug['slug'];
				$name = $post_type_slug['name'];
				$singular_name = $post_type_slug['singular_name'];
			}

			register_post_type($post_type,
				array(
					'label'       => esc_html__( 'Portfolio', 'g5plus-orson' ),
					'description' => esc_html__( 'Portfolio Description', 'g5plus-orson' ),
					'labels'      => array(
						'name'               => $name,
						'singular_name'      => $singular_name,
						'menu_name'          => $name,
						'parent_item_colon'  => esc_html__( 'Parent Portfolio:', 'g5plus-orson' ),
						'all_items'          => sprintf( esc_html__( 'All %s', 'g5plus-orson' ), $name ),
						'view_item'          => esc_html__( 'View Portfolio', 'g5plus-orson' ),
						'add_new_item'       => sprintf( esc_html__( 'Add New  %s', 'g5plus-orson' ), $name ),
						'add_new'            => esc_html__( 'Add New', 'g5plus-orson' ),
						'edit_item'          => esc_html__( 'Edit Portfolio', 'g5plus-orson' ),
						'update_item'        => esc_html__( 'Update Portfolio', 'g5plus-orson' ),
						'search_items'       => esc_html__( 'Search Portfolio', 'g5plus-orson' ),
						'not_found'          => esc_html__( 'Not found', 'g5plus-orson' ),
						'not_found_in_trash' => esc_html__( 'Not found in Trash', 'g5plus-orson' ),
					),
					'supports'    => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
					'public'      => true,
					'show_ui'     => true,
					'_builtin'    => false,
					'has_archive' => true,
					'menu_icon'   => 'dashicons-screenoptions',
					'rewrite'     => array( 'slug' => $slug, 'with_front' => true ),
				)
			);
			flush_rewrite_rules();
		}

		function register_taxonomies()
		{
			if (taxonomy_exists(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY)) {
				return;
			}

			$post_type = G5PLUS_PORTFOLIO_POST_TYPE;
			$taxonomy_slug = G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY;
			$taxonomy_name = 'Portfolio Categories';

			$post_type_slug = get_option('g5plus-orson-' . $post_type . '-config');
			if (isset($post_type_slug) && is_array($post_type_slug) &&
				array_key_exists('taxonomy_slug', $post_type_slug) && $post_type_slug['taxonomy_slug'] != ''
			) {
				$taxonomy_slug = $post_type_slug['taxonomy_slug'];
				$taxonomy_name = $post_type_slug['taxonomy_name'];
			}
			register_taxonomy(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY, G5PLUS_PORTFOLIO_POST_TYPE,
				array('hierarchical' => true,
					  'label'        => $taxonomy_name,
					  'query_var'    => true,
					  'rewrite'      => array('slug' => $taxonomy_slug))
			);
			flush_rewrite_rules();
		}
		function register_meta_boxes($meta_boxes)
		{
			$meta_boxes[] = array(
				'title' => esc_html__('Portfolio Extra', 'g5plus-orson'),
				'id' => 'orson-meta-box-portfolio-format-gallery',
				'pages' => array(G5PLUS_PORTFOLIO_POST_TYPE),
				'fields' => array(
					array(
						'name' => esc_html__('Established Date ', 'g5plus-orson'),
						'id' => 'established-date',
						'type' => 'date'
					),
					array(
						'name' => esc_html__('Link To Detail', 'g5plus-orson'),
						'id' => 'portfolio-link',
						'type' => 'text',
					),
					array(
						'name' => esc_html__('Open Single Page?', 'g5plus-orson'),
						'id' => 'portfolio-open-single-page',
						'type' => 'checkbox',
						'std' => 1,
						'required-field' => array('portfolio-link', '<>', '')
					),
					array(
						'name' => esc_html__('Client', 'g5plus-orson'),
						'id' => 'portfolio-client',
						'type' => 'text',
					),
					array(
						'name' => esc_html__('Client Site', 'g5plus-orson'),
						'id' => 'portfolio-client-site',
						'type' => 'text',
					),
					array(
						'name' => esc_html__('Gallery', 'g5plus-orson'),
						'id' => 'portfolio-format-gallery',
						'type' => 'image_advanced',
					),
					array(
						'name' => esc_html__('Video URL (oembed) or embed code', 'g5plus-orson'),
						'id' => 'portfolio-video',
						'type' => 'textarea',
						'std'  => ''
					),
					array(
						'name' => esc_html__('View Detail Style', 'g5plus-orson'),
						'id' => 'portfolio_detail_style',
						'type' => 'select',
						'std'      => 'none',
						'options' => array(
							'none'              => esc_html__( 'Inherit from theme options', 'g5plus-orson' ),
							'single-image'      => esc_html__( 'Single image', 'g5plus-orson' ),
							'horizontal-slider' => esc_html__( 'Horizontal slider', 'g5plus-orson' ),
							'video-layout'      => esc_html__( 'Video layout', 'g5plus-orson' ),
							'two-columns'       => esc_html__( 'Two columns', 'g5plus-orson' )
						),
						'multiple' => false
					),
					array(
						'name' => esc_html__('Custom Fields', 'g5plus-arvo'),
						'id' => 'portfolio-custom-field',
						'type' => 'key-value'
					)
				)
			);
			return $meta_boxes;
		}

		function get_portfolio_single_template($single)
		{
			global $post;
			/* Checks for single template by post type */
			if ($post->post_type == G5PLUS_PORTFOLIO_POST_TYPE) {
				$plugin_path =  untrailingslashit( G5PLUS_PORTFOLIO_DIR_PATH );
				$single = $plugin_path . '/templates/single/single-portfolio.php';
			}
			return $single;
		}

		function get_portfolio_archive_template($archive_template)
		{
			if (is_tax(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY) || is_post_type_archive(G5PLUS_PORTFOLIO_POST_TYPE)) {
				$g5plus_options = G5Plus_Framework_Global::get_options();
				$template_path = (isset($g5plus_options['portfolio_archive_page']) ? $g5plus_options['portfolio_archive_page'] : '');
				if (!isset($template_path) || $template_path == '') {
					$plugin_path = untrailingslashit(G5PLUS_PORTFOLIO_DIR_PATH);
					$template_path = $plugin_path . '/templates/archive/archive-portfolio.php';
					return $template_path;
				} else {
					wp_redirect($template_path);
				}
			}
			return $archive_template;
		}

		function add_portfolios_columns($columns)
		{
			unset(
				$columns['tags'],
				$columns['cb'],
				$columns['title'],
				$columns['date']
			);
			$cols = array_merge(array('cb' => ('')), $columns);
			$cols = array_merge($cols, array('title' => esc_html__('Name', 'g5plus-orson')));
			$cols = array_merge($cols, array('thumbnail' => esc_html__('Thumbnail', 'g5plus-orson')));
			$cols = array_merge($cols, array(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY => esc_html__('Categories', 'g5plus-orson')));
			$cols = array_merge($cols, array('date' => esc_html__('Date', 'g5plus-orson')));
			return $cols;
		}

		function set_portfolios_columns_value($column, $post_id)
		{

			switch ($column) {
				case 'id': {
					echo wp_kses_post($post_id);
					break;
				}
				case 'thumbnail': {
					echo get_the_post_thumbnail($post_id, 'thumbnail');
					break;
				}
				case G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY: {
					$terms = wp_get_post_terms(get_the_ID(), array(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
					$cat = '<ul>';
					foreach ($terms as $term) {
						$cat .= '<li><a href="' . get_term_link($term, G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY) . '">' . $term->name . '<a/></li>';
					}
					$cat .= '</ul>';
					echo wp_kses_post($cat);
					break;
				}
			}
		}

		function portfolio_manage_posts()
		{
			global $typenow;
			if ($typenow == G5PLUS_PORTFOLIO_POST_TYPE) {
				$selected = isset($_GET[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY]) ? $_GET[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY] : '';
				$args = array(
					'show_count' => true,
					'show_option_all' => esc_html__('Show All Categories', 'g5plus-orson'),
					'taxonomy' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY,
					'name' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY,
					'selected' => $selected,

				);
				wp_dropdown_categories($args);
			}
		}

		function convert_taxonomy_term_in_query($query)
		{
			global $pagenow;
			$qv = &$query->query_vars;
			if ($pagenow == 'edit.php' &&
				isset($qv[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY]) &&
				is_numeric($qv[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY])
			) {
				$term = get_term_by('id', $qv[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY], G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY);
				$qv[G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY] = $term->slug;
			}
		}

		function addMenuChangeSlug()
		{
			add_submenu_page('edit.php?post_type=portfolio', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
		}

		function initPageSettings()
		{
			G5plus_FrameWork::g5plus_get_template('posttype-settings/settings', array('taxonomy_key' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
		}
	}
	new G5PlusFramework_Portfolio();
}