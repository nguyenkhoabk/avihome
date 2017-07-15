<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux_Framework_options_config' ) ) {

    class Redux_Framework_options_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            if ( ! class_exists( 'ReduxFramework' ) ) {
                return;
            }
            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

	    private function get_section_start($id,$title) {
		    return array(
			    'id' => $id . '_start',
			    'type' => 'section',
			    'title' => $title,
			    'indent' => true
		    );
	    }

	    private function get_section_end($id) {
		    return array(
			    'id' => $id . '_end',
			    'type' => 'section',
			    'indent' => false
		    );
	    }

	    private function get_page_layout($id,$required = array() , $default = 'container') {
		    return array(
			        'id' => $id,
				    'type' => 'button_set',
				    'title' => esc_html__('Layout', 'g5plus-orson'),
				    'subtitle' => esc_html__('Select Page Layout', 'g5plus-orson'),
				    'desc' => '',
				    'options' => g5plus_get_page_layout(),
				    'default' => $default,
			        'required'  => $required,
			    );
	    }

	    private function get_sidebar_layout($id,$required = array(),$default = 'right') {
		    return  array(
			    'id' => $id,
			    'type' => 'image_select',
			    'title' => esc_html__('Sidebar Layout', 'g5plus-orson'),
			    'subtitle' => esc_html__('Set Sidebar Layout', 'g5plus-orson'),
			    'desc' => '',
			    'options' => g5plus_get_sidebar_layout(),
			    'default' => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_sidebar_width($id,$required = array() , $default = 'small') {
		    return array(
			    'id' => $id,
			    'type' => 'button_set',
			    'title' => esc_html__('Sidebar Width', 'g5plus-orson'),
			    'subtitle' => esc_html__('Set Sidebar width', 'g5plus-orson'),
			    'desc' => '',
			    'options' => g5plus_get_sidebar_width(),
			    'default' => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_sidebar_mobile_enable($id,$required = array(),$default = 1) {
		    return array(
			    'id' => $id,
			    'type' => 'button_set',
			    'title' => esc_html__('Sidebar Mobile', 'g5plus-orson'),
			    'subtitle' => esc_html__('Turn Off this option if you want to disable sidebar on mobile', 'g5plus-orson'),
			    'desc' => '',
			    'options' => g5plus_get_toggle(),
			    'default' => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_sidebar_mobile_canvas( $id, $required = array(), $default = 1 ) {
		    return array(
			    'id'       => $id,
			    'type'     => 'button_set',
			    'title'    => esc_html__( 'Canvas Sidebar Mobile', 'g5plus-orson' ),
			    'subtitle' => esc_html__( 'Turn Off this option if you want to disable canvas sidebar on mobile', 'g5plus-orson' ),
			    'desc'     => '',
			    'options'  => g5plus_get_toggle(),
			    'default'  => $default,
			    'required' => $required,
		    );
	    }

	    private function get_sidebar($id,$required = array() , $default = 'main-sidebar') {
		    return array(
			    'id' => $id,
			    'type' => 'select',
			    'select2' => array('allowClear' => false),
			    'title' => esc_html__('Sidebar', 'g5plus-orson'),
			    'subtitle' => '',
			    'data'      => 'sidebars',
			    'desc' => '',
			    'default' => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_content_padding($id,$required = array(), $default = array('padding-top'  => '70px','padding-bottom'  => '70px','units'=>'px')) {
		    return array(
			    'id'             => $id,
			    'type'           => 'spacing',
			    'mode'           => 'padding',
			    'units'          => 'px',
			    'units_extended' => 'false',
			    'title'          => esc_html__('Content Padding', 'g5plus-orson'),
			    'subtitle'       => esc_html__('Set content top/bottom padding.', 'g5plus-orson'),
			    'desc'           => esc_html__('Allow values (0,5,10,15....100)','g5plus-orson'),
			    'left'          => false,
			    'right'          => false,
			    'default'       => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_content_padding_mobile($id,$required = array(), $default = array('padding-top'  => '','padding-bottom'  => '','units'=>'px')) {
		    return array(
			    'id'             => $id,
			    'type'           => 'spacing',
			    'mode'           => 'padding',
			    'units'          => 'px',
			    'units_extended' => 'false',
			    'title'          => esc_html__('Content Padding Mobile', 'g5plus-orson'),
			    'subtitle'       => esc_html__('Set content top/bottom padding mobile.', 'g5plus-orson'),
			    'desc'           => esc_html__('Allow values (0,5,10,15....100)','g5plus-orson'),
			    'left'          => false,
			    'right'          => false,
			    'default'       => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_page_title_enable($id,$required = array(), $default = 1) {
		    return array(
			    'id' => $id,
			    'type' => 'button_set',
			    'title' => esc_html__('Page Title Enable', 'g5plus-orson'),
			    'subtitle' => esc_html__('Enable/Disable Page Title', 'g5plus-orson'),
			    'desc' => '',
			    'options' => g5plus_get_toggle(),
			    'default' => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_page_title_layout($id,$required = array(),$default = 'normal') {
		    return array(
			    'id' => $id,
			    'type' => 'button_set',
			    'title' => esc_html__('Page Title Layout', 'g5plus-orson'),
			    'desc' => '',
			    'options' => g5plus_get_page_title_layout(),
			    'default' => $default,
			    'required'  => $required
		    );
	    }

	    private function get_page_sub_title($id,$required = array()) {
		    return array(
			    'id' => $id,
			    'type' => 'text',
			    'title' => esc_html__('Page Sub Title', 'g5plus-orson'),
			    'subtitle' => '',
			    'desc' => '',
			    'default' => '',
			    'required'  => $required,
		    );
	    }

	    private function get_page_title_padding($id,$required = array(),$default = array('padding-top' => '','padding-bottom' => '','units' => 'px')) {
		    return array(
			    'id'             => $id,
			    'type'           => 'spacing',
			    'mode'           => 'padding',
			    'units'          => 'px',
			    'units_extended' => 'false',
			    'title'          => esc_html__('Padding', 'g5plus-orson'),
			    'subtitle'       => esc_html__('Set page title top/bottom padding.', 'g5plus-orson'),
			    'desc'           => '',
			    'left'          => false,
			    'right'          => false,
			    'default'            => $default,
			    'required'  => $required,
		    );
	    }


	    private function get_page_title_background_image($id,$required = array(),$default = array()) {
		    return array(
			    'id' => $id,
			    'type' => 'media',
			    'url'=> true,
			    'title' => esc_html__('Background Image', 'g5plus-orson'),
			    'subtitle' => esc_html__('Upload page title background.', 'g5plus-orson'),
			    'desc' => '',
			    'default' => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_page_title_parallax($id,$required = array(),$default = 1) {
		    return array(
			    'id'       => $id,
			    'type'     => 'button_set',
			    'title'    => esc_html__( 'Page Title Parallax', 'g5plus-orson' ),
			    'subtitle' => esc_html__( 'Enable Page Title Parallax', 'g5plus-orson' ),
			    'desc'     => '',
			    'options'  => g5plus_get_toggle(),
			    'default'  => $default,
			    'required'  => $required,
		    );
	    }

	    private function get_breadcrumb_enable($id,$required = array(),$default = 1) {
		    return array(
			    'id' => $id,
			    'type' => 'button_set',
			    'title' => esc_html__('Breadcrumbs Enable', 'g5plus-orson'),
			    'subtitle' => esc_html__('Enable/Disable Breadcrumbs In Pages Title', 'g5plus-orson'),
			    'desc' => '',
			    'options' => g5plus_get_toggle(),
			    'default' => $default,
			    'required'  => $required
		    );
	    }

	    private function get_theme_color_enable($id,$required = array(), $default = 0) {
		    return array(
			    'id' => $id,
			    'type' => 'button_set',
			    'title' => esc_html__('Customize Color', 'g5plus-orson'),
			    'subtitle' => esc_html__('Select "Customize" if you want to change default theme color', 'g5plus-orson'),
			    'desc' => '',
			    'options' => g5plus_get_toggle_color(),
			    'default' => $default,
			    'required'  => $required,
		    );
	    }

        public function setSections() {

            $fonts =array(
                            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                            "Courier, monospace"                                   => "Courier, monospace",
                            "Garamond, serif"                                      => "Garamond, serif",
                            "Georgia, serif"                                       => "Georgia, serif",
                            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                            "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                        );

            $g5plus_orson_options = get_option('g5plus_orson_options');

            // General Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'General Setting', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-wrench',
                'fields' => array(
                    array(
                        'id' => 'smooth_scroll',
                        'type' => 'button_set',
                        'title' => esc_html__('Smooth Scroll', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enable/Disable Smooth Scroll', 'g5plus-orson'),
                        'desc' => '',
                        'options' => g5plus_get_toggle(),
                        'default' => 0
                    ),

                    array(
                        'id' => 'custom_scroll',
                        'type' => 'button_set',
                        'title' => esc_html__('Custom Scroll', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enable/Disable Custom Scroll', 'g5plus-orson'),
                        'desc' => '',
                        'options' => g5plus_get_toggle(),
                        'default' => 0
                    ),

                    array(
                        'id'        => 'custom_scroll_width',
                        'type'      => 'text',
                        'title'     => esc_html__('Custom Scroll Width', 'g5plus-orson'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty.', 'g5plus-orson'),
                        'validate'  => 'numeric',
                        'default'   => '10',
                        'required'  => array('custom_scroll', '=', 1),
                    ),

                    array(
                        'id'       => 'custom_scroll_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Custom Scroll Color', 'g5plus-orson'),
                        'subtitle' => esc_html__('Set Custom Scroll Color', 'g5plus-orson'),
                        'default'  => '#19394B',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', 1),
                    ),

                    array(
                        'id'       => 'custom_scroll_thumb_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Custom Scroll Thumb Color', 'g5plus-orson'),
                        'subtitle' => esc_html__('Set Custom Scroll Thumb Color', 'g5plus-orson'),
                        'default'  => '#e8aa00',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', 1),
                    ),

                    array(
                        'id' => 'back_to_top',
                        'type' => 'button_set',
                        'title' => esc_html__('Back To Top', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enable/Disable Back to top button', 'g5plus-orson'),
                        'desc' => '',
                        'options' => g5plus_get_toggle(),
                        'default' => 1
                    ),

	                array(
		                'id' => 'enable_rtl_mode',
		                'type' => 'button_set',
		                'title' => esc_html__('Enable RTL mode', 'g5plus-orson'),
		                'subtitle' => esc_html__('Enable/Disable RTL mode', 'g5plus-orson'),
		                'desc' => '',
		                'options' => g5plus_get_toggle(),
		                'default' => 0
	                ),

	                array(
                        'id' => 'social_meta_enable',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Social Meta Tags', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enable the social meta head tag output.', 'g5plus-orson'),
                        'desc' => '',
                        'options' => g5plus_get_toggle(),
                        'default' => 0
                    ),

                    array(
                        'id' => 'twitter_author_username',
                        'type' => 'text',
                        'title' => esc_html__('Twitter Publisher Username', 'g5plus-orson'),
                        'subtitle' => esc_html__( 'Enter your twitter username here, to be used for the Twitter Card date. Ensure that you do not include the @ symbol.','g5plus-orson'),
                        'desc' => '',
                        'default' => "",
                        'required'  => array('enable_social_meta', '=', array('1')),
                    ),
                    array(
                        'id' => 'googleplus_author',
                        'type' => 'text',
                        'title' => esc_html__('Google+ Username', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enter your Google+ username here, to be used for the authorship meta.','g5plus-orson'),
                        'desc' => '',
                        'default' => "",
                        'required'  => array('enable_social_meta', '=', array('1')),
                    ),


                    array(
                        'id' => 'general_divide_2',
                        'type' => 'divide'
                    ),

	                array(
		                'id' => 'shopping_cart_button',
		                'type' => 'checkbox',
		                'title' => esc_html__('Shopping Mini Cart Button', 'g5plus-orson'),
		                'subtitle' => esc_html__('Select shopping mini cart button', 'g5plus-orson'),
		                'options' => array(
			                'view-cart' => esc_html__('View Cart','g5plus-orson'),
			                'checkout' => esc_html__('Checkout','g5plus-orson'),
		                ),
		                'default' => array(
			                'view-cart' => '1',
			                'checkout' => '1',
		                ),
	                ),
	                array(
		                'id' => 'search_popup_type',
		                'type' => 'button_set',
		                'title' => esc_html__('Search Popup Type', 'g5plus-orson'),
		                'subtitle' => esc_html__('Select search popup type.', 'g5plus-orson'),
		                'desc' => '',
		                'options' => array('standard' => esc_html__('Standard','g5plus-orson'),'ajax' => esc_html__('Ajax Search','g5plus-orson')),
		                'default' => 'standard'
	                ),
	                array(
		                'id' => 'search_popup_post_type',
		                'type' => 'checkbox',
		                'title' => esc_html__('Post type for Ajax Search', 'g5plus-orson'),
		                'subtitle' => esc_html__('Select post type for ajax search', 'g5plus-orson'),
		                'options' => array(
			                'post' => 'Post',
			                'page' => 'Page',
			                'product' => 'Product',
			                'portfolio' => 'Portfolio',
			                'service' => 'Our Services',
		                ),
		                'default' => array(
			                'post'      => '1',
			                'page'      => '0',
			                'product'   => '1',
			                'portfolio' => '1',
			                'service'   => '1',
		                ),
		                'required' => array('search_popup_type','=','ajax'),
	                ),

	                array(
		                'id'        => 'search_popup_result_amount',
		                'type'      => 'text',
		                'title'     => esc_html__('Amount Of Search Result', 'g5plus-orson'),
		                'subtitle'  => esc_html__('This must be numeric (no px) or empty (default: 8).', 'g5plus-orson'),
		                'desc'      => esc_html__('Set mount of Search Result', 'g5plus-orson'),
		                'validate'  => 'numeric',
		                'default'   => '',
		                'required' => array('search_popup_type','=','ajax'),
	                ),

	                array(
		                'id' => 'general_divide_3',
		                'type' => 'divide'
	                ),
	                array(
		                'id' => 'menu_transition',
		                'type' => 'button_set',
		                'title' => esc_html__('Menu transition', 'g5plus-orson'),
		                'subtitle' => esc_html__('Select menu transition', 'g5plus-orson'),
		                'desc' => '',
		                'options' => array(
			                'none'                  => esc_html__('None','g5plus-orson'),
			                'x-animate-slide-up'    => esc_html__('Slide Up','g5plus-orson'),
			                'x-animate-slide-down'  => esc_html__('Slide Down','g5plus-orson'),
			                'x-animate-slide-left'  => esc_html__('Slide Left','g5plus-orson'),
			                'x-animate-slide-right' => esc_html__('Slide Right','g5plus-orson'),
			                'x-animate-sign-flip'   => esc_html__('Sign Flip','g5plus-orson'),
		                ),
		                'default' => 'x-animate-sign-flip'
	                ),
                )
            );

            $this->sections[] = array(
                'title' => esc_html__('Maintenance Mode', 'g5plus-orson'),
                'desc' => '',
                'subsection' => true,
                'icon' => 'el-icon-eye-close',
                'fields' => array(
                    array(
                        'id' => 'enable_maintenance',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Maintenance', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enable the themes maintenance mode.', 'g5plus-orson'),
                        'desc' => '',
                        'options' => array('2' => 'On (Custom Page)', '1' => 'On (Standard)','0' => 'Off',),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'maintenance_mode_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'required'  => array('enable_maintenance', '=', '2'),
                        'title' => esc_html__('Custom Maintenance Mode Page', 'g5plus-orson'),
                        'subtitle' => esc_html__('Select the page that is your maintenace page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', 'g5plus-orson'),
                        'desc' => '',
                        'default' => '',
                        'args' => array()
                    ),
                ),
            );


            // Performance Options
            $this->sections[] = array(
                'title'  => esc_html__( 'Performance', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-fire',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'enable_minifile_js',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Mini File JS', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enable/Disable Mini File JS', 'g5plus-orson'),
                        'desc' => '',
                        'options' => g5plus_get_toggle(),
                        'default' => 0
                    ),
                    array(
                        'id' => 'enable_minifile_css',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Mini File CSS', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enable/Disable Mini File CSS', 'g5plus-orson'),
                        'desc' => '',
                        'options' => g5plus_get_toggle(),
                        'default' => 0
                    ),
                )
            );

            // Page Transition
            $this->sections[] = array(
                'title'  => esc_html__( 'Page Transition', 'g5plus-orson'),
                'desc'   => '',
                'icon'   => 'el el-dashboard',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'page_transition',
                        'type' => 'button_set',
                        'title' => esc_html__('Page Transition', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enable/Disable Page Transition', 'g5plus-orson'),
                        'desc' => '',
                        'options' => g5plus_get_toggle(),
                        'default' => 0
                    ),

                    //Loading Animation
                    array(
                        'id' => 'loading_animation',
                        'type' => 'select',
                        'title' => esc_html__('Loading Animation', 'g5plus-orson'),
                        'subtitle' => esc_html__('Choose type of preload animation', 'g5plus-orson'),
                        'desc' => '',
                        'options' => array(
                            'cube' => esc_html__('Cube','g5plus-orson'),
                            'double-bounce' => esc_html__('Double bounce','g5plus-orson'),
                            'wave' => esc_html__('Wave','g5plus-orson'),
                            'pulse' => esc_html__('Pulse','g5plus-orson'),
                            'chasing-dots' => esc_html__('Chasing dots','g5plus-orson'),
                            'three-bounce' => esc_html__('Three bounce','g5plus-orson'),
                            'circle' => esc_html__('Circle','g5plus-orson'),
                            'fading-circle' => esc_html__('Fading circle','g5plus-orson'),
                            'folding-cube' => esc_html__('Folding cube','g5plus-orson'),
                        ),
                        'default' => ''
                    ),

                    array(
                        'id' => 'loading_logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Logo Loading', 'g5plus-orson'),
                        'subtitle' => esc_html__('Upload logo loading.', 'g5plus-orson'),
                        'desc' => '',
                        'required'  => array('loading_animation', '!=', ''),
                    ),

                    array(
                        'id'       => 'loading_animation_bg_color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Loading Background Color', 'g5plus-orson' ),
                        'subtitle' => esc_html__( 'Set loading background color.', 'g5plus-orson' ),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 1
                        ),
                        'output' => array('background-color' => '.site-loading'),
                        'validate' => 'colorrgba',
	                    'required'  => array('loading_animation', '!=', ''),
                    ),

                    //Spinner Color
                    array(
                        'id'       => 'spinner_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Spinner color', 'g5plus-orson'),
                        'subtitle' => esc_html__('Pick a spinner color', 'g5plus-orson'),
                        'default'  => '',
                        'validate' => 'color',
                        'output' => array('background-color' => '.sk-spinner-pulse,.sk-rotating-plane,.sk-double-bounce .sk-child,.sk-wave .sk-rect,.sk-chasing-dots .sk-child,.sk-three-bounce .sk-child,.sk-circle .sk-child:before,.sk-fading-circle .sk-circle:before,.sk-folding-cube .sk-cube:before'),
	                    'required'  => array('loading_animation', '!=', ''),
                    ),
                )
            );

            // Custom Favicon
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom Favicon', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-eye-open',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'custom_favicon',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom favicon', 'g5plus-orson'),
                        'subtitle' => esc_html__('Upload a 16px x 16px Png/Gif/ico image that will represent your website favicon', 'g5plus-orson'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_title',
                        'type' => 'text',
                        'title' => esc_html__('Custom iOS Bookmark Title', 'g5plus-orson'),
                        'subtitle' => esc_html__('Enter a custom title for your site for when it is added as an iOS bookmark.', 'g5plus-orson'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon57',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 57x57', 'g5plus-orson'),
                        'subtitle' => esc_html__('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'g5plus-orson'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon72',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 72x72', 'g5plus-orson'),
                        'subtitle' => esc_html__('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'g5plus-orson'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon114',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 114x114', 'g5plus-orson'),
                        'subtitle' => esc_html__('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'g5plus-orson'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon144',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 144x144', 'g5plus-orson'),
                        'subtitle' => esc_html__('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'g5plus-orson'),
                        'desc' => ''
                    ),
                )
            );


            // 404
            $this->sections[] = array(
                'title'  => esc_html__( '404 Setting', 'g5plus-orson' ),
                'desc'   => '',
                'subsection' => true,
                'icon'   => 'el el-error',
                'fields' => array(
	                array(
		                'id'        => '404_apply_setting',
		                'type'      => 'select',
		                'title'     => esc_html__('404 Page Apply Setting', 'g5plus-orson'),
		                'data'      => 'page',
		                'default'   => '',
	                ),
					array(
						'id' => 'background_image_404',
						'type' => 'media',
						'url'=> true,
						'title' => esc_html__('Background image', 'g5plus-orson'),
						'desc' => '',
						'default' => array(
							'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/bg-404.jpg'
						)
					),
                )
            );

	        // Layout
	        $this->sections[] = array(
		        'title' => esc_html__('Layout Options','g5plus-orson'),
		        'icon' => 'el el-website',
		        'fields' => array(
			        // General
			        array(
				        'id' => 'layout_style',
				        'type' => 'image_select',
				        'title' => esc_html__('Layout Style', 'g5plus-orson'),
				        'subtitle' => esc_html__('Select the layout style', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_layout_style(),
				        'default' => 'wide'
			        ),
			        array(
				        'id' => 'body_background_mode',
				        'type' => 'button_set',
				        'title' => esc_html__('Body Background Mode', 'g5plus-orson'),
				        'subtitle' => esc_html__('Chose Background Mode', 'g5plus-orson'),
				        'desc' => '',
				        'options' => array(
					        'background' => esc_html__('Background','g5plus-orson'),
					        'pattern' => esc_html__('Pattern','g5plus-orson')
				        ),
				        'default' => 'background',
			        ),
			        array(
				        'id'       => 'body_background',
				        'type'     => 'background',
				        'output'   => array( 'body' ),
				        'title'    => esc_html__( 'Body Background', 'g5plus-orson' ),
				        'subtitle' => esc_html__( 'Body background (Apply for Boxed layout style).', 'g5plus-orson' ),
				        'default'  => array(
					        'background-color' => '',
					        'background-repeat' => 'no-repeat',
					        'background-position' => 'center center',
					        'background-attachment' => 'fixed',
					        'background-size' => 'cover'
				        ),
				        'required'  => array(
					        array('body_background_mode', '=', array('background'))
				        ),
			        ),
			        array(
				        'id' => 'body_background_pattern',
				        'type' => 'image_select',
				        'title' => esc_html__('Background Pattern', 'g5plus-orson'),
				        'subtitle' => esc_html__('Body background pattern(Apply for Boxed layout style)', 'g5plus-orson'),
				        'desc' => '',
				        'height' => '40px',
				        'options' => array(
					        'pattern-1.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-1.png'),
					        'pattern-2.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-2.png'),
					        'pattern-3.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-3.png'),
					        'pattern-4.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-4.png'),
					        'pattern-5.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-5.png'),
					        'pattern-6.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-6.png'),
					        'pattern-7.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-7.png'),
					        'pattern-8.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-8.png'),
				        ),
				        'default' => 'pattern-1.png',
				        'required'  => array(
					        array('body_background_mode', '=', array('pattern'))
				        ) ,
			        ),
			        $this->get_page_layout('layout'),
			        $this->get_sidebar_layout('sidebar_layout'),
			        $this->get_sidebar('sidebar',array('sidebar_layout', '=', array('left','right'))),
			        $this->get_sidebar_width('sidebar_width',array('sidebar_layout', '=', array('left','right'))),
			        $this->get_sidebar_mobile_enable('sidebar_mobile_enable',array('sidebar_layout', '=', array('left','right'))),
			        $this->get_sidebar_mobile_canvas( 'sidebar_mobile_canvas', array('sidebar_mobile_enable','=',1)),
			        array(
				        'id' => 'widget_layout',
				        'type' => 'select',
				        'select2' => array('allowClear' => false),
				        'title' => esc_html__('Widget Layout','g5plus-orson'),
				        'options' => g5plus_get_widget_layout(),
				        'default' => 'widget-classic'
			        ),
			        $this->get_content_padding('content_padding'),
			        $this->get_content_padding_mobile('content_padding_mobile'),
			        // Pages Layout
			        $this->get_section_start('page_layout',esc_html__('Pages','g5plus-orson')),
			        array(
				        'id' => 'custom_page_layout_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom layout on pages', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_layout('page_layout',array('custom_page_layout_enable', '=', 1)),
			        $this->get_sidebar_layout('page_sidebar_layout', array('custom_page_layout_enable', '=', 1)),
			        $this->get_sidebar('page_sidebar',array(
				        array('custom_page_layout_enable', '=', 1),
				        array('page_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_width('page_sidebar_width',array(
				        array('custom_page_layout_enable', '=', 1),
				        array('page_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_enable('page_sidebar_mobile_enable',array(
				        array('custom_page_layout_enable', '=', 1),
				        array('page_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_canvas( 'page_sidebar_mobile_canvas', array(
				        array( 'custom_page_layout_enable', '=', 1 ),
				        array( 'page_sidebar_mobile_enable', '=', 1 )
			        ) ),

			        $this->get_content_padding('page_content_padding',array('custom_page_layout_enable', '=', 1)),
			        $this->get_content_padding_mobile('page_content_padding_mobile',array('custom_page_layout_enable', '=', 1)),
			        // Blog Layout
			        $this->get_section_start('blog_layout',esc_html__('Blog','g5plus-orson')),
			        array(
				        'id' => 'custom_blog_layout_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom layout on blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_layout('blog_layout',array('custom_blog_layout_enable', '=', 1)),
			        $this->get_sidebar_layout('blog_sidebar_layout', array('custom_blog_layout_enable', '=', 1)),
			        $this->get_sidebar('blog_sidebar',array(
				        array('custom_blog_layout_enable', '=', 1),
				        array('blog_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_width('blog_sidebar_width',array(
				        array('custom_blog_layout_enable', '=', 1),
				        array('blog_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_enable('blog_sidebar_mobile_enable',array(
				        array('custom_blog_layout_enable', '=', 1),
				        array('blog_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_canvas( 'blog_sidebar_mobile_canvas', array(
				        array( 'custom_blog_layout_enable', '=', 1 ),
				        array( 'blog_sidebar_mobile_enable', '=', 1 )
			        ) ),
			        $this->get_content_padding('blog_content_padding',array('custom_blog_layout_enable', '=', 1),array('padding-top' => '50px', 'padding-bottom' => '50px', 'units' => 'px')),
			        $this->get_content_padding_mobile('blog_content_padding_mobile',array('custom_blog_layout_enable', '=', 1)),
			        // Single Blog Layout
			        $this->get_section_start('single_blog_layout',esc_html__('Single Blog','g5plus-orson')),
			        array(
				        'id' => 'custom_single_blog_layout_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom layout on single blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_layout('single_blog_layout',array('custom_single_blog_layout_enable', '=', 1)),
			        $this->get_sidebar_layout('single_blog_sidebar_layout', array('custom_single_blog_layout_enable', '=', 1)),
			        $this->get_sidebar('single_blog_sidebar',array(
				        array('custom_single_blog_layout_enable', '=', 1),
				        array('single_blog_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_width('single_blog_sidebar_width',array(
				        array('custom_single_blog_layout_enable', '=', 1),
				        array('single_blog_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_enable('single_blog_sidebar_mobile_enable',array(
				        array('custom_single_blog_layout_enable', '=', 1),
				        array('single_blog_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_canvas( 'single_blog_sidebar_mobile_canvas', array(
				        array( 'custom_single_blog_layout_enable', '=', 1 ),
				        array( 'single_blog_sidebar_mobile_enable', '=', 1 )
			        ) ),
			        $this->get_content_padding('single_blog_content_padding',array('custom_single_blog_layout_enable', '=', 1),array('padding-top' => '50px', 'padding-bottom' => '50px', 'units' => 'px')),
			        $this->get_content_padding_mobile('single_blog_content_padding_mobile',array('custom_single_blog_layout_enable', '=', 1)),
			        // Shop Layout
			        $this->get_section_start('archive_product_layout',esc_html__('Archive Product','g5plus-orson')),
			        array(
				        'id' => 'custom_archive_product_layout_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom layout on archive product', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 1
			        ),
			        $this->get_page_layout('archive_product_layout',array('custom_archive_product_layout_enable', '=', 1)),
			        $this->get_sidebar_layout('archive_product_sidebar_layout', array('custom_archive_product_layout_enable', '=', 1)),
			        $this->get_sidebar('archive_product_sidebar',array(
				        array('custom_archive_product_layout_enable', '=', 1),
				        array('archive_product_sidebar_layout', '=', array('left','right'))
			        ),'woocommerce'),
			        $this->get_sidebar_width('archive_product_sidebar_width',array(
				        array('custom_archive_product_layout_enable', '=', 1),
				        array('archive_product_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_enable('archive_product_sidebar_mobile_enable',array(
				        array('custom_archive_product_layout_enable', '=', 1),
				        array('archive_product_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_canvas( 'archive_product_sidebar_mobile_canvas', array(
				        array( 'custom_archive_product_layout_enable', '=', 1 ),
				        array( 'archive_product_sidebar_mobile_enable', '=', 1 )
			        ) ),
			        $this->get_content_padding('archive_product_content_padding',array('custom_archive_product_layout_enable', '=', 1),array('padding-top' => '50px', 'padding-bottom' => '50px', 'units' => 'px')),
			        $this->get_content_padding_mobile('archive_product_content_padding_mobile',array('custom_archive_product_layout_enable', '=', 1)),
			        // Single Product Layout
			        $this->get_section_start('single_product_layout',esc_html__('Single Product','g5plus-orson')),
			        array(
				        'id' => 'custom_single_product_layout_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom layout on single product', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_layout('single_product_layout',array('custom_single_product_layout_enable', '=', 1)),
			        $this->get_sidebar_layout('single_product_sidebar_layout', array('custom_single_product_layout_enable', '=', 1)),
			        $this->get_sidebar('single_product_sidebar',array(
				        array('custom_single_product_layout_enable', '=', 1),
				        array('single_product_sidebar_layout', '=', array('left','right'))
			        ),'single-product'),
			        $this->get_sidebar_width('single_product_sidebar_width',array(
				        array('custom_single_product_layout_enable', '=', 1),
				        array('single_product_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_enable('single_product_sidebar_mobile_enable',array(
				        array('custom_single_product_layout_enable', '=', 1),
				        array('single_product_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_canvas( 'single_product_sidebar_mobile_canvas', array(
				        array( 'custom_single_product_layout_enable', '=', 1 ),
				        array( 'single_product_sidebar_mobile_enable', '=', 1 )
			        ) ),
			        $this->get_content_padding('single_product_content_padding',array('custom_single_product_layout_enable', '=', 1),array('padding-top' => '50px', 'padding-bottom' => '50px', 'units' => 'px')),
			        $this->get_content_padding_mobile('single_product_content_padding_mobile',array('custom_single_product_layout_enable', '=', 1)),
			        // Archive Portfolio Layout
			        $this->get_section_start('archive_portfolio_layout',esc_html__('Archive Portfolio','g5plus-orson')),
			        array(
				        'id' => 'custom_archive_portfolio_layout_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom layout archive portfolio', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_layout('archive_portfolio_layout',array('custom_archive_portfolio_layout_enable', '=', 1)),
			        $this->get_sidebar_layout('archive_portfolio_sidebar_layout', array('custom_archive_portfolio_layout_enable', '=', 1)),
			        $this->get_sidebar('archive_portfolio_sidebar',array(
				        array('custom_archive_portfolio_layout_enable', '=', 1),
				        array('archive_portfolio_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_width('archive_portfolio_sidebar_width',array(
				        array('custom_archive_portfolio_layout_enable', '=', 1),
				        array('archive_portfolio_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_enable('archive_portfolio_sidebar_mobile_enable',array(
				        array('custom_archive_portfolio_layout_enable', '=', 1),
				        array('archive_portfolio_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_canvas( 'archive_portfolio_sidebar_mobile_canvas', array(
				        array( 'custom_archive_portfolio_layout_enable', '=', 1 ),
				        array( 'archive_portfolio_sidebar_mobile_enable', '=', 1 )
			        ) ),
			        $this->get_content_padding('archive_portfolio_content_padding',array('custom_archive_portfolio_layout_enable', '=', 1),array('padding-top' => '50px', 'padding-bottom' => '50px', 'units' => 'px')),
			        $this->get_content_padding_mobile('archive_portfolio_content_padding_mobile',array('custom_archive_portfolio_layout_enable', '=', 1)),
			        // Single Portfolio Layout
			        $this->get_section_start('single_portfolio_layout',esc_html__('Single Portfolio','g5plus-orson')),
			        array(
				        'id' => 'custom_single_portfolio_layout_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom layout on single portfolio', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_layout('single_portfolio_layout',array('custom_single_portfolio_layout_enable', '=', 1)),
			        $this->get_sidebar_layout('single_portfolio_sidebar_layout', array('custom_single_portfolio_layout_enable', '=', 1)),
			        $this->get_sidebar('single_portfolio_sidebar',array(
				        array('custom_single_portfolio_layout_enable', '=', 1),
				        array('single_portfolio_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_width('single_portfolio_sidebar_width',array(
				        array('custom_single_portfolio_layout_enable', '=', 1),
				        array('single_portfolio_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_enable('single_portfolio_sidebar_mobile_enable',array(
				        array('custom_single_portfolio_layout_enable', '=', 1),
				        array('single_portfolio_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_canvas( 'single_portfolio_sidebar_mobile_canvas', array(
				        array( 'custom_single_portfolio_layout_enable', '=', 1 ),
				        array( 'single_portfolio_sidebar_mobile_enable', '=', 1 )
			        ) ),
			        $this->get_content_padding('single_portfolio_content_padding',array('custom_single_portfolio_layout_enable', '=', 1),array('padding-top' => '50px', 'padding-bottom' => '50px', 'units' => 'px')),
			        $this->get_content_padding_mobile('single_portfolio_content_padding_mobile',array('custom_single_portfolio_layout_enable', '=', 1)),

			        // Archive OurTeam Layout
			        $this->get_section_start('archive_ourteam_layout',esc_html__('Archive OurTeam','g5plus-orson')),
			        array(
				        'id' => 'custom_archive_ourteam_layout_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom layout archive ourteam', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_layout('archive_ourteam_layout',array('custom_archive_ourteam_layout_enable', '=', 1)),
			        $this->get_sidebar_layout('archive_ourteam_sidebar_layout', array('custom_archive_ourteam_layout_enable', '=', 1)),
			        $this->get_sidebar('archive_ourteam_sidebar',array(
				        array('custom_archive_ourteam_layout_enable', '=', 1),
				        array('archive_ourteam_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_width('archive_ourteam_sidebar_width',array(
				        array('custom_archive_ourteam_layout_enable', '=', 1),
				        array('archive_ourteam_sidebar_layout', '=', array('left','right'))
			        )),
			        $this->get_sidebar_mobile_enable('archive_ourteam_sidebar_mobile_enable',array(
				        array('custom_archive_ourteam_layout_enable', '=', 1),
				        array('archive_ourteam_sidebar_layout', '=', array('left','right'))
			        ) ),
			        $this->get_sidebar_mobile_canvas( 'archive_ourteam_sidebar_mobile_canvas', array(
				        array( 'custom_archive_ourteam_layout_enable', '=', 1 ),
				        array( 'archive_ourteam_sidebar_mobile_enable', '=', 1 )
			        )),
			        $this->get_content_padding('archive_ourteam_content_padding',array('custom_archive_ourteam_layout_enable', '=', 1),array('padding-top' => '50px', 'padding-bottom' => '50px', 'units' => 'px')),
			        $this->get_content_padding_mobile('archive_ourteam_content_padding_mobile',array('custom_archive_ourteam_layout_enable', '=', 1)),


		        )
	        );

	        // Page Title & Breadcrumb
	        $this->sections[] = array(
		        'title' => esc_html__('Page Title','g5plus-orson'),
		        'icon' => 'el el-asterisk',
		        'fields' => array(
			        $this->get_section_start('page_title',esc_html__('General','g5plus-orson')),
			        $this->get_page_title_enable('page_title_enable'),
			        $this->get_page_title_layout('page_title_layout',array('page_title_enable', '=', 1)),
			        $this->get_page_sub_title('page_sub_title',array(array('page_title_enable', '=', 1),array('page_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_padding('page_title_padding',array(array('page_title_enable', '=', 1),array('page_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_background_image('page_title_bg_image',array(array('page_title_enable', '=', 1),array('page_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_parallax('page_title_parallax',array(array('page_title_enable', '=', 1),array('page_title_bg_image', '!=', ''),array('page_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_breadcrumb_enable('breadcrumbs_enable',array(array('page_title_enable', '=', 1),array('page_title_layout', '!=', 'only-breadcrumb'))),
			        // Archive Title
			        $this->get_section_start('blog_title',esc_html__('Blog','g5plus-orson')),
			        array(
				        'id' => 'custom_blog_title_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Page Title', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom title on blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_title_enable('blog_title_enable',array('custom_blog_title_enable', '=', 1)),
			        $this->get_page_title_layout('blog_title_layout',array(array('custom_blog_title_enable', '=', 1),array('blog_title_enable', '=', 1)) ),
			        $this->get_page_sub_title('blog_sub_title',array(array('custom_blog_title_enable', '=', 1),array('blog_title_enable', '=', 1),array('blog_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_padding('blog_title_padding',array(array('custom_blog_title_enable', '=', 1),array('blog_title_enable', '=', 1),array('blog_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_background_image('blog_title_bg_image',array(array('custom_blog_title_enable', '=', 1),array('blog_title_enable', '=', 1),array('blog_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_parallax('blog_title_parallax',array(array('custom_blog_title_enable', '=', 1),array('blog_title_enable', '=', 1),array('blog_title_bg_image', '!=', ''),array('blog_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_breadcrumb_enable('blog_breadcrumbs_enable',array(array('custom_blog_title_enable', '=', 1),array('blog_title_enable', '=', 1),array('blog_title_layout', '!=', 'only-breadcrumb'))),
			        // Single Blog Title
			        $this->get_section_start('single_blog_title',esc_html__('Single Blog','g5plus-orson')),
			        array(
				        'id' => 'custom_single_blog_title_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Page Title', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom title on single blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_title_enable('single_blog_title_enable',array('custom_single_blog_title_enable', '=', 1)),
			        $this->get_page_title_layout('single_blog_title_layout',array(array('custom_single_blog_title_enable', '=', 1),array('single_blog_title_enable', '=', 1)) ),
			        $this->get_page_sub_title('single_blog_sub_title',array(array('custom_single_blog_title_enable', '=', 1),array('single_blog_title_enable', '=', 1),array('single_blog_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_padding('single_blog_title_padding',array(array('custom_single_blog_title_enable', '=', 1),array('single_blog_title_enable', '=', 1),array('single_blog_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_background_image('single_blog_title_bg_image',array(array('custom_single_blog_title_enable', '=', 1),array('single_blog_title_enable', '=', 1),array('single_blog_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_parallax('single_blog_title_parallax',array(array('custom_single_blog_title_enable', '=', 1),array('single_blog_title_enable', '=', 1),array('single_blog_title_bg_image', '!=', ''),array('single_blog_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_breadcrumb_enable('single_blog_breadcrumbs_enable',array(array('custom_single_blog_title_enable', '=', 1),array('single_blog_title_enable', '=', 1),array('single_blog_title_layout', '!=', 'only-breadcrumb'))),
			        // Archive Product Title
			        $this->get_section_start('archive_product_title',esc_html__('Archive Product','g5plus-orson')),
			        array(
				        'id' => 'custom_archive_product_title_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Page Title', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom title on archive product', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_title_enable('archive_product_title_enable',array('custom_archive_product_title_enable', '=', 1)),
			        $this->get_page_title_layout('archive_product_title_layout',array(array('custom_archive_product_title_enable', '=', 1),array('archive_product_title_enable', '=', 1)) ),
			        $this->get_page_sub_title('archive_product_sub_title',array(array('custom_archive_product_title_enable', '=', 1),array('archive_product_title_enable', '=', 1),array('archive_product_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_padding('archive_product_title_padding',array(array('custom_archive_product_title_enable', '=', 1),array('archive_product_title_enable', '=', 1),array('archive_product_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_background_image('archive_product_title_bg_image',array(array('custom_archive_product_title_enable', '=', 1),array('archive_product_title_enable', '=', 1),array('archive_product_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_parallax('archive_product_title_parallax',array(array('custom_archive_product_title_enable', '=', 1),array('archive_product_title_enable', '=', 1),array('archive_product_title_bg_image', '!=', ''),array('archive_product_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_breadcrumb_enable('archive_product_breadcrumbs_enable',array(array('custom_product_archive_title_enable', '=', 1),array('archive_product_title_enable', '=', 1),array('archive_product_title_layout', '!=', 'only-breadcrumb'))),
			        // Single Product Title
			        $this->get_section_start('single_product_title',esc_html__('Single Product','g5plus-orson')),
			        array(
				        'id' => 'custom_single_product_title_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Page Title', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom title on single product', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_title_enable('single_product_title_enable',array('custom_single_product_title_enable', '=', 1)),
			        $this->get_page_title_layout('single_product_title_layout',array(array('custom_single_product_title_enable', '=', 1),array('single_product_title_enable', '=', 1)) ),
			        $this->get_page_sub_title('single_product_sub_title',array(array('custom_single_product_title_enable', '=', 1),array('single_product_title_enable', '=', 1),array('single_product_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_padding('single_product_title_padding',array(array('custom_single_product_title_enable', '=', 1),array('single_product_title_enable', '=', 1),array('single_product_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_background_image('single_product_title_bg_image',array(array('custom_single_product_title_enable', '=', 1),array('single_product_title_enable', '=', 1),array('single_product_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_parallax('single_product_title_parallax',array(array('custom_single_product_title_enable', '=', 1),array('single_product_title_enable', '=', 1),array('single_product_title_bg_image', '!=', ''),array('single_product_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_breadcrumb_enable('single_product_breadcrumbs_enable',array(array('custom_single_product_title_enable', '=', 1),array('single_product_title_enable', '=', 1),array('single_product_title_layout', '!=', 'only-breadcrumb'))),
			        // Archive Portfolio Title
			        $this->get_section_start('archive_ourteam_title',esc_html__('Archive Portfolio','g5plus-orson')),
			        array(
				        'id' => 'custom_archive_portfolio_title_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Page Title', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom title on archive portfolio', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_title_enable('archive_portfolio_title_enable',array('custom_archive_portfolio_title_enable', '=', 1)),
			        $this->get_page_title_layout('archive_portfolio_title_layout',array(array('custom_archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_enable', '=', 1)) ),
			        $this->get_page_sub_title('archive_portfolio_sub_title',array(array('custom_archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_padding('archive_portfolio_title_padding',array(array('custom_archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_background_image('archive_portfolio_title_bg_image',array(array('custom_archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_parallax('archive_portfolio_title_parallax',array(array('custom_archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_bg_image', '!=', ''),array('archive_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_breadcrumb_enable('archive_portfolio_breadcrumbs_enable',array(array('custom_product_archive_title_enable', '=', 1),array('archive_portfolio_title_enable', '=', 1),array('archive_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        // Single Portfolio Title
			        $this->get_section_start('single_poftfolio_title',esc_html__('Single Portfolio','g5plus-orson')),
			        array(
				        'id' => 'custom_single_portfolio_title_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Page Title', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom title on single portfolio', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_title_enable('single_portfolio_title_enable',array('custom_single_portfolio_title_enable', '=', 1)),
			        $this->get_page_title_layout('single_portfolio_title_layout',array(array('custom_single_portfolio_title_enable', '=', 1),array('single_portfolio_title_enable', '=', 1)) ),
			        $this->get_page_sub_title('single_portfolio_sub_title',array(array('custom_single_portfolio_title_enable', '=', 1),array('single_portfolio_title_enable', '=', 1),array('single_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_padding('single_portfolio_title_padding',array(array('custom_single_portfolio_title_enable', '=', 1),array('single_portfolio_title_enable', '=', 1),array('single_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_background_image('single_portfolio_title_bg_image',array(array('custom_single_portfolio_title_enable', '=', 1),array('single_portfolio_title_enable', '=', 1),array('single_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_parallax('single_portfolio_title_parallax',array(array('custom_single_portfolio_title_enable', '=', 1),array('single_portfolio_title_enable', '=', 1),array('single_portfolio_title_bg_image', '!=', ''),array('single_portfolio_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_breadcrumb_enable('single_portfolio_breadcrumbs_enable',array(array('custom_single_portfolio_title_enable', '=', 1),array('single_portfolio_title_enable', '=', 1),array('single_portfolio_title_layout', '!=', 'only-breadcrumb'))),

			        // Archive OurTeam Title
			        $this->get_section_start('archive_ourteam_title',esc_html__('Archive OurTeam','g5plus-orson')),
			        array(
				        'id' => 'custom_archive_ourteam_title_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Custom Page Title', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn on this option if you want to enable custom title on archive ourteam', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        $this->get_page_title_enable('archive_ourteam_title_enable',array('custom_archive_ourteam_title_enable', '=', 1)),
			        $this->get_page_title_layout('archive_ourteam_title_layout',array(array('custom_archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_enable', '=', 1)) ),
			        $this->get_page_sub_title('archive_ourteam_sub_title',array(array('custom_archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_padding('archive_ourteam_title_padding',array(array('custom_archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_background_image('archive_ourteam_title_bg_image',array(array('custom_archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_page_title_parallax('archive_ourteam_title_parallax',array(array('custom_archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_bg_image', '!=', ''),array('archive_ourteam_title_layout', '!=', 'only-breadcrumb'))),
			        $this->get_breadcrumb_enable('archive_ourteam_breadcrumbs_enable',array(array('custom_product_archive_title_enable', '=', 1),array('archive_ourteam_title_enable', '=', 1),array('archive_ourteam_title_layout', '!=', 'only-breadcrumb'))),

		        )
	        );

	        // Blog & Single Blog
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Blog & Single Blog', 'g5plus-orson' ),
		        'desc'   => '',
		        'icon'   => 'el el-blogger',
		        'fields' => array(
			        $this->get_section_start('blog',esc_html__('Blog Options','g5plus-orson')),
                    array(
                        'id' => 'post_layout',
                        'type' => 'select',
	                    'select2' => array('allowClear' => false),
                        'title' => esc_html__('Post Layout', 'g5plus-orson'),
                        'subtitle' => '',
                        'desc' => '',
                        'options' => g5plus_get_post_layout(),
                        'default' => 'large-image'
                    ),
                    array(
                        'id' => 'post_column',
                        'type' => 'select',
                        'title' => esc_html__('Post Columns', 'g5plus-orson'),
                        'subtitle' => '',
                        'options' => g5plus_get_post_columns(),
                        'desc' => '',
                        'default' => 2,
                        'required' => array('post_layout','=',array('masonry')),
                    ),
                    array(
                        'id' => 'post_paging',
                        'type' => 'button_set',
                        'title' => esc_html__('Post Paging', 'g5plus-orson'),
                        'subtitle' => '',
                        'desc' => '',
                        'options' => g5plus_get_paging_style(),
                        'default' => 'navigation'
                    ),

			        $this->get_section_start('single_blog',esc_html__('Single Blog Options','g5plus-orson')),
			        array(
				        'id'        => 'post_apply_setting',
				        'type'      => 'select',
				        'title'     => esc_html__('Post Single Apply Setting', 'g5plus-orson'),
				        'data'  => 'page',
				        'default'   => '',
			        ),
			        array(
				        'id' => 'single_tag_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Tags', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn Off this option if you want to hide tags on single blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 1
			        ),

			        array(
				        'id' => 'single_share_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Share', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn Off this option if you want to hide share on single blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 1
			        ),

			        array(
				        'id' => 'single_navigation_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Navigation', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn Off this option if you want to hide navigation on single blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0
			        ),
			        array(
				        'id' => 'single_author_info_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Author Info', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn Off this option if you want to hide author info area on single blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 1
			        ),

			        array(
				        'id' => 'single_related_post_enable',
				        'type' => 'button_set',
				        'title' => esc_html__('Related Post', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn Off this option if you want to hide related post area on single blog', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 1
			        ),
			        array(
				        'id' => 'single_related_enable_no_image',
				        'type' => 'button_set',
				        'title' => esc_html__('Use No Image Thumbnail', 'g5plus-orson'),
				        'subtitle' => esc_html__('Turn On this option if you want to use no image for thumbnail', 'g5plus-orson'),
				        'desc' => '',
				        'options' => g5plus_get_toggle(),
				        'default' => 0,
				        'required'  => array('single_related_post_enable', '=', 1),
			        ),


			        array(
				        'id'       => 'single_related_post_total',
				        'type'     => 'text',
				        'title'    => esc_html__('Related Post Total', 'g5plus-orson'),
				        'subtitle' => esc_html__('Total record of Related Post.', 'g5plus-orson'),
				        'validate' => 'number',
				        'default'  => 6,
				        'required'  => array('single_related_post_enable', '=', 1),
			        ),

			        array(
				        'id'       => 'single_related_post_column',
				        'type'     => 'select',
				        'title'    => esc_html__('Related Post Columns', 'g5plus-orson'),
				        'default'  => 3,
				        'options' => array(3 => '3',4 => '4'),
				        'select2' => array('allowClear' =>  false) ,
				        'required'  => array('single_related_post_enable', '=', 1),
			        ),

			        array(
				        'id' => 'single_related_post_condition',
				        'type' => 'checkbox',
				        'title' => esc_html__('Related Post Condition', 'g5plus-orson'),
				        'options' => array(
					        'category' => esc_html__('Same Category','g5plus-orson'),
					        'tag' => esc_html__('Same Tag','g5plus-orson'),
				        ),
				        'default' => array(
					        'category'      => '1',
					        'tag'      => '1',
				        ),
				        'required'  => array('single_related_post_enable', '=', 1),
			        ),

		        )
	        );

            // Logo
            $this->sections[] = array(
                'title'  => esc_html__( 'Logo Setting', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-leaf',
                'fields' => array(
	                array(
		                'id' => 'section-logo-desktop',
		                'type' => 'section',
		                'title' => esc_html__('Logo Desktop', 'g5plus-orson'),
		                'indent' => true
	                ),
                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Logo', 'g5plus-orson'),
                        'subtitle' => esc_html__('Upload your logo here.', 'g5plus-orson'),
                        'desc' => '',
                        'default' => array(
                            'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo.png'
                        )
                    ),
	                array(
		                'id' => 'logo_retina',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Logo Retina', 'g5plus-orson'),
		                'subtitle' => esc_html__('Upload your logo retina here.', 'g5plus-orson'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-2x.png'
		                )
	                ),
	                array(
		                'id' => 'sticky_logo',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Sticky Logo', 'g5plus-orson'),
		                'subtitle' => esc_html__('Upload a sticky version of your logo here', 'g5plus-orson'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo.png'
		                )
	                ),
	                array(
		                'id' => 'sticky_logo_retina',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Sticky Logo Retina', 'g5plus-orson'),
		                'subtitle' => esc_html__('Upload a sticky version of your logo retina here', 'g5plus-orson'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-2x.png'
		                )
	                ),
	                array(
		                'id'        => 'logo_max_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Max Height', 'g5plus-orson'),
		                'desc'      => esc_html__('You can set a max height for the logo here', 'g5plus-orson'),
		                'units' => false,
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),
	                array(
		                'id'             => 'logo_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => esc_html__('Logo Top/Bottom Padding', 'g5plus-orson'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-orson'),
		                'desc'           => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here.', 'g5plus-orson'),
		                'left'          => false,
		                'right'          => false,
		                'default'            => array(
			                'padding-top'     => '',
			                'padding-bottom'  => '',
			                'units'          => 'px',
		                )
	                ),

	                array(
		                'id' => 'section-logo-mobile',
		                'type' => 'section',
		                'title' => esc_html__('Logo Mobile', 'g5plus-orson'),
		                'indent' => true
	                ),
	                array(
		                'id' => 'mobile_logo',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Mobile Logo', 'g5plus-orson'),
		                'subtitle' => esc_html__('Upload your logo here.', 'g5plus-orson'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-mobile.png'
		                )
	                ),
	                array(
		                'id' => 'mobile_logo_retina',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Mobile Logo Retina', 'g5plus-orson'),
		                'subtitle' => esc_html__('Upload your logo retina here.', 'g5plus-orson'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-mobile-2x.png'
		                )
	                ),
	                array(
		                'id'        => 'mobile_logo_max_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Mobile Logo Max Height', 'g5plus-orson'),
		                'desc'      => esc_html__('You can set a max height for the logo mobile here', 'g5plus-orson'),
		                'units'     => false,
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),
	                array(
		                'id'             => 'mobile_logo_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => esc_html__('Logo Top/Bottom Padding', 'g5plus-orson'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-orson'),
		                'desc'           => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here.', 'g5plus-orson'),
		                'left'          => false,
		                'right'          => false,
		                'default'            => array(
			                'padding-top'     => '',
			                'padding-bottom'  => '',
			                'units'          => 'px',
		                )
	                ),

                )
            );

	        // Top Drawer
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Top Drawer', 'g5plus-orson' ),
		        'desc'   => '',
		        'icon'   => 'el el-photo',
		        'fields' => array(
			        array(
				        'id'       => 'top_drawer_type',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Top Drawer Type', 'g5plus-orson' ),
				        'subtitle' => esc_html__( 'Set top drawer type.', 'g5plus-orson' ),
				        'desc'     => '',
				        'options'  => array( 'none' => 'Disable', 'show' => 'Always Show', 'toggle' => 'Toggle' ),
				        'default'  => 'none'
			        ),
			        array(
				        'id'       => 'top_drawer_sidebar',
				        'type' => 'select',
				        'select2' => array('allowClear' => false),
				        'title' => esc_html__('Top Drawer Sidebar', 'g5plus-orson'),
				        'subtitle' => "Choose the default top drawer sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'top_drawer_sidebar',
				        'required' => array('top_drawer_type','=',array('show','toggle')),
			        ),

			        array(
				        'id' => 'top_drawer_wrapper_layout',
				        'type' => 'button_set',
				        'title' => esc_html__('Top Drawer Wrapper Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Select top drawer wrapper layout', 'g5plus-orson'),
				        'desc' => '',
				        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
				        'default' => 'container',
				        'required' => array('top_drawer_type','=',array('show','toggle')),
			        ),

			        array(
				        'id'       => 'top_drawer_hide_mobile',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Show/Hide Top Drawer on mobile', 'g5plus-orson' ),
				        'desc'     => '',
				        'options'  => array( '1' => 'On', '0' => 'Off' ),
				        'default'  => '1',
				        'required' => array('top_drawer_type','=',array('show','toggle')),
			        ),
			        array(
				        'id'             => 'top_drawer_padding',
				        'type'           => 'spacing',
				        'mode'           => 'padding',
				        'units'          => 'px',
				        'units_extended' => 'false',
				        'title'          => esc_html__('Logo Top/Bottom Padding', 'g5plus-orson'),
				        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-orson'),
				        'desc'           => esc_html__('If you would like to override the default top drawer top/bottom padding, then you can do so here.', 'g5plus-orson'),
				        'left'          => false,
				        'right'          => false,
				        'default'            => array(
					        'padding-top'     => '',
					        'padding-bottom'  => '',
					        'units'          => 'px',
				        ),
				        'required' => array('top_drawer_type','=',array('show','toggle')),
			        ),
		        )
	        );

	        // Top Bar
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Top Bar', 'g5plus-orson' ),
		        'desc'   => esc_html__( 'Setting for Top Bar', 'g5plus-orson' ),
		        'icon'   => 'el el-minus',
		        'fields' => array(
			        array(
				        'id' => 'section-top-bar-desktop',
				        'type' => 'section',
				        'title' => esc_html__('Desktop Settings', 'g5plus-orson'),
				        'indent' => true
			        ),
			        array(
				        'id'       => 'top_bar_enable',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Show/Hide Top Bar', 'g5plus-orson' ),
				        'subtitle' => esc_html__( 'Show Hide Top Bar.', 'g5plus-orson' ),
				        'desc'     => '',
				        'options'  => array( '1' => esc_html__('Show','g5plus-orson'), '0' => esc_html__('Hide','g5plus-orson') ),
				        'default'  => '0',
			        ),
			        array(
				        'id' => 'top_bar_layout',
				        'type' => 'image_select',
				        'title' => esc_html__('Top bar Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Select the top bar column layout.', 'g5plus-orson'),
				        'desc' => '',
				        'options' => array(
					        'top-bar-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg'),
					        'top-bar-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg'),
					        'top-bar-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg'),
					        'top-bar-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'),
				        ),
				        'default' => 'top-bar-1',
				        'required' => array('top_bar_enable','=','1'),
			        ),

			        array(
				        'id' => 'top_bar_left_sidebar',
				        'type' => 'select',
				        'select2' => array('allowClear' => false),
				        'title' => esc_html__('Top Left Sidebar', 'g5plus-orson'),
				        'subtitle' => esc_html__('Choose the default top left sidebar','g5plus-orson'),
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'top_bar_left',
				        'required' => array('top_bar_enable','=','1'),
			        ),
			        array(
				        'id' => 'top_bar_right_sidebar',
				        'type' => 'select',
				        'select2' => array('allowClear' => false),
				        'title' => esc_html__('Top Right Sidebar', 'g5plus-orson'),
				        'subtitle' => esc_html__('Choose the default top right sidebar','g5plus-orson'),
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'top_bar_right',
				        'required' => array('top_bar_enable','=','1'),
			        ),
			        array(
				        'id'        => 'top_bar_border',
				        'type'      => 'button_set',
				        'title'     => esc_html__('Top bar border', 'g5plus-orson'),
				        'options'  => array(
					        'none'              => esc_html__('None','g5plus-orson'),
					        'full-border'       => esc_html__('Full Border','g5plus-orson'),
					        'container-border'  => esc_html__('Container Border','g5plus-orson'),
				        ),
				        'default'  => 'none',
				        'required' => array('top_bar_enable','=','1'),
			        ),
			        array(
				        'id'             => 'top_bar_padding',
				        'type'           => 'spacing',
				        'mode'           => 'padding',
				        'units'          => 'px',
				        'units_extended' => 'false',
				        'title'          => esc_html__('Top Bar Top/Bottom Padding', 'g5plus-orson'),
				        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-orson'),
				        'desc'           => esc_html__('If you would like to override the default top bar top/bottom padding, then you can do so here.', 'g5plus-orson'),
				        'left'          => false,
				        'right'          => false,
				        'default'            => array(
					        'padding-top'     => '',
					        'padding-bottom'  => '',
					        'units'          => 'px',
				        ),
				        'required' => array('top_bar_enable','=','1'),
			        ),

			        //--------------------------------------------------------------
			        array(
				        'id' => 'section-top-bar-mobile',
				        'type' => 'section',
				        'title' => esc_html__('Mobile Settings', 'g5plus-orson'),
				        'indent' => true
			        ),
			        array(
				        'id'       => 'top_bar_mobile_enable',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Show/Hide Top Bar', 'g5plus-orson' ),
				        'subtitle' => esc_html__( 'Show Hide Top Bar.', 'g5plus-orson' ),
				        'desc'     => '',
				        'options'  => array( '1' => esc_html__('Show','g5plus-orson'), '0' => esc_html__('Hide','g5plus-orson') ),
				        'default'  => '0',
			        ),
			        array(
				        'id' => 'top_bar_mobile_layout',
				        'type' => 'image_select',
				        'title' => esc_html__('Top bar Layout', 'g5plus-orson'),
				        'subtitle' => esc_html__('Select the top bar column layout.', 'g5plus-orson'),
				        'desc' => '',
				        'options' => array(
					        'top-bar-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg'),
					        'top-bar-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg'),
					        'top-bar-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg'),
					        'top-bar-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'),
				        ),
				        'default' => 'top-bar-1',
				        'required' => array('top_bar_mobile_enable','=','1'),
			        ),

			        array(
				        'id' => 'top_bar_mobile_left_sidebar',
				        'type' => 'select',
				        'select2' => array('allowClear' => false),
				        'title' => esc_html__('Top Left Sidebar', 'g5plus-orson'),
				        'subtitle' => esc_html__('Choose the default top left sidebar','g5plus-orson'),
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'top_bar_left',
				        'required' => array('top_bar_mobile_enable','=','1'),
			        ),
			        array(
				        'id' => 'top_bar_mobile_right_sidebar',
				        'type' => 'select',
				        'select2' => array('allowClear' => false),
				        'title' => esc_html__('Top Right Sidebar', 'g5plus-orson'),
				        'subtitle' => esc_html__('Choose the default top right sidebar','g5plus-orson'),
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'top_bar_right',
				        'required' => array('top_bar_mobile_enable','=','1'),
			        ),
			        array(
				        'id'        => 'top_bar_mobile_border',
				        'type'      => 'button_set',
				        'title'     => esc_html__('Top bar mobile border', 'g5plus-orson'),
				        'options'  => array(
					        'none'              => esc_html__('None','g5plus-orson'),
					        'full-border'       => esc_html__('Full Border','g5plus-orson'),
					        'container-border'  => esc_html__('Container Border','g5plus-orson'),
				        ),
				        'default'  => 'container-border',
				        'required' => array('top_bar_mobile_enable','=','1'),
			        ),
			        array(
				        'id'             => 'top_bar_mobile_padding',
				        'type'           => 'spacing',
				        'mode'           => 'padding',
				        'units'          => 'px',
				        'units_extended' => 'false',
				        'title'          => esc_html__('Top Bar Top/Bottom Padding', 'g5plus-orson'),
				        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-orson'),
				        'desc'           => esc_html__('If you would like to override the default top bar top/bottom padding, then you can do so here.', 'g5plus-orson'),
				        'left'          => false,
				        'right'          => false,
				        'default'            => array(
					        'padding-top'     => '',
					        'padding-bottom'  => '',
					        'units'          => 'px',
				        ),
				        'required' => array('top_bar_mobile_enable','=','1'),
			        ),
		        )
	        );

            // Header
            $this->sections[] = array(
                'title'  => esc_html__( 'Header', 'g5plus-orson' ),
	            'desc'   => esc_html__( 'Setting for Theme Header', 'g5plus-orson' ),
                'icon'   => 'el el-credit-card',
                'fields' => array(
	                array(
		                'id'       => 'header_responsive_breakpoint',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Header responsive breakpoint', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Set header responsive breakpoint', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => array(
			                '991' => esc_html__('Medium Devices: < 992px','g5plus-orson'),
			                '767' => esc_html__('Tablet Portrait: < 768px','g5plus-orson'),
		                ),
		                'default'  => '991'
	                ),
	                array(
		                'id' => 'section-header-desktop',
		                'type' => 'section',
		                'title' => esc_html__('Desktop Settings', 'g5plus-orson'),
		                'indent' => true
	                ),
                    array(
                        'id' => 'header_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Header Layout', 'g5plus-orson'),
                        'subtitle' => esc_html__('Select a header layout option from the examples.', 'g5plus-orson'),
                        'desc' => '',
                        'options' => array(
                            'header-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-1.png'),
	                        'header-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-2.png'),
	                        'header-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-3.png'),
	                        'header-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-4.png'),
	                        'header-5' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-5.png'),
	                        'header-6' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-6.png'),
	                        'header-7' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-7.png'),
	                        'header-8' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-8.png'),
	                        'header-9' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-9.png'),
	                        'header-10' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-10.png'),
                            'header-11' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-11.png'),
                            'header-12' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-12.png'),
                        ),
                        'default' => 'header-1'
                    ),
	                array(
		                'id'        => 'header_container_layout',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Header container layout', 'g5plus-orson'),
		                'options'  => array(
			                'container'     => esc_html__('Container','g5plus-orson'),
			                'container-full'      => esc_html__('Container Full','g5plus-orson'),
		                ),
		                'default'  => 'container'
	                ),
	                array(
		                'id'       => 'header_float',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Header Float', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Enable/Disable Header Float.', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => '0',
	                ),
                    array(
		                'id'       => 'header_sticky',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show/Hide Header Sticky', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Show Hide header Sticky.', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => '1'
	                ),
	                array(
		                'id'       => 'header_border_bottom',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Header border bottom', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Set header border bottom', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => array(
			                'none'              => esc_html__('None','g5plus-orson'),
			                'full-border'       => esc_html__('Full Border','g5plus-orson'),
			                'container-border'  => esc_html__('Container Border','g5plus-orson'),
		                ),
		                'default'  => 'none',
		                'required' => array('header_layout', '=', array('header-1', 'header-3', 'header-4', 'header-5', 'header-7', 'header-11', 'header-12')),
	                ),
	                array(
		                'id'       => 'header_above_border_bottom',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Header above border bottom', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Set header above border bottom', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => array(
			                'none'              => esc_html__('None','g5plus-orson'),
			                'full-border'       => esc_html__('Full Border','g5plus-orson'),
			                'container-border'  => esc_html__('Container Border','g5plus-orson'),
		                ),
		                'default'  => 'none',
		                'required' => array('header_layout', '=', array('header-3', 'header-4', 'header-5', 'header-7', 'header-11', 'header-12')),
	                ),
	                array(
		                'id'             => 'header_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => esc_html__('Header Top/Bottom Padding', 'g5plus-orson'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-orson'),
		                'desc'           => esc_html__('If you would like to override the default header top/bottom padding, then you can do so here.', 'g5plus-orson'),
		                'left'          => false,
		                'right'          => false,
		                'default'            => array(
			                'padding-top'     => '',
			                'padding-bottom'  => '',
			                'units'          => 'px',
		                ),
	                ),
	                array(
		                'id'        => 'navigation_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Navigation height', 'g5plus-orson'),
		                'desc'      => esc_html__('Set header navigation height (px). Do not include unit. Empty to default', 'g5plus-orson'),
		                'units'     => false,
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),
	                array(
		                'id'        => 'navigation_spacing',
		                'type'      => 'slider',
		                'title'     => esc_html__('Navigation Spacing (px)', 'g5plus-orson'),
		                'default'   => '30',
		                'min'       => 0,
		                'step'      => 1,
		                'max'       => 100,
	                ),

	                //---------------------------------------------------------------
	                array(
		                'id' => 'section-header-mobile',
		                'type' => 'section',
		                'title' => esc_html__('Mobile Settings', 'g5plus-orson'),
		                'indent' => true
	                ),
	                array(
		                'id' => 'mobile_header_layout',
		                'type' => 'image_select',
		                'title' => esc_html__('Header Layout', 'g5plus-orson'),
		                'subtitle' => esc_html__('Select header mobile layout', 'g5plus-orson'),
		                'desc' => '',
		                'options' => array(
			                'header-mobile-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-1.png'),
			                'header-mobile-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-2.png'),
			                'header-mobile-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-3.png'),
			                'header-mobile-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-4.png'),
		                ),
		                'default' => 'header-mobile-1'
	                ),
	                array(
		                'id'       => 'mobile_header_menu_drop',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Menu Drop Type', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Set menu drop type for mobile header', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => array(
			                'menu-drop-dropdown' => esc_html__('Dropdown Menu','g5plus-orson'),
			                'menu-drop-fly' => esc_html__('Fly Menu','g5plus-orson')
		                ),
		                'default'  => 'fly'
	                ),
	                array(
		                'id'       => 'mobile_header_stick',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Stick Mobile Header', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Enable Stick Mobile Header.', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => array( '1' => esc_html__('On','g5plus-orson'), '0' => esc_html__('Off','g5plus-orson') ),
		                'default'  => '0'
	                ),
	                array(
		                'id'       => 'mobile_header_search_box',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Search Box', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Enable Search Box.', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => array( '1' => esc_html__('Show','g5plus-orson'), '0' => esc_html__('Hide','g5plus-orson') ),
		                'default'  => '1'
	                ),
	                array(
		                'id'       => 'mobile_header_shopping_cart',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Shopping Cart', 'g5plus-orson' ),
		                'subtitle' => esc_html__( 'Enable Shopping Cart', 'g5plus-orson' ),
		                'desc'     => '',
		                'options'  => array( '1' => esc_html__('Show','g5plus-orson'), '0' => esc_html__('Hide','g5plus-orson') ),
		                'default'  => '1'
	                ),
	                array(
		                'id'        => 'mobile_header_border_bottom',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Mobile header border bottom', 'g5plus-orson'),
		                'options'  => array(
			                'none'              => esc_html__('None','g5plus-orson'),
			                'full-border'       => esc_html__('Full Border','g5plus-orson'),
			                'container-border'  => esc_html__('Container Border','g5plus-orson'),
		                ),
		                'default'  => 'none',
	                ),
                )
            );

	        // Header Customize
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Header Customize', 'g5plus-orson' ),
		        'desc'   => '',
		        'icon'   => 'el el-credit-card',
		        'fields' => array(
			        array(
				        'id' => 'section-header-customize-left',
				        'type' => 'section',
				        'title' => esc_html__('Header Customize Left', 'g5plus-orson'),
				        'indent' => true,
				        'required' => array('header_layout', '=', array('header-5', 'header-11')),
			        ),
			        array(
				        'id'      => 'header_customize_left',
				        'type'    => 'sorter',
				        'title'   => 'Header customize left',
				        'desc'    => 'Organize how you want the layout to appear on the header left',
				        'options' => array(
					        'enabled'  => array(
						        'email'         => esc_html__('Email','g5plus-orson'),
						        'phone'         => esc_html__('Phone','g5plus-orson'),
						        'shopping-cart' => esc_html__('Shopping Cart','g5plus-orson'),
					        ),
					        'disabled' => array(
						        'search' => esc_html__('Search','g5plus-orson'),
						        'sidebar'       => esc_html__('Sidebar','g5plus-orson'),
						        'custom-text'   => esc_html__('Custom Text','g5plus-orson'),
					        )
				        )
			        ),
			        array(
				        'id' => 'header_customize_left_email',
				        'type' => 'label_value',
				        'title' => esc_html__('Email', 'g5plus-orson'),
				        'default' => array(
					        'label' => esc_html__('Email Us', 'g5plus-orson'),
					        'value' => '',
				        ),
			        ),
			        array(
				        'id' => 'header_customize_left_phone',
				        'type' => 'label_value',
				        'title' => esc_html__('Phone', 'g5plus-orson'),
				        'default' => array(
					        'label' => esc_html__('Call Us', 'g5plus-orson'),
					        'value' => '',
				        ),
			        ),
			        array(
				        'id' => 'header_customize_left_search',
				        'type' => 'button_set',
				        'title' => esc_html__('Search Type', 'g5plus-orson'),
				        'default' => 'button',
				        'options' => g5plus_get_search_type(),
			        ),
			        array(
				        'id' => 'header_customize_left_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Sidebar', 'g5plus-orson'),
				        'subtitle' => esc_html__('Choose the sidebar for header right customize','g5plus-orson'),
				        'data'      => 'sidebars',
				        'default' => '',
			        ),
			        array(
				        'id' => 'header_customize_left_text',
				        'type' => 'ace_editor',
				        'mode' => 'html',
				        'theme' => 'monokai',
				        'title' => esc_html__('Custom Text Content', 'g5plus-orson'),
				        'subtitle' => esc_html__('Add Content for Custom Text', 'g5plus-orson'),
				        'desc' => '',
				        'default' => '',
				        'options'  => array('minLines'=> 5, 'maxLines' => 60),
			        ),
			        array(
				        'id'        => 'header_customize_left_spacing',
				        'type'      => 'slider',
				        'title'     => esc_html__('Navigation Item Spacing (px)', 'g5plus-orson'),
				        'default'   => '40',
				        'min'       => 0,
				        'step'      => 1,
				        'max'       => 100,
			        ),

			        array(
				        'id' => 'section-header-customize-right',
				        'type' => 'section',
				        'title' => esc_html__('Header Customize Right', 'g5plus-orson'),
				        'indent' => true,
				        'required' => array('header_layout', '!=', 'header-1'),
			        ),
			        array(
				        'id'      => 'header_customize_right',
				        'type'    => 'sorter',
				        'title'   => 'Header customize right',
				        'desc'    => 'Organize how you want the layout to appear on the header right',
				        'options' => array(
					        'enabled'  => array(
					        ),
					        'disabled' => array(
						        'email'         => esc_html__('Email','g5plus-orson'),
						        'phone'         => esc_html__('Phone','g5plus-orson'),
						        'shopping-cart' => esc_html__('Shopping Cart','g5plus-orson'),
						        'search'        => esc_html__('Search','g5plus-orson'),
						        'sidebar'       => esc_html__('Sidebar','g5plus-orson'),
						        'custom-text'   => esc_html__('Custom Text','g5plus-orson'),
					        )
				        )
			        ),
			        array(
				        'id' => 'header_customize_right_email',
				        'type' => 'label_value',
				        'title' => esc_html__('Email', 'g5plus-orson'),
				        'default' => array(
					        'label' => esc_html__('Email Us', 'g5plus-orson'),
					        'value' => '',
				        ),
			        ),
			        array(
				        'id' => 'header_customize_right_phone',
				        'type' => 'label_value',
				        'title' => esc_html__('Phone', 'g5plus-orson'),
				        'default' => array(
					        'label' => esc_html__('Call Us', 'g5plus-orson'),
					        'value' => '',
				        ),
			        ),
			        array(
				        'id' => 'header_customize_right_search',
				        'type' => 'button_set',
				        'title' => esc_html__('Search Type', 'g5plus-orson'),
				        'default' => 'button',
				        'options' => g5plus_get_search_type(),
			        ),
			        array(
				        'id' => 'header_customize_right_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Sidebar', 'g5plus-orson'),
				        'subtitle' => esc_html__('Choose the sidebar for header right customize','g5plus-orson'),
				        'data'      => 'sidebars',
				        'default' => '',
			        ),
			        array(
				        'id' => 'header_customize_right_text',
				        'type' => 'ace_editor',
				        'mode' => 'html',
				        'theme' => 'monokai',
				        'title' => esc_html__('Custom Text Content', 'g5plus-orson'),
				        'subtitle' => esc_html__('Add Content for Custom Text', 'g5plus-orson'),
				        'desc' => '',
				        'default' => '',
				        'options'  => array('minLines'=> 5, 'maxLines' => 60),
			        ),
			        array(
				        'id'        => 'header_customize_right_spacing',
				        'type'      => 'slider',
				        'title'     => esc_html__('Navigation Item Spacing (px)', 'g5plus-orson'),
				        'default'   => '40',
				        'min'       => 0,
				        'step'      => 1,
				        'max'       => 100,
			        ),

			        array(
				        'id' => 'section-header-customize-nav',
				        'type' => 'section',
				        'title' => esc_html__('Header Customize Navigation', 'g5plus-orson'),
				        'indent' => true,
			        ),
			        array(
				        'id'      => 'header_customize_nav',
				        'type'    => 'sorter',
				        'title'   => 'Header customize navigation',
				        'desc'    => 'Organize how you want the layout to appear on the header navigation',
				        'options' => array(
					        'enabled'  => array(
					        ),
					        'disabled' => array(
						        'email'         => esc_html__('Email','g5plus-orson'),
						        'phone'         => esc_html__('Phone','g5plus-orson'),
						        'shopping-cart' => esc_html__('Shopping Cart','g5plus-orson'),
						        'search'        => esc_html__('Search','g5plus-orson'),
						        'sidebar'       => esc_html__('Sidebar','g5plus-orson'),
						        'custom-text'   => esc_html__('Custom Text','g5plus-orson'),
					        )
				        )
			        ),
			        array(
				        'id' => 'header_customize_nav_email',
				        'type' => 'label_value',
				        'title' => esc_html__('Email', 'g5plus-orson'),
				        'default' => array(
					        'label' => esc_html__('Email Us', 'g5plus-orson'),
					        'value' => '',
				        ),
			        ),
			        array(
				        'id' => 'header_customize_nav_phone',
				        'type' => 'label_value',
				        'title' => esc_html__('Phone', 'g5plus-orson'),
				        'default' => array(
					        'label' => esc_html__('Call Us', 'g5plus-orson'),
					        'value' => '',
				        ),
			        ),
			        array(
				        'id' => 'header_customize_nav_search',
				        'type' => 'button_set',
				        'title' => esc_html__('Search Type', 'g5plus-orson'),
				        'default' => 'button',
				        'options' => g5plus_get_search_type(),
			        ),
			        array(
				        'id' => 'header_customize_nav_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Sidebar', 'g5plus-orson'),
				        'subtitle' => esc_html__('Choose the sidebar for header customize navigation','g5plus-orson'),
				        'data'      => 'sidebars',
				        'default' => '',
			        ),
			        array(
				        'id' => 'header_customize_nav_text',
				        'type' => 'ace_editor',
				        'mode' => 'html',
				        'theme' => 'monokai',
				        'title' => esc_html__('Custom Text Content', 'g5plus-orson'),
				        'subtitle' => esc_html__('Add Content for Custom Text', 'g5plus-orson'),
				        'desc' => '',
				        'default' => '',
				        'options'  => array('minLines'=> 5, 'maxLines' => 60),
			        ),
			        array(
				        'id'        => 'header_customize_nav_spacing',
				        'type'      => 'slider',
				        'title'     => esc_html__('Navigation Item Spacing (px)', 'g5plus-orson'),
				        'default'   => '40',
				        'min'       => 0,
				        'step'      => 1,
				        'max'       => 100,
			        ),
		        )
	        );

	        // Footer
            $this->sections[] = array(
                'title'  => esc_html__( 'Footer', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-website',
                'fields' => array(
	                array(
		                'id' => 'section-footer-general-settings',
		                'type' => 'section',
		                'title' => esc_html__('General Settings', 'g5plus-orson'),
		                'indent' => true
	                ),
	                array(
		                'id' => 'footer_container_layout',
		                'type' => 'button_set',
		                'title' => esc_html__('Footer Container Layout', 'g5plus-orson'),
		                'subtitle' => esc_html__('Select Footer Container Layout', 'g5plus-orson'),
		                'desc' => '',
		                'options' => array(
                            'full'              => esc_html__('Full Width','g5plus-orson'),
                            'container-fluid'   => esc_html__('Container Fluid','g5plus-orson'),
			                'container'         => esc_html__('Container','g5plus-orson')
                        ),
		                'default' => 'container'
	                ),


                    array(
                        'id' => 'footer_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Layout', 'g5plus-orson'),
                        'subtitle' => esc_html__('Select the footer column layout.', 'g5plus-orson'),
                        'desc' => '',
                        'options' => array(
                            'footer-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-1.jpg'),
                            'footer-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-2.jpg'),
                            'footer-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-3.jpg'),
                            'footer-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-4.jpg'),
                            'footer-5' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-5.jpg'),
                            'footer-6' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-6.jpg'),
                            'footer-7' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-7.jpg'),
                            'footer-8' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-8.jpg'),
                            'footer-9' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-9.jpg'),
                        ),
                        'default' => 'footer-1'
                    ),

	                array(
		                'id' => 'footer_sidebar_1',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 1', 'g5plus-orson'),
		                'subtitle' => "Choose the default footer sidebar 1",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-1',
	                ),

	                array(
		                'id' => 'footer_sidebar_2',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 2', 'g5plus-orson'),
		                'subtitle' => "Choose the default footer sidebar 2",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-2',
		                'required' => array('footer_layout', '=', array('footer-1','footer-2','footer-3','footer-4','footer-5','footer-6','footer-7','footer-8'))
	                ),

	                array(
		                'id' => 'footer_sidebar_3',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 3', 'g5plus-orson'),
		                'subtitle' => "Choose the default footer sidebar 3",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-3',
		                'required' => array('footer_layout', '=', array('footer-1','footer-2','footer-3','footer-5','footer-8'))
	                ),

	                array(
		                'id' => 'footer_sidebar_4',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 4', 'g5plus-orson'),
		                'subtitle' => "Choose the default footer sidebar 4",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-4',
		                'required' => array('footer_layout', '=', array('footer-1'))
	                ),
                    array(
                        'id' => 'footer_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background image', 'g5plus-orson'),
                        'subtitle' => esc_html__('Upload footer background image here', 'g5plus-orson'),
                        'desc' => '',
	                    'default' => '',
                    ),

                    array(
                        'id'       => 'footer_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Footer Parallax', 'g5plus-orson' ),
                        'subtitle' => esc_html__( 'Enable Footer Parallax', 'g5plus-orson' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'collapse_footer',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Collapse footer on mobile device', 'g5plus-orson' ),
                        'subtitle' => esc_html__( 'Enable collapse footer', 'g5plus-orson' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '0'
                    ),
	                array(
		                'id'             => 'footer_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => esc_html__('Footer Top/Bottom Padding', 'g5plus-orson'),
		                'subtitle'       => esc_html__('This must be numeric (no px)', 'g5plus-orson'),
		                'desc'           => esc_html__('If you would like to override the default footer top/bottom padding, then you can do so here.', 'g5plus-orson'),
		                'left'          => false,
		                'right'          => false,
		                'default'            => array(
			                'padding-top'     => '60px',
			                'padding-bottom'  => '60px',
			                'units'          => 'px',
		                )
	                ),
	                array(
		                'id'        => 'footer_border_top',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Footer border top', 'g5plus-orson'),
		                'options'  => array(
			                'none'              => esc_html__('None','g5plus-orson'),
			                'full-border'       => esc_html__('Full Border','g5plus-orson'),
			                'container-border'  => esc_html__('Container Border','g5plus-orson'),
		                ),
		                'default'  => 'none',
	                ),

	                //--------------------------------------------------------------------------------
	                array(
		                'id' => 'section-footer-bottom-settings',
		                'type' => 'section',
		                'title' => esc_html__('Bottom Bar Settings', 'g5plus-orson'),
		                'indent' => true
	                ),
                    array(
                        'id' => 'bottom_bar_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Bottom bar Layout', 'g5plus-orson'),
                        'subtitle' => esc_html__('Select the bottom bar column layout.', 'g5plus-orson'),
                        'desc' => '',
                        'options' => array(
                            'bottom-bar-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-1.jpg'),
                            'bottom-bar-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-2.jpg'),
                            'bottom-bar-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-3.jpg'),
	                        'bottom-bar-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-4.jpg'),
                        ),
                        'default' => 'bottom-bar-1',
                    ),

                    array(
                        'id' => 'bottom_bar_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Bottom Left Sidebar', 'g5plus-orson'),
                        'subtitle' => "Choose the default bottom left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_left',
                    ),
                    array(
                        'id' => 'bottom_bar_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Bottom Right Sidebar', 'g5plus-orson'),
                        'subtitle' => "Choose the default bottom right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_right',
                    ),
	                array(
		                'id'             => 'bottom_bar_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => esc_html__('Bottom Bar Top/Bottom Padding', 'g5plus-orson'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-orson'),
		                'desc'           => esc_html__('If you would like to override the default bottom bar top/bottom padding, then you can do so here.', 'g5plus-orson'),
		                'left'          => false,
		                'right'         => false,
		                'default'            => array(
			                'padding-top'     => '25px',
			                'padding-bottom'  => '25px',
			                'units'          => 'px',
		                ),
	                ),
	                array(
		                'id'        => 'bottom_bar_border_top',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Bottom bar border top', 'g5plus-orson'),
		                'options'  => array(
			                'none'              => esc_html__('None','g5plus-orson'),
			                'full-border'       => esc_html__('Full Border','g5plus-orson'),
			                'container-border'  => esc_html__('Container Border','g5plus-orson'),
		                ),
		                'default'  => 'none',
	                ),
                )
            );

	        // Theme Colors
            $this->sections[] = array(
                'title'  => esc_html__( 'Theme Colors', 'g5plus-orson' ),
                'desc'   => esc_html__( 'If you change value in this section, you must "Save & Generate CSS"', 'g5plus-orson' ),
                'icon'   => 'el el-magic',
                'fields' => array(
	                array(
		                'id' => 'section-theme-color-general',
		                'type' => 'section',
		                'title' => esc_html__('General', 'g5plus-orson'),
		                'indent' => true
	                ),
                    array(
                        'id'       => 'accent_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Accent Color', 'g5plus-orson'),
                        'default'  => '#34A853',
                        'validate' => 'color',
	                    'colors' => array('#34A853','#7E0016', '#BDDCDA', '#FEC735', '#EA7B45', '#EA4336', '#4285F4', '#2F659A', '#C60325', '#35BFEE', '#FFC40E', '#6EA9AD')
                    ),
	                array(
		                'id'       => 'foreground_accent_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Foregound Accent Color', 'g5plus-orson'),
		                'default'  => '#fff',
		                'validate' => 'color',
	                ),
                    array(
                        'id'       => 'text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Text Color', 'g5plus-orson'),
                        'default'  => '#666',
                        'validate' => 'color',
                    ),

	                array(
		                'id'       => 'border_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Border Color', 'g5plus-orson'),
		                'default'  => '#eee',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'feature_color1',
		                'type'     => 'color',
		                'title'    => esc_html__('Feature Color 1', 'g5plus-orson'),
		                'default'  => '#EF7E7E',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'feature_color2',
		                'type'     => 'color',
		                'title'    => esc_html__('Feature Color 2', 'g5plus-orson'),
		                'default'  => '#6FA2F7',
		                'validate' => 'color',
	                ),

	                //--------------------------------------------------------------------
	                array(
		                'id' => 'section-theme-color-top-drawer',
		                'type' => 'section',
		                'title' => esc_html__('Top Drawer', 'g5plus-orson'),
		                'indent' => true
	                ),
	                array(
		                'id'       => 'top_drawer_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__( 'Top drawer background color', 'g5plus-orson' ),
		                'default'  => '#2f2f2f',
		                'validate' => 'color',
	                ),

	                array(
		                'id'       => 'top_drawer_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top drawer text color', 'g5plus-orson'),
		                'default'  => '#c5c5c5',
		                'validate' => 'color',
	                ),

	                //--------------------------------------------------------------------
	                array(
		                'id' => 'section-theme-color-header-color',
		                'type' => 'section',
		                'title' => esc_html__('Header', 'g5plus-orson'),
		                'indent' => true
	                ),
	                $this->get_theme_color_enable('header_color_customize'),
	                array(
		                'id'       => 'header_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header background color', 'g5plus-orson'),
		                'default'  => '#fff',
		                'validate' => 'color',
		                'required'  => array('header_color_customize', '=', 1),
	                ),
	                array(
		                'id'        => 'header_overlay',
		                'type'      => 'slider',
		                'title'     => esc_html__('Header Overlay', 'g5plus-orson'),
		                'subtitle'  => esc_html__('Set the opacity level of the overlay', 'g5plus-orson'),
		                'default'   => '0',
		                'min'       => 0,
		                'step'      => 1,
		                'max'       => 100,
		                'required'  => array(
			                array('header_color_customize', '=', 1),
			                array('header_float', '=', 1),
		                ),
	                ),
	                array(
		                'id'       => 'header_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header text color', 'g5plus-orson'),
		                'default'  => '#212121',
		                'validate' => 'color',
		                'required'  => array('header_color_customize', '=', 1),
	                ),
	                array(
		                'id'       => 'header_border_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header border color', 'g5plus-orson'),
		                'default'  => '#eee',
		                'validate' => 'color',
		                'required'  => array('header_color_customize', '=', 1),
	                ),
	                array(
		                'id'       => 'header_above_border_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header above border color', 'g5plus-orson'),
		                'default'  => '#eee',
		                'validate' => 'color',
		                'required'  => array('header_color_customize', '=', 1),
	                ),

	                //--------------------------------------------------------------------
	                array(
		                'id' => 'section-theme-color-top-bar',
		                'type' => 'section',
		                'title' => esc_html__('Top Bar', 'g5plus-orson'),
		                'indent' => true
	                ),
	                $this->get_theme_color_enable('top_bar_color_customize'),
	                array(
		                'id'       => 'top_bar_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__( 'Top bar background color', 'g5plus-orson' ),
		                'default'  => '#eee',
		                'validate' => 'color',
		                'required'  => array('top_bar_color_customize', '=', 1),
	                ),
	                array(
		                'id'        => 'top_bar_overlay',
		                'type'      => 'slider',
		                'title'     => esc_html__('Top bar overlay', 'g5plus-orson'),
		                'subtitle'  => esc_html__('Set the opacity level of the overlay.', 'g5plus-orson'),
		                'default'   => '0',
		                'min'       => 0,
		                'step'      => 1,
		                'max'       => 100,
		                'required'  => array(
			                array('top_bar_color_customize', '=', 1),
			                array('header_float', '=', 1),
		                ),
	                ),
	                array(
		                'id'       => 'top_bar_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top bar text color', 'g5plus-orson'),
		                'default'  => '#777',
		                'validate' => 'color',
		                'required'  => array('top_bar_color_customize', '=', 1),
	                ),
	                array(
		                'id'       => 'top_bar_border_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top bar border color', 'g5plus-orson'),
		                'default'  => '#eee',
		                'validate' => 'color',
		                'required'  => array('top_bar_color_customize', '=', 1),
	                ),

	                //--------------------------------------------------------------------
	                array(
		                'id' => 'section-theme-color-navigation-color',
		                'type' => 'section',
		                'title' => esc_html__('Navigation', 'g5plus-orson'),
		                'indent' => true
	                ),
	                $this->get_theme_color_enable('navigation_color_customize'),
	                array(
		                'id'       => 'navigation_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Navigation background color', 'g5plus-orson'),
		                'default'  => '#fff',
		                'validate' => 'color',
		                'required'  => array('navigation_color_customize', '=', 1),
	                ),
	                array(
		                'id'        => 'navigation_overlay',
		                'type'      => 'slider',
		                'title'     => esc_html__('Navigation overlay', 'g5plus-orson'),
		                'subtitle'  => esc_html__('Set the opacity level of the overlay.', 'g5plus-orson'),
		                'default'   => '0',
		                'min'       => 0,
		                'step'      => 1,
		                'max'       => 100,
		                'required'  => array(
			                array('header_float', '=', 1),
			                array('navigation_color_customize', '=', 1),
		                )
	                ),
	                array(
		                'id'       => 'navigation_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Navigation text color', 'g5plus-orson'),
		                'default'  => '#212121',
		                'validate' => 'color',
		                'required'  => array('navigation_color_customize', '=', 1),
	                ),
	                array(
		                'id'       => 'navigation_text_color_hover',
		                'type'     => 'color',
		                'title'    => esc_html__('Navigation text hover color', 'g5plus-orson'),
		                'default'  => '#34A853',
		                'validate' => 'color',
		                'required'  => array('navigation_color_customize', '=', 1),
	                ),

	                //--------------------------------------------------------------------
	                array(
		                'id' => 'section-theme-color-header-mobile',
		                'type' => 'section',
		                'title' => esc_html__('Header Mobile Color', 'g5plus-orson'),
		                'indent' => true
	                ),
	                array(
		                'id'       => 'top_bar_mobile_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top bar background color', 'g5plus-orson'),
		                'default'  => '#fff',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'top_bar_mobile_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top bar text color', 'g5plus-orson'),
		                'default'  => '#444',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'top_bar_mobile_border_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top bar border bottom color', 'g5plus-orson'),
		                'default'  => '#eee',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'header_mobile_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header background color', 'g5plus-orson'),
		                'default'  => '#fff',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'header_mobile_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header text color', 'g5plus-orson'),
		                'default'  => '#444',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'header_mobile_border_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header border bottom color', 'g5plus-orson'),
		                'default'  => '#eee',
		                'validate' => 'color',
	                ),

	                //--------------------------------------------------------------------
	                array(
		                'id' => 'section-theme-color-footer-color',
		                'type' => 'section',
		                'title' => esc_html__('Footer', 'g5plus-orson'),
		                'indent' => true
	                ),
	                array(
		                'id'       => 'footer_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Footer background color', 'g5plus-orson'),
		                'default'  => '#222',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'footer_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Footer text color', 'g5plus-orson'),
		                'default'  => '#ccc',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'footer_widget_title_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Footer widget title color', 'g5plus-orson'),
		                'default'  => '#fff',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'footer_border_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Footer border color', 'g5plus-orson'),
		                'default'  => '#373737',
		                'validate' => 'color',
	                ),
	                array(
		                'id' => 'section-theme-color-bottom-bar-color',
		                'type' => 'section',
		                'title' => esc_html__('Bottom Bar', 'g5plus-orson'),
		                'indent' => true
	                ),
	                array(
		                'id'       => 'bottom_bar_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Bottom bar background color', 'g5plus-orson'),
		                'default'  => '#2d2d2d',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'bottom_bar_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Bottom bar text color', 'g5plus-orson'),
		                'default'  => '#aaa',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'bottom_bar_border_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Bottom bar border color', 'g5plus-orson'),
		                'default'  => '#eee',
		                'validate' => 'color',
	                ),
                )
            );

	        // Font Options
            $this->sections[] = array(
                'icon' => 'el el-font',
                'title' => esc_html__('Font Options', 'g5plus-orson'),
                'desc'   => esc_html__( 'If you change value in this section, you must "Save & Generate CSS"', 'g5plus-orson' ),
                'fields' => array(
                    array(
                        'id'=>'body_font',
                        'type' => 'typography',
                        'title' => esc_html__('Body Font', 'g5plus-orson'),
                        'subtitle' => esc_html__('Specify the body font properties.', 'g5plus-orson'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'14px',
                            'font-family'=>'Roboto',
                            'font-weight'=>'400',
                            'google'      => true
                        ),
                    ),
	                array(
		                'id'=> 'secondary_font',
		                'type' => 'typography',
		                'title' => esc_html__('Secondary Font', 'g5plus-orson'),
		                'subtitle' => esc_html__('Specify the Secondary font properties.', 'g5plus-orson'),
		                'google' => true,
		                'fonts' => $fonts,
		                'line-height'=>false,
		                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
		                'color'=>false,
		                'text-align'=>false,
		                'font-style' => false,
		                'subsets' => false,
		                'font-size' => false,
		                'font-weight' => false,
		                'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
		                'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
		                'units'=> 'px', // Defaults to px
		                'default' => array(
			                'font-family'=>'Roboto Slab',
		                ),
	                ),

                    array(
                        'id'=>'h1_font',
                        'type' => 'typography',
                        'title' => esc_html__('H1 Font', 'g5plus-orson'),
                        'subtitle' => esc_html__('Specify the H1 font properties.', 'g5plus-orson'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'36px',
                            'font-family' => 'Roboto',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h2_font',
                        'type' => 'typography',
                        'title' => esc_html__('H2 Font', 'g5plus-orson'),
                        'subtitle' => esc_html__('Specify the H2 font properties.', 'g5plus-orson'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'30px',
                            'font-family' => 'Roboto',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h3_font',
                        'type' => 'typography',
                        'title' => esc_html__('H3 Font', 'g5plus-orson'),
                        'subtitle' => esc_html__('Specify the H3 font properties.', 'g5plus-orson'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'24px',
                            'font-family' => 'Roboto',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h4_font',
                        'type' => 'typography',
                        'title' => esc_html__('H4 Font', 'g5plus-orson'),
                        'subtitle' => esc_html__('Specify the H4 font properties.', 'g5plus-orson'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'20px',
                            'font-family' => 'Roboto',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h5_font',
                        'type' => 'typography',
                        'title' => esc_html__('H5 Font', 'g5plus-orson'),
                        'subtitle' => esc_html__('Specify the H5 font properties.', 'g5plus-orson'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'16px',
                            'font-family' => 'Roboto',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h6_font',
                        'type' => 'typography',
                        'title' => esc_html__('H6 Font', 'g5plus-orson'),
                        'subtitle' => esc_html__('Specify the H6 font properties.', 'g5plus-orson'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'14px',
                            'font-family' => 'Roboto',
                            'font-weight'=>'400',
                        ),
                    ),
                ),
            );

	        // Social Profiles
            $this->sections[] = array(
                'title'  => esc_html__( 'Social Profiles', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-path',
                'fields' => array_merge(g5plus_get_social_profiles(), array(
	                array(
		                'id'=>'social-profile-divide-0',
		                'type' => 'divide'
	                ),
	                array(
		                'title'    => esc_html__('Social Share', 'g5plus-orson'),
		                'id'       => 'social_sharing',
		                'type'     => 'checkbox',
		                'subtitle' => esc_html__('Show the social sharing in single blog and single product', 'g5plus-orson'),

		                //Must provide key => value pairs for multi checkbox options
		                'options'  => array(
			                'facebook' => 'Facebook',
			                'twitter' => 'Twitter',
			                'google' => 'Google',
			                'linkedin' => 'Linkedin',
			                'tumblr' => 'Tumblr',
			                'pinterest' => 'Pinterest'
		                ),

		                //See how default has changed? you also don't need to specify opts that are 0.
		                'default' => array(
			                'facebook' => '1',
			                'twitter' => '1',
			                'google' => '1',
			                'linkedin' => '1',
			                'tumblr' => '1',
			                'pinterest' => '1'
		                )
	                )
                ))
            );

	        // Woocommerce
            $this->sections[] = array(
                'title'  =>  esc_html__( 'Woocommerce', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-shopping-cart',
                'fields' => array(

	                $this->get_section_start('woocommerce_general',esc_html__('General','g5plus-orson')),
	                array(
		                'id'       => 'product_featured_label_enable',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show Featured Label', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => 1
	                ),

	                array(
		                'id'       => 'product_featured_label_text',
		                'type'     => 'text',
		                'title'    => esc_html__( 'Featured Label Text', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'default'  => 'Hot',
		                'required'  => array('product_featured_label_enable', '=', 1),
	                ),

	                array(
		                'id'       => 'product_sale_label_enable',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show Sale Label', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => 1
	                ),

	                array(
		                'id'       => 'product_sale_flash_mode',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Sale Flash Mode', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => array(
			                'text' => esc_html__('Text','g5plus-orson'),
			                'percent' => esc_html__('Percent','g5plus-orson')
		                ),
		                'default'  => 'percent',
		                'required'  => array('product_sale_label_enable', '=', 1),
	                ),

	                array(
		                'id'       => 'product_sale_label_text',
		                'type'     => 'text',
		                'title'    => esc_html__( 'Sale Label Text', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'default'  => 'Sale',
		                'required'  => array(
			                array('product_featured_label_enable', '=', 1),
			                array('product_sale_flash_mode', '=', 'text'),
		                )
	                ),


	                array(
		                'id'       => 'product_sale_count_down_enable',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show Sale Count Down', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => 0
	                ),


	                array(
		                'id'       => 'product_add_to_cart_enable',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show Add To Cart Button', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => 1
	                ),


	                $this->get_section_start('archive_product_banner',esc_html__('Banner Shop and Category Page','g5plus-orson')),


	                array(
		                'id'       => 'archive_product_banner_layout',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Banner Layout', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_archive_product_banner_layout(),
		                'default'  => 'container',
	                ),

	                array(
		                'id'       => 'archive_product_banner_type',
		                'type'     => 'radio',
		                'title'    => esc_html__( 'Banner Type', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_archive_product_banner_type(),
		                'default'  => '',
	                ),



	                array(
		                'id'       => 'archive_product_banner_image',
		                'type'     => 'media',
		                'url'      => true,
		                'title'    => esc_html__('Banner Image', 'g5plus-orson'),
		                'default'  => '',
		                'required'  => array('archive_product_banner_type', '=', 'image')
	                ),

	                array(
		                'id'       => 'archive_product_banner_video',
		                'type'     => 'textarea',
		                'url'      => true,
		                'title'    => esc_html__('Banner Video', 'g5plus-orson'),
		                'subtitle' => esc_html__('Video url (oembed) or embed code', 'g5plus-orson'),
		                'default'  => '',
		                'required'  => array('archive_product_banner_type', '=', 'video')
	                ),

	                array(
		                'id'       => 'archive_product_banner_rev_slider',
		                'type'     => 'select',
		                'url'      => true,
		                'title'    => esc_html__('Revolution Slider', 'g5plus-orson'),
		                'options'  => g5plus_get_rev_slider(),
		                'placeholder' => esc_html__('Select slider','g5plus-orson'),
		                'default'  => '-1',
		                'required'  => array('archive_product_banner_type', '=', 'rev_slider')
	                ),

	                $this->get_section_start('archive_product',esc_html__('Shop and Category Page','g5plus-orson')),
	                array(
		                'id'       => 'product_catalog_style',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Product Catalog Style', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_product_catalog_style(),
		                'default'  => 'left'
	                ),

	                array(
		                'id' => 'product_display_columns',
		                'type' => 'select',
		                'title' => esc_html__('Product Display Columns', 'g5plus-orson'),
		                'subtitle' => esc_html__('Choose the number of columns to display on shop/category pages.','g5plus-orson'),
		                'options' => array(
			                '2'		=> '2',
			                '3'		=> '3',
			                '4'		=> '4',
			                '5'       => '5'
		                ),
		                'desc' => '',
		                'default' => '3',
		                'select2' => array('allowClear' =>  false) ,
	                ),

	                array(
		                'id' => 'product_display_column_gap',
		                'type' => 'button_set',
		                'title' => esc_html__('Product Display Column Gap', 'g5plus-orson'),
		                'subtitle' => esc_html__('Select gap between columns .','g5plus-orson'),
		                'options' => array(
			                ''		=> '20px',
			                '15'		=> '15px',
		                ),
		                'desc' => '',
		                'default' => '',
		                'select2' => array('allowClear' =>  false) ,
	                ),



	                array (
		                'id' => 'product_per_page',
		                'type' => 'text',
		                'title'     => esc_html__('Products Per Page', 'g5plus-orson'),
		                'compiler' => true,
		                'validate' => 'comma_numeric',
		                'description' => esc_html__( 'Comma-seperated. Default: 12,24,36', 'g5plus-orson' ),
		                'default' => '12,24,36'
	                ),

	                array(
		                'id'       => 'product_image_hover_effect',
		                'type'     => 'select',
		                'select2' => array('allowClear' => false),
		                'title'    => esc_html__( 'Product Image Hover Effect', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_product_image_hover_effect(),
		                'default'  => 'change-image'
	                ),

	                array(
		                'id'       => 'product_category_enable',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show Category', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => 0
	                ),

	                array(
		                'id'       => 'product_rating_enable',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show Rating', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => 1
	                ),

	                array(
		                'id'       => 'product_quick_view_enable',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show Quick View', 'g5plus-orson' ),
		                'subtitle' => '',
		                'desc'     => '',
		                'options'  => g5plus_get_toggle(),
		                'default'  => 1
	                ),

	                $this->get_section_start('single_product',esc_html__('Single Product','g5plus-orson')),
	                array(
		                'id'        => 'product_apply_setting',
		                'type'      => 'select',
		                'title'     => esc_html__('Product Single Apply Setting', 'g5plus-orson'),
		                'data'  => 'page',
		                'default'   => '',
	                ),
	                array(
		                'id'       => 'related_product_count',
		                'type'     => 'text',
		                'title'    => esc_html__('Related Product Total Record', 'g5plus-orson'),
		                'subtitle' => esc_html__('Total Record Of Related Product.', 'g5plus-orson'),
		                'validate' => 'number',
		                'default'  => '6',
	                ),

	                array(
		                'id' => 'related_product_display_columns',
		                'type' => 'select',
		                'select2' => array('allowClear' => false),
		                'title' => esc_html__('Related Product Display Columns', 'g5plus-orson'),
		                'subtitle' => esc_html__('Choose the number of columns to display on related product.','g5plus-orson'),
		                'options' => array(
			                '3'		=> '3',
			                '4'		=> '4',
			                '5'		=> '5',
		                ),
		                'desc' => '',
		                'default' => '4'
	                ),

	                array(
		                'id' => 'related_product_condition',
		                'type' => 'checkbox',
		                'title' => esc_html__('Related Product Condition', 'g5plus-orson'),
		                'options' => array(
			                'category' => esc_html__('Same Category','g5plus-orson'),
			                'tag' => esc_html__('Same Tag','g5plus-orson'),
		                ),
		                'default' => array(
			                'category'      => '1',
			                'tag'      => '1',
		                ),
	                ),

	                array(
		                'id' => 'up_sells_product_display_columns',
		                'type' => 'select',
		                'select2' => array('allowClear' => false),
		                'title' => esc_html__('Up Sells Product Display Columns', 'g5plus-orson'),
		                'subtitle' => esc_html__('Choose the number of columns to display on up sells product.','g5plus-orson'),
		                'options' => array(
			                '3'		=> '3',
			                '4'		=> '4',
			                '5'		=> '5',
		                ),
		                'desc' => '',
		                'default' => '4'
	                ),
	                $this->get_section_start('cart_pages',esc_html__('Cart Page','g5plus-orson')),
	                array(
		                'id'       => 'cross_sells_product_count',
		                'type'     => 'text',
		                'title'    => esc_html__('Cross Sells Product Total Record', 'g5plus-orson'),
		                'subtitle' => esc_html__('Total Record Of Cross Sells Product.', 'g5plus-orson'),
		                'validate' => 'number',
		                'default'  => '6',
	                ),

	                array(
		                'id' => 'cross_sells_product_display_columns',
		                'type' => 'select',
		                'select2' => array('allowClear' => false),
		                'title' => esc_html__('Cross Sells Product Display Columns', 'g5plus-orson'),
		                'subtitle' => esc_html__('Choose the number of columns to display on cross sells product.','g5plus-orson'),
		                'options' => array(
			                '3'		=> '3',
			                '4'		=> '4',
			                '5'		=> '5',
		                ),
		                'desc' => '',
		                'default' => '4'
	                ),

                )
            );

			// Custom Post Type
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom Post Type', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-screenshot',
                'fields' => array(
                    array(
                        'id' => 'cpt_disable',
                        'type' => 'checkbox',
                        'title' => esc_html__('Disable Custom Post Types', 'g5plus-orson'),
                        'subtitle' => esc_html__('You can disable the custom post types used within the theme here, by checking the corresponding box. NOTE: If you do not want to disable any, then make sure none of the boxes are checked.', 'g5plus-orson'),
                        'options' => array(
                            'portfolio' => esc_html__('Portfolio','g5plus-orson'),
                            'ourteam' => esc_html__('Our Team','g5plus-orson'),
                        ),
                        'default' => array(
                            'portfolio' => '0',
                            'ourteam' => '0'
                        )
                    ),
                )
            );

	        $this->sections[] = array(
		        'title'  => esc_html__( 'OurTeam', 'g5plus-orson' ),
		        'desc'   => '',
		        'icon'   => 'el el-user',
		        'subsection' => true,
		        'fields' => array(
			        $this->get_section_start('archive_ourteam',esc_html__('Archive Page','g5plus-orson')),
					array(
						'id' => 'custom_ourteam_layout_style',
						'type' => 'select',
						'select2' => array('allowClear' => false),
						'title' => esc_html__('Layout Style', 'g5plus-orson'),
						'subtitle' => esc_html__('Select layout style.', 'g5plus-orson'),
						'desc' => '',
						'default' => 'style1',
						'options'  => array(
							'style1' => esc_html__('Default', 'g5plus-orson'),
							'style2' => esc_html__('Excerpt hide', 'g5plus-orson')
						)
					),
			        array(
				        'id' => 'custom_ourteam_slider',
				        'type' => 'button_set',
				        'title' => esc_html__('Is Slider?', 'g5plus-orson'),
				        'default' => 0,
				        'options'  => g5plus_get_toggle()
			        ),
					array(
						'id' => 'custom_ourteam_tab',
						'type' => 'button_set',
						'title' => esc_html__('Show Category?', 'g5plus-orson'),
						'subtitle' => esc_html__('Show OurTeam Categories As Tabs.', 'g5plus-orson'),
						'default' => 1,
						'options'  => g5plus_get_toggle()
					),
					array(
						'id' => 'custom_ourteam_column',
						'type' => 'select',
						'select2' => array('allowClear' => false),
						'title' => esc_html__('Column(s)', 'g5plus-orson'),
						'default' => '4',
						'options'  => array( '2' => '2' , '3' => '3','4' => '4' )
					),
					array(
						'id' => 'custom_ourteam_paging',
						'type' => 'select',
						'select2' => array('allowClear' => false),
						'title' => esc_html__('Page Paging', 'g5plus-orson'),
						'default' => '',
						'options'  => array(
							'' => esc_html__('Show all', 'g5plus-orson'),
							'load-more' => esc_html__('Load more', 'g5plus-orson')
						),
						'required' => array('custom_ourteam_slider', '=', 0)
					),
					array(
						'id' => 'custom_ourteam_post_per_page',
						'type' => 'text',
						'title' => esc_html__('Post per Page', 'g5plus-orson'),
						'default' => 8,
						'required'  => array('custom_ourteam_paging', '=', 'load-more')
					),
		        )
	        );

			$this->sections[] = array(
				'title'  => esc_html__( 'Portfolio', 'g5plus-orson' ),
				'desc'   => '',
				'icon'   => 'el el-th-large',
				'subsection' => true,
				'fields' => array(
					$this->get_section_start('archive_portfolio',esc_html__('Archive Page','g5plus-orson')),
					array(
						'id' => 'custom_portfolio_layout_style',
						'type'     => 'button_set',
						'title' => esc_html__('Layout Style', 'g5plus-orson'),
						'subtitle' => esc_html__('Select layout style.', 'g5plus-orson'),
						'desc' => '',
						'default'  => 'portfolio-grid',
						'options'  => array(
							'portfolio-grid'    => esc_html__('Grid', 'g5plus-orson'),
							'portfolio-slider' => esc_html__('Slider', 'g5plus-orson')
						)
					),
					array(
						'id'      => 'custom_portfolio_cate',
						'type'    => 'select',
						'select2' => array('allowClear' => false),
						'title' => esc_html__('Show Category?', 'g5plus-orson'),
						'default' => '',
						'options' => array(
							''       => esc_html__('None', 'g5plus-orson'),
							'left'   => esc_html__('Show in left', 'g5plus-orson'),
							'center' => esc_html__('Show in center', 'g5plus-orson')
						)
					),
					array(
						'type' => 'button_set',
						'title'    => esc_html__('Category diplay style', 'g5plus-orson'),
						'id'       => 'custom_portfolio_category_display',
						'options'  => array(
							''     => esc_html__('As button', 'g5plus-orson'),
							'-tab' => esc_html__('As tab', 'g5plus-orson')
						),
						'default'  => '',
						'required' => array('custom_portfolio_cate', '=', array('left', 'center'))
					),
					array(
						'id' => 'custom_portfolio_column',
						'type' => 'select',
						'select2' => array('allowClear' => false),
						'title' => esc_html__('Column(s)', 'g5plus-orson'),
						'default' => '4',
						'options'  => array( '2' => '2' , '3' => '3','4' => '4' )
					),
					array(
						'id' => 'custom_portfolio_paging',
						'type' => 'button_set',
						'title' => esc_html__('Page Paging', 'g5plus-orson'),
						'default' => '',
						'options'  => array(
							'' => esc_html__('Show all', 'g5plus-orson'),
							'load-more' => esc_html__('Load more', 'g5plus-orson')
						),
						'required' => array('custom_portfolio_layout_style', '=', 'portfolio-grid')
					),
					array(
						'id' => 'custom_portfolio_post_per_page',
						'type' => 'text',
						'title' => esc_html__('Post per Page', 'g5plus-orson'),
						'default' => 8,
						'required'  => array('custom_portfolio_paging', '=', 'load-more')
					),
					array(
						'type'    => 'select',
						'select2' => array('allowClear' => false),
						'title'   => esc_html__('Overlay Style', 'g5plus-orson'),
						'id'      => 'custom_portfolio_overlay_style',
						'options' => array(
							'portfolio-overlay-none'                => esc_html__('None', 'g5plus-orson'),
							'portfolio-overlay-title-category'      => esc_html__('Title - Category', 'g5plus-orson'),
							'portfolio-overlay-title-category-icon' => esc_html__('Title - Category - Zoom icon', 'g5plus-orson'),
						)
					),
					array(
						'type'     => 'select',
						'title'    => esc_html__('Hover effect', 'g5plus-orson'),
						'id'       => 'custom_portfolio_hover_effect',
						'default'  => 'default-effect',
						'options'  => array(
							'default-effect' => esc_html__('Default', 'g5plus-orson'),
							'layla-effect'   => esc_html__('Layla', 'g5plus-orson'),
							'bubba-effect'   => esc_html__('Bubba', 'g5plus-orson'),
							'jazz-effect'    => esc_html__('Jazz', 'g5plus-orson'),
						),
						'required' => array('custom_portfolio_overlay_style', '=', array('portfolio-overlay-title-category-icon', 'portfolio-overlay-title-category'))
					),
					array(
						'type' => 'button_set',
						'title'    => esc_html__('Zoom icon color scheme', 'g5plus-orson'),
						'id'       => 'custom_portfolio_icon_color_scheme',
						'options'  => array(
							'icon-color-dark'  => esc_html__('Dark', 'g5plus-orson'),
							'icon-color-light' => esc_html__('Light', 'g5plus-orson')
						),
						'required' => array('custom_portfolio_overlay_style', '=', 'portfolio-overlay-title-category-icon')
					),
					array(
						'type' => 'button_set',
						'title'   => esc_html__('Padding', 'g5plus-orson'),
						'id'      => 'custom_portfolio_column_padding',
						'default' => '',
						'options' => array(
							''     => esc_html__('No padding', 'g5plus-orson'),
							'20px' => '20 px'
						)
					),
					array(
						'type'    => 'select',
						'title'   => esc_html__('Image size', 'g5plus-orson'),
						'id'      => 'custom_portfolio_image_size',
						'options' => array(
							'portfolio-size1' => '270x185',
							'portfolio-size2' => '370x250',
							'portfolio-size3' => '480x300',
							'portfolio-size4' => '480x424',
							'portfolio-size5' => '565x380',
							'portfolio-size6' => '640x400'
						)
					),
					$this->get_section_start('single_portfolio', esc_html__('Single Page', 'g5plus-orson')),
					array(
						'id'       => 'portfolio-single-style',
						'type'     => 'image_select',
						'title'    => esc_html__('Single Portfolio Layout', 'g5plus-orson'),
						'subtitle' => esc_html__('Select Single Portfolio Layout', 'g5plus-orson'),
						'desc'     => '',
						'options'  => array(
							'single-image' => array(
								'title' => '',
								'img'   => G5PLUS_THEME_URL . 'assets/images/theme-options/portfolio-single-image.jpg'
							),
							'horizontal-slider' => array(
								'title' => '',
								'img'   => G5PLUS_THEME_URL . 'assets/images/theme-options/portfolio-horizontal-slider.jpg'
							),
							'video-layout' => array(
								'title' => '',
								'img'   => G5PLUS_THEME_URL . 'assets/images/theme-options/portfolio-video-layout.jpg'
							),
							'two-columns' => array(
								'title' => '',
								'img'   => G5PLUS_THEME_URL . 'assets/images/theme-options/portfolio-two-columns.jpg'
							),
						),
						'default'  => 'single-image'
					),
					array(
						'id'      => 'show_portfolio_related',
						'type'    => 'button_set',
						'title'   => esc_html__('Show Portfolio Related?', 'g5plus-orson'),
						'default' => 1,
						'options' => g5plus_get_toggle(),
						'desc'    => '',
					),
					array(
						'id'       => 'portfolio_related_column',
						'type'     => 'select',
						'select2' => array('allowClear' => false),
						'title'    => esc_html__('Portfolio Related Columns', 'g5plus-orson'),
						'default'  => 4,
						'options'  => array(
							'2' => '2',
							'3' => '3',
							'4' => '4'
						),
						'required' => array('show_portfolio_related', '=', 1)
					),
					array(
						'type'    => 'select',
						'title'   => esc_html__('Portfolio Related Image Size', 'g5plus-orson'),
						'id'      => 'custom_portfolio_related_image_size',
						'options' => array(
							'portfolio-size1' => '270x185',
							'portfolio-size2' => '370x250',
							'portfolio-size3' => '480x300'
						)
					),
				)
			);

            $this->sections[] = array(
                'title'  => esc_html__( 'Resources Options', 'g5plus-orson' ),
                'desc'   => '',
                'icon'   => 'el el-th-large',
                'fields' => array(
                    array(
                        'id'        => 'cdn_bootstrap_js',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Bootstrap Script', 'g5plus-orson'),
                        'subtitle'  => esc_html__('Url CDN Bootstrap Script', 'g5plus-orson'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_bootstrap_css',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Bootstrap Stylesheet', 'g5plus-orson'),
                        'subtitle'  => esc_html__('Url CDN Bootstrap Stylesheet', 'g5plus-orson'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_font_awesome',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Font Awesome', 'g5plus-orson'),
                        'subtitle'  => esc_html__('Url CDN Font Awesome', 'g5plus-orson'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                )
            );
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom CSS & Script', 'g5plus-orson' ),
                'desc'   => esc_html__( 'If you change Custom CSS, you must "Save & Generate CSS"', 'g5plus-orson' ),
                'icon'   => 'el el-edit',
                'fields' => array(
                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'title' => esc_html__('Custom CSS', 'g5plus-orson'),
                        'subtitle' => esc_html__('Add some CSS to your theme by adding it to this textarea. Please do not include any style tags.', 'g5plus-orson'),
                        'desc' => '',
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'title' => esc_html__('Custom JS', 'g5plus-orson'),
                        'subtitle' => esc_html__('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', 'g5plus-orson'),
                        'desc' => '',
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),

                )
            );
        }

        public function setHelpTabs() {
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'           => 'g5plus_orson_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'       => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'    => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'          => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'     => true,
                // Show the sections below the admin menu item or not
                'menu_title'         => esc_html__( 'Theme Options', 'g5plus-orson' ),
                'page_title'         => esc_html__( 'Theme Options', 'g5plus-orson' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'     => '',
                // Must be defined to add google fonts to the typography module

                'async_typography'   => false,
                // Use a asynchronous font on the front end or font string
                'admin_bar'          => true,
                // Show the panel pages on the admin bar
                'global_variable'    => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'           => false,
                // Show the time the page took to load, etc
                'customizer'         => true,
                // Enable basic customizer support

                // OPTIONAL -> Give you extra features
                'page_priority'      => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'        => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_theme_page#Parameters
                'page_permissions'   => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'          => '',
                // Specify a custom URL to an icon
                'last_tab'           => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'          => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'          => '_options',
                // Page slug used to denote the panel
                'save_defaults'      => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'       => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'       => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'     => 60 * MINUTE_IN_SECONDS,
                'output'             => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'         => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'           => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'        => false,
                // REMOVE

                // HINTS
                'hints'              => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'light',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                )
            );

            // Panel Intro text -> before the form
            if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                if ( ! empty( $this->args['global_variable'] ) ) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace( '-', '_', $this->args['opt_name'] );
                }
                $this->args['intro_text'] = sprintf( wp_kses_post(__( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'g5plus-orson' )), $v );
            } else {
                $this->args['intro_text'] = wp_kses_post(__( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'g5plus-orson' ));
            }
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_options_config();
}