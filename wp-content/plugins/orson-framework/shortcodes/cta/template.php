<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $content
 * @var $content_size
 * @var $button_text
 * @var $button_link
 * @var $button_style
 * @var $button_color
 * @var $button_size
 * @var $button_add_icon
 * @var $button_icon_align
 * @var $button_icon_font
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Cta
 */

$content_size = $button_text = $button_link = $button_style = $button_color = $button_size = $button_add_icon = $button_icon_align = $button_icon_font = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();

$button_attributes = array();

$wrapper_classes = array(
	'g5plus-cta',
	'clearfix',
	'text-color-medium',
	$content_size,
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

if (!empty($button_text)) {
	$wrapper_classes[] = 'cta-actions';

	$button_attributes = array();

	$button_classes = array(
		'btn',
		$button_size,
		$button_color,
		$button_style
	);

	//parse link
	$button_link = ( '||' === $button_link ) ? '' : $button_link;
	$button_link = vc_build_link( $button_link );
	$use_link = false;
	if ( strlen( $button_link['url'] ) > 0 ) {
		$use_link = true;
		$a_href = $button_link['url'];
		$a_title = $button_link['title'];
		$a_target = $button_link['target'];
	}

	$button_html = $button_text;

	if ( 'true' === $button_add_icon ) {
		$button_classes[] = 'btn-icon';
		if ($button_icon_align == 'right') {
			$button_classes[] = 'btn-icon-right';
		}
		$icon_html = '<i class="'. esc_attr($button_icon_font) .'"></i>';

		if ( 'left' === $button_icon_align ) {
			$button_html = $icon_html . ' <span>' . $button_html . '</span>';
		} else {
			$button_html = '<span>' . $button_html .  '</span> ' . $icon_html;
		}
	}

	if ( $button_classes ) {
		$button_attributes[] = 'class="' . trim(implode(' ' ,$button_classes) ) . '"';
	}

	if ( $use_link ) {
		$button_attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
		if (empty($a_title)) {
			$a_title = $button_text;
		}
		$button_attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
		if ( ! empty( $a_target ) ) {
			$button_attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
		}
	}


}

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'cta', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/cta/assets/css/cta'.$min_suffix.'.css'), array(), false, 'all');
}
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<div class="cta-content">
		<?php echo wpb_js_remove_wpautop( $content, true ); ?>
	</div>
	<?php if (!empty($button_text)): ?>
		<div class="cta-action">
			<?php if ($use_link) : ?>
				<a <?php echo implode( ' ', $button_attributes );?>><?php echo wp_kses_post($button_html); ?></a>
			<?php else: ?>
				<button <?php echo implode( ' ', $button_attributes );?>><?php echo wp_kses_post($button_html); ?></button>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
