<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 24/5/2016
 * Time: 10:47 AM
 */
/**
 * Shortcode attributes
 * @var $atts
 * @var $sale
 * @var $title
 * @var $description
 * @var $featured
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Sale_Box
 */

$sale = $title = $description = $featured = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);


$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-sale-box',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation ),
);
//parse link
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
}else {
	$a_href = '#';
}
if(empty($a_target)){
	$a_target='_self';
}

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
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'sale-box', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/sale-box/assets/css/sale-box'.$min_suffix.'.css'), array(), false, 'all');
}
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<div class="sale-number">
		<span class="sale-number-inner"><?php echo esc_html($sale)?></span>
	</div>
	<div class="sale-info">
		<?php if (!empty($title)): ?>
			<a target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href); ?>">
				<h4 class="sale-title"><?php echo esc_html($title)?></h4>
			</a>
		<?php endif; ?>
		<p class="sale-description"><?php echo esc_html($description)?></p>
	</div>
	<div class="sale-featured">
		<span class="sale-featured-inner"><?php echo esc_html($featured)?></span>
	</div>
</div>

