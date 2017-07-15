<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $style
 * @var $size
 * @var $align
 * @var $color_scheme
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Heading
 */

$title = $style = $size = $align = $color_scheme = $css_animation = $animation_duration = $animation_delay = $el_class = $css =  '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if (empty($title)) return;

$wrapper_attributes = array();
$styles = array();

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

$wrapper_classes = array(
	'g5plus-heading',
	'widget-title',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation ),
	$style,
	'text-'. $align,
	$color_scheme
);


if ($size == 'lg') {
	$wrapper_classes[] = 'size-lg';
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

$heading_html = trim($title);
if ($style == 'style_03') {
	$index = strpos($title,' ');
	if ($index) {
		$heading_html = '<b>'. substr($title,0,$index) .'</b>' . substr($title,$index);
	}
}

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<span><?php echo wp_kses_post($heading_html); ?></span>
</div>
