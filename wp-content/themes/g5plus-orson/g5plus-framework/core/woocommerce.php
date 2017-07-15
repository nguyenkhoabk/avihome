<?php
/**
 * Orson woocommerce class
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
if ( class_exists( 'WooCommerce' ) && !class_exists('G5Plus_Woocommerce') ){
	class G5Plus_Woocommerce{

		function __construct() {
			$this->define_filter();
			$this->remove_hook();
			$this->define_hook();
		}

		function define_filter() {

			// remove shop page title
			add_filter('woocommerce_show_page_title','__return_false');

			// shop per page
			add_filter('loop_shop_per_page', array($this,'loop_shop_per_page'));

			// filter pagination
			add_filter('woocommerce_pagination_args',array($this,'g5plus_woocommerce_pagination_args'));

			add_filter('woocommerce_product_description_heading','__return_false');

			add_filter('woocommerce_product_additional_information_heading','__return_false');

			add_filter('woocommerce_review_gravatar_size', array($this,'g5plus_woocommerce_review_gravatar_size'));

			// related columns and total
			add_filter('woocommerce_output_related_products_args',array($this,'g5plus_woocommerce_output_related_products_args'));

			// up-sell columns and total
			add_filter('woocommerce_upsell_display_args',array($this,'g5plus_woocommerce_upsell_display_args'));

		}

		function remove_hook() {

			// remove woocommerce sidebar
			remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);

			// remove Breadcrumb
			remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);

			// remove archive description
			remove_action('woocommerce_archive_description','woocommerce_taxonomy_archive_description',10);
			remove_action('woocommerce_archive_description','woocommerce_product_archive_description',10);

			// remove result count and catalog ordering
			remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
			remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

			// remove pagination
			remove_action('woocommerce_after_shop_loop','woocommerce_pagination',10);

			// remove product link close
			remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
			remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);

			// remove add to cart
			remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);

			// remove product thumb
			remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);

			// remove product title
			remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);

			// remove compare button
			global $yith_woocompare;
			if ( isset($yith_woocompare) && isset($yith_woocompare->obj)) {
				remove_action( 'woocommerce_after_shop_loop_item', array($yith_woocompare->obj,'add_compare_link'), 20 );
				remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
			}


		}


		function define_hook() {
			// add catalog filter
			add_action('woocommerce_before_shop_loop',array($this,'catalog_filter'),10);
			add_action('g5plus_woocommerce_catalog_filter',array($this,'catalog_page_size') ,10);
			add_action('g5plus_woocommerce_catalog_filter','woocommerce_pagination',20);


			add_action('woocommerce_after_shop_loop',array($this,'catalog_filter'),10);

			// product price, rating, add to cart button
			add_action('woocommerce_after_shop_loop_item_title',array($this,'product_price_rating_open'),4);
			add_action('woocommerce_after_shop_loop_item_title',array($this,'product_price_rating_close'),11);
			add_action('woocommerce_after_shop_loop_item_title',array($this,'g5plus_woocommerce_template_loop_add_to_cart'),15);

			// product actions
			add_action('g5plus_woocommerce_product_actions',array($this,'g5plus_woocomerce_template_loop_compare'),5);
			add_action('g5plus_woocommerce_product_actions',array($this,'g5plus_woocomerce_template_loop_wishlist'),10);
			add_action('g5plus_woocommerce_product_actions',array($this,'g5plus_woocomerce_template_loop_quick_view'),15);


			// product sale count down
			add_action('woocommerce_before_shop_loop_item_title',array($this,'g5plus_woocommerce_template_loop_sale_count_down'),10);
			add_action('g5plus_after_single_product_image_main',array($this,'g5plus_woocommerce_template_loop_sale_count_down'),10);

			// product images thumb
			add_action('woocommerce_before_shop_loop_item_title',array($this,'g5plus_woocommerce_template_loop_product_thumbnail'),20);




			// product link
			add_action('woocommerce_before_shop_loop_item_title',array($this,'g5plus_woocomerce_template_loop_link'),30);

			// product title
			add_action('woocommerce_shop_loop_item_title',array($this,'g5plus_woocommerce_template_loop_product_title'),10);

			// single product wishlist and compare
			add_action('woocommerce_single_product_summary',array($this,'g5plus_woocommerce_template_single_function'),35);

			// single product share
			add_action('woocommerce_share','g5plus_the_social_share',10);

			// quick-views ajax
			add_action( 'wp_ajax_nopriv_product_quick_view', array($this,'popup_product_quick_view'));
			add_action( 'wp_ajax_product_quick_view', array($this,'popup_product_quick_view') );
			add_action( 'wp_footer', array( $this, 'quick_view' ) );

			// quick view
			add_action('woocommerce_before_quick_view_product_summary','woocommerce_show_product_sale_flash',10);
			add_action('woocommerce_before_quick_view_product_summary',array($this,'g5plus_show_product_quick_view_images'),20);

			add_action('woocommerce_quick_view_product_summary',array($this,'g5plus_template_quick_view_product_title'),5);
			add_action('woocommerce_quick_view_product_summary',array($this,'g5plus_template_quick_view_rating'),10);
			add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_price',10);
			add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_excerpt',20);
			add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_add_to_cart',30);
			add_action('woocommerce_quick_view_product_summary',array($this,'g5plus_woocommerce_template_single_function'),35);
			add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_meta',40);
			add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_sharing',50);

			// banner
			add_action('g5plus_before_archive',array($this,'g5plus_archive_product_banner_full'),10);
			add_action('woocommerce_before_shop_loop',array($this,'g5plus_archive_product_banner_container'),5);

			add_action('woocommerce_before_shop_loop',array($this,'g5plus_archive_product_settings'),50);

			// product deals
			add_action('woocommerce_before_shop_loop_deals_item_title',array($this,'g5plus_woocommerce_template_loop_product_thumbnail'),10);
			add_action('woocommerce_after_shop_loop_deals_item_title','woocommerce_template_loop_rating',5);
			add_action('woocommerce_after_shop_loop_deals_item_title','woocommerce_template_loop_price',10);
			add_action('woocommerce_after_shop_loop_deals_item_title',array($this,'g5plus_woocommerce_template_loop_add_to_cart'),15);
			add_action('woocommerce_after_shop_loop_deals_item_title',array($this,'g5plus_woocommerce_template_loop_sale_count_down'),20);
		}

		function g5plus_woocommerce_template_loop_add_to_cart(){
			$product_add_to_cart_enable = G5Plus_Global::get_option('product_add_to_cart_enable');
			if ($product_add_to_cart_enable) {
				echo '<div class="text-center">';
					woocommerce_template_loop_add_to_cart();
				echo '</div>';
			}
		}

		function g5plus_archive_product_settings() {
			$g5plus_woocommerce_loop = &G5Plus_Woocommerce::get_woocommerce_loop();

			// setting columns
			$g5plus_woocommerce_loop['columns'] = G5Plus_Global::get_option('product_display_columns','3');
			$product_display_columns = isset($_GET['columns']) ? $_GET['columns'] : '';
			if (in_array($product_display_columns, array('2','3','4','5'))) {
				$g5plus_woocommerce_loop['columns'] = $product_display_columns;
			}

			// setting column gap
			$g5plus_woocommerce_loop['column_gap'] = G5Plus_Global::get_option('product_display_column_gap','');
		}

		function g5plus_archive_product_banner_full(){
			if (is_post_type_archive('product') || is_tax('product_cat')) {
				$banner_layout = G5Plus_Global::get_option('archive_product_banner_layout');
				$cat = get_queried_object();
				if ($cat && property_exists( $cat, 'term_id' )) {
					$banner_layout_custom = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_layout');
					if (isset($banner_layout_custom) &&  ($banner_layout_custom != '') && ($banner_layout_custom != -1)) {
						$banner_layout = $banner_layout_custom;
					}
				}

				if ($banner_layout == 'full') {
					wc_get_template('banner.php');
				}
			}
		}

		function g5plus_archive_product_banner_container(){
			if (is_post_type_archive('product') || is_tax('product_cat')) {
				$banner_layout = G5Plus_Global::get_option('archive_product_banner_layout');
				$cat = get_queried_object();
				if ($cat && property_exists( $cat, 'term_id' )) {
					$banner_layout_custom = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_layout');
					if (isset($banner_layout_custom) &&  ($banner_layout_custom != '') && ($banner_layout_custom != -1)) {
						$banner_layout = $banner_layout_custom;
					}
				}

				if ($banner_layout == 'container') {
					wc_get_template('banner.php');
				}
			}
		}


		function quick_view(){
			$product_quick_view = G5Plus_Global::get_option('product_quick_view_enable');
			if ($product_quick_view) {
				wp_enqueue_script( 'wc-add-to-cart-variation' );
			}
		}

		function popup_product_quick_view(){
			$product_id = $_REQUEST['id'];
			global $post, $product;
			$post = get_post($product_id);
			setup_postdata($post);
			$product = wc_get_product( $product_id );
			wc_get_template_part('content-product-quick-view');
			wp_reset_postdata();
			die();

		}

		function g5plus_template_quick_view_product_title(){
			wc_get_template('quick-view/title.php');
		}

		function g5plus_template_quick_view_rating(){
			wc_get_template('quick-view/rating.php');
		}

		function g5plus_show_product_quick_view_images(){
			wc_get_template('quick-view/product-image.php');
		}


		function g5plus_woocommerce_output_related_products_args($args){
			$default = array(
				'posts_per_page' 	=> G5Plus_Global::get_option('related_product_count',6),
				'columns' 			=> G5Plus_Global::get_option('related_product_display_columns',4)
			);
			$args = array_merge($args,$default);
			return $args;
		}

		function g5plus_woocommerce_upsell_display_args($args){
			$default = array(
				'columns' 			=> G5Plus_Global::get_option('up_sells_product_display_columns',4)
			);
			$args = array_merge($args,$default);
			return $args;
		}



		function g5plus_woocommerce_review_gravatar_size(){
			return 62;
		}

		function g5plus_woocommerce_template_single_function(){
			wc_get_template( 'single-product/product-function.php' );
		}

		function g5plus_woocommerce_pagination_args($woocommerce_pagination_args) {
			$args = array(
				'type' => '',
				'next_text' => '<i class="fa fa-chevron-right"></i>',
				'prev_text' => '<i class="fa fa-chevron-left"></i>'
			);
			$woocommerce_pagination_args = array_merge($woocommerce_pagination_args,$args);
			return $woocommerce_pagination_args;
		}

		function g5plus_woocommerce_template_loop_product_thumbnail() {
			wc_get_template('loop/product-thumb.php');
		}

		function g5plus_woocommerce_template_loop_product_title() {
			wc_get_template( 'loop/title.php' );
		}

		function g5plus_woocomerce_template_loop_link() {
			wc_get_template( 'loop/link.php' );
		}

		function g5plus_woocomerce_template_loop_quick_view() {
			wc_get_template( 'loop/quick-view.php' );
		}

		function g5plus_woocomerce_template_loop_compare() {
			if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && get_option('yith_woocompare_compare_button_in_products_list') == 'yes') {
				echo do_shortcode('[yith_compare_button container="false" type="link"]');
			}
		}

		function g5plus_woocomerce_template_loop_wishlist() {
			if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && (get_option( 'yith_wcwl_enabled' ) == 'yes')) {
				echo do_shortcode('[yith_wcwl_add_to_wishlist]');
			}
		}

		function product_price_rating_open() {
			echo '<div class="product-price-rating">';
		}
		function product_price_rating_close() {
			echo '</div>';
		}

		// Catalog Page Size
		function catalog_page_size() {
			wc_get_template( 'loop/page-size.php' );
		}

		function catalog_filter() {
			wc_get_template( 'loop/catalog-filter.php' );
		}


		function loop_shop_per_page() {
			$product_per_page = G5Plus_Global::get_option('product_per_page','12,24,36');
			$product_per_page_arr = explode ( ",", $product_per_page );
			$page_size = isset( $_GET['page_size'] ) ? wc_clean( $_GET['page_size'] ) : $product_per_page_arr[0];
			return $page_size;
		}

		function g5plus_woocommerce_template_loop_sale_count_down(){
			wc_get_template('loop/sale-count-down.php');
		}

		// GET Woocommerce loop
		public static function &get_woocommerce_loop() {
			if (isset($GLOBALS['g5plus_woocommerce_loop']) && is_array($GLOBALS['g5plus_woocommerce_loop'])) {
				return $GLOBALS['g5plus_woocommerce_loop'];
			}
			$GLOBALS['g5plus_woocommerce_loop'] = array(
				'layout' => '',
				'columns' => '',
				'columns_md' => '',
				'columns_sm' => '',
				'columns_xs' => '',
				'columns_mb' => '',
				'column_gap' => '',
				'rows' => '',
				'dots' => 'false',
				'arrows' => 'true',
				'arrows_position' => 'top',
				'arrows_style' => '',
				'size' => '',
				'category_enable' => '',
				'catalog_style' => '',
				'sale_count_down_enable' => ''
			);
			return $GLOBALS['g5plus_woocommerce_loop'];
		}

		public static function reset_loop() {
			unset($GLOBALS['g5plus_woocommerce_loop']);
		}
	}
	new G5Plus_Woocommerce();
}


