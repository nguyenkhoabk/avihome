<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2016
 * Time: 11:00 AM
 */
if (!class_exists('G5plus_FrameWork_ShortCodes_Auto_Complete')) {
	class G5plus_FrameWork_ShortCodes_Auto_Complete{
		public function __construct() {
			add_action( 'vc_after_mapping', array($this,'define_filter') );
		}

		public function define_filter(){

			// product
			add_filter('vc_autocomplete_g5plus_products_slugs_callback',array($this,'productSlugAutocompleteSuggester'),10,1);
			add_filter('vc_autocomplete_g5plus_products_slugs_render', array(&$this,'productSlugAutocompleteRender',), 10, 1 ); // Render exact product. Must return an array (label,value)

			// product sidebar
			add_filter('vc_autocomplete_g5plus_product_sidebar_slugs_callback',array($this,'productSlugAutocompleteSuggester'),10,1);
			add_filter( 'vc_autocomplete_g5plus_product_sidebar_slugs_render', array(&$this,'productSlugAutocompleteRender',), 10, 1 ); // Render exact product. Must return an array (label,value)


			// product deals
			add_filter('vc_autocomplete_g5plus_product_deals_slugs_callback',array($this,'productSlugAutocompleteSuggester'),10,1);
			add_filter( 'vc_autocomplete_g5plus_product_deals_slugs_render', array(&$this,'productSlugAutocompleteRender',), 10, 1 ); // Render exact product. Must return an array (label,value)

			// product categories
			add_filter('vc_autocomplete_g5plus_product_categories_category_callback',array($this,'productCategorySlugAutocompleteSuggester'),10,1);
			add_filter( 'vc_autocomplete_g5plus_product_categories_category_render', array(&$this,'productCategorySlugAutocompleteRender',), 10, 1 ); // Render exact product. Must return an array (label,value)

			// product categories box
			add_filter('vc_autocomplete_g5plus_product_categories_box_category_callback',array($this,'productCategorySlugAutocompleteSuggester'),10,1);
			add_filter( 'vc_autocomplete_g5plus_product_categories_box_category_render', array(&$this,'productCategorySlugAutocompleteRender',), 10, 1 ); // Render exact product. Must return an array (label,value)
		}

		public function productSlugAutocompleteSuggester($query){
			global $wpdb;
			$post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.ID as ID, a.post_title AS title, a.post_name AS slug
			FROM {$wpdb->posts} as a
			WHERE (a.post_type = 'product')
			AND (a.post_status = 'publish')
			AND (a.post_title LIKE '%%%s%%')",stripslashes( $query )),ARRAY_A);
			$results = array();
			if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
				foreach ( $post_meta_infos as $value ) {
					$data = array();
					$data['value'] = $value['slug'];
					$data['label'] = esc_html__( 'Id', 'g5plus-orson' ) . ': ' . $value['ID'] .  ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'g5plus-orson' ) . ': ' . $value['title'] : '' );
					$results[] = $data;
				}
			}
			return $results;
		}

		public function productSlugAutocompleteRender( $query ) {
			$query = trim( $query['value'] ); // get value from requested
			if ( ! empty( $query ) ) {
				$product_id = g5plus_get_product_id_by_slug($query);
				// get product
				$product_object =  wc_get_product( $product_id );
				if ( is_object( $product_object ) ) {
					$product_title = $product_object->get_title();
					$product_title_display = '';
					if ( ! empty( $product_title ) ) {
						$product_title_display = ' - ' . esc_html__( 'Title', 'g5plus-orson' ) . ': ' . $product_title;
					}

					$product_id_display = esc_html__( 'Id', 'g5plus-orson' ) . ': ' . $product_id;

					$data = array();
					$data['value'] = $query;
					$data['label'] = $product_id_display . $product_title_display;
					return ! empty( $data ) ? $data : false;
				}

				return false;
			}

			return false;
		}

		public function productCategorySlugAutocompleteSuggester($query){

			global $wpdb;
			$cat_id = (int) $query;
			$query = trim( $query );
			$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.term_id AS id, b.name as name, b.slug AS slug
						FROM {$wpdb->term_taxonomy} AS a
						INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
						WHERE a.taxonomy = 'product_cat' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%' )", $cat_id > 0 ? $cat_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

			$result = array();
			if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
				foreach ( $post_meta_infos as $value ) {
					$data = array();
					$data['value'] =  $value['slug'];
					$data['label'] = esc_html__( 'Id', 'g5plus-orson' ) . ': ' . $value['id'] . ( ( strlen( $value['name'] ) > 0 ) ? ' - ' . esc_html__( 'Name', 'g5plus-orson' ) . ': ' . $value['name'] : '' );
					$result[] = $data;
				}
			}

			return $result;
		}

		public function productCategorySlugAutocompleteRender($query){
			$query = $query['value'];
			$query = trim( $query );

			if (!empty($query)) {
				$term = get_term_by( 'slug', $query, 'product_cat' );
				if (is_object($term)) {
					$term_slug = $term->slug;
					$term_name = $term->name;
					$term_id = $term->term_id;

					$term_slug_display = '';

					$term_title_display = '';
					if ( ! empty( $term_name ) ) {
						$term_title_display = ' - ' . esc_html__( 'Name', 'g5plus-orson' ) . ': ' . $term_name;
					}

					$term_id_display = esc_html__( 'Id', 'g5plus-orson' ) . ': ' . $term_id;

					$data = array();
					$data['value'] = $term_slug;
					$data['label'] = $term_id_display . $term_title_display . $term_slug_display;

					return ! empty( $data ) ? $data : false;
				}
				return false;
			}

			return false;


		}


	}
	new G5plus_FrameWork_ShortCodes_Auto_Complete();
}