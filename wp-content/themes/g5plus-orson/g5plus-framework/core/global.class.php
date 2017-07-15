<?php
/**
 * GLOBAL VARIABLE
 */
if (!class_exists('G5Plus_Global')) {
	class G5Plus_Global
	{

		public static $key_page_layout = 'g5plus_page_layout';
		public static $key_post_layout = 'g5plus_post_layout';
		public static $key_page_title_layout = 'g5plus_page_title_layout';

		// GET/SET layout
		public static function &get_page_layout()
		{
			if (isset($GLOBALS[G5Plus_Global::$key_page_layout]) && is_array($GLOBALS[G5Plus_Global::$key_page_layout])) {
				return $GLOBALS[G5Plus_Global::$key_page_layout];
			}
			$GLOBALS[G5Plus_Global::$key_page_layout] = G5Plus_Global::get_page_layout_default();

			return $GLOBALS[G5Plus_Global::$key_page_layout];
		}

		public static function set_page_layout($args)
		{
			$default = G5Plus_Global::get_page_layout_default();
			$GLOBALS[G5Plus_Global::$key_page_layout] = array_merge($default, $args);
		}

		public static function get_page_layout_default()
		{
			return array(
				'layout'                 => G5Plus_Global::get_option( 'layout' ),
				'sidebar_layout'         => G5Plus_Global::get_option( 'sidebar_layout' ),
				'sidebar'                => G5Plus_Global::get_option( 'sidebar' ),
				'sidebar_width'          => G5Plus_Global::get_option( 'sidebar_width' ),
				'sidebar_mobile_enable'  => G5Plus_Global::get_option( 'sidebar_mobile_enable' ),
				'sidebar_mobile_canvas'  => G5Plus_Global::get_option( 'sidebar_mobile_canvas' ),
				'padding'                => G5Plus_Global::get_option( 'content_padding' ),
				'padding_mobile'         => G5Plus_Global::get_option( 'content_padding_mobile' ),
				'remove_content_padding' => ''
			);
		}

		// GET/SET Post Layout
		public static function &get_post_layout()
		{
			if (isset($GLOBALS[G5Plus_Global::$key_post_layout]) && is_array($GLOBALS[G5Plus_Global::$key_post_layout])) {
				return $GLOBALS[G5Plus_Global::$key_post_layout];
			}
			$GLOBALS[G5Plus_Global::$key_post_layout] = G5Plus_Global::get_post_layout_default();

			return $GLOBALS[G5Plus_Global::$key_post_layout];
		}

		public static function  set_post_layout($args)
		{
			$default = G5Plus_Global::get_post_layout_default();
			$GLOBALS[G5Plus_Global::$key_post_layout] = array_merge($default, $args);
		}

		public static function get_post_layout_default()
		{
			return array(
				'layout'      => G5Plus_Global::get_option('post_layout'),
				'post_column' => G5Plus_Global::get_option('post_column'),
				'paging'      => G5Plus_Global::get_option('post_paging')
			);
		}

		// GET/SET Page Title Layout

		public static function &get_page_title_layout()
		{
			if (isset($GLOBALS[G5Plus_Global::$key_page_title_layout]) && is_array($GLOBALS[G5Plus_Global::$key_page_title_layout])) {
				return $GLOBALS[G5Plus_Global::$key_page_title_layout];
			}
			$GLOBALS[G5Plus_Global::$key_page_title_layout] = G5Plus_Global::get_page_title_layout_default();

			return $GLOBALS[G5Plus_Global::$key_page_title_layout];
		}

		public static function  set_page_title_layout($args)
		{
			$default = G5Plus_Global::get_page_title_layout_default();
			$GLOBALS[G5Plus_Global::$key_page_title_layout] = array_merge($default, $args);
		}

		public static function get_page_title_layout_default()
		{
			return array(
				'page_title_enable'  => G5Plus_Global::get_option('page_title_enable'),
				'layout'             => G5Plus_Global::get_option('page_title_layout'),
				'title'              => '',
				'sub_title'          => G5Plus_Global::get_option('page_sub_title'),
				'padding'            => G5Plus_Global::get_option('page_title_padding'),
				'background-image'   => G5Plus_Global::get_option('page_title_bg_image'),
				'parallax'           => G5Plus_Global::get_option('page_title_parallax'),
				'breadcrumbs_enable' => G5Plus_Global::get_option('breadcrumbs_enable')
			);
		}


		// GET OPTION KEY VALUE
		public static function get_option($key, $default = null)
		{
			if (isset($GLOBALS['g5plus_orson_options']) && isset($GLOBALS['g5plus_orson_options'][$key])) {
				return $GLOBALS['g5plus_orson_options'][$key];
			}

			return $default;
		}

		public static function &get_options()
		{
			if (isset($GLOBALS['g5plus_orson_options']) && is_array($GLOBALS['g5plus_orson_options'])) {
				return $GLOBALS['g5plus_orson_options'];
			}
			$GLOBALS['g5plus_orson_options'] = array();

			return $GLOBALS['g5plus_orson_options'];
		}

		//==============================================================================
		// GET $wp_version
		//==============================================================================
		public static function &get_wp_version()
		{
			global $wp_version;

			return $wp_version;
		}

		//==============================================================================
		// GET $wpdb
		//==============================================================================
		public static function &get_wpdb()
		{
			global $wpdb;

			return $wpdb;
		}

		//==============================================================================
		// GET $wp_query
		//==============================================================================
		public static function &get_wp_query()
		{
			global $wp_query;

			return $wp_query;
		}

		public static function &get_wp_rewrite()
		{
			global $wp_rewrite;

			return $wp_rewrite;
		}


		// Fonts Icon
		public static function &theme_font_icon()
		{
			if (isset($GLOBALS['g5plus_theme_icons']) && is_array($GLOBALS['g5plus_theme_icons'])) {
				return $GLOBALS['g5plus_theme_icons'];
			}
			$GLOBALS['g5plus_theme_icons'] = array(
				array('pe-7s-album' => 'pe-7s-album'), array('pe-7s-arc' => 'pe-7s-arc'), array('pe-7s-back-2' => 'pe-7s-back-2'), array('pe-7s-bandaid' => 'pe-7s-bandaid'), array('pe-7s-car' => 'pe-7s-car'), array('pe-7s-diamond' => 'pe-7s-diamond'), array('pe-7s-door-lock' => 'pe-7s-door-lock'), array('pe-7s-eyedropper' => 'pe-7s-eyedropper'), array('pe-7s-female' => 'pe-7s-female'), array('pe-7s-gym' => 'pe-7s-gym'), array('pe-7s-hammer' => 'pe-7s-hammer'), array('pe-7s-headphones' => 'pe-7s-headphones'), array('pe-7s-helm' => 'pe-7s-helm'), array('pe-7s-hourglass' => 'pe-7s-hourglass'), array('pe-7s-leaf' => 'pe-7s-leaf'), array('pe-7s-magic-wand' => 'pe-7s-magic-wand'), array('pe-7s-male' => 'pe-7s-male'), array('pe-7s-map-2' => 'pe-7s-map-2'), array('pe-7s-next-2' => 'pe-7s-next-2'), array('pe-7s-paint-bucket' => 'pe-7s-paint-bucket'), array('pe-7s-pendrive' => 'pe-7s-pendrive'), array('pe-7s-photo' => 'pe-7s-photo'), array('pe-7s-piggy' => 'pe-7s-piggy'), array('pe-7s-plugin' => 'pe-7s-plugin'), array('pe-7s-refresh-2' => 'pe-7s-refresh-2'), array('pe-7s-rocket' => 'pe-7s-rocket'), array('pe-7s-settings' => 'pe-7s-settings'), array('pe-7s-shield' => 'pe-7s-shield'), array('pe-7s-smile' => 'pe-7s-smile'), array('pe-7s-usb' => 'pe-7s-usb'), array('pe-7s-vector' => 'pe-7s-vector'), array('pe-7s-wine' => 'pe-7s-wine'), array('pe-7s-cloud-upload' => 'pe-7s-cloud-upload'), array('pe-7s-cash' => 'pe-7s-cash'), array('pe-7s-close' => 'pe-7s-close'), array('pe-7s-bluetooth' => 'pe-7s-bluetooth'), array('pe-7s-cloud-download' => 'pe-7s-cloud-download'), array('pe-7s-way' => 'pe-7s-way'), array('pe-7s-close-circle' => 'pe-7s-close-circle'), array('pe-7s-id' => 'pe-7s-id'), array('pe-7s-angle-up' => 'pe-7s-angle-up'), array('pe-7s-wristwatch' => 'pe-7s-wristwatch'), array('pe-7s-angle-up-circle' => 'pe-7s-angle-up-circle'), array('pe-7s-world' => 'pe-7s-world'), array('pe-7s-angle-right' => 'pe-7s-angle-right'), array('pe-7s-volume' => 'pe-7s-volume'), array('pe-7s-angle-right-circle' => 'pe-7s-angle-right-circle'), array('pe-7s-users' => 'pe-7s-users'), array('pe-7s-angle-left' => 'pe-7s-angle-left'), array('pe-7s-user-female' => 'pe-7s-user-female'), array('pe-7s-angle-left-circle' => 'pe-7s-angle-left-circle'), array('pe-7s-up-arrow' => 'pe-7s-up-arrow'), array('pe-7s-angle-down' => 'pe-7s-angle-down'), array('pe-7s-switch' => 'pe-7s-switch'), array('pe-7s-angle-down-circle' => 'pe-7s-angle-down-circle'), array('pe-7s-scissors' => 'pe-7s-scissors'), array('pe-7s-wallet' => 'pe-7s-wallet'), array('pe-7s-safe' => 'pe-7s-safe'), array('pe-7s-volume2' => 'pe-7s-volume2'), array('pe-7s-volume1' => 'pe-7s-volume1'), array('pe-7s-voicemail' => 'pe-7s-voicemail'), array('pe-7s-video' => 'pe-7s-video'), array('pe-7s-user' => 'pe-7s-user'), array('pe-7s-upload' => 'pe-7s-upload'), array('pe-7s-unlock' => 'pe-7s-unlock'), array('pe-7s-umbrella' => 'pe-7s-umbrella'), array('pe-7s-trash' => 'pe-7s-trash'), array('pe-7s-tools' => 'pe-7s-tools'), array('pe-7s-timer' => 'pe-7s-timer'), array('pe-7s-ticket' => 'pe-7s-ticket'), array('pe-7s-target' => 'pe-7s-target'), array('pe-7s-sun' => 'pe-7s-sun'), array('pe-7s-study' => 'pe-7s-study'), array('pe-7s-stopwatch' => 'pe-7s-stopwatch'), array('pe-7s-star' => 'pe-7s-star'), array('pe-7s-speaker' => 'pe-7s-speaker'), array('pe-7s-signal' => 'pe-7s-signal'), array('pe-7s-shuffle' => 'pe-7s-shuffle'), array('pe-7s-shopbag' => 'pe-7s-shopbag'), array('pe-7s-share' => 'pe-7s-share'), array('pe-7s-server' => 'pe-7s-server'), array('pe-7s-search' => 'pe-7s-search'), array('pe-7s-film' => 'pe-7s-film'), array('pe-7s-science' => 'pe-7s-science'), array('pe-7s-disk' => 'pe-7s-disk'), array('pe-7s-ribbon' => 'pe-7s-ribbon'), array('pe-7s-repeat' => 'pe-7s-repeat'), array('pe-7s-refresh' => 'pe-7s-refresh'), array('pe-7s-add-user' => 'pe-7s-add-user'), array('pe-7s-refresh-cloud' => 'pe-7s-refresh-cloud'), array('pe-7s-paperclip' => 'pe-7s-paperclip'), array('pe-7s-radio' => 'pe-7s-radio'), array('pe-7s-note2' => 'pe-7s-note2'), array('pe-7s-print' => 'pe-7s-print'), array('pe-7s-network' => 'pe-7s-network'), array('pe-7s-prev' => 'pe-7s-prev'), array('pe-7s-mute' => 'pe-7s-mute'), array('pe-7s-power' => 'pe-7s-power'), array('pe-7s-medal' => 'pe-7s-medal'), array('pe-7s-portfolio' => 'pe-7s-portfolio'), array('pe-7s-like2' => 'pe-7s-like2'), array('pe-7s-plus' => 'pe-7s-plus'), array('pe-7s-left-arrow' => 'pe-7s-left-arrow'), array('pe-7s-play' => 'pe-7s-play'), array('pe-7s-key' => 'pe-7s-key'), array('pe-7s-plane' => 'pe-7s-plane'), array('pe-7s-joy' => 'pe-7s-joy'), array('pe-7s-photo-gallery' => 'pe-7s-photo-gallery'), array('pe-7s-pin' => 'pe-7s-pin'), array('pe-7s-phone' => 'pe-7s-phone'), array('pe-7s-plug' => 'pe-7s-plug'), array('pe-7s-pen' => 'pe-7s-pen'), array('pe-7s-right-arrow' => 'pe-7s-right-arrow'), array('pe-7s-paper-plane' => 'pe-7s-paper-plane'), array('pe-7s-delete-user' => 'pe-7s-delete-user'), array('pe-7s-paint' => 'pe-7s-paint'), array('pe-7s-bottom-arrow' => 'pe-7s-bottom-arrow'), array('pe-7s-notebook' => 'pe-7s-notebook'), array('pe-7s-note' => 'pe-7s-note'), array('pe-7s-next' => 'pe-7s-next'), array('pe-7s-news-paper' => 'pe-7s-news-paper'), array('pe-7s-musiclist' => 'pe-7s-musiclist'), array('pe-7s-music' => 'pe-7s-music'), array('pe-7s-mouse' => 'pe-7s-mouse'), array('pe-7s-more' => 'pe-7s-more'), array('pe-7s-moon' => 'pe-7s-moon'), array('pe-7s-monitor' => 'pe-7s-monitor'), array('pe-7s-micro' => 'pe-7s-micro'), array('pe-7s-menu' => 'pe-7s-menu'), array('pe-7s-map' => 'pe-7s-map'), array('pe-7s-map-marker' => 'pe-7s-map-marker'), array('pe-7s-mail' => 'pe-7s-mail'), array('pe-7s-mail-open' => 'pe-7s-mail-open'), array('pe-7s-mail-open-file' => 'pe-7s-mail-open-file'), array('pe-7s-magnet' => 'pe-7s-magnet'), array('pe-7s-loop' => 'pe-7s-loop'), array('pe-7s-look' => 'pe-7s-look'), array('pe-7s-lock' => 'pe-7s-lock'), array('pe-7s-lintern' => 'pe-7s-lintern'), array('pe-7s-link' => 'pe-7s-link'), array('pe-7s-like' => 'pe-7s-like'), array('pe-7s-light' => 'pe-7s-light'), array('pe-7s-less' => 'pe-7s-less'), array('pe-7s-keypad' => 'pe-7s-keypad'), array('pe-7s-junk' => 'pe-7s-junk'), array('pe-7s-info' => 'pe-7s-info'), array('pe-7s-home' => 'pe-7s-home'), array('pe-7s-help2' => 'pe-7s-help2'), array('pe-7s-help1' => 'pe-7s-help1'), array('pe-7s-graph3' => 'pe-7s-graph3'), array('pe-7s-graph2' => 'pe-7s-graph2'), array('pe-7s-graph1' => 'pe-7s-graph1'), array('pe-7s-graph' => 'pe-7s-graph'), array('pe-7s-global' => 'pe-7s-global'), array('pe-7s-gleam' => 'pe-7s-gleam'), array('pe-7s-glasses' => 'pe-7s-glasses'), array('pe-7s-gift' => 'pe-7s-gift'), array('pe-7s-folder' => 'pe-7s-folder'), array('pe-7s-flag' => 'pe-7s-flag'), array('pe-7s-filter' => 'pe-7s-filter'), array('pe-7s-file' => 'pe-7s-file'), array('pe-7s-expand1' => 'pe-7s-expand1'), array('pe-7s-exapnd2' => 'pe-7s-exapnd2'), array('pe-7s-edit' => 'pe-7s-edit'), array('pe-7s-drop' => 'pe-7s-drop'), array('pe-7s-drawer' => 'pe-7s-drawer'), array('pe-7s-download' => 'pe-7s-download'), array('pe-7s-display2' => 'pe-7s-display2'), array('pe-7s-display1' => 'pe-7s-display1'), array('pe-7s-diskette' => 'pe-7s-diskette'), array('pe-7s-date' => 'pe-7s-date'), array('pe-7s-cup' => 'pe-7s-cup'), array('pe-7s-culture' => 'pe-7s-culture'), array('pe-7s-crop' => 'pe-7s-crop'), array('pe-7s-credit' => 'pe-7s-credit'), array('pe-7s-copy-file' => 'pe-7s-copy-file'), array('pe-7s-config' => 'pe-7s-config'), array('pe-7s-compass' => 'pe-7s-compass'), array('pe-7s-comment' => 'pe-7s-comment'), array('pe-7s-coffee' => 'pe-7s-coffee'), array('pe-7s-cloud' => 'pe-7s-cloud'), array('pe-7s-clock' => 'pe-7s-clock'), array('pe-7s-check' => 'pe-7s-check'), array('pe-7s-chat' => 'pe-7s-chat'), array('pe-7s-cart' => 'pe-7s-cart'), array('pe-7s-camera' => 'pe-7s-camera'), array('pe-7s-call' => 'pe-7s-call'), array('pe-7s-calculator' => 'pe-7s-calculator'), array('pe-7s-browser' => 'pe-7s-browser'), array('pe-7s-box2' => 'pe-7s-box2'), array('pe-7s-box1' => 'pe-7s-box1'), array('pe-7s-bookmarks' => 'pe-7s-bookmarks'), array('pe-7s-bicycle' => 'pe-7s-bicycle'), array('pe-7s-bell' => 'pe-7s-bell'), array('pe-7s-battery' => 'pe-7s-battery'), array('pe-7s-ball' => 'pe-7s-ball'), array('pe-7s-back' => 'pe-7s-back'), array('pe-7s-attention' => 'pe-7s-attention'), array('pe-7s-anchor' => 'pe-7s-anchor'), array('pe-7s-albums' => 'pe-7s-albums'), array('pe-7s-alarm' => 'pe-7s-alarm'), array('pe-7s-airplay' => 'pe-7s-airplay')
			);

			return $GLOBALS['g5plus_theme_icons'];
		}

		// Fonts Awesome
		public static function &font_awesome()
		{
			if (isset($GLOBALS['g5plus_font_awesome']) && is_array($GLOBALS['g5plus_font_awesome'])) {
				return $GLOBALS['g5plus_font_awesome'];
			}
			$GLOBALS['g5plus_font_awesome'] = array(array('fa fa-500px' => 'fa-500px'), array('fa fa-adjust' => 'fa-adjust'), array('fa fa-adn' => 'fa-adn'), array('fa fa-align-center' => 'fa-align-center'), array('fa fa-align-justify' => 'fa-align-justify'), array('fa fa-align-left' => 'fa-align-left'), array('fa fa-align-right' => 'fa-align-right'), array('fa fa-amazon' => 'fa-amazon'), array('fa fa-ambulance' => 'fa-ambulance'), array('fa fa-anchor' => 'fa-anchor'), array('fa fa-android' => 'fa-android'), array('fa fa-angellist' => 'fa-angellist'), array('fa fa-angle-double-down' => 'fa-angle-double-down'), array('fa fa-angle-double-left' => 'fa-angle-double-left'), array('fa fa-angle-double-right' => 'fa-angle-double-right'), array('fa fa-angle-double-up' => 'fa-angle-double-up'), array('fa fa-angle-down' => 'fa-angle-down'), array('fa fa-angle-left' => 'fa-angle-left'), array('fa fa-angle-right' => 'fa-angle-right'), array('fa fa-angle-up' => 'fa-angle-up'), array('fa fa-apple' => 'fa-apple'), array('fa fa-archive' => 'fa-archive'), array('fa fa-area-chart' => 'fa-area-chart'), array('fa fa-arrow-circle-down' => 'fa-arrow-circle-down'), array('fa fa-arrow-circle-left' => 'fa-arrow-circle-left'), array('fa fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down'), array('fa fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left'), array('fa fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right'), array('fa fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up'), array('fa fa-arrow-circle-right' => 'fa-arrow-circle-right'), array('fa fa-arrow-circle-up' => 'fa-arrow-circle-up'), array('fa fa-arrow-down' => 'fa-arrow-down'), array('fa fa-arrow-left' => 'fa-arrow-left'), array('fa fa-arrow-right' => 'fa-arrow-right'), array('fa fa-arrow-up' => 'fa-arrow-up'), array('fa fa-arrows' => 'fa-arrows'), array('fa fa-arrows-alt' => 'fa-arrows-alt'), array('fa fa-arrows-h' => 'fa-arrows-h'), array('fa fa-arrows-v' => 'fa-arrows-v'), array('fa fa-asterisk' => 'fa-asterisk'), array('fa fa-at' => 'fa-at'), array('fa fa-automobile' => 'fa-automobile'), array('fa fa-backward' => 'fa-backward'), array('fa fa-balance-scale' => 'fa-balance-scale'), array('fa fa-ban' => 'fa-ban'), array('fa fa-bank' => 'fa-bank'), array('fa fa-bar-chart' => 'fa-bar-chart'), array('fa fa-bar-chart-o' => 'fa-bar-chart-o'), array('fa fa-barcode' => 'fa-barcode'), array('fa fa-bars' => 'fa-bars'), array('fa fa-battery-0' => 'fa-battery-0'), array('fa fa-battery-1' => 'fa-battery-1'), array('fa fa-battery-2' => 'fa-battery-2'), array('fa fa-battery-3' => 'fa-battery-3'), array('fa fa-battery-4' => 'fa-battery-4'), array('fa fa-battery-empty' => 'fa-battery-empty'), array('fa fa-battery-full' => 'fa-battery-full'), array('fa fa-battery-half' => 'fa-battery-half'), array('fa fa-battery-quarter' => 'fa-battery-quarter'), array('fa fa-battery-three-quarters' => 'fa-battery-three-quarters'), array('fa fa-bed' => 'fa-bed'), array('fa fa-beer' => 'fa-beer'), array('fa fa-behance' => 'fa-behance'), array('fa fa-behance-square' => 'fa-behance-square'), array('fa fa-bell' => 'fa-bell'), array('fa fa-bell-o' => 'fa-bell-o'), array('fa fa-bell-slash' => 'fa-bell-slash'), array('fa fa-bell-slash-o' => 'fa-bell-slash-o'), array('fa fa-bicycle' => 'fa-bicycle'), array('fa fa-binoculars' => 'fa-binoculars'), array('fa fa-birthday-cake' => 'fa-birthday-cake'), array('fa fa-bitbucket' => 'fa-bitbucket'), array('fa fa-bitbucket-square' => 'fa-bitbucket-square'), array('fa fa-bitcoin' => 'fa-bitcoin'), array('fa fa-black-tie' => 'fa-black-tie'), array('fa fa-bluetooth' => 'fa-bluetooth'), array('fa fa-bluetooth-b' => 'fa-bluetooth-b'), array('fa fa-bold' => 'fa-bold'), array('fa fa-bolt' => 'fa-bolt'), array('fa fa-bomb' => 'fa-bomb'), array('fa fa-book' => 'fa-book'), array('fa fa-bookmark' => 'fa-bookmark'), array('fa fa-bookmark-o' => 'fa-bookmark-o'), array('fa fa-briefcase' => 'fa-briefcase'), array('fa fa-btc' => 'fa-btc'), array('fa fa-bug' => 'fa-bug'), array('fa fa-building' => 'fa-building'), array('fa fa-building-o' => 'fa-building-o'), array('fa fa-bullhorn' => 'fa-bullhorn'), array('fa fa-bullseye' => 'fa-bullseye'), array('fa fa-bus' => 'fa-bus'), array('fa fa-buysellads' => 'fa-buysellads'), array('fa fa-cab' => 'fa-cab'), array('fa fa-calculator' => 'fa-calculator'), array('fa fa-calendar' => 'fa-calendar'), array('fa fa-calendar-check-o' => 'fa-calendar-check-o'), array('fa fa-calendar-minus-o' => 'fa-calendar-minus-o'), array('fa fa-calendar-o' => 'fa-calendar-o'), array('fa fa-calendar-plus-o' => 'fa-calendar-plus-o'), array('fa fa-calendar-times-o' => 'fa-calendar-times-o'), array('fa fa-camera' => 'fa-camera'), array('fa fa-camera-retro' => 'fa-camera-retro'), array('fa fa-car' => 'fa-car'), array('fa fa-caret-down' => 'fa-caret-down'), array('fa fa-caret-left' => 'fa-caret-left'), array('fa fa-caret-right' => 'fa-caret-right'), array('fa fa-caret-square-o-down' => 'fa-caret-square-o-down'), array('fa fa-caret-square-o-left' => 'fa-caret-square-o-left'), array('fa fa-caret-square-o-right' => 'fa-caret-square-o-right'), array('fa fa-caret-square-o-up' => 'fa-caret-square-o-up'), array('fa fa-caret-up' => 'fa-caret-up'), array('fa fa-cart-arrow-down' => 'fa-cart-arrow-down'), array('fa fa-cart-plus' => 'fa-cart-plus'), array('fa fa-cc' => 'fa-cc'), array('fa fa-cc-amex' => 'fa-cc-amex'), array('fa fa-cc-diners-club' => 'fa-cc-diners-club'), array('fa fa-cc-discover' => 'fa-cc-discover'), array('fa fa-cc-jcb' => 'fa-cc-jcb'), array('fa fa-cc-mastercard' => 'fa-cc-mastercard'), array('fa fa-cc-paypal' => 'fa-cc-paypal'), array('fa fa-cc-stripe' => 'fa-cc-stripe'), array('fa fa-cc-visa' => 'fa-cc-visa'), array('fa fa-certificate' => 'fa-certificate'), array('fa fa-chain' => 'fa-chain'), array('fa fa-chain-broken' => 'fa-chain-broken'), array('fa fa-check' => 'fa-check'), array('fa fa-check-circle' => 'fa-check-circle'), array('fa fa-check-circle-o' => 'fa-check-circle-o'), array('fa fa-check-square' => 'fa-check-square'), array('fa fa-check-square-o' => 'fa-check-square-o'), array('fa fa-chevron-circle-down' => 'fa-chevron-circle-down'), array('fa fa-chevron-circle-left' => 'fa-chevron-circle-left'), array('fa fa-chevron-circle-right' => 'fa-chevron-circle-right'), array('fa fa-chevron-circle-up' => 'fa-chevron-circle-up'), array('fa fa-chevron-down' => 'fa-chevron-down'), array('fa fa-chevron-left' => 'fa-chevron-left'), array('fa fa-chevron-right' => 'fa-chevron-right'), array('fa fa-chevron-up' => 'fa-chevron-up'), array('fa fa-child' => 'fa-child'), array('fa fa-chrome' => 'fa-chrome'), array('fa fa-circle' => 'fa-circle'), array('fa fa-circle-o' => 'fa-circle-o'), array('fa fa-circle-o-notch' => 'fa-circle-o-notch'), array('fa fa-circle-thin' => 'fa-circle-thin'), array('fa fa-clipboard' => 'fa-clipboard'), array('fa fa-clock-o' => 'fa-clock-o'), array('fa fa-clone' => 'fa-clone'), array('fa fa-close' => 'fa-close'), array('fa fa-cloud' => 'fa-cloud'), array('fa fa-cloud-download' => 'fa-cloud-download'), array('fa fa-cloud-upload' => 'fa-cloud-upload'), array('fa fa-cny' => 'fa-cny'), array('fa fa-code' => 'fa-code'), array('fa fa-code-fork' => 'fa-code-fork'), array('fa fa-codepen' => 'fa-codepen'), array('fa fa-codiepie' => 'fa-codiepie'), array('fa fa-coffee' => 'fa-coffee'), array('fa fa-cog' => 'fa-cog'), array('fa fa-cogs' => 'fa-cogs'), array('fa fa-columns' => 'fa-columns'), array('fa fa-comment' => 'fa-comment'), array('fa fa-comment-o' => 'fa-comment-o'), array('fa fa-commenting' => 'fa-commenting'), array('fa fa-commenting-o' => 'fa-commenting-o'), array('fa fa-comments' => 'fa-comments'), array('fa fa-comments-o' => 'fa-comments-o'), array('fa fa-compass' => 'fa-compass'), array('fa fa-compress' => 'fa-compress'), array('fa fa-connectdevelop' => 'fa-connectdevelop'), array('fa fa-contao' => 'fa-contao'), array('fa fa-copy' => 'fa-copy'), array('fa fa-copyright' => 'fa-copyright'), array('fa fa-creative-commons' => 'fa-creative-commons'), array('fa fa-credit-card' => 'fa-credit-card'), array('fa fa-credit-card-alt' => 'fa-credit-card-alt'), array('fa fa-crop' => 'fa-crop'), array('fa fa-crosshairs' => 'fa-crosshairs'), array('fa fa-css3' => 'fa-css3'), array('fa fa-cube' => 'fa-cube'), array('fa fa-cubes' => 'fa-cubes'), array('fa fa-cut' => 'fa-cut'), array('fa fa-cutlery' => 'fa-cutlery'), array('fa fa-dashboard' => 'fa-dashboard'), array('fa fa-dashcube' => 'fa-dashcube'), array('fa fa-database' => 'fa-database'), array('fa fa-dedent' => 'fa-dedent'), array('fa fa-delicious' => 'fa-delicious'), array('fa fa-desktop' => 'fa-desktop'), array('fa fa-deviantart' => 'fa-deviantart'), array('fa fa-diamond' => 'fa-diamond'), array('fa fa-digg' => 'fa-digg'), array('fa fa-dollar' => 'fa-dollar'), array('fa fa-dot-circle-o' => 'fa-dot-circle-o'), array('fa fa-download' => 'fa-download'), array('fa fa-dribbble' => 'fa-dribbble'), array('fa fa-dropbox' => 'fa-dropbox'), array('fa fa-drupal' => 'fa-drupal'), array('fa fa-edge' => 'fa-edge'), array('fa fa-edit' => 'fa-edit'), array('fa fa-eject' => 'fa-eject'), array('fa fa-ellipsis-h' => 'fa-ellipsis-h'), array('fa fa-ellipsis-v' => 'fa-ellipsis-v'), array('fa fa-empire' => 'fa-empire'), array('fa fa-envelope' => 'fa-envelope'), array('fa fa-envelope-o' => 'fa-envelope-o'), array('fa fa-envelope-square' => 'fa-envelope-square'), array('fa fa-eraser' => 'fa-eraser'), array('fa fa-eur' => 'fa-eur'), array('fa fa-euro' => 'fa-euro'), array('fa fa-exchange' => 'fa-exchange'), array('fa fa-exclamation' => 'fa-exclamation'), array('fa fa-exclamation-circle' => 'fa-exclamation-circle'), array('fa fa-exclamation-triangle' => 'fa-exclamation-triangle'), array('fa fa-expand' => 'fa-expand'), array('fa fa-expeditedssl' => 'fa-expeditedssl'), array('fa fa-external-link' => 'fa-external-link'), array('fa fa-external-link-square' => 'fa-external-link-square'), array('fa fa-eye' => 'fa-eye'), array('fa fa-eye-slash' => 'fa-eye-slash'), array('fa fa-eyedropper' => 'fa-eyedropper'), array('fa fa-facebook' => 'fa-facebook'), array('fa fa-facebook-f' => 'fa-facebook-f'), array('fa fa-facebook-official' => 'fa-facebook-official'), array('fa fa-facebook-square' => 'fa-facebook-square'), array('fa fa-fast-backward' => 'fa-fast-backward'), array('fa fa-fast-forward' => 'fa-fast-forward'), array('fa fa-fax' => 'fa-fax'), array('fa fa-feed' => 'fa-feed'), array('fa fa-female' => 'fa-female'), array('fa fa-fighter-jet' => 'fa-fighter-jet'), array('fa fa-file' => 'fa-file'), array('fa fa-file-archive-o' => 'fa-file-archive-o'), array('fa fa-file-audio-o' => 'fa-file-audio-o'), array('fa fa-file-code-o' => 'fa-file-code-o'), array('fa fa-file-excel-o' => 'fa-file-excel-o'), array('fa fa-file-image-o' => 'fa-file-image-o'), array('fa fa-file-movie-o' => 'fa-file-movie-o'), array('fa fa-file-o' => 'fa-file-o'), array('fa fa-file-pdf-o' => 'fa-file-pdf-o'), array('fa fa-file-photo-o' => 'fa-file-photo-o'), array('fa fa-file-picture-o' => 'fa-file-picture-o'), array('fa fa-file-powerpoint-o' => 'fa-file-powerpoint-o'), array('fa fa-file-sound-o' => 'fa-file-sound-o'), array('fa fa-file-text' => 'fa-file-text'), array('fa fa-file-text-o' => 'fa-file-text-o'), array('fa fa-file-video-o' => 'fa-file-video-o'), array('fa fa-file-word-o' => 'fa-file-word-o'), array('fa fa-file-zip-o' => 'fa-file-zip-o'), array('fa fa-files-o' => 'fa-files-o'), array('fa fa-film' => 'fa-film'), array('fa fa-filter' => 'fa-filter'), array('fa fa-fire' => 'fa-fire'), array('fa fa-fire-extinguisher' => 'fa-fire-extinguisher'), array('fa fa-firefox' => 'fa-firefox'), array('fa fa-flag' => 'fa-flag'), array('fa fa-flag-checkered' => 'fa-flag-checkered'), array('fa fa-flag-o' => 'fa-flag-o'), array('fa fa-flash' => 'fa-flash'), array('fa fa-flask' => 'fa-flask'), array('fa fa-flickr' => 'fa-flickr'), array('fa fa-floppy-o' => 'fa-floppy-o'), array('fa fa-folder' => 'fa-folder'), array('fa fa-folder-o' => 'fa-folder-o'), array('fa fa-folder-open' => 'fa-folder-open'), array('fa fa-folder-open-o' => 'fa-folder-open-o'), array('fa fa-font' => 'fa-font'), array('fa fa-fonticons' => 'fa-fonticons'), array('fa fa-fort-awesome' => 'fa-fort-awesome'), array('fa fa-forumbee' => 'fa-forumbee'), array('fa fa-forward' => 'fa-forward'), array('fa fa-foursquare' => 'fa-foursquare'), array('fa fa-frown-o' => 'fa-frown-o'), array('fa fa-futbol-o' => 'fa-futbol-o'), array('fa fa-gamepad' => 'fa-gamepad'), array('fa fa-gavel' => 'fa-gavel'), array('fa fa-gbp' => 'fa-gbp'), array('fa fa-ge' => 'fa-ge'), array('fa fa-gear' => 'fa-gear'), array('fa fa-gears' => 'fa-gears'), array('fa fa-genderless' => 'fa-genderless'), array('fa fa-get-pocket' => 'fa-get-pocket'), array('fa fa-gg' => 'fa-gg'), array('fa fa-gg-circle' => 'fa-gg-circle'), array('fa fa-gift' => 'fa-gift'), array('fa fa-git' => 'fa-git'), array('fa fa-git-square' => 'fa-git-square'), array('fa fa-github' => 'fa-github'), array('fa fa-github-alt' => 'fa-github-alt'), array('fa fa-github-square' => 'fa-github-square'), array('fa fa-gittip' => 'fa-gittip'), array('fa fa-glass' => 'fa-glass'), array('fa fa-globe' => 'fa-globe'), array('fa fa-google' => 'fa-google'), array('fa fa-google-plus' => 'fa-google-plus'), array('fa fa-google-plus-square' => 'fa-google-plus-square'), array('fa fa-google-wallet' => 'fa-google-wallet'), array('fa fa-graduation-cap' => 'fa-graduation-cap'), array('fa fa-gratipay' => 'fa-gratipay'), array('fa fa-group' => 'fa-group'), array('fa fa-h-square' => 'fa-h-square'), array('fa fa-hacker-news' => 'fa-hacker-news'), array('fa fa-hand-grab-o' => 'fa-hand-grab-o'), array('fa fa-hand-lizard-o' => 'fa-hand-lizard-o'), array('fa fa-hand-o-down' => 'fa-hand-o-down'), array('fa fa-hand-o-left' => 'fa-hand-o-left'), array('fa fa-hand-o-right' => 'fa-hand-o-right'), array('fa fa-hand-o-up' => 'fa-hand-o-up'), array('fa fa-hand-paper-o' => 'fa-hand-paper-o'), array('fa fa-hand-peace-o' => 'fa-hand-peace-o'), array('fa fa-hand-pointer-o' => 'fa-hand-pointer-o'), array('fa fa-hand-rock-o' => 'fa-hand-rock-o'), array('fa fa-hand-scissors-o' => 'fa-hand-scissors-o'), array('fa fa-hand-spock-o' => 'fa-hand-spock-o'), array('fa fa-hand-stop-o' => 'fa-hand-stop-o'), array('fa fa-hashtag' => 'fa-hashtag'), array('fa fa-hdd-o' => 'fa-hdd-o'), array('fa fa-header' => 'fa-header'), array('fa fa-headphones' => 'fa-headphones'), array('fa fa-heart' => 'fa-heart'), array('fa fa-heart-o' => 'fa-heart-o'), array('fa fa-heartbeat' => 'fa-heartbeat'), array('fa fa-history' => 'fa-history'), array('fa fa-home' => 'fa-home'), array('fa fa-hospital-o' => 'fa-hospital-o'), array('fa fa-hotel' => 'fa-hotel'), array('fa fa-hourglass' => 'fa-hourglass'), array('fa fa-hourglass-1' => 'fa-hourglass-1'), array('fa fa-hourglass-2' => 'fa-hourglass-2'), array('fa fa-hourglass-3' => 'fa-hourglass-3'), array('fa fa-hourglass-end' => 'fa-hourglass-end'), array('fa fa-hourglass-half' => 'fa-hourglass-half'), array('fa fa-hourglass-o' => 'fa-hourglass-o'), array('fa fa-hourglass-start' => 'fa-hourglass-start'), array('fa fa-houzz' => 'fa-houzz'), array('fa fa-html5' => 'fa-html5'), array('fa fa-i-cursor' => 'fa-i-cursor'), array('fa fa-ils' => 'fa-ils'), array('fa fa-image' => 'fa-image'), array('fa fa-inbox' => 'fa-inbox'), array('fa fa-indent' => 'fa-indent'), array('fa fa-industry' => 'fa-industry'), array('fa fa-info' => 'fa-info'), array('fa fa-info-circle' => 'fa-info-circle'), array('fa fa-inr' => 'fa-inr'), array('fa fa-instagram' => 'fa-instagram'), array('fa fa-institution' => 'fa-institution'), array('fa fa-internet-explorer' => 'fa-internet-explorer'), array('fa fa-intersex' => 'fa-intersex'), array('fa fa-ioxhost' => 'fa-ioxhost'), array('fa fa-italic' => 'fa-italic'), array('fa fa-joomla' => 'fa-joomla'), array('fa fa-jpy' => 'fa-jpy'), array('fa fa-jsfiddle' => 'fa-jsfiddle'), array('fa fa-key' => 'fa-key'), array('fa fa-keyboard-o' => 'fa-keyboard-o'), array('fa fa-krw' => 'fa-krw'), array('fa fa-language' => 'fa-language'), array('fa fa-laptop' => 'fa-laptop'), array('fa fa-lastfm' => 'fa-lastfm'), array('fa fa-lastfm-square' => 'fa-lastfm-square'), array('fa fa-leaf' => 'fa-leaf'), array('fa fa-leanpub' => 'fa-leanpub'), array('fa fa-legal' => 'fa-legal'), array('fa fa-lemon-o' => 'fa-lemon-o'), array('fa fa-level-down' => 'fa-level-down'), array('fa fa-level-up' => 'fa-level-up'), array('fa fa-life-bouy' => 'fa-life-bouy'), array('fa fa-life-buoy' => 'fa-life-buoy'), array('fa fa-life-ring' => 'fa-life-ring'), array('fa fa-life-saver' => 'fa-life-saver'), array('fa fa-lightbulb-o' => 'fa-lightbulb-o'), array('fa fa-line-chart' => 'fa-line-chart'), array('fa fa-link' => 'fa-link'), array('fa fa-linkedin' => 'fa-linkedin'), array('fa fa-linkedin-square' => 'fa-linkedin-square'), array('fa fa-linux' => 'fa-linux'), array('fa fa-list' => 'fa-list'), array('fa fa-list-alt' => 'fa-list-alt'), array('fa fa-list-ol' => 'fa-list-ol'), array('fa fa-list-ul' => 'fa-list-ul'), array('fa fa-location-arrow' => 'fa-location-arrow'), array('fa fa-lock' => 'fa-lock'), array('fa fa-long-arrow-down' => 'fa-long-arrow-down'), array('fa fa-long-arrow-left' => 'fa-long-arrow-left'), array('fa fa-long-arrow-right' => 'fa-long-arrow-right'), array('fa fa-long-arrow-up' => 'fa-long-arrow-up'), array('fa fa-magic' => 'fa-magic'), array('fa fa-magnet' => 'fa-magnet'), array('fa fa-mail-forward' => 'fa-mail-forward'), array('fa fa-mail-reply' => 'fa-mail-reply'), array('fa fa-mail-reply-all' => 'fa-mail-reply-all'), array('fa fa-male' => 'fa-male'), array('fa fa-map' => 'fa-map'), array('fa fa-map-marker' => 'fa-map-marker'), array('fa fa-map-o' => 'fa-map-o'), array('fa fa-map-pin' => 'fa-map-pin'), array('fa fa-map-signs' => 'fa-map-signs'), array('fa fa-mars' => 'fa-mars'), array('fa fa-mars-double' => 'fa-mars-double'), array('fa fa-mars-stroke' => 'fa-mars-stroke'), array('fa fa-mars-stroke-h' => 'fa-mars-stroke-h'), array('fa fa-mars-stroke-v' => 'fa-mars-stroke-v'), array('fa fa-maxcdn' => 'fa-maxcdn'), array('fa fa-meanpath' => 'fa-meanpath'), array('fa fa-medium' => 'fa-medium'), array('fa fa-medkit' => 'fa-medkit'), array('fa fa-meh-o' => 'fa-meh-o'), array('fa fa-mercury' => 'fa-mercury'), array('fa fa-microphone' => 'fa-microphone'), array('fa fa-microphone-slash' => 'fa-microphone-slash'), array('fa fa-minus' => 'fa-minus'), array('fa fa-minus-circle' => 'fa-minus-circle'), array('fa fa-minus-square' => 'fa-minus-square'), array('fa fa-minus-square-o' => 'fa-minus-square-o'), array('fa fa-mixcloud' => 'fa-mixcloud'), array('fa fa-mobile' => 'fa-mobile'), array('fa fa-mobile-phone' => 'fa-mobile-phone'), array('fa fa-modx' => 'fa-modx'), array('fa fa-money' => 'fa-money'), array('fa fa-moon-o' => 'fa-moon-o'), array('fa fa-mortar-board' => 'fa-mortar-board'), array('fa fa-motorcycle' => 'fa-motorcycle'), array('fa fa-mouse-pointer' => 'fa-mouse-pointer'), array('fa fa-music' => 'fa-music'), array('fa fa-navicon' => 'fa-navicon'), array('fa fa-neuter' => 'fa-neuter'), array('fa fa-newspaper-o' => 'fa-newspaper-o'), array('fa fa-object-group' => 'fa-object-group'), array('fa fa-object-ungroup' => 'fa-object-ungroup'), array('fa fa-odnoklassniki' => 'fa-odnoklassniki'), array('fa fa-odnoklassniki-square' => 'fa-odnoklassniki-square'), array('fa fa-opencart' => 'fa-opencart'), array('fa fa-openid' => 'fa-openid'), array('fa fa-opera' => 'fa-opera'), array('fa fa-optin-monster' => 'fa-optin-monster'), array('fa fa-outdent' => 'fa-outdent'), array('fa fa-pagelines' => 'fa-pagelines'), array('fa fa-paint-brush' => 'fa-paint-brush'), array('fa fa-paper-plane' => 'fa-paper-plane'), array('fa fa-paper-plane-o' => 'fa-paper-plane-o'), array('fa fa-paperclip' => 'fa-paperclip'), array('fa fa-paragraph' => 'fa-paragraph'), array('fa fa-paste' => 'fa-paste'), array('fa fa-pause' => 'fa-pause'), array('fa fa-pause-circle' => 'fa-pause-circle'), array('fa fa-pause-circle-o' => 'fa-pause-circle-o'), array('fa fa-paw' => 'fa-paw'), array('fa fa-paypal' => 'fa-paypal'), array('fa fa-pencil' => 'fa-pencil'), array('fa fa-pencil-square' => 'fa-pencil-square'), array('fa fa-pencil-square-o' => 'fa-pencil-square-o'), array('fa fa-percent' => 'fa-percent'), array('fa fa-phone' => 'fa-phone'), array('fa fa-phone-square' => 'fa-phone-square'), array('fa fa-photo' => 'fa-photo'), array('fa fa-picture-o' => 'fa-picture-o'), array('fa fa-pie-chart' => 'fa-pie-chart'), array('fa fa-pied-piper' => 'fa-pied-piper'), array('fa fa-pied-piper-alt' => 'fa-pied-piper-alt'), array('fa fa-pinterest' => 'fa-pinterest'), array('fa fa-pinterest-p' => 'fa-pinterest-p'), array('fa fa-pinterest-square' => 'fa-pinterest-square'), array('fa fa-plane' => 'fa-plane'), array('fa fa-play' => 'fa-play'), array('fa fa-play-circle' => 'fa-play-circle'), array('fa fa-play-circle-o' => 'fa-play-circle-o'), array('fa fa-plug' => 'fa-plug'), array('fa fa-plus' => 'fa-plus'), array('fa fa-plus-circle' => 'fa-plus-circle'), array('fa fa-plus-square' => 'fa-plus-square'), array('fa fa-plus-square-o' => 'fa-plus-square-o'), array('fa fa-power-off' => 'fa-power-off'), array('fa fa-print' => 'fa-print'), array('fa fa-product-hunt' => 'fa-product-hunt'), array('fa fa-puzzle-piece' => 'fa-puzzle-piece'), array('fa fa-qq' => 'fa-qq'), array('fa fa-qrcode' => 'fa-qrcode'), array('fa fa-question' => 'fa-question'), array('fa fa-question-circle' => 'fa-question-circle'), array('fa fa-quote-left' => 'fa-quote-left'), array('fa fa-quote-right' => 'fa-quote-right'), array('fa fa-ra' => 'fa-ra'), array('fa fa-random' => 'fa-random'), array('fa fa-rebel' => 'fa-rebel'), array('fa fa-recycle' => 'fa-recycle'), array('fa fa-reddit' => 'fa-reddit'), array('fa fa-reddit-alien' => 'fa-reddit-alien'), array('fa fa-reddit-square' => 'fa-reddit-square'), array('fa fa-refresh' => 'fa-refresh'), array('fa fa-registered' => 'fa-registered'), array('fa fa-remove' => 'fa-remove'), array('fa fa-renren' => 'fa-renren'), array('fa fa-reorder' => 'fa-reorder'), array('fa fa-repeat' => 'fa-repeat'), array('fa fa-reply' => 'fa-reply'), array('fa fa-reply-all' => 'fa-reply-all'), array('fa fa-retweet' => 'fa-retweet'), array('fa fa-rmb' => 'fa-rmb'), array('fa fa-road' => 'fa-road'), array('fa fa-rocket' => 'fa-rocket'), array('fa fa-rotate-left' => 'fa-rotate-left'), array('fa fa-rotate-right' => 'fa-rotate-right'), array('fa fa-rouble' => 'fa-rouble'), array('fa fa-rss' => 'fa-rss'), array('fa fa-rss-square' => 'fa-rss-square'), array('fa fa-rub' => 'fa-rub'), array('fa fa-ruble' => 'fa-ruble'), array('fa fa-rupee' => 'fa-rupee'), array('fa fa-safari' => 'fa-safari'), array('fa fa-save' => 'fa-save'), array('fa fa-scissors' => 'fa-scissors'), array('fa fa-scribd' => 'fa-scribd'), array('fa fa-search' => 'fa-search'), array('fa fa-search-minus' => 'fa-search-minus'), array('fa fa-search-plus' => 'fa-search-plus'), array('fa fa-sellsy' => 'fa-sellsy'), array('fa fa-send' => 'fa-send'), array('fa fa-send-o' => 'fa-send-o'), array('fa fa-server' => 'fa-server'), array('fa fa-share' => 'fa-share'), array('fa fa-share-alt' => 'fa-share-alt'), array('fa fa-share-alt-square' => 'fa-share-alt-square'), array('fa fa-share-square' => 'fa-share-square'), array('fa fa-share-square-o' => 'fa-share-square-o'), array('fa fa-shekel' => 'fa-shekel'), array('fa fa-sheqel' => 'fa-sheqel'), array('fa fa-shield' => 'fa-shield'), array('fa fa-ship' => 'fa-ship'), array('fa fa-shirtsinbulk' => 'fa-shirtsinbulk'), array('fa fa-shopping-bag' => 'fa-shopping-bag'), array('fa fa-shopping-basket' => 'fa-shopping-basket'), array('fa fa-shopping-cart' => 'fa-shopping-cart'), array('fa fa-sign-in' => 'fa-sign-in'), array('fa fa-sign-out' => 'fa-sign-out'), array('fa fa-signal' => 'fa-signal'), array('fa fa-simplybuilt' => 'fa-simplybuilt'), array('fa fa-sitemap' => 'fa-sitemap'), array('fa fa-skyatlas' => 'fa-skyatlas'), array('fa fa-skype' => 'fa-skype'), array('fa fa-slack' => 'fa-slack'), array('fa fa-sliders' => 'fa-sliders'), array('fa fa-slideshare' => 'fa-slideshare'), array('fa fa-smile-o' => 'fa-smile-o'), array('fa fa-soccer-ball-o' => 'fa-soccer-ball-o'), array('fa fa-sort' => 'fa-sort'), array('fa fa-sort-alpha-asc' => 'fa-sort-alpha-asc'), array('fa fa-sort-alpha-desc' => 'fa-sort-alpha-desc'), array('fa fa-sort-amount-asc' => 'fa-sort-amount-asc'), array('fa fa-sort-amount-desc' => 'fa-sort-amount-desc'), array('fa fa-sort-asc' => 'fa-sort-asc'), array('fa fa-sort-desc' => 'fa-sort-desc'), array('fa fa-sort-down' => 'fa-sort-down'), array('fa fa-sort-numeric-asc' => 'fa-sort-numeric-asc'), array('fa fa-sort-numeric-desc' => 'fa-sort-numeric-desc'), array('fa fa-sort-up' => 'fa-sort-up'), array('fa fa-soundcloud' => 'fa-soundcloud'), array('fa fa-space-shuttle' => 'fa-space-shuttle'), array('fa fa-spinner' => 'fa-spinner'), array('fa fa-spoon' => 'fa-spoon'), array('fa fa-spotify' => 'fa-spotify'), array('fa fa-square' => 'fa-square'), array('fa fa-square-o' => 'fa-square-o'), array('fa fa-stack-exchange' => 'fa-stack-exchange'), array('fa fa-stack-overflow' => 'fa-stack-overflow'), array('fa fa-star' => 'fa-star'), array('fa fa-star-half' => 'fa-star-half'), array('fa fa-star-half-empty' => 'fa-star-half-empty'), array('fa fa-star-half-full' => 'fa-star-half-full'), array('fa fa-star-half-o' => 'fa-star-half-o'), array('fa fa-star-o' => 'fa-star-o'), array('fa fa-steam' => 'fa-steam'), array('fa fa-steam-square' => 'fa-steam-square'), array('fa fa-step-backward' => 'fa-step-backward'), array('fa fa-step-forward' => 'fa-step-forward'), array('fa fa-stethoscope' => 'fa-stethoscope'), array('fa fa-sticky-note' => 'fa-sticky-note'), array('fa fa-sticky-note-o' => 'fa-sticky-note-o'), array('fa fa-stop' => 'fa-stop'), array('fa fa-stop-circle' => 'fa-stop-circle'), array('fa fa-stop-circle-o' => 'fa-stop-circle-o'), array('fa fa-street-view' => 'fa-street-view'), array('fa fa-strikethrough' => 'fa-strikethrough'), array('fa fa-stumbleupon' => 'fa-stumbleupon'), array('fa fa-stumbleupon-circle' => 'fa-stumbleupon-circle'), array('fa fa-subscript' => 'fa-subscript'), array('fa fa-subway' => 'fa-subway'), array('fa fa-suitcase' => 'fa-suitcase'), array('fa fa-sun-o' => 'fa-sun-o'), array('fa fa-superscript' => 'fa-superscript'), array('fa fa-support' => 'fa-support'), array('fa fa-table' => 'fa-table'), array('fa fa-tablet' => 'fa-tablet'), array('fa fa-tachometer' => 'fa-tachometer'), array('fa fa-tag' => 'fa-tag'), array('fa fa-tags' => 'fa-tags'), array('fa fa-tasks' => 'fa-tasks'), array('fa fa-taxi' => 'fa-taxi'), array('fa fa-television' => 'fa-television'), array('fa fa-tencent-weibo' => 'fa-tencent-weibo'), array('fa fa-terminal' => 'fa-terminal'), array('fa fa-text-height' => 'fa-text-height'), array('fa fa-text-width' => 'fa-text-width'), array('fa fa-th' => 'fa-th'), array('fa fa-th-large' => 'fa-th-large'), array('fa fa-th-list' => 'fa-th-list'), array('fa fa-thumb-tack' => 'fa-thumb-tack'), array('fa fa-thumbs-down' => 'fa-thumbs-down'), array('fa fa-thumbs-o-down' => 'fa-thumbs-o-down'), array('fa fa-thumbs-o-up' => 'fa-thumbs-o-up'), array('fa fa-thumbs-up' => 'fa-thumbs-up'), array('fa fa-ticket' => 'fa-ticket'), array('fa fa-times' => 'fa-times'), array('fa fa-times-circle' => 'fa-times-circle'), array('fa fa-times-circle-o' => 'fa-times-circle-o'), array('fa fa-tint' => 'fa-tint'), array('fa fa-toggle-down' => 'fa-toggle-down'), array('fa fa-toggle-left' => 'fa-toggle-left'), array('fa fa-toggle-off' => 'fa-toggle-off'), array('fa fa-toggle-on' => 'fa-toggle-on'), array('fa fa-toggle-right' => 'fa-toggle-right'), array('fa fa-toggle-up' => 'fa-toggle-up'), array('fa fa-trademark' => 'fa-trademark'), array('fa fa-train' => 'fa-train'), array('fa fa-transgender' => 'fa-transgender'), array('fa fa-transgender-alt' => 'fa-transgender-alt'), array('fa fa-trash' => 'fa-trash'), array('fa fa-trash-o' => 'fa-trash-o'), array('fa fa-tree' => 'fa-tree'), array('fa fa-trello' => 'fa-trello'), array('fa fa-tripadvisor' => 'fa-tripadvisor'), array('fa fa-trophy' => 'fa-trophy'), array('fa fa-truck' => 'fa-truck'), array('fa fa-try' => 'fa-try'), array('fa fa-tty' => 'fa-tty'), array('fa fa-tumblr' => 'fa-tumblr'), array('fa fa-tumblr-square' => 'fa-tumblr-square'), array('fa fa-turkish-lira' => 'fa-turkish-lira'), array('fa fa-tv' => 'fa-tv'), array('fa fa-twitch' => 'fa-twitch'), array('fa fa-twitter' => 'fa-twitter'), array('fa fa-twitter-square' => 'fa-twitter-square'), array('fa fa-umbrella' => 'fa-umbrella'), array('fa fa-underline' => 'fa-underline'), array('fa fa-undo' => 'fa-undo'), array('fa fa-university' => 'fa-university'), array('fa fa-unlink' => 'fa-unlink'), array('fa fa-unlock' => 'fa-unlock'), array('fa fa-unlock-alt' => 'fa-unlock-alt'), array('fa fa-unsorted' => 'fa-unsorted'), array('fa fa-upload' => 'fa-upload'), array('fa fa-usb' => 'fa-usb'), array('fa fa-usd' => 'fa-usd'), array('fa fa-user' => 'fa-user'), array('fa fa-user-md' => 'fa-user-md'), array('fa fa-user-plus' => 'fa-user-plus'), array('fa fa-user-secret' => 'fa-user-secret'), array('fa fa-user-times' => 'fa-user-times'), array('fa fa-users' => 'fa-users'), array('fa fa-venus' => 'fa-venus'), array('fa fa-venus-double' => 'fa-venus-double'), array('fa fa-venus-mars' => 'fa-venus-mars'), array('fa fa-viacoin' => 'fa-viacoin'), array('fa fa-video-camera' => 'fa-video-camera'), array('fa fa-vimeo' => 'fa-vimeo'), array('fa fa-vimeo-square' => 'fa-vimeo-square'), array('fa fa-vine' => 'fa-vine'), array('fa fa-vk' => 'fa-vk'), array('fa fa-volume-down' => 'fa-volume-down'), array('fa fa-volume-off' => 'fa-volume-off'), array('fa fa-volume-up' => 'fa-volume-up'), array('fa fa-warning' => 'fa-warning'), array('fa fa-wechat' => 'fa-wechat'), array('fa fa-weibo' => 'fa-weibo'), array('fa fa-weixin' => 'fa-weixin'), array('fa fa-whatsapp' => 'fa-whatsapp'), array('fa fa-wheelchair' => 'fa-wheelchair'), array('fa fa-wifi' => 'fa-wifi'), array('fa fa-wikipedia-w' => 'fa-wikipedia-w'), array('fa fa-windows' => 'fa-windows'), array('fa fa-won' => 'fa-won'), array('fa fa-wordpress' => 'fa-wordpress'), array('fa fa-wrench' => 'fa-wrench'), array('fa fa-xing' => 'fa-xing'), array('fa fa-xing-square' => 'fa-xing-square'), array('fa fa-y-combinator' => 'fa-y-combinator'), array('fa fa-y-combinator-square' => 'fa-y-combinator-square'), array('fa fa-yahoo' => 'fa-yahoo'), array('fa fa-yc' => 'fa-yc'), array('fa fa-yc-square' => 'fa-yc-square'), array('fa fa-yelp' => 'fa-yelp'), array('fa fa-yen' => 'fa-yen'), array('fa fa-youtube' => 'fa-youtube'), array('fa fa-youtube-play' => 'fa-youtube-play'), array('fa fa-youtube-square' => 'fa-youtube-square'));

			return $GLOBALS['g5plus_font_awesome'];
		}

		// Image Thumb Size
		// Fonts Awesome

		//GET VC pixel_icons
		public static function &get_pixel_icons()
		{
			global $pixel_icons;
			if (isset($pixel_icons)) {
				return $pixel_icons;
			}
			$val = array();

			return $val;
		}

		// GET meta_boxs
		public static function &get_meta_boxes()
		{
			if (isset($GLOBALS['g5plus_meta_boxes']) && is_array($GLOBALS['g5plus_meta_boxes'])) {
				return $GLOBALS['g5plus_meta_boxes'];
			}
			$GLOBALS['g5plus_meta_boxes'] = array();

			return $GLOBALS['g5plus_meta_boxes'];
		}

		public static function &wp_post_types()
		{
			if (isset($GLOBALS['wp_post_types'])) {
				return $GLOBALS['wp_post_types'];
			}
			$GLOBALS['wp_post_types'] = array();

			return $GLOBALS['wp_post_types'];
		}

		//==============================================================================
		// Get Logo variable
		//==============================================================================
		public static function &get_logo_var()
		{
			if (isset($GLOBALS['g5plus_logo_var'])) {
				return $GLOBALS['g5plus_logo_var'];
			}
			$logo = G5Plus_Global::get_option('logo', array('url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo.png'));
			$logo_retina = G5Plus_Global::get_option('logo_retina', array('url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-2x.png'));
			$sticky_logo = G5Plus_Global::get_option('sticky_logo', array('url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo.png'));
			$sticky_logo_retina = G5Plus_Global::get_option('sticky_logo_retina', array('url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-2x.png'));
			$mobile_logo = G5Plus_Global::get_option('mobile_logo', array('url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-mobile.png'));
			$mobile_logo_retina = G5Plus_Global::get_option('mobile_logo_retina', array('url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-mobile-2x.png'));
			$logo_max_height = G5Plus_Global::get_option('logo_max_height', array('height' => ''));
			if ($logo_max_height['height'] !== '') {
				$logo_max_height['height'] .= 'px';
			}
			$mobile_logo_max_height = G5Plus_Global::get_option('mobile_logo_max_height', array('height' => ''));
			if ($mobile_logo_max_height['height'] !== '') {
				$mobile_logo_max_height['height'] .= 'px';
			}

			$GLOBALS['g5plus_logo_var'] = array(
				'logo'                   => $logo['url'],
				'logo_retina'            => $logo_retina['url'],
				'sticky_logo'            => $sticky_logo['url'],
				'sticky_logo_retina'     => $sticky_logo_retina['url'],
				'mobile_logo'            => $mobile_logo['url'],
				'mobile_logo_retina'     => $mobile_logo_retina['url'],
				'logo_max_height'        => $logo_max_height['height'],
				'mobile_logo_max_height' => $mobile_logo_max_height['height'],
				'logo_padding'           => G5Plus_Global::get_option('logo_padding', array('padding-top' => '', 'padding-bottom' => '')),
				'mobile_logo_padding'    => G5Plus_Global::get_option('mobile_logo_padding', array('padding-top' => '0', 'padding-bottom' => '0')),

			);

			return $GLOBALS['g5plus_logo_var'];
		}

		//==============================================================================
		// Get Top Drawer variable
		//==============================================================================
		public static function &get_top_drawer_var()
		{
			if (isset($GLOBALS['g5plus_top_drawer_var'])) {
				return $GLOBALS['g5plus_top_drawer_var'];
			}
			$GLOBALS['g5plus_top_drawer_var'] = array(
				'top_drawer_type'           => G5Plus_Global::get_option('top_drawer_type', 'none'),
				'top_drawer_sidebar'        => G5Plus_Global::get_option('top_drawer_sidebar', 'top_drawer_sidebar'),
				'top_drawer_wrapper_layout' => G5Plus_Global::get_option('top_drawer_wrapper_layout', 'container'),
				'top_drawer_hide_mobile'    => G5Plus_Global::get_option('top_drawer_hide_mobile', '1'),
				'top_drawer_padding'        => G5Plus_Global::get_option('top_drawer_padding', array('padding-top' => '', 'padding-bottom' => '')),
			);

			return $GLOBALS['g5plus_top_drawer_var'];
		}

		//==============================================================================
		// Get Top Bar variable
		//==============================================================================
		public static function &get_top_bar_var()
		{
			if (isset($GLOBALS['g5plus_top_bar_var'])) {
				return $GLOBALS['g5plus_top_bar_var'];
			}
			$GLOBALS['g5plus_top_bar_var'] = array(
				'top_bar_enable'               => G5Plus_Global::get_option('top_bar_enable', '0'),
				'top_bar_layout'               => G5Plus_Global::get_option('top_bar_layout', 'top-bar-1'),
				'top_bar_left_sidebar'         => G5Plus_Global::get_option('top_bar_left_sidebar', 'top_bar_left'),
				'top_bar_right_sidebar'        => G5Plus_Global::get_option('top_bar_right_sidebar', 'top_bar_right'),
				'top_bar_border'               => G5Plus_Global::get_option('top_bar_border', 'none'),
				'top_bar_padding'              => G5Plus_Global::get_option('top_bar_padding', array('padding-top' => '5px', 'padding-bottom' => '5px')),

				'top_bar_mobile_enable'        => G5Plus_Global::get_option('top_bar_mobile_enable', '0'),
				'top_bar_mobile_layout'        => G5Plus_Global::get_option('top_bar_mobile_layout', 'top-bar-1'),
				'top_bar_mobile_left_sidebar'  => G5Plus_Global::get_option('top_bar_mobile_left_sidebar', 'top_bar_left'),
				'top_bar_mobile_right_sidebar' => G5Plus_Global::get_option('top_bar_mobile_right_sidebar', 'top_bar_right'),
				'top_bar_mobile_border'        => G5Plus_Global::get_option('top_bar_mobile_border', 'container-border'),
				'top_bar_mobile_padding'       => G5Plus_Global::get_option('top_bar_mobile_padding', array('padding-top' => '5px', 'padding-bottom' => '5px')),
			);

			return $GLOBALS['g5plus_top_bar_var'];
		}

		//==============================================================================
		// Get header variable
		//==============================================================================
		public static function &get_header_var()
		{
			if (isset($GLOBALS['g5plus_header_var'])) {
				return $GLOBALS['g5plus_header_var'];
			}
			$navigation_height = G5Plus_Global::get_option('navigation_height', array('height' => ''));
			if ($navigation_height['height'] !== '') {
				$navigation_height['height'] .= 'px';
			}

			$GLOBALS['g5plus_header_var'] = array(
				'header_show_hide'             => 1,
				'header_responsive_breakpoint' => G5Plus_Global::get_option('header_responsive_breakpoint', '991px'),
				'header_layout'                => G5Plus_Global::get_option('header_layout', 'header-1'),
				'header_container_layout'      => G5Plus_Global::get_option('header_container_layout', 'container'),
				'header_float'                 => G5Plus_Global::get_option('header_float', '0'),
				'header_sticky'                => G5Plus_Global::get_option('header_sticky', '1'),
				'header_border_bottom'         => G5Plus_Global::get_option('header_border_bottom', 'none'),
				'header_above_border_bottom'   => G5Plus_Global::get_option('header_above_border_bottom', 'none'),
				'header_padding'               => G5Plus_Global::get_option('header_padding', array('padding-top' => '', 'padding-bottom' => '')),
				'navigation_height'            => $navigation_height['height'],
				'navigation_spacing'           => G5Plus_Global::get_option('navigation_spacing', '30') . 'px',
				'mobile_header_layout'         => G5Plus_Global::get_option('mobile_header_layout', 'header-mobile-1'),
				'mobile_header_menu_drop'      => G5Plus_Global::get_option('mobile_header_menu_drop', 'menu-drop-fly'),
				'mobile_header_stick'          => G5Plus_Global::get_option('mobile_header_stick', '0'),
				'mobile_header_search_box'     => G5Plus_Global::get_option('mobile_header_search_box', '1'),
				'mobile_header_shopping_cart'  => G5Plus_Global::get_option('mobile_header_shopping_cart', '1'),
				'mobile_header_border_bottom'  => G5Plus_Global::get_option('header_layout', 'mobile_header_border_bottom'),
			);

			return $GLOBALS['g5plus_header_var'];
		}

		//==============================================================================
		// Get Header Customize variable
		//==============================================================================
		public static function &get_header_customize_var()
		{
			if (isset($GLOBALS['g5plus_header_customize_var'])) {
				return $GLOBALS['g5plus_header_customize_var'];
			}
			$GLOBALS['g5plus_header_customize_var'] = array(
				'header_customize_nav'           => G5Plus_Global::get_option('header_customize_nav', array()),
				'header_customize_nav_email'     => G5Plus_Global::get_option('header_customize_nav_email', array('label' => '', 'value' => '')),
				'header_customize_nav_phone'     => G5Plus_Global::get_option('header_customize_nav_phone', array('label' => '', 'value' => '')),
				'header_customize_nav_search'    => G5Plus_Global::get_option('header_customize_nav_search', 'button'),
				'header_customize_nav_sidebar'   => G5Plus_Global::get_option('header_customize_nav_sidebar', ''),
				'header_customize_nav_text'      => G5Plus_Global::get_option('header_customize_nav_text', ''),
				'header_customize_nav_spacing'   => G5Plus_Global::get_option('header_customize_nav_spacing', '40') . 'px',

				'header_customize_left'          => G5Plus_Global::get_option('header_customize_left', array()),
				'header_customize_left_email'    => G5Plus_Global::get_option('header_customize_left_email', array('label' => '', 'value' => '')),
				'header_customize_left_phone'    => G5Plus_Global::get_option('header_customize_left_phone', array('label' => '', 'value' => '')),
				'header_customize_left_search'   => G5Plus_Global::get_option('header_customize_left_search', 'button'),
				'header_customize_left_sidebar'  => G5Plus_Global::get_option('header_customize_left_sidebar', ''),
				'header_customize_left_text'     => G5Plus_Global::get_option('header_customize_left_text', ''),
				'header_customize_left_spacing'  => G5Plus_Global::get_option('header_customize_left_spacing', '40') . 'px',

				'header_customize_right'         => G5Plus_Global::get_option('header_customize_right', array()),
				'header_customize_right_email'   => G5Plus_Global::get_option('header_customize_right_email', array('label' => '', 'value' => '')),
				'header_customize_right_phone'   => G5Plus_Global::get_option('header_customize_right_phone', array('label' => '', 'value' => '')),
				'header_customize_right_search'  => G5Plus_Global::get_option('header_customize_right_search', 'button'),
				'header_customize_right_sidebar' => G5Plus_Global::get_option('header_customize_right_sidebar', ''),
				'header_customize_right_text'    => G5Plus_Global::get_option('header_customize_right_text', ''),
				'header_customize_right_spacing' => G5Plus_Global::get_option('header_customize_right_spacing', '40') . 'px',
			);

			return $GLOBALS['g5plus_header_customize_var'];
		}

		//==============================================================================
		// Get Footer variable
		//==============================================================================
		public static function &get_footer_var()
		{
			if (isset($GLOBALS['g5plus_footer_var'])) {
				return $GLOBALS['g5plus_footer_var'];
			}
			$GLOBALS['g5plus_footer_var'] = array(
				'footer_show_hide'         => 1,
				'bottom_bar_visible'       => 1,
				'footer_container_layout'  => G5Plus_Global::get_option('footer_container_layout', 'container'),
				'footer_layout'            => G5Plus_Global::get_option('footer_layout', 'footer-1'),
				'footer_sidebar_1'         => G5Plus_Global::get_option('footer_sidebar_1', 'footer-1'),
				'footer_sidebar_2'         => G5Plus_Global::get_option('footer_sidebar_2', 'footer-2'),
				'footer_sidebar_3'         => G5Plus_Global::get_option('footer_sidebar_3', 'footer-3'),
				'footer_sidebar_4'         => G5Plus_Global::get_option('footer_sidebar_4', 'footer-4'),
				'footer_bg_image'          => G5Plus_Global::get_option('footer_bg_image', ''),
				'footer_parallax'          => G5Plus_Global::get_option('footer_parallax', '0'),
				'collapse_footer'          => G5Plus_Global::get_option('collapse_footer', '0'),
				'footer_padding'           => G5Plus_Global::get_option('footer_padding', array('padding-top' => '60px', 'padding-bottom' => '60px')),
				'footer_border_top'        => G5Plus_Global::get_option('footer_border_top', 'none'),
				'bottom_bar_layout'        => G5Plus_Global::get_option('bottom_bar_layout', 'bottom-bar-1'),
				'bottom_bar_left_sidebar'  => G5Plus_Global::get_option('bottom_bar_left_sidebar', 'bottom_bar_left'),
				'bottom_bar_right_sidebar' => G5Plus_Global::get_option('bottom_bar_right_sidebar', 'bottom_bar_right'),
				'bottom_bar_padding'       => G5Plus_Global::get_option('bottom_bar_padding', array('padding-top' => '25px', 'padding-bottom' => '25px')),
				'bottom_bar_border_top'    => G5Plus_Global::get_option('bottom_bar_border_top', 'none'),
			);

			return $GLOBALS['g5plus_footer_var'];
		}

		//==============================================================================
		// Get Theme Color variable
		//==============================================================================
		public static function &get_theme_color_var()
		{
			if (isset($GLOBALS['g5plus_theme_color_var'])) {
				return $GLOBALS['g5plus_theme_color_var'];
			}
			$header = &G5Plus_Global::get_header_var();
			$header_layout = $header['header_layout'];
			$header_float = $header['header_float'];

			// Header Color
			/////////////////////////////////////////////
			$header_bg_color = G5Plus_Global::get_option('header_bg_color', '#fff');
			$header_text_color = G5Plus_Global::get_option('header_text_color', '#212121');
			$header_border_color = G5Plus_Global::get_option('header_border_color', '#eee');
			$header_above_border_color = G5Plus_Global::get_option('header_above_border_color', '#eee');
			$header_overlay = G5Plus_Global::get_option('header_overlay', 0);
			if (G5Plus_Global::get_option('header_color_customize', 0)) {
				if ($header_float) {
					$header_bg_color = g5plus_hex2rgba($header_bg_color, $header_overlay);
					$header_border_color = g5plus_hex2rgba($header_border_color, 0.2);
					$header_above_border_color = g5plus_hex2rgba($header_above_border_color, 0.2);
				}
			} else {
				$header_border_color = '#eee';
				switch ($header_layout) {
					case 'header-3':
						$header_bg_color = '#fff';
						$header_text_color = '#777';
						break;
					case 'header-8':
						$header_bg_color = '#fff';
						$header_text_color = '#fff';
						break;
					case 'header-9':
						$header_bg_color = G5Plus_Global::get_option('accent_color', '#34A853');
						$header_text_color = '#fff';
						break;
					default:
						$header_bg_color = '#fff';
						$header_text_color = '#212121';
						break;
				}
				if ($header_float) {
					$header_text_color = '#fff';
					$header_bg_color = g5plus_hex2rgba($header_bg_color, 0.2);
					$header_border_color = g5plus_hex2rgba($header_border_color, 0.2);
				}
			}


			// Top bar Color
			/////////////////////////////////////////////
			$top_bar_bg_color = G5Plus_Global::get_option('top_bar_bg_color', '#eee');
			$top_bar_text_color = G5Plus_Global::get_option('top_bar_text_color', '#777');
			$top_bar_border_color = G5Plus_Global::get_option('top_bar_border_color', '#eee');
			$top_bar_overlay = G5Plus_Global::get_option('top_bar_overlay', 0);
			if (G5Plus_Global::get_option('top_bar_color_customize', 0)) {
				if ($header_float) {
					$top_bar_bg_color = g5plus_hex2rgba($top_bar_bg_color, $top_bar_overlay);
					$top_bar_border_color = g5plus_hex2rgba($top_bar_border_color, 0.2);
				}
			} else {
				$top_bar_border_color = '#eee';
				switch ($header_layout) {
					case 'header-1':
					case 'header-10':
						$top_bar_bg_color = '#fff';
						$top_bar_text_color = '#777';
						break;
					case 'header-8':
						$top_bar_bg_color = $header_bg_color;
						$top_bar_text_color = '#212121';
						break;
					case 'header-9':
						$top_bar_bg_color = G5Plus_Global::get_option('accent_color', '#34A853');
						$top_bar_text_color = '#fff';
						$top_bar_border_color = 'rgba(255,255,255, 0.2)';
						break;
					default:
						$top_bar_bg_color = '#fff';
						$top_bar_text_color = '#212121';
						break;
				}
				if ($header_float) {
					$top_bar_bg_color = g5plus_hex2rgba($top_bar_bg_color, 0);
					$top_bar_border_color = g5plus_hex2rgba($top_bar_border_color, 0);
				}
			}

			// Navigation Bar Color
			/////////////////////////////////////////////
			$navigation_bg_color = G5Plus_Global::get_option('navigation_bg_color', '#fff');
			$navigation_text_color = G5Plus_Global::get_option('navigation_text_color', '#212121');
			$navigation_text_color_hover = G5Plus_Global::get_option('navigation_text_color_hover', '#34A853');
			$navigation_overlay = G5Plus_Global::get_option('navigation_overlay', 0);
			if (G5Plus_Global::get_option('navigation_color_customize', 0)) {
				if ($header_float) {
					$navigation_bg_color = g5plus_hex2rgba($navigation_bg_color, $navigation_overlay);
				}
			} else {
				switch ($header_layout) {
					case 'header-1':
					case 'header-3':
						$navigation_bg_color = 'transparent';
						$navigation_text_color = '#212121';
						break;
					case 'header-2':
					case 'header-6':
					case 'header-8':
					case 'header-9':
					case 'header-10':
						$navigation_bg_color = G5Plus_Global::get_option('accent_color', '#34A853');
						$navigation_text_color = G5Plus_Global::get_option('foreground_accent_color', '#fff');
						$navigation_text_color_hover = G5Plus_Global::get_option('foreground_accent_color', '#fff');
						break;
					case 'header-4':
						$navigation_bg_color = '#444';
						$navigation_text_color = '#fff';
						break;
					case 'header-7':
						$navigation_bg_color = '#eee';
						$navigation_text_color = '#212121';
						break;
					case 'header-12':
						$navigation_bg_color = '#fff';
						$navigation_text_color = '#222';
						break;
					default:
						$navigation_bg_color = '#fff';
						$navigation_text_color = '#212121';
				}
				if ($navigation_text_color_hover == '') {
					$navigation_text_color_hover = G5Plus_Global::get_option('accent_color', '#34A853');
				}
				if ($header_float) {
					$navigation_text_color = '#fff';
					$navigation_bg_color = g5plus_hex2rgba($navigation_bg_color, 0);
				}
			}


			$GLOBALS['g5plus_theme_color_var'] = array(
				'accent_color'                => G5Plus_Global::get_option('accent_color', '#34A853'),
				'foreground_accent_color'     => G5Plus_Global::get_option('foreground_accent_color', '#fff'),
				'text_color'                  => G5Plus_Global::get_option('text_color', '#666'),
				'border_color'                => G5Plus_Global::get_option('border_color', '#eee'),
				'feature_color1'              => G5Plus_Global::get_option('feature_color1', '#EF7E7E'),
				'feature_color2'              => G5Plus_Global::get_option('feature_color2', '#6FA2F7'),
				'top_drawer_bg_color'         => G5Plus_Global::get_option('top_drawer_bg_color', '#2f2f2f'),
				'top_drawer_text_color'       => G5Plus_Global::get_option('top_drawer_text_color', '#c5c5c5'),
				'header_bg_color'             => $header_bg_color,
				'header_text_color'           => $header_text_color,
				'header_above_border_color'   => $header_above_border_color,
				'header_border_color'         => $header_border_color,
				'top_bar_bg_color'            => $top_bar_bg_color,
				'top_bar_text_color'          => $top_bar_text_color,
				'top_bar_border_color'        => $top_bar_border_color,
				'navigation_bg_color'         => $navigation_bg_color,
				'navigation_text_color'       => $navigation_text_color,
				'navigation_text_color_hover' => $navigation_text_color_hover,

				'top_bar_mobile_bg_color'     => G5Plus_Global::get_option('top_bar_mobile_bg_color', '#fff'),
				'top_bar_mobile_text_color'   => G5Plus_Global::get_option('top_bar_mobile_text_color', '#444'),
				'top_bar_mobile_border_color' => G5Plus_Global::get_option('top_bar_mobile_border_color', '#eee'),
				'header_mobile_bg_color'      => G5Plus_Global::get_option('header_mobile_bg_color', '#fff'),
				'header_mobile_text_color'    => G5Plus_Global::get_option('header_mobile_text_color', '#444'),
				'header_mobile_border_color'  => G5Plus_Global::get_option('header_mobile_border_color', '#eee'),

				'footer_bg_color'             => G5Plus_Global::get_option('footer_bg_color', '#222'),
				'footer_text_color'           => G5Plus_Global::get_option('footer_text_color', '#aaa'),
				'footer_widget_title_color'   => G5Plus_Global::get_option('footer_widget_title_color', '#fff'),
				'footer_border_color'         => G5Plus_Global::get_option('footer_border_color', '#eee'),
				'bottom_bar_bg_color'         => G5Plus_Global::get_option('bottom_bar_bg_color', '#2d2d2d'),
				'bottom_bar_text_color'       => G5Plus_Global::get_option('bottom_bar_text_color', '#aaa'),
				'bottom_bar_border_color'     => G5Plus_Global::get_option('bottom_bar_border_color', '#eee'),
			);

			return $GLOBALS['g5plus_theme_color_var'];
		}

		//==============================================================================
		// GET page changed setting
		//==============================================================================
		public static function &get_page_changed_setting()
		{
			if (isset($GLOBALS['g5plus_page_changed_setting'])) {
				return $GLOBALS['g5plus_page_changed_setting'];
			}
			$GLOBALS['g5plus_page_changed_setting'] = array(
				'page_setting'     => false,
				'spacing'          => false,
				'accent_color'     => false,
				'top_drawer_color' => false,
				'top_bar_color'    => false,
				'header_color'     => false,
				'navigation_color' => false,
				'footer_color'     => false,
				'bottom_bar_color' => false
			);

			return $GLOBALS['g5plus_page_changed_setting'];
		}

		// IS CHANGE CATEGORY SETTING
		public static function is_changed_category_setting() {
			if (isset($GLOBALS['g5plus_is_changed_category_setting'])) {
				return $GLOBALS['g5plus_is_changed_category_setting'];
			}
			return false;
		}

		public static function set_is_changed_category_setting($value) {
			$GLOBALS['g5plus_is_changed_category_setting'] = $value;
		}

		public static function get_page_setting_meta($key) {
			if (isset($GLOBALS['g5plus_page_setting_meta']) && isset($GLOBALS['g5plus_page_setting_meta'][$key])) {
				return $GLOBALS['g5plus_page_setting_meta'][$key];
			}
			return '';
		}

		public static function set_page_setting_metas($value) {
			$GLOBALS['g5plus_page_setting_meta'] = $value;
		}
	}
}