<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * @var $name
 * @var $price
 * @var $features
 * @var $title
 * @var $link
 * @var $recommend
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Pricing_Tables
 */

$values = $name = $price = $features = $title = $link = $recommend = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$values = (array) vc_param_group_parse_atts( $values );

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-pricing-tables',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation ),
);
// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
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
$button_class= 'btn btn-sm btn-gray';

if ( 'true' === $recommend) {
	$wrapper_classes[] = 'pricing-recommend';
	$button_class= 'btn btn-sm';
}

if ( $wrapper_styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $wrapper_styles ) . '"';
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

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'pricing-tables', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/pricing-tables/assets/css/pricing-tables'.$min_suffix.'.css'), array(), false, 'all');
}
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php if ( 'true' === $recommend): ?>
		<div class="pricing-recommend">
			<span>RECOMMEND</span>
		</div>
	<?php endif; ?>
	<div class="pricing-name">
		<h4><?php echo esc_attr($name)?></h4>
	</div>
	<div class="pricing-price">
		<span class="price-value"><?php echo esc_attr($price)?></span>
	</div>
	<div class="pricing-features">
		<ul>
			<?php foreach ($values as $data): ?>
				<?php $features = isset( $data['features'] ) ? $data['features'] : ''; ?>
				<?php if (!empty($features)): ?>
					<li><?php echo wp_kses_post($features)?></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php if (!empty($title)): ?>
	<div class="pricing-action">
		<a class="<?php echo esc_attr($button_class) ?>" <?php echo implode( ' ', $button_attributes );?>><?php echo esc_html($title) ?></a>
	</div>
	<?php endif; ?>
</div>