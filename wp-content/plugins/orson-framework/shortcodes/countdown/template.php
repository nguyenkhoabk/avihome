<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 20/5/2016
 * Time: 3:57 PM
 */
/**
 * Shortcode attributes
 * @var $atts
 * @var $color_scheme
 * @var $size
 * @var $time
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Countdown
 */

$color_scheme = $size = $time = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);


$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-countdown',
	'product-deal-countdown',
	$size,
	$color_scheme,
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation ),
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}
if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode('; ', array_filter($wrapper_styles) ) . '"';
}

$class_to_filter = implode(' ', array_filter($wrapper_classes));
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'countdown', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/countdown/assets/css/countdown'.$min_suffix.'.css'), array(), false, 'all');
}

if ( !empty($time)) {
	$time =  mysql2date( 'Y/m/d H:i:s', $time );

	?>
	<div class="<?php echo esc_attr($css_class) ?>" data-date-end="<?php echo esc_attr($time); ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
		<div class="product-deal-countdown-inner">
			<div class="countdown-section">
				<span class="countdown-amount countdown-day"></span>
				<span class="countdown-period"><?php esc_html_e('DAYS','g5plus-orson'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-hours"></span>
				<span class="countdown-period"><?php esc_html_e('HOURS','g5plus-orson'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-minutes"></span>
				<span class="countdown-period"><?php esc_html_e('MINS','g5plus-orson'); ?></span>
			</div>
			<div class="countdown-section">
				<span class="countdown-amount countdown-seconds"></span>
				<span class="countdown-period"><?php esc_html_e('SECS','g5plus-orson'); ?></span>
			</div>
		</div>
	</div>
<?php
}