<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

if (!defined('G5PLUS_OURTEAM_CATEGORY_TAXONOMY'))
	define('G5PLUS_OURTEAM_CATEGORY_TAXONOMY', 'ourteam-category');

if (!defined('G5PLUS_OURTEAM_POST_TYPE'))
	define('G5PLUS_OURTEAM_POST_TYPE', 'ourteam');

if (!defined('G5PLUS_OURTEAM_DIR_PATH'))
	define('G5PLUS_OURTEAM_DIR_PATH', plugin_dir_path(__FILE__));

// Include post types
global $ourteam_metabox;
$ourteam_metabox = new WPAlchemy_MetaBox(array(
	'id' => 'orson_ourteam_social_settings',
	'title' => esc_html__('Social Settings', 'g5plus-orson'),
	'template' => plugin_dir_path(__FILE__) . 'custom-field.php',
	'types' => array(G5PLUS_OURTEAM_POST_TYPE),
	'autosave' => TRUE,
	'priority' => 'high',
	'context' => 'normal',
	'hide_editor' => FALSE
));
if (!class_exists('G5plus_FrameWork_OurTeam')) {
	class G5plus_FrameWork_OurTeam
	{
		function __construct()
		{
			add_action('init', array($this, 'register_taxonomies'), 5);
			add_action('init', array($this, 'register_post_types'), 6);
			add_filter('rwmb_meta_boxes', array($this, 'register_meta_boxes'));
			add_filter( 'archive_template', array($this,'get_archive_template')) ;
			add_filter('g5plus_image_size',array($this,'register_image_size'));
			add_filter('g5plus_filter_layout_wrap_class',array($this,'get_layout_wrap_class'));
			add_filter('g5plus_filter_layout_inner_class',array($this,'get_layout_inner_class'));

			add_action('wp_ajax_nopriv_ourteam_load_more', array($this,'load_more_callback'));
			add_action('wp_ajax_ourteam_load_more',  array($this,'load_more_callback'));

			add_action('wp_ajax_nopriv_ourteam_filter_carousel', array($this,'filter_carousel_callback'));
			add_action('wp_ajax_ourteam_filter_carousel',  array($this,'filter_carousel_callback'));


			if (is_admin()) {
				add_filter('manage_edit-ourteam_columns', array($this, 'add_columns'));
				add_action('manage_' . G5PLUS_OURTEAM_POST_TYPE . '_posts_custom_column', array($this, 'set_columns_value'), 10, 2);
				add_action('admin_menu', array($this, 'addMenuChangeSlug'));
			}
		}

		function register_image_size($image_sizes){
			$sizes = array(
				'ourteam-image' => array(
					'width'  => 368,
					'height' => 271
				)
			);
			return array_merge($image_sizes,$sizes);
		}

		function get_layout_wrap_class($layout_wrap_class){
			$wrap_class = array();
			if (is_post_type_archive(G5PLUS_OURTEAM_POST_TYPE) || is_tax(G5PLUS_OURTEAM_CATEGORY_TAXONOMY)) {
				$wrap_class[] = 'archive-ourteam-wrap';
			}
			return array_merge($layout_wrap_class,$wrap_class);
		}

		function get_layout_inner_class($layout_inner_class){
			$inner_class = array();
			if (is_post_type_archive(G5PLUS_OURTEAM_POST_TYPE) || is_tax(G5PLUS_OURTEAM_CATEGORY_TAXONOMY)) {
				$inner_class[] = 'archive-ourteam-inner';
			}
			return array_merge($layout_inner_class,$inner_class);
		}

		function get_archive_template($archive_template) {
			if (is_post_type_archive(G5PLUS_OURTEAM_POST_TYPE) || is_tax(G5PLUS_OURTEAM_CATEGORY_TAXONOMY)) {
				$plugin_path =  untrailingslashit( G5PLUS_OURTEAM_DIR_PATH );
				$archive_template = $plugin_path . '/templates/archive/archive-ourteam.php';
			}
			return $archive_template;
		}

		function load_more_callback(){
			if (class_exists('WPBMap')) {
				WPBMap::addAllMappedShortcodes();
			}
			$current_page = $_REQUEST['current_page'];
			$columns = $_REQUEST['columns'];
			$category = $_REQUEST['category'];
			$post_per_page = $_REQUEST['post_per_page'];
			$layout_style = $_REQUEST['layout_style'];
			echo do_shortcode('[g5plus_our_team title="" category="' . $category . '" layout_style="' . $layout_style . '" show_tab="false" columns="' . $columns . '" page_paging="load-more" post_per_page="' . $post_per_page . '" current_page=' . $current_page . ' ajax=1]');
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
			$columns = $_REQUEST['columns'];
			$layout_style = $_REQUEST['layout_style'];
			$item_amounts = $_REQUEST['item_amounts'];
			echo do_shortcode('[g5plus_our_team title="" layout_style="'.$layout_style.'" show_tab="true" is_slider=true columns="'.$columns.'" category="'.$category.'" item_amounts='.$item_amounts.' ajax=1]');
			die();
		}

		function add_columns($columns)
		{
			unset(
				$columns['cb'],
				$columns['title'],
				$columns['date']
			);
			$cols = array_merge(array('cb' => ('')), $columns);
			$cols = array_merge($cols, array('title' => esc_html__('Name', 'g5plus-orson')));
			$cols = array_merge($cols, array('job' => esc_html__('Job', 'g5plus-orson')));
			$cols = array_merge($cols, array('thumbnail' => esc_html__('Picture', 'g5plus-orson')));
			$cols = array_merge($cols, array('date' => esc_html__('Date', 'g5plus-orson')));
			return $cols;
		}

		function register_meta_boxes($meta_boxes)
		{
			$meta_boxes[] = array(
				'title' => esc_html__('Contact Info', 'g5plus-orson'),
				'id' => 'orson_ourteam_contact_info',
				'pages' => array(G5PLUS_OURTEAM_POST_TYPE),
				'fields' => array(
					array(
						'name' => esc_html__('Job', 'g5plus-orson'),
						'id' => 'job',
						'type' => 'text',
					),
				)
			);
			return $meta_boxes;
		}

		function register_post_types()
		{
			$post_type = G5PLUS_OURTEAM_POST_TYPE;

			if (post_type_exists($post_type)) {
				return;
			}
			$post_type_slug = get_option('g5plus-orson-' . $post_type . '-config');
			if (!isset($post_type_slug) || !is_array($post_type_slug)) {
				$slug = 'ourteam';
				$name = $singular_name = 'Our Team';
			} else {
				$slug = $post_type_slug['slug'];
				$name = $post_type_slug['name'];
				$singular_name = $post_type_slug['singular_name'];
			}

			register_post_type($post_type,
				array(
					'label' => esc_html__('Our Team', 'g5plus-orson'),
					'description' => esc_html__('Our Team Information', 'g5plus-orson'),
					'labels'      => array(
						'name' => $name,
						'singular_name' => $singular_name,
						'menu_name' => $name,
						'parent_item_colon' => esc_html__('Parent Item:', 'g5plus-orson'),
						'all_items' => sprintf(esc_html__('All %s', 'g5plus-orson'), $name),
						'view_item' => esc_html__('View Item', 'g5plus-orson'),
						'add_new_item' => sprintf(esc_html__('Add New  %s', 'g5plus-orson'), $name),
						'add_new' => esc_html__('Add New', 'g5plus-orson'),
						'edit_item' => esc_html__('Edit Item', 'g5plus-orson'),
						'update_item' => esc_html__('Update Item', 'g5plus-orson'),
						'search_items' => esc_html__('Search Item', 'g5plus-orson'),
						'not_found' => esc_html__('Not found', 'g5plus-orson'),
						'not_found_in_trash' => esc_html__('Not found in Trash', 'g5plus-orson'),
					),
					'supports'    => array('title', 'excerpt', 'thumbnail'),
					'public'      => true,
					'show_ui'     => true,
					'_builtin'    => false,
					'has_archive' => true,
					'menu_icon'   => 'dashicons-groups',
					'rewrite'     => array('slug' => $slug, 'with_front' => true),
				)
			);
			flush_rewrite_rules();
		}

		function register_taxonomies()
		{
			if (taxonomy_exists(G5PLUS_OURTEAM_CATEGORY_TAXONOMY)) {
				return;
			}

			$post_type = G5PLUS_OURTEAM_POST_TYPE;
			$taxonomy_slug = G5PLUS_OURTEAM_CATEGORY_TAXONOMY;
			$taxonomy_name = 'OurTeam Category';

			$post_type_slug = get_option('g5plus-orson-' . $post_type . '-config');
			if (isset($post_type_slug) && is_array($post_type_slug) &&
				array_key_exists('taxonomy_slug', $post_type_slug) && $post_type_slug['taxonomy_slug'] != ''
			) {
				$taxonomy_slug = $post_type_slug['taxonomy_slug'];
				$taxonomy_name = $post_type_slug['taxonomy_name'];
			}
			register_taxonomy(G5PLUS_OURTEAM_CATEGORY_TAXONOMY, G5PLUS_OURTEAM_POST_TYPE,
				array('hierarchical' => true,
					'label' => $taxonomy_name,
					'query_var' => true,
					'rewrite' => array('slug' => $taxonomy_slug))
			);
			flush_rewrite_rules();
		}

		function addMenuChangeSlug()
		{
			call_user_func('add' . '_submenu_page', 'edit.php?post_type=ourteam', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
		}

		function initPageSettings()
		{
			G5plus_FrameWork::g5plus_get_template('posttype-settings/settings', array('taxonomy_key' => G5PLUS_OURTEAM_CATEGORY_TAXONOMY));
		}

		function set_columns_value($column, $post_id)
		{
			switch ($column) {
				case 'id': {
					echo wp_kses_post($post_id);
					break;
				}
				case 'job': {
					echo get_post_meta($post_id, 'job', true);
					break;
				}
				case 'thumbnail': {
					echo get_the_post_thumbnail($post_id, 'thumbnail');
					break;
				}
			}
		}
	}
	new G5plus_FrameWork_OurTeam();
}