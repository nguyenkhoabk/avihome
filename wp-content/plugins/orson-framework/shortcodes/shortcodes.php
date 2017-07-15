<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/2/2016
 * Time: 10:49 AM
 */
if (!class_exists('G5plus_FrameWork_ShortCodes')) {
	class G5plus_FrameWork_ShortCodes{
		public function __construct(){
			$this->includes();
			add_action( 'vc_after_init', array($this,'vc_custom_params'));
			spl_autoload_register(array($this,'autoload'));

			// Hook for admin editor.
			add_action( 'vc_build_admin_page', array($this,'vc_remove_woocommerce'), 11 );
			// Hook for frontend editor.
			add_action( 'vc_load_shortcode', array($this,'vc_remove_woocommerce'), 11 );
		}

		public function includes() {
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'shortcodes/functions.php';
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'shortcodes/lean-map.php';
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'shortcodes/base-shortcode.php';
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'shortcodes/auto-complete.php';
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'shortcodes/our-team/ourteam-post-type.php';
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'shortcodes/portfolio/portfolio-post-type.php';
		}
		public function autoload($class){
			$class = preg_replace('/^WPBakeryShortCode_g5plus_/', '', $class);
			$class = str_replace('_', '-', $class);
			$class = strtolower($class);
			set_include_path(PLUGIN_G5PLUS_FRAMEWORK_DIR .'shortcodes/' . $class . '/');
			spl_autoload_extensions('.php');
			spl_autoload($class);
		}

		public function vc_custom_params(){
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . "vc-params/select2/select2.php";
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . "vc-params/number/number.php";
			require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . "vc-params/datetimepicker/datetimepicker.php";
		}

		public function vc_remove_woocommerce(){
			if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				$elements = apply_filters('g5plus_vc_remove_woocommerce',array(
					'woocommerce_cart',
					'woocommerce_checkout',
					'woocommerce_order_tracking',
					'woocommerce_my_account',
					'recent_products',
					'featured_products',
					'product',
					'products',
					'add_to_cart',
					'add_to_cart_url',
					'product_page',
					'product_category',
					'product_categories',
					'sale_products',
					'best_selling_products',
					'top_rated_products',
					'product_attribute',
					'related_products',
				));
				foreach ($elements as $element) {
					vc_remove_element($element);
				}
			}
		}
	}
	new G5plus_FrameWork_ShortCodes();
}