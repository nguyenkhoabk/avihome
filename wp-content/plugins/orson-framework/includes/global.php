<?php
if (!class_exists('G5Plus_Framework_Global')) {
	class G5Plus_Framework_Global
	{
		public static function &get_font_awesome()
		{
			if (class_exists('G5Plus_Global')) {
				return G5Plus_Global::font_awesome();
			}
			$empty = array();
			return $empty;
		}

		public static function &get_theme_font_icon()
		{
			if (class_exists('G5Plus_Global')) {
				return G5Plus_Global::theme_font_icon();
			}
			$empty = array();
			return $empty;
		}

		public static function get_option($key, $default = null){
			if (class_exists('G5Plus_Global')) {
				return G5Plus_Global::get_option($key,$default);
			}
			return $default;
		}

		public static function &get_options()
		{
			if (class_exists('G5Plus_Global')) {
				return G5Plus_Global::get_options();
			}
			$empty = array();
			return $empty;
		}

		public static function set_page_layout($args) {
			if (class_exists('G5Plus_Global')) {
				G5Plus_Global::set_page_layout($args);
			}
		}

		// GET/SET layout
		public static function &get_page_layout()
		{
			if (class_exists('G5Plus_Global')) {
				return G5Plus_Global::get_page_layout();
			}
			return array();
		}

		public static function &get_woocommerce_loop() {
			if (class_exists('G5Plus_Woocommerce')) {
				return G5Plus_Woocommerce::get_woocommerce_loop();
			}
			return array(
				'layout' => '',
				'columns' => '',
				'rows' => '',
				'dots' => 'false',
				'arrows' => 'true',
				'arrows_position' => 'top',
				'arrows_style' => '',
				'size' => '',
				'category_enable' => '',
				'catalog_style' => ''
			);
		}
	}
}