<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $counter_title
 * @var $counter_value
 * @var $counter_unit
 * @var $counter_unit_align
 * @var $text_align
 * @var $color_scheme
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Counter
 */

$counter_title = $counter_value = $counter_unit = $counter_unit_align = $text_align = $color_scheme = $css_animation = $animation_duration = $animation_delay = $el_class = $css =  '';
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
    'g5plus-counter',
    $this->getExtraClass( $el_class ),
    $this->getCSSAnimation( $css_animation ),
    $color_scheme,
    'text-'.$text_align
);


if ( $styles ) {
    $wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
    $min_suffix_css = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
    wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'counter', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/counter/assets/css/counter'.$min_suffix_css.'.css'), array(), false, 'all');
}
?>

<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
    <div class="ct_content">
        <?php if(($counter_unit_align=='left') && !empty($counter_unit)): ?>
            <span class="ct_unit"><?php echo wp_kses_post($counter_unit) ?></span>
        <?php endif;
        if(!empty($counter_value)): ?>
            <span class="ct_value counter" ><?php echo wp_kses_post($counter_value) ?></span>
        <?php endif;
        if(($counter_unit_align =='right') && !empty($counter_unit)): ?>
            <span class="ct_unit"><?php echo wp_kses_post($counter_unit) ?></span>
        <?php endif;
        if(!empty($counter_title)): ?>
            <p class="ct_title"><?php echo wp_kses_post($counter_title) ?></p>
        <?php endif; ?>
    </div>
</div>