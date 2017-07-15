<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/1/2016
 * Time: 8:34 AM
 */
if (!class_exists('G5plus_FrameWork_Widget')) {
	class G5plus_FrameWork_Widget {

		public function __construct(){
			add_action('widgets_init', array($this,'register_widget'), 1);
			$this->includes();
			spl_autoload_register(array($this,'autoload'));
		}

		public function autoload($class) {
			$class = preg_replace('/^G5Plus_Widget_/', '', $class);
			$class = str_replace('_', '-', $class);
			$class = strtolower($class);
			set_include_path(PLUGIN_G5PLUS_FRAMEWORK_DIR .'widgets/includes/');
			spl_autoload_extensions('.php');
			spl_autoload($class);
		}

		private function includes(){
			include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'widgets/g5plus-widget.php' );
			include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'widgets/g5plus-widget-acf.php' );
		}

		public function register_widget(){
			register_widget('G5Plus_Widget_Posts');
			register_widget('G5Plus_Widget_Twitter');
			register_widget('G5Plus_Widget_Image');
			register_widget('G5Plus_Widget_Social_Profile');
			register_widget('G5Plus_Widget_Info_Box');
		}

	}
	new G5plus_FrameWork_Widget();
}


