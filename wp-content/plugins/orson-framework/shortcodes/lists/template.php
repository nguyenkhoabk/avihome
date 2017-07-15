<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $bullet
 * @var $color
 * @var $size
 * @var $values
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Lists
 */

$style  = $bullet =  $color = $size = $values = $css_animation = $animation_duration = $animation_delay = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();


$wrapper_classes = array(
	'g5plus-lists',
	'clearfix',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation ),
	'g5plus-lists-' . $style,
	( $size ) ? 'g5plus-list-size-' . $size : '',
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

$values = (array) vc_param_group_parse_atts( $values );
$index = 1;

$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'lists', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/lists/assets/css/lists'.$min_suffix.'.css'), array(), false, 'all');
}

?>
<ul class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php foreach ($values as $value) : ?>
		<?php
			$li_classes = array();
			if (!empty($value['color'])) {
				$li_classes[] = 'g5plus-lists-color-' . $value['color'];
			} else {
				$li_classes[] = 'g5plus-lists-color-' . $color;
			}
			$li_attributes = array();
			if ( $li_classes ) {
				$li_attributes[] = 'class="' . implode( ' ', $li_classes ) . '"';
			}
		?>
		<li <?php echo implode( ' ', $li_attributes ); ?>>
			<?php if ($bullet == 'icon') : ?>
				<span><i class="<?php echo esc_attr($value['icon_font']);?>"></i></span>
			<?php else: ?>
				<span><?php echo esc_html($index); ?></span>
			<?php endif; ?>
			<p><?php echo esc_html($value['label']); ?></p>
		</li>
		<?php $index++; ?>
	<?php endforeach; ?>
</ul>
