<?php
/**
 *    Plugin Name: Orson Framework
 *    Plugin URI: http://g5plus.net
 *    Description: The Orson Framework plugin.
 *    Version: 1.3
 *    Author: g5plus
 *    Author URI: http://g5plus.net
 *
 *    Text Domain: g5plus-orson
 *    Domain Path: /languages/
 *
 * @package G5Plus Framework
 * @category Core
 * @author g5plus
 *
 **/
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!class_exists('G5plus_FrameWork')){
	class G5plus_FrameWork{

		private $min_suffix = '';

		public function __construct(){
			$this->min_suffix = !(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG) ? '.min' : '';
			$this->define_constants();
			$this->includes();
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_resources' ));
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_resources' ),100 );
			add_action('wp_ajax_popup_icon', array($this, 'popup_icon'));
			add_action('admin_enqueue_scripts',array($this,'dequeue_style_woocommerce'),100);

			add_action('after_setup_theme', array($this,'do_shortcode_content'));
		}

		private function define_constants(){
			$plugin_dir_name = dirname(__FILE__);
			$plugin_dir_name = str_replace('\\', '/', $plugin_dir_name);
			$plugin_dir_name = explode('/', $plugin_dir_name);
			$plugin_dir_name = end($plugin_dir_name);

			if (!defined('PLUGIN_G5PLUS_FRAMEWORK_NAME')) {
				define('PLUGIN_G5PLUS_FRAMEWORK_NAME', $plugin_dir_name);
			}

			if (!defined('PLUGIN_G5PLUS_FRAMEWORK_DIR')) {
				define('PLUGIN_G5PLUS_FRAMEWORK_DIR', plugin_dir_path(__FILE__));
			}

			if (!defined('G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY')) {
				define('G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY', esc_html__('Orson Shortcodes', 'g5plus-orson'));
			}

			if (!defined('G5PLUS_FRAMEWORK_WIDGET_CATEGORY')) {
				define('G5PLUS_FRAMEWORK_WIDGET_CATEGORY', esc_html__('Orson Widgets', 'g5plus-orson'));
			}

			if (!defined('G5PLUS_FRAMEWORK_PREFIX')) {
				define('G5PLUS_FRAMEWORK_PREFIX', 'orson-framework-');
			}
		}

		private function includes(){
			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/functions.php');

			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/global.php');

			if (!class_exists('WPAlchemy_MetaBox')) {
				include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/MetaBox.php');
			}

			/* widgets */
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'widgets/widgets.php';

			/* short-codes */
			if (class_exists('Vc_Manager')) {
				include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'shortcodes/shortcodes.php';
			}

			/* install demo */
			include_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'install-demo/install-demo.php';
		}

		public function enqueue_admin_resources(){
			add_thickbox();
			// select2
			wp_enqueue_style('rwmb-select2',plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME. '/assets/plugins/select2/css/select2'. $this->min_suffix .'.css'),array(),'4.0.2','all');
			wp_enqueue_script('rwmb-select2',plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/assets/plugins/select2/js/select2'. $this->min_suffix .'.js'),array('jquery'),'4.0.2',true);
			// datetimepicker
			wp_enqueue_style('rwmb-datetimepicker',plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME. '/assets/plugins/datetimepicker/css/datetimepicker'. $this->min_suffix .'.css'),array(),false,'all');

			wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'admin', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/assets/css/admin'.$this->min_suffix.'.css'), array(), false, 'all');
			wp_enqueue_script(G5PLUS_FRAMEWORK_PREFIX.'media',plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/assets/js/g5plus-media-init'. $this->min_suffix .'.js'),array(),false,true);
			wp_enqueue_script(G5PLUS_FRAMEWORK_PREFIX.'popup-icon',plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/assets/js/popup-icon'. $this->min_suffix .'.js'),array(),false,true);
			wp_localize_script(G5PLUS_FRAMEWORK_PREFIX . 'popup-icon', 'g5plus_framework_meta', array(
				'ajax_url' => admin_url('admin-ajax.php?activate-multi=true')
			));
		}

		public function enqueue_frontend_resources(){
			wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'frontend', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/assets/css/frontend'. $this->min_suffix .'.css'), array(), false, 'all');
		}

		function dequeue_style_woocommerce() {

			$screen         = get_current_screen();
			$screen_id      = $screen ? $screen->id : '';
			$screen_ids   = array(
				'widgets',
				'toplevel_page__options'
			);

			if ( in_array( $screen_id, $screen_ids ) ) {
				wp_dequeue_style( 'woocommerce_admin_styles' );
				wp_dequeue_style('yith_wcan_admin');
				wp_dequeue_style('jquery-ui-style');
				wp_dequeue_style('yit-jquery-ui-style');
				wp_dequeue_style('jquery-ui-overcast');
				wp_deregister_script('select2');
			}

		}

		public function popup_icon(){

			$font_awesome = &G5Plus_Framework_Global::get_font_awesome();
			$font_theme_icon = &G5Plus_Framework_Global::get_theme_font_icon();
			ob_start();
			?>
			<div id="g5plus-framework-popup-icon-wrapper">
				<div class="popup-icon-wrapper">
					<div class="popup-content">
						<div class="popup-search-icon">
							<input placeholder="Search" type="text" id="txtSearch">
							<div class="preview">
								<span></span> <a id="iconPreview" href="javascript:"><i class="fa fa-home"></i></a>
							</div>
							<div style="clear: both;"></div>
						</div>
						<div class="list-icon">
							<h3>Font Pe-Icon-7-stroke</h3>
							<ul id="group-1">
								<?php foreach ($font_theme_icon as $icon) {
									$arrkey=array_keys($icon);
									?>
									<li><a title="<?php echo esc_attr($arrkey[0]); ?>" href="javascript:"><i class="<?php echo esc_attr($arrkey[0]); ?>"></i></a></li>
									<?php

								} ?>
							</ul>
							<br>
							<h3>Font Awesome</h3>
							<ul id="group-2">
								<?php foreach ($font_awesome as $icon) {
									$arrkey=array_keys($icon);
									?>
									<li><a title="<?php echo esc_attr($arrkey[0]); ?>" href="javascript:"><i class="<?php echo esc_attr($arrkey[0]); ?>"></i></a></li>
									<?php

								} ?>
							</ul>
						</div>
					</div>
					<div class="popup-bottom">
						<a id="btnSave" href="javascript:" class="button button-primary">Insert Icon</a>
					</div>
				</div>
			</div>
			<?php
			die();

		}

		public static function g5plus_get_template($slug, $args = array()) {
			if ( $args && is_array( $args ) ) {
				extract( $args );
			}
			$located = PLUGIN_G5PLUS_FRAMEWORK_DIR . '/' . $slug . '.php';
			if ( ! file_exists( $located ) ) {
				_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $slug ), '1.0' );
				return;
			}
			include( $located);
		}

		function do_shortcode_content(){
			// Apply filter do_shortcode
			if (apply_filters('g5plus_do_shortcode_widget_text', true)) {
				add_filter('widget_text', 'do_shortcode');
			}
			if (apply_filters('g5plus_do_shortcode_widget_content', true)) {
				add_filter('widget_content', 'do_shortcode');
			}
		}

	}
	new G5plus_FrameWork();
}
