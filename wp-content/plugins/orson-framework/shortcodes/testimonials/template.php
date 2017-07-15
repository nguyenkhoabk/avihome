<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * @var $layout_style
 * @var $layout_type
 * @var $layout_type_2
 * @var $text_align
 * @var $color_scheme
 * @var $arrows
 * @var $arrows_position
 * @var $arrows_style
 * @var $dots
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Testimonials
 */

$values = $layout_style = $layout_type = $layout_type_2 = $text_align = $color_scheme = $arrows = $arrows_position = $arrows_style = $dots = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$values = (array) vc_param_group_parse_atts( $values );

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-testimonials',
	'owl-carousel',
	$layout_style,
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
	$wrapper_attributes[] = 'style="' . implode('; ', $wrapper_styles) . '"';
}

if ($layout_style == 'style1') {
	$wrapper_classes[] = $layout_type;
	$wrapper_classes[] = $text_align;
}
if ($layout_style == 'style2') {
	$wrapper_classes[] = $layout_type_2;
}
if ($arrows) {
	if (($layout_style=='style2')||($layout_style=='style3')) {
		$wrapper_classes[] = 'owl-nav-'. $arrows_position;
	}
	if (!empty($arrows_style)) {
		$wrapper_classes[] = 'owl-nav-' . $arrows_style;
	}
}

$owl_attributes = array(
	'"dots": ' . ($dots ? 'true' : 'false'),
	'"nav": ' . ($arrows ? 'true' : 'false'),
	'"items": 1',
	'"animateOut": "fadeOut"',
	'"loop":true'
);
$wrapper_attributes[] = "data-owl-config='{". implode(', ', $owl_attributes) ."}'";

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'testimonials', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/testimonials/assets/css/testimonials'.$min_suffix.'.css'), array(), false, 'all');
}

?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php foreach ($values as $data): ?>
		<?php $avatar = isset( $data['avatar'] ) ? $data['avatar'] : ''; ?>
		<?php $quote = isset( $data['quote'] ) ? $data['quote'] : ''; ?>
		<?php $author = isset( $data['author'] ) ? $data['author'] : ''; ?>
		<?php $author_info = isset( $data['author_info'] ) ? $data['author_info'] : ''; ?>
		<?php $image = wp_get_attachment_image_src( $avatar, 'full' ); ?>
		<div class="testimonial-item">
			<div class="quote">
				<i class="fa fa-quote-left" aria-hidden="true"></i>
				<p class="s-font"><?php echo esc_html($quote)?></p>
			</div>
			<div class="info">
				<?php if (!empty($image[0])): ?>
					<img alt="<?php echo esc_attr($author)?>" src="<?php echo esc_url($image[0])?>"/>
				<?php endif; ?>
				<div class="info-content">
					<?php if (!empty($author)): ?>
						<h4><?php echo esc_html($author)?></h4>
					<?php endif; ?>
					<?php if (!empty($author_info)): ?>
						<span><?php echo esc_html($author_info)?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>