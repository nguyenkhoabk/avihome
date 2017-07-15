<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $image
 * @var $title
 * @var $description
 * @var $title_bt
 * @var $link
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Product_Category_Box
 */

$layout_style = $image = $height = $title = $description = $title_bt = $link = $css_animation = $animation_duration = $animation_delay = $el_class = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-product-category-box',
	'text-center',
	$layout_style,
	$this->getExtraClass($el_class),
	$this->getCSSAnimation($css_animation)
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}

if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode(' ', $wrapper_styles) . '"';
}

// get image src
if (!empty($image)) {
	$image_id = preg_replace('/[^\d]/', '', $image);
	$image_src = wp_get_attachment_image_src($image_id, 'full');
	$image_title = esc_attr(get_the_title($image_id));
	if (!empty($image_src[0])) {
		$image_src = $image_src[0];
	}
}

//parse link
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
}
$button_attributes = array();
if ( $use_link ) {
	$button_attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
	if(empty($a_title)) {
		$a_title = $title;
	}
	$button_attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
	if ( ! empty( $a_target ) ) {
		$button_attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
	}
}
if($layout_style!=''){
	$button_class='btn btn-md btn-white';
}
else{
	$button_class='btn btn-md btn-light';
}


$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'product-category-box', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/product-category-box/assets/css/product-category-box'.$min_suffix.'.css'), array(), false, 'all');
}


?>
<div class="<?php echo esc_attr($css_class) ?>" style="background-image: url('<?php echo esc_url($image_src)?>') " <?php echo implode(' ', $wrapper_attributes); ?>>
	<div class="product-category-box-content">
		<?php if (!empty($title)): ?>
			<h4 class="widget-title style_02"><span><?php echo esc_html($title); ?></span></h4>
		<?php endif;?>
		<?php if (!empty($description)): ?>
			<p><?php echo esc_html($description); ?></p>
		<?php endif; ?>
		<?php if (!empty($title_bt)): ?>
			<a class="<?php echo esc_attr($button_class) ?>" <?php echo implode( ' ', $button_attributes );?>><?php echo esc_html($title_bt) ?></a>
		<?php endif; ?>
	</div>
</div>
