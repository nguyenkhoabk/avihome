<?php
/**
 * Shortcode attributes
 * @var $content
 * @var $atts
 * @var $arrows
 * @var $dots
 * @var $infinite
 * @var $arrows_style
 * @var $arrows_position
 * @var $items_lg
 * @var $items_md
 * @var $items_sm
 * @var $items_xs
 * @var $items_mb
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * @vả $gap
 * Shortcode class
 * @var $this WPBakeryShortCode_g5Plus_Slider_Container
 */
$arrows = $dots = $infinite = $arrows_style = $arrows_position = $items_lg = $items_md = $items_sm = $items_xs = $items_mb = $css_animation = $animation_duration = $animation_delay = $el_class = $css = $gap = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-slider-container',
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
$wrapper_classes[] = 'owl-carousel';

if ($arrows) {
	$wrapper_classes[] = 'owl-nav-'. $arrows_position;
	if (!empty($arrows_style)) {
		$wrapper_classes[] = 'owl-nav-' . $arrows_style;
	}
}

$owl_responsive_attributes = array();

$owl_margin = $gap;
// Mobile <= 480px
$owl_responsive_attributes[] = '"0" : {"items" : '. $items_mb .', "margin": 0}';

// Extra small devices ( < 768px)
$owl_responsive_attributes[] = '"481" : {"items" : '. $items_xs .', "margin": '. $owl_margin .'}';

// Small devices Tablets ( < 992px)
$owl_responsive_attributes[] = '"768" : {"items" : '. $items_sm .', "margin": '. $owl_margin .'}';

// Medium devices ( < 1199px)
$owl_responsive_attributes[] = '"992" : {"items" : '. $items_md .', "margin": '. $owl_margin .'}';

// Medium devices ( > 1199px)
$owl_responsive_attributes[] = '"1200" : {"items" : '. $items_lg .', "margin": '. $owl_margin .'}';

$owl_attributes = array(
	'"autoHeight": true',
	'"dots": ' . ($dots ? 'true' : 'false'),
	'"nav": ' . ($arrows ? 'true' : 'false'),
	'"responsive": {'. implode(', ', $owl_responsive_attributes) . '}'
);
$wrapper_attributes[] = "data-owl-config='{". implode(', ', $owl_attributes) ."}'";

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php echo do_shortcode($content) ?>
</div>