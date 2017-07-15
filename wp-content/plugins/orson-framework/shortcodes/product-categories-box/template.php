<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout
 * @var $image
 * @var $title
 * @var $description
 * @var $badge
 * @var $category
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Product_Categories_Box
 */

$layout = $image = $title = $category = $css_animation = $animation_duration = $animation_delay = $el_class = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-product-categories-box',
	'clearfix',
	'bordered',
	$layout,
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

if ($layout == 'vertical') {
	$wrapper_classes[] = 'text-center';
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


$product_categories = array();
$slugs = explode(',', $category);
$slugs = array_map('trim', $slugs);
foreach ($slugs as $slug) {
	$term = get_term_by('slug', $slug, 'product_cat');
	if (is_object($term)) {
		$product_categories[] = $term;
	}
}


$class_to_filter = implode(' ', $wrapper_classes);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'product-categories-box', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/product-categories-box/assets/css/product-categories-box'.$min_suffix.'.css'), array(), false, 'all');
}
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php if (!empty($badge)): ?>
		<span class="badge"><?php echo esc_html($badge); ?></span>
	<?php endif; ?>
	<?php if ($layout == 'vertical') : ?>
		<?php if (!empty($image_src)) : ?>
			<img src="<?php echo esc_url($image_src) ?>" alt="<?php echo esc_attr($image_title); ?>">
		<?php endif; ?>
		<div class="product-categories-box-content">
			<?php if (!empty($title)): ?>
				<h4 class="widget-title"><span><?php echo esc_html($title); ?></span></h4>
			<?php endif;?>
			<?php if (sizeof($product_categories) > 0): ?>
				<ul>
					<?php foreach ($product_categories as $product_category):?>
						<li>
							<a title="<?php echo esc_attr($product_category->name); ?>" href="<?php echo esc_attr(get_term_link($product_category->term_id,'product_cat')) ?>"><?php echo esc_html($product_category->name) ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	<?php else: ?>
		<?php if (!empty($title)): ?>
			<h4 class="widget-title"><span><?php echo esc_html($title); ?></span></h4>
		<?php endif;?>
		<div class="product-categories-box-content clearfix">
			<?php if (!empty($image_src)) : ?>
				<img src="<?php echo esc_url($image_src) ?>" alt="<?php echo esc_attr($image_title); ?>">
			<?php endif; ?>
			<div class="product-categories-box-content-inner">
				<?php if (!empty($description)): ?>
					<p><?php echo esc_html($description); ?></p>
				<?php endif; ?>
				<?php if (sizeof($product_categories) > 0): ?>
					<ul>
						<?php foreach ($product_categories as $product_category):?>
							<li>
								<a title="<?php echo esc_attr($product_category->name); ?>" href="<?php echo esc_attr(get_term_link($product_category->term_id,'product_cat')) ?>"><?php echo esc_html($product_category->name) ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
