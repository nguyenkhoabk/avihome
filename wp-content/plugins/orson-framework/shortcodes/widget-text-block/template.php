<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $widget_layout
 * @var $title
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Widget_Text_Block
 */

$widget_layout = $title =  $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

$wrapper_classes = array(
	'g5plus-widget-text-block',
	'clearfix',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$type = 'WP_Widget_Text';
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php $this->the_widget( $type, $atts); ?>
</div>
