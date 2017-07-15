<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $hover_effect
 * @var $banner_image
 * @var $link
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Banner
 */

$hover_effect = $banner_image = $link = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
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
	'g5plus-banner',
	'effect-wrap',
	$hover_effect,
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation($css_animation)
);

//parse link
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$banner_link_attr = array();
if ( strlen( $link['url'] ) > 0 ) {
	$banner_link_attr[] = 'href="'.$link['url'].'"';
	$banner_link_attr[] = (strlen( $link['title'] ) > 0)?'title="'.$link['title'].'"' : '';
	$banner_link_attr[] = (strlen( $link['target'] ) > 0)?'target="'.$link['target'].'"' : '';
	$banner_link_attr[] = (strlen( $link['rel'] ) > 0)?'rel="'.$link['rel'].'"' : '';
} else {
	$banner_link_attr[] = 'href="#"';
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

// image html
$image_html = '';
if (!empty($banner_image)) {
	$image_id = preg_replace('/[^\d]/', '', $banner_image);
	$image_src = wp_get_attachment_image_src( $image_id, 'full' );
	if ( ! empty( $image_src[0] ) ) {
		$image_src = $image_src[0];
		$image_html = '<img alt="'. the_title_attribute(array('post' => $image_id,'echo' => false )) .'" src="'. esc_url($image_src) .'">';
	}
}


$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>

<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php if (!empty($banner_image)): ?>
		<a <?php echo implode( ' ', $banner_link_attr ); ?>></a>
		<?php echo wp_kses_post($image_html); ?>
	<?php endif; ?>
</div>
