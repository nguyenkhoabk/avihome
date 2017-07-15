<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $title_style
 * @var $title_size
 * @var $title_align
 * @var $title_scheme
 * @var $layout_style
 * @var $size
 * @var $height
 * @var $images
 * @var $images_opacity
 * @var $custom_links
 * @var $custom_links_target
 * @var $arrows
 * @var $dots
 * @var $arrows_style
 * @var $arrows_position
 * @var $items_lg
 * @var $items_md
 * @var $items_sm
 * @var $items_xs
 * @var $items_mb
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Partner_Carousel
 */
$layout_style = $size = $height = $images = $images_opacity = $custom_links = $custom_links_target = $arrows = $dots = $arrows_style = $arrows_position = $items_lg = $items_md = $items_sm = $items_xs = $items_mb = $css_animation = $animation_duration = $animation_delay = $el_class = $css ='';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

if($size=='size_01'){
	$height=90;
}
if($size=='size_02'){
	$height=124;
}

$custom_links = explode(',', $custom_links);
$images = explode(',', $images);

$wrapper_attributes = array();
$wrapper_styles = array();
$content_attributes = array();

$wrapper_classes = array(
'g5plus-partner-carousel',
'heading-' . $title_style,
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

if ($items_md == -1) {
	$items_md = $items_lg;
}

if ($items_sm == -1) {
	$items_sm = $items_lg;
}

if ($items_xs == -1) {
	$items_xs = $items_lg;
}

if ($items_mb == -1) {
	$items_mb = $items_lg;
}

$content_classes[] = 'owl-carousel';

if ($arrows) {
	$content_classes[] = 'owl-nav-'. $arrows_position;
	if (!empty($arrows_style)) {
		$content_classes[] = 'owl-nav-' . $arrows_style;
	}
}

$owl_responsive_attributes = array();
// Mobile <= 480px
$owl_responsive_attributes[] = '"0" : {"items" : '. $items_mb .'}';

// Extra small devices ( < 768px)
$owl_responsive_attributes[] = '"481" : {"items" : '. $items_xs .'}';

// Small devices Tablets ( < 992px)
$owl_responsive_attributes[] = '"768" : {"items" : '. $items_sm .'}';

// Medium devices ( < 1199px)
$owl_responsive_attributes[] = '"992" : {"items" : '. $items_md .'}';

// Medium devices ( > 1199px)
$owl_responsive_attributes[] = '"1200" : {"items" : '. $items_lg .'}';

$owl_attributes = array(
	'"autoHeight": true',
	'"dots": ' . ($dots ? 'true' : 'false'),
	'"nav": ' . ($arrows ? 'true' : 'false'),
	'"responsive": {'. implode(', ', $owl_responsive_attributes) . '}',
	'"loop":true'
);
$content_attributes[] = "data-owl-config='{". implode(', ', $owl_attributes) ."}'";

$css_content_class = implode(' ', $content_classes);
$class_to_filter = implode(' ', $wrapper_classes);

$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if ($custom_links_target=='true') {
	$custom_links_target='_blank';
}
else{
	$custom_links_target='_self';
}
if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'partner-carousel', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/partner-carousel/assets/css/partner-carousel'.$min_suffix.'.css'), array(), false, 'all');
}
$i=0;
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php $this->the_title($title,$title_style,$title_size,$title_align,$title_scheme); ?>
	<div class="row">
		<div class="<?php echo esc_attr($css_content_class);?>" <?php echo implode(' ', $content_attributes) ?>>
		<?php $i = 0; ?>
		<?php foreach ($images as $attach_id):
			$i++;
			$post_thumbnail_id = preg_replace( '/[^\d]/', '', $attach_id );
			$post_thumbnail_src = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
			$post_thumbnail_alt = the_title_attribute(array('post' => $post_thumbnail_id,'echo' => false ));
			if($post_thumbnail_src !='') {?>
				<div class='partner-item text-center '>
					<div class='<?php echo esc_attr($layout_style) ?>' style='height: <?php echo esc_attr($height) ?>px;'>
						<?php if (isset($custom_links[$i]) && $custom_links[$i] != ''): ?>
							<a href="<?php echo esc_url($custom_links[$i]) ?>"
							   target="<?php echo esc_attr($custom_links_target) ?>">
								<img style="opacity: <?php echo esc_attr($images_opacity / 100) ?> "
									 alt="<?php echo esc_attr($post_thumbnail_alt) ?>"
									 src="<?php echo esc_url($post_thumbnail_src[0]) ?>"/>
							</a>
						<?php else: ?>
							<img style="opacity: <?php echo esc_attr($images_opacity / 100) ?> " alt="<?php echo esc_attr($post_thumbnail_alt) ?>" src="<?php echo esc_url($post_thumbnail_src[0]) ?>"/>
						<?php endif;?>
					</div>
				</div>
			<?php }
		endforeach; ?>
		</div>
	</div>
</div>
