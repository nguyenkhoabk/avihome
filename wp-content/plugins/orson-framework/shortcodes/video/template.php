<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 28/5/2016
 * Time: 8:27 AM
 */
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $link
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Video
 */

$layout_style = $link = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-video',
	$layout_style,
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation ),
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}

if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode('; ', $wrapper_styles) . '"';
}

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'video', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/video/assets/css/video'.$min_suffix.'.css'), array(), false, 'all');
}
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<a class="prettyPhoto view-video" data-src="<?php echo esc_url($link) ?>">
		<span class="pe-7s-play"></span>
	</a>
</div>

