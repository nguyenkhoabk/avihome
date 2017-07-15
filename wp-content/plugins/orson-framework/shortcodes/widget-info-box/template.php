<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $widget_layout
 * @var $title
 * @var $style
 * @var $values
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Widget_Info_Box
 */

$widget_layout = $title = $style = $values = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
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
	'g5plus-widget-info-box',
	'clearfix',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

$values = (array) vc_param_group_parse_atts( $values );
$atts['fields'] = array();
$index = 0;
foreach ($values as $value) {
	$atts['fields'][$index] = array();
	$atts['fields'][$index]['title'] = isset($value['title']) ? $value['title'] : '';
	$atts['fields'][$index]['icon'] = isset($value['icon']) ? $value['icon'] : '' ;
	$atts['fields'][$index]['description'] = isset($value['description']) ? $value['description'] : '';
	$atts['fields'][$index]['link'] = isset($value['link']) ? $value['link'] : '';
	$atts['fields'][$index]['read_more'] = isset($value['read_more']) ? $value['read_more'] : '';
	$index++;
}

$atts['extra'] = array();
$atts['extra']['title'] = $title;
$atts['extra']['style'] = $style;


$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$type = 'G5Plus_Widget_Info_Box';
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php $this->the_widget( $type, $atts); ?>
</div>
