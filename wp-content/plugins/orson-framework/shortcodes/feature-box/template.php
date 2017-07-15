<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 16/5/2016
 * Time: 3:22 PM
 */
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $image
 * @var $video_url
 * @var $title
 * @var $description
 * @var $text_link
 * @var $link
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Feature_Box
 */

$layout_style = $image = $video_url = $title = $description = $text_link = $link = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

//parse link
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
}else {
	$a_href = '#';
}
if(empty($a_target)){
	$a_target='_self';
}

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-feature-box',
	$layout_style,
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
// get image src
if (!empty($image)) {
	$image_id = preg_replace('/[^\d]/', '', $image);
	if($layout_style=='style_02')
	{
		$img = wpb_getImageBySize( array( 'attach_id' => $image_id, 'thumb_size' => '370x210'  ) );
	}
	else{
		$img = wpb_getImageBySize( array( 'attach_id' => $image_id, 'thumb_size' => '270x270'  ) );
	}
}
$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'feature-box', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/feature-box/assets/css/feature-box'.$min_suffix.'.css'), array(), false, 'all');
}

?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php if ($layout_style == 'style_02'): ?>
		<div class="feature-thumb">
			<?php if($video_url != ''):?>
				<a class="view-video" data-src="<?php echo esc_url($video_url); ?>">
					<?php echo wp_kses_post($img['thumbnail']);?>
					<i class="fa fa-play-circle-o"></i>
				</a>
			<?php else:?>
				<a target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href); ?>">
					<?php echo wp_kses_post($img['thumbnail']);?>
				</a>
			<?php endif;?>
		</div>
		<div class="feature-content">
			<?php if($title!=''):?>
				<a class="fs-20 text-color-bold" target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href); ?>"><?php echo esc_html($title); ?></a>
			<?php endif;
			if($description!=''): ?>
				<p class="fs-14 text-color-light"><?php echo wp_kses_post($description); ?></p>
			<?php endif;
			if($text_link!=''): ?>
				<a class="text-link fs-13 fw-bold" target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href); ?>"><?php echo esc_html($text_link); ?><i class="fa fa-arrow-right fs-10"></i></a>
			<?php endif;?>
		</div>
	<?php else: ?>
		<div class="feature-content">
			<?php if($title!=''):?>
				<a class="fs-20 text-color-bold" target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href); ?>"><?php echo esc_html($title); ?></a>
			<?php endif;
			if($description!=''): ?>
				<p class="fs-14 text-color-light"><?php echo wp_kses_post($description); ?></p>
			<?php endif;
			if($text_link!=''): ?>
				<a class="text-link fs-13 fw-bold" target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href); ?>"><?php echo esc_html($text_link); ?><i class="fa fa-arrow-right fs-10"></i></a>
			<?php endif;?>
		</div>
		<div class="feature-thumb">
			<?php if($video_url != ''):?>
				<a class="view-video" data-src="<?php echo esc_url($video_url); ?>">
					<?php echo wp_kses_post($img['thumbnail']);?>
					<i class="fa fa-play-circle-o"></i>
				</a>
			<?php else:?>
				<a target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href); ?>">
					<?php echo wp_kses_post($img['thumbnail']);?>
				</a>
			<?php endif;?>
		</div>
	<?php endif; ?>
</div>