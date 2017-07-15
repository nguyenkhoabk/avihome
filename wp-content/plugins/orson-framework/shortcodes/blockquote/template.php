<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout
 * @var $border_size
 * @var $quote_content
 * @var $author_name
 * @var $author_link
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_BlockQuote
 */

$layout = $border_size = $quote_content = $author_name = $author_link = $css_animation = $animation_duration = $animation_delay = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();

$author_link_attributes = array();

$wrapper_classes = array(
	'g5plus-quote',
	'clearfix',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

if (in_array($layout,array('border_left','border_left_primary')) ) {
	$wrapper_classes[] = 'qt-' . $border_size;
}

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

$author_html = '';

//parse link
$author_link = ( '||' === $author_link ) ? '' : $author_link;
$author_link = vc_build_link( $author_link );
$use_link = false;
if ( strlen( $author_link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $author_link['url'];
	$a_title = $author_link['title'];
	$a_target = $author_link['target'];
}

if ( $use_link ) {
	$author_link_attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
	$author_link_attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
	if ( ! empty( $a_target ) ) {
		$author_link_attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
	}

	$author_html = '<cite><a '. implode(' ', $author_link_attributes) .'>'. esc_html($author_name) .'</a></cite>';
} else {
	$author_html = '<cite>'. esc_html($author_name) .'</cite>';
}

if ($layout == 'border_left_primary'){
	$wrapper_classes[] = 'quote-border-left-accent';
}
if ($layout == 'border_round'){
	$wrapper_classes[] = 'quote-border';
}

if ($layout == 'border_round_large'){
	$wrapper_classes[] = 'quote-border-large';
}


$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>
<blockquote class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<p>
		<?php echo esc_html($quote_content); ?>
		<?php if (!empty($author_name)): ?>
			<?php echo wp_kses_post($author_html); ?>
		<?php endif; ?>
	</p>
</blockquote>
