<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 18/5/2016
 * Time: 3:47 PM
 */
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $size
 * @var $values
 * @var $name
 * @var $link
 * @var $color
 * @var $icon_font
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Icon_Box
 */
$layout_style = $size = $values = $name = $link = $color = $icon_font = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$values = (array) vc_param_group_parse_atts( $values );

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-social-icons',
	$layout_style,
	$size,
	$this->getExtraClass($el_class),
	$this->getCSSAnimation($css_animation)
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}

if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode('; ', $wrapper_styles) . '"';
}

//parse link
$link_attributes = array();
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
} else {
	$a_href = '#';
}

$link_attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
if (!empty($a_title)) {
	$link_attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
}
if ( ! empty( $a_target ) ) {
	$link_attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
}
$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);


if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'social-icons', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/social-icons/assets/css/social-icons'.$min_suffix.'.css'), array(), false, 'all');
}

?>
<ul class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php foreach ($values as $data): ?>
		<?php $style_social_icon=$style_social_icon_border=$style_icon='';?>
		<?php $name = isset( $data['name'] ) ? $data['name'] : ''; ?>
		<?php $link = isset( $data['link'] ) ? $data['link'] : ''; ?>
		<?php $color = isset( $data['color'] ) ? $data['color'] : ''; ?>
		<?php $icon_font = isset( $data['icon_font'] ) ? $data['icon_font'] : ''; ?>
		<?php
			$width = 100/count($values);
		if(($layout_style != 'style_04')&&($layout_style != 'style_03')){
			$style_social_icon = 'style = "width:'. $width .'%;"';
		}
		else{
			if(!empty($color)){
				$style_social_icon = 'style = "background-color:'.$color.'; width:'. $width .'%;"';
				$style_social_icon_border = 'style= "border-color:'.$color.';"';
			}
			else{
				$style_social_icon = 'style = "width:'. $width .'%;"';
			}
		}
		if(!empty($color)) {
			$style_icon = 'style = "background-color:'.$color.';"';
		}

		?>
		<li class="social-icon-item col-xs-12" <?php echo wp_kses_post($style_social_icon)?>>
			<a <?php echo wp_kses_post($style_social_icon_border)?> href="<?php echo esc_url($link)?>">
				<span class="social-icon-name"><?php echo esc_html($name)?></span>
				<?php if($layout_style=='style_01'): ?>
					<span data-lang="en" class="social-icon-name-hover chaffle" style="color: <?php echo esc_attr($color)?>"><?php echo esc_html($name)?></span>
				<?php endif; ?>
				<i <?php echo wp_kses_post($style_icon)?> class="<?php echo esc_attr($icon_font) ?>"></i>
			</a>
		</li>
	<?php endforeach; ?>
</ul>